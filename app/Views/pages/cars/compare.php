<div class="container py-5">
    <!-- Page Header -->
    <div class="d-flex align-items-center mb-4">
        <i class="bi bi-diagram-2-fill text-primary fs-3 me-2"></i>
        <h1 class="h3 fw-bold text-dark mb-0">Compare Cars</h1>
    </div>

    <!-- Search Section -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-search text-secondary"></i></span>
                <input type="text" id="carSearch" class="form-control" placeholder="Search car by brand or model...">
                <button id="addToCompare" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Add to Compare
                </button>
            </div>
            <div id="searchResults" class="list-group mt-3"></div>
        </div>
    </div>

    <!-- Alert Box -->
    <div id="alertBox" class="alert alert-warning alert-dismissible fade show d-none shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <span id="alertMessage"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- Comparison Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-bordered  table-hover align-middle text-center" id="compareTable">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-start">Feature</th>
                            <?php foreach ($vehicles as $index => $car): ?>
                                <th>
                                    <!-- Close button -->
                                    <button type="button" class="btn-close float-end" aria-label="Remove"
                                        onclick="removeColumn(<?= $index + 1 ?>)"></button>
                                    <div class="fw-bold text-dark mb-2">
                                        <?= esc($car['make']) ?>     <?= esc($car['model']) ?>     <?= esc($car['variant'] ?? '') ?>
                                    </div>
                                    <?php if (!empty($car['image_url'])): ?>
                                        <img src="<?= esc($car['image_url']) ?>" alt="Car Image"
                                            class="img-fluid rounded shadow-sm mb-2" style="max-height:120px;">
                                    <?php endif; ?>
                                    <?php if (!empty($car['brochure_url'])): ?>
                                        <div>
                                            <a href="<?= esc($car['brochure_url']) ?>" target="_blank"
                                                class="btn btn-sm btn-outline-primary rounded-pill">
                                                <i class="bi bi-file-earmark-text me-1"></i> Brochure
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody class="table-light">
                        <tr>
                            <td class="text-start"><i class="bi bi-calendar3 me-1 text-secondary"></i> Year</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['year']) ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="text-start"><i class="bi bi-fuel-pump me-1 text-secondary"></i> Fuel Type</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['fuel_type']) ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="text-start"><i class="bi bi-gear-fill me-1 text-secondary"></i> Transmission</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['transmission']) ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="text-start"><i class="bi bi-speedometer2 me-1 text-secondary"></i> Engine CC</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['engine_cc']) ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="text-start"><i class="bi bi-lightning-charge-fill me-1 text-secondary"></i> Power
                                (BHP)</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['power_bhp']) ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-arrow-repeat me-1 text-secondary"></i> Torque (Nm)</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['torque_nm']) ?></td><?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-droplet-half me-1 text-secondary"></i> Mileage (kmpl)</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['mileage_kmpl']) ?></td><?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-people-fill me-1 text-secondary"></i> Seating Capacity</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['seating_capacity']) ?></td><?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-box-seam me-1 text-secondary"></i> Boot Space (L)</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['boot_space_liters']) ?></td><?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-currency-rupee me-1 text-secondary"></i> Ex-Showroom Price</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc(number_format($car['pricing']['ex_showroom_price'] ?? 0, 2)) ?>
                                    <?= esc($car['pricing']['currency'] ?? '') ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-cash-stack me-1 text-secondary"></i> On-Road Price</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc(number_format($car['pricing']['on_road_price'] ?? 0, 2)) ?>
                                    <?= esc($car['pricing']['currency'] ?? '') ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-credit-card-2-front me-1 text-secondary"></i> EMI Available</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td>
                                    <?php if (!empty($car['pricing']['emi_available'])): ?>
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Yes</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger"><i class="bi bi-x-circle"></i> No</span>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-wallet2 me-1 text-secondary"></i> EMI Amount</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['pricing']['emi_amount'] ?? '') ?></td><?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-bank me-1 text-secondary"></i> Down Payment</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['pricing']['down_payment'] ?? '') ?></td><?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-shield-check me-1 text-secondary"></i> Insurance Cost</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['pricing']['insurance_cost'] ?? '') ?></td><?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-receipt me-1 text-secondary"></i> Road Tax</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['pricing']['road_tax'] ?? '') ?></td><?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-gift-fill me-1 text-secondary"></i> Discount Offers</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td>
                                    <?php if (!empty($car['pricing']['discount_offers']) && is_array($car['pricing']['discount_offers'])): ?>
                                        <ul class="list-unstyled mb-0">
                                            <?php foreach ($car['pricing']['discount_offers'] as $offer): ?>
                                                <li><i class="bi bi-check2-circle text-success me-1"></i><?= esc($offer) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <?= esc($car['pricing']['discount_offers'] ?? '—') ?>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                           <td class="text-start"><i class="bi bi-hourglass-split me-1 text-secondary"></i> Price Validity</td>
                            <?php foreach ($vehicles as $car): ?>
                                <td><?= esc($car['pricing']['price_validity'] ?? '') ?></td><?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            let selectedCars = [];
            window.CARS_SEARCH_URL = "<?= site_url('cars/search') ?>";

            // ✅ On page load, check for ?ids=...
            document.addEventListener("DOMContentLoaded", function () {
                const urlParams = new URLSearchParams(window.location.search);
                const idsParam = urlParams.get("ids");
                if (idsParam) {
                    selectedCars = idsParam.split(",").map(id => parseInt(id, 10));
                    // Optionally highlight or fetch details for these cars
                    // Example: mark them as active in search results if available
                    console.log("Preloaded selected cars:", selectedCars);
                }
            });

            // Search cars
            document.getElementById('carSearch').addEventListener('input', function () {
                const query = this.value.trim();
                if (query.length < 2) return;

                fetch(`${window.CARS_SEARCH_URL}?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(results => {
                        const resultsBox = document.getElementById('searchResults');
                        resultsBox.innerHTML = '';
                        results.forEach(car => {
                            const item = document.createElement('button');
                            item.className = 'list-group-item list-group-item-action';
                            item.textContent = `${car.make} ${car.model} ${car.variant ?? ''}`;
                            item.onclick = () => {
                                if (!selectedCars.includes(car.vehicle_id)) {
                                    selectedCars.push(car.vehicle_id);
                                    item.classList.add('active');
                                }
                            };
                            // ✅ Pre-highlight if already in selectedCars
                            if (selectedCars.includes(car.vehicle_id)) {
                                item.classList.add('active');
                            }
                            resultsBox.appendChild(item);
                        });
                    });
            });

            const compareBaseUrl = "<?= site_url('cars/compare') ?>";

            // Add to compare
            document.getElementById('addToCompare').addEventListener('click', function () {
                if (selectedCars.length < 2) {
                    showAlert('Please select at least two cars to compare.');
                    return;
                }
                const ids = selectedCars.join(',');
                window.location.href = `${compareBaseUrl}?ids=${ids}`;
            });

            function showAlert(message) {
                const alertBox = document.getElementById("alertBox");
                const alertMessage = document.getElementById("alertMessage");
                alertMessage.textContent = message;
                alertBox.classList.remove("d-none");
            }

            function removeColumn(colIndex) {
                const table = document.getElementById("compareTable");
                if (!table) return;

                const totalCols = table.rows[0].cells.length;
                if (totalCols <= 3) {
                    showAlert("You must keep at least two cars in the comparison.");
                    return;
                }

                for (let row of table.rows) {
                    if (row.cells[colIndex]) {
                        row.deleteCell(colIndex);
                    }
                }

                const urlParams = new URLSearchParams(window.location.search);
                let ids = urlParams.get("ids") ? urlParams.get("ids").split(",") : [];

                if (ids.length >= colIndex) {
                    ids.splice(colIndex - 1, 1);
                    urlParams.set("ids", ids.join(","));
                    const newUrl = window.location.pathname + "?" + urlParams.toString();
                    window.history.replaceState({}, "", newUrl);
                }
            }
        </script>