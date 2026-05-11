<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 mb-1">Contact Details</h1>
            <div class="text-muted small">Contact #<?= esc($contact['id']) ?> - <?= esc($contact['subject']) ?></div>
        </div>
        <div>
            <a href="<?= site_url('admin/contact') ?>" class="btn btn-secondary">← Back to List</a>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><?= esc($contact['subject']) ?></h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Message:</label>
                        <p class="form-control-plaintext p-3 bg-light rounded"><?= esc($contact['message']) ?></p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Submitted:</label>
                            <p class="form-control-plaintext"><?= date('M d, Y H:i', strtotime($contact['created_at'])) ?></p>
                        </div>
                        <?php if (isset($contact['updated_at']) && !empty($contact['updated_at']) && $contact['updated_at'] !== $contact['created_at']): ?>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Updated:</label>
                            <p class="form-control-plaintext"><?= date('M d, Y H:i', strtotime($contact['updated_at'])) ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Contact Information</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Name</label>
                        <p class="mb-1 h6"><?= esc($contact['name']) ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Email</label>
                        <a href="mailto:<?= esc($contact['email']) ?>" class="d-block h6 mb-0"><?= esc($contact['email']) ?></a>
                    </div>

                    <?php if (!empty($contact['phone'])): ?>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Phone</label>
                        <a href="tel:<?= esc($contact['phone']) ?>" class="d-block h6 mb-0"><?= esc($contact['phone']) ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card shadow-sm mt-3">
                <div class="card-body text-center p-4">
                    <?= form_open("admin/contact/delete/{$contact['id']}", ['style' => 'display:inline;']) ?>
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger btn-lg w-100" onclick="return confirm('Are you sure you want to delete this contact? This cannot be undone.')">
                        <i class="bi bi-trash me-2"></i>Delete Contact
                    </button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>