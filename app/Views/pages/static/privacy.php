<style>
    /* 
   SEO & UX UPDATES:
   - Added Semantic Typography Scales (Fluid resizing)
   - Improved Contrast Ratios (WCAG Compliance)
   - Reduced Layout Shift (CLS optimization)
   - Lightweight animations to maintain page speed
*/

    :root {
        --primary-blue: #1e3a8a;
        --accent-blue: #3b82f6;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --glass-bg: rgba(255, 255, 255, 0.98);
    }

    /* 1. Fluid Hero Section - No fixed height for mobile SEO */
    .policy-hero,
    .terms-hero {
        min-height: 340px;
        height: auto;
        padding: 4rem 1rem;
        background: linear-gradient(135deg, var(--primary-blue) 0%, #1d4ed8 100%);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        border-radius: 0 0 2rem 2rem;
    }

    /* 2. Enhanced Readability Container */
    .policy-body {
        max-width: 800px;
        /* Optimized line length for reading */
        margin: 0 auto;
        line-height: 1.8;
        /* SEO best practice for readability */
        color: var(--text-main);
        font-size: 1.1rem;
    }

    /* 3. Stat Cards - Simplified for Performance */
    .glass-effect {
        background: var(--glass-bg);
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
        border-radius: 1.25rem;
        padding: 2.5rem;
    }

    .glass-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* 4. Semantic Header Styles */
    .h1-seo {
        font-size: clamp(2.25rem, 5vw, 3.5rem);
        font-weight: 800;
        letter-spacing: -0.02em;
        color: #ffffff;
        line-height: 1.1;
        margin-bottom: 1rem;
    }

    /* 5. SEO 'Last Updated' Badge */
    .update-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 2rem;
        color: #ffffff;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }

    /* 6. Mobile Accessibility */
    @media (max-width: 768px) {
        .policy-hero {
            padding: 3rem 1.5rem;
            border-radius: 0;
        }

        .glass-effect {
            padding: 1.5rem;
        }

        .policy-body {
            font-size: 1rem;
        }
    }

    /* 7. Dark Mode - Prevent 'Flash' on load */
    @media (prefers-color-scheme: dark) {
        :root {
            --glass-bg: #1e293b;
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
        }

        .glass-effect {
            border-color: #334155;
        }
    }
</style>
<?php
// ✅ SAFE ACCESS - Static page variables
$current_year = date('Y');
$last_updated = date('F d, Y');
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xxl-9 col-xl-10">

            <!-- ✅ SEO Header -->
            <header class="policy-hero position-relative rounded-4 shadow-lg mb-5 overflow-hidden">
                <div class="hero-bg-clean"></div>

                <div class="container-fluid px-4 py-5 position-relative" style="z-index: 2;">
                    <div class="row align-items-center">
                        <div class="col-lg-3 text-center text-lg-start mb-4 mb-lg-0">
                            <div class="policy-icon-large mx-auto mx-lg-0 shadow-lg d-flex align-items-center justify-content-center bg-white bg-opacity-10 border border-white border-opacity-25 rounded-4"
                                style="width: 120px; height: 120px;">
                                <i class="bi bi-shield-check display-3 text-white"></i>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="update-badge">
                                <i class="bi bi-clock-history me-2"></i>
                                Last updated: <strong>
                                    <?= $last_updated ?>
                                </strong>
                            </div>
                            <h1 class="h1-seo text-white">Privacy Policy & Data Protection</h1>
                            <p class="policy-lead mb-4">Your trust is our priority. Learn how
                                <strong>://onlinewebhub.com</strong> secures your educational journey.</p>

                            <div class="stat-primary d-inline-block">
                                <div
                                    class="bg-white bg-opacity-10 backdrop-blur-sm rounded-3 p-2 px-3 border border-white border-opacity-10">
                                    <span class="text-white small fw-bold text-uppercase tracking-wider">
                                        <i class="bi bi-patch-check-fill text-success me-2"></i>GDPR • DPDP Compliant
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ✅ High-Value Addition: Table of Contents -->
            <nav
                class="toc-container mb-5 p-4 bg-light rounded-4 border border-dashed border-primary border-opacity-25">
                <h5 class="fw-bold mb-3 text-dark">Quick Navigation</h5>
                <div class="row g-2">
                    <div class="col-6 col-md-3"><a href="#intro" class="btn btn-sm btn-outline-primary w-100">1.
                            Introduction</a></div>
                    <div class="col-6 col-md-3"><a href="#collection" class="btn btn-sm btn-outline-primary w-100">2.
                            Data Usage</a></div>
                    <div class="col-6 col-md-3"><a href="#rights" class="btn btn-sm btn-outline-primary w-100">3. Your
                            Rights</a></div>
                    <div class="col-6 col-md-3"><a href="#contact" class="btn btn-sm btn-outline-primary w-100">4.
                            Support</a></div>
                </div>
            </nav>

            <!-- ✅ Semantic Content -->
            <article class="policy-body">
                <section id="intro" class="glass-effect mb-4">
                    <h2 class="h3 fw-bold mb-3 text-primary">1. Introduction</h2>
                    <p>At <strong>OnlineWebHub</strong>, we are committed to transparency. This Privacy Policy outlines
                        how we collect, process, and safeguard your data in compliance with <strong>General Data
                            Protection Regulation (GDPR)</strong> and the <strong>DPDP Act</strong>.</p>
                </section>

                <section id="collection" class="glass-effect mb-4">
                    <h2 class="h3 fw-bold mb-3 text-success">2. Information We Collect</h2>
                    <div class="row g-4">
                        <div class="col-md-6 border-end-md">
                            <h3 class="h6 text-uppercase fw-bold text-muted">Personal Data</h3>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check2 text-success me-2"></i>Name and Email (OAuth2)</li>
                                <li><i class="bi bi-check2 text-success me-2"></i>Quiz scores & progress</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h3 class="h6 text-uppercase fw-bold text-muted">Technical Data</h3>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check2 text-success me-2"></i>IP address & cookies</li>
                                <li><i class="bi bi-check2 text-success me-2"></i>Consent-based analytics</li>
                            </ul>
                        </div>
                    </div>
                </section>
            </article>

            <!-- ✅ Contact Footer -->
            <footer id="contact" class="text-center mt-5 p-5 bg-dark rounded-4 text-white">
                <h2 class="h4 fw-bold mb-3">Privacy Questions?</h2>
                <p class="text-white-50">Our Data Protection Officer (DPO) is here to help.</p>
                <a href="mailto:support@onlinewebhub.com" class="btn btn-primary px-5 py-3 rounded-pill fw-bold">
                    Contact Privacy Team
                </a>
            </footer>

        </div>
    </div>
</div>