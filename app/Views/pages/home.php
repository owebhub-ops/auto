<style>
        /* ===== GLOBAL THEME - MATCHING PREMIUM GLASS NAVBAR ===== */
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #ffffff;
            scroll-behavior: smooth;
            padding-top: 78px;
        }

        /* Glassmorphism core — matching navbar glass style */
        .hero-gradient {
            background: linear-gradient(135deg, rgba(10, 30, 65, 0.04) 0%, rgba(27, 48, 92, 0.06) 100%);
            position: relative;
            border-bottom: 1px solid rgba(59, 130, 246, 0.15);
            backdrop-filter: blur(2px);
        }

        .text-gradient {
            background: linear-gradient(120deg, #2563eb, #6d28d9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Cards with subtle glass/neomorphic feel */
        .feature-card {
            background: rgba(255, 255, 255, 0.96) !important;
            backdrop-filter: blur(0px);
            transition: all 0.35s cubic-bezier(0.2, 0, 0, 1);
            border: 1px solid rgba(59, 130, 246, 0.08) !important;
            box-shadow: 0 8px 20px -6px rgba(0, 0, 0, 0.02);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 40px -20px rgba(0, 0, 0, 0.12) !important;
            border-color: rgba(37, 99, 235, 0.25) !important;
            background: #ffffff !important;
        }

        .icon-box {
            width: 78px;
            height: 78px;
            border-radius: 28px;
            transition: 0.2s;
        }

        .btn-arrow {
            transition: transform 0.2s ease;
        }

        .btn-outline-primary:hover .btn-arrow,
        .btn-primary:hover .btn-arrow {
            transform: translateX(4px);
        }

        /* roadmap card style */
        .roadmap-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(2px);
            border-radius: 2rem;
            transition: all 0.25s;
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .accordion-button:focus {
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.2);
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(90deg, #f0f4ff, #ffffff);
            color: #1e40af;
        }

        /* testimonial cards glass style */
        .testimonial-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(6px);
            transition: 0.25s;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .testimonial-card:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-6px);
            border-color: rgba(59, 130, 246, 0.4);
        }

        .trust-icon {
            opacity: 0.6;
            transition: all 0.25s;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        .trust-icon:hover {
            opacity: 1;
            filter: drop-shadow(0 6px 12px rgba(37, 99, 235, 0.3));
            transform: scale(1.03);
        }

        .tracking-wide {
            letter-spacing: 0.5px;
        }

        .bg-soft-primary {
            background: linear-gradient(105deg, #eef2ff 0%, #e0e7ff 100%);
            backdrop-filter: blur(2px);
        }

        .rounded-4xl {
            border-radius: 2rem;
        }

        /* Dark section theme with glass effect */
        .bg-dark-glass {
            background: linear-gradient(145deg, #0a1428 0%, #0c1a2f 100%);
            border-top: 1px solid rgba(59, 130, 246, 0.2);
            border-bottom: 1px solid rgba(59, 130, 246, 0.2);
        }

        /* custom CTA card */
        .cta-glass {
            background: linear-gradient(125deg, #ffffff 0%, #f8faff 100%);
            border: 1px solid rgba(37, 99, 235, 0.2);
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.08);
        }

        /* buttons unified with navbar vibe */
        .btn-primary {
            background: linear-gradient(95deg, #1e3a8a, #2563eb);
            border: none;
            transition: all 0.25s;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(95deg, #1e40af, #3b82f6);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
        }

        .btn-outline-secondary {
            border: 1px solid rgba(0, 0, 0, 0.15);
            color: #1f2937;
        }
        .btn-outline-secondary:hover {
            background: #f3f4f6;
            border-color: #2563eb;
            transform: translateY(-2px);
        }

        @media (max-width: 992px) {
            body {
                padding-top: 68px;
            }
            .display-3 {
                font-size: 2.3rem;
            }
            .display-5 {
                font-size: 1.9rem;
            }
        }

        /* FAQ accordion match */
        .accordion-item {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(37, 99, 235, 0.08);
        }
         /* ===== GLOSSY DYNAMIC HERO SECTION ===== */
    .hero-glossy {
        background: linear-gradient(135deg, #f0f4ff 0%, #faf5ff 50%, #eef2ff 100%);
        position: relative;
        min-height: 85vh;
        display: flex;
        align-items: center;
    }
    
    /* Animated glossy orbs */
    .glossy-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.5;
        animation: floatOrb 20s infinite ease-in-out;
        z-index: 0;
    }
    
    .glossy-orb-1 {
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.3), rgba(139, 92, 246, 0.15));
        top: -150px;
        right: -100px;
        animation-delay: 0s;
    }
    
    .glossy-orb-2 {
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(168, 85, 247, 0.25), rgba(59, 130, 246, 0.1));
        bottom: -100px;
        left: -80px;
        animation-delay: -5s;
    }
    
    .glossy-orb-3 {
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(6, 182, 212, 0.2), rgba(59, 130, 246, 0.1));
        top: 40%;
        left: 30%;
        animation-delay: -10s;
        filter: blur(100px);
    }
    
    @keyframes floatOrb {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -30px) scale(1.05); }
        66% { transform: translate(-20px, 20px) scale(0.95); }
    }
    
    /* Glass badge */
    .badge-glow {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(59, 130, 246, 0.3);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        color: #1e40af;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .badge-glow:hover {
        background: rgba(255, 255, 255, 0.85);
        border-color: rgba(59, 130, 246, 0.6);
        transform: translateY(-2px);
    }
    
    .pulse-dot {
        width: 8px;
        height: 8px;
        background: #3b82f6;
        border-radius: 50%;
        display: inline-block;
        animation: pulse 1.5s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(1.3); }
    }
    
    /* Gradient text glossy */
    .text-gradient-glossy {
        background: linear-gradient(120deg, #1e3a8a, #3b82f6, #6d28d9);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmer 4s ease infinite;
    }
    
    @keyframes shimmer {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Typing animation wrapper */
    .typing-wrapper {
        display: inline-block;
        min-width: 200px;
    }
    
    #typingText {
        display: inline-block;
        color: #2563eb;
    }
    
    .typing-cursor {
        display: inline-block;
        width: 3px;
        margin-left: 2px;
        animation: blink 0.8s infinite;
        color: #2563eb;
        font-weight: 300;
    }
    
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }
    
    /* Glossy buttons */
    .btn-glossy-primary {
        background: linear-gradient(105deg, #1e3a8a, #2563eb, #3b82f6);
        background-size: 200% auto;
        border: none;
        color: white;
        transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        box-shadow: 0 8px 25px -8px rgba(37, 99, 235, 0.4);
        position: relative;
        overflow: hidden;
    }
    
    .btn-glossy-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-glossy-primary:hover::before {
        left: 100%;
    }
    
    .btn-glossy-primary:hover {
        background-position: 100% 0;
        transform: translateY(-3px);
        box-shadow: 0 15px 35px -10px rgba(37, 99, 235, 0.5);
    }
    
    .btn-glossy-outline {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(37, 99, 235, 0.3);
        color: #1e3a8a;
        transition: all 0.3s ease;
    }
    
    .btn-glossy-outline:hover {
        background: rgba(37, 99, 235, 0.1);
        border-color: #2563eb;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    
    .shadow-glow {
        box-shadow: 0 8px 30px rgba(37, 99, 235, 0.3);
    }
    
    /* Stats counter styling */
    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        background: linear-gradient(135deg, #1e293b, #2563eb);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
    }
    
    .stat-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #475569;
        margin-top: 4px;
    }
    
    .stat-item {
        padding: 8px 16px;
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(8px);
        border-radius: 60px;
        border: 1px solid rgba(59, 130, 246, 0.15);
        transition: all 0.3s;
    }
    
    .stat-item:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: translateY(-4px);
        border-color: rgba(59, 130, 246, 0.4);
    }
    
    /* Scroll indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        color: #64748b;
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 2px;
        cursor: pointer;
        animation: bounce 2s infinite;
        z-index: 2;
    }
    
    .scroll-indicator i {
        font-size: 18px;
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(8px); }
    }
    
    /* Animation utilities */
    .animate-fade-up {
        animation: fadeUp 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
        opacity: 0;
    }
    
    .animation-delay-1 { animation-delay: 0.2s; }
    .animation-delay-2 { animation-delay: 0.4s; }
    .animation-delay-3 { animation-delay: 0.6s; }
    
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Mobile responsive adjustments */
    @media (max-width: 768px) {
        .hero-glossy {
            min-height: 90vh;
            padding: 2rem 0;
        }
        
        .display-3 {
            font-size: 1.9rem !important;
        }
        
        .lead {
            font-size: 1rem !important;
        }
        
        .typing-wrapper {
            min-width: 140px;
        }
        
        .stat-number {
            font-size: 1.4rem;
        }
        
        .stat-label {
            font-size: 0.7rem;
        }
        
        .stat-item {
            padding: 6px 12px;
        }
        
        .btn-glossy-primary, .btn-glossy-outline {
            padding: 10px 20px !important;
            font-size: 0.9rem !important;
        }
        
        .glossy-orb-1 {
            width: 250px;
            height: 250px;
            top: -80px;
            right: -60px;
        }
        
        .glossy-orb-2 {
            width: 200px;
            height: 200px;
            bottom: -50px;
        }
    }
    
    @media (max-width: 576px) {
        .stats-container {
            gap: 12px !important;
        }
        
        .stat-item {
            flex: 0 0 auto;
            min-width: 85px;
        }
        
        .badge-glow {
            font-size: 0.75rem;
            padding: 6px 14px !important;
        }
    }
    
    .text-dark-85 {
        color: rgba(0, 0, 0, 0.85);
    }
    
    .z-2 {
        z-index: 2;
    }
    </style>
