<div class="container py-4">
    <h4>Crawling Progress</h4>
    <p>
        Crawling from:
        <code><?= esc($crawl_url) ?></code>
    </p>
    <div id="crawl-progress">
        Pages crawled: <span id="progress-crawled">0</span> / <span id="progress-max"><?= $progress['max'] ?></span><br>
        URLs discovered: <span id="progress-discovered">0</span><br>
        Current page: <span id="progress-current"></span>
    </div>
    <hr>
</div>