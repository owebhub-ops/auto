<div class="row justify-content-center">
    <div class="col-lg-6 text-center">
        <i class="bi bi-bug display-1 text-danger mb-4"></i>
        <h1 class="display-3 fw-bold text-danger mb-3">500</h1>
        <h2 class="h2 fw-normal text-muted mb-4">Server Error</h2>
        <p class="lead mb-5"><?= $description ?></p>
        <div class="alert alert-warning">
            <i class="bi bi-info-circle me-2"></i>
            Refreshing the page might help.
        </div>
        <a href="<?= base_url() ?>" class="btn btn-primary btn-lg px-5">
            <i class="bi bi-arrow-clockwise me-2"></i>Retry
        </a>
    </div>