</head>
<body>

<header class="hero-glossy py-4 py-md-5 position-relative overflow-hidden">
    <!-- Animated background glossy orbs -->
    <div class="glossy-orb glossy-orb-1"></div>
    <div class="glossy-orb glossy-orb-2"></div>
    <div class="glossy-orb glossy-orb-3"></div>
    
    <div class="container position-relative z-2 py-xl-4 py-3">
        <div class="row justify-content-center text-center g-4">
            <div class="col-xl-9 col-lg-10">
                <!-- Animated badge -->
                <div class="d-inline-block mb-3 animate-fade-up">
                    <span class="badge-glow px-4 py-2 rounded-pill fw-semibold tracking-wide">
                        <i class="bi bi-star-fill me-1 small"></i> 
                        <span id="yearBadge">2026</span>&nbsp; Car Guide
                        <span class="ms-2 pulse-dot"></span>
                    </span>
                </div>
                
                <!-- Main headline with dynamic typing effect -->
                <h1 class="display-3 fw-bold mb-4 lh-sm animate-fade-up">
                    Discover <span class="text-gradient-glossy">Car Details & Reviews</span> 
                    <br class="d-none d-sm-block">
                    at AutoOWH
                </h1>
                
                <!-- Dynamic typing subheading -->
                <div class="mb-4 animate-fade-up">
                    <p class="lead fs-4 mb-0 text-dark-85">
                        Your trusted hub for 
                        <span class="typing-wrapper">
                            <span id="typingText" class="fw-bold text-primary"></span>
                            <span class="typing-cursor">|</span>
                        </span>
                    </p>
                </div>
                
                <p class="text-secondary mb-5 fs-5 px-md-5 animate-fade-up animation-delay-1">
                    AutoOWH delivers expert reviews, detailed specifications, safety ratings, and real-world mileage data. 
                    Compare thousands of models and drive home with confidence.
                </p>
                
                <!-- CTA Buttons with glossy hover -->
                <div class="d-flex flex-wrap justify-content-center gap-3 animate-fade-up animation-delay-2">
                    <a href="<?= base_url('cars') ?>" class="btn btn-glossy-primary btn-lg px-4 px-md-5 py-3 rounded-pill shadow-glow fs-5 fw-semibold">
                        <i class="bi bi-car-front me-2"></i>Browse Cars 
                        <i class="bi bi-arrow-right-short btn-arrow"></i>
                    </a>
                    <a href="<?= base_url('cars/compareHome') ?>" class="btn btn-glossy-outline btn-lg px-4 px-md-5 py-3 rounded-pill fs-5 fw-semibold">
                        <i class="bi bi-layout-split me-2"></i>Compare Models
                    </a>
                </div>
                
                <!-- Dynamic Stats Counter Section -->
                <div class="stats-container mt-5 pt-3 d-flex flex-wrap justify-content-center gap-4 gap-md-5 animate-fade-up animation-delay-3">
                    <div class="stat-item text-center">
                        <div class="stat-number" data-target="500">0</div>
                        <div class="stat-label"><i class="bi bi-car-front-fill me-1 text-primary"></i> Cars Listed</div>
                    </div>
                    <div class="stat-item text-center">
                        <div class="stat-number" data-target="150">0</div>
                        <div class="stat-label"><i class="bi bi-star-fill me-1 text-warning"></i> Expert Reviews</div>
                    </div>
                    <div class="stat-item text-center">
                        <div class="stat-number" data-target="25">0</div>
                        <div class="stat-label"><i class="bi bi-fuel-pump me-1 text-success"></i> Avg. Mileage (km/l)</div>
                    </div>
                    <div class="stat-item text-center">
                        <div class="stat-number" data-target="10000" data-suffix="+">0</div>
                        <div class="stat-label"><i class="bi bi-people-fill me-1 text-info"></i> Happy Users</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="scroll-indicator d-none d-md-flex">
        <span>Scroll</span>
        <i class="bi bi-chevron-down"></i>
    </div>
