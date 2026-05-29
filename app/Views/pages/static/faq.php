
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
      "name": "How do I view my owned vehicles?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Once you add a car to your garage, it will appear instantly in your Dashboard. You can also access detailed specs and pricing from the 'My Garage' section."
      }
    },
    {
      "@type": "Question",
      "name": "Is my payment information secure when buying a car?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. We use SSL encryption and trusted payment gateways. Your card details are never stored on our servers, ensuring PCI-DSS compliance."
      }
    },
    {
      "@type": "Question",
      "name": "Do I get warranty details with my purchase?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Absolutely. Each vehicle profile includes manufacturer warranty information and coverage terms. You can download the brochure for full details."
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
      <h1 class="h1-seo mb-3">Automotive FAQs</h1>
      <p class="policy-lead mx-auto">Find answers to common questions about vehicles, pricing, and ownership.</p>
    </div>
  </header>

  <div class="row justify-content-center">
    <div class="col-lg-8">
      <!-- Search Bar -->
      <div class="faq-search-wrapper mb-5">
        <div class="position-relative">
          <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-4 text-primary fs-5"></i>
          <input type="text" class="form-control faq-search-input"
                 placeholder="Search for answers (e.g. 'warranty', 'financing')...">
        </div>
      </div>

      <!-- Category Tabs -->
      <ul class="nav nav-pills justify-content-center mb-5" id="faqTabs" role="tablist">
        <li class="nav-item"><button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button">All Questions</button></li>
        <li class="nav-item"><button class="nav-link" id="ownership-tab" data-bs-toggle="tab" data-bs-target="#ownership" type="button">Ownership</button></li>
        <li class="nav-item"><button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" type="button">Payments</button></li>
        <li class="nav-item"><button class="nav-link" id="warranty-tab" data-bs-toggle="tab" data-bs-target="#warranty" type="button">Warranty</button></li>
        <li class="nav-item"><button class="nav-link" id="safety-tab" data-bs-toggle="tab" data-bs-target="#safety" type="button">Safety</button></li>
      </ul>

      <!-- Tab Content -->
      <div class="tab-content" id="faqTabContent">

        <!-- All Questions -->
        <div class="tab-pane fade show active" id="all" role="tabpanel">
          <div class="accordion" id="faqAccordionAll">
            <div class="accordion-item shadow-sm">
              <h2 class="accordion-header" id="headingAll1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAll1" aria-expanded="true" aria-controls="collapseAll1">
                  <i class="bi bi-car-front-fill me-3 text-primary"></i> How do I view my owned vehicles?
                </button>
              </h2>
              <div id="collapseAll1" class="accordion-collapse collapse show" aria-labelledby="headingAll1" data-bs-parent="#faqAccordionAll">
                <div class="accordion-body">Once you add a car to your <strong>Garage</strong>, it appears instantly in your Dashboard.</div>
              </div>
            </div>
            <div class="accordion-item shadow-sm">
              <h2 class="accordion-header" id="headingAll2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAll2" aria-controls="collapseAll2">
                  <i class="bi bi-shield-check me-3 text-success"></i> Is my payment information secure?
                </button>
              </h2>
              <div id="collapseAll2" class="accordion-collapse collapse" aria-labelledby="headingAll2" data-bs-parent="#faqAccordionAll">
                <div class="accordion-body">We use SSL encryption and trusted gateways. Your card details are never stored.</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Ownership -->
        <div class="tab-pane fade" id="ownership" role="tabpanel">
          <div class="accordion" id="faqAccordionOwnership">
            <div class="accordion-item shadow-sm">
              <h2 class="accordion-header" id="headingOwn1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOwn1" aria-controls="collapseOwn1">
                  <i class="bi bi-garage me-3 text-primary"></i> How do I add a car to my garage?
                </button>
              </h2>
              <div id="collapseOwn1" class="accordion-collapse collapse show" aria-labelledby="headingOwn1" data-bs-parent="#faqAccordionOwnership">
                <div class="accordion-body">Go to the car detail page and click “Add to Garage”.</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Payments -->
        <div class="tab-pane fade" id="payments" role="tabpanel">
          <div class="accordion" id="faqAccordionPayments">
            <div class="accordion-item shadow-sm">
              <h2 class="accordion-header" id="headingPay1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePay1" aria-controls="collapsePay1">
                  <i class="bi bi-credit-card me-3 text-success"></i> What payment methods are accepted?
                </button>
              </h2>
              <div id="collapsePay1" class="accordion-collapse collapse show" aria-labelledby="headingPay1" data-bs-parent="#faqAccordionPayments">
                <div class="accordion-body">We accept credit/debit cards, UPI, and trusted gateways like Stripe and PayPal.</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Warranty -->
        <div class="tab-pane fade" id="warranty" role="tabpanel">
          <div class="accordion" id="faqAccordionWarranty">
            <div class="accordion-item shadow-sm">
              <h2 class="accordion-header" id="headingWar1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWar1" aria-controls="collapseWar1">
                  <i class="bi bi-award me-3 text-warning"></i> Do vehicles come with warranty?
                </button>
              </h2>
              <div id="collapseWar1" class="accordion-collapse collapse show" aria-labelledby="headingWar1" data-bs-parent="#faqAccordionWarranty">
                <div class="accordion-body">Yes, each vehicle profile includes manufacturer warranty details and coverage terms.</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Safety -->
        <div class="tab-pane fade" id="safety" role="tabpanel">
          <div class="accordion" id="faqAccordionSafety">
            <div class="accordion-item shadow-sm">
              <h2 class="accordion-header" id="headingSafe1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSafe1" aria-controls="collapseSafe1">
                  <i class="bi bi-shield-lock me-3 text-danger"></i> How safe are the vehicles?
                </button>
              </h2>
              <div id="collapseSafe1" class="accordion-collapse collapse show" aria-labelledby="headingSafe1" data-bs-parent="#faqAccordionSafety">
                <div class="accordion-body">Safety ratings (NCAP) and features like airbags, ABS, and sensors are listed in each car profile.</div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Contact Support Callout -->
      <div class="glass-effect text-center mt-5 p-4 border-dashed border-primary">
        <p class="mb-0 text-muted">Still have questions? <a href="<?= base_url() ?>/contact" class="text-primary fw-bold">Chat with our support team</a></p>
      </div>
    </div>
  </div>
</div>