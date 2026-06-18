<?php
$carTitle = trim($vehicle['make'] . ' ' . $vehicle['model'] . ' ' . ($vehicle['variant'] ?? ''));
$carDescription = $carTitle . ' price, mileage, specifications, features, images, colours, EMI and on-road price in India.';
$carUrl = current_url();

$pricingData = $pricing ?? [];
$dimensions = $vehicle['dimensions'] ?? [];
$suspension = $vehicle['suspension'] ?? [];
$brakes = $vehicle['brakes'] ?? [];
$safety = $vehicle['safety_features'] ?? [];
$comfort = $vehicle['comfort_features'] ?? [];
$interior = $vehicle['interior_features'] ?? [];
$exterior = $vehicle['exterior_features'] ?? [];
$colors = $vehicle['color_options'] ?? [];
$camera = $vehicle['camera_features'] ?? [];
$warranty = $vehicle['warranty'] ?? [];
$infotainment = $vehicle['infotainment'] ?? [];

// Car content from new table
$carContent = $car_content ?? [];
$prosList = $carContent['pros'] ?? [];
$consList = $carContent['cons'] ?? [];
$competitorsList = $carContent['competitors'] ?? [];
$overviewText = $carContent['overview'] ?? '';

$schema = [
    "@context" => "https://schema.org",
    "@type" => "Car",
    "name" => $carTitle,
    "brand" => ["@type" => "Brand", "name" => $vehicle['make'] ?? ''],
    "model" => $vehicle['model'] ?? '',
    "vehicleModelDate" => $vehicle['year'] ?? date('Y'),
    "bodyType" => $vehicle['body_type'] ?? '',
    "fuelType" => $vehicle['fuel_type'] ?? '',
    "vehicleTransmission" => $vehicle['transmission'] ?? '',
    "image" => $vehicle['image_url'] ?? '',
    "description" => strip_tags(substr($overviewText, 0, 200)) ?: $carDescription,
    "offers" => [
        "@type" => "Offer",
        "priceCurrency" => $pricingData['currency'] ?? 'INR',
        "price" => (float) ($pricingData['ex_showroom_price'] ?? 0),
        "availability" => "https://schema.org/InStock",
        "url" => $carUrl
    ]
];
?>


<?php /* <title><?= esc($carTitle) ?> - Price, Specs, Mileage & Features</title>
<meta name="description" content="<?= esc(strip_tags(substr($overviewText, 0, 160)) ?: $carDescription) ?>"> */ ?>
<meta name="keywords" content="<?= esc(implode(', ', array_filter([
    $vehicle['make'] ?? '',
    $vehicle['model'] ?? '',
    $vehicle['variant'] ?? '',
    'price',
    'specs',
    'mileage',
    'features',
    'review',
    $vehicle['fuel_type'] ?? ''
]))) ?>">
<meta property="og:title" content="<?= esc($carTitle) ?>">
<meta property="og:description" content="<?= esc(strip_tags(substr($overviewText, 0, 160)) ?: $carDescription) ?>">
<meta property="og:image" content="<?= esc($vehicle['image_url'] ?? '') ?>">
<meta property="og:url" content="<?= esc($carUrl) ?>">
<meta property="og:type" content="website">
<link rel="canonical" href="<?= esc($carUrl) ?>">
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?></script>


