<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: #f5f7fb;
    }

    /* premium root variables */
    :root {
        --primary: #3b82f6;
        --primary-dark: #1e40af;
        --primary-light: #eff6ff;
        --secondary: #8b5cf6;
        --dark: #0f172a;
        --dark-light: #1e293b;
        --gray: #64748b;
        --gray-light: #f1f5f9;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --white: #ffffff;
        --gradient-hero: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
        --gradient-primary: linear-gradient(135deg, #3b82f6, #2563eb, #1d4ed8);
        --gradient-gold: linear-gradient(135deg, #fbbf24, #f59e0b, #d97706);
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .cars-list-container {
        background: linear-gradient(180deg, #f5f7fb 0%, #f0f4f8 100%);
        min-height: 100vh;
    }

    /* ========= PREMIUM HERO SECTION ========= */
    .cars-hero {
        background: var(--gradient-hero);
        position: relative;
        isolation: isolate;
        overflow: hidden;
    }

    .cars-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 800'%3E%3Cpath fill='%233b82f6' fill-opacity='0.05' d='M0,0 L1200,0 L1200,800 L0,800 Z M200,200 L400,200 L400,400 L200,400 Z M700,500 L900,500 L900,700 L700,700 Z'/%3E%3C/svg%3E");
        background-repeat: repeat;
        background-size: 60px;
        pointer-events: none;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .hero-title {
        font-weight: 800;
        letter-spacing: -0.02em;
        color: white;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .gradient-text {
        background: var(--gradient-gold);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        position: relative;
        display: inline-block;
    }

    .hero-lead {
        color: rgba(255, 255, 255, 0.85) !important;
        font-weight: 500;
        line-height: 1.6;
    }

    .hero-subtitle .badge {
        background: rgba(59, 130, 246, 0.9);
        backdrop-filter: blur(8px);
        font-weight: 600;
        border: 1px solid rgba(251, 191, 36, 0.4);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .btn-warning {
        background: var(--gradient-gold);
        border: none;
        color: var(--dark);
        font-weight: 700;
        transition: var(--transition);
        box-shadow: var(--shadow-md);
    }

    .btn-warning:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
        filter: brightness(1.05);
    }

    .btn-outline-light {
        border: 2px solid rgba(255, 255, 255, 0.5);
        color: white;
        background: transparent;
        backdrop-filter: blur(4px);
        transition: var(--transition);
    }

    .btn-outline-light:hover {
        background: white;
        color: var(--dark);
        border-color: white;
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }

    /* ========= FILTER BAR ========= */
    .filter-bar {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        box-shadow: var(--shadow-md);
        /* position: sticky;
        top: 0;
        z-index: 1030; */
    }

    .form-control,
    .form-select {
        border-radius: 60px;
        border: 1px solid #e2e8f0;
        padding: 0.7rem 1.2rem;
        font-weight: 500;
        font-size: 0.9rem;
        transition: var(--transition);
        background: var(--white);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        transform: translateY(-2px);
    }

    .btn-primary {
        background: var(--gradient-primary);
        border: none;
        border-radius: 60px;
        font-weight: 600;
        letter-spacing: 0.3px;
        transition: var(--transition);
        box-shadow: var(--shadow-md);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
        background: var(--gradient-primary);
        filter: brightness(1.05);
    }

    /* ========= CATEGORY TABS ========= */
    .category-nav {
        background: var(--white);
        border-bottom: 1px solid #e2e8f0;
        position: relative;
        z-index: 10;
    }

    .category-tabs .nav-link {
        background: var(--gray-light);
        border-radius: 60px;
        padding: 0.7rem 1.8rem;
        font-weight: 600;
        color: var(--dark-light);
        transition: var(--transition);
        border: none;
        font-size: 0.9rem;
    }

    .category-tabs .nav-link i {
        margin-right: 8px;
        font-size: 1rem;
    }

    .category-tabs .nav-link.active {
        background: var(--gradient-primary);
        color: white;
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    .category-tabs .nav-link:hover:not(.active) {
        background: var(--white);
        color: var(--primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    /* ========= CAR CARDS ========= */
    .car-card {
        background: var(--white);
        transition: var(--transition);
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(0, 0, 0, 0.04);
        position: relative;
    }

    .car-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient-primary);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
        z-index: 10;
    }

    .car-card:hover::before {
        transform: scaleX(1);
    }

    .car-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-2xl);
    }

    .car-image {
        height: 220px;
        background: var(--gray-light);
        position: relative;
        overflow: hidden;
    }

    .car-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .car-card:hover .car-image img {
        transform: scale(1.08);
    }

    .price-badge {
        background: linear-gradient(135deg, var(--dark), var(--dark-light));
        border-radius: 20px;
        padding: 0.5rem 1rem;
        left: 1rem;
        bottom: 1rem;
        backdrop-filter: blur(8px);
        border-left: 3px solid var(--warning);
        box-shadow: var(--shadow-md);
    }

    .price-value {
        color: var(--warning);
        font-weight: 800;
    }

    .car-badges {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        z-index: 5;
    }

    .car-badges .badge {
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.4rem 0.9rem;
        backdrop-filter: blur(8px);
        background: rgba(0, 0, 0, 0.75);
        color: white;
        border-radius: 40px;
    }

    .image-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 5;
    }

    .car-card:hover .image-overlay {
        opacity: 1;
    }

    .car-details {
        padding: 1.25rem;
    }

    .car-brand {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--primary);
        font-weight: 700;
    }

    .car-model {
        font-size: 1.3rem;
        font-weight: 800;
        line-height: 1.3;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .car-category {
        background: var(--primary-light);
        color: var(--primary);
        font-weight: 600;
        font-size: 0.7rem;
        padding: 0.25rem 0.75rem;
        border-radius: 40px;
        display: inline-block;
    }

    .car-specs {
        margin: 1rem 0;
    }

    .spec-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.6rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .spec-label {
        color: var(--gray);
        font-size: 0.8rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .spec-value {
        color: var(--dark);
        font-weight: 700;
        font-size: 0.85rem;
    }

    .car-actions .btn-primary {
        border-radius: 40px;
        padding: 0.7rem;
        font-size: 0.85rem;
        font-weight: 600;
        width: 100%;
        margin-bottom: 0.75rem;
    }

    .secondary-actions {
        display: flex;
        gap: 0.5rem;
    }

    .secondary-actions .btn-outline-secondary {
        border-radius: 40px;
        padding: 0.4rem;
        font-size: 0.8rem;
        flex: 1;
        transition: var(--transition);
    }

    /* ========= LIST VIEW ========= */
    .cars-grid.list-view .car-card-wrapper {
        max-width: 100%;
        flex: 0 0 100%;
    }

    .cars-grid.list-view .car-card {
        display: flex;
        flex-direction: row;
        align-items: stretch;
    }

    .cars-grid.list-view .car-image {
        width: 280px;
        min-width: 280px;
        height: auto;
    }

    @media (max-width: 768px) {
        .cars-grid.list-view .car-card {
            flex-direction: column;
        }
        .cars-grid.list-view .car-image {
            width: 100%;
            height: 220px;
        }
    }

    /* ========= ANIMATIONS ========= */
    .fade-in-up {
        opacity: 0;
        transform: translateY(30px);
        animation: premiumFadeUp 0.6s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
    }

    @keyframes premiumFadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ========= LOAD MORE BUTTON ========= */
    #loadMoreBtn {
        border-radius: 60px;
        font-weight: 700;
        background: var(--white);
        border: 2px solid var(--primary);
        color: var(--primary);
        transition: var(--transition);
        padding: 0.75rem 2rem;
    }

    #loadMoreBtn:hover {
        background: var(--gradient-primary);
        color: var(--white);
        transform: translateY(-3px);
        box-shadow: var(--shadow-xl);
        border-color: transparent;
    }

    #loadMoreBtn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    /* ========= RESULTS FOOTER ========= */
    .results-footer {
        border-top: 1px solid #e2e8f0;
        padding-top: 2rem;
    }

    .results-info {
        font-weight: 500;
        color: var(--gray);
        background: var(--white);
        padding: 0.75rem 1.25rem;
        border-radius: 60px;
        display: inline-block;
        box-shadow: var(--shadow-sm);
    }

    .view-toggle .btn-outline-secondary {
        border-radius: 40px;
        padding: 0.5rem 1.2rem;
        font-size: 0.85rem;
        transition: var(--transition);
    }

    .view-toggle .btn-outline-secondary.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* ========= RESPONSIVE ========= */
    @media (max-width: 992px) {
        .hero-title {
            font-size: 2.5rem !important;
        }
    }

    @media (max-width: 768px) {
        .filter-bar .row > div {
            margin-bottom: 0.75rem;
        }
        .category-tabs {
            flex-wrap: wrap;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 1.8rem !important;
        }
        .car-model {
            font-size: 1.1rem;
        }
    }
</style>

<div class="cars-list-container">
    <!-- HERO HEADER -->
    <section class="cars-hero position-relative overflow-hidden">
        <div class="hero-bg"></div>
        <div class="container position-relative z-2 py-5">
            <div class="row align-items-center py-4">
                <div class="col-lg-8">
                    <h1 class="hero-title display-4 fw-bold mb-3 lh-1">
                        Discover Your
                        <span class="gradient-text">Perfect Car</span>
                        <div class="hero-subtitle mt-3">
                            <span class="text-white-75 fs-5 fw-semibold"><?= $stats['total_cars'] ?> premium models</span>
                            <?php if ($current_category): ?>
                                <span class="badge ms-2 fs-6 px-3 py-2 rounded-pill fw-semibold">
                                    <?= esc($current_category) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </h1>
                    <p class="hero-lead fs-5 mb-4 lh-lg">
                        Compare prices, mileage, features & safety ratings.
                        <strong>Find your dream car today!</strong>
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="<?= site_url('cars/price-low') ?>" class="btn btn-warning btn-lg shadow-lg px-5 rounded-pill fw-bold">
                            <i class="bi bi-arrow-down-circle me-2"></i> Cheapest First
                        </a>
                        <a href="<?= site_url('cars/price-high') ?>" class="btn btn-outline-light btn-lg px-5 rounded-pill fw-semibold">
                            <i class="bi bi-arrow-up-circle me-2"></i> Luxury Cars
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <div class="bg-white/10 rounded-4 p-4 backdrop-blur-sm border border-white/20">
                        <div class="d-flex align-items-center justify-content-lg-end gap-3">
                            <i class="bi bi-shield-check fs-1 text-warning"></i>
                            <div class="text-start text-lg-end">
                                <span class="text-white fw-bold d-block">Trusted by 50k+ drivers</span>
                                <small class="text-white-75">Verified listings</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FILTER BAR -->
    <section class="filter-bar py-4">
        <div class="container">
            <div class="row align-items-end g-3">
                <div class="col-lg-3 col-md-6">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-transparent border-0 ps-0 pe-1">
                            <i class="bi bi-search text-muted fs-5"></i>
                        </span>
                        <input type="text" class="form-control border-0 shadow-none fs-6 fw-medium ps-2"
                            placeholder="Search Swift, SUV, Maruti..." id="carSearch">
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="row g-2">
                        <div class="col-sm-4">
                            <select class="form-select filter-select" id="fuelFilter">
                                <option value="">All Fuels</option>
                                <option value="Petrol">⛽ Petrol</option>
                                <option value="Diesel">⬛ Diesel</option>
                                <option value="CNG">🟢 CNG</option>
                                <option value="Electric">⚡ Electric</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-select filter-select" id="bodyFilter">
                                <option value="">All Types</option>
                                <?php foreach ($categories ?? [] as $cat): ?>
                                    <option value="<?= esc($cat) ?>" <?= $current_category === $cat ? 'selected' : '' ?>>
                                        <?= esc($cat) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-select filter-select" id="sortFilter" onchange="sortCars(this.value)">
                                <option value="">Sort By</option>
                                <option value="price-low" <?= $current_sort === 'price-low' ? 'selected' : '' ?>>💰 Low Price</option>
                                <option value="price-high" <?= $current_sort === 'price-high' ? 'selected' : '' ?>>💎 Luxury</option>
                                <option value="mileage">⛽ Best Mileage</option>
                                <option value="make">🔤 A-Z Brands</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg shadow-sm rounded-pill" onclick="applyFilters()">
                            <i class="bi bi-funnel-fill me-2"></i>
                            Apply Filters
                        </button>
                        <small class="text-center mt-1 text-muted">Live filtering</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CATEGORY TABS -->
    <section class="category-nav py-4">
        <div class="container">
            <ul class="nav nav-pills category-tabs justify-content-center flex-wrap gap-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active shadow-sm px-4 py-3 rounded-pill fw-semibold" href="<?= site_url('cars') ?>">
                        <i class="bi bi-grid-3x3-gap me-2"></i>All Cars
                        <span class="badge rounded-pill bg-primary ms-2 text-white"><?= $stats['total_cars'] ?></span>
                    </a>
                </li>
                <?php
                $mainCategories = ['Hatchback', 'Sedan', 'SUV', 'MPV'];
                foreach ($mainCategories as $cat):
                    $count = rand(8, 35);
                    ?>
                    <li class="nav-item">
                        <a class="nav-link shadow-sm px-4 py-3 rounded-pill fw-semibold" href="<?= site_url('cars/category/' . $cat) ?>" data-bs-toggle="tooltip" title="<?= $cat ?> Cars">
                            <i class="bi bi-car-front me-1"></i><?= $cat ?>
                            <span class="badge rounded-pill bg-success ms-1"><?= $count ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- CARS GRID -->
    <section class="cars-section py-5">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-md-6">
                    <div class="section-info">
                        <h2 class="section-title fw-bold mb-1 fs-2">
                            <?= $current_category ? esc($current_category) . ' Cars' : 'Latest Models' ?>
                        </h2>
                        <div class="section-stats d-flex align-items-center gap-3 fs-6">
                            <span><i class="bi bi-clock-history me-1"></i>Updated Today</span>
                            <span><i class="bi bi-fire me-1 text-danger"></i><span id="carsCountDisplay"><?= count($cars) ?></span> Available</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <div class="view-toggle d-inline-flex gap-2">
                        <button class="btn btn-outline-secondary btn-sm active rounded-pill px-3" id="gridViewBtn">
                            <i class="bi bi-grid-3x3-gap-fill"></i> Grid
                        </button>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" id="listViewBtn">
                            <i class="bi bi-list-ul"></i> List
                        </button>
                    </div>
                </div>
            </div>

            <div class="cars-grid row g-4" id="carsGrid"></div>

            <div class="results-footer mt-5 pt-5">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="results-info">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Showing <strong id="showingCount">0</strong> of <strong id="totalCarsCount"><?= count($cars) ?></strong> cars
                            <?= $current_sort ? ' | Sorted by ' . ucfirst(str_replace('-', ' ', $current_sort)) : '' ?>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <div class="load-more-section">
                            <button class="btn btn-outline-primary btn-lg px-5 rounded-pill shadow-lg" id="loadMoreBtn">
                                <i class="bi bi-plus-circle me-2"></i>Load More Cars
                                <span class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Base URL for AJAX calls
    const baseUrl = '<?= base_url() ?>';
    let currentPage = 1;
    let isLoading = false;
    let hasMore = true;
    let totalCars = <?= $stats['total_cars'] ?? 0 ?>;
    let currentFilters = {
        sort: '<?= $current_sort ?? '' ?>',
        fuel: '<?= $current_fuel ?? '' ?>',
        body: '<?= $current_body ?? '' ?>',
        search: '<?= $current_search ?? '' ?>'
    };

    function escapeHtml(str) { 
        if (!str) return ''; 
        return str.replace(/[&<>]/g, function(m) { 
            if (m === '&') return '&amp;'; 
            if (m === '<') return '&lt;'; 
            if (m === '>') return '&gt;'; 
            return m; 
        }); 
    }

    function renderCarCard(car, index) {
        const make = car.make ?? '';
        const model = car.model ?? '';
        const variant = car.variant ?? '';
        const bodyType = car.body_type ?? '';
        const fuelType = car.fuel_type ?? '';
        const transmission = car.transmission ?? '';
        const mileageVal = car.mileage_kmpl ?? '';
        const priceNum = Number(car.ex_showroom_price || 0);
        const priceFormatted = priceNum.toLocaleString();
        const ratingBadge = car.ncap_rating ? `<span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-star-fill me-1"></i>${car.ncap_rating}</span>` : '';
        const evBadge = (fuelType && fuelType.toLowerCase().includes('electric')) ? `<span class="badge bg-success px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-lightning-charge me-1"></i>EV</span>` : '';
        const atBadge = (transmission === 'Automatic') ? `<span class="badge bg-info px-3 py-2 rounded-pill shadow-sm">AT</span>` : '';
        const mileageDisplay = mileageVal ? `${mileageVal} kmpl` : '—';
        const seating = car.seating_capacity ?? 5;
        const carSlug = car.slug || `${make.toLowerCase()}-${model.toLowerCase()}`.replace(/\s+/g, '-');
        
        return `<div class="col-xl-3 col-lg-4 col-md-6 car-card-wrapper fade-in-up" style="animation-delay:${(index % 12) * 0.04}s">
                    <div class="car-card">
                        <div class="car-image">
                            <img src="${car.image_url || '/public/images/no-car.jpg'}" alt="${escapeHtml(make + ' ' + model)}" onerror="this.src='/public/images/no-car.jpg'">
                            <div class="car-badges">${ratingBadge} ${evBadge} ${atBadge}</div>
                            <div class="price-badge position-absolute start-0 bottom-0 text-white shadow-lg px-4 py-3 rounded-4 m-2">
                                <div class="price-value h4 mb-0 fw-bold fs-4 lh-1">₹${priceFormatted}</div>
                                <small class="opacity-75">Ex-Showroom</small>
                            </div>
                            <div class="image-overlay">
                                <a href="${baseUrl}car/${carSlug}" class="btn btn-light btn-sm rounded-pill shadow"><i class="bi bi-eye"></i> Quick View</a>
                            </div>
                        </div>
                        <div class="car-details p-3">
                            <div class="car-header mb-2">
                                <h5 class="car-brand text-primary fw-bold mb-0">${escapeHtml(make)}</h5>
                                <h4 class="car-model fw-bold">${escapeHtml(model)}</h4>
                                <span class="car-category badge bg-light border">${escapeHtml(bodyType || 'Vehicle')}</span>
                            </div>
                            ${variant ? `<div class="text-muted small mb-2">${escapeHtml(variant)}</div>` : ''}
                            <div class="car-specs mb-3">
                                <div class="spec-row d-flex justify-content-between py-2 border-bottom"><span class="spec-label"><i class="bi bi-speedometer2"></i> Mileage</span><span class="spec-value fw-bold">${mileageDisplay}</span></div>
                                <div class="spec-row d-flex justify-content-between py-2 border-bottom"><span class="spec-label"><i class="bi bi-gear-wide"></i> Transmission</span><span class="spec-value fw-bold">${escapeHtml(transmission)}</span></div>
                                <div class="spec-row d-flex justify-content-between py-2"><span class="spec-label"><i class="bi bi-people"></i> Seating</span><span class="spec-value fw-bold">${seating} Seats</span></div>
                            </div>
                            <div class="car-actions">
                                <a href="${baseUrl}car/${carSlug}" class="btn btn-primary w-100 rounded-pill mb-2"><i class="bi bi-arrow-right-circle me-2"></i>Explore Details</a>
                                <div class="secondary-actions d-flex gap-2">
                                    <button class="btn btn-outline-secondary btn-sm flex-fill rounded-pill" onclick="event.preventDefault(); alert('Save feature coming soon!')"><i class="bi bi-heart"></i> Save</button>
                                    <button class="btn btn-outline-secondary btn-sm flex-fill rounded-pill" onclick="event.preventDefault(); alert('Share feature coming soon!')"><i class="bi bi-share"></i> Share</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
    }

    function loadMoreCars() {
        if (isLoading || !hasMore) {
            console.log('Load more blocked: isLoading=' + isLoading + ', hasMore=' + hasMore);
            return;
        }
        
        isLoading = true;
        const loadBtn = document.getElementById('loadMoreBtn');
        const spinner = loadBtn?.querySelector('.spinner-border');
        
        if (spinner) spinner.classList.remove('d-none');
        if (loadBtn) loadBtn.disabled = true;
        
        const nextPage = currentPage + 1;
        let url = `${baseUrl}/ajax/loadMore?page=${nextPage}&limit=8`;
        
        if (currentFilters.sort) url += `&sort=${encodeURIComponent(currentFilters.sort)}`;
        if (currentFilters.fuel) url += `&fuel=${encodeURIComponent(currentFilters.fuel)}`;
        if (currentFilters.body) url += `&body=${encodeURIComponent(currentFilters.body)}`;
        if (currentFilters.search) url += `&search=${encodeURIComponent(currentFilters.search)}`;
        
        console.log('Fetching URL:', url);
        
        fetch(url)
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success && data.cars && data.cars.length > 0) {
                    const grid = document.getElementById('carsGrid');
                    const newCarsHtml = data.cars.map((car, idx) => renderCarCard(car, idx)).join('');
                    grid.insertAdjacentHTML('beforeend', newCarsHtml);
                    
                    currentPage = nextPage;
                    hasMore = data.hasMore;
                    totalCars = data.total;
                    
                    const showingCount = document.getElementById('showingCount');
                    if (showingCount) {
                        const currentShowing = parseInt(showingCount.innerText) || 0;
                        showingCount.innerText = currentShowing + data.cars.length;
                    }
                } else {
                    hasMore = false;
                    console.log('No more cars or error:', data);
                }
                
                if (!hasMore && loadBtn) {
                    loadBtn.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error loading more cars:', error);
                const grid = document.getElementById('carsGrid');
                if (grid) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'col-12 text-center py-3';
                    errorDiv.innerHTML = '<p class="text-danger">Error loading more cars. Please try again.</p>';
                    grid.appendChild(errorDiv);
                    setTimeout(() => errorDiv.remove(), 3000);
                }
            })
            .finally(() => {
                if (spinner) spinner.classList.add('d-none');
                if (loadBtn) {
                    loadBtn.disabled = false;
                    loadBtn.innerHTML = '<i class="bi bi-plus-circle me-2"></i>Load More Cars<span class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>';
                }
                isLoading = false;
            });
    }

    function filterAndSortCars() {
        currentFilters.search = document.getElementById('carSearch')?.value || '';
        currentFilters.fuel = document.getElementById('fuelFilter')?.value || '';
        currentFilters.body = document.getElementById('bodyFilter')?.value || '';
        currentFilters.sort = document.getElementById('sortFilter')?.value || '';
        
        currentPage = 1;
        hasMore = true;
        
        let url = `${baseUrl}/ajax/loadMore?page=1&limit=12`;
        if (currentFilters.sort) url += `&sort=${encodeURIComponent(currentFilters.sort)}`;
        if (currentFilters.fuel) url += `&fuel=${encodeURIComponent(currentFilters.fuel)}`;
        if (currentFilters.body) url += `&body=${encodeURIComponent(currentFilters.body)}`;
        if (currentFilters.search) url += `&search=${encodeURIComponent(currentFilters.search)}`;
        
        const grid = document.getElementById('carsGrid');
        if (grid) grid.innerHTML = '<div class="col-12 text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.cars && data.cars.length > 0) {
                    const carsHtml = data.cars.map((car, idx) => renderCarCard(car, idx)).join('');
                    if (grid) grid.innerHTML = carsHtml;
                    
                    hasMore = data.hasMore;
                    totalCars = data.total;
                    
                    document.getElementById('showingCount').innerText = data.cars.length;
                    document.getElementById('carsCountDisplay').innerText = totalCars;
                    document.getElementById('totalCarsCount').innerText = totalCars;
                    
                    const loadBtn = document.getElementById('loadMoreBtn');
                    if (loadBtn) {
                        loadBtn.style.display = hasMore ? 'inline-flex' : 'none';
                        loadBtn.disabled = false;
                    }
                } else {
                    if (grid) grid.innerHTML = '<div class="col-12 text-center py-5"><p class="text-muted">No cars found matching your criteria.</p></div>';
                    document.getElementById('showingCount').innerText = 0;
                    document.getElementById('carsCountDisplay').innerText = 0;
                    document.getElementById('totalCarsCount').innerText = 0;
                    const loadBtn = document.getElementById('loadMoreBtn');
                    if (loadBtn) loadBtn.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error filtering cars:', error);
                if (grid) grid.innerHTML = '<div class="col-12 text-center py-5"><p class="text-danger">Error loading cars. Please refresh the page and try again.</p></div>';
            });
    }

    function sortCars(value) {
        currentFilters.sort = value;
        filterAndSortCars();
    }
    
    function applyFilters() {
        filterAndSortCars();
    }

    function initViewToggle() {
        const gridBtn = document.getElementById('gridViewBtn');
        const listBtn = document.getElementById('listViewBtn');
        const carsGrid = document.getElementById('carsGrid');
        
        if (gridBtn && listBtn && carsGrid) {
            carsGrid.classList.add('grid-view');
            gridBtn.classList.add('active');
            
            gridBtn.onclick = () => {
                carsGrid.classList.remove('list-view');
                carsGrid.classList.add('grid-view');
                gridBtn.classList.add('active');
                listBtn.classList.remove('active');
                document.querySelectorAll('.car-card-wrapper').forEach(c => {
                    c.classList.remove('col-12');
                    c.classList.add('col-xl-3', 'col-lg-4', 'col-md-6');
                });
            };
            
            listBtn.onclick = () => {
                carsGrid.classList.remove('grid-view');
                carsGrid.classList.add('list-view');
                listBtn.classList.add('active');
                gridBtn.classList.remove('active');
                document.querySelectorAll('.car-card-wrapper').forEach(c => {
                    c.classList.remove('col-xl-3', 'col-lg-4', 'col-md-6');
                    c.classList.add('col-12');
                });
            };
        }
    }

    // Initial cars data from PHP
    const initialCars = <?= json_encode($cars) ?>;
    
    document.addEventListener('DOMContentLoaded', function() {
        const grid = document.getElementById('carsGrid');
        if (grid && initialCars && initialCars.length > 0) {
            const carsHtml = initialCars.map((car, idx) => renderCarCard(car, idx)).join('');
            grid.innerHTML = carsHtml;
            document.getElementById('showingCount').innerText = initialCars.length;
            document.getElementById('carsCountDisplay').innerText = <?= $stats['total_cars'] ?? 0 ?>;
            document.getElementById('totalCarsCount').innerText = <?= $stats['total_cars'] ?? 0 ?>;
            
            const loadBtn = document.getElementById('loadMoreBtn');
            if (loadBtn && initialCars.length >= <?= $stats['total_cars'] ?? 0 ?>) {
                loadBtn.style.display = 'none';
            }
        }
        
        initViewToggle();
        
        document.getElementById('carSearch')?.addEventListener('input', () => filterAndSortCars());
        document.getElementById('fuelFilter')?.addEventListener('change', () => filterAndSortCars());
        document.getElementById('bodyFilter')?.addEventListener('change', () => filterAndSortCars());
        
        const loadBtn = document.getElementById('loadMoreBtn');
        if (loadBtn) loadBtn.addEventListener('click', loadMoreCars);
        
        // Initialize tooltips
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
        }
    });
</script>