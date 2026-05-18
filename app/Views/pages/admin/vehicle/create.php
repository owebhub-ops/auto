<div class="container py-4">
    <h1 class="h4 mb-4">Create Pricing for <?= esc($vehicle['name']) ?></h1>

    <form action="<?= site_url("admin/vehicle/{$vehicle['vehicle_id']}/pricing/store") ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="ex_showroom_price" class="form-label">Ex-Showroom Price</label>
            <input type="number" step="0.01" name="ex_showroom_price" id="ex_showroom_price" class="form-control" value="<?= old('ex_showroom_price') ?>">
        </div>

        <div class="mb-3">
            <label for="on_road_price" class="form-label">On-Road Price</label>
            <input type="number" step="0.01" name="on_road_price" id="on_road_price" class="form-control" value="<?= old('on_road_price') ?>">
        </div>

        <div class="mb-3">
            <label for="emi_available" class="form-label">EMI Available</label>
            <select name="emi_available" id="emi_available" class="form-control">
                <option value="0" <?= old('emi_available') == 0 ? 'selected' : '' ?>>No</option>
                <option value="1" <?= old('emi_available') == 1 ? 'selected' : '' ?>>Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="emi_amount" class="form-label">EMI Amount</label>
            <input type="number" step="0.01" name="emi_amount" id="emi_amount" class="form-control" value="<?= old('emi_amount') ?>">
        </div>

        <div class="mb-3">
            <label for="down_payment" class="form-label">Down Payment</label>
            <input type="number" step="0.01" name="down_payment" id="down_payment" class="form-control" value="<?= old('down_payment') ?>">
        </div>

        <div class="mb-3">
            <label for="insurance_cost" class="form-label">Insurance Cost</label>
            <input type="number" step="0.01" name="insurance_cost" id="insurance_cost" class="form-control" value="<?= old('insurance_cost') ?>">
        </div>

        <div class="mb-3">
            <label for="road_tax" class="form-label">Road Tax</label>
            <input type="number" step="0.01" name="road_tax" id="road_tax" class="form-control" value="<?= old('road_tax') ?>">
        </div>

        <div class="mb-3">
            <label for="discount_offers" class="form-label">Discount Offers (JSON)</label>
            <textarea name="discount_offers" id="discount_offers" class="form-control" rows="5"><?= old('discount_offers') ?></textarea>
        </div>

        <div class="mb-3">
            <label for="price_validity" class="form-label">Price Validity</label>
            <input type="date" name="price_validity" id="price_validity" class="form-control" value="<?= old('price_validity') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="<?= site_url("admin/vehicle/{$vehicle['vehicle_id']}/pricing") ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="<?= base_url('public/assets/vendor/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
<script>
    tinymce.init({
        selector: 'textarea#discount_offers',
        license_key: 'gpl',
        height: 300,
        plugins: [
            'code', 'fullscreen', 'searchreplace', 'visualblocks', 'help'
        ],
        toolbar: 'undo redo | bold italic | code fullscreen | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>