<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1e40af;
        --primary-glow: rgba(37, 99, 235, 0.2);
        --dark: #0f172a;
        --gray: #64748b;
        --light-bg: #f8fafc;
        --card-shadow: 0 25px 40px -16px rgba(0, 0, 0, 0.12);
        --card-hover-shadow: 0 35px 50px -20px rgba(0, 0, 0, 0.2);
        --transition: all 0.3s cubic-bezier(0.2, 0.95, 0.4, 1.05);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #f5f7fb 0%, #eef2f8 100%);
        font-family: 'Inter', sans-serif;
    }

    .car-detail-page {
        max-width: 1600px;
        margin: 0 auto;
    }

    /* Premium Breadcrumb */
    .breadcrumb-wrap {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        padding: 1rem 0;
       
    }

    .breadcrumb {
        background: transparent;
    }

    .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }

    .breadcrumb-item a:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: var(--dark);
        font-weight: 700;
    }

    /* Hero Section */
    .car-hero {
        padding: 3rem 0 4rem;
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    }

    .hero-image-card {
        border-radius: 2rem;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        background: #fff;
    }

    .hero-image-card:hover {
        transform: scale(1.01);
        box-shadow: var(--card-hover-shadow);
    }

    .main-image {
        width: 100%;
        height: 460px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .hero-image-card:hover .main-image {
        transform: scale(1.02);
    }

    .no-image {
        height: 460px;
        background: linear-gradient(145deg, #e2e8f0, #cbd5e1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        color: var(--gray);
    }

    .gallery-thumbs {
        display: flex;
        gap: 0.85rem;
        flex-wrap: wrap;
        margin-top: 1.25rem;
    }

    .thumb {
        width: 88px;
        height: 72px;
        object-fit: cover;
        border-radius: 1rem;
        cursor: pointer;
        border: 2px solid transparent;
        transition: var(--transition);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.06);
    }

    .thumb:hover,
    .active-thumb {
        border-color: var(--primary);
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -8px var(--primary-glow);
    }

    /* Premium Sidebar */
    .car-sidebar {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(16px);
        border-radius: 1.75rem;
        padding: 1.75rem;
        box-shadow: var(--card-shadow);
        position: sticky;
        top: 5rem;
        border: 1px solid rgba(255, 255, 255, 0.6);
    }

    .car-title {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--dark), #2d3a5e);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
    }

    .quick-specs {
        display: flex;
        flex-wrap: wrap;
        gap: 0.7rem;
        margin-bottom: 1.5rem;
    }

    .spec-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 0.5rem 1rem;
        border-radius: 60px;
        font-size: 0.8rem;
        font-weight: 700;
        background: var(--light-bg);
        color: var(--dark);
        border: 1px solid #e2e8f0;
        transition: var(--transition);
    }

    .spec-badge:hover {
        transform: translateY(-2px);
        border-color: var(--primary);
    }

    .price-box {
        background: linear-gradient(115deg, #fef9e3, #fef3c7);
        padding: 1.5rem;
        border-radius: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #fde68a;
    }

    .price-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #b45309;
        font-weight: 800;
    }

    .main-price {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--dark);
        letter-spacing: -0.02em;
    }

    .onroad-price {
        font-weight: 600;
        color: #475569;
        margin-top: 0.5rem;
    }

    .emi-box {
        background: rgba(255, 255, 235, 0.9);
        padding: 0.7rem 1rem;
        border-radius: 1rem;
        margin-top: 1rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .sidebar-actions .btn {
        border-radius: 60px;
        padding: 0.85rem;
        font-weight: 700;
        transition: var(--transition);
    }

    .sidebar-actions .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 25px -10px rgba(0, 0, 0, 0.2);
    }

    .small-spec-list {
        margin-top: 1.5rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.8rem;
    }

    .small-spec-list div {
        background: var(--light-bg);
        padding: 0.8rem;
        border-radius: 1rem;
        display: flex;
        justify-content: space-between;
        font-weight: 700;
        border: 1px solid #eef2ff;
        transition: var(--transition);
    }

    .small-spec-list div:hover {
        border-color: var(--primary);
        background: white;
    }

    /* Section Styles */
    .section-space {
        padding: 5rem 0;
    }

    .section-header {
        margin-bottom: 3rem;
        text-align: center;
    }

    .section-header h2 {
        font-size: 2.2rem;
        font-weight: 800;
        background: linear-gradient(125deg, var(--dark), var(--primary));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    .bg-white {
        background: #ffffff;
    }

    .bg-light {
        background: var(--light-bg);
    }

    /* Pros & Cons Cards */
    .pros-card {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border-radius: 1.5rem;
        padding: 1.5rem;
        height: 100%;
        border: 1px solid #bbf7d0;
    }

    .cons-card {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        border-radius: 1.5rem;
        padding: 1.5rem;
        height: 100%;
        border: 1px solid #fecaca;
    }

    .pros-card h3,
    .cons-card h3 {
        font-weight: 800;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pros-card ul,
    .cons-card ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pros-card li,
    .cons-card li {
        padding: 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border-bottom: 1px dashed rgba(0, 0, 0, 0.05);
    }

    .pros-card li:last-child,
    .cons-card li:last-child {
        border-bottom: none;
    }

    .pros-card li i {
        color: #16a34a;
        font-size: 1.1rem;
    }

    .cons-card li i {
        color: #dc2626;
        font-size: 1.1rem;
    }

    /* Premium Spec Cards */
    .spec-card {
        background: white;
        border-radius: 1.25rem;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
        transition: var(--transition);
        border: 1px solid #f0f2f8;
    }

    .spec-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow);
        border-color: #e0e7ff;
    }

    .spec-icon {
        width: 52px;
        height: 52px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .spec-content {
        display: flex;
        flex-direction: column;
    }

    .spec-label {
        font-size: 0.75rem;
        color: var(--gray);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .spec-value {
        font-weight: 800;
        font-size: 1.1rem;
        color: var(--dark);
    }

    /* Feature Cards */
    .feature-card {
        background: white;
        border-radius: 1.5rem;
        padding: 1.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
        transition: var(--transition);
        height: 100%;
        border: 1px solid #f0f2f8;
    }

    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--card-shadow);
        border-color: #e0e7ff;
    }

    .feature-head {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #eef2ff;
    }

    .feature-icon {
        width: 52px;
        height: 52px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .feature-head h3 {
        font-size: 1.2rem;
        font-weight: 800;
        margin: 0;
        color: var(--dark);
    }

    .kv-list {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }

    .kv-item {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        padding: 0.6rem 0;
        border-bottom: 1px dashed #e9eef3;
    }

    .kv-item dt {
        font-weight: 700;
        color: var(--dark);
        margin: 0;
        font-size: 0.9rem;
    }

    .kv-item dd {
        margin: 0;
        color: var(--gray);
        font-weight: 600;
        text-align: right;
    }

    .empty-text {
        padding: 1rem;
        background: var(--light-bg);
        border-radius: 1rem;
        color: var(--gray);
        text-align: center;
        font-size: 0.9rem;
    }

    /* Price Table */
    .price-table {
        background: white;
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: var(--card-shadow);
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        padding: 1.2rem 2rem;
        border-bottom: 1px solid #edf2f7;
        font-weight: 500;
        transition: background 0.2s;
    }

    .price-row:hover {
        background: #fafcff;
    }

    .price-row.total {
        background: linear-gradient(115deg, var(--dark), #1e293b);
        color: white;
        font-weight: 800;
        font-size: 1.2rem;
        border: none;
    }

    /* Competitors Section */
    .competitor-badge {
        background: #f1f5f9;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--dark);
        transition: var(--transition);
        display: inline-block;
    }

    .competitor-badge:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    @media (max-width: 992px) {
        .car-sidebar {
            position: static;
            margin-top: 2rem;
        }

        .main-image,
        .no-image {
            height: 340px;
        }

        .car-title {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 576px) {
        .main-price {
            font-size: 1.6rem;
        }

        .kv-item {
            flex-direction: column;
            gap: 0.3rem;
        }

        .kv-item dd {
            text-align: left;
        }

        .spec-card {
            padding: 1rem;
        }

        .section-space {
            padding: 3rem 0;
        }
    }

    .btn-warning {
        background: linear-gradient(95deg, #fbbf24, #f59e0b);
        border: none;
        font-weight: 700;
    }

    .btn-dark {
        background: var(--dark);
        border: none;
    }

    .btn-dark:hover {
        background: #2d3a5e;
    }

    .btn {
        transition: var(--transition);
    }
</style>
</head>

<body>
    <div class="car-detail-page">
        <!-- Premium Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb-wrap">
            <div class="container">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?= site_url('cars') ?>"><i
                                class="bi bi-grid-3x3-gap-fill me-1"></i>All Cars</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= esc($carTitle) ?></li>
                </ol>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="car-hero">
            <div class="container">
                <div class="row g-5 align-items-start">
                    <div class="col-lg-7">
                        <div class="hero-image-card">
                            <?php if (!empty($vehicle['image_url'])): ?>
                                <img src="<?= esc($vehicle['image_url']) ?>" alt="<?= esc($carTitle) ?>" class="main-image"
                                    id="mainCarImage" loading="eager">
                            <?php else: ?>
                                <div class="no-image"><i class="bi bi-car-front-fill"></i></div>
                            <?php endif; ?>
                        </div>
                        <div class="gallery-thumbs">
                            <?php
                            $thumbs = [];
                            if (!empty($vehicle['image_url']))
                                $thumbs[] = $vehicle['image_url'];
                            if (is_array($colors)) {
                                foreach ($colors as $color) {
                                    if (!empty($color['image']))
                                        $thumbs[] = $color['image'];
                                }
                            }
                            $thumbs = array_values(array_unique($thumbs));
                            foreach (array_slice($thumbs, 0, 6) as $index => $thumb): ?>
                                <img src="<?= esc($thumb) ?>" alt="<?= esc($carTitle) ?>"
                                    class="thumb <?= $index === 0 ? 'active-thumb' : '' ?>" loading="lazy">
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="car-sidebar">
                            <h1 class="car-title"><?= esc($carTitle) ?></h1>
                            <div class="quick-specs">
                                <?php if (!empty($vehicle['fuel_type'])): ?><span class="spec-badge"><i
                                            class="bi bi-fuel-pump"></i>
                                        <?= esc($vehicle['fuel_type']) ?></span><?php endif; ?>
                                <?php if (!empty($vehicle['transmission'])): ?><span class="spec-badge"><i
                                            class="bi bi-gear"></i>
                                        <?= esc($vehicle['transmission']) ?></span><?php endif; ?>
                                <?php if (!empty($vehicle['mileage_kmpl'])): ?><span class="spec-badge"><i
                                            class="bi bi-speedometer2"></i> <?= esc($vehicle['mileage_kmpl']) ?>
                                        kmpl</span><?php endif; ?>
                                <?php if (!empty($vehicle['ncap_rating'])): ?><span class="spec-badge"><i
                                            class="bi bi-shield-check"></i> <?= esc($vehicle['ncap_rating']) ?> ⭐
                                        NCAP</span><?php endif; ?>
                            </div>
                            <div class="price-box">
                                <div class="price-label">Ex-Showroom Price</div>
                                <div class="main-price">
                                    ₹<?= number_format((float) ($pricingData['ex_showroom_price'] ?? 0)) ?></div>
                                <?php if (!empty($pricingData['on_road_price'])): ?>
                                    <div class="onroad-price"><i class="bi bi-geo-alt-fill"></i> On Road:
                                        ₹<?= number_format((float) $pricingData['on_road_price']) ?></div><?php endif; ?>
                                <?php if (!empty($pricingData['emi_amount']) && ($pricingData['emi_available'] ?? false)): ?>
                                    <div class="emi-box"><i class="bi bi-credit-card"></i> EMI
                                        <strong>₹<?= number_format((float) $pricingData['emi_amount']) ?>/month</strong>
                                    </div><?php endif; ?>
                            </div>
                            <div class="sidebar-actions d-flex flex-column gap-2">
                                <a href="#price-section" class="btn btn-warning btn-lg w-100"><i
                                        class="bi bi-cash-stack"></i> Check On-Road Price</a>
                                <a href="#features" class="btn btn-dark btn-lg w-100"><i class="bi bi-list-check"></i>
                                    Explore Features</a>
                            </div>
                            <div class="small-spec-list">
                                <div><span><i class="bi bi-cpu"></i>
                                        Engine</span><strong><?= esc($vehicle['engine_cc'] ?? 'N/A') ?> cc</strong>
                                </div>
                                <div><span><i class="bi bi-lightning-charge"></i>
                                        Power</span><strong><?= esc($vehicle['power_bhp'] ?? 'N/A') ?> bhp</strong>
                                </div>
                                <div><span><i class="bi bi-arrow-repeat"></i>
                                        Torque</span><strong><?= esc($vehicle['torque_nm'] ?? 'N/A') ?> Nm</strong>
                                </div>
                                <div><span><i class="bi bi-people"></i>
                                        Seating</span><strong><?= esc($vehicle['seating_capacity'] ?? 'N/A') ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Overview Section with Pros & Cons -->
        <section class="section-space bg-white">
            <div class="container">
                <div class="section-header">
                    <h2><?= esc($vehicle['make'] . ' ' . $vehicle['model']) ?> Overview</h2>
                    <p class="text-muted mt-2">Expert review, key highlights, and everything you need to know</p>
                </div>
                <div class="row g-4">
                    <!-- Overview Text -->
                    <div class="col-12">
                        <div class="feature-card">
                            <div class="feature-head">
                                <div class="feature-icon bg-primary-subtle text-primary"><i
                                        class="bi bi-info-circle-fill"></i></div>
                                <h3>Complete Review</h3>
                            </div>
                            <div class="overview-text">
                                <?= !empty($overviewText) ? $overviewText : '<p>The ' . esc($carTitle) . ' is a popular choice in the Indian market, offering a great balance of performance, features, and value for money.</p>' ?>
                            </div>
                        </div>
                    </div>
                    <!-- Pros Column -->
                    <div class="col-md-6">
                        <div class="pros-card">
                            <h3><i class="bi bi-check-circle-fill"></i> What We Like</h3>
                            <ul>
                                <?php if (!empty($prosList) && is_array($prosList)): ?>
                                    <?php foreach ($prosList as $pro): ?>
                                        <li><i class="bi bi-check-lg"></i> <?= esc($pro) ?></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li><i class="bi bi-check-lg"></i> Excellent fuel efficiency</li>
                                    <li><i class="bi bi-check-lg"></i> Spacious and comfortable cabin</li>
                                    <li><i class="bi bi-check-lg"></i> Smooth and refined engine</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <!-- Cons Column -->
                    <div class="col-md-6">
                        <div class="cons-card">
                            <h3><i class="bi bi-x-circle-fill"></i> What Could Be Better</h3>
                            <ul>
                                <?php if (!empty($consList) && is_array($consList)): ?>
                                    <?php foreach ($consList as $con): ?>
                                        <li><i class="bi bi-dash-lg"></i> <?= esc($con) ?></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li><i class="bi bi-dash-lg"></i> Premium pricing</li>
                                    <li><i class="bi bi-dash-lg"></i> Basic interior plastics in some areas</li>
                                    <li><i class="bi bi-dash-lg"></i> Limited features in base variants</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Specifications Grid -->
        <section class="section-space bg-light" id="specs">
            <div class="container">
                <div class="section-header">
                    <h2><?= esc($carTitle) ?> Specifications</h2>
                    <p class="text-muted mt-2">Complete technical specifications at a glance</p>
                </div>
                <div class="row g-4">
                    <div class="col-6 col-lg-4">
                        <div class="spec-card">
                            <div class="spec-icon bg-primary-subtle text-primary"><i class="bi bi-fuel-pump"></i></div>
                            <div class="spec-content"><span class="spec-label">Fuel Type</span><strong
                                    class="spec-value"><?= esc($vehicle['fuel_type'] ?? 'N/A') ?></strong></div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="spec-card">
                            <div class="spec-icon bg-warning-subtle text-warning"><i
                                    class="bi bi-gear-wide-connected"></i></div>
                            <div class="spec-content"><span class="spec-label">Transmission</span><strong
                                    class="spec-value"><?= esc($vehicle['transmission'] ?? 'N/A') ?></strong></div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="spec-card">
                            <div class="spec-icon bg-success-subtle text-success"><i class="bi bi-people"></i></div>
                            <div class="spec-content"><span class="spec-label">Seating Capacity</span><strong
                                    class="spec-value"><?= esc($vehicle['seating_capacity'] ?? 'N/A') ?></strong></div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="spec-card">
                            <div class="spec-icon bg-info-subtle text-info"><i class="bi bi-truck"></i></div>
                            <div class="spec-content"><span class="spec-label">Boot Space</span><strong
                                    class="spec-value"><?= esc($vehicle['boot_space_liters'] ?? 'N/A') ?> L</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="spec-card">
                            <div class="spec-icon bg-danger-subtle text-danger"><i class="bi bi-arrow-down-up"></i>
                            </div>
                            <div class="spec-content"><span class="spec-label">Ground Clearance</span><strong
                                    class="spec-value"><?= esc($vehicle['ground_clearance_mm'] ?? 'N/A') ?> mm</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="spec-card">
                            <div class="spec-icon bg-dark-subtle text-dark"><i class="bi bi-signpost-split"></i></div>
                            <div class="spec-content"><span class="spec-label">Drive Type</span><strong
                                    class="spec-value"><?= esc($vehicle['drive_type'] ?? 'N/A') ?></strong></div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="spec-card">
                            <div class="spec-icon bg-primary-subtle text-primary"><i class="bi bi-cpu-fill"></i></div>
                            <div class="spec-content"><span class="spec-label">Engine</span><strong
                                    class="spec-value"><?= esc($vehicle['engine_cc'] ?? 'N/A') ?> cc</strong></div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="spec-card">
                            <div class="spec-icon bg-success-subtle text-success"><i
                                    class="bi bi-lightning-charge-fill"></i></div>
                            <div class="spec-content"><span class="spec-label">Max Power</span><strong
                                    class="spec-value"><?= esc($vehicle['power_bhp'] ?? 'N/A') ?> bhp</strong></div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <div class="spec-card">
                            <div class="spec-icon bg-warning-subtle text-warning"><i class="bi bi-speedometer2"></i>
                            </div>
                            <div class="spec-content"><span class="spec-label">Torque</span><strong
                                    class="spec-value"><?= esc($vehicle['torque_nm'] ?? 'N/A') ?> Nm</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dimensions & Suspension Row -->
        <section class="section-space bg-white">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="feature-card">
                            <div class="feature-head">
                                <div class="feature-icon bg-info-subtle text-info"><i class="bi bi-aspect-ratio"></i>
                                </div>
                                <h3>Dimensions</h3>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="spec-card p-3">
                                        <div class="spec-content"><span class="spec-label">Length</span><strong
                                                class="spec-value"><?= esc($vehicle['dimensions_formatted']['length'] ?? 'N/A') ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="spec-card p-3">
                                        <div class="spec-content"><span class="spec-label">Width</span><strong
                                                class="spec-value"><?= esc($vehicle['dimensions_formatted']['width'] ?? 'N/A') ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="spec-card p-3">
                                        <div class="spec-content"><span class="spec-label">Height</span><strong
                                                class="spec-value"><?= esc($vehicle['dimensions_formatted']['height'] ?? 'N/A') ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="spec-card p-3">
                                        <div class="spec-content"><span class="spec-label">Wheelbase</span><strong
                                                class="spec-value"><?= esc($vehicle['dimensions_formatted']['wheelbase'] ?? 'N/A') ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <?php if (!empty($vehicle['weight_kg'])): ?>
                                    <div class="col-6">
                                        <div class="spec-card p-3">
                                            <div class="spec-content"><span class="spec-label">Kerb Weight</span><strong
                                                    class="spec-value"><?= esc($vehicle['weight_kg']) ?> kg</strong></div>
                                        </div>
                                    </div><?php endif; ?>
                                <?php if (!empty($vehicle['tyre_spec'])): ?>
                                    <div class="col-6">
                                        <div class="spec-card p-3">
                                            <div class="spec-content"><span class="spec-label">Tyres</span><strong
                                                    class="spec-value"><?= esc($vehicle['tyre_spec']) ?></strong></div>
                                        </div>
                                    </div><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-card">
                            <div class="feature-head">
                                <div class="feature-icon bg-secondary-subtle text-secondary"><i
                                        class="bi bi-diagram-2"></i></div>
                                <h3>Suspension & Brakes</h3>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="spec-card p-3">
                                        <div class="spec-content"><span class="spec-label">Front
                                                Suspension</span><strong
                                                class="spec-value"><?= esc($vehicle['suspension_formatted']['front'] ?? 'N/A') ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="spec-card p-3">
                                        <div class="spec-content"><span class="spec-label">Rear Suspension</span><strong
                                                class="spec-value"><?= esc($vehicle['suspension_formatted']['rear'] ?? 'N/A') ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="spec-card p-3">
                                        <div class="spec-content"><span class="spec-label">Front Brake</span><strong
                                                class="spec-value"><?= esc($vehicle['brakes_formatted']['front'] ?? 'N/A') ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="spec-card p-3">
                                        <div class="spec-content"><span class="spec-label">Rear Brake</span><strong
                                                class="spec-value"><?= esc($vehicle['brakes_formatted']['rear'] ?? 'N/A') ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Grid -->
        <section class="section-space bg-light" id="features">
            <div class="container">
                <div class="section-header">
                    <h2>Key Features</h2>
                    <p class="text-muted">Explore all the premium features this car has to offer</p>
                </div>
                <div class="row g-4">
                    <div class="col-12 col-lg-6">
                        <div class="feature-card">
                            <div class="feature-head">
                                <div class="feature-icon bg-danger-subtle text-danger"><i
                                        class="bi bi-shield-check"></i></div>
                                <h3>Safety Features</h3>
                            </div><?php if (!empty($safety) && is_array($safety)): ?>
                                <dl class="kv-list"><?php foreach ($safety as $label => $value): ?>
                                        <div class="kv-item">
                                            <dt><?= esc(ucwords(str_replace('_', ' ', $label))) ?></dt>
                                            <dd><?= esc(is_array($value) ? implode(', ', $value) : $value) ?></dd>
                                        </div><?php endforeach; ?>
                                </dl><?php else: ?>
                                <div class="empty-text">Comprehensive safety features including airbags, ABS, and more.
                                </div><?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="feature-card">
                            <div class="feature-head">
                                <div class="feature-icon bg-primary-subtle text-primary"><i class="bi bi-car-front"></i>
                                </div>
                                <h3>Comfort Features</h3>
                            </div><?php if (!empty($comfort) && is_array($comfort)): ?>
                                <dl class="kv-list"><?php foreach ($comfort as $key => $value): ?>
                                        <div class="kv-item">
                                            <dt><?= esc(ucwords(str_replace('_', ' ', $key))) ?></dt>
                                            <dd><?= esc(is_array($value) ? implode(', ', $value) : $value) ?></dd>
                                        </div><?php endforeach; ?>
                                </dl><?php else: ?>
                                <div class="empty-text">Premium comfort features for an enjoyable driving experience.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="feature-card">
                            <div class="feature-head">
                                <div class="feature-icon bg-success-subtle text-success"><i
                                        class="bi bi-speedometer2"></i></div>
                                <h3>Interior Features</h3>
                            </div><?php if (!empty($interior) && is_array($interior)): ?>
                                <dl class="kv-list"><?php foreach ($interior as $key => $value): ?>
                                        <div class="kv-item">
                                            <dt><?= esc(ucwords(str_replace('_', ' ', $key))) ?></dt>
                                            <dd><?= esc(is_array($value) ? implode(', ', $value) : $value) ?></dd>
                                        </div><?php endforeach; ?>
                                </dl><?php else: ?>
                                <div class="empty-text">Well-designed interior with quality materials and thoughtful layout.
                                </div><?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="feature-card">
                            <div class="feature-head">
                                <div class="feature-icon bg-warning-subtle text-warning"><i class="bi bi-palette"></i>
                                </div>
                                <h3>Exterior Features</h3>
                            </div><?php if (!empty($exterior) && is_array($exterior)): ?>
                                <dl class="kv-list"><?php foreach ($exterior as $key => $value): ?>
                                        <div class="kv-item">
                                            <dt><?= esc(ucwords(str_replace('_', ' ', $key))) ?></dt>
                                            <dd><?= esc(is_array($value) ? implode(', ', $value) : $value) ?></dd>
                                        </div><?php endforeach; ?>
                                </dl><?php else: ?>
                                <div class="empty-text">Modern exterior design with premium styling elements.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (!empty($infotainment) && is_array($infotainment)): ?>
                        <div class="col-12">
                            <div class="feature-card">
                                <div class="feature-head">
                                    <div class="feature-icon bg-info-subtle text-info"><i class="bi bi-display"></i></div>
                                    <h3>Infotainment & Connectivity</h3>
                                </div>
                                <dl class="kv-list"><?php foreach ($infotainment as $key => $value): ?>
                                        <div class="kv-item">
                                            <dt><?= esc(ucwords(str_replace('_', ' ', $key))) ?></dt>
                                            <dd><?= esc(is_array($value) ? implode(', ', $value) : $value) ?></dd>
                                        </div><?php endforeach; ?>
                                </dl>
                            </div>
                        </div><?php endif; ?>
                    <?php if (!empty($warranty)): ?>
                        <div class="col-12">
                            <div class="feature-card">
                                <div class="feature-head">
                                    <div class="feature-icon bg-dark-subtle text-dark"><i
                                            class="bi bi-shield-fill-check"></i></div>
                                    <h3>Warranty</h3>
                                </div>
                                <p><strong><?= esc(is_array($warranty) ? implode(', ', $warranty) : $warranty) ?></strong>
                                </p>
                            </div>
                        </div><?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Competitors Section -->
        <?php if (!empty($competitorsList) && is_array($competitorsList)): ?>
            <section class="section-space bg-white">
                <div class="container">
                    <div class="section-header">
                        <h2>Key Competitors</h2>
                        <p class="text-muted">Compare <?= esc($vehicle['model']) ?> with similar cars in the segment</p>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <?php foreach ($competitorsList as $competitor):
                            // Generate slug from competitor name for URL
                            $competitorSlug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $competitor), '-'));

                            // Try to find the competitor vehicle in the database
                            $competitorVehicle = null;
                            if (method_exists($this, 'vehicleModel')) {
                                $competitorVehicle = $this->vehicleModel->where('make', $competitor)
                                    ->orLike('model', $competitor)
                                    ->first();
                            }

                            // Use found slug or generated slug
                            $competitorUrl = site_url('cars/' . ($competitorVehicle['slug'] ?? $competitorSlug));
                            ?>
                            <div class="col-md-3 col-6 text-center">
                                <a href="<?= $competitorUrl ?>" class="competitor-badge p-3 text-decoration-none d-block">
                                    <i class="bi bi-car-front fs-1 d-block mb-2"></i>
                                    <strong><?= esc($competitor) ?></strong>
                                    <small class="text-muted d-block mt-1">View Details →</small>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Price Section -->
        <section class="section-space bg-light" id="price-section">
            <div class="container">
                <div class="section-header">
                    <h2><?= esc($carTitle) ?> Price in India</h2>
                    <p class="text-muted">Complete pricing breakdown including taxes and insurance</p>
                </div>
                <div class="price-table">
                    <div class="price-row"><span>🚗 Ex-Showroom
                            Price</span><strong>₹<?= number_format((float) ($pricingData['ex_showroom_price'] ?? 0)) ?></strong>
                    </div>
                    <?php if (!empty($pricingData['insurance_cost'])): ?>
                        <div class="price-row"><span>🛡️
                                Insurance</span><strong>₹<?= number_format((float) $pricingData['insurance_cost']) ?></strong>
                        </div><?php endif; ?>
                    <?php if (!empty($pricingData['road_tax'])): ?>
                        <div class="price-row"><span>📋 Road Tax
                                (RTO)</span><strong>₹<?= number_format((float) $pricingData['road_tax']) ?></strong></div>
                    <?php endif; ?>
                    <?php if (!empty($pricingData['discount_offers']) && is_array($pricingData['discount_offers'])): ?>
                        <div class="price-row"><span>🎁 Offers &
                                Discounts</span><strong><?= esc(implode(' + ', $pricingData['discount_offers'])) ?></strong>
                        </div><?php endif; ?>
                    <div class="price-row total"><span>🏁 On-Road Price
                            (India)</span><strong>₹<?= number_format((float) ($pricingData['on_road_price'] ?? 0)) ?></strong>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mainImage = document.getElementById('mainCarImage');
            if (mainImage) {
                document.querySelectorAll('.thumb').forEach(thumb => {
                    thumb.addEventListener('click', function () {
                        mainImage.src = this.src;
                        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active-thumb'));
                        this.classList.add('active-thumb');
                    });
                });
            }
        });
    </script>