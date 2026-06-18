 <style>
        :root {
            --ev-primary: #10b981;
            --ev-primary-dark: #059669;
            --ev-secondary: #1e293b;
            --ev-accent: #f59e0b;
            --ev-bg-light: #f8fafc;
            --ev-bg-white: #ffffff;
            --ev-text-dark: #0f172a;
            --ev-text-gray: #64748b;
            --ev-border: #e2e8f0;
            --shadow-xs: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--ev-bg-light) 0%, #e2e8f0 100%);
            color: var(--ev-text-dark);
        }

        /* Hero Section */
        .ev-hero {
            background: linear-gradient(135deg, var(--ev-secondary) 0%, #0f172a 100%);
            color: white;
            padding: 4rem 0;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .ev-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.05)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
            opacity: 0.3;
        }

        .ev-hero .container {
            position: relative;
            z-index: 2;
        }

        .ev-hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .ev-hero .lead {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        /* Stats Bar */
        .stats-bar {
            background: var(--ev-bg-white);
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: -2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-lg);
            position: relative;
            z-index: 10;
        }

        .stat-item {
            text-align: center;
            border-right: 1px solid var(--ev-border);
        }

        .stat-item:last-child {
            border-right: none;
        }

        .stat-number {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--ev-primary);
            line-height: 1.2;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--ev-text-gray);
            margin-top: 0.25rem;
        }

        /* Filter Sidebar */
        .filter-sidebar {
            background: var(--ev-bg-white);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 20px;
            border: 1px solid var(--ev-border);
        }

        .filter-header {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--ev-primary);
            display: inline-block;
        }

        .filter-group {
            margin-bottom: 1.5rem;
        }

        .filter-label {
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            color: var(--ev-text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 1px solid var(--ev-border);
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--ev-primary);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* EV Cards */
        .ev-card {
            background: var(--ev-bg-white);
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-sm);
            height: 100%;
            position: relative;
        }

        .ev-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .ev-card-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            z-index: 10;
        }

        .ev-badge {
            background: linear-gradient(135deg, var(--ev-primary) 0%, var(--ev-primary-dark) 100%);
            color: white;
            padding: 0.375rem 0.875rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            box-shadow: var(--shadow-sm);
        }

        .ev-card-image {
            height: 220px;
            overflow: hidden;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            position: relative;
        }

        .ev-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .ev-card:hover .ev-card-image img {
            transform: scale(1.05);
        }

        .ev-card-price {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
            background: rgba(255,255,255,0.95);
            padding: 0.375rem 0.875rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.875rem;
            color: var(--ev-primary);
            box-shadow: var(--shadow-sm);
        }

        .ev-card-body {
            padding: 1.25rem;
        }

        .ev-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: var(--ev-text-dark);
        }

        .ev-variant {
            font-size: 0.75rem;
            color: var(--ev-text-gray);
            margin-bottom: 1rem;
        }

        .ev-specs-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
            background: var(--ev-bg-light);
            padding: 0.875rem;
            border-radius: 16px;
            margin: 1rem 0;
        }

        .ev-spec-item {
            text-align: center;
        }

        .ev-spec-icon {
            font-size: 1.1rem;
            color: var(--ev-primary);
            margin-bottom: 0.25rem;
            display: block;
        }

        .ev-spec-value {
            font-weight: 700;
            font-size: 0.8rem;
            color: var(--ev-text-dark);
        }

        .ev-spec-label {
            font-size: 0.65rem;
            color: var(--ev-text-gray);
            display: block;
        }

        .ev-charging {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            color: var(--ev-text-gray);
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid var(--ev-border);
        }

        .btn-ev-compare {
            background: linear-gradient(135deg, var(--ev-primary) 0%, var(--ev-primary-dark) 100%);
            border: none;
            color: white;
            border-radius: 12px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .btn-ev-compare:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-outline-ev {
            border: 1px solid var(--ev-primary);
            background: transparent;
            color: var(--ev-primary);
            border-radius: 12px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .btn-outline-ev:hover {
            background: var(--ev-primary);
            color: white;
            transform: translateY(-2px);
        }

        /* Load More Button */
        .load-more-container {
            text-align: center;
            margin: 3rem 0 2rem;
        }

        .btn-load-more {
            background: var(--ev-bg-white);
            border: 2px solid var(--ev-primary);
            color: var(--ev-primary);
            border-radius: 50px;
            padding: 0.875rem 2.5rem;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-load-more:hover {
            background: var(--ev-primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-load-more.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-load-more.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid white;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Skeleton Loading */
        .skeleton-card {
            background: var(--ev-bg-white);
            border-radius: 20px;
            overflow: hidden;
            height: 100%;
        }

        .skeleton-image {
            height: 220px;
            background: linear-gradient(90deg, var(--ev-border) 25%, #f1f5f9 50%, var(--ev-border) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        .skeleton-content {
            padding: 1.25rem;
        }

        .skeleton-title {
            height: 24px;
            background: var(--ev-border);
            border-radius: 8px;
            margin-bottom: 0.5rem;
            width: 70%;
        }

        .skeleton-text {
            height: 16px;
            background: var(--ev-border);
            border-radius: 6px;
            margin-bottom: 0.75rem;
            width: 90%;
        }

        .skeleton-specs {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
            margin: 1rem 0;
        }

        .skeleton-spec {
            height: 50px;
            background: var(--ev-border);
            border-radius: 12px;
        }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Toast Custom */
        .toast-custom {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow-xl);
            border: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .ev-hero h1 {
                font-size: 2rem;
            }
            
            .stat-item {
                border-right: none;
                margin-bottom: 1rem;
            }
            
            .stats-bar .row {
                gap: 1rem;
            }
            
            .filter-sidebar {
                margin-bottom: 1.5rem;
                position: static;
            }
        }
    </style>

<div class="ev-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1>
                    <i class="bi bi-ev-station-fill me-2"></i>
                    Electric Vehicles
                </h1>
                <p class="lead">Discover the future of mobility. Compare range, performance, and pricing of India's best electric vehicles.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="d-flex gap-2 justify-content-lg-end">
                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                        <i class="bi bi-lightning-charge-fill text-success me-1"></i> Zero Emission
                    </span>
                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                        <i class="bi bi-cash-stack text-success me-1"></i> Low Running Cost
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Stats Bar -->
    <div class="stats-bar">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number" id="totalCount"><?= number_format($total ?? 0) ?></div>
                    <div class="stat-label">Total EVs</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number" id="avgRange">—</div>
                    <div class="stat-label">Avg Range (km)</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number" id="avgPrice">—</div>
                    <div class="stat-label">Avg Price (₹ Lakh)</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number" id="brandCount">—</div>
                    <div class="stat-label">Brands</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Filters Sidebar -->
        <div class="col-lg-3">
            <div class="filter-sidebar">
                <div class="filter-header">
                    <i class="bi bi-funnel-fill me-2"></i> Filters
                </div>
                
                <form id="filterForm">
                    <!-- Search -->
                    <div class="filter-group">
                        <label class="filter-label">
                            <i class="bi bi-search"></i> Search
                        </label>
                        <input type="text" name="search" id="searchInput" class="form-control" 
                               placeholder="Search by make or model..." value="<?= esc($_GET['search'] ?? '') ?>">
                    </div>
                    
                    <!-- Sort -->
                    <div class="filter-group">
                        <label class="filter-label">
                            <i class="bi bi-arrow-up-down"></i> Sort By
                        </label>
                        <select name="sort" id="sortSelect" class="form-select">
                            <option value="">Default</option>
                            <option value="price_low" <?= ($sort ?? '') == 'price_low' ? 'selected' : '' ?>>Price: Low to High</option>
                            <option value="price_high" <?= ($sort ?? '') == 'price_high' ? 'selected' : '' ?>>Price: High to Low</option>
                            <option value="range_high" <?= ($sort ?? '') == 'range_high' ? 'selected' : '' ?>>Range: High to Low</option>
                            <option value="range_low" <?= ($sort ?? '') == 'range_low' ? 'selected' : '' ?>>Range: Low to High</option>
                            <option value="newest" <?= ($sort ?? '') == 'newest' ? 'selected' : '' ?>>Newest First</option>
                        </select>
                    </div>
                    
                    <!-- Range Filter -->
                    <div class="filter-group">
                        <label class="filter-label">
                            <i class="bi bi-speedometer2"></i> Range (km)
                        </label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" name="min_range" id="minRange" class="form-control" 
                                       placeholder="Min" value="<?= $selected_min_range ?? '' ?>">
                            </div>
                            <div class="col-6">
                                <input type="number" name="max_range" id="maxRange" class="form-control" 
                                       placeholder="Max" value="<?= $selected_max_range ?? '' ?>">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Make Filter -->
                    <?php if (!empty($filters['makes'])): ?>
                    <div class="filter-group">
                        <label class="filter-label">
                            <i class="bi bi-building"></i> Manufacturer
                        </label>
                        <select name="make" id="makeSelect" class="form-select">
                            <option value="">All Makes</option>
                            <?php foreach ($filters['makes'] as $make): ?>
                                <option value="<?= esc($make['make']) ?>" 
                                    <?= ($selected_make ?? '') == $make['make'] ? 'selected' : '' ?>>
                                    <?= esc($make['make']) ?> (<?= $make['count'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Body Type Filter -->
                    <?php if (!empty($filters['body_types'])): ?>
                    <div class="filter-group">
                        <label class="filter-label">
                            <i class="bi bi-car-front"></i> Body Type
                        </label>
                        <select name="body_type" id="bodyTypeSelect" class="form-select">
                            <option value="">All Types</option>
                            <?php foreach ($filters['body_types'] as $body): ?>
                                <option value="<?= esc($body['body_type']) ?>" 
                                    <?= ($selected_body_type ?? '') == $body['body_type'] ? 'selected' : '' ?>>
                                    <?= esc($body['body_type']) ?> (<?= $body['count'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    
                    <button type="button" id="applyFiltersBtn" class="btn btn-success w-100 mb-2">
                        <i class="bi bi-check-circle me-2"></i> Apply Filters
                    </button>
                    
                    <button type="button" id="resetFiltersBtn" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-arrow-repeat me-2"></i> Reset All
                    </button>
                </form>
            </div>
        </div>
        
        <!-- EV Listings -->
        <div class="col-lg-9">
            <div id="evsContainer">
                <div class="row g-4" id="evsList">
                    <?php if (!empty($evs)): ?>
                        <?php foreach ($evs as $ev): ?>
                            <?= renderEVCard($ev) ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-info text-center" style="border-radius: 20px;">
                                <i class="bi bi-ev-station fs-1 d-block mb-2"></i>
                                <h5>No electric vehicles found</h5>
                                <p>Try adjusting your filters or check back later for new EV listings.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Load More Button -->
            <div class="load-more-container" id="loadMoreContainer" style="display: none;">
                <button class="btn-load-more" id="loadMoreBtn">
                    <i class="bi bi-arrow-down-circle me-2"></i> Load More
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Comparison Toast -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
    <div id="compareToast" class="toast toast-custom" role="alert" data-bs-autohide="false">
        <div class="toast-header bg-success text-white">
            <i class="bi bi-bar-chart-steps me-2"></i>
            <strong class="me-auto">Compare EVs</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            <div id="compareList"></div>
            <button class="btn btn-success btn-sm mt-2 w-100" onclick="proceedToCompare()">
                <i class="bi bi-arrow-right-circle me-1"></i> Compare Now
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let currentPage = 1;
let isLoading = false;
let hasMore = true;
let compareList = [];

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    calculateStats();
    setupEventListeners();
    checkLoadMore();
});

function setupEventListeners() {
    document.getElementById('applyFiltersBtn').addEventListener('click', applyFilters);
    document.getElementById('resetFiltersBtn').addEventListener('click', resetFilters);
    document.getElementById('loadMoreBtn').addEventListener('click', loadMore);
    
    // Enter key in search
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') applyFilters();
    });
}

function applyFilters() {
    currentPage = 1;
    hasMore = true;
    const formData = new FormData(document.getElementById('filterForm'));
    const params = new URLSearchParams();
    
    for (let [key, value] of formData.entries()) {
        if (value) params.append(key, value);
    }
    
    fetchEVs(params);
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('sortSelect').value = '';
    document.getElementById('minRange').value = '';
    document.getElementById('maxRange').value = '';
    document.getElementById('makeSelect').value = '';
    document.getElementById('bodyTypeSelect').value = '';
    
    applyFilters();
}

function fetchEVs(params, append = false) {
    if (isLoading) return;
    isLoading = true;
    
    params.append('page', currentPage);
    params.append('ajax', '1');
    
    if (!append) {
        document.getElementById('evsList').innerHTML = '';
        showSkeletons(6);
    }
    
    fetch(`<?= site_url('ev/load-more') ?>?${params.toString()}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!append) {
            document.getElementById('evsList').innerHTML = '';
        }
        
        if (data.html) {
            document.getElementById('evsList').insertAdjacentHTML('beforeend', data.html);
        }
        
        hasMore = data.has_more;
        currentPage = data.current_page;
        
        if (hasMore) {
            document.getElementById('loadMoreContainer').style.display = 'block';
        } else {
            document.getElementById('loadMoreContainer').style.display = 'none';
        }
        
        calculateStats();
        isLoading = false;
    })
    .catch(error => {
        console.error('Error:', error);
        isLoading = false;
        showAlert('Error loading EVs. Please try again.', 'danger');
    });
}

function loadMore() {
    if (!hasMore || isLoading) return;
    currentPage++;
    const formData = new FormData(document.getElementById('filterForm'));
    const params = new URLSearchParams();
    
    for (let [key, value] of formData.entries()) {
        if (value) params.append(key, value);
    }
    
    fetchEVs(params, true);
}

function checkLoadMore() {
    const total = <?= $total ?? 0 ?>;
    const currentCount = <?= count($evs ?? []) ?>;
    hasMore = currentCount < total;
    
    if (hasMore) {
        document.getElementById('loadMoreContainer').style.display = 'block';
    }
}

function showSkeletons(count) {
    const container = document.getElementById('evsList');
    for (let i = 0; i < count; i++) {
        container.insertAdjacentHTML('beforeend', `
            <div class="col-md-6 col-xl-4">
                <div class="skeleton-card">
                    <div class="skeleton-image"></div>
                    <div class="skeleton-content">
                        <div class="skeleton-title"></div>
                        <div class="skeleton-text"></div>
                        <div class="skeleton-specs">
                            <div class="skeleton-spec"></div>
                            <div class="skeleton-spec"></div>
                            <div class="skeleton-spec"></div>
                        </div>
                    </div>
                </div>
            </div>
        `);
    }
}

function calculateStats() {
    // Calculate average range
    const rangeElements = document.querySelectorAll('.ev-spec-value[data-spec="range"]');
    let totalRange = 0;
    rangeElements.forEach(el => {
        let range = parseInt(el.textContent);
        if (!isNaN(range)) totalRange += range;
    });
    const avgRange = rangeElements.length ? Math.round(totalRange / rangeElements.length) : 0;
    document.getElementById('avgRange').textContent = avgRange ? `${avgRange}+` : '—';
    
    // Calculate brand count
    const brands = new Set();
    document.querySelectorAll('.ev-title').forEach(el => {
        brands.add(el.textContent.split(' ')[0]);
    });
    document.getElementById('brandCount').textContent = brands.size || '—';
}

function addToCompare(vehicleId, make, model) {
    if (compareList.includes(vehicleId)) {
        showAlert(`${make} ${model} already in comparison`, 'warning');
        return;
    }
    
    if (compareList.length >= 4) {
        showAlert('You can compare up to 4 EVs at a time', 'warning');
        return;
    }
    
    compareList.push({id: vehicleId, name: `${make} ${model}`});
    updateCompareToast();
    showAlert(`${make} ${model} added to comparison`, 'success');
}

function removeFromCompare(vehicleId) {
    compareList = compareList.filter(item => item.id !== vehicleId);
    updateCompareToast();
}

function updateCompareToast() {
    const compareListDiv = document.getElementById('compareList');
    const toastEl = document.getElementById('compareToast');
    const toast = bootstrap.Toast.getOrCreateInstance(toastEl);
    
    if (compareList.length > 0) {
        compareListDiv.innerHTML = `
            <strong>Selected (${compareList.length}/4):</strong>
            <div class="mt-2">
                ${compareList.map(item => `
                    <span class="badge bg-secondary me-1 mb-1 p-2">
                        ${escapeHtml(item.name)}
                        <i class="bi bi-x-circle ms-1" style="cursor: pointer;" onclick="removeFromCompare(${item.id})"></i>
                    </span>
                `).join('')}
            </div>
        `;
        toast.show();
    } else {
        toast.hide();
    }
}

function proceedToCompare() {
    if (compareList.length < 2) {
        showAlert('Please select at least 2 EVs to compare', 'warning');
        return;
    }
    
    const ids = compareList.map(item => item.id).join(',');
    window.location.href = `<?= site_url('ev/compare') ?>?ids=${ids}`;
}

function showAlert(message, type) {
    const alertDiv = document.createElement('div');
    const alertClass = type === 'success' ? 'alert-success' : (type === 'danger' ? 'alert-danger' : 'alert-warning');
    
    alertDiv.className = `alert ${alertClass} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
    alertDiv.style.zIndex = '9999';
    alertDiv.style.minWidth = '300px';
    alertDiv.style.borderRadius = '12px';
    alertDiv.innerHTML = `
        <i class="bi bi-${type === 'success' ? 'check-circle' : (type === 'danger' ? 'exclamation-circle' : 'info-circle')} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(alertDiv);
    setTimeout(() => alertDiv.remove(), 3000);
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
</script>

</body>
</html>

<?php
// Helper function to render EV card
function renderEVCard($ev) {
    ob_start();
    ?>
    <div class="col-md-6 col-xl-4">
        <div class="ev-card">
            <div class="ev-card-badge">
                <span class="ev-badge">
                    <i class="bi bi-ev-station-fill me-1"></i> Electric
                </span>
            </div>
            <div class="ev-card-image">
                <?php if (!empty($ev['image_url'])): ?>
                    <img src="<?= esc($ev['image_url']) ?>" alt="<?= esc($ev['make']) ?> <?= esc($ev['model']) ?>">
                <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <i class="bi bi-ev-station" style="font-size: 4rem; color: #10b981;"></i>
                    </div>
                <?php endif; ?>
                <?php if (!empty($ev['ex_showroom_price']) && $ev['ex_showroom_price'] > 0): ?>
                    <div class="ev-card-price">
                        ₹ <?= number_format($ev['ex_showroom_price'], 0) ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="ev-card-body">
                <h3 class="ev-title">
                    <?= esc($ev['make']) ?> <?= esc($ev['model']) ?>
                </h3>
                <?php if (!empty($ev['variant'])): ?>
                    <div class="ev-variant"><?= esc($ev['variant']) ?></div>
                <?php endif; ?>
                
                <div class="ev-specs-grid">
                    <div class="ev-spec-item">
                        <i class="bi bi-battery-full ev-spec-icon"></i>
                        <span class="ev-spec-value" data-spec="battery"><?= $ev['battery_formatted'] ?? 'N/A' ?></span>
                        <span class="ev-spec-label">Battery</span>
                    </div>
                    <div class="ev-spec-item">
                        <i class="bi bi-speedometer2 ev-spec-icon"></i>
                        <span class="ev-spec-value" data-spec="range"><?= preg_replace('/[^0-9]/', '', $ev['range_formatted'] ?? '0') ?></span>
                        <span class="ev-spec-label">Range</span>
                    </div>
                    <div class="ev-spec-item">
                        <i class="bi bi-lightning-charge ev-spec-icon"></i>
                        <span class="ev-spec-value"><?= $ev['power_formatted'] ?? 'N/A' ?></span>
                        <span class="ev-spec-label">Power</span>
                    </div>
                </div>
                
                <div class="ev-charging">
                    <i class="bi bi-clock-history"></i>
                    <span><?= $ev['charging_formatted'] ?? 'N/A' ?></span>
                </div>
                
                <div class="d-flex gap-2 mt-3">
                    <a href="<?= site_url('ev/detail/' . $ev['slug']) ?>" class="btn btn-outline-ev flex-grow-1">
                        <i class="bi bi-eye me-1"></i> Details
                    </a>
                    <button class="btn btn-ev-compare" onclick="addToCompare(<?= $ev['vehicle_id'] ?>, '<?= esc($ev['make']) ?>', '<?= esc($ev['model']) ?>')">
                        <i class="bi bi-bar-chart-steps me-1"></i> Compare
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
?>