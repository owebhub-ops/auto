<style>
    :root {
        --primary-blue: #1e3a8a;
        --accent-blue: #3b82f6;
        --text-dark: #0f172a;
        --glass-bg: rgba(255, 255, 255, 0.95);
    }

    /* 1. Fix: Policy Hero Background */
    .policy-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255,255,255,0.1);
    }

    /* 2. Animated Pattern for Hero */
    .hero-bg-clean {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(255,255,255,0.1) 0%, transparent 50%);
        opacity: 0.6;
        z-index: 1;
    }

    /* 3. Search Bar Adjustment */
    .faq-search-wrapper {
        margin-top: -35px;
        z-index: 10;
        position: relative;
    }

    .faq-search-input {
        padding: 1rem 1.5rem 1rem 3.5rem;
        border-radius: 50px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    /* 4. Accordion Refinements */
    .accordion-item {
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        margin-bottom: 15px;
        background: white;
        transition: transform 0.2s ease;
    }

    .accordion-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .accordion-button {
        font-weight: 600;
        padding: 1.25rem;
    }

    .accordion-button:not(.collapsed) {
        background-color: #f8fafc;
        color: var(--primary-blue);
        box-shadow: none;
    }

    /* 5. Category Pills */
    .category-pill {
        padding: 0.6rem 1.4rem;
        border-radius: 50px;
        background: #f1f5f9;
        color: #64748b;
        cursor: pointer;
        font-weight: 500;
        transition: 0.3s;
    }

    .category-pill.active, .category-pill:hover {
        background: var(--primary-blue);
        color: white;
    }

    /* 6. Glass Effect Footer */
    .glass-effect {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 2px dashed var(--accent-blue);
        border-radius: 15px;
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
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "How do I access my purchased courses?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Once your payment is confirmed, courses are instantly added to your Dashboard. You will also receive an email with direct access links."
      }
    }
  ]
}
</script>


<div class="container py-5">
    <!-- Hero Section -->
    <header class="policy-hero position-relative rounded-4 shadow-lg mb-5 overflow-hidden text-center text-white">
        <div class="hero-bg-clean"></div>
        <div class="container py-5 position-relative" style="z-index: 2;">
            <span class="badge bg-white bg-opacity-20 text-dark px-3 py-2 rounded-pill mb-3">Help Center</span>
            <h1 class="h1-seo mb-3">How can we help you?</h1>
            <p class="policy-lead mx-auto">Find answers to common questions about our platform, courses, and
                certifications.</p>
        </div>
    </header>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Search Bar (UX Enhancement) -->
            <div class="faq-search-wrapper mb-5">
                <div class="position-relative">
                    <i
                        class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-4 text-primary fs-5"></i>
                    <input type="text" class="form-control faq-search-input"
                        placeholder="Search for answers (e.g. 'refunds', 'login')...">
                </div>
            </div>

            <!-- Categories -->
            <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
                <span class="category-pill active">All Questions</span>
                <span class="category-pill">Account</span>
                <span class="category-pill">Payments</span>
                <span class="category-pill">Courses</span>
                <span class="category-pill">Security</span>
            </div>

            <!-- FAQ Accordion -->
            <div class="accordion" id="faqAccordion">

                <!-- Question 1 -->
                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            <i class="bi bi-question-circle me-3 text-primary"></i>
                            How do I access my purchased courses?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Once your payment is confirmed, courses are instantly added to your
                            <strong>Dashboard</strong>. You will also receive an email with direct access links. If you
                            used OAuth2 (Google/GitHub) to sign up, ensure you are logged into that specific account.
                        </div>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq2">
                            <i class="bi bi-shield-check me-3 text-success"></i>
                            Is my payment information secure?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Absolutely. We use <strong>SSL encryption</strong> and industry-standard payment gateways
                            (Stripe/PayPal). We never store your credit card details on our servers in compliance with
                            <strong>PCI-DSS standards</strong>.
                        </div>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq3">
                            <i class="bi bi-award me-3 text-warning"></i>
                            Do I get a certificate after completion?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes! Upon maintaining a minimum score of 70% in all course quizzes, a <strong>verifiable
                                digital certificate</strong> is automatically generated in your profile. You can share
                            this directly to LinkedIn.
                        </div>
                    </div>
                </div>

            </div>

            <!-- Contact Support Callout -->
            <div class="glass-effect text-center mt-5 p-4 border-dashed border-primary">
                <p class="mb-0 text-muted">Still have questions? <a href="/contact" class="text-primary fw-bold">Chat
                        with our support team</a></p>
            </div>
        </div>
    </div>
</div>