<!-- =========================
SEO META + SCHEMA
========================= -->
<?php
$carTitle = trim($vehicle['make'] . ' ' . $vehicle['model'] . ' ' . ($vehicle['variant'] ?? ''));
$carDescription = $carTitle . ' price, mileage, specifications, features, images, colours, EMI and on-road price in India.';
$carUrl = current_url();

$schema = [
    "@context" => "https://schema.org",
    "@type" => "Car",
    "name" => $carTitle,
    "brand" => [
        "@type" => "Brand",
        "name" => $vehicle['make']
    ],
    "model" => $vehicle['model'],
    "vehicleModelDate" => $vehicle['year'] ?? date('Y'),
    "bodyType" => $vehicle['body_type'] ?? '',
    "fuelType" => $vehicle['fuel_type'] ?? '',
    "vehicleTransmission" => $vehicle['transmission'] ?? '',
    "image" => $vehicle['image_url'] ?? '',
    "description" => $carDescription,
    "offers" => [
        "@type" => "Offer",
        "priceCurrency" => "INR",
        "price" => $pricing['ex_showroom_price'] ?? 0,
        "availability" => "https://schema.org/InStock",
        "url" => $carUrl
    ]
];
?>

<title><?= esc($carTitle) ?> Price, Specs, Mileage & Features</title>

<meta name="description" content="<?= esc($carDescription) ?>">
<meta name="keywords"
    content="<?= esc($vehicle['make']) ?>, <?= esc($vehicle['model']) ?> price, <?= esc($vehicle['model']) ?> mileage, <?= esc($vehicle['model']) ?> specs">
<meta property="og:title" content="<?= esc($carTitle) ?>">
<meta property="og:description" content="<?= esc($carDescription) ?>">
<meta property="og:image" content="<?= esc($vehicle['image_url']) ?>">
<meta property="og:url" content="<?= esc($carUrl) ?>">
<meta property="og:type" content="website">

<link rel="canonical" href="<?= esc($carUrl) ?>">

<script type="application/ld+json">
<?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>

<!-- =========================
CAR DETAIL PAGE
========================= -->

<div class="car-detail-page">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-wrap">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?= site_url('cars') ?>">
                        All Cars
                    </a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                    <?= esc($carTitle) ?>
                </li>
            </ol>
        </div>
    </nav>

    <!-- HERO -->
    <section class="car-hero">
        <div class="container">

            <div class="row g-5 align-items-start">

                <!-- IMAGE -->
                <div class="col-lg-7">

                    <figure class="car-image-box">

                        <?php if (!empty($vehicle['image_url'])): ?>

                            <img src="<?= esc($vehicle['image_url']) ?>" alt="<?= esc($carTitle) ?>"
                                class="main-image img-fluid" loading="eager" width="900" height="550">

                        <?php else: ?>

                            <div class="no-image">
                                <i class="bi bi-car-front-fill"></i>
                            </div>

                        <?php endif; ?>

                    </figure>

                    <!-- THUMBNAILS -->
                    <div class="gallery-thumbs">

                        <?php
                        $thumbs = [];

                        if (!empty($vehicle['image_url'])) {
                            $thumbs[] = $vehicle['image_url'];
                        }

                        if (!empty($vehicle['color_options']) && is_array($vehicle['color_options'])) {
                            foreach ($vehicle['color_options'] as $color) {
                                if (!empty($color['image'])) {
                                    $thumbs[] = $color['image'];
                                }
                            }
                        }

                        $thumbs = array_unique($thumbs);

                        foreach (array_slice($thumbs, 0, 6) as $thumb):
                            ?>
