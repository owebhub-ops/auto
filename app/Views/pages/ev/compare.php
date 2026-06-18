<style>
    :root {
        --primary-color: #00a67e;
        --primary-dark: #008b66;
        --secondary-color: #2d3748;
        --light-bg: #f7fafc;
        --border-color: #e2e8f0;
        --text-primary: #2d3748;
        --text-secondary: #718096;
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: var(--text-primary);
        line-height: 1.6;
    }

    .compare-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .compare-header {
        text-align: center;
        margin-bottom: 3rem;
        animation: fadeInDown 0.6s ease;
    }

    .compare-header h1 {
        font-size: 2.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 0.5rem;
        font-weight: 800;
    }

    .compare-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
    }

    .selection-section {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 1.5rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
        box-shadow: var(--shadow-xl);
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--primary-color);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .vehicle-selector-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .selector-item {
        background: white;
        border-radius: 1rem;
        padding: 1rem;
        border: 2px solid var(--border-color);
        transition: all 0.3s;
    }

    .selector-item:hover {
        border-color: var(--primary-color);
        box-shadow: var(--shadow-lg);
    }

    .selector-label {
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 0.75rem;
        font-size: 1rem;
        background: white;
        transition: all 0.3s;
        cursor: pointer;
    }

    select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 166, 126, 0.1);
    }

    .btn-compare {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        border: none;
        padding: 0.875rem 2rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 0.75rem;
        cursor: pointer;
        transition: all 0.3s;
        width: 100%;
    }

    .btn-compare:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .view-toggle {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .toggle-btn {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 2rem;
        color: white;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
    }

    .toggle-btn.active {
        background: white;
        color: var(--primary-color);
    }

    .comparison-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .vehicle-card {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: transform 0.3s;
        animation: fadeInUp 0.6s ease;
    }

    .vehicle-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .vehicle-image {
        height: 200px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .vehicle-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vehicle-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .winner-badge {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
        margin: 1rem;
    }

    .vehicle-info {
        padding: 1.5rem;
    }

    .vehicle-name {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: var(--text-primary);
    }

    .vehicle-brand {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .price-section {
        background: var(--light-bg);
        padding: 1rem;
        border-radius: 0.75rem;
        margin: 1rem 0;
    }

    .ex-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .onroad-price {
        font-size: 0.875rem;
        color: var(--text-secondary);
        margin-top: 0.25rem;
    }

    .spec-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .spec-label {
        font-weight: 600;
        color: var(--text-secondary);
    }

    .spec-value {
        font-weight: 500;
        color: var(--text-primary);
    }

    .spec-highlight {
        color: var(--primary-color);
        font-weight: 700;
    }

    .feature-list {
        margin-top: 1rem;
    }

    .feature-item {
        display: inline-block;
        background: var(--light-bg);
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        margin: 0.25rem;
        color: var(--text-secondary);
    }

    .score-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 1rem auto;
    }

    .score-text {
        color: white;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .score-label {
        text-align: center;
        font-size: 0.75rem;
        color: var(--text-secondary);
        margin-top: 0.5rem;
    }

    .table-view {
        background: white;
        border-radius: 1rem;
        overflow-x: auto;
        margin-top: 2rem;
        box-shadow: var(--shadow-lg);
    }

    .comparison-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    .comparison-table th,
    .comparison-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
    }

    .comparison-table th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
    }

    .comparison-table tr:hover {
        background: var(--light-bg);
    }

    .category-header {
        background: var(--light-bg);
        font-weight: 700;
        color: var(--primary-color);
    }

    .best-value {
        background: linear-gradient(135deg, #d4fc79 0%, #96e6a1 100%);
        font-weight: 700;
        padding: 0.25rem 0.5rem;
        border-radius: 0.5rem;
        display: inline-block;
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        backdrop-filter: blur(5px);
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 3px solid var(--border-color);
        border-top-color: var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-secondary);
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    @media (max-width: 768px) {
        .compare-container {
            padding: 1rem;
        }

        .compare-header h1 {
            font-size: 1.75rem;
        }

        .comparison-grid {
            grid-template-columns: 1fr;
        }

        .vehicle-name {
            font-size: 1.25rem;
        }

        .ex-price {
            font-size: 1.25rem;
        }

        .comparison-table th,
        .comparison-table td {
            padding: 0.75rem;
            font-size: 0.875rem;
        }
    }

    @media (max-width: 480px) {
        .comparison-table {
            font-size: 0.75rem;
        }

        .vehicle-selector-grid {
            grid-template-columns: 1fr;
        }
    }

    @media print {

        .selection-section,
        .view-toggle,
        .btn-compare {
            display: none;
        }

        body {
            background: white;
        }

        .vehicle-card {
            break-inside: avoid;
            box-shadow: none;
            border: 1px solid var(--border-color);
        }
    }
</style>

<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
</div>

<div class="compare-container">
    <div class="compare-header">
        <h1>⚡ Compare Electric Vehicles</h1>
        <p>Side-by-side comparison of electric vehicle specifications, prices, and features</p>
    </div>

    <div class="selection-section">
        <div class="section-title">
            🔄 Select Vehicles to Compare
        </div>
        <div class="vehicle-selector-grid" id="vehicleSelectors">
        </div>
        <button class="btn-compare" onclick="updateComparison()">
            🔄 Update Comparison
        </button>
    </div>

    <div class="view-toggle">
        <button class="toggle-btn active" onclick="switchView('card', this)">📱 Card View</button>
        <button class="toggle-btn" onclick="switchView('table', this)">📊 Table View</button>
    </div>

    <div id="comparisonContainer">
        <?php if (!empty($evs) && count($evs) >= 2): ?>
            <?php
            // Safe helper function to get max value from array
            function safeMax($array, $default = 0)
            {
                $filtered = array_filter($array, function ($value) {
                    return $value !== null && $value !== '' && is_numeric($value);
                });
                return !empty($filtered) ? max($filtered) : $default;
            }

            function safeMin($array, $default = 0)
            {
                $filtered = array_filter($array, function ($value) {
                    return $value !== null && $value !== '' && is_numeric($value);
                });
                return !empty($filtered) ? min($filtered) : $default;
            }

            // Calculate best values safely
            $ranges = array_column($evs, 'range_km');
            $bestRange = safeMax($ranges);

            $batteries = array_column($evs, 'battery_capacity_kwh');
            $bestBattery = safeMax($batteries);

            $accelerations = array_column($evs, 'acceleration_0_100');
            $bestAccel = safeMin($accelerations);

            $topSpeeds = array_column($evs, 'top_speed_kmh');
            $bestSpeed = safeMax($topSpeeds);

            $efficiencies = array_column($evs, 'efficiency_wh_km');
            $bestEfficiency = safeMin($efficiencies);

            $costs = array_column($evs, 'cost_per_100km');
            $bestCost = safeMin($costs);
            ?>

            <!-- Card View -->
            <div id="cardView">
                <div class="comparison-grid">
                    <?php
                    $scores = array_column($evs, 'overall_score');
                    $maxScore = !empty($scores) ? max($scores) : 0;
                    foreach ($evs as $index => $ev):
                        $isWinner = isset($ev['overall_score']) && $ev['overall_score'] == $maxScore && $maxScore > 0;
                        ?>
                        <div class="vehicle-card">
                            <?php if ($isWinner): ?>
                                <div><span class="winner-badge">🏆 Best Overall Value</span></div>
                            <?php endif; ?>

                            <div class="vehicle-image">
                                <?php if (!empty($ev['image_url'])): ?>
                                    <img src="<?= $ev['image_url'] ?>"
                                        alt="<?= esc($ev['make'] . ' ' . $ev['model']) ?>">
                                <?php else: ?>
                                    <div style="font-size: 4rem;">🚗</div>
                                <?php endif; ?>
                                <div class="vehicle-badge">Vehicle <?= $index + 1 ?></div>
                            </div>

                            <div class="vehicle-info">
                                <div class="vehicle-name"><?= esc($ev['make'] . ' ' . $ev['model']) ?></div>
                                <div class="vehicle-brand"><?= esc($ev['variant'] ?? 'Standard') ?></div>

                                <div class="price-section">
                                    <div class="ex-price">
                                        <?= $ev['currency'] ?? '₹' ?>         <?= number_format($ev['ex_showroom_price'] ?? 0) ?>
                                    </div>
                                    <div class="onroad-price">
                                        On-Road: <?= $ev['currency'] ?? '₹' ?>         <?= number_format($ev['on_road_price'] ?? 0) ?>
                                    </div>
                                </div>

                                <div class="spec-item">
                                    <span class="spec-label">🔋 Range</span>
                                    <span
                                        class="spec-value <?= isset($ev['range_km']) && $ev['range_km'] == $bestRange && $bestRange > 0 ? 'spec-highlight' : '' ?>">
                                        <?= number_format($ev['range_km'] ?? 0) ?> km
                                    </span>
                                </div>

                                <div class="spec-item">
                                    <span class="spec-label">⚡ Battery</span>
                                    <span class="spec-value"><?= $ev['battery_capacity_kwh'] ?? 'N/A' ?> kWh</span>
                                </div>

                                <div class="spec-item">
                                    <span class="spec-label">⏱️ 0-100 km/h</span>
                                    <span class="spec-value"><?= $ev['acceleration_0_100'] ?? 'N/A' ?> sec</span>
                                </div>

                                <div class="spec-item">
                                    <span class="spec-label">⚡ Fast Charging</span>
                                    <span
                                        class="spec-value"><?= $ev['fast_charging_time'] ?? $ev['charging_time_80'] ?? 'N/A' ?>
                                        hours</span>
                                </div>

                                <div class="spec-item">
                                    <span class="spec-label">💡 Efficiency</span>
                                    <span class="spec-value"><?= $ev['efficiency_wh_km'] ?? 'N/A' ?> Wh/km</span>
                                </div>

                                <div class="spec-item">
                                    <span class="spec-label">💰 Cost/100km</span>
                                    <span class="spec-value"><?= $ev['currency'] ?? '₹' ?>
                                        <?= number_format($ev['cost_per_100km'] ?? 0, 2) ?></span>
                                </div>

                                <?php if (isset($ev['overall_score'])): ?>
                                    <div class="score-circle">
                                        <div class="score-text"><?= round($ev['overall_score']) ?></div>
                                    </div>
                                    <div class="score-label">Overall Score</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Table View -->
            <div id="tableView" style="display: none;">
                <div class="table-view">
                    <table class="comparison-table">
                        <thead>
                            <tr>
                                <th>Specifications</th>
                                <?php foreach ($evs as $ev): ?>
                                    <th><?= esc($ev['make'] . ' ' . $ev['model']) ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="category-header">
                                <td colspan="<?= count($evs) + 1 ?>">💰 Pricing</td>
                            </tr>
                            <tr>
                                <td>Ex-Showroom Price</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= $ev['currency'] ?? '₹' ?>         <?= number_format($ev['ex_showroom_price'] ?? 0) ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>On-Road Price</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= $ev['currency'] ?? '₹' ?>         <?= number_format($ev['on_road_price'] ?? 0) ?></td>
                                <?php endforeach; ?>
                            </tr>

                            <tr class="category-header">
                                <td colspan="<?= count($evs) + 1 ?>">🔋 Performance</td>
                            </tr>
                            <tr>
                                <td>Range (km)</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td>
                                        <?= number_format($ev['range_km'] ?? 0) ?> km
                                        <?php if (($ev['range_km'] ?? 0) == $bestRange && $bestRange > 0): ?>
                                            <span class="best-value">🏆 Best</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Battery Capacity</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td>
                                        <?= $ev['battery_capacity_kwh'] ?? 'N/A' ?> kWh
                                        <?php if (($ev['battery_capacity_kwh'] ?? 0) == $bestBattery && $bestBattery > 0): ?>
                                            <span class="best-value">🏆 Best</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Acceleration (0-100 km/h)</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td>
                                        <?= $ev['acceleration_0_100'] ?? 'N/A' ?> sec
                                        <?php if (($ev['acceleration_0_100'] ?? 0) == $bestAccel && $bestAccel > 0): ?>
                                            <span class="best-value">⚡ Fastest</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Top Speed</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td>
                                        <?= $ev['top_speed_kmh'] ?? 'N/A' ?> km/h
                                        <?php if (($ev['top_speed_kmh'] ?? 0) == $bestSpeed && $bestSpeed > 0): ?>
                                            <span class="best-value">🏆 Best</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Motor Power</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td>
                                        <?php
                                        if ($ev['motor_power_kw'] ?? false) {
                                            echo $ev['motor_power_kw'] . ' kW';
                                            if ($ev['motor_power_hp'] ?? false) {
                                                echo ' (' . $ev['motor_power_hp'] . ' HP)';
                                            }
                                        } else {
                                            echo 'N/A';
                                        }
                                        ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Torque</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= number_format($ev['torque_nm'] ?? 0) ?> Nm</td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Drive Type</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= $ev['drive_type'] ?? 'N/A' ?></td>
                                <?php endforeach; ?>
                            </tr>

                            <tr class="category-header">
                                <td colspan="<?= count($evs) + 1 ?>">🔌 Charging</td>
                            </tr>
                            <tr>
                                <td>Charging Time (0-80%)</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= $ev['charging_time_80'] ?? 'N/A' ?> hours</td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Fast Charging Time</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= $ev['fast_charging_time'] ?? 'N/A' ?> hours</td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Charge Port Type</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= $ev['charge_port_type'] ?? 'CCS2' ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>V2L Capability</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= ($ev['vehicle_to_load'] ?? 0) ? '✅ Yes' : '❌ No' ?></td>
                                <?php endforeach; ?>
                            </tr>

                            <tr class="category-header">
                                <td colspan="<?= count($evs) + 1 ?>">💡 Efficiency</td>
                            </tr>
                            <tr>
                                <td>Efficiency</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td>
                                        <?= $ev['efficiency_wh_km'] ?? 'N/A' ?> Wh/km
                                        <?php if (($ev['efficiency_wh_km'] ?? 0) == $bestEfficiency && $bestEfficiency > 0): ?>
                                            <span class="best-value">💚 Most Efficient</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Real World Range</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= number_format($ev['real_world_range'] ?? $ev['range_km'] ?? 0) ?> km</td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Cost per 100km</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td>
                                        <?= $ev['currency'] ?? '₹' ?>         <?= number_format($ev['cost_per_100km'] ?? 0, 2) ?>
                                        <?php if (($ev['cost_per_100km'] ?? 0) == $bestCost && $bestCost > 0): ?>
                                            <span class="best-value">💰 Most Economical</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>

                            <tr class="category-header">
                                <td colspan="<?= count($evs) + 1 ?>">🔧 Warranty</td>
                            </tr>
                            <tr>
                                <td>Battery Warranty</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= $ev['battery_warranty'] ?? '8 years / 1,60,000 km' ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Motor Warranty</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= $ev['motor_warranty'] ?? '8 years / 1,60,000 km' ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Battery Type</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= $ev['battery_type'] ?? 'Lithium-ion' ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Thermal Management</td>
                                <?php foreach ($evs as $ev): ?>
                                    <td><?= $ev['thermal_management'] ?? 'Liquid Cooling' ?></td>
                                <?php endforeach; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="table-view">
                <div class="empty-state">
                    <i>🔍</i>
                    <h3>No Vehicles Selected</h3>
                    <p>Please select at least two vehicles to compare</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    const currentVehicleIds = <?= json_encode(array_column($evs, 'vehicle_id')) ?>;
    const allVehicles = <?= json_encode($allVehicles ?? []) ?>;
    const baseUrl = '<?= base_url() ?>';

    function initSelectors() {
        const container = document.getElementById('vehicleSelectors');
        const maxVehicles = 4;

        container.innerHTML = '';
        for (let i = 0; i < maxVehicles; i++) {
            container.innerHTML += `
                    <div class="selector-item">
                        <div class="selector-label">
                            <i>🚗</i> Vehicle ${i + 1}
                        </div>
                        <select id="vehicle_${i}" onchange="updateComparison()">
                            <option value="">Select Vehicle</option>
                            ${allVehicles.map(v => `
                                <option value="${v.vehicle_id}" ${currentVehicleIds[i] == v.vehicle_id ? 'selected' : ''}>
                                    ${v.make} ${v.model} ${v.variant ? '(' + v.variant + ')' : ''} ${v.range_km ? ' - ' + v.range_km + 'km' : ''}
                                </option>
                            `).join('')}
                        </select>
                    </div>
                `;
        }
    }

    function updateComparison() {
        const selectedIds = [];
        for (let i = 0; i < 4; i++) {
            const select = document.getElementById(`vehicle_${i}`);
            if (select && select.value) {
                selectedIds.push(select.value);
            }
        }

        if (selectedIds.length < 2) {
            alert('Please select at least 2 vehicles to compare');
            return;
        }

        document.getElementById('loadingOverlay').style.display = 'flex';
        window.location.href = `${baseUrl}/ev/compare/${selectedIds.join(',')}`;
    }

    function switchView(view, btn) {
        document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        if (view === 'card') {
            document.getElementById('cardView').style.display = 'block';
            document.getElementById('tableView').style.display = 'none';
        } else {
            document.getElementById('cardView').style.display = 'none';
            document.getElementById('tableView').style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        initSelectors();
        setTimeout(() => {
            document.getElementById('loadingOverlay').style.display = 'none';
        }, 500);
    });
</script>