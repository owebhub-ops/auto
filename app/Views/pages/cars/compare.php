<style>
    /* ============================================
   COMPARE CARS PAGE - OPTIMIZED CSS
   ============================================ */

    :root {
        --primary: #667eea;
        --primary-dark: #5a67d8;
        --secondary: #764ba2;
        --success: #28a745;
        --success-dark: #20c997;
        --danger: #dc3545;
        --warning: #ffc107;
        --dark: #333;
        --light: #f8f9fa;
        --gray: #666;
        --border: #e0e0e0;
        --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 5px 20px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.15);
        --primary-gradient: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        --success-gradient: linear-gradient(135deg, var(--success) 0%, var(--success-dark) 100%);
        --danger-gradient: linear-gradient(135deg, var(--danger) 0%, #c82333 100%);
    }

    /* Base Styles */
    .compare-page {
        background: var(--light);
        min-height: 100vh;
    }

    /* Header Section */
    .compare-header {
        background: var(--primary-gradient);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    /* Search Card - Normal State */
    .search-card {
        border: none;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        margin-bottom: 2rem;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .search-card .card-body {
        padding: 1.5rem;
        position: relative;
    }

    /* Search Input Group */
    .search-input-group {
        border-radius: 50px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .search-input-group .input-group-text {
        background: white;
        border: 1px solid var(--border);
        border-right: none;
        color: var(--primary);
    }

    .search-input-group input {
        border: 1px solid var(--border);
        border-left: none;
        border-right: none;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.2s;
    }

    .search-input-group input:focus {
        box-shadow: none;
        border-color: var(--primary);
    }

    .search-input-group button {
        background: var(--primary-gradient);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 0 50px 50px 0;
        transition: transform 0.2s, box-shadow 0.2s;
        white-space: nowrap;
    }

    .search-input-group button:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-sm);
    }

    /* Search Overlay & Expanded State */
    .search-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9998;
        display: none;
        backdrop-filter: blur(5px);
    }

    .search-card-expanded {
        position: fixed !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        width: 90% !important;
        max-width: 800px !important;
        z-index: 9999 !important;
        margin: 0 !important;
        animation: modalExpand 0.3s ease-out;
    }

    @keyframes modalExpand {
        from {
            opacity: 0;
            transform: translate(-50%, -40%) scale(0.9);
        }

        to {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }

    .search-card-expanded .card-body {
        padding: 2rem;
    }

    .search-card-expanded .input-group input {
        font-size: 1.2rem;
        padding: 1rem;
    }

    .search-card-expanded .input-group button {
        padding: 1rem 2rem;
    }

    .search-card-expanded .search-results-dropdown {
        max-height: 60vh;
        position: static;
        margin-top: 1rem;
    }

    .close-search-overlay {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: var(--gray);
        cursor: pointer;
        transition: all 0.2s;
        z-index: 10000;
        display: none;
    }

    .close-search-overlay:hover {
        color: var(--danger);
        transform: rotate(90deg);
    }

    /* Search Results Dropdown */
    .search-results-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 1000;
        background: white;
        border-radius: 15px;
        box-shadow: var(--shadow-lg);
        max-height: 400px;
        overflow-y: auto;
        margin-top: 0.5rem;
        display: none;
    }

    .car-result-item {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        padding: 1rem 1.5rem !important;
        border-bottom: 1px solid var(--border) !important;
        cursor: pointer !important;
        transition: all 0.2s !important;
        background: white !important;
    }

    .car-result-item:hover {
        background: var(--light) !important;
        transform: translateX(5px);
    }

    .car-result-item.active {
        background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%) !important;
        border-left: 3px solid var(--primary) !important;
    }

    .car-result-info {
        flex: 1;
        text-align: left;
    }

    .car-result-info h6 {
        margin: 0;
        font-weight: 600;
        color: var(--dark);
    }

    .car-result-info small {
        color: var(--gray);
        font-size: 0.85rem;
    }

    /* Selected Cars Panel */
    .selected-panel {
        background: white;
        border-radius: 15px;
        padding: 1rem;
        margin-top: 1rem;
        display: none;
        box-shadow: var(--shadow-sm);
    }

    .selected-badge-item {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        margin: 0.25rem;
        font-size: 0.9rem;
    }

    .selected-badge-item button {
        background: none !important;
        border: none !important;
        color: var(--danger) !important;
        cursor: pointer !important;
        padding: 0 !important;
        margin-left: 0.5rem !important;
    }

    .selected-badge-item button:hover {
        color: #c82333 !important;
    }

    /* Comparison Table Card */
    .comparison-card {
        border: none;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        overflow: hidden;
    }

    .comparison-card .card-body {
        padding: 0;
    }

    .comparison-table-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Comparison Table */
    .comparison-table {
        margin-bottom: 0;
        min-width: 800px;
        width: 100%;
        background: white;
    }

    .comparison-table thead th {
        background: var(--primary-gradient);
        color: white;
        padding: 1.5rem 1rem;
        border: none;
        position: relative;
        vertical-align: top;
    }

    .comparison-table tbody th {
        background: var(--light);
        font-weight: 600;
        color: #495057;
        width: 200px;
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border);
    }

    .comparison-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border);
        word-wrap: break-word;
        max-width: 300px;
    }

    .comparison-table tbody tr:hover td {
        background: var(--light);
    }

    /* Vehicle Header in Table */
    .vehicle-header {
        position: relative;
        text-align: center;
    }

    .vehicle-name {
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0.5rem 0;
        word-wrap: break-word;
    }

    .vehicle-image {
        max-height: 120px;
        object-fit: contain;
        border-radius: 10px;
        margin: 0.5rem 0;
    }

    .vehicle-brochure-btn {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        border-radius: 50px;
        padding: 0.25rem 1rem;
        font-size: 0.85rem;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .vehicle-brochure-btn:hover {
        background: white;
        color: var(--primary);
    }

    /* Remove Vehicle Button */
    .remove-vehicle-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--danger) !important;
        border: none !important;
        color: white !important;
        border-radius: 50% !important;
        width: 32px !important;
        height: 32px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        transition: all 0.2s !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2) !important;
        z-index: 10 !important;
    }

    .remove-vehicle-btn:hover {
        background: #c82333 !important;
        transform: scale(1.05) !important;
    }

    .remove-vehicle-btn i {
        font-size: 1rem !important;
        color: white !important;
        pointer-events: none !important;
    }

    /* Price Highlight */
    .price-highlight {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--success);
    }

    /* Badge Styles */
    .badge-success-custom {
        background: var(--success-gradient);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        display: inline-block;
    }

    .badge-danger-custom {
        background: var(--danger-gradient);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        display: inline-block;
    }

    /* Offers List */
    .offers-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .offers-list li {
        font-size: 0.85rem;
        margin-bottom: 0.25rem;
        word-wrap: break-word;
    }

    .offers-list li i {
        color: var(--success);
        margin-right: 0.25rem;
    }

    /* Floating Alert */
    .alert-floating {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        max-width: 90%;
        border: none;
        border-radius: 15px;
        box-shadow: var(--shadow-lg);
        animation: slideInRight 0.3s ease;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Loading Spinner */
    .spinner-custom {
        width: 40px;
        height: 40px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid var(--primary);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin: 0 auto;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Utility Classes */
    .position-relative {
        position: relative !important;
    }

    .btn-link.text-danger {
        color: var(--danger) !important;
        text-decoration: none !important;
    }

    .btn-link.text-danger:hover {
        color: #c82333 !important;
        text-decoration: underline !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .compare-header {
            padding: 1.5rem;
        }

        .compare-header h1 {
            font-size: 1.5rem;
        }

        .compare-header .lead {
            font-size: 1rem;
        }

        .comparison-table tbody th {
            width: 120px;
            font-size: 0.85rem;
            padding: 0.75rem;
        }

        .comparison-table tbody td {
            padding: 0.75rem;
            font-size: 0.85rem;
        }

        .vehicle-name {
            font-size: 0.9rem;
        }

        .price-highlight {
            font-size: 1rem;
        }

        .search-input-group button {
            padding: 0.75rem 1rem;
        }

        .search-card-expanded .input-group input {
            font-size: 1rem;
        }

        .search-card-expanded .input-group button {
            padding: 0.75rem 1rem;
        }
    }

    @media (max-width: 576px) {
        .comparison-table tbody th {
            width: 100px;
            font-size: 0.75rem;
            padding: 0.5rem;
        }

        .comparison-table tbody td {
            padding: 0.5rem;
            font-size: 0.75rem;
        }

        .vehicle-name {
            font-size: 0.8rem;
        }

        .remove-vehicle-btn {
            width: 24px !important;
            height: 24px !important;
            top: 5px;
            right: 5px;
        }

        .selected-badge-item {
            font-size: 0.75rem;
            padding: 0.35rem 0.75rem;
        }

        .alert-floating {
            min-width: 250px;
            top: 10px;
            right: 10px;
        }
    }

    /* Print Styles */
    @media print {

        .search-card,
        .selected-panel,
        .alert-floating,
        .remove-vehicle-btn {
            display: none !important;
        }

        .comparison-table {
            min-width: 100%;
        }
    }
</style>

<div class="compare-page">
    <div class="container py-4">
        <!-- Header Section -->
        <div class="compare-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-diagram-2-fill fs-1 me-3"></i>
                        <h1 class="display-5 fw-bold mb-0">Compare Cars</h1>
                    </div>
                    <p class="lead mb-0">Make an informed decision by comparing specifications side by side</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <i class="bi bi-car-front-fill" style="font-size: 4rem; opacity: 0.8;"></i>
                </div>
            </div>
        </div>

        <!-- Search Overlay -->
        <div id="searchOverlay" class="search-overlay"></div>

        <!-- Search Section -->
        <div class="search-card card" id="searchCard">
            <div class="card-body">
                <button class="close-search-overlay" id="closeSearchOverlay" style="display: none;">
                    <i class="bi bi-x-lg"></i>
                </button>

                <label class="form-label fw-semibold mb-2">
                    <i class="bi bi-search me-1"></i> Search & Add Cars to Compare
                </label>

                <!-- Wrapper for search input and results -->
                <div style="position: relative; z-index: 1000;">
                    <div class="input-group search-input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="carSearch" class="form-control"
                            placeholder="Search by brand, model, or variant... (min. 2 characters)" autocomplete="off">
                        <button id="addToCompareBtn" class="btn btn-primary" type="button">
                            <i class="bi bi-plus-circle me-2"></i> Add to Compare
                        </button>
                    </div>

                    <!-- Search Results Dropdown -->
                    <div id="searchResults" class="search-results-dropdown"></div>
                </div>

                <small class="text-muted mt-2 d-block">
                    <i class="bi bi-info-circle"></i> Select up to 4 cars to compare
                </small>
            </div>
        </div>

        <!-- Selected Cars Panel -->
        <div id="selectedPanel" class="selected-panel">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <strong>
                    <i class="bi bi-check-circle-fill text-success me-1"></i>
                    Selected Cars (<span id="selectedCount">0</span>/4)
                </strong>
                <button class="btn btn-sm btn-link text-danger" onclick="clearAllSelections()">
                    <i class="bi bi-trash"></i> Clear All
                </button>
            </div>
            <div id="selectedCarsList" class="d-flex flex-wrap gap-2">
                <!-- Selected badges will appear here -->
            </div>
        </div>

        <!-- Comparison Table -->
        <?php if (!empty($vehicles) && count($vehicles) >= 2): ?>
            <div class="comparison-card card">
                <div class="card-body">
                    <div class="comparison-table-wrapper">
                        <table class="comparison-table table" id="compareTable">
                            <thead>
                                <tr>
                                    <th style="width: 200px;">Specifications</th>
                                    <?php foreach ($vehicles as $index => $car): ?>
                                        <th class="vehicle-header">
                                            <button class="remove-vehicle-btn" onclick="removeColumn(<?= $index + 1 ?>)">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                            <div class="vehicle-name">
                                                <?= esc($car['make']) ?>         <?= esc($car['model']) ?>
                                            </div>
                                            <?php if (!empty($car['variant'])): ?>
                                                <small><?= esc($car['variant']) ?></small>
                                            <?php endif; ?>
                                            <?php if (!empty($car['image_url'])): ?>
                                                <div>
                                                    <img src="<?= esc($car['image_url']) ?>" alt="<?= esc($car['model']) ?>"
                                                        class="vehicle-image">
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($car['brochure_url'])): ?>
                                                <div class="mt-2">
                                                    <a href="<?= esc($car['brochure_url']) ?>" target="_blank"
                                                        class="btn vehicle-brochure-btn btn-sm">
                                                        <i class="bi bi-file-earmark-text"></i> Brochure
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><i class="bi bi-calendar3 text-primary me-2"></i> Year</th>
                                    <?php foreach ($vehicles as $car): ?>
                                        <td><strong><?= esc($car['year']) ?></strong></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-fuel-pump text-primary me-2"></i> Fuel Type</th>
                                    <?php foreach ($vehicles as $car): ?>
                                        <td><?= esc($car['fuel_type']) ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-gear-fill text-primary me-2"></i> Transmission</th>
                                    <?php foreach ($vehicles as $car): ?>
                                        <td><?= esc($car['transmission']) ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-speedometer2 text-primary me-2"></i> Engine (CC)</th>
                                    <?php foreach ($vehicles as $car): ?>
                                        <td><?= number_format(esc($car['engine_cc'])) ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-lightning-charge-fill text-primary me-2"></i> Power (BHP)</th>
                                    <?php foreach ($vehicles as $car): ?>
                                        <td><?= number_format(esc($car['power_bhp'])) ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-arrow-repeat text-primary me-2"></i> Torque (Nm)</th>
                                    <?php foreach ($vehicles as $car): ?>
                                        <td><?= number_format(esc($car['torque_nm'])) ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-droplet-half text-primary me-2"></i> Mileage (kmpl)</th>
                                    <?php foreach ($vehicles as $car): ?>
                                        <td><?= esc($car['mileage_kmpl']) ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-people-fill text-primary me-2"></i> Seating Capacity</th>
                                    <?php foreach ($vehicles as $car): ?>
                                        <td><?= esc($car['seating_capacity']) ?> Seats</td>
                                    <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th><i class="bi bi-box-seam text-primary me-2"></i> Boot Space (L)</th>
                                    <?php foreach ($vehicles as $car): ?>
                                        <td><?= number_format(esc($car['boot_space_liters'])) ?> L</td>
                                    <?php endforeach; ?>
                                </tr>
                                <!-- Ex-Showroom Price Row -->
<tr class="table-active">
    <th><i class="bi bi-currency-rupee text-success me-2"></i> Ex-Showroom Price</th>
    <?php foreach ($vehicles as $car): ?>
        <td class="price-highlight">
            <?= esc($car['currency'] ?? '₹') ?> 
            <?= number_format(floatval($car['ex_showroom_price'] ?? 0), 2) ?>
        </td>
    <?php endforeach; ?>
</tr>

<!-- On-Road Price Row -->
<tr>
    <th><i class="bi bi-cash-stack text-primary me-2"></i> On-Road Price</th>
    <?php foreach ($vehicles as $car): ?>
        <td>
            <strong><?= esc($car['currency'] ?? '₹') ?> 
            <?= number_format(floatval($car['on_road_price'] ?? 0), 2) ?></strong>
        </td>
    <?php endforeach; ?>
</tr>

<!-- EMI Available Row -->
<tr>
    <th><i class="bi bi-credit-card-2-front text-primary me-2"></i> EMI Available</th>
    <?php foreach ($vehicles as $car): ?>
        <td>
            <?php if (!empty($car['emi_available']) && $car['emi_available'] == 1): ?>
                <span class="badge-success-custom">
                    <i class="bi bi-check-circle"></i> Yes
                </span>
            <?php else: ?>
                <span class="badge-danger-custom">
                    <i class="bi bi-x-circle"></i> No
                </span>
            <?php endif; ?>
        </td>
    <?php endforeach; ?>
</tr>

<!-- EMI Amount Row (only show if any vehicle has EMI) -->
<?php $hasEmi = false; foreach ($vehicles as $car): if (!empty($car['emi_amount']) && $car['emi_amount'] > 0) $hasEmi = true; endforeach; ?>
<?php if ($hasEmi): ?>
<tr>
    <th><i class="bi bi-wallet2 text-primary me-2"></i> EMI Amount</th>
    <?php foreach ($vehicles as $car): ?>
        <td>
            <?php if (!empty($car['emi_amount']) && $car['emi_amount'] > 0): ?>
                <?= esc($car['currency'] ?? '₹') ?> 
                <?= number_format(floatval($car['emi_amount'] ?? 0), 2) ?>/month
            <?php else: ?>
                <span class="text-muted">—</span>
            <?php endif; ?>
        </td>
    <?php endforeach; ?>
</tr>
<?php endif; ?>

<!-- Insurance Row -->
<tr>
    <th><i class="bi bi-shield-check text-primary me-2"></i> Insurance</th>
    <?php foreach ($vehicles as $car): ?>
        <td>
            <?php if (!empty($car['insurance_cost']) && $car['insurance_cost'] > 0): ?>
                <?= esc($car['currency'] ?? '₹') ?> 
                <?= number_format(floatval($car['insurance_cost'] ?? 0), 2) ?>
            <?php else: ?>
                <span class="text-muted">—</span>
            <?php endif; ?>
        </td>
    <?php endforeach; ?>
</tr>

<!-- Offers & Discounts Row -->
<tr>
    <th><i class="bi bi-gift-fill text-primary me-2"></i> Offers & Discounts</th>
    <?php foreach ($vehicles as $car): ?>
        <td>
            <?php
            $offers = $car['discount_offers'] ?? null;
            if (!empty($offers)) {
                // If offers is a JSON string, decode it
                if (is_string($offers)) {
                    $offers = json_decode($offers, true);
                }
                // If offers is an array and not empty
                if (is_array($offers) && !empty($offers)): ?>
                    <ul class="offers-list">
                        <?php foreach ($offers as $offer): ?>
                            <li><i class="bi bi-check2-circle"></i> <?= esc($offer) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <span class="text-muted">—</span>
                <?php endif;
            } else {
                echo '<span class="text-muted">—</span>';
            }
            ?>
        </td>
    <?php endforeach; ?>
</tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php elseif (isset($vehicles) && count($vehicles) < 2): ?>
            <div class="alert alert-info text-center" style="border-radius: 20px;">
                <i class="bi bi-info-circle-fill fs-1 d-block mb-2"></i>
                <h5>Please add at least 2 cars to start comparing</h5>
                <p class="mb-0">Use the search box above to find and select cars you want to compare</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Floating Alert -->
<div id="alertBox" class="alert alert-warning alert-floating d-none" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    <span id="alertMessage"></span>
</div>

<script>
let selectedCars = [];
let searchTimeout;
let isSearchExpanded = false;
window.CARS_SEARCH_URL = "<?= site_url('cars/search') ?>";
const compareBaseUrl = "<?= site_url('cars/compare') ?>";

// Initialize on page load
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const idsParam = urlParams.get("ids");
    if (idsParam) {
        selectedCars = idsParam.split(",").map(id => parseInt(id, 10));
        updateSelectedPanel();
    }

    // Setup search input
    const searchInput = document.getElementById('carSearch');
    if (searchInput) {
        searchInput.addEventListener('input', handleSearch);
        searchInput.addEventListener('focus', expandSearchCard);
    }

    // Setup add to compare button - THIS WILL CLOSE THE OVERLAY
    const addBtn = document.getElementById('addToCompareBtn');
    if (addBtn) {
        addBtn.addEventListener('click', function() {
            if (selectedCars.length >= 2) {
                // Close overlay before proceeding
                if (isSearchExpanded) {
                    collapseSearchCard();
                }
                proceedToCompare();
            } else {
                showAlert(`Please select at least 2 cars to compare (${selectedCars.length} selected)`, 'warning');
                // Keep overlay open if not enough cars selected
            }
        });
    }

    // Close search overlay button (X button)
    const closeBtn = document.getElementById('closeSearchOverlay');
    if (closeBtn) {
        closeBtn.addEventListener('click', collapseSearchCard);
    }

    // Close search results when clicking outside (only when not expanded)
    document.addEventListener('click', function (e) {
        const searchCard = document.getElementById('searchCard');
        const searchInput = document.getElementById('carSearch');
        const resultsBox = document.getElementById('searchResults');
        
        if (!isSearchExpanded && resultsBox && !searchCard.contains(e.target)) {
            resultsBox.style.display = 'none';
        }
    });
    
    // Prevent overlay from closing when clicking inside search card
    const searchCard = document.getElementById('searchCard');
    if (searchCard) {
        searchCard.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
});

