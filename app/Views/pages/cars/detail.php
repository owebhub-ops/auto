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

$schema = [
    "@context" => "https://schema.org",
    "@type" => "Car",
    "name" => $carTitle,
    "brand" => [
        "@type" => "Brand",
        "name" => $vehicle['make'] ?? ''
    ],
    "model" => $vehicle['model'] ?? '',
    "vehicleModelDate" => $vehicle['year'] ?? date('Y'),
    "bodyType" => $vehicle['body_type'] ?? '',
    "fuelType" => $vehicle['fuel_type'] ?? '',
    "vehicleTransmission" => $vehicle['transmission'] ?? '',
    "image" => $vehicle['image_url'] ?? '',
    "description" => $carDescription,
    "offers" => [
        "@type" => "Offer",
        "priceCurrency" => $pricingData['currency'] ?? 'INR',
        "price" => (float) ($pricingData['ex_showroom_price'] ?? 0),
        "availability" => "https://schema.org/InStock",
        "url" => $carUrl
    ]
];
?>

<title><?= esc($carTitle) ?> Price, Specs, Mileage & Features</title>
<meta name="description" content="<?= esc($carDescription) ?>">
<meta name="keywords" content="<?= esc(implode(', ', array_filter([
    $vehicle['make'] ?? '',
    $vehicle['model'] ?? '',
    $vehicle['variant'] ?? '',
    'price',
    'specs',
    'mileage',
    'features',
    'review'
]))) ?>">

<meta property="og:title" content="<?= esc($carTitle) ?>">
<meta property="og:description" content="<?= esc($carDescription) ?>">
<meta property="og:image" content="<?= esc($vehicle['image_url'] ?? '') ?>">
<meta property="og:url" content="<?= esc($carUrl) ?>">
<meta property="og:type" content="website">
<link rel="canonical" href="<?= esc($carUrl) ?>">

<script type="application/ld+json">
<?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>

