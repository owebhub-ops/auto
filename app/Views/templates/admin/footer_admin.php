<!-- Premium Footer - Matches Policy Page Design -->
<footer class="bg-gradient-dark text-light py-5 mt-auto">
    <div class="container">
        <!-- Main Footer Content -->
        <div class="row g-4 g-lg-5 align-items-center">
            <!-- Brand & Copyright -->
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center mb-3 mb-lg-0">
                    <div class="me-3">
                        <i class="bi bi-book-half display-4 text-primary opacity-75"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1 text-white">Learn.OnlineWebHub</h5>
                        <p class="mb-0 text-light-50 small">© <?= date('Y') ?> All rights reserved.</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="col-lg-4 col-md-6">
                <div class="row g-3 justify-content-center justify-content-lg-start">
                    <div class="col-6 col-sm-4">
                        <h6 class="fw-bold text-white mb-3">Legal</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a href="<?= base_url('privacy') ?>" class="text-light-75 small text-decoration-none hover-primary">Privacy Policy</a></li>
                            <li><a href="<?= base_url('terms') ?>" class="text-light-75 small text-decoration-none hover-primary">Terms of Service</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-4">
                        <h6 class="fw-bold text-white mb-3">Support</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a href="mailto:info@onlinewebhub.com" class="text-light-75 small text-decoration-none hover-success">Help Center</a></li>
                            <li><a href="<?= base_url('contact') ?>" class="text-light-75 small text-decoration-none hover-success">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Company Info & Social -->
            <div class="col-lg-4 col-md-12 text-lg-end text-center">
                <div class="mb-4">
                    <p class="text-light-50 small mb-3">Building the future of online learning</p>
                </div>
                <div class="d-flex justify-content-center justify-content-lg-end gap-3">
                    <a href="https://x.com/onlinewebhub"  target="_blank"  class="btn btn-outline-light btn-sm rounded-circle p-2 hover-scale" aria-label="Twitter">
                        <i class="bi bi-twitter-x fs-5"></i>
                    </a>
                    <!-- <a href="#" class="btn btn-outline-light btn-sm rounded-circle p-2 hover-scale" aria-label="LinkedIn">
                        <i class="bi bi-linkedin fs-5"></i>
                    </a> -->
                    <a href="https://www.youtube.com/@onlinewebhub" target="_blank" class="btn btn-outline-light btn-sm rounded-circle p-2 hover-scale" aria-label="Youtube">
                        <i class="bi bi-youtube fs-5"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <hr class="my-4 border-light border-opacity-10">

        <!-- Bottom Bar -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-2 mb-md-0 text-light-50 small">
                    Made with <i class="bi bi-heart-fill text-danger mx-1" style="font-size: 0.75em;"></i> by 
                    <strong class="text-primary">OWH</strong>
                </p>
            </div>
            <div class="col-md-6 text-md-end text-center">
                <small class="text-light-50">
                    <span class="d-none d-md-inline me-2">Follow us:</span>
                    <a href="#" class="text-light-75 me-2 hover-primary" style="font-size: 0.8em;">@learn_owh</a>
                    <a href="#" class="text-light-75 hover-primary" style="font-size: 0.8em;">v1.0.0</a>
                </small>
            </div>
        </div>
    </div>
</footer>
<div id="cookie-banner" style="position: fixed; bottom: 0; left: 0; right: 0; background: #333; color: white; padding: 20px; z-index: 10000; display: none;">
  <p>We use cookies for analytics and better experience on learn.onlinewebhub.com. <a href="/privacy" style="color: #4CAF50;">Learn more</a>.</p>
  <button onclick="acceptAllCookies()" style="background: #4CAF50; color: white; border: none; padding: 10px 20px; margin-right: 10px; cursor: pointer; border-radius: 4px;">Accept All</button>
  <button onclick="manageCookies()" style="background: #2196F3; color: white; border: none; padding: 10px 20px; margin-right: 10px; cursor: pointer; border-radius: 4px;">Manage Preferences</button>
  <button onclick="rejectCookies()" style="background: transparent; color: white; border: 1px solid white; padding: 10px 20px; cursor: pointer; border-radius: 4px;">Cancel</button>
</div>
<style>

 /* ==========================================================================
   FOOTER STYLES
   ========================================================================== */

/* Gradient Background */
.bg-gradient-dark {
    background: linear-gradient(135deg, 
        #0f172a 0%, 
        #1e293b 50%, 
        #334155 100%);
    border-top: 1px solid rgba(255,255,255,0.08);
}

/* Text Utilities */
.text-light-75 { color: rgba(255,255,255,0.75) !important; }
.text-light-50 { color: rgba(255,255,255,0.5) !important; }

/* Hover Effects */
.hover-primary:hover { color: #3b82f6 !important; }
.hover-success:hover { color: #10b981 !important; }
.hover-scale {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.hover-scale:hover {
    transform: scale(1.15);
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
}

/* Footer Links */
footer a {
    transition: all 0.25s ease;
}
footer a:hover {
    color: inherit !important;
    text-decoration: none !important;
}

/* Responsive Tweaks */
@media (max-width: 768px) {
    footer .row > div { text-align: center !important; }
    footer h5 { font-size: 1.25rem !important; }
}

/* Print Styles */
@media print {
    footer { display: none !important; }
}
<script>
function acceptAllCookies() {
  localStorage.setItem('cookieConsent', 'all');
  document.getElementById('cookie-banner').style.display = 'none';
  loadTrackers('granted');
}
function rejectCookies() {
  localStorage.setItem('cookieConsent', 'reject');
  document.getElementById('cookie-banner').style.display = 'none';
  loadTrackers('denied');
}
function manageCookies() {
  // Implement granular modal: essential (always), analytics/marketing (checkboxes)
  alert('Preferences:\n- Essential: Always On\n- Analytics: [ ] Opt-in\n- Marketing: [ ] Opt-in\nSave to localStorage accordingly.');
}
function loadTrackers(status) {
  if (status === 'granted') {
    // Load GA, etc.: gtag('consent', 'update', {analytics_storage: 'granted'});
  } else {
    // Block trackers
  }
}
if (!localStorage.getItem('cookieConsent')) {
  document.getElementById('cookie-banner').style.display = 'block';
}
</script>

<script>
(function () {
  'use strict'
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl)
  })
})()
</script>
</body>
</html>