// Expand search card to overlay
function expandSearchCard() {
    if (isSearchExpanded) return;
    
    const searchCard = document.getElementById('searchCard');
    const searchOverlay = document.getElementById('searchOverlay');
    const closeBtn = document.getElementById('closeSearchOverlay');
    const searchInput = document.getElementById('carSearch');
    
    // Add expanded classes
    searchCard.classList.add('search-card-expanded');
    searchOverlay.style.display = 'block';
    closeBtn.style.display = 'block';
    isSearchExpanded = true;
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
    
    // Focus on input
    setTimeout(() => {
        searchInput.focus();
        searchInput.select();
    }, 100);
    
    // If there's text, search immediately
    if (searchInput.value.trim().length >= 2) {
        performSearch(searchInput.value.trim());
    }
}

// Collapse search card back to normal
function collapseSearchCard() {
    if (!isSearchExpanded) return;
    
    const searchCard = document.getElementById('searchCard');
    const searchOverlay = document.getElementById('searchOverlay');
    const closeBtn = document.getElementById('closeSearchOverlay');
    const resultsBox = document.getElementById('searchResults');
    
    // Remove expanded classes
    searchCard.classList.remove('search-card-expanded');
    searchOverlay.style.display = 'none';
    closeBtn.style.display = 'none';
    resultsBox.style.display = 'none';
    isSearchExpanded = false;
    document.body.style.overflow = ''; // Restore scrolling
}