</header>

<!-- 🧠 SEO Content + Buying Roadmap (EEAT signals) with Glass card -->
<section class="container py-5 my-lg-4">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3" style="background: rgba(37, 99, 235, 0.1);">Why AutoOWH</span>
            <h2 class="display-5 fw-bold text-dark mb-4">Your Guide to <span class="text-primary">Car Features & Performance</span></h2>
            <p class="text-secondary fs-5 mb-4">At <strong class="text-dark">AutoOWH</strong>, we simplify car research. Explore detailed specifications, safety ratings, mileage insights, and expert comparisons to make smarter buying decisions — all in one place.</p>
            <div class="row g-4 mt-2">
                <div class="col-sm-6">
                    <div class="d-flex gap-3 align-items-start">
                        <i class="bi bi-speedometer2 fs-3 text-primary"></i>
                        <div><h4 class="h6 fw-bold mb-1">Performance Insights</h4><p class="text-muted small">Horsepower, torque & fuel efficiency made simple.</p></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex gap-3 align-items-start">
                        <i class="bi bi-shield-check fs-3 text-primary"></i>
                        <div><h4 class="h6 fw-bold mb-1">Safety & Reliability</h4><p class="text-muted small">NCAP ratings, ADAS, airbags & reliability scores.</p></div>
                    </div>
                </div>
            </div>
            <div class="mt-4 d-flex flex-wrap gap-3">
                <span class="bg-light px-3 py-2 rounded-pill small fw-semibold"><i class="bi bi-file-text me-1"></i> Detailed Specs</span>
                <span class="bg-light px-3 py-2 rounded-pill small fw-semibold"><i class="bi bi-chat-quote me-1"></i> Expert Reviews</span>
                <span class="bg-light px-3 py-2 rounded-pill small fw-semibold"><i class="bi bi-graph-up me-1"></i> Compare Models</span>
                <span class="bg-light px-3 py-2 rounded-pill small fw-semibold"><i class="bi bi-newspaper me-1"></i> Car News</span>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="roadmap-card p-4 p-md-5 shadow-sm border rounded-4">
                <h3 class="fw-bold mb-4 d-flex align-items-center gap-2"><i class="bi bi-map text-primary fs-3"></i> 2026 Car Buying Roadmap</h3>
                <div class="position-relative ps-3">
                    <div class="mb-4 pb-1 border-start border-primary border-3 ps-4">
                        <h5 class="fw-bold text-primary">01. Explore Car Models</h5>
                        <p class="text-muted mb-0 small">Browse sedans, SUVs, hatchbacks, and electric cars with full specs & real-world reviews.</p>
                    </div>
                    <div class="mb-4 pb-1 border-start border-primary border-3 ps-4">
                        <h5 class="fw-bold text-primary">02. Compare Features</h5>
                        <p class="text-muted mb-0 small">Side-by-side comparisons of mileage, safety, engine & tech features.</p>
                    </div>
                    <div class="border-start border-primary border-3 ps-4">
                        <h5 class="fw-bold text-primary">03. Read Expert Reviews</h5>
                        <p class="text-muted mb-0 small">Unbiased insights from automotive experts before making your final decision.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 🚗 Car Categories Grid (Glass edge cards) -->
