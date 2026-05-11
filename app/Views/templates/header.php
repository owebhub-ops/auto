<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($pageData['title'] ?? 'Cars Catalog') ?> | AutoHub</title>
    <meta name="description"
        content="<?= esc($pageData['description'] ?? 'Explore latest cars with prices, specs, mileage, features and reviews. Find your perfect car today.') ?>" />
    <?php if (!empty($pageData['keywords'])): ?>
        <meta name="keywords" content="<?= esc($pageData['keywords']) ?>">
    <?php endif; ?>

    <link rel="canonical" href="<?= current_url() ?>">
    <meta name="robots" content="index, follow">
    <meta name="author" content="AutoHub Team">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= esc($pageData['title'] ?? 'Cars Catalog') ?>">
    <meta property="og:description" content="<?= esc($pageData['description'] ?? '') ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:site_name" content="AutoHub.com">
    <meta property="og:image" content="<?= base_url('public/images/og-car.jpg') ?>">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($pageData['title'] ?? '') ?>">
    <meta name="twitter:description" content="<?= esc($pageData['description'] ?? '') ?>">
    <meta name="twitter:image" content="<?= base_url('public/images/og-car.jpg') ?>">

    <!-- Schema.org for Car Listing/Detail -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "<?= isset($vehicle) ? 'Car' : 'ItemList' ?>",
        <?php if (isset($vehicle)): ?>
            "name": "<?= esc($vehicle['make'] . ' ' . $vehicle['model']) ?>",
            "brand": { "@type": "Brand", "name": "<?= esc($vehicle['make']) ?>" },
            "model": "<?= esc($vehicle['model']) ?>",
            "offers": {
                "@type": "Offer",
                "price": "<?= $pricing['ex_showroom_price'] ?? 0 ?>",
                "priceCurrency": "<?= $pricing['currency'] ?? 'INR' ?>"
            },
            "fuelType": "<?= esc($vehicle['fuel_type']) ?>",
            "vehicleTransmission": "<?= esc($vehicle['transmission']) ?>"
        <?php else: ?>
            "itemListElement": [
                <?php foreach ($cars ?? [] as $index => $car): ?>
                    {
                        "@type": "ListItem",
                        "position": <?= $index + 1 ?>,
                        "item": {
                            "@type": "Car",
                            "name": "<?= esc($car['make'] . ' ' . $car['model']) ?>",
                            "url": "<?= site_url('cars/' . $car['vehicle_id']) ?>"
                        }
                    }<?= $index < count($cars ?? []) - 1 ? ',' : '' ?>
                <?php endforeach; ?>
            ]
        <?php endif; ?>
    }
    </script>

    <!-- Preconnects -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="//bootstrap-icons.fontawesome.com">

    <!-- Core CSS -->
    <link href="<?= base_url('public/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Google Fonts - Inter for modern look -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="<?= base_url('public/assets/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/cars.css') ?>" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('public/favicon.ico') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/favicon-16x16.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('public/apple-touch-icon.png') ?>">
    <link rel="manifest" href="<?= base_url('public/site.webmanifest') ?>">

    <!-- PWA & Theme -->
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#667eea">
    <script src="<?= base_url('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Google Adsense -->
    <!-- <meta name="google-adsense-account" content="ca-pub-3584384822563781">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3584384822563781"
        crossorigin="anonymous"></script> -->
</head>

<body class="cars-theme">
    <!-- Preloader -->
    <!-- <div id="preloader" class="preloader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->