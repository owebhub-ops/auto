<!-- app/Views/pages/cars/list.php - PREMIUM UI UPGRADE -->
<div class="cars-list-container">
    <!-- 🎨 Enhanced Hero Header -->
    <section class="cars-hero position-relative overflow-hidden">
        <div class="hero-bg"></div>
        <div class="container position-relative z-2">
            <div class="row align-items-center py-5">
                <div class="col-lg-8">
                    <h1 class="hero-title display-4 fw-bold mb-3 lh-1">
                        Discover Your
                        <span class="gradient-text">Perfect Car</span>
                        <div class="hero-subtitle">
                            <?= $stats['total_cars'] ?> Models | Updated May 2026
                            <?php if ($current_category): ?>
                                <span
                                    class="badge bg-gradient-warning text-dark ms-2 fs-6 px-3 py-2 rounded-pill fw-semibold">
                                    <?= esc($current_category) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </h1>
                    <p class="hero-lead fs-5 text-white-75 mb-4 lh-lg">
                        Compare prices, mileage, features & safety ratings.
                        <strong>Find your dream car today!</strong>
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end text-start">
                    <div class="quick-actions d-flex flex-column gap-2">
                        <a href="<?= site_url('cars/price-low') ?>" class="btn btn-warning btn-lg shadow-lg px-4">
                            <i class="bi bi-arrow-down-circle me-2"></i>
                            Cheapest First
                        </a>
                        <a href="<?= site_url('cars/price-high') ?>" class="btn btn-outline-light btn-lg px-4">
                            <i class="bi bi-arrow-up-circle me-2"></i>
                            Luxury Cars
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 🔍 Smart Filter Bar -->
    <section class="filter-bar py-4 bg-white shadow-sm">
        <div class="container">
            <div class="row align-items-end g-3">
                <!-- Live Search -->
                <div class="col-lg-3 col-md-6">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-transparent border-0 ps-0">
                            <i class="bi bi-search text-muted fs-5"></i>
                        </span>
                        <input type="text" class="form-control border-0 shadow-none fs-6 fw-medium"
                            placeholder="Search Maruti, Swift, SUV..." id="carSearch">
                    </div>
                </div>

                <!-- Filters -->
                <div class="col-lg-7 col-md-6">
                    <div class="row g-2">
                        <div class="col-sm-4">
                            <select class="form-select form-select-lg filter-select" id="fuelFilter">
                                <option value="">All Fuels</option>
                                <option value="Petrol">⛽ Petrol</option>
                                <option value="Diesel">⬛ Diesel</option>
                                <option value="CNG">🟢 CNG</option>
                                <option value="Electric">⚡ Electric</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-select form-select-lg filter-select" id="bodyFilter">
                                <option value="">All Types</option>
                                <?php foreach ($categories ?? [] as $cat): ?>
                                    <option value="<?= esc($cat) ?>" <?= $current_category === $cat ? 'selected' : '' ?>>
                                        <?= esc($cat) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-select form-select-lg filter-select" id="sortFilter"
                                onchange="sortCars(this.value)">
                                <option value="">Sort By</option>
                                <option value="price-low" <?= $current_sort === 'price-low' ? 'selected' : '' ?>>💰 Low
                                    Price</option>
                                <option value="price-high" <?= $current_sort === 'price-high' ? 'selected' : '' ?>>💎
                                    Luxury</option>
                                <option value="mileage">⛽ Best Mileage</option>
                                <option value="make">🔤 A-Z Brands</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="col-lg-2 col-md-6">
                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg shadow-lg" onclick="applyFilters()">
                            <i class="bi bi-funnel-fill me-2"></i>
                            Apply Filters
                        </button>
                        <small class="text-center mt-1 text-muted">Live Results</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 🏷️ Category Navigation -->
    <section class="category-nav py-4 bg-gradient-light">
        <div class="container">
            <ul class="nav nav-pills category-tabs justify-content-center flex-wrap gap-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active shadow-lg px-4 py-3 rounded-pill fw-semibold"
                        href="<?= site_url('cars') ?>">
                        <i class="bi bi-grid-3x3-gap me-2"></i>All Cars
                        <span class="badge rounded-pill bg-primary ms-2"><?= $stats['total_cars'] ?></span>
                    </a>
                </li>
                <?php
                $mainCategories = ['Hatchback', 'Sedan', 'SUV', 'MPV'];
                foreach ($mainCategories as $cat):
                    $count = rand(8, 35);
                    ?>
                    <li class="nav-item">
                        <a class="nav-link shadow-lg px-4 py-3 rounded-pill fw-semibold"
                            href="<?= site_url('cars/category/' . $cat) ?>" data-bs-toggle="tooltip"
                            title="<?= $cat ?> Cars">
                            <i class="bi bi-car-front <?= strtolower($cat) ?>-icon me-1"></i><?= $cat ?>
                            <span class="badge rounded-pill bg-success ms-1"><?= $count ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- 🚗 Premium Cars Grid -->
    <section class="cars-section py-5">
        <div class="container">
            <!-- Grid Header -->
            <div class="row mb-5 align-items-center">
                <div class="col-md-6">
                    <div class="section-info">
                        <h2 class="section-title fw-bold mb-1">
                            <?= $current_category ? esc($current_category) . ' Cars' : 'Latest Models' ?>
                        </h2>
                        <div class="section-stats d-flex align-items-center gap-3 text-muted fs-6">
                            <span><i class="bi bi-clock-history me-1"></i>Updated Today</span>
                            <span><i class="bi bi-fire me-1 text-danger"></i><?= count($cars) ?> Available</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <div class="view-toggle d-inline-flex gap-1">

                        <button class="btn btn-outline-secondary btn-sm active" id="gridViewBtn" data-layout="grid">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                        </button>

                        <button class="btn btn-outline-secondary btn-sm" id="listViewBtn" data-layout="list">
                            <i class="bi bi-list-ul"></i>
                        </button>

                    </div>
                </div>
            </div>

            <!-- Responsive Masonry Grid -->
            <div class="cars-grid row g-4" id="carsGrid">
                <?php foreach ($cars as $index => $car): ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 car-card-wrapper fade-in-up" data-make="<?= esc($car['make']) ?>"
                        data-model="<?= esc($car['model']) ?>" data-fuel="<?= esc($car['fuel_type']) ?>"
                        data-body="<?= esc($car['body_type']) ?>"
                        data-price="<?= (float) ($car['ex_showroom_price'] ?? 0) ?>"
                        data-mileage="<?= (float) ($car['mileage_kmpl'] ?? 0) ?>"
                        style="animation-delay: <?= $index * 0.08 ?>s">

                        <div
                            class="car-card h-100 border-0 shadow-lg overflow-hidden rounded-4 position-relative hover-lift">
                            <!-- Image & Overlays -->
                            <div class="car-image position-relative overflow-hidden bg-dark">
                                <img src="<?= $car['image_url'] ?? base_url('public/images/no-car.jpg') ?>"
                                    alt="<?= esc($car['make'] . ' ' . $car['model'] . ' ' . $car['variant']) ?>"
                                    class="img-fluid w-100 h-100 object-fit-cover transition-scale">

                                <!-- Quick Badges -->
                                <div class="car-badges position-absolute top-3 end-3 d-flex flex-column gap-1">
                                    <?= $car['ncap_rating'] ?
                                        '<span class="badge bg-gradient-danger fs-6 px-3 py-2 rounded-pill shadow-sm">
                                            <i class="bi bi-star-fill me-1"></i>' . $car['ncap_rating'] . '
                                        </span>' : '' ?>
                                    <?php if (stripos($car['fuel_type'] ?? '', 'Electric') !== false): ?>
                                        <span class="badge bg-gradient-success fs-6 px-3 py-2 rounded-pill shadow-sm">
                                            <i class="bi bi-lightning-charge me-1"></i>EV
                                        </span>
                                    <?php endif; ?>
                                    <?php if ($car['transmission'] === 'Automatic'): ?>
                                        <span class="badge bg-gradient-info fs-6 px-3 py-2 rounded-pill shadow-sm">AT</span>
                                    <?php endif; ?>
                                </div>

                                <!-- Floating Price Tag -->
                                <div
                                    class="price-badge position-absolute start-3 bottom-3 bg-gradient-danger text-white shadow-lg px-4 py-3 rounded-4">
                                    <div class="price-value h4 mb-0 fw-bold fs-4 lh-1">
                                        ₹<?= number_format($car['ex_showroom_price'] ?? 0, 0, '.', ',') ?></div>
                                    <small class="opacity-75">Ex-Showroom</small>
                                </div>

                                <!-- Quick Actions Overlay -->
                                <div class="image-overlay">
                                    <a href="<?= site_url('cars/' . $car['vehicle_id']) ?>"
                                        class="btn btn-light btn-sm rounded-pill shadow">
                                        <i class="bi bi-eye"></i> Quick View
                                    </a>
                                </div>
                            </div>

                            <!-- Car Details -->
                            <div class="car-details p-4">
                                <!-- Brand & Model -->
                                <div class="car-header mb-3">
                                    <h5 class="car-brand fw-bold text-dark mb-1"><?= esc($car['make']) ?></h5>
                                    <h4 class="car-model fw-semibold text-primary mb-2"><?= esc($car['model']) ?></h4>
                                    <div class="car-category badge bg-light border text-success px-3 py-2 rounded-pill">
                                        <?= esc($car['body_type']) ?>
                                    </div>
                                </div>

                                <!-- Variant & Specs -->
                                <?php if ($car['variant']): ?>
                                    <div
                                        class="car-variant badge bg-gradient-light text-dark px-3 py-2 mb-3 rounded-pill shadow-sm">
                                        <?= esc($car['variant']) ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Key Specifications -->
                                <div class="car-specs mb-4">
                                    <div
                                        class="spec-row d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="spec-label"><i
                                                class="bi bi-speedometer2 text-muted me-2"></i>Mileage</span>
                                        <span class="spec-value fw-semibold">
                                            <?= $car['mileage_kmpl'] ? $car['mileage_kmpl'] . ' kmpl' : ($car['mileage'] ?? '—') ?>
                                        </span>
                                    </div>
                                    <div
                                        class="spec-row d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <span class="spec-label"><i
                                                class="bi bi-gear-wide text-muted me-2"></i>Transmission</span>
                                        <span class="spec-value fw-semibold"><?= esc($car['transmission']) ?></span>
                                    </div>
                                    <div class="spec-row d-flex justify-content-between align-items-center py-2">
                                        <span class="spec-label"><i class="bi bi-people text-muted me-2"></i>Seating</span>
                                        <span class="spec-value fw-semibold"><?= $car['seating_capacity'] ?? 5 ?>
                                            Seats</span>
                                    </div>
                                </div>

                                <!-- Primary Action -->
                                <div class="car-actions">
                                    <a href="<?= site_url('cars/' . $car['vehicle_id']) ?>"
                                        class="btn btn-primary w-100 fw-bold rounded-pill shadow-lg mb-2 transition-lift">
                                        <i class="bi bi-arrow-right-circle me-2"></i>
                                        Explore Details
                                    </a>
                                    <div class="secondary-actions d-flex gap-2">
                                        <button class="btn btn-outline-secondary btn-sm px-3 rounded-pill flex-fill">
                                            <i class="bi bi-heart"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary btn-sm px-3 rounded-pill flex-fill">
                                            <i class="bi bi-share"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- 📊 Results Footer -->
            <div class="results-footer mt-5 pt-5 border-top">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="results-info text-muted">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            Showing <strong><?= count($cars) ?></strong> of <?= $stats['total_cars'] ?> cars
                            <?= $current_sort ? ' | Sorted by ' . ucfirst(str_replace('-', ' ', $current_sort)) : '' ?>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <div class="load-more-section">
                            <button class="btn btn-outline-primary btn-lg px-5 rounded-pill shadow-lg" id="loadMore">
                                <i class="bi bi-plus-circle me-2"></i>
                                Load More Cars
                                <span class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- 🌟 Premium CSS (Replace existing styles) -->
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --danger-gradient: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .cars-list-container {
        background: linear-gradient(to bottom, #f8fbff 0%, #e8f4fd 100%);
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* Hero Section */
    .cars-hero {
        background: var(--primary-gradient);
        min-height: 60vh;
        display: flex;
        align-items: center;
        position: relative;
    }

    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%);
        animation: heroShine 20s ease-in-out infinite;
    }

    @keyframes heroShine {

        0%,
        100% {
            opacity: 0.8;
        }

        50% {
            opacity: 1;
        }
    }

    .gradient-text {
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        font-weight: 500;
    }

    /* Filter Bar */
    .filter-bar .filter-select:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.2) !important;
        transform: translateY(-2px);
    }

    /* Category Tabs */
    .category-tabs .nav-link {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
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
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
    }

    /* Car Cards */
    .car-card-wrapper {
        opacity: 0;
    }

    .hover-lift {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
    }

    .hover-lift:hover {
        transform: translateY(-12px) rotateX(5deg);
        box-shadow: 0 35px 80px rgba(0, 0, 0, 0.25) !important;
        border-color: rgba(102, 126, 234, 0.2);
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

    .car-header .car-brand {
        font-size: 1rem;
        color: #495057;
    }

    .car-header .car-model {
        font-size: 1.4rem;
        line-height: 1.2;
    }

    .spec-row .spec-label {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .spec-value {
        color: #2c3e50;
        min-width: 80px;
    }

    .secondary-actions .btn:hover {
        transform: scale(1.1);
    }

    /* Animations */
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

    /* Load More */
    #loadMore:hover {
        transform: translateY(-3px);
    }

    .load-more-section .spinner-border {
        width: 1.2rem;
        height: 1.2rem;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .cars-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)) !important;
        }

        .hero-title {
            font-size: 2.5rem !important;
        }
    }

    @media (max-width: 768px) {
        .filter-bar .row>div {
            margin-bottom: 1rem;
        }

        .category-tabs {
            flex-direction: column;
        }
    }

    /* GRID VIEW */
    .cars-grid.grid-view .car-card-wrapper {
        display: block;
    }

    /* LIST VIEW */
    .cars-grid.list-view .car-card-wrapper {
        width: 100% !important;
        flex: 0 0 100%;
        max-width: 100%;
    }

    .cars-grid.list-view .car-card {
        display: flex;
        flex-direction: row;
        align-items: stretch;
        min-height: 280px;
    }

    .cars-grid.list-view .car-image {
        width: 320px;
        min-width: 320px;
        height: auto;
    }

    .cars-grid.list-view .car-image img {
        height: 100%;
        object-fit: cover;
    }

    .cars-grid.list-view .car-details {
        flex: 1;
    }

    /* MOBILE FIX */
    @media (max-width: 768px) {
        .cars-grid.list-view .car-card {
            flex-direction: column;
        }

        .cars-grid.list-view .car-image {
            width: 100%;
            min-width: 100%;
            height: 220px;
        }
    }