<section id="categories" class="bg-light py-5" style="background: #f9fafc !important;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Explore Car Categories</h2>
            <p class="text-secondary fs-5">Discover specifications, features, and reviews across all car types.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 feature-card p-4 rounded-4 shadow-sm border-0 text-center">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary mx-auto d-flex align-items-center justify-content-center">
                        <i class="bi bi-truck-front fs-1"></i>
                    </div>
                    <h3 class="h4 fw-bold mt-3">SUVs & Crossovers</h3>
                    <p class="text-muted small">Explore spacious SUVs with advanced safety, off-road capability, and family-friendly features. Compare mileage, engine power, and reliability ratings.</p>
                    <a href="#" class="btn btn-outline-primary rounded-pill w-100 mt-2 fw-semibold">Browse SUVs <i class="bi bi-arrow-right-short btn-arrow"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 feature-card p-4 rounded-4 shadow-sm border-0 text-center">
                    <div class="icon-box bg-info bg-opacity-10 text-info mx-auto d-flex align-items-center justify-content-center">
                        <i class="bi bi-car-front fs-1"></i>
                    </div>
                    <h3 class="h4 fw-bold mt-3">Sedans</h3>
                    <p class="text-muted small">Find stylish Sedans with premium interiors, smooth handling, and fuel efficiency. Perfect for city driving and long-distance comfort.</p>
                    <a href="#" class="btn btn-outline-info rounded-pill w-100 mt-2 fw-semibold">View Sedans <i class="bi bi-arrow-right-short btn-arrow"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 feature-card p-4 rounded-4 shadow-sm border-0 text-center">
                    <div class="icon-box bg-warning bg-opacity-10 text-warning mx-auto d-flex align-items-center justify-content-center">
                        <i class="bi bi-lightning-charge-fill fs-1"></i>
                    </div>
                    <h3 class="h4 fw-bold mt-3">Electric Vehicles</h3>
                    <p class="text-muted small">Discover the latest EVs with battery range, charging speed, and eco-friendly performance. Compare Tesla, Tata, Hyundai, and more.</p>
                    <a href="#" class="btn btn-outline-warning rounded-pill w-100 mt-2 fw-semibold">Explore EVs <i class="bi bi-arrow-right-short btn-arrow"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ❄️ FAQ Section (Glass friendly) -->
