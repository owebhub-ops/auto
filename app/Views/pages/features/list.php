<style>
    :root {
        --bg: #f6f4ef;
        --paper: #fffdf8;
        --ink: #161616;
        --muted: #66615b;
        --line: rgba(22, 22, 22, .1);
        --brand: #c94f2d;
        --brand-2: #f2b84b;
        --accent: #1f6b5c;
        --shadow: 0 20px 60px rgba(18, 18, 18, .08);
        --radius: 28px;
        --primary-gradient: linear-gradient(135deg, #c94f2d 0%, #f2b84b 100%);
    }

    * {
        box-sizing: border-box
    }

    html {
        scroll-behavior: smooth
    }

    body {
        margin: 0;
        font-family: "Inter", sans-serif;
        color: var(--ink);
        background:
            radial-gradient(circle at top left, rgba(201, 79, 45, .08), transparent 30%),
            radial-gradient(circle at bottom right, rgba(31, 107, 92, .08), transparent 25%),
            var(--bg);
    }

    a {
        text-decoration: none;
        color: inherit
    }

    img {
        max-width: 100%;
        display: block
    }

    .container {
        width: min(1200px, calc(100% - 32px));
        margin-inline: auto;
    }

    .page-shell {
        padding: 32px 0 72px;
    }

    .hero {
        position: relative;
        overflow: hidden;
        background:
            linear-gradient(135deg, rgba(255, 255, 255, .72), rgba(255, 255, 255, .45)),
            linear-gradient(120deg, rgba(201, 79, 45, .12), rgba(242, 184, 75, .1), rgba(31, 107, 92, .12));
        border: 1px solid rgba(255, 255, 255, .5);
        box-shadow: var(--shadow);
        border-radius: 36px;
        padding: clamp(28px, 5vw, 54px);
        margin-bottom: 28px;
        backdrop-filter: blur(10px);
    }

    .hero::before,
    .hero::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        filter: blur(10px);
    }

    .hero::before {
        width: 240px;
        height: 240px;
        background: rgba(201, 79, 45, .14);
        top: -80px;
        right: -40px;
    }

    .hero::after {
        width: 180px;
        height: 180px;
        background: rgba(31, 107, 92, .14);
        bottom: -60px;
        left: -40px;
    }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: .82rem;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--accent);
        font-weight: 700;
        margin-bottom: 14px;
    }

    .eyebrow::before {
        content: "";
        width: 32px;
        height: 1px;
        background: currentColor;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 1.3fr .9fr;
        gap: 28px;
        align-items: end;
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-family: "Syne", sans-serif;
        font-size: clamp(2.4rem, 6vw, 5rem);
        line-height: .95;
        letter-spacing: -.04em;
        margin: 0 0 16px;
        max-width: 12ch;
    }

    .hero-copy {
        font-size: 1.02rem;
        color: var(--muted);
        max-width: 60ch;
        line-height: 1.75;
        margin: 0;
    }

    .hero-stats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .stat-tile {
        background: rgba(255, 255, 255, .62);
        border: 1px solid rgba(255, 255, 255, .55);
        border-radius: 22px;
        padding: 18px;
        backdrop-filter: blur(10px);
    }

    .stat-label {
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: var(--muted);
        margin-bottom: 8px;
    }

    .stat-value {
        font-family: "Syne", sans-serif;
        font-size: 1.6rem;
        line-height: 1;
    }

    .filters-wrap {
        margin: 28px 0 20px;
        display: grid;
        gap: 18px;
    }

    .filter-bar {
        background: rgba(255, 255, 255, .62);
        border: 1px solid rgba(255, 255, 255, .5);
        border-radius: 26px;
        padding: 18px;
        box-shadow: var(--shadow);
        backdrop-filter: blur(12px);
    }

    .filter-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto;
        gap: 14px;
        align-items: center;
    }

    .field {
        display: grid;
        gap: 8px;
    }

    .field label {
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: var(--muted);
        font-weight: 700;
    }

    .input,
    .select {
        width: 100%;
        border: 1px solid var(--line);
        background: rgba(255, 253, 248, .95);
        border-radius: 18px;
        padding: 14px 16px;
        font: inherit;
        color: var(--ink);
        outline: none;
        transition: .25s ease;
    }

    .input:focus,
    .select:focus {
        border-color: rgba(201, 79, 45, .55);
        box-shadow: 0 0 0 4px rgba(201, 79, 45, .08);
    }

    .view-toggle {
        display: flex;
        gap: 8px;
        align-self: end;
    }

    .toggle-btn {
        border: none;
        background: #fff;
        color: var(--ink);
        border: 1px solid var(--line);
        border-radius: 16px;
        padding: 13px 14px;
        cursor: pointer;
        transition: .25s ease;
        font-weight: 700;
    }

    .toggle-btn.active,
    .toggle-btn:hover {
        background: var(--primary-gradient);
        color: #fff;
        border-color: transparent;
        transform: translateY(-2px);
    }

    .category-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .category-tabs .nav-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 18px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .55);
        color: var(--ink);
        font-size: .94rem;
        font-weight: 700;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(18, 18, 18, .06);
    }

    .category-tabs .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.6s;
    }

    .category-tabs .nav-link:hover::before {
        left: 100%;
    }

    .category-tabs .nav-link.active {
        background: var(--primary-gradient) !important;
        color: #fff;
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 20px 40px rgba(201, 79, 45, 0.25);
        border-color: transparent;
    }

    .section-head {
        display: flex;
        justify-content: space-between;
        align-items: end;
        gap: 16px;
        margin: 28px 0 18px;
    }

    .section-title {
        font-family: "Syne", sans-serif;
        font-size: clamp(1.5rem, 3vw, 2.25rem);
        margin: 0;
        letter-spacing: -.03em;
    }

    .section-stats {
        color: var(--muted);
        font-weight: 600;
    }

    .section-stats .text-danger {
        color: var(--brand);
        font-family: "Syne", sans-serif;
        font-size: 1.1rem;
    }

    .cars-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
    }

    .cars-grid.list-view {
        grid-template-columns: 1fr;
    }

    .car-card-wrapper {
        opacity: 0;
    }

    .fade-in-up {
        opacity: 0;
        transform: translateY(40px);
        animation: fadeInUp 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hover-lift {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
    }

    .hover-lift:hover {
        transform: translateY(-12px) rotateX(2deg);
        box-shadow: 0 35px 80px rgba(0, 0, 0, 0.14) !important;
        border-color: rgba(201, 79, 45, 0.18);
    }

    .car-card {
        height: 100%;
        background: rgba(255, 255, 255, .78);
        border-radius: 28px;
        overflow: hidden;
        box-shadow: var(--shadow);
        position: relative;
        backdrop-filter: blur(12px);
        display: flex;
        flex-direction: column;
    }

    .car-image {
        position: relative;
        min-height: 220px;
        background:
            radial-gradient(circle at 20% 20%, rgba(242, 184, 75, .35), transparent 35%),
            linear-gradient(135deg, #1c1c1c, #484848);
        overflow: hidden;
    }

    .car-image::before {
        content: "";
        position: absolute;
        inset: 18px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, .12);
        pointer-events: none;
    }

    .feature-visual {
        position: absolute;
        inset: auto 20px 18px 20px;
        height: 120px;
        border-radius: 18px;
        background:
            linear-gradient(135deg, rgba(255, 255, 255, .2), rgba(255, 255, 255, .04)),
            radial-gradient(circle at 80% 20%, rgba(242, 184, 75, .45), transparent 30%),
            radial-gradient(circle at 20% 80%, rgba(201, 79, 45, .4), transparent 28%);
        border: 1px solid rgba(255, 255, 255, .16);
        backdrop-filter: blur(6px);
        display: grid;
        place-items: center;
    }

    .feature-visual svg {
        width: 74%;
        max-width: 220px;
        height: auto;
        opacity: .92;
    }

    .transition-scale {
        transition: transform 0.6s ease;
    }

    .hover-lift:hover .transition-scale {
        transform: scale(1.08);
    }

    .image-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 0;
        transition: all 0.4s ease;
    }

    .hover-lift:hover .image-overlay {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }

    .pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        padding: 10px 14px;
        font-size: .82rem;
        font-weight: 700;
        line-height: 1;
    }

    .badge-soft {
        background: rgba(255, 255, 255, .14);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, .18);
        backdrop-filter: blur(8px);
    }

    .price-badge {
        position: absolute;
        left: 18px;
        bottom: 18px;
        background: rgba(255, 250, 243, .94);
        color: var(--ink);
        box-shadow: 0 18px 40px rgba(0, 0, 0, .12);
        padding: 14px 16px;
        border-radius: 18px;
        z-index: 2;
        min-width: 140px;
    }

    .price-value {
        font-family: "Syne", sans-serif;
        font-size: 1.25rem;
        line-height: 1;
        margin-bottom: 4px;
    }

    .car-badges {
        position: absolute;
        top: 16px;
        right: 16px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        z-index: 2;
    }

    .car-details {
        padding: 22px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .car-header .car-brand {
        font-size: .95rem;
        color: #6c635b;
        margin: 0 0 4px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .car-header .car-model {
        font-family: "Syne", sans-serif;
        font-size: 1.5rem;
        line-height: 1.05;
        margin: 0 0 10px;
        letter-spacing: -.03em;
    }

    .car-category {
        display: inline-flex;
        align-items: center;
        padding: 9px 14px;
        border-radius: 999px;
        background: #f6efe4;
        color: var(--accent);
        border: 1px solid rgba(31, 107, 92, .14);
        font-weight: 700;
        font-size: .84rem;
    }

    .car-variant {
        display: inline-flex;
        align-self: flex-start;
        background: #fff;
        color: #5f5751;
        border: 1px solid rgba(22, 22, 22, .08);
        padding: 9px 14px;
        border-radius: 999px;
        margin: 14px 0 12px;
        font-size: .84rem;
        font-weight: 600;
        box-shadow: 0 8px 18px rgba(18, 18, 18, .04);
    }

    .feature-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 0 0 16px;
    }

    .feature-tag {
        background: #f4efe8;
        color: #403932;
        border: 1px solid rgba(22, 22, 22, .08);
        border-radius: 999px;
        padding: 8px 12px;
        font-size: .78rem;
        font-weight: 700;
    }

    .car-specs {
        margin: 8px 0 20px;
    }

    .spec-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 11px 0;
        border-bottom: 1px solid rgba(22, 22, 22, .08);
    }

    .spec-row:last-child {
        border-bottom: none
    }

    .spec-row .spec-label {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .spec-value {
        color: #2c3e50;
        min-width: 80px;
        text-align: right;
        font-weight: 700;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        border: none;
        border-radius: 999px;
        padding: 14px 18px;
        background: var(--primary-gradient);
        color: #fff;
        font-weight: 800;
        letter-spacing: .01em;
        cursor: pointer;
        transition: .25s ease;
        box-shadow: 0 16px 30px rgba(201, 79, 45, .22);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 36px rgba(201, 79, 45, .28);
    }

    .btn-ghost {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--line);
        border-radius: 999px;
        padding: 12px 16px;
        background: #fff;
        color: var(--ink);
        font-weight: 700;
        transition: .25s ease;
    }

    .btn-ghost:hover {
        transform: translateY(-2px);
        border-color: rgba(201, 79, 45, .3);
    }

    .load-more-section {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    #loadMore {
        min-width: 220px;
    }

    .spinner-border {
        display: inline-block;
        width: 1rem;
        height: 1rem;
        border: .16em solid rgba(255, 255, 255, .45);
        border-right-color: transparent;
        border-radius: 50%;
        animation: spin .8s linear infinite;
        vertical-align: -.125em;
        margin-right: 10px;
    }

    .d-none {
        display: none !important
    }

    @keyframes spin {
        to {
            transform: rotate(360deg)
        }
    }

    .empty-state {
        padding: 42px 24px;
        background: rgba(255, 255, 255, .7);
        border: 1px solid rgba(255, 255, 255, .55);
        border-radius: 28px;
        text-align: center;
        box-shadow: var(--shadow);
    }

    .empty-state h3 {
        font-family: "Syne", sans-serif;
        margin: 0 0 10px;
        font-size: 1.6rem;
    }

    .muted {
        color: var(--muted)
    }

    .cars-grid.list-view .car-card {
        display: grid;
        grid-template-columns: 320px 1fr;
        min-height: 280px;
    }

    .cars-grid.list-view .car-image {
        min-height: 100%;
        height: 100%;
    }

    @media (max-width: 1100px) {
        .cars-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr))
        }

        .hero-grid {
            grid-template-columns: 1fr
        }
    }

    @media (max-width: 992px) {
        .cars-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .hero-title {
            font-size: 2.8rem !important;
        }

        .filter-grid {
            grid-template-columns: 1fr 1fr;
        }

        .view-toggle {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 768px) {
        .category-tabs {
            flex-direction: column;
        }

        .cars-grid {
            grid-template-columns: 1fr !important;
        }

        .cars-grid.list-view .car-card {
            grid-template-columns: 1fr;
        }

        .car-image {
            min-height: 220px;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .section-head {
            flex-direction: column;
            align-items: flex-start;
        }

        .hero-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>

<body>
    <main class="page-shell">
        <div class="container">
            <section class="hero fade-in-up" style="animation-delay:.05s">
                <div class="hero-grid">
                    <div>
                        <div class="eyebrow">Feature Explorer</div>
                        <h1 class="hero-title"><?= esc($page_title ?? 'Car Features') ?></h1>
                        <p class="hero-copy">
                            Compare modern safety, comfort, infotainment, and camera technologies across India’s most
                            researched vehicles. Built for buyers who care about features, not just specs.
                        </p>
                    </div>

                    <div class="hero-stats">
                        <div class="stat-tile">
                            <div class="stat-label">Vehicles Covered</div>
                            <div class="stat-value"><?= count($vehicles ?? []) ?></div>
                        </div>
                        <div class="stat-tile">
                            <div class="stat-label">Focus Area</div>
                            <div class="stat-value"><?= esc($current_category ?? 'All') ?></div>
                        </div>
                        <div class="stat-tile">
                            <div class="stat-label">Top Filters</div>
                            <div class="stat-value">Body • Fuel</div>
                        </div>
                        <div class="stat-tile">
                            <div class="stat-label">Search Mode</div>
                            <div class="stat-value">Live</div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="filters-wrap">
                <div class="filter-bar fade-in-up" style="animation-delay:.12s">
                    <div class="filter-grid">
                        <div class="field">
                            <label for="featureSearch">Search Car</label>
                            <input id="featureSearch" class="input" type="text"
                                placeholder="Search by make, model or variant">
                        </div>

                        <div class="field">
                            <label for="fuelFilter">Fuel Type</label>
                            <select id="fuelFilter" class="select">
                                <option value="">All Fuel Types</option>
                                <?php
                                $fuelTypes = [];
                                foreach (($vehicles ?? []) as $v) {
                                    if (!empty($v['fuel_type']))
                                        $fuelTypes[] = $v['fuel_type'];
                                }
                                $fuelTypes = array_values(array_unique($fuelTypes));
                                sort($fuelTypes);
                                foreach ($fuelTypes as $fuel):
                                    ?>
                                    <option value="<?= esc($fuel) ?>"><?= esc($fuel) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="field">
                            <label for="bodyFilter">Body Type</label>
                            <select id="bodyFilter" class="select">
                                <option value="">All Body Types</option>
                                <?php
                                $bodyTypes = [];
                                foreach (($vehicles ?? []) as $v) {
                                    if (!empty($v['body_type']))
                                        $bodyTypes[] = $v['body_type'];
                                }
                                $bodyTypes = array_values(array_unique($bodyTypes));
                                sort($bodyTypes);
                                foreach ($bodyTypes as $body):
                                    ?>
                                    <option value="<?= esc($body) ?>"><?= esc($body) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="view-toggle">
                            <button id="gridViewBtn" class="toggle-btn active" type="button"
                                aria-label="Grid view">Grid</button>
                            <button id="listViewBtn" class="toggle-btn" type="button"
                                aria-label="List view">List</button>
                        </div>
                    </div>
                </div>

                <div class="fade-in-up" style="animation-delay:.18s">
                    <nav class="category-tabs" aria-label="Feature categories">
                        <?php
                        $categories = $categories ?? ['Safety', 'Infotainment', 'Comfort', 'Interior', 'Exterior', 'Camera'];
                        $currentCategory = $current_category ?? '';
                        ?>
                        <a class="nav-link <?= empty($currentCategory) ? 'active' : '' ?>"
                            href="<?= base_url('features') ?>">All Features</a>
                        <?php foreach ($categories as $category): ?>
                            <a class="nav-link <?= ($currentCategory === $category) ? 'active' : '' ?>"
                                href="<?= base_url('features/' . urlencode($category)) ?>">
                                <?= esc($category) ?>
                            </a>
                        <?php endforeach; ?>
                    </nav>
                </div>
            </section>

            <section class="section-head fade-in-up" style="animation-delay:.22s">
                <div>
                    <h2 class="section-title">Feature-focused cars</h2>
                    <div class="muted">Browse cars with enriched feature data and pricing context.</div>
                </div>
                <div class="section-stats">
                    <span class="text-danger"><?= count($vehicles ?? []) ?></span> Available
                </div>
            </section>

            <section id="carsGrid" class="cars-grid grid-view">
                <?php if (!empty($vehicles)): ?>
                    <?php foreach (($vehicles ?? []) as $index => $car): ?>
                        <?php
                        $title = trim(($car['make'] ?? '') . ' ' . ($car['model'] ?? ''));
                        $variant = $car['variant'] ?? '';
                        $bodyType = $car['body_type'] ?? '';
                        $fuelType = $car['fuel_type'] ?? '';
                        $transmission = $car['transmission'] ?? '';
                        $mileage = $car['mileage_kmpl'] ?? '';
                        $seating = $car['seating_capacity'] ?? 5;
                        $price = !empty($car['ex_showroom_price']) ? '₹' . number_format((float) $car['ex_showroom_price'], 0) : 'Price N/A';

                        $featureTags = [];
                        if (!empty($car['safety_features']))
                            $featureTags[] = 'Safety';
                        if (!empty($car['infotainment']))
                            $featureTags[] = 'Infotainment';
                        if (!empty($car['comfort_features']))
                            $featureTags[] = 'Comfort';
                        if (!empty($car['interior_features']))
                            $featureTags[] = 'Interior';
                        if (!empty($car['exterior_features']))
                            $featureTags[] = 'Exterior';
                        if (!empty($car['camera_features']))
                            $featureTags[] = 'Camera';

                        $featureCount = count($featureTags);
                        ?>
                        <article class="car-card-wrapper fade-in-up" data-make="<?= esc(strtolower($car['make'] ?? '')) ?>"
                            data-model="<?= esc(strtolower($car['model'] ?? '')) ?>"
                            data-variant="<?= esc(strtolower($variant)) ?>" data-fuel="<?= esc($fuelType) ?>"
                            data-body="<?= esc($bodyType) ?>" data-price="<?= esc($car['ex_showroom_price'] ?? 0) ?>"
                            data-mileage="<?= esc($mileage ?: 0) ?>" style="animation-delay:<?= $index * 0.06 ?>s">

                            <div class="car-card hover-lift">
                                <div class="car-image">
                                    <div class="car-badges">
                                        <?php if (!empty($car['ncap_rating'])): ?>
                                            <span class="pill badge-soft">★ <?= esc($car['ncap_rating']) ?> NCAP</span>
                                        <?php endif; ?>
                                        <?php if (!empty($featureCount)): ?>
                                            <span class="pill badge-soft"><?= esc($featureCount) ?> Feature Sets</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="feature-visual transition-scale" aria-hidden="true">
                                        <svg viewBox="0 0 420 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M72 107C80 82 98 64 127 55L193 35C214 29 238 29 259 35L314 50C331 55 346 66 355 82L371 107C375 114 370 123 362 123H81C74 123 69 114 72 107Z"
                                                fill="rgba(255,255,255,.88)" />
                                            <circle cx="126" cy="122" r="21" fill="#1b1b1b" />
                                            <circle cx="314" cy="122" r="21" fill="#1b1b1b" />
                                            <circle cx="126" cy="122" r="10" fill="#c94f2d" />
                                            <circle cx="314" cy="122" r="10" fill="#f2b84b" />
                                            <path d="M138 59H258C282 59 300 70 311 91H115C120 72 127 59 138 59Z"
                                                fill="rgba(31,107,92,.55)" />
                                            <path d="M194 43L228 43" stroke="#fff" stroke-width="6" stroke-linecap="round" />
                                        </svg>
                                    </div>

                                    <div class="price-badge">
                                        <div class="price-value"><?= esc($price) ?></div>
                                        <small>Ex-Showroom</small>
                                    </div>

                                    <div class="image-overlay">
                                        <a href="<?= base_url('cars/features/detail/' . ($car['vehicle_id'] ?? 0)) ?>"
                                            class="btn-ghost">Quick View</a>
                                    </div>
                                </div>

                                <div class="car-details">
                                    <div class="car-header">
                                        <div class="car-brand"><?= esc($car['make'] ?? '') ?></div>
                                        <h3 class="car-model"><?= esc($car['model'] ?? '') ?></h3>
                                        <div class="car-category"><?= esc($bodyType ?: 'Vehicle') ?></div>
                                    </div>

                                    <?php if (!empty($variant)): ?>
                                        <div class="car-variant"><?= esc($variant) ?></div>
                                    <?php endif; ?>

                                    <?php if (!empty($featureTags)): ?>
                                        <div class="feature-tags">
                                            <?php foreach (array_slice($featureTags, 0, 4) as $tag): ?>
                                                <span class="feature-tag"><?= esc($tag) ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="car-specs">
                                        <div class="spec-row">
                                            <span class="spec-label">Fuel</span>
                                            <span class="spec-value"><?= esc($fuelType ?: '—') ?></span>
                                        </div>
                                        <div class="spec-row">
                                            <span class="spec-label">Transmission</span>
                                            <span class="spec-value"><?= esc($transmission ?: '—') ?></span>
                                        </div>
                                        <div class="spec-row">
                                            <span class="spec-label">Mileage</span>
                                            <span
                                                class="spec-value"><?= !empty($mileage) ? esc($mileage) . ' kmpl' : '—' ?></span>
                                        </div>
                                        <div class="spec-row">
                                            <span class="spec-label">Seating</span>
                                            <span class="spec-value"><?= esc($seating) ?> Seats</span>
                                        </div>
                                    </div>

                                    <a href="<?= base_url('cars/features/detail/' . ($car['vehicle_id'] ?? 0)) ?>"
                                        class="btn-primary">
                                        Explore Features
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <h3>No feature-rich vehicles found</h3>
                        <p class="muted">Try switching categories or clearing your filters.</p>
                    </div>
                <?php endif; ?>
            </section>

            <div class="load-more-section">
                <button id="loadMore" class="btn-primary" type="button">
                    <span class="spinner-border d-none"></span>
                    Load More Cars
                </button>
            </div>
        </div>
    </main>

    <script>
        let allCars = <?= json_encode($vehicles ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
        let currentPage = 1;
        const loadMoreUrl = "<?= site_url('features/loadMore') ?>";

        document.addEventListener('DOMContentLoaded', function () {
            initScrollAnimations();
            window.addEventListener('scroll', initScrollAnimations);

            document.getElementById('featureSearch')?.addEventListener('input', debounce(filterCars, 250));
            document.getElementById('fuelFilter')?.addEventListener('change', filterCars);
            document.getElementById('bodyFilter')?.addEventListener('change', filterCars);

            const carsGrid = document.getElementById('carsGrid');
            const gridBtn = document.getElementById('gridViewBtn');
            const listBtn = document.getElementById('listViewBtn');

            carsGrid?.classList.add('grid-view');

            gridBtn?.addEventListener('click', function () {
                carsGrid.classList.remove('list-view');
                carsGrid.classList.add('grid-view');
                gridBtn.classList.add('active');
                listBtn.classList.remove('active');
            });

            listBtn?.addEventListener('click', function () {
                carsGrid.classList.remove('grid-view');
                carsGrid.classList.add('list-view');
                listBtn.classList.add('active');
                gridBtn.classList.remove('active');
            });

            document.getElementById('loadMore')?.addEventListener('click', loadMoreCars);

            filterCars();
        });

        function initScrollAnimations() {
            document.querySelectorAll('.fade-in-up').forEach((el, index) => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight * 0.9) {
                    el.style.animationDelay = `${index * 0.05}s`;
                    el.style.opacity = '1';
                }
            });
        }

        function debounce(func, wait) {
            let timeout;
            return (...args) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        function filterCars() {
            const search = (document.getElementById('featureSearch')?.value || '').toLowerCase().trim();
            const fuel = document.getElementById('fuelFilter')?.value || '';
            const body = document.getElementById('bodyFilter')?.value || '';

            const filtered = allCars.filter(car => {
                const make = (car.make || '').toLowerCase();
                const model = (car.model || '').toLowerCase();
                const variant = (car.variant || '').toLowerCase();

                const matchesSearch = !search || make.includes(search) || model.includes(search) || variant.includes(search);
                const matchesFuel = !fuel || (car.fuel_type || '') === fuel;
                const matchesBody = !body || (car.body_type || '') === body;

                return matchesSearch && matchesFuel && matchesBody;
            });

            renderCars(filtered);
            updateStats(filtered.length);
        }

        function renderCars(cars) {
            const grid = document.getElementById('carsGrid');
            if (!grid) return;

            if (!cars.length) {
                grid.innerHTML = `
          <div class="empty-state">
            <h3>No matching vehicles</h3>
            <p class="muted">Adjust your search or filter combination.</p>
          </div>
        `;
                return;
            }

            grid.innerHTML = cars.map((car, index) => createFeatureCard(car, index)).join('');
            setTimeout(initScrollAnimations, 80);
        }

        function createFeatureCard(car, index) {
            const price = car.ex_showroom_price ? `₹${Number(car.ex_showroom_price).toLocaleString()}` : 'Price N/A';
            const tags = [];
            if (car.safety_features && hasContent(car.safety_features)) tags.push('Safety');
            if (car.infotainment && hasContent(car.infotainment)) tags.push('Infotainment');
            if (car.comfort_features && hasContent(car.comfort_features)) tags.push('Comfort');
            if (car.interior_features && hasContent(car.interior_features)) tags.push('Interior');
            if (car.exterior_features && hasContent(car.exterior_features)) tags.push('Exterior');
            if (car.camera_features && hasContent(car.camera_features)) tags.push('Camera');

            return `
        <article class="car-card-wrapper fade-in-up"
                 data-make="${escapeHtml((car.make || '').toLowerCase())}"
                 data-model="${escapeHtml((car.model || '').toLowerCase())}"
                 data-fuel="${escapeHtml(car.fuel_type || '')}"
                 data-body="${escapeHtml(car.body_type || '')}"
                 style="animation-delay:${index * 0.06}s">
          <div class="car-card hover-lift">
            <div class="car-image">
              <div class="car-badges">
                ${car.ncap_rating ? `<span class="pill badge-soft">★ ${escapeHtml(car.ncap_rating)} NCAP</span>` : ''}
                ${tags.length ? `<span class="pill badge-soft">${tags.length} Feature Sets</span>` : ''}
              </div>

              <div class="feature-visual transition-scale" aria-hidden="true">
                <svg viewBox="0 0 420 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M72 107C80 82 98 64 127 55L193 35C214 29 238 29 259 35L314 50C331 55 346 66 355 82L371 107C375 114 370 123 362 123H81C74 123 69 114 72 107Z" fill="rgba(255,255,255,.88)"/>
                  <circle cx="126" cy="122" r="21" fill="#1b1b1b"/>
                  <circle cx="314" cy="122" r="21" fill="#1b1b1b"/>
                  <circle cx="126" cy="122" r="10" fill="#c94f2d"/>
                  <circle cx="314" cy="122" r="10" fill="#f2b84b"/>
                  <path d="M138 59H258C282 59 300 70 311 91H115C120 72 127 59 138 59Z" fill="rgba(31,107,92,.55)"/>
                  <path d="M194 43L228 43" stroke="#fff" stroke-width="6" stroke-linecap="round"/>
                </svg>
              </div>

              <div class="price-badge">
                <div class="price-value">${price}</div>
                <small>Ex-Showroom</small>
              </div>

              <div class="image-overlay">
                <a href="<?= base_url('cars/features/detail') ?>/${car.vehicle_id}" class="btn-ghost">Quick View</a>
              </div>
            </div>

            <div class="car-details">
              <div class="car-header">
                <div class="car-brand">${escapeHtml(car.make || '')}</div>
                <h3 class="car-model">${escapeHtml(car.model || '')}</h3>
                <div class="car-category">${escapeHtml(car.body_type || 'Vehicle')}</div>
              </div>

              ${car.variant ? `<div class="car-variant">${escapeHtml(car.variant)}</div>` : ''}

              ${tags.length ? `
                <div class="feature-tags">
                  ${tags.slice(0, 4).map(tag => `<span class="feature-tag">${escapeHtml(tag)}</span>`).join('')}
                </div>` : ''}

              <div class="car-specs">
                <div class="spec-row">
                  <span class="spec-label">Fuel</span>
                  <span class="spec-value">${escapeHtml(car.fuel_type || '—')}</span>
                </div>
                <div class="spec-row">
                  <span class="spec-label">Transmission</span>
                  <span class="spec-value">${escapeHtml(car.transmission || '—')}</span>
                </div>
                <div class="spec-row">
                  <span class="spec-label">Mileage</span>
                  <span class="spec-value">${car.mileage_kmpl ? `${escapeHtml(String(car.mileage_kmpl))} kmpl` : '—'}</span>
                </div>
                <div class="spec-row">
                  <span class="spec-label">Seating</span>
                  <span class="spec-value">${escapeHtml(String(car.seating_capacity || 5))} Seats</span>
                </div>
              </div>

              <a href="<?= base_url('cars/features/detail') ?>/${car.vehicle_id}" class="btn-primary">
                Explore Features
              </a>
            </div>
          </div>
        </article>
      `;
        }

        function updateStats(count) {
            const statsEl = document.querySelector('.section-stats .text-danger');
            if (statsEl) statsEl.textContent = count + '';
        }

        function hasContent(value) {
            if (Array.isArray(value)) return value.length > 0;
            if (typeof value === 'string') return value.trim() !== '' && value.trim() !== '[]';
            if (value && typeof value === 'object') return Object.keys(value).length > 0;
            return false;
        }

        function escapeHtml(str) {
            return String(str)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function loadMoreCars() {
            const btn = document.getElementById('loadMore');
            if (!btn) return;

            const spinner = btn.querySelector('.spinner-border');
            spinner?.classList.remove('d-none');
            btn.disabled = true;
            currentPage++;

            fetch(`${loadMoreUrl}?page[features]=${currentPage}`)
                .then(res => res.json())
                .then(data => {
                    spinner?.classList.add('d-none');
                    btn.disabled = false;

                    const incoming = Array.isArray(data.vehicles) ? data.vehicles : Object.values(data.vehicles || {});
                    if (!incoming.length) {
                        btn.style.display = 'none';
                        return;
                    }

                    allCars = [...allCars, ...incoming];
                    filterCars();

                    if (!data.hasMore) {
                        btn.style.display = 'none';
                    }
                })
                .catch(() => {
                    spinner?.classList.add('d-none');
                    btn.disabled = false;
                });
        }
    </script>