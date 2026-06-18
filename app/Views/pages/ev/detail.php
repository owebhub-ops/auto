<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
    
    :root {
        --ev-primary: #0d9488;
        --ev-primary-light: #14b8a6;
        --ev-primary-dark: #0f766e;
        --ev-secondary: #1e293b;
        --ev-accent: #f59e0b;
        --ev-bg-light: #f0fdfa;
        --ev-bg-white: #ffffff;
        --ev-text-dark: #0f172a;
        --ev-text-gray: #64748b;
        --ev-text-light: #94a3b8;
        --ev-border: #e2e8f0;
        --ev-shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --ev-shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --ev-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --ev-shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        color: var(--ev-text-dark);
        line-height: 1.5;
    }

    /* Modern Hero Section */
    .ev-hero-modern {
        background: linear-gradient(135deg, var(--ev-secondary) 0%, #0f172a 100%);
        position: relative;
        overflow: hidden;
        padding: 4rem 0;
        margin-bottom: 2rem;
    }

    .ev-hero-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.1) 0%, transparent 50%);
    }

    .ev-hero-modern::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 80%;
        height: 200%;
        background: radial-gradient(circle, rgba(13, 148, 136, 0.05) 0%, transparent 70%);
        transform: rotate(30deg);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .ev-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(13, 148, 136, 0.2);
        backdrop-filter: blur(10px);
        padding: 0.5rem 1.25rem;
        border-radius: 100px;
        font-size: 0.875rem;
        font-weight: 500;
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 2rem;
    }

    .ev-title-modern {
        font-size: 3.5rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        color: white;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .ev-subtitle-modern {
        font-size: 1.125rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 1.5rem;
    }

    .ev-meta-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .ev-meta-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 100px;
        font-size: 0.875rem;
        color: white;
        backdrop-filter: blur(5px);
    }

    /* Modern Price Card */
    .price-card-modern {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        text-align: center;
        box-shadow: var(--ev-shadow-xl);
        position: relative;
        z-index: 2;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .price-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 40px -20px rgba(0, 0, 0, 0.3);
    }

    .price-badge {
        display: inline-block;
        background: linear-gradient(135deg, var(--ev-primary) 0%, var(--ev-primary-light) 100%);
        color: white;
        padding: 0.25rem 1rem;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .price-amount-modern {
        font-size: 3rem;
        font-weight: 800;
        color: var(--ev-primary);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .price-label-modern {
        font-size: 0.875rem;
        color: var(--ev-text-gray);
        margin-bottom: 1rem;
    }

    /* Stats Grid Modern */
    .stats-grid-modern {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card-modern {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: var(--ev-shadow-md);
        transition: all 0.3s ease;
        border: 1px solid var(--ev-border);
    }

    .stat-card-modern:hover {
        transform: translateY(-4px);
        box-shadow: var(--ev-shadow-lg);
        border-color: var(--ev-primary-light);
    }

    .stat-icon-modern {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--ev-bg-light) 0%, #e6f7f5 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .stat-icon-modern i {
        font-size: 1.75rem;
        color: var(--ev-primary);
    }

    .stat-value-modern {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--ev-text-dark);
        margin-bottom: 0.25rem;
    }

    .stat-label-modern {
        font-size: 0.875rem;
        color: var(--ev-text-gray);
    }

    /* Tabs Navigation */
    .spec-tabs {
        background: white;
        border-radius: 16px;
        padding: 0.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--ev-shadow-sm);
        border: 1px solid var(--ev-border);
    }

    .spec-tab-btn {
        padding: 0.75rem 1.5rem;
        border: none;
        background: transparent;
        font-weight: 600;
        color: var(--ev-text-gray);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .spec-tab-btn.active {
        background: var(--ev-primary);
        color: white;
        box-shadow: var(--ev-shadow-md);
    }

    .spec-tab-btn:hover:not(.active) {
        background: var(--ev-bg-light);
        color: var(--ev-primary);
    }

    /* Content Cards */
    .content-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: var(--ev-shadow-md);
        margin-bottom: 2rem;
        border: 1px solid var(--ev-border);
    }

    .content-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--ev-primary);
        display: inline-block;
    }

    .spec-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .spec-list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--ev-border);
    }

    .spec-list-label {
        font-weight: 600;
        color: var(--ev-text-gray);
    }

    .spec-list-value {
        font-weight: 500;
        color: var(--ev-text-dark);
    }

    .spec-list-value.highlight {
        color: var(--ev-primary);
        font-weight: 700;
    }

    /* Features Grid Modern */
    .features-grid-modern {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .feature-card {
        background: var(--ev-bg-light);
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--ev-shadow-md);
    }

    .feature-card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .feature-card-header i {
        font-size: 1.5rem;
        color: var(--ev-primary);
    }

    .feature-card-header h4 {
        font-size: 1.125rem;
        font-weight: 700;
        margin: 0;
    }

    .feature-list-modern {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .feature-list-modern li {
        padding: 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--ev-text-gray);
    }

    .feature-list-modern li i {
        color: var(--ev-primary);
        font-size: 0.75rem;
    }

    /* CTA Section Modern */
    .cta-section {
        background: linear-gradient(135deg, var(--ev-primary) 0%, var(--ev-primary-dark) 100%);
        border-radius: 24px;
        padding: 3rem;
        text-align: center;
        margin: 3rem 0;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 80%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        transform: rotate(30deg);
    }

    .cta-section h3 {
        font-size: 2rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .cta-section p {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .btn-cta-modern {
        background: white;
        color: var(--ev-primary);
        border: none;
        padding: 0.875rem 2.5rem;
        border-radius: 100px;
        font-weight: 700;
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cta-modern:hover {
        transform: translateY(-2px);
        box-shadow: var(--ev-shadow-lg);
        color: var(--ev-primary-dark);
    }

    /* Related Cars Modern */
    .related-section-modern {
        margin-top: 3rem;
    }

    .related-title-modern {
        font-size: 1.75rem;
        font-weight: 800;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .related-card-modern {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: var(--ev-shadow-sm);
        height: 100%;
        border: 1px solid var(--ev-border);
    }

    .related-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: var(--ev-shadow-lg);
    }

    .related-image-modern {
        height: 180px;
        overflow: hidden;
        position: relative;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .related-image-modern img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .related-card-modern:hover .related-image-modern img {
        transform: scale(1.05);
    }

    .related-body-modern {
        padding: 1rem;
    }

    .related-title-modern-small {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .related-price {
        color: var(--ev-primary);
        font-weight: 700;
        font-size: 0.875rem;
        margin: 0.5rem 0;
    }

    /* Gallery Modern */
    .gallery-modern {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--ev-shadow-lg);
        margin-bottom: 1.5rem;
        background: white;
    }

    .gallery-main-modern {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .gallery-placeholder-modern {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .ev-title-modern {
            font-size: 2rem;
        }
        
        .price-card-modern {
            margin-top: 2rem;
        }
        
        .stats-grid-modern {
            gap: 1rem;
        }
        
        .stat-card-modern {
            padding: 1rem;
        }
        
        .stat-value-modern {
            font-size: 1.25rem;
        }
        
        .content-card {
            padding: 1.5rem;
        }
        
        .spec-list {
            grid-template-columns: 1fr;
        }
        
        .cta-section h3 {
            font-size: 1.5rem;
        }
        
        .gallery-main-modern,
        .gallery-placeholder-modern {
            height: 250px;
        }
    }
</style>

<!-- Modern Hero Section -->
<div class="ev-hero-modern">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-content">
                    <div class="ev-tag">
                        <i class="bi bi-ev-station-fill"></i>
                        <span>100% Electric Vehicle</span>
                    </div>
                    <h1 class="ev-title-modern">
                        <?= esc($ev['make']) ?> <?= esc($ev['model']) ?>
                    </h1>
                    <?php if (!empty($ev['variant'])): ?>
                        <p class="ev-subtitle-modern"><?= esc($ev['variant']) ?> <span class="opacity-50">|</span> <?= esc($ev['year'] ?? '2024') ?></p>
                    <?php endif; ?>
                    <div class="ev-meta-grid">
                        <span class="ev-meta-chip">
                            <i class="bi bi-car-front"></i>
                            <?= esc($ev['body_type'] ?? 'SUV') ?>
                        </span>
                        <span class="ev-meta-chip">
                            <i class="bi bi-people-fill"></i>
                            <?= esc($ev['seating_capacity'] ?? 5) ?> Seats
                        </span>
                        <?php if (!empty($ev['range_km'])): ?>
                            <span class="ev-meta-chip">
                                <i class="bi bi-speedometer2"></i>
                                <?= number_format($ev['range_km']) ?> km Range
                            </span>
                        <?php endif; ?>
                        <span class="ev-meta-chip">
                            <i class="bi bi-tree-fill"></i>
                            Zero Emission
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <?php if (!empty($ev['ex_showroom_price']) && $ev['ex_showroom_price'] > 0): ?>
                    <div class="price-card-modern">
                        <div class="price-badge">Best Price</div>
                        <div class="price-amount-modern">
                            ₹ <?= number_format($ev['ex_showroom_price'], 0) ?>
                        </div>
                        <div class="price-label-modern">Ex-Showroom Price</div>
                        <?php if (!empty($ev['on_road_price']) && $ev['on_road_price'] > 0): ?>
                            <div class="text-muted small">
                                On-Road: ₹ <?= number_format($ev['on_road_price'], 0) ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($ev['emi_available'])): ?>
                            <div class="mt-3">
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                    <i class="bi bi-credit-card"></i> EMI Available
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Key Stats Overview -->
    <div class="stats-grid-modern">
        <?php if (!empty($ev['range_km'])): ?>
            <div class="stat-card-modern">
                <div class="stat-icon-modern">
                    <i class="bi bi-speedometer2"></i>
                </div>
                <div class="stat-value-modern"><?= number_format($ev['range_km']) ?> km</div>
                <div class="stat-label-modern">Driving Range (ARAI)</div>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($ev['battery_capacity_kwh'])): ?>
            <div class="stat-card-modern">
                <div class="stat-icon-modern">
                    <i class="bi bi-battery-full"></i>
                </div>
                <div class="stat-value-modern"><?= $ev['battery_capacity_kwh'] ?> kWh</div>
                <div class="stat-label-modern">Battery Capacity</div>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($ev['motor_power_kw'])): ?>
            <div class="stat-card-modern">
                <div class="stat-icon-modern">
                    <i class="bi bi-lightning-charge"></i>
                </div>
                <div class="stat-value-modern"><?= $ev['motor_power_kw'] ?> kW</div>
                <div class="stat-label-modern">Motor Power</div>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($ev['charging_time_80'])): ?>
            <div class="stat-card-modern">
                <div class="stat-icon-modern">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stat-value-modern"><?= $ev['charging_time_80'] ?> hrs</div>
                <div class="stat-label-modern">Charging Time (0-80%)</div>
            </div>
        <?php endif; ?>
    </div>

    <div class="row g-4">
        <!-- Left Column - Gallery -->
        <div class="col-lg-6">
            <div class="gallery-modern">
                <?php if (!empty($ev['image_url'])): ?>
                    <img src="<?= esc($ev['image_url']) ?>" alt="<?= esc($ev['make']) ?> <?= esc($ev['model']) ?>" class="gallery-main-modern">
                <?php else: ?>
                    <div class="gallery-placeholder-modern">
                        <i class="bi bi-ev-station" style="font-size: 5rem; color: var(--ev-primary); opacity: 0.5;"></i>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right Column - Quick Info -->
        <div class="col-lg-6">
            <div class="content-card">
                <h3 class="content-card-title">At a Glance</h3>
                <div class="spec-list">
                    <div class="spec-list-item">
                        <span class="spec-list-label">Manufacturer</span>
                        <span class="spec-list-value"><?= esc($ev['make']) ?></span>
                    </div>
                    <div class="spec-list-item">
                        <span class="spec-list-label">Model</span>
                        <span class="spec-list-value"><?= esc($ev['model']) ?></span>
                    </div>
                    <?php if (!empty($ev['variant'])): ?>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Variant</span>
                            <span class="spec-list-value"><?= esc($ev['variant']) ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="spec-list-item">
                        <span class="spec-list-label">Body Type</span>
                        <span class="spec-list-value"><?= esc($ev['body_type'] ?? 'SUV') ?></span>
                    </div>
                    <div class="spec-list-item">
                        <span class="spec-list-label">Seating Capacity</span>
                        <span class="spec-list-value"><?= esc($ev['seating_capacity'] ?? 5) ?> Persons</span>
                    </div>
                    <div class="spec-list-item">
                        <span class="spec-list-label">Fuel Type</span>
                        <span class="spec-list-value spec-list-value highlight">100% Electric</span>
                    </div>
                    <?php if (!empty($ev['ncap_rating'])): ?>
                        <div class="spec-list-item">
                            <span class="spec-list-label">NCAP Rating</span>
                            <span class="spec-list-value">⭐ <?= esc($ev['ncap_rating']) ?> Star</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Cost Analysis -->
            <?php if (!empty($cost_analysis)): ?>
                <div class="content-card">
                    <h3 class="content-card-title">Running Cost Analysis</h3>
                    <div class="spec-list">
                        <div class="spec-list-item">
                            <span class="spec-list-label">
                                <i class="bi bi-ev-station me-1"></i> Cost per km
                            </span>
                            <span class="spec-list-value highlight"><?= $cost_analysis['cost_per_km'] ?? 'N/A' ?></span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">
                                <i class="bi bi-calendar-month me-1"></i> Monthly Cost (1,500 km)
                            </span>
                            <span class="spec-list-value"><?= $cost_analysis['monthly_cost'] ?? 'N/A' ?></span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">
                                <i class="bi bi-calendar-week me-1"></i> Annual Cost (15,000 km)
                            </span>
                            <span class="spec-list-value"><?= $cost_analysis['annual_cost'] ?? 'N/A' ?></span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">
                                <i class="bi bi-fuel-pump me-1"></i> Savings vs Petrol
                            </span>
                            <span class="spec-list-value highlight"><?= $cost_analysis['annual_savings_vs_petrol'] ?? 'N/A' ?></span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">
                                <i class="bi bi-tree-fill me-1"></i> CO₂ Savings/Year
                            </span>
                            <span class="spec-list-value"><?= $cost_analysis['co2_savings_per_year'] ?? 'N/A' ?></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tabs for Detailed Specifications -->
    <div class="spec-tabs">
        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <button class="spec-tab-btn active" data-tab="performance">
                <i class="bi bi-speedometer2 me-2"></i>Performance
            </button>
            <button class="spec-tab-btn" data-tab="battery">
                <i class="bi bi-battery-full me-2"></i>Battery & Range
            </button>
            <button class="spec-tab-btn" data-tab="charging">
                <i class="bi bi-plug-fill me-2"></i>Charging
            </button>
            <button class="spec-tab-btn" data-tab="warranty">
                <i class="bi bi-shield-check me-2"></i>Warranty
            </button>
            <button class="spec-tab-btn" data-tab="features">
                <i class="bi bi-star-fill me-2"></i>Features
            </button>
        </div>
    </div>

    <!-- Tab Content -->
    <div id="performanceTab" class="tab-content active">
        <div class="content-card">
            <h3 class="content-card-title">Performance Specifications</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="spec-list">
                        <div class="spec-list-item">
                            <span class="spec-list-label">Motor Power</span>
                            <span class="spec-list-value">
                                <?php 
                                if (!empty($ev['motor_power_kw'])) {
                                    echo $ev['motor_power_kw'] . ' kW';
                                    if (!empty($ev['motor_power_hp'])) {
                                        echo ' (' . $ev['motor_power_hp'] . ' HP)';
                                    }
                                } else {
                                    echo 'N/A';
                                }
                                ?>
                            </span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Peak Torque</span>
                            <span class="spec-list-value">
                                <?= !empty($ev['torque_nm']) ? number_format($ev['torque_nm']) . ' Nm' : 'N/A' ?>
                            </span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Acceleration (0-100 km/h)</span>
                            <span class="spec-list-value">
                                <?= !empty($ev['acceleration_0_100']) ? $ev['acceleration_0_100'] . ' seconds' : 'N/A' ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="spec-list">
                        <div class="spec-list-item">
                            <span class="spec-list-label">Top Speed</span>
                            <span class="spec-list-value">
                                <?= !empty($ev['top_speed_kmh']) ? $ev['top_speed_kmh'] . ' km/h' : 'N/A' ?>
                            </span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Drive Type</span>
                            <span class="spec-list-value"><?= !empty($ev['drive_type']) ? $ev['drive_type'] : 'N/A' ?></span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Transmission</span>
                            <span class="spec-list-value">Automatic (Single Speed)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="batteryTab" class="tab-content" style="display: none;">
        <div class="content-card">
            <h3 class="content-card-title">Battery & Range Details</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="spec-list">
                        <div class="spec-list-item">
                            <span class="spec-list-label">Battery Capacity</span>
                            <span class="spec-list-value">
                                <?= !empty($ev['battery_capacity_kwh']) ? $ev['battery_capacity_kwh'] . ' kWh' : 'N/A' ?>
                            </span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Battery Type</span>
                            <span class="spec-list-value"><?= !empty($ev['battery_type']) ? $ev['battery_type'] : 'Lithium-ion' ?></span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">ARAI Certified Range</span>
                            <span class="spec-list-value">
                                <?= !empty($ev['range_km']) ? number_format($ev['range_km']) . ' km' : 'N/A' ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="spec-list">
                        <div class="spec-list-item">
                            <span class="spec-list-label">Real World Range</span>
                            <span class="spec-list-value">
                                <?= !empty($ev['real_world_range']) ? number_format($ev['real_world_range']) . ' km' : (!empty($ev['range_km']) ? number_format($ev['range_km']) . ' km' : 'N/A') ?>
                            </span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Efficiency</span>
                            <span class="spec-list-value">
                                <?= !empty($ev['efficiency_wh_km']) ? $ev['efficiency_wh_km'] . ' Wh/km' : 'N/A' ?>
                            </span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Thermal Management</span>
                            <span class="spec-list-value"><?= !empty($ev['thermal_management']) ? $ev['thermal_management'] : 'Liquid Cooling' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="chargingTab" class="tab-content" style="display: none;">
        <div class="content-card">
            <h3 class="content-card-title">Charging Information</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="spec-list">
                        <div class="spec-list-item">
                            <span class="spec-list-label">Home Charging (15A)</span>
                            <span class="spec-list-value">
                                <?php 
                                if (!empty($ev['battery_capacity_kwh'])) {
                                    $hours = round($ev['battery_capacity_kwh'] / 2.8, 1);
                                    echo $hours . ' hours';
                                } else {
                                    echo 'N/A';
                                }
                                ?>
                            </span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Home Charging (7.2 kW)</span>
                            <span class="spec-list-value">
                                <?= !empty($ev['charging_time_80']) ? $ev['charging_time_80'] . ' hours (0-80%)' : 'N/A' ?>
                            </span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Fast Charging (DC)</span>
                            <span class="spec-list-value">
                                <?= !empty($ev['fast_charging_time']) ? $ev['fast_charging_time'] . ' hours (0-80%)' : 'N/A' ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="spec-list">
                        <div class="spec-list-item">
                            <span class="spec-list-label">Charge Port Type</span>
                            <span class="spec-list-value"><?= !empty($ev['charge_port_type']) ? $ev['charge_port_type'] : 'CCS2' ?></span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Vehicle to Load (V2L)</span>
                            <span class="spec-list-value"><?= (!empty($ev['vehicle_to_load']) && $ev['vehicle_to_load'] == 1) ? '✅ Yes' : '❌ No' ?></span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Fast Charger Compatible</span>
                            <span class="spec-list-value"><?= !empty($ev['fast_charger_compatible']) ? $ev['fast_charger_compatible'] : 'CCS2' ?></span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Home Charger Included</span>
                            <span class="spec-list-value"><?= (!empty($ev['home_charger_included']) && $ev['home_charger_included'] == 1) ? '✅ Yes' : '❌ No' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="warrantyTab" class="tab-content" style="display: none;">
        <div class="content-card">
            <h3 class="content-card-title">Warranty & Support</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="spec-list">
                        <div class="spec-list-item">
                            <span class="spec-list-label">Vehicle Warranty</span>
                            <span class="spec-list-value">3 years / 1,00,000 km</span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Battery Warranty</span>
                            <span class="spec-list-value"><?= !empty($ev['battery_warranty']) ? $ev['battery_warranty'] : '8 years / 1,60,000 km' ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="spec-list">
                        <div class="spec-list-item">
                            <span class="spec-list-label">Motor Warranty</span>
                            <span class="spec-list-value"><?= !empty($ev['motor_warranty']) ? $ev['motor_warranty'] : '8 years / 1,60,000 km' ?></span>
                        </div>
                        <div class="spec-list-item">
                            <span class="spec-list-label">Regenerative Braking</span>
                            <span class="spec-list-value"><?= !empty($ev['regenerative_braking']) ? $ev['regenerative_braking'] : 'Yes' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="featuresTab" class="tab-content" style="display: none;">
        <div class="content-card">
            <h3 class="content-card-title">Key Features</h3>
            <div class="features-grid-modern">
                <?php if (!empty($ev['safety_features']) && is_array($ev['safety_features'])): ?>
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <i class="bi bi-shield-check"></i>
                            <h4>Safety</h4>
                        </div>
                        <ul class="feature-list-modern">
                            <?php foreach (array_slice($ev['safety_features'], 0, 8) as $feature): ?>
                                <?php if (is_string($feature) && !empty($feature)): ?>
                                    <li><i class="bi bi-check-circle-fill"></i> <?= esc($feature) ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($ev['comfort_features']) && is_array($ev['comfort_features'])): ?>
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <i class="bi bi-chevron-double-up"></i>
                            <h4>Comfort & Convenience</h4>
                        </div>
                        <ul class="feature-list-modern">
                            <?php foreach (array_slice($ev['comfort_features'], 0, 8) as $feature): ?>
                                <?php if (is_string($feature) && !empty($feature)): ?>
                                    <li><i class="bi bi-check-circle-fill"></i> <?= esc($feature) ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($ev['infotainment']) && is_array($ev['infotainment'])): ?>
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <i class="bi bi-display"></i>
                            <h4>Infotainment</h4>
                        </div>
                        <ul class="feature-list-modern">
                            <?php foreach (array_slice($ev['infotainment'], 0, 8) as $feature): ?>
                                <?php if (is_string($feature) && !empty($feature)): ?>
                                    <li><i class="bi bi-check-circle-fill"></i> <?= esc($feature) ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($ev['exterior_features']) && is_array($ev['exterior_features'])): ?>
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <i class="bi bi-brightness-high"></i>
                            <h4>Exterior</h4>
                        </div>
                        <ul class="feature-list-modern">
                            <?php foreach (array_slice($ev['exterior_features'], 0, 8) as $feature): ?>
                                <?php if (is_string($feature) && !empty($feature)): ?>
                                    <li><i class="bi bi-check-circle-fill"></i> <?= esc($feature) ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <h3>Ready to Go Electric?</h3>
        <p>Get the best price, schedule a test drive, or learn more about this vehicle</p>
        <a href="<?= site_url('enquiry?vehicle=' . urlencode($ev['make'] . ' ' . $ev['model'])) ?>" class="btn-cta-modern">
            <i class="bi bi-envelope-fill me-2"></i>Get Best Price
        </a>
        <button class="btn-cta-modern ms-2" onclick="addToCompare(<?= $ev['vehicle_id'] ?>)">
            <i class="bi bi-bar-chart-steps me-2"></i>Add to Compare
        </button>
    </div>

    <!-- Related EVs -->
    <?php if (!empty($related_evs)): ?>
        <div class="related-section-modern">
            <h2 class="related-title-modern">
                <i class="bi bi-ev-station"></i>
                You May Also Like
            </h2>
            <div class="row g-4">
                <?php foreach (array_slice($related_evs, 0, 4) as $related): ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="related-card-modern">
                            <div class="related-image-modern">
                                <?php if (!empty($related['image_url'])): ?>
                                    <img src="<?= esc($related['image_url']) ?>" alt="<?= esc($related['make']) ?> <?= esc($related['model']) ?>">
                                <?php else: ?>
                                    <i class="bi bi-ev-station" style="font-size: 2.5rem; color: var(--ev-primary);"></i>
                                <?php endif; ?>
                            </div>
                            <div class="related-body-modern">
                                <h3 class="related-title-modern-small">
                                    <?= esc($related['make']) ?> <?= esc($related['model']) ?>
                                </h3>
                                <?php if (!empty($related['range_km'])): ?>
                                    <div class="related-price">
                                        <i class="bi bi-speedometer2 me-1"></i><?= number_format($related['range_km']) ?> km
                                    </div>
                                <?php endif; ?>
                                <a href="<?= site_url('ev/detail/' . ($related['slug'] ?? $related['vehicle_id'])) ?>" class="btn btn-sm btn-outline-success w-100 mt-2 rounded-pill">
                                    View Details <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Tab functionality