<?php /*
                            <img src="<?= esc($thumb) ?>" alt="<?= esc($carTitle) ?>" class="thumb active-thumb"
                                loading="lazy" width="90" height="70"> 
                                
                                */?>

                        <?php endforeach; ?>

                    </div>

                </div>

                <!-- CONTENT -->
                <div class="col-lg-5">

                    <div class="car-content">

                        <h1 class="car-title">
                            <?= esc($carTitle) ?>
                        </h1>

                        <!-- QUICK SPECS -->
                        <div class="quick-specs">

                            <?php if (!empty($vehicle['fuel_type'])): ?>
                                <span>
                                    <i class="bi bi-fuel-pump"></i>
                                    <?= esc($vehicle['fuel_type']) ?>
                                </span>
                            <?php endif; ?>

                            <?php if (!empty($vehicle['transmission'])): ?>
                                <span>
                                    <i class="bi bi-gear"></i>
                                    <?= esc($vehicle['transmission']) ?>
                                </span>
                            <?php endif; ?>

                            <?php if (!empty($vehicle['mileage_kmpl'])): ?>
                                <span>
                                    <i class="bi bi-speedometer2"></i>
                                    <?= esc($vehicle['mileage_kmpl']) ?> kmpl
                                </span>
                            <?php endif; ?>

                        </div>

                        <!-- PRICE -->
                        <div class="price-box">

                            <div class="price-label">
                                Ex-Showroom Price
                            </div>

                            <div class="main-price">
                                ₹<?= number_format($pricing['ex_showroom_price'] ?? 0) ?>
                            </div>

                            <?php if (!empty($pricing['on_road_price'])): ?>
                                <div class="onroad-price">
                                    On Road Price:
                                    ₹<?= number_format($pricing['on_road_price']) ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($pricing['emi_amount'])): ?>
                                <div class="emi-box">
                                    EMI Starts At ₹<?= number_format($pricing['emi_amount']) ?>/month
                                </div>
                            <?php endif; ?>

                        </div>

                        <!-- CTA -->
                        <div class="cta-buttons">

                            <a href="#price-section" class="btn btn-warning btn-lg">
                                Check Price
                            </a>

                            <a href="#features" class="btn btn-dark btn-lg">
                                View Features
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- OVERVIEW -->
    <section class="section-space bg-white">
        <div class="container">

            <header class="section-header">
                <h2><?= esc($carTitle) ?> Overview</h2>
                <p>
                    Explore mileage, specifications, engine performance,
                    dimensions, safety features and latest price.
                </p>
            </header>

            <div class="row g-4">

                <div class="col-md-3">
                    <div class="spec-card">
                        <h3>Engine</h3>
                        <p><?= esc($vehicle['engine_cc'] ?? 'N/A') ?> cc</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="spec-card">
                        <h3>Power</h3>
                        <p><?= esc($vehicle['power_bhp'] ?? 'N/A') ?> bhp</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="spec-card">
                        <h3>Torque</h3>
                        <p><?= esc($vehicle['torque_nm'] ?? 'N/A') ?> Nm</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="spec-card">
                        <h3>Mileage</h3>
                        <p><?= esc($vehicle['mileage_kmpl'] ?? 'N/A') ?> kmpl</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- SPECIFICATIONS -->
    <section class="section-space bg-light" id="specs">
        <div class="container">

            <header class="section-header">
                <h2><?= esc($carTitle) ?> Specifications</h2>
            </header>

            <div class="spec-table">

                <div class="spec-row">
                    <span>Fuel Type</span>
                    <strong><?= esc($vehicle['fuel_type'] ?? 'N/A') ?></strong>
                </div>

                <div class="spec-row">
                    <span>Transmission</span>
                    <strong><?= esc($vehicle['transmission'] ?? 'N/A') ?></strong>
                </div>

                <div class="spec-row">
                    <span>Seating Capacity</span>
                    <strong><?= esc($vehicle['seating_capacity'] ?? 'N/A') ?></strong>
                </div>

                <div class="spec-row">
                    <span>Boot Space</span>
                    <strong><?= esc($vehicle['boot_space_liters'] ?? 'N/A') ?> L</strong>
                </div>

                <div class="spec-row">
                    <span>Ground Clearance</span>
                    <strong><?= esc($vehicle['ground_clearance_mm'] ?? 'N/A') ?> mm</strong>
                </div>

            </div>

        </div>
    </section>

    <!-- FEATURES -->
    <section class="section-space bg-white" id="features">
        <div class="container">

            <header class="section-header">
                <h2><?= esc($carTitle) ?> Features</h2>
            </header>

            <div class="row g-4">

                <!-- SAFETY -->
                <div class="col-lg-6">

                    <div class="feature-box">

                        <h3>Safety Features</h3>

                        <ul>

                            <?php
                            $safety = $vehicle['safety_features'] ?? [];

                            foreach (array_slice($safety, 0, 8) as $feature):
                                ?>

                                <li><?= esc($feature) ?></li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                </div>

                <!-- COMFORT -->
                <div class="col-lg-6">

                    <div class="feature-box">

                        <h3>Comfort Features</h3>

                        <ul>

                            <?php
                            $comfort = $vehicle['comfort_features'] ?? [];

                            foreach (array_slice($comfort, 0, 8) as $feature):
                                ?>

                                <li><?= esc($feature) ?></li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                </div>

                <!-- =========================
     DIMENSIONS SECTION
