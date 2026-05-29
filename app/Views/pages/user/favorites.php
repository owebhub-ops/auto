<div class="container py-4">
    <h1 class="fw-bold mb-4">My Favorites</h1>

    <?php if (!empty($favorites)): ?>
        <div class="row g-4">
            <?php foreach ($favorites as $car): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="<?= esc($car['image_url'] ?? base_url('public/assets/img/car-default.png')) ?>" 
                             class="card-img-top" alt="Car">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($car['make'].' '.$car['model'].' '.($car['variant'] ?? '')) ?></h5>
                            <p class="card-text">₹<?= number_format($car['ex_showroom_price'] ?? 0, 0, '.', ',') ?></p>
                            <a href="<?= base_url("cars/detail/{$car['slug']}") ?>" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center text-muted">
            <i class="bi bi-heart display-4 opacity-25 mb-3"></i>
            <p>No favorites yet</p>
            <a href="<?= base_url('cars') ?>" class="btn btn-outline-primary btn-sm">Browse Cars</a>
        </div>
    <?php endif; ?>
</div>