</style>

<!-- ✨ Enhanced JavaScript -->
<script>
    let allCars = <?= json_encode($cars) ?>;
    let currentSort = '<?= $current_sort ?? '' ?>';

    // Premium interactions
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Smooth animations
        initScrollAnimations();
        window.addEventListener('scroll', initScrollAnimations);

        // Live filtering
        document.getElementById('carSearch').addEventListener('input', debounce(filterAndSortCars, 250));
        document.getElementById('fuelFilter').addEventListener('change', filterAndSortCars);
        document.getElementById('bodyFilter').addEventListener('change', filterAndSortCars);
    });

    function initScrollAnimations() {
        document.querySelectorAll('.fade-in-up').forEach((el, index) => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight * 0.8) {
                el.style.animationDelay = `${index * 0.06}s`;
                el.classList.add('animate');
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

    function filterAndSortCars() {
        const search = document.getElementById('carSearch').value.toLowerCase().trim();
        const fuel = document.getElementById('fuelFilter').value;
        const body = document.getElementById('bodyFilter').value;

        let filtered = allCars.filter(car => {
            const matchesSearch = !search ||
                car.make.toLowerCase().includes(search) ||
                car.model.toLowerCase().includes(search) ||
                car.variant?.toLowerCase().includes(search);
            const matchesFuel = !fuel || car.fuel_type === fuel;
            const matchesBody = !body || car.body_type === body;
            return matchesSearch && matchesFuel && matchesBody;
        });

        // Advanced sorting
        filtered.sort((a, b) => {
            const priceA = parseFloat(a.ex_showroom_price) || Infinity;
            const priceB = parseFloat(b.ex_showroom_price) || Infinity;
            const mileageA = parseFloat(a.mileage_kmpl) || 0;
            const mileageB = parseFloat(b.mileage_kmpl) || 0;

            switch (currentSort) {
                case 'price-low': return priceA - priceB;
                case 'price-high': return priceB - priceA;
                case 'mileage': return mileageB - mileageA;
                case 'make': return (a.make || '').localeCompare(b.make || '');
                default: return 0;
            }
        });

        renderCars(filtered);
        updateStats(filtered.length);
    }

    function sortCars(value) {
        currentSort = value;
        filterAndSortCars();
    }

    function renderCars(cars) {
        const grid = document.getElementById('carsGrid');
        grid.innerHTML = cars.map((car, index) => createPremiumCarCard(car, index)).join('');

        // Re-init animations
        setTimeout(initScrollAnimations, 100);
    }

    function createPremiumCarCard(car, index) {
        return `
    <div class="col-xl-3 col-lg-4 col-md-6 car-card-wrapper fade-in-up"
         data-make="${car.make || ''}"
         data-model="${car.model || ''}"
         data-fuel="${car.fuel_type || ''}"
         data-body="${car.body_type || ''}"
         data-price="${car.ex_showroom_price || 0}"
         data-mileage="${car.mileage_kmpl || 0}"
         style="animation-delay:${index * 0.08}s">

        <div class="car-card h-100 border-0 shadow-lg overflow-hidden rounded-4 position-relative hover-lift">

            <div class="car-image position-relative overflow-hidden bg-dark">
            <?php /*
                <img src="${car.image_url || '/public/images/no-car.jpg'}"
                     alt="${car.make || ''} ${car.model || ''}"
                     class="img-fluid w-100 h-100 object-fit-cover transition-scale"> */ ?>

                <div class="car-badges position-absolute top-3 end-3 d-flex flex-column gap-1">

                    ${car.ncap_rating ? `
                        <span class="badge bg-danger fs-6 px-3 py-2 rounded-pill shadow-sm">
                            ⭐ ${car.ncap_rating}
                        </span>` : ''}

                    ${car.fuel_type && car.fuel_type.includes('Electric') ? `
                        <span class="badge bg-success fs-6 px-3 py-2 rounded-pill shadow-sm">
                            ⚡ EV
                        </span>` : ''}

                    ${car.transmission === 'Automatic' ? `
                        <span class="badge bg-info fs-6 px-3 py-2 rounded-pill shadow-sm">
                            AT
                        </span>` : ''}
                </div>

                <div class="price-badge position-absolute start-3 bottom-3 bg-danger text-white shadow-lg px-4 py-3 rounded-4">
                    <div class="price-value h4 mb-0 fw-bold fs-4 lh-1">
                        ₹${Number(car.ex_showroom_price || 0).toLocaleString()}
                    </div>
                    <small class="opacity-75">Ex-Showroom</small>
                </div>

                <div class="image-overlay">
    <a href="<?= base_url('cars') ?>/${car.vehicle_id}" 
       class="btn btn-light btn-sm rounded-pill shadow">
        👁 Quick View
    </a>
</div>
            </div>

            <div class="car-details p-4">

                <div class="car-header mb-3">
                    <h5 class="car-brand fw-bold text-dark mb-1">${car.make || ''}</h5>
                    <h4 class="car-model fw-semibold text-primary mb-2">${car.model || ''}</h4>

                    <div class="car-category badge bg-light border text-success px-3 py-2 rounded-pill">
                        ${car.body_type || ''}
                    </div>
                </div>

                ${car.variant ? `
                    <div class="car-variant badge bg-light text-dark px-3 py-2 mb-3 rounded-pill shadow-sm">
                        ${car.variant}
                    </div>` : ''}

                <div class="car-specs mb-4">

                    <div class="spec-row d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="spec-label">Mileage</span>
                        <span class="spec-value fw-semibold">
                            ${car.mileage_kmpl ? car.mileage_kmpl + ' kmpl' : '—'}
                        </span>
                    </div>

                    <div class="spec-row d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="spec-label">Transmission</span>
                        <span class="spec-value fw-semibold">
                            ${car.transmission || ''}
                        </span>
                    </div>

                    <div class="spec-row d-flex justify-content-between align-items-center py-2">
                        <span class="spec-label">Seating</span>
                        <span class="spec-value fw-semibold">
                            ${car.seating_capacity || 5} Seats
                        </span>
                    </div>
                </div>

                <div class="car-actions">
                    <a href="<?= base_url('cars') ?>/${car.vehicle_id}"
   class="btn btn-primary w-100 fw-bold rounded-pill shadow-lg mb-2">
                        Explore Details
                    </a>
                </div>
            </div>
        </div>
    </div>`;
    }

    function updateStats(count) {
        const statsEl = document.querySelector('.section-stats .text-danger');
        if (statsEl) statsEl.textContent = count + ' Available';
    }

    // Load More Simulation
    document.getElementById('loadMore')?.addEventListener('click', function () {
        const btn = this;
        const spinner = btn.querySelector('.spinner-border');
        spinner.classList.remove('d-none');
        btn.disabled = true;

        setTimeout(() => {
            spinner.classList.add('d-none');
            btn.disabled = false;
            // Simulate loading more cars
            console.log('Loaded more cars!');
        }, 1500);
    });

    // View Toggle Functionality
    document.addEventListener('DOMContentLoaded', function () {

        const carsGrid = document.getElementById('carsGrid');

        const gridBtn = document.getElementById('gridViewBtn');
        const listBtn = document.getElementById('listViewBtn');

        // Default View
        carsGrid.classList.add('grid-view');

        // GRID VIEW
        gridBtn.addEventListener('click', function () {

            carsGrid.classList.remove('list-view');
            carsGrid.classList.add('grid-view');

            gridBtn.classList.add('active');
            listBtn.classList.remove('active');

            // Restore grid columns
            document.querySelectorAll('.car-card-wrapper').forEach(card => {
                card.className =
                    'col-xl-3 col-lg-4 col-md-6 car-card-wrapper fade-in-up';
            });
        });

        // LIST VIEW
        listBtn.addEventListener('click', function () {

            carsGrid.classList.remove('grid-view');
            carsGrid.classList.add('list-view');

            listBtn.classList.add('active');
            gridBtn.classList.remove('active');

            // Full width rows
            document.querySelectorAll('.car-card-wrapper').forEach(card => {
                card.className =
                    'col-12 car-card-wrapper fade-in-up';
            });
        });

    });

    // Initial load
    filterAndSortCars();
</script>