========================= -->

                <?php
                $dimensions = $vehicle['dimensions'] ?? [];

                function mmToFeet($mm)
                {
                    return !empty($mm)
                        ? round($mm / 304.8, 2)
                        : null;
                }
                ?>

                <!-- DIMENSIONS -->
                <div class="col-lg-6">

                    <div class="feature-box h-100">

                        <h3>
                            <i class="bi bi-rulers me-2"></i>
                            Dimensions
                        </h3>

                        <div class="spec-table">

                            <div class="spec-row">
                                <span>Length</span>

                                <strong>
                                    <?= !empty($dimensions['length_mm'])
                                        ? number_format($dimensions['length_mm']) . ' mm (' . mmToFeet($dimensions['length_mm']) . ' ft)'
                                        : 'N/A' ?>
                                </strong>
                            </div>

                            <div class="spec-row">
                                <span>Width</span>

                                <strong>
                                    <?= !empty($dimensions['width_mm'])
                                        ? number_format($dimensions['width_mm']) . ' mm (' . mmToFeet($dimensions['width_mm']) . ' ft)'
                                        : 'N/A' ?>
                                </strong>
                            </div>

                            <div class="spec-row">
                                <span>Height</span>

                                <strong>
                                    <?= !empty($dimensions['height_mm'])
                                        ? number_format($dimensions['height_mm']) . ' mm (' . mmToFeet($dimensions['height_mm']) . ' ft)'
                                        : 'N/A' ?>
                                </strong>
                            </div>

                            <div class="spec-row">
                                <span>Wheelbase</span>

                                <strong>
                                    <?= !empty($dimensions['wheelbase_mm'])
                                        ? number_format($dimensions['wheelbase_mm']) . ' mm (' . mmToFeet($dimensions['wheelbase_mm']) . ' ft)'
                                        : 'N/A' ?>
                                </strong>
                            </div>

                            <div class="spec-row">
                                <span>Ground Clearance</span>

                                <strong>
                                    <?= !empty($vehicle['ground_clearance_mm'])
                                        ? number_format($vehicle['ground_clearance_mm']) . ' mm'
                                        : 'N/A' ?>
                                </strong>
                            </div>

                            <div class="spec-row border-0">
                                <span>Boot Space</span>

                                <strong>
                                    <?= !empty($vehicle['boot_space_liters'])
                                        ? number_format($vehicle['boot_space_liters']) . ' Litres'
                                        : 'N/A' ?>
                                </strong>
                            </div>

                        </div>

                    </div>

                </div>


                <!-- =========================
     SUSPENSION & BRAKES
========================= -->

<?php
$suspension = $vehicle['suspension'] ?? [];
$brakes = $vehicle['brakes'] ?? [];
?>

               <!-- SUSPENSION -->
<div class="col-lg-6">