<section class="container py-5 my-3">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5">
                <h2 class="fw-bold display-6">Car Buying & Features <span class="text-primary">FAQ</span></h2>
                <p class="text-muted">Get answers to most searched car queries: mileage, safety, EV worth & comparisons.</p>
            </div>
            <div class="accordion" id="carFaqAccordion">
                <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                    <h3 class="accordion-header">
                        <button class="accordion-button fw-semibold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Which cars have the best mileage in 2026?
                        </button>
                    </h3>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#carFaqAccordion">
                        <div class="accordion-body text-secondary">Mileage leaders include compact sedans and hybrid cars. Popular models like <strong>Toyota Prius</strong>, <strong>Honda City Hybrid</strong>, and <strong>Maruti Suzuki Dzire</strong> deliver excellent fuel efficiency, often exceeding 25 km/l in real-world conditions.</div>
                    </div>
                </div>
                <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            What are the safest SUVs available?
                        </button>
                    </h3>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#carFaqAccordion">
                        <div class="accordion-body text-secondary">SUVs like the <strong>Volvo XC60</strong>, <strong>Tata Harrier</strong>, and <strong>Hyundai Tucson</strong> score high in crash tests. Look for features such as <strong>6+ airbags</strong>, <strong>ABS with EBD</strong>, and <strong>ADAS</strong>.</div>
                    </div>
                </div>
                <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Are electric cars worth buying in India?
                        </button>
                    </h3>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#carFaqAccordion">
                        <div class="accordion-body text-secondary">Yes — EVs like <strong>Tata Nexon EV</strong>, <strong>MG ZS EV</strong> offer low running costs and government incentives. With charging infrastructure expanding rapidly, EVs are becoming practical for daily use.</div>
                    </div>
                </div>
                <div class="accordion-item border-0 shadow-sm rounded-4 overflow-hidden">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            How do I compare cars effectively?
                        </button>
                    </h3>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#carFaqAccordion">
                        <div class="accordion-body text-secondary">Use our <strong>Car Comparison Tool</strong> to check specs side by side: engine power, mileage, safety ratings, and price to find the best fit.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 💬 Community Success Stories (Matching navbar glass dark) -->
