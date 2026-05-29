<?php 
// ✅ SAFE ACCESS - Prevent undefined key errors
$stats             = $stats ?? [];
$total_vehicles    = $stats['total_vehicles'] ?? 0;
$owned_vehicles    = $stats['owned_vehicles'] ?? 0;
$wishlist_count    = $stats['wishlist_count'] ?? 0;
$comparison_count  = $stats['comparison_count'] ?? 0;
$recent_vehicles   = $recent_vehicles ?? [];
$userName          = esc(session()->get('user_name') ?: 'User');
$userAvatar        = esc(session()->get('user_avatar') ?: base_url('public/assets/img/avatar-car.png'));
?>

<div class="container-fluid py-4">
    <!-- Welcome Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <img src="<?= $userAvatar ?>" 
                     class="rounded-circle me-4 shadow-lg" width="80" height="80" alt="<?= $userName ?> Avatar">
                <div>
                    <h1 class="mb-1 fw-bold">Welcome back, <?= $userName ?>!</h1>
                    <p class="text-muted mb-0">Here’s your automotive dashboard</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 text-center bg-primary text-white">
                <div class="card-body py-4">
                    <i class="bi bi-car-front-fill display-4 opacity-75 mb-3"></i>
                    <div class="h2 fw-bold mb-1"><?= $total_vehicles ?></div>
                    <div class="h6 mb-0">Vehicles Listed</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 text-center bg-success text-white">
                <div class="card-body py-4">
                    <i class="bi bi-check-circle-fill display-4 opacity-75 mb-3"></i>
                    <div class="h2 fw-bold mb-1"><?= $owned_vehicles ?></div>
                    <div class="h6 mb-0">Owned Vehicles</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 text-center bg-warning text-white">
                <div class="card-body py-4">
                    <i class="bi bi-heart-fill display-4 opacity-75 mb-3"></i>
                    <div class="h2 fw-bold mb-1"><?= $wishlist_count ?></div>
                    <div class="h6 mb-0">Wishlist</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 text-center bg-info text-white">
                <div class="card-body py-4">
                    <i class="bi bi-bar-chart-fill display-4 opacity-75 mb-3"></i>
                    <div class="h2 fw-bold mb-1"><?= $comparison_count ?></div>
                    <div class="h6 mb-0">Comparisons</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Quick Actions -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header border-0 pb-0">
                    <h5 class="card-title mb-3">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="<?= base_url('cars/my-garage') ?>" class="card border-0 shadow-sm h-100 text-decoration-none hover-lift">
                                <div class="card-body text-center py-4">
                                    <i class="bi bi-house-door-fill display-4 text-primary mb-3"></i>
                                    <h6 class="fw-bold mb-1">My Garage</h6>
                                    <p class="text-muted small mb-0">View your owned cars</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="<?= base_url('cars/compare') ?>" class="card border-0 shadow-sm h-100 text-decoration-none hover-lift">
                                <div class="card-body text-center py-4">
                                    <i class="bi bi-diagram-3-fill display-4 text-success mb-3"></i>
                                    <h6 class="fw-bold mb-1">Compare Cars</h6>
                                    <p class="text-muted small mb-0">Side-by-side comparison</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Vehicles -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header border-0">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-clock-history me-2"></i>Recently Viewed
                    </h6>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($recent_vehicles)): ?>
                        <?php foreach ($recent_vehicles as $vehicle): ?>
                        <a href="<?= base_url("cars/detail/{$vehicle['slug']}") ?>" class="list-group-item list-group-item-action border-0 px-3 py-3 hover-light">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="<?= esc($vehicle['image_url'] ?? base_url('public/assets/img/car-default.png')) ?>" 
                                         class="rounded shadow-sm" width="48" height="32" alt="Car">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-bold text-truncate" style="max-width: 200px;">
                                        <?= esc($vehicle['make'] . ' ' . $vehicle['model'] . ' ' . ($vehicle['variant'] ?? '')) ?>
                                    </div>
                                    <small class="text-muted">
                                        Price: ₹<?= number_format($vehicle['ex_showroom_price'] ?? 0, 0, '.', ',') ?>
                                    </small>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-inbox display-4 opacity-25 mb-3"></i>
                            <p class="mb-0">No recent vehicles</p>
                            <a href="<?= base_url('cars') ?>" class="btn btn-outline-primary btn-sm mt-2">Browse Cars</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-lift {
    transition: all 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}
.hover-light:hover {
    background-color: rgba(0,0,0,0.025) !important;
}
</style>
