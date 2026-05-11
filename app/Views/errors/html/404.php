<div class="container py-5 py-lg-7">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <i class="bi bi-exclamation-triangle display-1 text-warning mb-4"></i>
            <h1 class="display-3 fw-bold text-dark mb-3">404</h1>
            <h2 class="h2 fw-normal text-muted mb-4"><?= esc($message ?? 'Page Not Found') ?></h2>
            <p class="lead mb-5"><?= $description ?></p>

            <div class="d-grid gap-3 d-md-flex justify-content-md-center">
                <a href="<?= base_url() ?>" class="btn btn-primary btn-lg px-5">
                    <i class="bi bi-house me-2"></i>Go Home
                </a>
                <a href="javascript:history.back()" class="btn btn-outline-secondary btn-lg px-5">
                    <i class="bi bi-arrow-left me-2"></i>Go Back
                </a>
            </div>
        </div>
    </div>
</div>