<div class="feature-box h-100">

    <h3>
        <i class="bi bi-gear-wide-connected me-2"></i>
        Suspension & Brakes
    </h3>

    <div class="spec-table">

        <div class="spec-row">
            <span>Front Suspension</span>

            <strong>
                <?= esc($suspension['front'] ?? 'N/A') ?>
            </strong>
        </div>

        <div class="spec-row">
            <span>Rear Suspension</span>

            <strong>
                <?= esc($suspension['rear'] ?? 'N/A') ?>
            </strong>
        </div>

        <div class="spec-row">
            <span>Front Brake</span>

            <strong>
                <?= esc($brakes['front'] ?? 'N/A') ?>
            </strong>
        </div>

        <div class="spec-row">
            <span>Rear Brake</span>

            <strong>
                <?= esc($brakes['rear'] ?? 'N/A') ?>
            </strong>
        </div>

        <div class="spec-row border-0">
            <span>Drive Type</span>

            <strong>
                <?= esc($vehicle['drive_type'] ?? 'N/A') ?>
            </strong>
        </div>

    </div>

</div>

</div>

            </div>

        </div>
    </section>

    <!-- PRICE -->
    <section class="section-space bg-light" id="price-section">
        <div class="container">

            <header class="section-header">
                <h2><?= esc($carTitle) ?> Price in India</h2>
            </header>

            <div class="price-table">

                <div class="price-row">
                    <span>Ex-Showroom Price</span>
                    <strong>₹<?= number_format($pricing['ex_showroom_price'] ?? 0) ?></strong>
                </div>

                <?php if (!empty($pricing['insurance_cost'])): ?>
                    <div class="price-row">
                        <span>Insurance</span>
                        <strong>₹<?= number_format($pricing['insurance_cost']) ?></strong>
                    </div>
                <?php endif; ?>

                <?php if (!empty($pricing['road_tax'])): ?>
                    <div class="price-row">
                        <span>Road Tax</span>
                        <strong>₹<?= number_format($pricing['road_tax']) ?></strong>
                    </div>
                <?php endif; ?>

                <div class="price-row total">
                    <span>On-Road Price</span>
                    <strong>₹<?= number_format($pricing['on_road_price'] ?? 0) ?></strong>
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

    .main-image {
        width: 100%;
        border-radius: 18px;
        object-fit: cover;
        height: 520px;
    }

    .no-image {
        height: 520px;
        background: #ececec;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 70px;
    }

    .gallery-thumbs {
        display: flex;
        gap: 10px;
        margin-top: 15px;
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

    .thumb:hover {
        border-color: #0d6efd;
    }

    .car-title {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.3;
    }

    .quick-specs {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 20px 0;
    }

    .quick-specs span {
        background: #f1f3f5;
        padding: 10px 16px;
        border-radius: 50px;
        font-size: 14px;
    }

    .price-box {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 20px;
        margin-top: 25px;
    }

    .price-label {
        color: #666;
        margin-bottom: 10px;
    }

    .main-price {
        font-size: 3rem;
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

    .cta-buttons {
        display: flex;
        gap: 15px;
        margin-top: 25px;
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

    .spec-card {
        background: #fff;
        border-radius: 16px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .05);
    }

    .spec-card h3 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .spec-table,
    .price-table {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
    }

    .spec-row,
    .price-row {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .price-row.total {
        background: #198754;
        color: #fff;
        font-size: 20px;
        font-weight: 700;
    }

    .feature-box {
        background: #fff;
        border-radius: 20px;
        padding: 30px;
        height: 100%;
    }

    .feature-box h3 {
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: 700;
    }

    .feature-box ul {
        padding-left: 20px;
    }

    .feature-box li {
        margin-bottom: 12px;
    }

    @media(max-width:768px) {

        .main-image,
        .no-image {
            height: 300px;
        }

        .car-title {
            font-size: 2rem;
        }

        .main-price {
            font-size: 2.2rem;
        }

        .cta-buttons {
            flex-direction: column;
        }

    }

    .active-thumb{
    border-color:#0d6efd !important;
    box-shadow:0 0 0 3px rgba(13,110,253,.2);
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const mainImage = document.querySelector('.main-image');

        document.querySelectorAll('.thumb').forEach(thumb => {

            thumb.addEventListener('click', function () {

                if (mainImage) {
                    mainImage.src = this.src;
                }

                document.querySelectorAll('.thumb').forEach(t => {
                    t.classList.remove('active-thumb');
                });

                this.classList.add('active-thumb');

            });

        });

    });
</script>