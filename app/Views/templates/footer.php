<style>
    /* 💎 Premium Footer & UI Enhancements */
    .bg-gradient-dark {
        background: linear-gradient(180deg, #1a1d21 0%, #08090a 100%);
    }

    .footer-heading {
        font-size: 0.85rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #6c757d !important;
        margin-bottom: 1.5rem;
        font-weight: 700;
    }

    .footer-link {
        color: #adb5bd !important;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: block;
        margin-bottom: 0.75rem;
    }

    .footer-link:hover {
        color: #0d6efd !important;
        transform: translateX(5px);
    }

    .social-btn {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
        transition: all 0.3s ease;
    }

    .social-btn:hover {
        background: #0d6efd;
        color: #fff;
        transform: translateY(-3px);
    }

    #cookie-banner {
        backdrop-filter: blur(15px);
        background: rgba(20, 22, 25, 0.98) !important;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.3);
    }
</style>

<footer class="bg-gradient-dark text-light py-5 mt-auto" id="_footer">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- 🚀 Brand & Expertise Column -->
            <div class="col-lg-4 col-md-12">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-car-front-fill display-5 text-primary me-3"></i>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">AutoOWH</h5>
                        <p class="mb-0 text-primary small fw-bold">Your Trusted Car Details Hub</p>
                    </div>
                </div>
                <p class="text-light-50 small pe-lg-5 mb-4">
                    Helping car buyers make smarter decisions with detailed <strong>specifications</strong>,
                    <strong>performance insights</strong>, and <strong>expert reviews</strong>. Compare models, explore
                    features, and discover the latest in <strong>SUVs</strong>, <strong>Sedans</strong>, and
                    <strong>Electric Vehicles</strong>.
                </p>

                <div class="d-flex gap-2">
                    <a href="https://x.com/onlinewebhub" target="_blank" class="social-btn"><i
                            class="bi bi-twitter-x"></i></a>
                    <a href="https://www.youtube.com/@onlinewebhub" target="_blank" class="social-btn"><i
                            class="bi bi-youtube"></i></a>
                    <a href="https://github.com" target="_blank" class="social-btn"><i class="bi bi-github"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <h6 class="footer-heading">Car Categories</h6>
                <ul class="list-unstyled">
                    <li><a href="<?= base_url('cars/suv') ?>" class="footer-link">SUVs & Crossovers</a></li>
                    <li><a href="<?= base_url('cars/sedan') ?>" class="footer-link">Sedans</a></li>
                    <li><a href="<?= base_url('cars/hatchback') ?>" class="footer-link">Hatchbacks</a></li>
                    <li><a href="<?= base_url('cars/electric') ?>" class="footer-link">Electric Vehicles</a></li>
                </ul>
            </div>


            <!-- ⚖️ Governance & Support -->
            <div class="col-lg-2 col-6">
                <h6 class="footer-heading">Governance</h6>
                <ul class="list-unstyled">
                    <li><a href="<?= base_url('privacy') ?>" class="footer-link">Privacy Policy</a></li>
                    <li><a href="<?= base_url('terms') ?>" class="footer-link">Terms of Service</a></li>
                    <li><a href="<?= base_url('contact') ?>" class="footer-link">Contact Support</a></li>
                    <li><a href="<?= base_url('faq') ?>" class="footer-link">Technical FAQ</a></li>
                </ul>
            </div>

            <!-- 📬 Newsletter / Trust Signal -->
            <!-- views/newsletter_form.php - FIXED VERSION -->
            <div class="col-lg-3 col-md-12">
                <h6 class="footer-heading">Join the Hub</h6>
                <p class="small text-light-50 mb-3">
                    Get expert-curated AI insights and technical tutorials delivered monthly.
                </p>

                <?php if (isset($success) && $success): ?>
                    <div class="alert alert-success alert-dismissible fade show py-2 small mb-2" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        <?= esc($success) ?>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($error) && $error): ?>
                    <div class="alert alert-danger alert-dismissible fade show py-2 small mb-2" role="alert">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        <?= esc($error) ?>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form id="newsletterForm" class="needs-validation" novalidate>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= $csrf ?? '' ?>">
                    <div class="input-group input-group-sm mb-2">
                        <input type="email" class="form-control bg-dark border-secondary text-white" name="email"
                            id="emailInput" placeholder="your@email.com" required autocomplete="email">
                        <button class="btn btn-primary" type="submit" id="submitBtn">
                            <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"
                                id="loadingSpinner"></span>
                            Join Now
                        </button>
                    </div>
                    <div id="formFeedback" class="small"></div>
                </form>

                <div class="mt-2 small text-light-50">
                    <i class="bi bi-shield-check me-1"></i>
                    We respect your privacy. Unsubscribe anytime.
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const form = document.getElementById('newsletterForm');
                    const emailInput = document.getElementById('emailInput');
                    const submitBtn = document.getElementById('submitBtn');
                    const loadingSpinner = document.getElementById('loadingSpinner');
                    const formFeedback = document.getElementById('formFeedback');

                    // Clear feedback on input
                    emailInput.addEventListener('input', function () {
                        emailInput.classList.remove('is-invalid');
                        formFeedback.innerHTML = '';
                    });

                    form.addEventListener('submit', async function (e) {
                        e.preventDefault();

                        // Reset previous state
                        formFeedback.innerHTML = '';
                        emailInput.classList.remove('is-invalid');
                        submitBtn.disabled = true;
                        loadingSpinner.classList.remove('d-none');

                        if (!emailInput.checkValidity()) {
                            emailInput.classList.add('is-invalid');
                            formFeedback.innerHTML = '<div class="text-danger small">Please enter a valid email address.</div>';
                            submitBtn.disabled = false;
                            loadingSpinner.classList.add('d-none');
                            return;
                        }

                        try {
                            const formData = new FormData(form);
                            const response = await fetch('<?= site_url("newsletter/subscribe") ?>', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });

                            const result = await response.json();

                            if (result.success === true) {
                                formFeedback.innerHTML = `
                    <div class="alert alert-success py-1 mb-0 small">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        ${result.message || 'Thank you! Check your email.'}
                    </div>`;
                                form.reset();
                            } else {
                                const errorMsg = result.error || result.message || 'Something went wrong.';
                                formFeedback.innerHTML = `
                    <div class="text-danger small">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        ${errorMsg}
                    </div>`;
                                emailInput.classList.add('is-invalid');
                            }
                        } catch (error) {
                            console.error('Newsletter error:', error);
                            formFeedback.innerHTML = `
                <div class="text-danger small">
                    <i class="bi bi-wifi-off me-1"></i>
                    Network error. Please try again.
                </div>`;
                        } finally {
                            submitBtn.disabled = false;
                            loadingSpinner.classList.add('d-none');
                        }
                    });
                });
            </script>
        </div>

        <hr class="border-light opacity-10 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0 text-light-50 small">
                    Powered with <i class="bi bi-lightning-charge-fill text-warning mx-1"></i> passion by
                    <span class="text-white fw-bold border-bottom border-primary">AutoOWH Engineering</span>
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <small class="text-light-50">
                    <span class="badge bg-dark border border-secondary fw-normal px-3 py-2">
                        <i class="bi bi-shield-lock-fill text-success me-1"></i> SSL Secured Car Information Hub
                    </span>
                </small>
            </div>
        </div>
    </div>
    </div>
