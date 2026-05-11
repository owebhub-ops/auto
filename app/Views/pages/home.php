<style>
    /* Professional Styling Upgrades */
    .hero-gradient {
        background: radial-gradient(circle at top right, #f8faff 0%, #eef2ff 100%);
        position: relative;
        overflow: hidden;
    }

    .hero-gradient::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        height: 100px;
        background: #fff;
        border-radius: 50% 50% 0 0;
    }

    .feature-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #f1f5f9 !important;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05) !important;
    }

    .icon-box {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        margin: 0 auto 1.5rem;
    }

    .check-list i {
        font-size: 1.2rem;
        vertical-align: middle;
    }

    /* New Styles for Content Sections */
    .roadmap-line {
        border-left: 3px dashed #0d6efd;
        padding-left: 2rem;
        margin-left: 1rem;
    }

    .faq-question {
        cursor: pointer;
        transition: color 0.3s;
    }

    .faq-question:hover {
        color: #0d6efd;
    }

    .text-gradient {
        background: linear-gradient(90deg, #0d6efd, #6610f2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<!-- 🚀 Hero Section -->
<header class="hero-gradient py-5 mt-n4">
    <div class="container py-5">
        <div class="row justify-content-center text-center">
            <div class="col-xl-9 col-lg-10">
                <span
                    class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-bold mb-3 text-uppercase tracking-wider">
                    Explore Cars, Compare Features
                </span>
                <h1 class="display-3 fw-extrabold text-dark mb-4 lh-sm">
                    Discover <span class="text-primary text-gradient">Car Details & Reviews</span> at AutoOWH
                </h1>
                <p class="lead text-secondary mb-5 fs-4 px-lg-5">
                    AutoOWH is your trusted hub for car specifications, performance insights, and expert reviews.
                    Compare models, explore features, and find the perfect car for your lifestyle.
                </p>
                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <a href="<?= base_url('cars') ?>"
                        class="btn btn-primary btn-lg px-5 py-3 fs-5 rounded-pill shadow-lg">
                        <i class="bi bi-car-front me-2"></i>Browse Cars
                    </a>
                    <a href="<?= base_url('compare') ?>"
                        class="btn btn-outline-dark btn-lg px-5 py-3 fs-5 rounded-pill">
                        Compare Models
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- 🧠 SEO Content Section: Expert Insights -->
<section id="about" class="container py-5 my-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <h2 class="display-5 fw-bold text-dark mb-4">Your Guide to <span class="text-primary">Car Features &
                    Performance</span></h2>
            <p class="text-secondary fs-5">At <strong>AutoOWH</strong>, we simplify car research. Explore detailed
                specifications, safety ratings, mileage insights, and expert comparisons to make smarter buying
                decisions.</p>

            <div class="mt-4">
                <h4 class="h5 fw-bold"><i class="bi bi-speedometer2 text-primary me-2"></i>Performance Insights</h4>
                <p class="text-muted">Understand horsepower, torque, and fuel efficiency with easy-to-read breakdowns.
                </p>
            </div>

            <div class="mt-4">
                <h4 class="h5 fw-bold"><i class="bi bi-shield-check text-primary me-2"></i>Safety & Reliability</h4>
                <p class="text-muted">Compare crash-test ratings, safety features, and reliability scores across brands.
                </p>
            </div>

            <div class="mt-4 row g-3 check-list">
                <div class="col-sm-6"><i class="bi bi-check-circle-fill text-success me-2"></i>Detailed Specifications
                </div>
                <div class="col-sm-6"><i class="bi bi-check-circle-fill text-success me-2"></i>Expert Reviews</div>
                <div class="col-sm-6"><i class="bi bi-check-circle-fill text-success me-2"></i>Car Comparisons</div>
                <div class="col-sm-6"><i class="bi bi-check-circle-fill text-success me-2"></i>Latest Car News</div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="bg-light p-5 rounded-5 border shadow-sm">
                <h3 class="fw-bold mb-4">2026 Car Buying Roadmap</h3>
                <div class="roadmap-line">
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary">01. Explore Car Models</h5>
                        <p class="small text-muted mb-0">Browse sedans, SUVs, hatchbacks, and electric cars with full
                            specifications.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary">02. Compare Features</h5>
                        <p class="small text-muted mb-0">Side-by-side comparisons of mileage, safety, and performance.
                        </p>
                    </div>
                    <div>
                        <h5 class="fw-bold text-primary">03. Read Expert Reviews</h5>
                        <p class="small text-muted mb-0">Get unbiased insights from automotive experts before making a
                            decision.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- 🚗 Car Categories Grid -->
<section id="categories" class="bg-light py-5 border-top border-bottom">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-dark">Explore Car Categories</h2>
            <p class="text-secondary fs-5">Discover specifications, features, and reviews across all car types.</p>
        </div>

        <div class="row g-4">
            <!-- 🚙 SUVs -->
            <article class="col-md-4">
                <div class="card h-100 feature-card p-4 rounded-4 shadow-sm border-0 text-center">
                    <div class="icon-box bg-primary-subtle text-primary">
                        <i class="bi bi-truck-front fs-1"></i>
                    </div>
                    <h3 class="h4 fw-bold">SUVs & Crossovers</h3>
                    <p class="text-muted small">
                        Explore spacious <strong>SUVs</strong> with advanced safety, off-road capability, and
                        family-friendly features. Compare mileage, engine power, and reliability ratings.
                    </p>
                    <a href="<?= base_url('cars/suv') ?>"
                        class="btn btn-outline-primary w-100 rounded-pill mt-auto">Browse SUVs</a>
                </div>
            </article>

            <!-- 🚗 Sedans -->
            <article class="col-md-4">
                <div class="card h-100 feature-card p-4 rounded-4 shadow-sm border-0 text-center">
                    <div class="icon-box bg-info-subtle text-info">
                        <i class="bi bi-car-front fs-1"></i>
                    </div>
                    <h3 class="h4 fw-bold">Sedans</h3>
                    <p class="text-muted small">
                        Find stylish <strong>Sedans</strong> with premium interiors, smooth handling, and fuel
                        efficiency. Perfect for city driving and long-distance comfort.
                    </p>
                    <a href="<?= base_url('cars/sedan') ?>" class="btn btn-outline-info w-100 rounded-pill mt-auto">View
                        Sedans</a>
                </div>
            </article>

            <!-- ⚡ Electric Cars -->
            <article class="col-md-4">
                <div class="card h-100 feature-card p-4 rounded-4 shadow-sm border-0 text-center">
                    <div class="icon-box bg-warning-subtle text-warning">
                        <i class="bi bi-lightning-charge-fill fs-1"></i>
                    </div>
                    <h3 class="h4 fw-bold">Electric Vehicles</h3>
                    <p class="text-muted small">
                        Discover the latest <strong>EVs</strong> with battery range, charging speed, and eco-friendly
                        performance. Compare Tesla, Tata, Hyundai, and more.
                    </p>
                    <a href="<?= base_url('cars/electric') ?>"
                        class="btn btn-outline-warning w-100 rounded-pill mt-auto">Explore EVs</a>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- ❓ FAQ Section (High Value for Google Bot) -->
<!-- ❓ Car Buying & Features FAQ -->
<section class="container py-5 my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="text-center mb-5">
                <h2 class="fw-bold display-6">Car Buying & Features <span class="text-primary">FAQ</span></h2>
                <p class="text-muted">Answers to the most common questions about cars, mileage, safety, and comparisons.
                </p>
            </div>

            <div class="accordion" id="carFAQ">
                <!-- Mileage Focus -->
                <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqMileage">
                            Which cars have the best mileage in 2026?
                        </button>
                    </h2>
                    <div id="faqMileage" class="accordion-collapse collapse show" data-bs-parent="#carFAQ">
                        <div class="accordion-body text-muted">
                            Mileage leaders include compact sedans and hybrid cars. Popular models like <strong>Toyota
                                Prius</strong>, <strong>Honda City Hybrid</strong>, and <strong>Maruti Suzuki
                                Dzire</strong> deliver excellent fuel efficiency, often exceeding 25 km/l in real-world
                            conditions.
                        </div>
                    </div>
                </div>

                <!-- Safety Focus -->
                <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqSafety">
                            What are the safest SUVs available?
                        </button>
                    </h2>
                    <div id="faqSafety" class="accordion-collapse collapse" data-bs-parent="#carFAQ">
                        <div class="accordion-body text-muted">
                            SUVs like the <strong>Volvo XC60</strong>, <strong>Tata Harrier</strong>, and
                            <strong>Hyundai Tucson</strong> score high in crash tests. Look for features such as
                            <strong>6+ airbags</strong>, <strong>ABS with EBD</strong>, and <strong>ADAS (Advanced
                                Driver Assistance Systems)</strong>.
                        </div>
                    </div>
                </div>

                <!-- Electric Vehicle Focus -->
                <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqEV">
                            Are electric cars worth buying in India?
                        </button>
                    </h2>
                    <div id="faqEV" class="accordion-collapse collapse" data-bs-parent="#carFAQ">
                        <div class="accordion-body text-muted">
                            Yes — EVs like <strong>Tata Nexon EV</strong>, <strong>MG ZS EV</strong>, and
                            <strong>Hyundai Kona</strong> offer low running costs and government incentives. With
                            charging infrastructure expanding, EVs are becoming practical for daily use.
                        </div>
                    </div>
                </div>

                <!-- Comparison Focus -->
                <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCompare">
                            How do I compare cars effectively?
                        </button>
                    </h2>
                    <div id="faqCompare" class="accordion-collapse collapse" data-bs-parent="#carFAQ">
                        <div class="accordion-body text-muted">
                            Use our <strong>Car Comparison Tool</strong> to check specifications side by side. Compare
                            <strong>engine power</strong>, <strong>mileage</strong>, <strong>safety ratings</strong>,
                            and <strong>price</strong> to find the best fit for your needs.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
    /* Premium Success Stories Styling */
    .success-quote {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 20px;
        padding: 2.5rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
    }

    .success-quote:hover {
        background: rgba(255, 255, 255, 0.07);
        border-color: rgba(13, 110, 253, 0.5) !important;
        transform: translateY(-5px);
    }

    .avatar-placeholder {
        width: 50px;
        height: 50px;
        background: linear-gradient(45deg, #0d6efd, #0dcaf0);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: white;
        margin-bottom: 1rem;
    }

    .brand-opacity {
        opacity: 0.5;
        filter: grayscale(1);
        transition: all 0.3s ease;
    }

    .brand-opacity:hover {
        opacity: 1;
        filter: grayscale(0);
    }
</style>
<section class="bg-dark py-5">
    <div class="container py-5">
        <!-- Section Header -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="display-5 fw-bold text-white mb-3">Community Success Stories</h2>
                <p class="text-white-50 fs-5">Hear from car owners who found their perfect ride through AutoOWH.</p>
            </div>
        </div>

        <!-- Testimonial Grid -->
        <div class="row g-4 mb-5">
            <!-- Testimonial 1: Family SUV -->
            <div class="col-lg-4 col-md-6">
                <article class="success-quote h-100">
                    <div class="avatar-placeholder">RK</div>
                    <div class="text-warning mb-3 small">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-white-50 mb-4">"AutoOWH helped me compare SUVs side by side. I chose the <strong>Tata
                            Harrier</strong> for its safety features and spacious design — perfect for my family."</p>
                    <hr class="border-secondary opacity-25">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="fw-bold text-white">Ravi Kumar</div>
                            <small class="text-primary fw-bold text-uppercase" style="font-size: 0.7rem;">Family Car
                                Buyer</small>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Testimonial 2: Electric Vehicle -->
            <div class="col-lg-4 col-md-6">
                <article class="success-quote h-100">
                    <div class="avatar-placeholder bg-success">AS</div>
                    <div class="text-warning mb-3 small">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-white-50 mb-4">"I was unsure about EVs until AutoOWH showed me detailed range and
                        charging info. I bought the <strong>Tata Nexon EV</strong> and my running costs dropped
                        drastically."</p>
                    <hr class="border-secondary opacity-25">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="fw-bold text-white">Anita Sharma</div>
                            <small class="text-info fw-bold text-uppercase" style="font-size: 0.7rem;">EV
                                Enthusiast</small>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Testimonial 3: Sedan Buyer -->
            <div class="col-lg-4 col-md-6">
                <article class="success-quote h-100">
                    <div class="avatar-placeholder bg-danger">VK</div>
                    <div class="text-warning mb-3 small">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <p class="text-white-50 mb-4">"The comparison tool made it easy to choose between sedans. I went
                        with the <strong>Honda City</strong> for its mileage and premium feel."</p>
                    <hr class="border-secondary opacity-25">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="fw-bold text-white">Vikram Patel</div>
                            <small class="text-warning fw-bold text-uppercase" style="font-size: 0.7rem;">Sedan
                                Owner</small>
                        </div>
                    </div>
                </article>
            </div>
        </div>

        <!-- Trust Signals / Partner Logos -->
        <div class="row align-items-center text-center mt-5 pt-4">
            <div class="col-12 mb-4">
                <p class="text-white-50 small text-uppercase tracking-widest fw-bold">Trusted by car buyers across India
                </p>
            </div>
            <div class="col-6 col-md-3 col-lg-2 offset-lg-1 mb-4">
                <i class="bi bi-car-front text-white fs-3 brand-opacity"></i>
            </div>
            <div class="col-6 col-md-3 col-lg-2 mb-4">
                <i class="bi bi-lightning-charge text-white fs-3 brand-opacity"></i>
            </div>
            <div class="col-6 col-md-3 col-lg-2 mb-4">
                <i class="bi bi-shield-check text-white fs-3 brand-opacity"></i>
            </div>
            <div class="col-6 col-md-3 col-lg-2 mb-4">
                <i class="bi bi-speedometer2 text-white fs-3 brand-opacity"></i>
            </div>
            <div class="col-6 col-md-3 col-lg-2 mb-4">
                <i class="bi bi-fuel-pump text-white fs-3 brand-opacity"></i>
            </div>
        </div>
    </div>
</section>