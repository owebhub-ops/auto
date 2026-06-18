<?php

namespace App\Controllers;

use App\Models\VehicleModel;
use App\Models\PricingModel;

class EVController extends BaseController
{
    protected $vehicleModel;
    protected $pricingModel;

    public function __construct()
    {
        $this->vehicleModel = new VehicleModel();
        $this->pricingModel = new PricingModel();
    }

    /**
     * Display all electric vehicles
     */
    public function index()
    {
        $page = (int) ($this->request->getGet('page') ?? 1);
        $limit = 12;
        $offset = ($page - 1) * $limit;

        // Get filter parameters
        $sort = $this->request->getGet('sort');
        $search = $this->request->getGet('search');
        $minRange = $this->request->getGet('min_range');
        $maxRange = $this->request->getGet('max_range');
        $make = $this->request->getGet('make');
        $bodyType = $this->request->getGet('body_type');
        $driveType = $this->request->getGet('drive_type');

        // Get EVs
        $result = $this->vehicleModel->getAllEVs($limit, $offset, $sort, $search, $minRange, $maxRange);
        $evs = $result['evs'];
        $total = $result['total'];

        // Apply additional filters that couldn't be done in query
        if ($make) {
            $evs = array_filter($evs, function ($ev) use ($make) {
                return $ev['make'] === $make;
            });
        }

        if ($bodyType) {
            $evs = array_filter($evs, function ($ev) use ($bodyType) {
                return $ev['body_type'] === $bodyType;
            });
        }

        if ($driveType) {
            $evs = array_filter($evs, function ($ev) use ($driveType) {
                return ($ev['drive_type'] ?? '') === $driveType;
            });
        }

        // Recalculate totals after filtering
        $totalFiltered = count($evs);
        $evs = array_slice($evs, $offset, $limit);
        $totalPages = ceil($totalFiltered / $limit);

        // Get filter options for sidebar
        $filters = $this->vehicleModel->getEVFilterOptions();

        $data = [
            'page_title' => 'Electric Vehicles - Browse All EVs',
            'evs' => $evs,
            'total' => $totalFiltered,
            'current_page' => $page,
            'total_pages' => $totalPages,
            'filters' => $filters,
            'sort' => $sort,
            'selected_make' => $make,
            'selected_body_type' => $bodyType,
            'selected_drive_type' => $driveType,
            'selected_min_range' => $minRange,
            'selected_max_range' => $maxRange
        ];

        $content = view('pages/ev/index', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'Electric Vehicles - Compare EVs in India',
                'description' => 'Explore the best electric vehicles in India. Compare EV range, battery capacity, charging time, and prices.',
                'keywords' => 'electric vehicles, EV cars, electric cars, EV range, EV price, Tesla, Tata EV, Mahindra EV'
            ],
            'content' => $content
        ]);
    }

    /**
     * EV detail page
     */
    public function detail($slug)
    {
        // Get EV details from database
        $ev = $this->vehicleModel->getEVBySlug($slug);
        
        if (!$ev) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('EV not found');
        }
        
        // Get pricing data
        $pricingModel = new \App\Models\PricingModel();
        $pricing = $pricingModel->where('vehicle_id', $ev['vehicle_id'])->first();
        if ($pricing) {
            $ev['ex_showroom_price'] = $pricing['ex_showroom_price'] ?? 0;
            $ev['on_road_price'] = $pricing['on_road_price'] ?? 0;
            $ev['currency'] = $pricing['currency'] ?? 'INR';
            $ev['emi_available'] = $pricing['emi_available'] ?? 0;
            $ev['emi_amount'] = $pricing['emi_amount'] ?? 0;
            $ev['down_payment'] = $pricing['down_payment'] ?? 0;
        }
        
        // Get EV features from ev_features table
        $evFeatures = $this->vehicleModel->getEVFeatures($ev['vehicle_id']);
        if ($evFeatures) {
            $ev = array_merge($ev, $evFeatures);
        }
        
        // Format all EV specifications using the VehicleModel method
        $ev = $this->vehicleModel->formatEVSpecs($ev);
        
        // Calculate charging times
        $charging_info = $this->calculateChargingTimes($ev);
        $ev = array_merge($ev, $charging_info);
        
        // Calculate cost analysis
        $cost_analysis = $this->calculateCostAnalysis($ev);
        
        // Decode JSON fields if they exist
        $ev = $this->decodeJsonFields($ev);
        
        // Get related EVs
        $related_evs = $this->vehicleModel->getRelatedEVs($ev['vehicle_id'], $ev['make'], $ev['fuel_type']);
        foreach ($related_evs as &$related) {
            $related = $this->vehicleModel->formatEVSpecs($related);
        }
        
        $data = [
            'page_title' => $ev['make'] . ' ' . $ev['model'] . ' - Electric Vehicle Details',
            'ev' => $ev,
            'cost_analysis' => $cost_analysis,
            'charging_info' => $charging_info,
            'related_evs' => $related_evs
        ];
        
        $content = view('pages/ev/detail', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => $ev['make'] . ' ' . $ev['model'] . ' - Specifications, Price, Range, Features',
                'description' => 'Check out complete details of ' . $ev['make'] . ' ' . $ev['model'] . ' including price, range, battery capacity, charging time, features and specifications.',
                'keywords' => $ev['make'] . ' ' . $ev['model'] . ', EV, electric vehicle, electric car, EV price, EV range'
            ],
            'content' => $content
        ]);
    }
    
    // Helper methods to add to your EVController
    
    private function calculateChargingTimes($ev)
    {
        $batteryKwh = $ev['battery_capacity_kwh'] ?? 0;
        $rangeKm = $ev['range_km'] ?? 0;
        
        // Standard home charging (15A socket) - ~2.8 kW
        $homeCharging15A = $batteryKwh > 0 ? round($batteryKwh / 2.8, 1) : 'N/A';
        $homeCharging15AFormatted = is_numeric($homeCharging15A) ? $homeCharging15A . ' hours' : 'N/A';
        
        // Home charging with 7.2 kW charger
        $homeCharging7_2 = $batteryKwh > 0 ? round($batteryKwh / 7.2, 1) : 'N/A';
        $homeCharging7_2Formatted = is_numeric($homeCharging7_2) ? $homeCharging7_2 . ' hours' : 'N/A';
        
        // Fast charging (DC 50kW) - 0-80%
        $fastCharging50 = $ev['fast_charging_time'] ?? ($batteryKwh > 0 ? round(($batteryKwh * 0.8) / 50, 1) : 'N/A');
        $fastCharging50Formatted = is_numeric($fastCharging50) ? $fastCharging50 . ' hours' : 'N/A';
        
        return [
            'Home Charging (15A Socket)' => $homeCharging15AFormatted,
            'Home Charging (7.2 kW)' => $homeCharging7_2Formatted,
            'Fast Charging (DC 50kW)' => $fastCharging50Formatted,
            'home_15a' => $homeCharging15AFormatted,
            'home_7_2kw' => $homeCharging7_2Formatted,
            'fast_50kw' => $fastCharging50Formatted
        ];
    }
    
    private function calculateCostAnalysis($ev)
    {
        // Electricity rate (₹ per kWh)
        $electricityRate = 8;
        
        // Petrol rate for comparison (₹ per liter)
        $petrolRate = 105;
        
        // Petrol car mileage (km/l) for comparison
        $petrolMileage = 15;
        
        // Efficiency in Wh/km (convert to kWh/km)
        $efficiencyWhKm = $ev['efficiency_wh_km'] ?? 150;
        $efficiencyKwhKm = $efficiencyWhKm / 1000;
        
        // Cost per km
        $costPerKm = $efficiencyKwhKm * $electricityRate;
        $costPerKmFormatted = '₹ ' . number_format($costPerKm, 2) . '/km';
        
        // Monthly cost (1,500 km)
        $monthlyKm = 1500;
        $monthlyCost = $costPerKm * $monthlyKm;
        $monthlyCostFormatted = '₹ ' . number_format($monthlyCost, 0);
        
        // Annual cost (15,000 km)
        $annualKm = 15000;
        $annualCost = $costPerKm * $annualKm;
        $annualCostFormatted = '₹ ' . number_format($annualCost, 0);
        
        // Petrol cost for same distance
        $petrolCostPerKm = $petrolRate / $petrolMileage;
        $petrolAnnualCost = $petrolCostPerKm * $annualKm;
        
        // Annual savings
        $annualSavings = $petrolAnnualCost - $annualCost;
        $annualSavingsFormatted = '₹ ' . number_format($annualSavings, 0) . '/year';
        
        // CO2 savings (1 liter petrol = 2.3 kg CO2)
        $annualPetrolLiters = $annualKm / $petrolMileage;
        $co2Savings = $annualPetrolLiters * 2.3;
        $co2SavingsFormatted = number_format($co2Savings, 0) . ' kg CO₂/year';
        
        return [
            'cost_per_km' => $costPerKmFormatted,
            'monthly_cost' => $monthlyCostFormatted,
            'annual_cost' => $annualCostFormatted,
            'annual_savings_vs_petrol' => $annualSavingsFormatted,
            'co2_savings_per_year' => $co2SavingsFormatted
        ];
    }
    
    private function decodeJsonFields($ev)
    {
        $jsonFields = [
            'dimensions',
            'suspension',
            'brakes',
            'safety_features',
            'infotainment',
            'comfort_features',
            'interior_features',
            'exterior_features',
            'color_options',
            'warranty',
            'camera_features'
        ];
        
        foreach ($jsonFields as $field) {
            if (isset($ev[$field]) && !empty($ev[$field]) && is_string($ev[$field])) {
                $decoded = json_decode($ev[$field], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $ev[$field] = $decoded;
                } elseif ($ev[$field] == '[]' || $ev[$field] == '{}') {
                    $ev[$field] = [];
                } else {
                    // Try to handle comma-separated strings
                    if (strpos($ev[$field], ',') !== false) {
                        $ev[$field] = array_map('trim', explode(',', $ev[$field]));
                    } else {
                        $ev[$field] = [];
                    }
                }
            } elseif (!isset($ev[$field]) || empty($ev[$field])) {
                $ev[$field] = [];
            }
        }
        
        return $ev;
    }

    /**
     * EV comparison page
     */


    /**
     * Search EVs (AJAX endpoint)
     */
    public function search()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        $query = $this->request->getGet('q');
        if (strlen($query) < 2) {
            return $this->response->setJSON([]);
        }

        $result = $this->vehicleModel->getAllEVs(10, 0, null, $query, null, null);

        $evs = array_map(function ($ev) {
            return [
                'vehicle_id' => $ev['vehicle_id'],
                'make' => $ev['make'],
                'model' => $ev['model'],
                'slug' => $ev['slug'],
                'variant' => $ev['variant'] ?? 'Standard',
                'range_formatted' => $ev['range_formatted'] ?? 'N/A',
                'battery_formatted' => $ev['battery_formatted'] ?? 'N/A',
                'ex_showroom_price' => $ev['ex_showroom_price'] ?? 0,
                'image_url' => $ev['image_url'] ?? null
            ];
        }, $result['evs']);

        return $this->response->setJSON($evs);
    }

    /**
     * Get EV by ID (helper method)
     */
    public function getEVById($id)
    {
        $builder = $this->vehicleModel->db->table('vehicles v');
        $builder->select('v.*, p.ex_showroom_price, p.on_road_price, p.currency,
                          e.battery_capacity_kwh, e.range_km, e.charging_time_80, e.fast_charging_time,
                          e.motor_power_kw, e.motor_power_hp, e.torque_nm, e.drive_type, 
                          e.acceleration_0_100, e.top_speed_kmh, e.charge_port_type, e.battery_warranty,
                          e.battery_type, e.thermal_management, e.regenerative_braking, e.vehicle_to_load,
                          e.real_world_range, e.efficiency_wh_km');
        $builder->join('pricing p', 'p.vehicle_id = v.vehicle_id', 'left');
        $builder->join('ev_features e', 'e.vehicle_id = v.vehicle_id', 'left');
        $builder->where('v.vehicle_id', $id);
        $builder->where('v.fuel_type', 'Electric');

        $result = $builder->get()->getRowArray();

        if ($result) {
            $result = $this->vehicleModel->formatEVSpecs($result);
        }

        return $result;
    }

    /**
     * Calculate cost per kilometer
     */
    
    /**
     * Calculate annual savings vs petrol car
     */
    private function calculateAnnualSavings($ev)
    {
        $annualKm = 15000; // Average annual driving in India
        $petrolCostPerKm = 8.5; // Average petrol cost per km
        $evCostPerKm = $this->calculateCostPerKm($ev);

        $petrolAnnual = $petrolCostPerKm * $annualKm;
        $evAnnual = $evCostPerKm * $annualKm;

        return round($petrolAnnual - $evAnnual, 0);
    }

    /**
     * Get efficiency rating (1-5 stars)
     */

    /**
     * Get complete cost analysis
     */
    private function getCostAnalysis($ev)
    {
        $costPerKm = $this->calculateCostPerKm($ev);
        $annualSavings = $this->calculateAnnualSavings($ev);

        // Calculate CO2 savings (assuming petrol car emits 120g CO2/km)
        $annualKm = 15000;
        $co2PerKm = 0.120; // 120g/km
        $co2Savings = $co2PerKm * $annualKm;

        return [
            'cost_per_km' => '₹' . number_format($costPerKm, 2),
            'cost_per_100km' => '₹' . number_format($costPerKm * 100, 2),
            'monthly_cost' => '₹' . number_format($costPerKm * 1250, 0), // 1250 km per month
            'annual_cost' => '₹' . number_format($costPerKm * 15000, 0),
            'annual_savings_vs_petrol' => '₹' . number_format($annualSavings),
            'co2_savings_per_year' => number_format($co2Savings, 0) . ' kg',
            'efficiency_rating' => $this->getEfficiencyRating($ev)
        ];
    }

    /**
     * Get EV specification groups for detail page
     */
    private function getEVSpecGroups($ev)
    {
        return [
            'Performance' => [
                'Motor Power' => $ev['power_formatted'] ?? 'N/A',
                'Peak Torque' => $ev['torque_formatted'] ?? 'N/A',
                'Acceleration (0-100 km/h)' => $ev['acceleration_formatted'] ?? 'N/A',
                'Top Speed' => $ev['top_speed_formatted'] ?? 'N/A',
                'Drive Type' => $ev['drive_type'] ?? 'N/A'
            ],
            'Battery & Range' => [
                'Battery Capacity' => $ev['battery_formatted'] ?? 'N/A',
                'Battery Type' => $ev['battery_type'] ?? 'N/A',
                'ARAI Certified Range' => $ev['range_formatted'] ?? 'N/A',
                'Real World Range' => $ev['real_range_formatted'] ?? 'N/A',
                'Efficiency' => $ev['efficiency_formatted'] ?? 'N/A',
                'Battery Warranty' => $ev['battery_warranty'] ?? 'N/A'
            ],
            'Charging' => [
                'Home Charging (0-80%)' => $ev['charging_formatted'] ?? 'N/A',
                'Fast Charging (0-80%)' => $ev['fast_charging_formatted'] ?? 'N/A',
                'Charge Port Type' => $ev['charge_port_type'] ?? 'N/A',
                'Fast Charger Compatibility' => $ev['fast_charger_compatible'] ?? 'CCS2',
                'Vehicle to Load (V2L)' => ($ev['vehicle_to_load'] ?? false) ? 'Yes' : 'No'
            ]
        ];
    }

    /**
     * Get charging information
     */
    private function getChargingInfo($ev)
    {
        $homeChargingTime = isset($ev['charging_time_80']) ? ceil($ev['charging_time_80'] * 1.5) : null;

        return [
            'Home Charging (15A Socket)' => $homeChargingTime ? $homeChargingTime . ' hours' : 'N/A',
            'Home Charging (7.2 kW)' => $ev['charging_formatted'] ?? 'N/A',
            'Fast Charging (DC 50kW)' => $ev['fast_charging_formatted'] ?? 'N/A',
            'Charge Port Location' => 'Front',
            'Charge Port Type' => $ev['charge_port_type'] ?? 'Type 2 / CCS2',
            'Charging Cable Included' => ($ev['home_charger_included'] ?? false) ? 'Yes' : 'Home charger not included'
        ];
    }

    /**
     * Get battery information
     */
    private function getBatteryInfo($ev)
    {
        return [
            'Battery Chemistry' => $ev['battery_type'] ?? 'Lithium-ion',
            'Thermal Management' => $ev['thermal_management'] ?? 'Liquid Cooling',
            'Regenerative Braking' => $ev['regenerative_braking'] ?? 'Yes',
            'Battery Warranty' => $ev['battery_warranty'] ?? '8 years / 160,000 km',
            'Motor Warranty' => $ev['motor_warranty'] ?? '8 years / 160,000 km',
            'Waterproof Rating' => 'IP67',
            'Battery Protection' => 'Underbody protection with skid plate'
        ];
    }
    /**
     * Load more EVs via AJAX
     */
    public function loadMore()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        $page = (int) ($this->request->getGet('page') ?? 1);
        $limit = 12;
        $offset = ($page - 1) * $limit;

        // Get filter parameters
        $sort = $this->request->getGet('sort');
        $search = $this->request->getGet('search');
        $minRange = $this->request->getGet('min_range');
        $maxRange = $this->request->getGet('max_range');
        $make = $this->request->getGet('make');
        $bodyType = $this->request->getGet('body_type');

        // Get EVs
        $result = $this->vehicleModel->getAllEVs($limit, $offset, $sort, $search, $minRange, $maxRange);
        $evs = $result['evs'];
        $total = $result['total'];

        // Apply additional filters
        if ($make) {
            $evs = array_filter($evs, function ($ev) use ($make) {
                return $ev['make'] === $make;
            });
        }

        if ($bodyType) {
            $evs = array_filter($evs, function ($ev) use ($bodyType) {
                return $ev['body_type'] === $bodyType;
            });
        }

        $hasMore = ($offset + $limit) < count($evs);
        $evs = array_slice($evs, 0, $limit);

        // Render HTML
        $html = '';
        foreach ($evs as $ev) {
            $html .= $this->renderEVCard($ev);
        }

        return $this->response->setJSON([
            'html' => $html,
            'has_more' => $hasMore,
            'current_page' => $page + 1,
            'total' => count($evs)
        ]);
    }

    /**
     * Render EV card HTML
     */
    private function renderEVCard($ev)
    {
        ob_start();
        ?>
        <div class="col-md-6 col-xl-4">
            <div class="ev-card">
                <div class="ev-card-badge">
                    <span class="ev-badge">
                        <i class="bi bi-ev-station-fill me-1"></i> Electric
                    </span>
                </div>
                <div class="ev-card-image">
                    <?php if (!empty($ev['image_url'])): ?>
                        <img src="<?= esc($ev['image_url']) ?>" alt="<?= esc($ev['make']) ?> <?= esc($ev['model']) ?>">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="bi bi-ev-station" style="font-size: 4rem; color: #10b981;"></i>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($ev['ex_showroom_price']) && $ev['ex_showroom_price'] > 0): ?>
                        <div class="ev-card-price">
                            ₹ <?= number_format($ev['ex_showroom_price'], 0) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="ev-card-body">
                    <h3 class="ev-title">
                        <?= esc($ev['make']) ?>         <?= esc($ev['model']) ?>
                    </h3>
                    <?php if (!empty($ev['variant'])): ?>
                        <div class="ev-variant"><?= esc($ev['variant']) ?></div>
                    <?php endif; ?>

                    <div class="ev-specs-grid">
                        <div class="ev-spec-item">
                            <i class="bi bi-battery-full ev-spec-icon"></i>
                            <span class="ev-spec-value"><?= $ev['battery_formatted'] ?? 'N/A' ?></span>
                            <span class="ev-spec-label">Battery</span>
                        </div>
                        <div class="ev-spec-item">
                            <i class="bi bi-speedometer2 ev-spec-icon"></i>
                            <span class="ev-spec-value"><?= $ev['range_formatted'] ?? 'N/A' ?></span>
                            <span class="ev-spec-label">Range</span>
                        </div>
                        <div class="ev-spec-item">
                            <i class="bi bi-lightning-charge ev-spec-icon"></i>
                            <span class="ev-spec-value"><?= $ev['power_formatted'] ?? 'N/A' ?></span>
                            <span class="ev-spec-label">Power</span>
                        </div>
                    </div>

                    <div class="ev-charging">
                        <i class="bi bi-clock-history"></i>
                        <span><?= $ev['charging_formatted'] ?? 'N/A' ?></span>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <a href="<?= site_url('ev/detail/' . $ev['slug']) ?>" class="btn btn-outline-ev flex-grow-1">
                            <i class="bi bi-eye me-1"></i> Details
                        </a>
                        <button class="btn btn-ev-compare"
                            onclick="addToCompare(<?= $ev['vehicle_id'] ?>, '<?= esc($ev['make']) ?>', '<?= esc($ev['model']) ?>')">
                            <i class="bi bi-bar-chart-steps me-1"></i> Compare
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    // In your EVController.php compare method

    // Create an API endpoint for AJAX calls
    public function getEvData()
    {
        if ($this->request->isAJAX()) {
            $evs = $this->evModel->findAll();
            return $this->response->setJSON($evs);
        }
    }
    public function compare($ids = null)
    {
        if (!$ids) {
            $ids = $this->request->getGet('ids');
        }

        if (!$ids) {
            return redirect()->to('/ev')->with('error', 'Please select EVs to compare');
        }

        // Parse IDs from URL
        $ids = str_replace(['/', '-'], ',', $ids);
        $vehicleIds = array_filter(explode(',', $ids));

        if (count($vehicleIds) < 2) {
            return redirect()->to('/ev')->with('error', 'Please select at least two EVs to compare');
        }

        // Limit to maximum 4 vehicles for better UX
        if (count($vehicleIds) > 4) {
            return redirect()->to('/ev')->with('error', 'You can compare maximum 4 vehicles at a time');
        }

        // Get EVs with complete details using existing methods
        $evs = [];
        foreach ($vehicleIds as $id) {
            // First try to get by ID
            $ev = $this->vehicleModel->getEVById($id);
            if (!$ev) {
                // Try by slug
                $ev = $this->vehicleModel->getEVBySlug($id);
            }

            if ($ev) {
                // Get pricing data
                $pricingModel = new \App\Models\PricingModel();
                $pricing = $pricingModel->where('vehicle_id', $ev['vehicle_id'])->first();
                if ($pricing) {
                    $ev['ex_showroom_price'] = $pricing['ex_showroom_price'] ?? 0;
                    $ev['on_road_price'] = $pricing['on_road_price'] ?? 0;
                    $ev['currency'] = $pricing['currency'] ?? 'INR';
                    $ev['emi_available'] = $pricing['emi_available'] ?? 0;
                    $ev['emi_amount'] = $pricing['emi_amount'] ?? 0;
                    $ev['down_payment'] = $pricing['down_payment'] ?? 0;
                }

                // Get EV features from ev_features table
                $evFeatures = $this->vehicleModel->getEVFeatures($ev['vehicle_id']);
                if ($evFeatures) {
                    $ev = array_merge($ev, $evFeatures);
                }

                // Format EV specifications
                $ev = $this->vehicleModel->formatEVSpecs($ev);

                $evs[] = $ev;
            }
        }

        if (count($evs) < 2) {
            return redirect()->to('/ev')->with('error', 'Selected vehicles not found');
        }

        // Calculate additional metrics for comparison
        foreach ($evs as &$ev) {
            $ev['cost_per_km'] = $this->calculateCostPerKm($ev);
            $ev['cost_per_100km'] = $ev['cost_per_km'] * 100;
            $ev['efficiency_rating'] = $this->getEfficiencyRating($ev);
            $ev['range_score'] = $this->calculateRangeScore($ev);
            $ev['price_score'] = $this->calculatePriceScore($ev);
            $ev['overall_score'] = ($ev['range_score'] + $ev['price_score']) / 2;
        }

        // Get all EVs for the comparison selector
        $allVehicles = $this->vehicleModel->getAllEVsForComparison();

        $data = [
            'page_title' => 'Compare Electric Vehicles',
            'evs' => $evs,
            'compare_ids' => array_column($evs, 'vehicle_id'),
            'all_vehicles' => $allVehicles,
            'vehicle_count' => count($evs)
        ];

        $content = view('pages/ev/compare', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'EV Comparison - Compare Electric Vehicles Side by Side',
                'description' => 'Compare electric vehicles based on range, battery, charging time, price, and features.',
                'keywords' => 'EV comparison, electric car comparison, EV range compare'
            ],
            'content' => $content
        ]);
    }

    // Add these helper methods to your EVController (continued)

    private function calculateCostPerKm($ev)
    {
        // Assuming electricity cost of ₹8 per kWh
        $electricityRate = 8;
        $efficiency = $ev['efficiency_wh_km'] ?? 150; // Default 150 Wh/km if not set

        // Cost per km = (efficiency in kWh/km) * electricity rate
        $costPerKm = ($efficiency / 1000) * $electricityRate;

        return $costPerKm;
    }

    private function getEfficiencyRating($ev)
    {
        $efficiency = $ev['efficiency_wh_km'] ?? 150;

        if ($efficiency <= 120)
            return 'Excellent';
        if ($efficiency <= 150)
            return 'Good';
        if ($efficiency <= 180)
            return 'Average';
        return 'Below Average';
    }

    private function calculateRangeScore($ev)
    {
        $maxRange = 500; // Maximum expected range in km
        $range = $ev['range_km'] ?? 0;
        if ($range <= 0)
            return 0;
        return min(100, ($range / $maxRange) * 100);
    }

    private function calculatePriceScore($ev)
    {
        $minPrice = 1000000; // Minimum expected price (₹10 Lakhs)
        $maxPrice = 5000000; // Maximum expected price (₹50 Lakhs)
        $price = $ev['ex_showroom_price'] ?? 0;

        if ($price <= 0)
            return 0;

        // Lower price gets higher score
        if ($price <= $minPrice)
            return 100;
        if ($price >= $maxPrice)
            return 0;

        return round(100 - (($price - $minPrice) / ($maxPrice - $minPrice)) * 100);
    }


}