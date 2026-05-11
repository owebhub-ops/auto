<?php
namespace App\Libraries;

use DOMDocument;
use DOMXPath;

class SitemapGenerator
{
    protected $urls = [];
    protected $origin = null;
    protected $parsed = []; // already crawled
    protected $seen = []; // all discovered URLs
    protected $maxDepth = 3;
    protected $response = null;

    // Progress
    protected $progress = [
        'started_at' => null,
        'crawled' => 0,
        'discovered' => 0,
        'current' => '',
        'pending' => 0,
        'max_depth' => 3,
        'status' => 'idle', // idle, crawling, complete, error
    ];

    public function __construct(string $origin = null, $response = null)
    {
        $this->origin = rtrim($origin ?: base_url(), '/');
        $this->response = $response;

        // Validate origin
        $origin_parts = parse_url($this->origin);
        if (!$origin_parts || !isset($origin_parts['host'])) {
            log_message('error', 'SitemapGenerator: Invalid origin URL: ' . $this->origin);
            $this->origin = rtrim(base_url(), '/'); // fallback
        }

        $this->resetProgress();
        log_message('debug', 'SitemapGenerator::__construct origin: ' . $this->origin);
    }
    public function addUrl(
        string $loc,
        ?string $lastmod = null,
        ?string $changefreq = 'weekly',
        ?string $priority = '0.8'
    ) {
        // Normalize URL - ensure consistent trailing slash handling
        $loc = rtrim($loc, '/');

        // Avoid duplicates
        if (isset($this->seen[$loc])) {
            return;
        }

        $this->urls[] = compact('loc', 'lastmod', 'changefreq', 'priority');
        $this->seen[$loc] = true;
        $this->updateProgress();

        log_message('debug', 'SitemapGenerator::addUrl: ' . $loc);
    }

    public function parseUrlList(string $rawUrls)
    {
        $lines = array_filter(array_map('trim', explode("\n", $rawUrls)));
        foreach ($lines as $line) {
            if (filter_var($line, FILTER_VALIDATE_URL)) {
                $this->addUrl($line);
            }
        }
    }

    protected function resetProgress()
    {
        $this->progress = [
            'started_at' => date('Y-m-d H:i:s'),
            'crawled' => 0,
            'discovered' => 0,
            'current' => '',
            'pending' => 0,
            'max_depth' => $this->maxDepth,
            'status' => 'idle',
        ];
    }

    protected function updateProgress()
    {
        $this->progress['crawled'] = count($this->parsed);
        $this->progress['discovered'] = count($this->seen);
        $this->progress['pending'] = max(0, count($this->seen) - count($this->parsed));
    }

    public function crawlFrom(?string $initialUrl)
    {
        log_message('debug', 'SitemapGenerator::crawlFrom initial = ' . ($initialUrl ?: '(empty)'));

        if (!$initialUrl || !$this->origin) {
            log_message('debug', 'SitemapGenerator::crawlFrom: no initial URL or origin');
            $this->progress['status'] = 'complete';
            return;
        }

        $url = $this->sanitizeUrl($initialUrl);
        if (!$url || !$this->isInternalUrl($url)) {
            log_message('debug', 'SitemapGenerator::crawlFrom: invalid or external URL = ' . $url);
            $this->progress['status'] = 'error';
            return;
        }

        log_message('debug', 'SitemapGenerator::crawlFrom: starting crawl = ' . $url);
        $this->progress['status'] = 'crawling';
        $this->crawl($url, 0);
        $this->progress['status'] = 'complete';

        log_message('debug', 'SitemapGenerator::crawlFrom finished. URLs count = ' . count($this->urls));
    }

    protected function crawl(string $url, int $depth = 0)
    {
        if ($depth > $this->maxDepth) {
            log_message('debug', "SitemapGenerator::crawl: depth too high on = $url");
            return;
        }

        $url = $this->sanitizeUrl($url);
        if (!$url || isset($this->parsed[$url])) {
            log_message('debug', "SitemapGenerator::crawl: skipped (invalid or parsed) = $url");
            return;
        }

        // Early check before marking as seen
        if (!$this->isInternalUrl($url)) {
            log_message('debug', "SitemapGenerator::crawl: external URL skipped = $url");
            return;
        }

        $this->seen[$url] = true;
        $this->progress['current'] = $url;
        $this->updateProgress();

        if ($this->response) {
            $this->flushProgressLine();
        }

        log_message('debug', "SitemapGenerator::crawl: fetching = $url");

        $context = stream_context_create([
            'http' => [
                'timeout' => 10,
                'user_agent' => 'Mozilla/5.0 (compatible; SitemapGenerator/1.0)'
            ]
        ]);

        $html = @file_get_contents($url, false, $context);
        if ($html === false) {
            log_message('error', "SitemapGenerator::crawl: file_get_contents failed for = $url");
            return;
        }

        $this->parsed[$url] = true;
        $this->addUrl($url, date('c'), 'weekly', $depth === 0 ? '1.0' : '0.7');

        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="UTF-8">' . $html);
        $xpath = new DOMXPath($dom);

        $links = $xpath->query('//a[not(contains(@class,"no-crawl"))]/@href | //link[@rel="canonical"]/@href');
        log_message('debug', "SitemapGenerator::crawl: found " . $links->length . " links on = $url");

        foreach ($links as $link) {
            $href = $link->nodeValue;
            $abs = $this->resolveUrl($href, $url);

            if ($this->isInternalUrl($abs) && !isset($this->seen[$abs])) {
                $this->crawl($abs, $depth + 1);
            }
        }

        $this->updateProgress();
        if ($this->response) {
            $this->flushProgressLine();
        }
    }