<div class="car-detail-page">
    <nav aria-label="breadcrumb" class="breadcrumb-wrap">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= site_url('cars') ?>">All Cars</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($carTitle) ?></li>
            </ol>
        </div>
    </nav>

    <section class="car-hero">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-7">
                    <div class="hero-image-card">
                        <?php if (!empty($vehicle['image_url'])): ?>
                            <img src="<?= esc($vehicle['image_url']) ?>" alt="<?= esc($carTitle) ?>"
                                class="main-image img-fluid" loading="eager" width="900" height="550">
                        <?php else: ?>
                            <div class="no-image">
                                <i class="bi bi-car-front-fill"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="gallery-thumbs mt-3">
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
                        foreach (array_slice($thumbs, 0, 6) as $index => $thumb):
                            ?>
                            <img src="<?= esc($thumb) ?>" alt="<?= esc($carTitle) ?>"
                                class="thumb <?= $index === 0 ? 'active-thumb' : '' ?>" loading="lazy" width="90"
                                height="70">
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="car-sidebar">
                        <h1 class="car-title"><?= esc($carTitle) ?></h1>

                        <div class="quick-specs">
                            <?php if (!empty($vehicle['fuel_type'])): ?>
                                <span class="spec-badge bg-primary-subtle text-primary">
                                    <i class="bi bi-fuel-pump"></i> <?= esc($vehicle['fuel_type']) ?>
                                </span>
                            <?php endif; ?>
                            <?php if (!empty($vehicle['transmission'])): ?>
                                <span class="spec-badge bg-warning-subtle text-warning">
                                    <i class="bi bi-gear"></i> <?= esc($vehicle['transmission']) ?>
                                </span>
                            <?php endif; ?>
                            <?php if (!empty($vehicle['mileage_kmpl'])): ?>
                                <span class="spec-badge bg-success-subtle text-success">
                                    <i class="bi bi-speedometer2"></i> <?= esc($vehicle['mileage_kmpl']) ?> kmpl
                                </span>
                            <?php endif; ?>
                            <?php if (!empty($vehicle['ncap_rating'])): ?>
                                <span class="spec-badge bg-info-subtle text-info">
                                    <i class="bi bi-shield-check"></i> <?= esc($vehicle['ncap_rating']) ?> NCAP
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="price-box">
                            <div class="price-label">Ex-Showroom Price</div>
                            <div class="main-price">
                                ₹<?= number_format((float) ($pricingData['ex_showroom_price'] ?? 0)) ?>
                            </div>

                            <?php if (!empty($pricingData['on_road_price'])): ?>
                                <div class="onroad-price">
                                    On Road Price: ₹<?= number_format((float) $pricingData['on_road_price']) ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($pricingData['emi_amount'])): ?>
                                <div class="emi-box">
                                    <i class="bi bi-credit-card"></i> EMI Starts At
                                    <strong>₹<?= number_format((float) $pricingData['emi_amount']) ?>/month</strong>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="sidebar-actions">
                            <a href="#price-section" class="btn btn-warning btn-lg w-100 mb-2">
                                <i class="bi bi-cash-stack"></i> Check Price
                            </a>
                            <a href="#features" class="btn btn-dark btn-lg w-100">
                                <i class="bi bi-list-check"></i> View Features
                            </a>
                        </div>

                        <div class="small-spec-list">
                            <div><span>Engine</span><strong><?= esc($vehicle['engine_cc'] ?? 'N/A') ?> cc</strong></div>
                            <div><span>Power</span><strong><?= esc($vehicle['power_bhp'] ?? 'N/A') ?> bhp</strong></div>
                            <div><span>Torque</span><strong><?= esc($vehicle['torque_nm'] ?? 'N/A') ?> Nm</strong></div>
                            <div><span>Seating</span><strong><?= esc($vehicle['seating_capacity'] ?? 'N/A') ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="section-space bg-white">
        <div class="container">
            <header class="section-header text-center text-md-start mb-4">
                <h2 class="mb-2"><?= esc($carTitle) ?> Overview</h2>
                <p class="text-muted mb-0">
                    Explore mileage, specifications, engine performance, dimensions, safety features and latest price.
                </p>
            </header>

            <div class="row g-4">
                <div class="col-6 col-lg-3">
                    <div class="spec-card h-100">
                        <div class="spec-icon bg-primary-subtle text-primary">
                            <i class="bi bi-cpu-fill"></i>
                        </div>
                        <div class="spec-content">
                            <span class="spec-label">Engine</span>
                            <strong class="spec-value"><?= esc($vehicle['engine_cc'] ?? 'N/A') ?> cc</strong>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="spec-card h-100">
                        <div class="spec-icon bg-success-subtle text-success">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <div class="spec-content">
                            <span class="spec-label">Power</span>
                            <strong class="spec-value"><?= esc($vehicle['power_bhp'] ?? 'N/A') ?> bhp</strong>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="spec-card h-100">
                        <div class="spec-icon bg-warning-subtle text-warning">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <div class="spec-content">
                            <span class="spec-label">Torque</span>
                            <strong class="spec-value"><?= esc($vehicle['torque_nm'] ?? 'N/A') ?> Nm</strong>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="spec-card h-100">
                        <div class="spec-icon bg-info-subtle text-info">
                            <i class="bi bi-fuel-pump"></i>
                        </div>
                        <div class="spec-content">
                            <span class="spec-label">Mileage</span>
                            <strong class="spec-value"><?= esc($vehicle['mileage_kmpl'] ?? 'N/A') ?> kmpl</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-space bg-light" id="specs">
        <div class="container">
            <header class="section-header text-center text-md-start mb-4">
                <h2 class="mb-2"><?= esc($carTitle) ?> Specifications</h2>
                <p class="text-muted mb-0">Key technical details at a glance.</p>
            </header>

            <div class="row g-4">
                <div class="col-6 col-lg-4">
                    <div class="spec-card h-100">
                        <div class="spec-icon bg-primary-subtle text-primary">
                            <i class="bi bi-fuel-pump"></i>
                        </div>
                        <div class="spec-content">
                            <span class="spec-label">Fuel Type</span>
                            <strong class="spec-value"><?= esc($vehicle['fuel_type'] ?? 'N/A') ?></strong>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-4">
                    <div class="spec-card h-100">
                        <div class="spec-icon bg-warning-subtle text-warning">
                            <i class="bi bi-gear-wide-connected"></i>
                        </div>
                        <div class="spec-content">
                            <span class="spec-label">Transmission</span>
                            <strong class="spec-value"><?= esc($vehicle['transmission'] ?? 'N/A') ?></strong>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-4">
                    <div class="spec-card h-100">
                        <div class="spec-icon bg-success-subtle text-success">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="spec-content">
                            <span class="spec-label">Seating Capacity</span>
                            <strong class="spec-value"><?= esc($vehicle['seating_capacity'] ?? 'N/A') ?></strong>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-4">
                    <div class="spec-card h-100">
                        <div class="spec-icon bg-info-subtle text-info">
                            <i class="bi bi-truck"></i>
                        </div>
                        <div class="spec-content">
                            <span class="spec-label">Boot Space</span>
                            <strong class="spec-value">
                                <?= esc($vehicle['boot_space_liters'] ?? 'N/A') ?> L
                            </strong>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-4">
                    <div class="spec-card h-100">
                        <div class="spec-icon bg-danger-subtle text-danger">
                            <i class="bi bi-arrow-down-up"></i>
                        </div>
                        <div class="spec-content">
                            <span class="spec-label">Ground Clearance</span>
                            <strong class="spec-value">
                                <?= esc($vehicle['ground_clearance_mm'] ?? 'N/A') ?> mm
                            </strong>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-4">
                    <div class="spec-card h-100">
                        <div class="spec-icon bg-dark-subtle text-dark">
                            <i class="bi bi-signpost-split"></i>
                        </div>
                        <div class="spec-content">
                            <span class="spec-label">Drive Type</span>
                            <strong class="spec-value"><?= esc($vehicle['drive_type'] ?? 'N/A') ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-space bg-white" id="features">
        <div class="container">
            <header class="section-header">
                <h2><?= esc($carTitle) ?> Features</h2>
            </header>

            <div class="row g-4">

                <div class="col-12 col-lg-6">
                    <div class="feature-box feature-card h-100">
                        <div class="feature-head">
                            <div class="feature-icon bg-danger-subtle text-danger">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div>
                                <h3 class="mb-1">Safety Features</h3>
                                <p class="text-muted mb-0">Protection and driver assistance highlights.</p>
                            </div>
                        </div>

                        <?php if (!empty($safety) && is_array($safety)): ?>
                            <dl class="kv-list">
                                <?php foreach ($safety as $label => $value): ?>
                                    <div class="kv-item">
                                        <dt><?= esc(ucwords(str_replace('_', ' ', $label))) ?></dt>
                                        <dd><?= esc(is_array($value) ? implode(', ', $value) : $value) ?></dd>
                                    </div>
                                <?php endforeach; ?>
                            </dl>
                        <?php else: ?>
                            <div class="empty-text">No safety details available.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="feature-box feature-card h-100">
                        <div class="feature-head">
                            <div class="feature-icon bg-primary-subtle text-primary">
                                <i class="bi bi-car-front"></i>
                            </div>
                            <div>
                                <h3 class="mb-1">Comfort Features</h3>
                                <p class="text-muted mb-0">Convenience and driving comfort details.</p>
                            </div>
                        </div>

                        <?php if (!empty($comfort) && is_array($comfort)): ?>
                            <dl class="kv-list">
                                <?php foreach ($comfort as $key => $value): ?>
                                    <div class="kv-item">
                                        <dt><?= esc(ucwords(str_replace('_', ' ', $key))) ?></dt>
                                        <dd><?= esc(is_array($value) ? implode(', ', $value) : $value) ?></dd>
                                    </div>
                                <?php endforeach; ?>
                            </dl>
                        <?php else: ?>
                            <div class="empty-text">No comfort details available.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="feature-box feature-card h-100">
                        <div class="feature-head">
                            <div class="feature-icon bg-success-subtle text-success">
                                <i class="bi bi-speedometer2"></i>
                            </div>
                            <div>
                                <h3 class="mb-1">Interior Features</h3>
                                <p class="text-muted mb-0">Cabin materials, seats and controls.</p>
                            </div>
                        </div>

                        <?php if (!empty($interior) && is_array($interior)): ?>
                            <dl class="kv-list">
                                <?php foreach ($interior as $key => $value): ?>
                                    <div class="kv-item">
                                        <dt><?= esc(ucwords(str_replace('_', ' ', $key))) ?></dt>
                                        <dd><?= esc(is_array($value) ? implode(', ', $value) : $value) ?></dd>
                                    </div>
                                <?php endforeach; ?>
                            </dl>
                        <?php else: ?>
                            <div class="empty-text">No interior details available.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="feature-box feature-card h-100">
                        <div class="feature-head">
                            <div class="feature-icon bg-warning-subtle text-warning">
                                <i class="bi bi-palette"></i>
                            </div>
                            <div>
                                <h3 class="mb-1">Exterior Features</h3>
                                <p class="text-muted mb-0">Styling, lighting and finishing details.</p>
                            </div>
                        </div>

                        <?php if (!empty($exterior) && is_array($exterior)): ?>
                            <dl class="kv-list">
                                <?php foreach ($exterior as $key => $value): ?>
                                    <div class="kv-item">
                                        <dt><?= esc(ucwords(str_replace('_', ' ', $key))) ?></dt>
                                        <dd><?= esc(is_array($value) ? implode(', ', $value) : $value) ?></dd>
                                    </div>
                                <?php endforeach; ?>
                            </dl>
                        <?php else: ?>
                            <div class="empty-text">No exterior details available.</div>
                        <?php endif; ?>
                    </div>
                </div>



                <div class="col-lg-6">
                    <div class="feature-box h-100">
                        <h3>Dimensions</h3>
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="spec-card h-100">
                                    <div class="spec-icon bg-primary-subtle text-primary">
                                        <i class="bi bi-arrows-expand"></i>
                                    </div>
                                    <div class="spec-content">
                                        <span class="spec-label">Length</span>
                                        <strong
                                            class="spec-value"><?= esc($vehicle['dimensions_formatted']['length'] ?? 'N/A') ?></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="spec-card h-100">
                                    <div class="spec-icon bg-warning-subtle text-warning">
                                        <i class="bi bi-arrows-angle-expand"></i>
                                    </div>
                                    <div class="spec-content">
                                        <span class="spec-label">Width</span>
                                        <strong
                                            class="spec-value"><?= esc($vehicle['dimensions_formatted']['width'] ?? 'N/A') ?></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="spec-card h-100">
                                    <div class="spec-icon bg-success-subtle text-success">
                                        <i class="bi bi-arrows-collapse"></i>
                                    </div>
                                    <div class="spec-content">
                                        <span class="spec-label">Height</span>
                                        <strong
                                            class="spec-value"><?= esc($vehicle['dimensions_formatted']['height'] ?? 'N/A') ?></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="spec-card h-100">
                                    <div class="spec-icon bg-info-subtle text-info">
                                        <i class="bi bi-diagram-3"></i>
                                    </div>
                                    <div class="spec-content">
                                        <span class="spec-label">Wheelbase</span>
                                        <strong
                                            class="spec-value"><?= esc($vehicle['dimensions_formatted']['wheelbase'] ?? 'N/A') ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="feature-box h-100">
                        <h3>Suspension & Brakes</h3>
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="spec-card h-100">
                                    <div class="spec-icon bg-primary-subtle text-primary">
                                        <i class="bi bi-diagram-2"></i>
                                    </div>
                                    <div class="spec-content">
                                        <span class="spec-label">Front Suspension</span>
                                        <strong
                                            class="spec-value"><?= esc($vehicle['suspension_formatted']['front'] ?? 'N/A') ?></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="spec-card h-100">
                                    <div class="spec-icon bg-warning-subtle text-warning">
                                        <i class="bi bi-diagram-2-fill"></i>
                                    </div>
                                    <div class="spec-content">
                                        <span class="spec-label">Rear Suspension</span>
                                        <strong
                                            class="spec-value"><?= esc($vehicle['suspension_formatted']['rear'] ?? 'N/A') ?></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="spec-card h-100">
                                    <div class="spec-icon bg-success-subtle text-success">
                                        <i class="bi bi-disc"></i>
                                    </div>
                                    <div class="spec-content">
                                        <span class="spec-label">Front Brake</span>
                                        <strong
                                            class="spec-value"><?= esc($vehicle['brakes_formatted']['front'] ?? 'N/A') ?></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="spec-card h-100">
                                    <div class="spec-icon bg-danger-subtle text-danger">
                                        <i class="bi bi-disc-fill"></i>
                                    </div>
                                    <div class="spec-content">
                                        <span class="spec-label">Rear Brake</span>
                                        <strong
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

    <section class="section-space bg-light" id="price-section">
        <div class="container">
            <header class="section-header">
                <h2><?= esc($carTitle) ?> Price in India</h2>
            </header>

            <div class="price-table">
                <div class="price-row">
                    <span>Ex-Showroom Price</span>
                    <strong>₹<?= number_format((float) ($pricing['ex_showroom_price'] ?? 0)) ?></strong>
                </div>
                <?php if (!empty($pricing['insurance_cost'])): ?>
                    <div class="price-row">
                        <span>Insurance</span>
                        <strong>₹<?= number_format((float) $pricing['insurance_cost']) ?></strong>
                    </div>
                <?php endif; ?>
                <?php if (!empty($pricingData['road_tax'])): ?>
                    <div class="price-row"><span>Road
                            Tax</span><strong>₹<?= number_format((float) $pricingData['road_tax']) ?></strong></div>
                <?php endif; ?>
                <div class="price-row total"><span>On-Road
                        Price</span><strong>₹<?= number_format((float) ($pricingData['on_road_price'] ?? 0)) ?></strong>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    body {
        background: #f4f6f9;
    }

    .car-detail-page {
        font-family: Inter, sans-serif;
    }

    .breadcrumb-wrap {
        background: #fff;
        border-bottom: 1px solid #eee;
        padding: 14px 0;
    }

    .car-hero {
        padding: 50px 0;
        background: #fff;
    }

    .hero-image-card {
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, .08);
        background: #fff;
    }

    .main-image {
        width: 100%;
        border-radius: 18px;
        object-fit: cover;
        height: 520px;
    }

    .no-image {
        height: 520px;
        background: #ececec;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 70px;
    }

    .gallery-thumbs {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .thumb {
        width: 90px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        cursor: pointer;
        border: 2px solid transparent;
    }

    .thumb:hover,
    .active-thumb {
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .2);
    }

    .car-sidebar {
        background: #f8f9fa;
        padding: 28px;
        border-radius: 20px;
        position: sticky;
        top: 20px;
    }

    .car-title {
        font-size: 2.2rem;
        font-weight: 800;
        line-height: 1.2;
    }

    .quick-specs {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 18px 0;
    }

    .quick-specs span {
        background: #fff;
        padding: 10px 16px;
        border-radius: 50px;
        font-size: 14px;
        border: 1px solid #e9ecef;
    }

    .price-box {
        background: #fff;
        padding: 24px;
        border-radius: 18px;
        margin-top: 20px;
    }

    .price-label {
        color: #666;
        margin-bottom: 10px;
    }

    .main-price {
        font-size: 2.8rem;
        font-weight: 800;
        color: #198754;
    }

    .onroad-price {
        margin-top: 10px;
        font-weight: 600;
    }

    .emi-box {
        margin-top: 15px;
        background: #d1e7dd;
        padding: 14px;
        border-radius: 12px;
        font-weight: 600;
    }

    .small-spec-list {
        margin-top: 20px;
    }

    .small-spec-list div {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .section-space {
        padding: 70px 0;
    }

    .section-header {
        margin-bottom: 40px;
    }

    .section-header h2 {
        font-size: 2rem;
        font-weight: 800;
    }

    .spec-card,
    .feature-box,
    .spec-table,
    .price-table {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
    }

    .spec-card {
        padding: 30px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .05);
    }

    .spec-table,
    .price-table {
        box-shadow: 0 4px 20px rgba(0, 0, 0, .05);
    }

    .spec-row,
    .price-row {
        display: flex;
        justify-content: space-between;
        padding: 18px 20px;
        border-bottom: 1px solid #eee;
    }

    .price-row.total {
        background: #198754;
        color: #fff;
        font-size: 20px;
        font-weight: 700;
    }

    .feature-box {
        padding: 28px;
        height: 100%;
    }

    .feature-box h3 {
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: 700;
    }

    .feature-box ul {
        padding-left: 20px;
        margin-bottom: 0;
    }

    .feature-box li {
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {

        .main-image,
        .no-image {
            height: 300px;
        }

        .car-title {
            font-size: 1.8rem;
        }

        .main-price {
            font-size: 2.1rem;
        }

        .car-sidebar {
            position: static;
        }
    }

    .kv-list {
        display: grid;
        gap: 12px;
        margin: 0;
    }

    .kv-list>div {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        padding: 12px 14px;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .kv-list dt {
        font-weight: 700;
        color: #212529;
        margin: 0;
    }

    .kv-list dd {
        margin: 0;
        color: #495057;
        text-align: right;
        font-weight: 500;
    }

    .spec-card {
        background: #fff;
        border-radius: 18px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 6px 24px rgba(0, 0, 0, .06);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .spec-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 28px rgba(0, 0, 0, .10);
    }

    .spec-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .spec-content {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .spec-label {
        font-size: .88rem;
        color: #6c757d;
        margin-bottom: 4px;
    }

    .spec-value {
        font-size: 1.05rem;
        font-weight: 700;
        color: #212529;
        line-height: 1.2;
    }

    @media (max-width: 576px) {
        .spec-card {
            padding: 16px;
            gap: 12px;
        }

        .spec-icon {
            width: 46px;
            height: 46px;
            font-size: 1.2rem;
        }

        .spec-value {
            font-size: .98rem;
        }
    }

    .spec-content {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .spec-label {
        font-size: .88rem;
        color: #6c757d;
        margin-bottom: 4px;
    }

    .spec-value {
        font-size: 1.05rem;
        font-weight: 700;
        color: #212529;
        line-height: 1.2;
    }

    @media (max-width: 576px) {
        .spec-card {
            padding: 16px;
            gap: 12px;
        }

        .spec-icon {
            width: 46px;
            height: 46px;
            font-size: 1.2rem;
        }

        .spec-value {
            font-size: .98rem;
        }
    }

    .feature-card {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 6px 24px rgba(0, 0, 0, .06);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 28px rgba(0, 0, 0, .10);
    }

    .feature-head {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
    }

    .feature-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .kv-list {
        display: grid;
        gap: 12px;
        margin: 0;
    }

    .kv-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        padding: 12px 14px;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .kv-item dt {
        font-weight: 700;
        color: #212529;
        margin: 0;
        flex: 1;
    }

    .kv-item dd {
        margin: 0;
        color: #495057;
        text-align: right;
        font-weight: 500;
        flex: 1;
    }

    .empty-text {
        padding: 14px;
        background: #f8f9fa;
        border-radius: 12px;
        color: #6c757d;
        font-size: .95rem;
    }

    @media (max-width: 576px) {
        .feature-card {
            padding: 18px;
        }

        .feature-head {
            gap: 12px;
        }

        .feature-icon {
            width: 46px;
            height: 46px;
            font-size: 1.15rem;
        }

        .kv-item {
            flex-direction: column;
            gap: 4px;
        }

        .kv-item dd {
            text-align: left;
        }
    }

    .car-sidebar {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 6px 24px rgba(0, 0, 0, .06);
    }

    .car-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 16px;
        color: #212529;
    }

    .quick-specs {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .spec-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 12px;
        font-size: .9rem;
        font-weight: 500;
        box-shadow: inset 0 0 4px rgba(0, 0, 0, .05);
    }

    .price-box {
        margin-bottom: 20px;
    }

    .price-label {
        font-size: .9rem;
        color: #6c757d;
        margin-bottom: 4px;
    }

    .main-price {
        font-size: 1.6rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 8px;
    }

    .onroad-price {
        font-size: .95rem;
        color: #495057;
        margin-bottom: 6px;
    }

    .emi-box {
        font-size: .95rem;
        background: #f8f9fa;
        padding: 8px 12px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
    }

    .sidebar-actions .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .sidebar-actions .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, .1);
    }

    .small-spec-list {
        margin-top: 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .small-spec-list div {
        background: #f8f9fa;
        padding: 10px 14px;
        border-radius: 12px;
        display: flex;
        justify-content: space-between;
        font-size: .95rem;
    }

    .small-spec-list span {
        color: #6c757d;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mainImage = document.querySelector('.main-image');
        document.querySelectorAll('.thumb').forEach(thumb => {
            thumb.addEventListener('click', function () {
                if (mainImage) mainImage.src = this.src;
                document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active-thumb'));
                this.classList.add('active-thumb');
            });
        });
    });
</script>