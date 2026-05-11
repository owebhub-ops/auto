<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-1">Admin Settings</h1>
        <div class="text-muted small">Configure platform options</div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label class="form-label">Site Name</label>
                <input type="text" class="form-control" value="<?= esc($settings['site_name'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Support Email</label>
                <input type="email" class="form-control" value="<?= esc($settings['site_email'] ?? '') ?>">
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="maintenanceMode" <?= !empty($settings['maintenance_mode']) ? 'checked' : '' ?>>
                <label class="form-check-label" for="maintenanceMode">Maintenance Mode</label>
            </div>

            <button type="submit" class="btn btn-success">Save Settings</button>
        </form>
    </div>
</div>