</footer>

<!-- 🍪 Modernized Cookie Banner -->
<div id="cookie-banner" style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 10000; display: none;">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <p class="text-white small mb-3 mb-lg-0">
                    <i class="bi bi-info-circle-fill text-primary me-2"></i>
                    We utilize <strong>AI-enhanced analytics</strong> to personalize your learning journey. By clicking
                    "Accept All", you consent to our use of cookies in accordance with our
                    <a href="<?= base_url('privacy') ?>" class="text-primary text-decoration-none border-bottom">Data
                        Privacy Framework</a>.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <button onclick="acceptAllCookies()" class="btn btn-primary btn-sm px-4 fw-bold me-2">Accept
                    All</button>
                <button onclick="manageCookies()"
                    class="btn btn-outline-light btn-sm px-4 fw-bold me-2">Preferences</button>
                <button onclick="rejectCookies()"
                    class="btn btn-link btn-sm text-light-50 text-decoration-none">Dismiss</button>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        const banner = document.getElementById('cookie-banner');
        const consentKey = 'owh_consent_v1';

        window.setConsent = (value, status) => {
            localStorage.setItem(consentKey, value);
            if (banner) banner.style.display = 'none';
            if (status === 'granted') initializeAnalytics();
        };

        window.acceptAllCookies = () => setConsent('full', 'granted');
        window.rejectCookies = () => setConsent('minimal', 'denied');
        window.manageCookies = () => {
            // Logic for granular settings modal
            alert('Preference settings coming soon.');
        };

        function initializeAnalytics() {
            const gaScript = document.createElement('script');
            gaScript.async = true;
            gaScript.src = "https://www.googletagmanager.com/gtag/js?id=G-ZPYKDJ8M3M";
            document.head.appendChild(gaScript);

            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', 'G-ZPYKDJ8M3M', { 'anonymize_ip': true });
        }

        if (!localStorage.getItem(consentKey)) {
            setTimeout(() => { if (banner) banner.style.display = 'block'; }, 1000);
        } else if (localStorage.getItem(consentKey) === 'full') {
            initializeAnalytics();
        }
    })();
</script>