    protected function flushProgressLine()
    {
        // Check if headers already sent
        if (headers_sent($file, $line)) {
            log_message('debug', "SitemapGenerator::flushProgressLine: headers already sent ($file:$line)");
            return;
        }

        // Use JSONP-style callback to avoid session interference
        $progressJson = json_encode($this->progress);
        echo "<script>
        (function() {
            if (window.updateProgressLine && typeof window.updateProgressLine === 'function') {
                window.updateProgressLine($progressJson);
            }
        })();
    </script>\n";

        // Safe flush
        if (ob_get_level() > 0) {
            ob_flush();
        }
        flush();
    }
    protected function sanitizeUrl(string $url): ?string
    {
        // Remove fragments early (#anchors)
        $url = preg_replace('/#.*$/', '', $url);

        if (!preg_match('#^https?://#i', $url)) {
            return null;
        }

        $parsed = parse_url($url);
        if (
            !$parsed || !isset($parsed['scheme'], $parsed['host']) ||
            strtolower($parsed['scheme']) !== 'http' && strtolower($parsed['scheme']) !== 'https' ||
            empty(trim($parsed['host']))
        ) {
            return null;
        }

        // Block private/reserved IPs and invalid hosts
        if (
            filter_var($parsed['host'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false &&
            !filter_var($parsed['host'], FILTER_VALIDATE_DOMAIN)
        ) {
            return null;
        }

        // Safe reconstruction
        $parts = [
            $parsed['scheme'],
            '://',
            $parsed['host']
        ];

        if (isset($parsed['port']) && $parsed['port'] != getservbyname(strtolower($parsed['scheme']), 'tcp')) {
            $parts[] = ':';
            $parts[] = $parsed['port'];
        }

        if (isset($parsed['path'])) {
            $parts[] = $parsed['path'];
        } else {
            $parts[] = '/';
        }

        if (isset($parsed['query'])) {
            $parts[] = '?';
            $parts[] = $parsed['query'];
        }

        if (isset($parsed['fragment'])) {
            $parts[] = '#';
            $parts[] = $parsed['fragment'];
        }

        return implode('', $parts);
    }

    protected function resolveUrl(string $href, string $base): string
    {
        // Absolute URL - return as-is (already sanitized)
        if (filter_var($href, FILTER_VALIDATE_URL)) {
            return rtrim($href, '/');
        }

        // Protocol-relative (//example.com)
        if (str_starts_with($href, '//')) {
            $scheme = parse_url($base, PHP_URL_SCHEME);
            if (!$scheme)
                $scheme = 'https';
            return rtrim($scheme . ':' . $href, '/');
        }

        // Root-relative (/path)
        if ($href[0] === '/') {
            $baseParts = parse_url($base);
            if (!$baseParts || !isset($baseParts['scheme']) || !isset($baseParts['host'])) {
                return rtrim($base, '/'); // fallback
            }

            $port = isset($baseParts['port']) ? ':' . $baseParts['port'] : '';
            return rtrim($baseParts['scheme'] . '://' . $baseParts['host'] . $port . $href, '/');
        }

        // Relative path (page.html)
        $base_path = preg_replace('#/[^/]*$#', '', rtrim($base, '/'));
        return rtrim($base_path . '/' . ltrim($href, '/'), '/');
    }

    protected function isInternalUrl(string $url): bool
    {
        if (!$this->origin) {
            return false;
        }

        $origin_parts = parse_url($this->origin);
        $url_parts = parse_url($url);

        // Safety check - if parse_url failed, it's not a valid URL
        if (!$origin_parts || !$url_parts || !isset($origin_parts['host']) || !isset($url_parts['host'])) {
            log_message('debug', "SitemapGenerator::isInternalUrl: invalid URL structure - origin: {$this->origin}, url: $url");
            return false;
        }

        $isEqual = $url_parts['host'] === $origin_parts['host'];
        log_message('debug', "SitemapGenerator::isInternalUrl {$url_parts['host']} === {$origin_parts['host']} = " . ($isEqual ? 'true' : 'false'));
        return $isEqual;
    }

    public function getProgress(): array
    {
        $this->updateProgress();
        return $this->progress;
    }

    public function getUrls(): array
    {
        return $this->urls;
    }

    public function toXml(): string
    {
        log_message('debug', "SitemapGenerator::toXml: URLs count = " . count($this->urls));

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($this->urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            if ($url['lastmod']) {
                $xml .= "    <lastmod>" . htmlspecialchars($url['lastmod'], ENT_XML1, 'UTF-8') . "</lastmod>\n";
            }
            if ($url['changefreq']) {
                $xml .= "    <changefreq>" . htmlspecialchars($url['changefreq'], ENT_XML1, 'UTF-8') . "</changefreq>\n";
            }
            if ($url['priority']) {
                $xml .= "    <priority>" . htmlspecialchars($url['priority'], ENT_XML1, 'UTF-8') . "</priority>\n";
            }
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';
        return $xml;
    }

    public function sendResponse()
    {
        $xml = $this->toXml();
        $this->response
            ->setHeader('Content-Type', 'application/xml; charset=utf-8')
            ->setBody($xml);
    }

    public function saveToFile(string $filePath): bool
    {
        log_message('debug', "SitemapGenerator::saveToFile path = " . $filePath);
        $result = file_put_contents($filePath, $this->toXml()) !== false;
        if ($result) {
            chmod($filePath, 0644);
        }
        return $result;
    }
}