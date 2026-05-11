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
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Privacy Policy - Online Web Hub",
  "description": "Information about how Online Web Hub collects, uses, and protects student data for AI and Web development training.",
  "publisher": {
    "@type": "Organization",
    "name": "Online Web Hub"
  }
}
</script>

<main class="container px-0">
    <!-- 🛡️ Policy Hero Section -->
    <header class="policy-hero d-flex align-items-center mb-5">
        <div class="hero-bg-clean"></div>
        <div class="container position-relative z-3">
            <div class="row align-items-center text-white">
                <div class="col-lg-2 text-center text-lg-start mb-4 mb-lg-0">
                    <div class="policy-icon-large bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center mx-auto mx-lg-0 shadow-lg" style="width: 140px; height: 140px;">
                        <i class="bi bi-shield-lock-fill display-3"></i>
                    </div>
                </div>
                <div class="col-lg-10 text-center text-lg-start">
                    <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-2 mb-3 tracking-widest text-uppercase fw-bold" style="font-size: 0.75rem;">Compliance & Trust</span>
                    <h1 class="h1-lg fw-extrabold text-shadow-soft mb-2"><?= $page_title ?? 'Privacy Policy' ?></h1>
                    <p class="lead opacity-75 mb-0">Your privacy is our priority. Learn how we secure your data in the age of AI.</p>
                </div>
            </div>
        </div>
    </header>

    <!-- 📊 Quick Overview Cards (Solves "Thin Content" Issues) -->
    <section class="container py-4">
        <div class="row g-4 mt-n5 position-relative z-3 justify-content-center">
            <div class="col-md-4">
                <div class="glass-effect p-5 rounded-4 text-center h-100">
                    <div class="stat-icon text-primary mb-4 shadow-sm"><i class="bi bi-eye-slash-fill fs-2"></i></div>
                    <h3 class="h5 fw-bold text-dark">Data Transparency</h3>
                    <p class="small text-muted mb-0">We clearly list what data we collect and why—no hidden tracking.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-effect p-5 rounded-4 text-center h-100">
                    <div class="stat-icon text-success mb-4 shadow-sm"><i class="bi bi-lock-fill fs-2"></i></div>
                    <h3 class="h5 fw-bold text-dark">Enterprise Security</h3>
                    <p class="small text-muted mb-0">All student data is encrypted with bank-grade AES-256 protocols.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-effect p-5 rounded-4 text-center h-100">
                    <div class="stat-icon text-info mb-4 shadow-sm"><i class="bi bi-person-check-fill fs-2"></i></div>
                    <h3 class="h5 fw-bold text-dark">User Control</h3>
                    <p class="small text-muted mb-0">You have the legal right to request, edit, or delete your data anytime.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 📄 Main Content Section -->
    <section class="container py-5">
        <div class="row justify-content-center">
            <article class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                    <h2 class="fw-bold mb-4">1. Information Collection</h2>
                    <p class="text-secondary lh-lg">At <strong>Online Web Hub</strong>, we collect information to provide better services to our students. This includes your name, email address, and learning progress. Our AI-driven algorithms analyze your coding patterns to provide personalized feedback but never sell this data to third parties.</p>

                    <h2 class="fw-bold mt-5 mb-4">2. How We Use Data</h2>
                    <p class="text-secondary lh-lg">Your information is used solely for educational purposes, including:</p>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item bg-transparent px-0 border-0 d-flex align-items-center">
                            <i class="bi bi-check2-circle text-primary me-3 fs-5"></i> Personalizing AI-driven coding challenges.
                        </li>
                        <li class="list-group-item bg-transparent px-0 border-0 d-flex align-items-center">
                            <i class="bi bi-check2-circle text-primary me-3 fs-5"></i> Issuing course completion certificates.
                        </li>
                    </ul>

                    <h2 class="fw-bold mt-5 mb-4">3. Your Data Rights</h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="text-center p-4 border rounded-3 bg-light h-100">
                                <i class="bi bi-cloud-download text-primary fs-3 d-block mb-2"></i>
                                <h4 class="h6 fw-bold">Access & Export</h4>
                                <p class="small text-muted mb-0">Download a full copy of your account data.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center p-4 border rounded-3 bg-light h-100">
                                <i class="bi bi-trash text-danger fs-3 d-block mb-2"></i>
                                <h4 class="h6 fw-bold">Permanent Deletion</h4>
                                <p class="small text-muted mb-0">Remove your account and data permanently.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <!-- ✉️ Contact Card (E-E-A-T Signal) -->
    <section class="container pb-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg rounded-4 border-0 p-5 text-center bg-white">
                    <h2 class="fw-bold mb-3">Questions about Privacy?</h2>
                    <p class="text-muted mb-4">Our Data Protection Officer (DPO) is here to help you understand your rights.</p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <a href="mailto:privacy@onlinewebhub.com" class="btn btn-primary lift-hover px-5 py-3 rounded-pill fw-bold">
                            <i class="bi bi-envelope-fill me-2"></i> Email Privacy Team
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