<section class="bg-dark-glass py-5 mt-4">
    <div class="container py-4">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="display-5 fw-bold text-white mb-3">Community Success Stories</h2>
                <p class="text-white-50 fs-5">Hear from car owners who found their perfect ride through AutoOWH.</p>
            </div>
        </div>
        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card h-100 p-4 rounded-4">
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;"><span class="fw-bold text-white fs-5">RK</span></div>
                        <div><div class="text-warning"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div></div>
                    </div>
                    <p class="text-white-50">"AutoOWH helped me compare SUVs side by side. I chose the <strong>Tata Harrier</strong> for its safety features and spacious design — perfect for my family."</p>
                    <hr class="opacity-25">
                    <div class="fw-bold text-white">Ravi Kumar</div>
                    <small class="text-primary fw-semibold">Family Car Buyer</small>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card h-100 p-4 rounded-4">
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;"><span class="fw-bold text-white fs-5">AS</span></div>
                        <div><div class="text-warning"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div></div>
                    </div>
                    <p class="text-white-50">"I was unsure about EVs until AutoOWH showed me detailed range and charging info. I bought the <strong>Tata Nexon EV</strong> and my running costs dropped drastically."</p>
                    <hr class="opacity-25">
                    <div class="fw-bold text-white">Anita Sharma</div>
                    <small class="text-info fw-semibold">EV Enthusiast</small>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card h-100 p-4 rounded-4">
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;"><span class="fw-bold text-white fs-5">VP</span></div>
                        <div><div class="text-warning"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div></div>
                    </div>
                    <p class="text-white-50">"The comparison tool made it easy to choose between sedans. I went with the <strong>Honda City</strong> for its mileage and premium feel."</p>
                    <hr class="opacity-25">
                    <div class="fw-bold text-white">Vikram Patel</div>
                    <small class="text-warning fw-semibold">Sedan Owner</small>
                </div>
            </div>
        </div>
        <div class="row align-items-center text-center mt-3 pt-2">
            <div class="col-12 mb-3"><p class="text-white-50 small text-uppercase fw-semibold tracking-wide">Trusted by car buyers across India</p></div>
            <div class="col-6 col-md-3 col-lg-2 offset-lg-1 mb-3"><i class="bi bi-car-front text-white-50 fs-1 trust-icon"></i></div>
            <div class="col-6 col-md-3 col-lg-2 mb-3"><i class="bi bi-lightning-charge text-white-50 fs-1 trust-icon"></i></div>
            <div class="col-6 col-md-3 col-lg-2 mb-3"><i class="bi bi-shield-check text-white-50 fs-1 trust-icon"></i></div>
            <div class="col-6 col-md-3 col-lg-2 mb-3"><i class="bi bi-speedometer2 text-white-50 fs-1 trust-icon"></i></div>
            <div class="col-6 col-md-3 col-lg-2 mb-3"><i class="bi bi-fuel-pump text-white-50 fs-1 trust-icon"></i></div>
        </div>
    </div>
</section>

