<div class="container py-4">
    <h1 class="h4 mb-3">Edit Vehicle: <?= esc($vehicle['make']) ?> <?= esc($vehicle['model']) ?></h1>

    <form action="<?= site_url("admin/vehicle/update/{$vehicle['vehicle_id']}") ?>" method="post">
        <?= csrf_field() ?>

        <!-- Basic Fields -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="make" class="form-label">Make</label>
                <input type="text" name="make" id="make" class="form-control" value="<?= esc($vehicle['make']) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" name="model" id="model" class="form-control" value="<?= esc($vehicle['model']) ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="variant" class="form-label">Variant</label>
                <input type="text" name="variant" id="variant" class="form-control"
                    value="<?= esc($vehicle['variant']) ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" name="year" id="year" class="form-control" value="<?= esc($vehicle['year']) ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="fuel_type" class="form-label">Fuel Type</label>
                <input type="text" name="fuel_type" id="fuel_type" class="form-control"
                    value="<?= esc($vehicle['fuel_type']) ?>">
            </div>
        </div>

        <!-- JSON Fields -->
        <div class="mb-3">
            <label for="suspension" class="form-label">Suspension (JSON)</label>
            <textarea name="suspension" id="suspension"
                class="form-control"><?= esc($vehicle['suspension']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="brakes" class="form-label">Brakes (JSON)</label>
            <textarea name="brakes" id="brakes" class="form-control"><?= esc($vehicle['brakes']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="safety_features" class="form-label">Safety Features (JSON)</label>
            <textarea name="safety_features" id="safety_features"
                class="form-control"><?= esc($vehicle['safety_features']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="infotainment" class="form-label">Infotainment (JSON)</label>
            <textarea name="infotainment" id="infotainment"
                class="form-control"><?= esc($vehicle['infotainment']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="comfort_features" class="form-label">Comfort Features (JSON)</label>
            <textarea name="comfort_features" id="comfort_features"
                class="form-control"><?= esc($vehicle['comfort_features']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="interior_features" class="form-label">Interior Features (JSON)</label>
            <textarea name="interior_features" id="interior_features"
                class="form-control"><?= esc($vehicle['interior_features']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="exterior_features" class="form-label">Exterior Features (JSON)</label>
            <textarea name="exterior_features" id="exterior_features"
                class="form-control"><?= esc($vehicle['exterior_features']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="color_options" class="form-label">Color Options (JSON)</label>
            <textarea name="color_options" id="color_options"
                class="form-control"><?= esc($vehicle['color_options']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="warranty" class="form-label">Warranty (JSON)</label>
            <textarea name="warranty" id="warranty" class="form-control"><?= esc($vehicle['warranty']) ?></textarea>
        </div>



        <!-- Pricing Section -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light">
                <strong>Pricing Details</strong>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="ex_showroom_price">Ex-Showroom Price</label>
                    <input type="number" step="0.01" name="ex_showroom_price" class="form-control"
                        value="<?= esc($pricing['ex_showroom_price'] ?? '') ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="on_road_price">On-Road Price</label>
                    <input type="number" step="0.01" name="on_road_price" class="form-control"
                        value="<?= esc($pricing['on_road_price'] ?? '') ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="emi_available">EMI Available</label>
                    <select name="emi_available" class="form-control">
                        <option value="0" <?= (isset($pricing['emi_available']) && $pricing['emi_available'] == 0) ? 'selected' : '' ?>>No</option>
                        <option value="1" <?= (isset($pricing['emi_available']) && $pricing['emi_available'] == 1) ? 'selected' : '' ?>>Yes</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="emi_amount">EMI Amount</label>
                    <input type="number" step="0.01" name="emi_amount" class="form-control"
                        value="<?= esc($pricing['emi_amount'] ?? '') ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="down_payment">Down Payment</label>
                    <input type="number" step="0.01" name="down_payment" class="form-control"
                        value="<?= esc($pricing['down_payment'] ?? '') ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="insurance_cost">Insurance Cost</label>
                    <input type="number" step="0.01" name="insurance_cost" class="form-control"
                        value="<?= esc($pricing['insurance_cost'] ?? '') ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="road_tax">Road Tax</label>
                    <input type="number" step="0.01" name="road_tax" class="form-control"
                        value="<?= esc($pricing['road_tax'] ?? '') ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="discount_offers">Discount Offers (JSON)</label>
                    <textarea name="discount_offers" id="discount_offers"
                        class="form-control"><?= esc($pricing['discount_offers'] ?? '{}') ?></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="price_validity">Price Validity</label>
                    <input type="date" name="price_validity" class="form-control"
                        value="<?= esc($pricing['price_validity'] ?? '') ?>">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Vehicle & Pricing</button>
    </form>
</div>

<script src="<?= base_url('public/assets/vendor/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
<script>
    tinymce.init({
        selector: 'textarea#discount_offers', 'textarea#suspension, textarea#brakes, textarea#safety_features, textarea#infotainment, textarea#comfort_features, textarea#interior_features, textarea#exterior_features, textarea#color_options, textarea#warranty',
        license_key: 'gpl',
        height: 300,
        plugins: [
            'code', 'fullscreen', 'searchreplace', 'visualblocks', 'help'
        ],
        toolbar: 'undo redo | bold italic | code fullscreen | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>