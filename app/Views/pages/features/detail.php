<?php
helper('url');

$vehicle = $vehicle ?? [];
$pricing = $pricing ?? [];

$title = trim(($vehicle['make'] ?? '') . ' ' . ($vehicle['model'] ?? '') . ' ' . ($vehicle['variant'] ?? ''));
$image = !empty($vehicle['image_url'])
    ? $vehicle['image_url']
    : base_url('assets/images/default-car.png');


function featureList($value)
{
    if (empty($value)) {
        return [];
    }

    if (is_array($value)) {
        return $value;
    }

    if (is_string($value)) {
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }
    }

    return [];
}

$safetyFeatures = featureList($vehicle['safety_features'] ?? []);
$infotainmentFeatures = featureList($vehicle['infotainment'] ?? []);
$comfortFeatures = featureList($vehicle['comfort_features'] ?? []);
$interiorFeatures = featureList($vehicle['interior_features'] ?? []);
$exteriorFeatures = featureList($vehicle['exterior_features'] ?? []);
$cameraFeatures = featureList($vehicle['camera_features'] ?? []);
$colorOptions = featureList($vehicle['color_options'] ?? []);
$warranty = featureList($vehicle['warranty'] ?? []);
?>

<div class="container py-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('features') ?>">Features</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= esc($title) ?>
            </li>
        </ol>
    </nav>

    <div class="row g-4 mb-4">
        <div class="col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="ratio ratio-4x3 bg-light">
                    <img src="<?= esc($image) ?>"
                         alt="<?= esc($title) ?>"
                         class="w-100 h-100 object-fit-cover">
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <h1 class="mb-2"><?= esc($title) ?></h1>

            <div class="mb-3">
                <span class="badge bg-primary me-1"><?= esc($vehicle['body_type'] ?? 'N/A') ?></span>
                <span class="badge bg-secondary me-1"><?= esc($vehicle['fuel_type'] ?? 'N/A') ?></span>
                <span class="badge bg-dark"><?= esc($vehicle['transmission'] ?? 'N/A') ?></span>
            </div>

            <div class="fs-4 fw-semibold text-primary mb-3">
                <?= !empty($pricing['ex_showroom_price']) ? '₹' . number_format($pricing['ex_showroom_price'], 0) : 'Price Not Available' ?>
            </div>

            <div class="row g-3">
                <div class="col-sm-6">
                    <div class="p-3 border rounded bg-light">
                        <div class="text-muted small">Engine</div>
                        <div class="fw-semibold"><?= !empty($vehicle['engine_cc']) ? esc($vehicle['engine_cc']) . ' cc' : 'N/A' ?></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="p-3 border rounded bg-light">
                        <div class="text-muted small">Power</div>
                        <div class="fw-semibold"><?= !empty($vehicle['power_bhp']) ? esc($vehicle['power_bhp']) . ' bhp' : 'N/A' ?></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="p-3 border rounded bg-light">
                        <div class="text-muted small">Torque</div>
                        <div class="fw-semibold"><?= !empty($vehicle['torque_nm']) ? esc($vehicle['torque_nm']) . ' Nm' : 'N/A' ?></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="p-3 border rounded bg-light">
                        <div class="text-muted small">Mileage</div>
                        <div class="fw-semibold"><?= esc($vehicle['mileage'] ?? ($vehicle['mileage_kmpl'] ?? 'N/A')) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Safety Features</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($safetyFeatures)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($safetyFeatures as $item): ?>
                                <li class="list-group-item px-0"><?= esc(is_array($item) ? json_encode($item) : $item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">No safety feature data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Infotainment</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($infotainmentFeatures)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($infotainmentFeatures as $item): ?>
                                <li class="list-group-item px-0"><?= esc(is_array($item) ? json_encode($item) : $item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">No infotainment data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Comfort Features</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($comfortFeatures)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($comfortFeatures as $item): ?>
                                <li class="list-group-item px-0"><?= esc(is_array($item) ? json_encode($item) : $item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">No comfort feature data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Interior Features</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($interiorFeatures)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($interiorFeatures as $item): ?>
                                <li class="list-group-item px-0"><?= esc(is_array($item) ? json_encode($item) : $item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">No interior feature data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Exterior Features</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($exteriorFeatures)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($exteriorFeatures as $item): ?>
                                <li class="list-group-item px-0"><?= esc(is_array($item) ? json_encode($item) : $item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">No exterior feature data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Camera Features</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($cameraFeatures)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($cameraFeatures as $item): ?>
                                <li class="list-group-item px-0"><?= esc(is_array($item) ? json_encode($item) : $item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">No camera feature data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Dimensions</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($vehicle['dimensions_formatted'])): ?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">Length: <?= esc($vehicle['dimensions_formatted']['length'] ?? 'N/A') ?></li>
                            <li class="list-group-item px-0">Width: <?= esc($vehicle['dimensions_formatted']['width'] ?? 'N/A') ?></li>
                            <li class="list-group-item px-0">Height: <?= esc($vehicle['dimensions_formatted']['height'] ?? 'N/A') ?></li>
                            <li class="list-group-item px-0">Wheelbase: <?= esc($vehicle['dimensions_formatted']['wheelbase'] ?? 'N/A') ?></li>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">No dimension data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Pricing Details</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">
                            Ex-showroom Price: <strong><?= !empty($pricing['ex_showroom_price']) ? '₹' . number_format($pricing['ex_showroom_price'], 0) : 'N/A' ?></strong>
                        </li>
                        <li class="list-group-item px-0">
                            On-road Price: <strong><?= !empty($pricing['on_road_price']) ? '₹' . number_format($pricing['on_road_price'], 0) : 'N/A' ?></strong>
                        </li>
                        <li class="list-group-item px-0">
                            EMI Available: <strong><?= !empty($pricing['emi_available']) ? 'Yes' : 'No' ?></strong>
                        </li>
                        <li class="list-group-item px-0">
                            EMI Amount: <strong><?= !empty($pricing['emi_amount']) ? '₹' . number_format($pricing['emi_amount'], 0) : 'N/A' ?></strong>
                        </li>
                        <li class="list-group-item px-0">
                            Down Payment: <strong><?= !empty($pricing['down_payment']) ? '₹' . number_format($pricing['down_payment'], 0) : 'N/A' ?></strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($colorOptions) || !empty($warranty)): ?>
        <div class="row g-4 mt-1">
            <?php if (!empty($colorOptions)): ?>
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Color Options</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($colorOptions as $item): ?>
                                    <li class="list-group-item px-0"><?= esc(is_array($item) ? json_encode($item) : $item) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($warranty)): ?>
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Warranty</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($warranty as $item): ?>
                                    <li class="list-group-item px-0"><?= esc(is_array($item) ? json_encode($item) : $item) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
