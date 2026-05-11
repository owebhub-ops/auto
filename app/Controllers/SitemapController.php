<?php
namespace App\Controllers;

use App\Libraries\SitemapGenerator;
use CodeIgniter\Controller;

class SitemapController extends Controller
{
    public function generator()
    {
        $page_data = $this->getPageData('sitemap-generator');

        $crawl_url = $this->request->getPost('crawl_url') ?? '';
        $rawUrls = $this->request->getPost('urls') ?? '';

        $origin = $crawl_url ?: base_url();
        $sitemap = new SitemapGenerator($origin, $this->response);

        if ($rawUrls) {
            $sitemap->parseUrlList($rawUrls);
        }

        $crawl_from = $crawl_url ?: $origin;
        $sitemap->crawlFrom($crawl_from);

        $content = view('pages/utilities/sitemap', [
            'crawl_url' => $crawl_url,
            'urls' => $rawUrls,
            'sitemap' => $sitemap,
            'progress' => $sitemap->getProgress(),
        ]);

        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => $page_data['title'],
                'description' => $page_data['description'],
                'keywords' => $page_data['keywords'],
            ],
            'content' => $content
        ]);
    }

    public function generate()
    {
        $rawUrls = $this->request->getPost('urls') ?? '';
        $crawl_url = $this->request->getPost('crawl_url') ?? '';

        $origin = $crawl_url ?: base_url();
        $sitemap = new SitemapGenerator($origin, $this->response);

        if ($rawUrls) {
            $sitemap->parseUrlList($rawUrls);
        }

        $crawl_from = $crawl_url ?: $origin;
        $sitemap->crawlFrom($crawl_from);

        return $this->response
            ->setStatusCode(200)
            ->setHeader('Content-Type', 'application/json')
            ->setJSON([
                'success' => true,
                'urls_count' => count($sitemap->getUrls()),
                'progress' => $sitemap->getProgress(),
                'xml_preview' => substr($sitemap->toXml(), 0, 1000) . '...'
            ]);
    }

    public function download()
    {
        $rawUrls = $this->request->getPost('urls') ?? '';
        $crawl_url = $this->request->getPost('crawl_url') ?? '';

        $origin = $crawl_url ?: base_url();
        $sitemap = new SitemapGenerator($origin, $this->response);

        if ($rawUrls) {
            $sitemap->parseUrlList($rawUrls);
        }

        $crawl_from = $crawl_url ?: $origin;
        $sitemap->crawlFrom($crawl_from);

        log_message('debug', "SitemapController::download URLs count = " . count($sitemap->getUrls()));

        $xml = $sitemap->toXml();

        return $this->response
            ->setHeader('Content-Type', 'application/xml; charset=utf-8')
            ->setHeader('Content-Disposition', 'attachment; filename="sitemap.xml"')
            ->setHeader('Cache-Control', 'no-cache')
            ->setBody($xml);
    }

    public function save()
    {
        $rawUrls = $this->request->getPost('urls') ?? '';
        $crawl_url = $this->request->getPost('crawl_url') ?? '';

        $origin = $crawl_url ?: base_url();
        $sitemap = new SitemapGenerator($origin, null);

        if ($rawUrls) {
            $sitemap->parseUrlList($rawUrls);
        }

        $crawl_from = $crawl_url ?: $origin;
        $sitemap->crawlFrom($crawl_from);

        $path = WRITEPATH . 'sitemaps/sitemap.xml';
        $dir = dirname($path);
        
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $success = $sitemap->saveToFile($path);

        log_message('debug', "SitemapController::save URLs count = " . count($sitemap->getUrls()));

        return $this->response
            ->setStatusCode($success ? 200 : 500)
            ->setHeader('Content-Type', 'application/json')
            ->setJSON([
                'success' => $success,
                'message' => $success ? 'Sitemap saved successfully' : 'Failed to save sitemap',
                'file_url' => $success ? base_url('writable/sitemaps/sitemap.xml') : null,
                'urls_count' => count($sitemap->getUrls()),
                'progress' => $sitemap->getProgress(),
            ]);
    }

    protected function getPageData(string $page_slug): array
    {
        $pages = [
            'sitemap-generator' => [
                'title' => 'Generate sitemap.xml - Learn.OnlineWebHub.com',
                'description' => 'Enter a URL to crawl the full website and generate a standards‑compliant sitemap.xml file.',
                'keywords' => 'sitemap generator, sitemap.xml, full site crawl, codeigniter 4',
                'page_title' => 'Sitemap Generator',
            ],
        ];

        return $pages[$page_slug] ?? $pages['sitemap-generator'];
    }
}