document.querySelectorAll('.spec-tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.spec-tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        document.querySelectorAll('.tab-content').forEach(tab => tab.style.display = 'none');
        
        const tabId = btn.dataset.tab;
        document.getElementById(`${tabId}Tab`).style.display = 'block';
    });
});

// Compare functionality
let compareList = JSON.parse(localStorage.getItem('ev_compare_list') || '[]');

function addToCompare(vehicleId) {
    if (compareList.includes(vehicleId)) {
        showAlert('Already in comparison list', 'warning');
        return;
    }
    
    if (compareList.length >= 4) {
        showAlert('You can compare up to 4 EVs at a time', 'warning');
        return;
    }
    
    compareList.push(vehicleId);
    localStorage.setItem('ev_compare_list', JSON.stringify(compareList));
    showAlert('Added to comparison', 'success');
}

function showAlert(message, type) {
    const alertDiv = document.createElement('div');
    const alertClass = type === 'success' ? 'alert-success' : 'alert-warning';
    
    alertDiv.className = `alert ${alertClass} alert-dismissible fade show position-fixed top-0 end-0 m-3 shadow-lg`;
    alertDiv.style.zIndex = '9999';
    alertDiv.style.minWidth = '300px';
    alertDiv.style.borderRadius = '12px';
    alertDiv.innerHTML = `
        <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(alertDiv);
    setTimeout(() => alertDiv.remove(), 3000);
}
</script>