// Handle search with debounce
function handleSearch() {
    const query = this.value.trim();
    const resultsBox = document.getElementById('searchResults');
    
    // Auto-expand when typing
    if (!isSearchExpanded && query.length >= 1) {
        expandSearchCard();
    }

    if (query.length < 2) {
        resultsBox.style.display = 'none';
        return;
    }

    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => performSearch(query), 300);
}

// Perform search
function performSearch(query) {
    const resultsBox = document.getElementById('searchResults');
    if (!resultsBox) {
        console.error('Search results element not found');
        return;
    }

    // Clear previous results and show loading
    resultsBox.innerHTML = '<div class="text-center p-4"><div class="spinner-custom"></div><p class="mt-2 mb-0 text-muted">Searching...</p></div>';
    resultsBox.style.display = 'block';
    resultsBox.style.visibility = 'visible';
    resultsBox.style.opacity = '1';

    fetch(`${window.CARS_SEARCH_URL}?q=${encodeURIComponent(query)}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => {
        if (!res.ok) {
            throw new Error(`HTTP ${res.status}`);
        }
        return res.json();
    })
    .then(results => {
        resultsBox.innerHTML = '';

        if (!results || results.length === 0) {
            resultsBox.innerHTML = '<div class="text-center p-4 text-muted"><i class="bi bi-emoji-frown fs-1"></i><p class="mt-2 mb-0">No cars found</p></div>';
            resultsBox.style.display = 'block';
            return;
        }

        results.forEach(car => {
            const item = document.createElement('div');
            item.className = 'car-result-item';
            if (selectedCars.includes(car.vehicle_id)) {
                item.classList.add('active');
            }

            item.innerHTML = `
                <div class="car-result-info">
                    <h6>${escapeHtml(car.make)} ${escapeHtml(car.model)}</h6>
                    <small>${escapeHtml(car.variant || 'Standard')} • ID: ${car.vehicle_id}</small>
                </div>
                ${selectedCars.includes(car.vehicle_id) ?
                    '<i class="bi bi-check-circle-fill text-success fs-5"></i>' :
                    '<i class="bi bi-plus-circle text-primary fs-5"></i>'}
            `;

            item.onclick = (function(c, element) {
                return function() {
                    toggleCarSelection(c, element);
                    // Keep dropdown open after selection
                    resultsBox.style.display = 'block';
                    // Do NOT auto-collapse - wait for Add to Compare button
                };
            })(car, item);

            resultsBox.appendChild(item);
        });

        resultsBox.style.display = 'block';
    })
    .catch(error => {
        console.error('Search error:', error);
        resultsBox.innerHTML = '<div class="text-center p-4 text-danger"><i class="bi bi-exclamation-triangle-fill fs-1"></i><p class="mt-2 mb-0">Error searching cars. Please try again.</p></div>';
        resultsBox.style.display = 'block';
    });
}

// Toggle car selection
function toggleCarSelection(car, element) {
    const index = selectedCars.indexOf(car.vehicle_id);

    if (index === -1) {
        if (selectedCars.length >= 4) {
            showAlert('You can compare up to 4 cars at a time.', 'warning');
            return;
        }
        selectedCars.push(car.vehicle_id);
        element.classList.add('active');
        
        // Update icon
        const iconSpan = element.querySelector('.bi-plus-circle, .bi-check-circle-fill');
        if (iconSpan) {
            iconSpan.className = 'bi bi-check-circle-fill text-success fs-5';
        }
        
        showAlert(`${car.make} ${car.model} added to comparison (${selectedCars.length}/4)`, 'success');
        
        // DO NOT auto-collapse - keep overlay open for more selections
    } else {
        selectedCars.splice(index, 1);
        element.classList.remove('active');
        
        const iconSpan = element.querySelector('.bi-check-circle-fill, .bi-plus-circle');
        if (iconSpan) {
            iconSpan.className = 'bi bi-plus-circle text-primary fs-5';
        }
        
        showAlert(`${car.make} ${car.model} removed from comparison`, 'info');
    }

    updateSelectedPanel();
}

// Update selected cars panel
function updateSelectedPanel() {
    const panel = document.getElementById('selectedPanel');
    const countSpan = document.getElementById('selectedCount');
    const listContainer = document.getElementById('selectedCarsList');

    if (selectedCars.length > 0) {
        panel.style.display = 'block';
        countSpan.textContent = selectedCars.length;

        listContainer.innerHTML = '';
        selectedCars.forEach(carId => {
            const badge = document.createElement('div');
            badge.className = 'selected-badge-item';
            badge.innerHTML = `
                <i class="bi bi-car-front"></i>
                <span>Car ID: ${carId}</span>
                <button class="btn btn-sm p-0" onclick="removeSelectedCar(${carId})">
                    <i class="bi bi-x-circle-fill text-danger"></i>
                </button>
            `;
            listContainer.appendChild(badge);
        });
    } else {
        panel.style.display = 'none';
    }
}

// Remove selected car
function removeSelectedCar(carId) {
    selectedCars = selectedCars.filter(id => id !== carId);
    updateSelectedPanel();

    // Update search results active state
    document.querySelectorAll('.car-result-item').forEach(item => {
        if (item.querySelector('h6')?.innerHTML.includes(carId)) {
            item.classList.remove('active');
            const icon = item.querySelector('.bi-check-circle-fill');
            if (icon) {
                icon.className = 'bi bi-plus-circle text-primary fs-5';
            }
        }
    });

    showAlert('Car removed from comparison', 'info');
    
    // Keep overlay open if expanded
}

// Clear all selections
function clearAllSelections() {
    if (confirm('Remove all cars from comparison? This will clear your selection.')) {
        selectedCars = [];
        updateSelectedPanel();
        
        document.querySelectorAll('.car-result-item').forEach(item => {
            item.classList.remove('active');
            const icon = item.querySelector('.bi-check-circle-fill');
            if (icon) {
                icon.className = 'bi bi-plus-circle text-primary fs-5';
            }
        });
        
        showAlert('All cars cleared from comparison', 'success');
        
        // Keep overlay open if expanded - user might want to add new cars
    }
}

// Proceed to compare
function proceedToCompare() {
    if (selectedCars.length < 2) {
        showAlert(`Please select at least 2 cars to compare (${selectedCars.length} selected)`, 'warning');
        // Expand search card if not enough cars
        if (!isSearchExpanded) {
            expandSearchCard();
        }
        return;
    }

    const idsParam = selectedCars.join(',');
    window.location.href = `${compareBaseUrl}?ids=${idsParam}`;
}

// Remove column from table
function removeColumn(colIndex) {
    const table = document.getElementById("compareTable");
    if (!table) return;

    const totalCols = table.rows[0].cells.length;
    if (totalCols <= 3) {
        showAlert("You must keep at least two cars for comparison.", 'warning');
        return;
    }

    if (confirm('Are you sure you want to remove this car from comparison?')) {
        for (let row of table.rows) {
            if (row.cells[colIndex]) {
                row.deleteCell(colIndex);
            }
        }

        // Update URL
        const urlParams = new URLSearchParams(window.location.search);
        let ids = urlParams.get("ids") ? urlParams.get("ids").split(",") : [];
        if (ids.length >= colIndex) {
            ids.splice(colIndex - 1, 1);
            
            if (ids.length < 2) {
                showAlert('Less than 2 cars remaining. Redirecting...', 'warning');
                setTimeout(() => {
                    window.location.href = "<?= site_url('cars/compareHome') ?>";
                }, 500);
            } else {
                urlParams.set("ids", ids.join(","));
                const newUrl = window.location.pathname + "?" + urlParams.toString();
                window.history.replaceState({}, "", newUrl);
                showAlert('Car removed from comparison', 'success');
            }
        }
    }
}

// Show alert message
function showAlert(message, type = 'warning') {
    const alertBox = document.getElementById("alertBox");
    const alertMessage = document.getElementById("alertMessage");

    alertBox.className = `alert alert-floating d-none`;
    if (type === 'success') {
        alertBox.classList.add('alert-success');
    } else if (type === 'danger') {
        alertBox.classList.add('alert-danger');
    } else if (type === 'info') {
        alertBox.classList.add('alert-info');
    } else {
        alertBox.classList.add('alert-warning');
    }

    alertMessage.textContent = message;
    alertBox.classList.remove("d-none");

    setTimeout(() => {
        alertBox.classList.add("d-none");
    }, 3000);
}

// Escape HTML helper
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Handle escape key to close overlay
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && isSearchExpanded) {
        collapseSearchCard();
    }
});
</script>