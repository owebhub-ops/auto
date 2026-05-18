<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">
            <?= esc($vehicle['make']) ?> <?= esc($vehicle['model']) ?> (<?= esc($vehicle['year']) ?>)
        </h1>
        <a href="<?= site_url("admin/vehicle") ?>" class="btn btn-secondary">Back to Vehicles</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Vehicle Specs -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <i class="bi bi-car-front me-2"></i><strong>Vehicle Specifications</strong>
        </div>
        <div class="card-body">
            <table class="table table-sm table-borderless mb-0">
                <tbody>
                    <tr>
                        <th>Make</th>
                        <td><?= esc($vehicle['make']) ?></td>
                        <th>Model</th>
                        <td><?= esc($vehicle['model']) ?></td>
                        <th>Variant</th>
                        <td><?= esc($vehicle['variant']) ?></td>
                    </tr>
                    <tr>
                        <th>Year</th>
                        <td><?= esc($vehicle['year']) ?></td>
                        <th>Fuel Type</th>
                        <td><?= esc($vehicle['fuel_type']) ?></td>
                        <th>Transmission</th>
                        <td><?= esc($vehicle['transmission']) ?></td>
                    </tr>
                    <tr>
                        <th>Engine CC</th>
                        <td><?= esc($vehicle['engine_cc']) ?></td>
                        <th>Power (BHP)</th>
                        <td><?= esc($vehicle['power_bhp']) ?></td>
                        <th>Torque (Nm)</th>
                        <td><?= esc($vehicle['torque_nm']) ?></td>
                    </tr>
                    <tr>
                        <th>Mileage (kmpl)</th>
                        <td><?= esc($vehicle['mileage_kmpl']) ?></td>
                        <th>Seating Capacity</th>
                        <td><?= esc($vehicle['seating_capacity']) ?></td>
                        <th>Boot Space (L)</th>
                        <td><?= esc($vehicle['boot_space_liters']) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Vehicle Media -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <i class="bi bi-images me-2"></i><strong>Vehicle Media</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong><i class="bi bi-image me-2"></i>Image:</strong><br>
                    <?php if (!empty($vehicle['image_url'])): ?>
                        <img src="<?= esc($vehicle['image_url']) ?>" alt="Vehicle Image"
                            class="img-fluid rounded border shadow-sm" style="max-height:200px;">
                    <?php else: ?>
                        <span class="text-muted">No image available</span>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                    <strong><i class="bi bi-file-earmark-pdf me-2"></i>Brochure:</strong><br>
                    <?php if (!empty($vehicle['brochure_url'])): ?>
                        <a href="<?= esc($vehicle['brochure_url']) ?>" target="_blank"
                            class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-download me-1"></i>Download Brochure
                        </a>
                    <?php else: ?>
                        <span class="text-muted">No brochure available</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


    <!-- JSON Feature Details -->
    <div class="card shadow-sm mb-4">
        <div class="card-header"><strong>Features & Specs (JSON)</strong></div>
        <div class="card-body">
            <div class="mb-2"><strong>Suspension:</strong>
                <pre><?= esc($vehicle['suspension']) ?></pre>
            </div>
            <div class="mb-2"><strong>Brakes:</strong>
                <pre><?= esc($vehicle['brakes']) ?></pre>
            </div>
            <div class="mb-2"><strong>Safety Features:</strong>
                <pre><?= esc($vehicle['safety_features']) ?></pre>
            </div>
            <div class="mb-2"><strong>Infotainment:</strong>
                <pre><?= esc($vehicle['infotainment']) ?></pre>
            </div>
            <div class="mb-2"><strong>Comfort Features:</strong>
                <pre><?= esc($vehicle['comfort_features']) ?></pre>
            </div>
            <div class="mb-2"><strong>Interior Features:</strong>
                <pre><?= esc($vehicle['interior_features']) ?></pre>
            </div>
            <div class="mb-2"><strong>Exterior Features:</strong>
                <pre><?= esc($vehicle['exterior_features']) ?></pre>
            </div>
            <div class="mb-2"><strong>Color Options:</strong>
                <pre><?= esc($vehicle['color_options']) ?></pre>
            </div>
            <div class="mb-2"><strong>Warranty:</strong>
                <pre><?= esc($vehicle['warranty']) ?></pre>
            </div>
        </div>
    </div>

    <!-- Pricing Details -->
    <div class="card shadow-sm mb-4">
        <div class="card-header"><strong>Pricing Details</strong></div>
        <div class="card-body">
            <?php if (!empty($vehicle['ex_showroom_price'])): ?>
                <table class="table table-bordered mb-0">
                    <tr>
                        <th>Ex-Showroom Price</th>
                        <td><?= esc($vehicle['ex_showroom_price']) ?>     <?= esc($vehicle['currency']) ?></td>
                    </tr>
                    <tr>
                        <th>On-Road Price</th>
                        <td><?= esc($vehicle['on_road_price']) ?>     <?= esc($vehicle['currency']) ?></td>
                    </tr>
                    <tr>
                        <th>EMI Available</th>
                        <td><?= $vehicle['emi_available'] ? 'Yes' : 'No' ?></td>
                    </tr>
                    <tr>
                        <th>EMI Amount</th>
                        <td><?= esc($vehicle['emi_amount']) ?></td>
                    </tr>
                    <tr>
                        <th>Down Payment</th>
                        <td><?= esc($vehicle['down_payment']) ?></td>
                    </tr>
                    <tr>
                        <th>Insurance Cost</th>
                        <td><?= esc($vehicle['insurance_cost']) ?></td>
                    </tr>
                    <tr>
                        <th>Road Tax</th>
                        <td><?= esc($vehicle['road_tax']) ?></td>
                    </tr>
                    <tr>
                        <th>Discount Offers</th>
                        <td>
                            <pre><?= esc($vehicle['discount_offers']) ?></pre>
                        </td>
                    </tr>
                    <tr>
                        <th>Price Validity</th>
                        <td><?= esc($vehicle['price_validity']) ?></td>
                    </tr>
                </table>
            <?php else: ?>
                <div class="alert alert-info mb-0">No pricing details available for this vehicle.</div>
            <?php endif; ?>
        </div>
    </div>



    <!-- Actions -->
    <div class="d-flex">
        <a href="<?= site_url("admin/vehicle/edit/{$vehicle['vehicle_id']}") ?>" class="btn btn-warning me-2">Edit
            Vehicle Information</a>
        <?= form_open("admin/vehicle/delete/{$vehicle['vehicle_id']}", ['style' => 'display:inline;']) ?>
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-danger"
            onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete Vehicle</button>
        <?= form_close() ?>
    </div>
</div>