<!-- ✨ Elegant CTA Footer area (Glass unified) -->
<section class="container py-5 text-center">
    <div class="cta-glass p-5 rounded-4">
        <h3 class="fw-bold display-6 mb-3">Ready to find your dream car?</h3>
        <p class="lead text-secondary mb-4">Join thousands of car enthusiasts who use AutoOWH to compare, review, and decide.</p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="#" class="btn btn-primary rounded-pill px-5 py-3 fw-semibold"><i class="bi bi-search me-2"></i>Start Exploring</a>
            <a href="#" class="btn btn-outline-primary rounded-pill px-5 py-3 fw-semibold"><i class="bi bi-envelope me-2"></i>Get Newsletter</a>
        </div>
    </div>
</section>

<!-- Bootstrap JS & Schema (same as before, enhanced) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type": "Question","name": "Which cars have the best mileage in 2026?","acceptedAnswer": {"@type": "Answer","text": "Mileage leaders include compact sedans and hybrid cars like Toyota Prius, Honda City Hybrid, and Maruti Suzuki Dzire, delivering over 25 km/l."}},
    {"@type": "Question","name": "What are the safest SUVs available?","acceptedAnswer": {"@type": "Answer","text": "SUVs like Volvo XC60, Tata Harrier, and Hyundai Tucson score high in crash tests with ADAS and 6+ airbags."}},
    {"@type": "Question","name": "Are electric cars worth buying in India?","acceptedAnswer": {"@type": "Answer","text": "Yes, EVs like Tata Nexon EV, MG ZS EV offer low running costs and government incentives."}},
    {"@type": "Question","name": "How do I compare cars effectively?","acceptedAnswer": {"@type": "Answer","text": "Use AutoOWH's car comparison tool to compare engine power, mileage, safety ratings and price side-by-side."}}
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AutomotiveBusiness",
  "name": "AutoOWH",
  "url": "https://www.autoowh.com",
  "description": "Comprehensive car comparison platform with expert reviews, car specifications, safety ratings and mileage insights."
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // === Dynamic Typing Effect ===
        const words = ['Car Specifications', 'Expert Reviews', 'Safety Ratings', 'Mileage Data', 'Car Comparisons'];
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        const typingElement = document.getElementById('typingText');
        const cursorElement = document.querySelector('.typing-cursor');
        
        function typeEffect() {
            const currentWord = words[wordIndex];
            
            if (isDeleting) {
                typingElement.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;
            } else {
                typingElement.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;
            }
            
            if (!isDeleting && charIndex === currentWord.length) {
                isDeleting = true;
                setTimeout(typeEffect, 2000);
                return;
            }
            
            if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % words.length;
                setTimeout(typeEffect, 500);
                return;
            }
            
            const speed = isDeleting ? 50 : 100;
            setTimeout(typeEffect, speed);
        }
        
        typeEffect();
        
        // === Dynamic Year Update ===
        const yearSpan = document.getElementById('yearBadge');
        if (yearSpan) {
            yearSpan.textContent = new Date().getFullYear();
        }
        
        // === Counter Animation (Intersection Observer) ===
        const statNumbers = document.querySelectorAll('.stat-number');
        
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const target = parseInt(element.getAttribute('data-target'));
                    const suffix = element.getAttribute('data-suffix') || '';
                    let current = 0;
                    const increment = target / 50;
                    const updateCounter = () => {
                        current += increment;
                        if (current < target) {
                            element.textContent = Math.floor(current) + suffix;
                            requestAnimationFrame(updateCounter);
                        } else {
                            element.textContent = target + suffix;
                        }
                    };
                    updateCounter();
                    counterObserver.unobserve(element);
                }
            });
        }, { threshold: 0.3 });
        
        statNumbers.forEach(num => counterObserver.observe(num));
        
        // === Smooth scroll for scroll indicator ===
        const scrollIndicator = document.querySelector('.scroll-indicator');
        if (scrollIndicator) {
            scrollIndicator.addEventListener('click', () => {
                window.scrollTo({
                    top: window.innerHeight,
                    behavior: 'smooth'
                });
            });
        }
    });
</script>