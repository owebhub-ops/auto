<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h4 mb-1">Vehicles</h1>
            <div class="text-muted small">
                Manage all vehicles (<?= $pager ? $pager->getTotal('vehicles') : 0 ?> total)
            </div>
        </div>
        <a href="<?= site_url("admin/vehicle/create") ?>" class="btn btn-primary">
            Add Vehicle
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (empty($vehicles)): ?>
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>No vehicles found.
            <a href="<?= site_url("admin/vehicle/create") ?>" class="alert-link">
                Create the first vehicle
            </a>.
        </div>
    <?php else: ?>
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60px;">ID</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Fuel</th>
                                <th>Price</th>
                                <th style="width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vehicles as $vehicle): ?>
                                <tr>
                                    <td><?= esc($vehicle['vehicle_id']) ?></td>
                                    <td><?= esc($vehicle['make']) ?></td>
                                    <td><?= esc($vehicle['model']) ?></td>
                                    <td><?= esc($vehicle['year']) ?></td>
                                    <td><?= esc($vehicle['fuel_type']) ?></td>
                                    <td>
                                        <?php if (!empty($vehicle['pricing'])): ?>
                                            <?= esc(number_format($vehicle['pricing']['ex_showroom_price'], 2)) ?> <?= esc($vehicle['pricing']['currency']) ?>
                                        <?php else: ?>
                                            <span class="text-muted">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= site_url("admin/vehicle/edit/{$vehicle['vehicle_id']}") ?>"
                                            class="btn btn-warning btn-sm me-1">Edit</a>

                                        <a href="<?= site_url("admin/vehicle/show/{$vehicle['vehicle_id']}") ?>"
                                            class="btn btn-info btn-sm me-1" target="_blank" rel="noopener">
                                            View
                                        </a>

                                        <?= form_open("admin/vehicle/delete/{$vehicle['vehicle_id']}", ['style' => 'display:inline;']) ?>
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                            Delete
                                        </button>
                                        <?= form_close() ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-muted small mt-2">
            Manage vehicles (<?= $pager ? $pager->getTotal('vehicles') : 0 ?> total, page
            <?= $pager ? $pager->getCurrentPage('vehicles') : 1 ?> of <?= $pager ? $pager->getPageCount('vehicles') : 1 ?>)
        </div>

        <?php if ($pager && $pager->getPageCount('vehicles') > 1): ?>
            <nav aria-label="Page navigation" class="mt-4">
                <?= $pager->links('vehicles', 'bootstrap_pagination') ?>
            </nav>
        <?php endif; ?>
    <?php endif; ?>
</div>
