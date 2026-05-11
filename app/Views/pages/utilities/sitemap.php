<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <!-- Bootstrap Alert Container -->
            <div id="alert-container" class="mb-3"></div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-sitemap me-2"></i>
                        Sitemap Generator
                    </h4>
                </div>

                <div class="card-body">

                    <p class="text-muted mb-4">
                        Enter a starting URL to crawl the full website and generate a standards‑compliant
                        <code>sitemap.xml</code> for <code><?= esc(base_url()) ?></code>.
                    </p>

                    <!-- Progress -->
                    <div id="progress-section" class="mb-4" style="display: none;">
                        <div class="d-flex justify-content-between small mb-1">
                            <span>Progress</span>
                            <span id="progress-stats">
                                <span id="progress-crawled">0</span> / 
                                <span id="progress-discovered">0</span>
                            </span>
                        </div>

                        <div class="progress mb-2" style="height: 12px;">
                            <div id="pbar" class="progress-bar progress-bar-striped progress-bar-animated bg-info" 
                                 role="progressbar" style="width: 0%">
                            </div>
                        </div>

                        <div class="small text-muted">
                            Status: <strong><span id="progress-status">idle</span></strong><br>
                            Completed: <strong><span id="progress-crawled-label">0</span></strong><br>
                            Pending: <strong><span id="progress-pending">0</span></strong><br>
                            Current: <code id="progress-current">-</code>
                        </div>
                    </div>

                    <form id="sitemap-form" method="post" action="">

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-link me-1"></i>
                                Crawl URL (e.g. full site root)
                            </label>
                            <input type="url" name="crawl_url" class="form-control form-control-lg" 
                                   id="crawl_url" value="<?= esc($crawl_url ?? '') ?>" 
                                   placeholder="https://learn.onlinewebhub.com" />
                            <small class="form-text text-muted">
                                Leave empty to use only manual URLs below.
                            </small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-file-lines me-1"></i>
                                Manual URLs (one per line)
                            </label>
                            <textarea name="urls" id="manual_urls" class="form-control" rows="6"
                                style="font-family: 'Courier New', monospace; font-size: 0.9rem;"><?= esc($urls ?? '') ?></textarea>
                            <small class="form-text text-muted">
                                Optional: Add URLs that might not be linked from the home page.
                            </small>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <button type="button" class="btn btn-primary btn-lg flex-grow-1" id="btn-generate">
                                <i class="fas fa-bolt me-1"></i>
                                <span id="btn-generate-text">Generate Sitemap</span>
                            </button>

                            <button type="button" class="btn btn-outline-secondary btn-lg" id="btn-download" style="display: none;">
                                <i class="fas fa-download me-1"></i>
                                Download sitemap.xml
                            </button>

                            <button type="button" class="btn btn-outline-success btn-lg" id="btn-save" style="display: none;">
                                <i class="fas fa-save me-1"></i>
                                Save to Server
                            </button>
                        </div>
                    </form>

                    <!-- Results -->
                    <div id="results-section" class="mt-4" style="display: none;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="fas fa-list me-2"></i>Summary</h6>
                                        <div id="summary-stats" class="small"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="fas fa-file-code me-2"></i>XML Preview</h6>
                                        <pre id="xml-preview" class="small bg-white p-2 rounded" style="height: 120px; overflow-y: auto; font-size: 0.75rem;"></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-light border rounded small">
                        <strong>Notes:</strong>
                        <ul class="mb-0">
                            <li>Crawls up to <strong>3 levels deep</strong> for performance</li>
                            <li>Only <strong>internal HTTPS/HTTP links</strong> are included</li>
                            <li>Respect robots.txt and <code>no-crawl</code> classes</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
let isProcessing = false;
let generatedData = null;

function showAlert(message, type = 'info') {
    const container = document.getElementById('alert-container');
    const icons = {
        success: 'check-circle text-success',
        error: 'exclamation-circle text-danger',
        info: 'info-circle text-info',
        warning: 'exclamation-triangle text-warning'
    };
    const icon = icons[type] || icons.info;
    
    container.innerHTML = `
        <div class="alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show mb-0" role="alert">
            <i class="fas fa-${icon} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
}

function updateProgressLine(data) {
    const progressSection = document.getElementById('progress-section');
    progressSection.style.display = 'block';
    
    document.getElementById('progress-crawled').textContent = data.crawled || 0;
    document.getElementById('progress-crawled-label').textContent = data.crawled || 0;
    document.getElementById('progress-pending').textContent = data.pending || 0;
    document.getElementById('progress-discovered').textContent = data.discovered || 0;
    document.getElementById('progress-current').textContent = data.current || '-';
    document.getElementById('progress-status').textContent = data.status || 'unknown';

    const pct = data.discovered > 0 ? Math.round((data.crawled / data.discovered) * 100) : 0;
    const pbar = document.getElementById('pbar');
    pbar.style.width = Math.min(100, pct) + '%';
    pbar.setAttribute('aria-valuenow', pct);
}

function updateResults(data) {
    generatedData = data;
    document.getElementById('results-section').style.display = 'block';
    
    document.getElementById('summary-stats').innerHTML = `
        <strong>${data.urls_count || 0}</strong> URLs generated<br>
        Crawled: <strong>${data.progress?.crawled || 0}</strong><br>
        Status: <strong>${data.progress?.status || 'complete'}</strong>
    `;
    
    if (data.xml_preview) {
        document.getElementById('xml-preview').textContent = data.xml_preview;
    }
    
    // Show action buttons
    document.getElementById('btn-download').style.display = 'inline-block';
    document.getElementById('btn-save').style.display = 'inline-block';
}

async function submitSitemapForm(actionUrl, buttonId = null) {
    if (isProcessing) return;
    
    isProcessing = true;
    const button = buttonId ? document.getElementById(buttonId) : document.getElementById('btn-generate');
    const originalText = button.innerHTML;
    
    try {
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Processing...';
        showAlert('Generating sitemap... This may take a moment.', 'info');
        
        // Reset UI
        document.getElementById('progress-section').style.display = 'block';
        document.getElementById('results-section').style.display = 'none';
        
        const formData = new FormData(document.getElementById('sitemap-form'));
        const response = await fetch(actionUrl, {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            updateProgressLine(data.progress || {});
            updateResults(data);
            showAlert(`✅ Sitemap generated successfully! Found <strong>${data.urls_count || 0}</strong> URLs.`, 'success');
        } else {
            showAlert(`❌ ${data.message || 'Failed to generate sitemap'}`, 'error');
        }
        
    } catch (error) {
        console.error('Error:', error);
        showAlert('Network error. Please check your connection and try again.', 'error');
    } finally {
        isProcessing = false;
        button.disabled = false;
        button.innerHTML = originalText;
    }
}

// Event listeners
document.getElementById('btn-generate').addEventListener('click', () => {
    submitSitemapForm('<?= site_url('sitemap/generate') ?>', 'btn-generate');
});

document.getElementById('btn-download').addEventListener('click', () => {
    if (!generatedData) return;
    
    const formData = new FormData(document.getElementById('sitemap-form'));
    const url = '<?= site_url('sitemap/download') ?>?' + new URLSearchParams(formData).toString();
    window.open(url, '_blank');
});

document.getElementById('btn-save').addEventListener('click', () => {
    submitSitemapForm('<?= site_url('sitemap/save') ?>', 'btn-save');
});

// Auto-hide alerts after 8 seconds
document.addEventListener('click', function() {
    setTimeout(() => {
        const alerts = document.querySelectorAll('#alert-container .alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 8000);
});
</script>