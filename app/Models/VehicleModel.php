<?php

namespace App\Models;

use CodeIgniter\Model;

class VehicleModel extends Model
{
    protected $table = 'vehicles';
    protected $primaryKey = 'vehicle_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;

    protected $allowedFields = [
        'make',
        'model',
        'variant',
        'slug',
        'year',
        'body_type',
        'fuel_type',
        'transmission',
        'engine_cc',
        'power_bhp',
        'torque_nm',
        'mileage_kmpl',
        'mileage',
        'seating_capacity',
        'boot_space_liters',
        'ground_clearance_mm',
        'dimensions',
        'weight_kg',
        'drive_type',
        'suspension',
        'brakes',
        'tyre_spec',
        'safety_features',
        'infotainment',
        'comfort_features',
        'interior_features',
        'exterior_features',
        'color_options',
        'warranty',
        'ncap_rating',
        'camera_features',
        'image_url',
        'brochure_url'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    /*
    |--------------------------------------------------------------------------
    | STORED PROCEDURE METHODS
    |--------------------------------------------------------------------------
    */

    /**
     * Get all cars with pagination and filters using stored procedure
     */
    public function getAllCarsWithFilters($limit = 12, $offset = 0, $sort = null, $fuel = null, $body = null, $search = null)
    {
        $limit = (int) $limit;
        $offset = (int) $offset;
        $sort = $sort ? "'" . $this->db->escapeString($sort) . "'" : "NULL";
        $fuel = $fuel ? "'" . $this->db->escapeString($fuel) . "'" : "NULL";
        $body = $body ? "'" . $this->db->escapeString($body) . "'" : "NULL";
        $search = $search ? "'" . $this->db->escapeString($search) . "'" : "NULL";

        // Call stored procedure
        $query = $this->db->query("CALL sp_GetAllCars({$limit}, {$offset}, {$sort}, {$fuel}, {$body}, {$search})");
        $cars = $query->getResultArray();
        $query->freeResult();

        // Get total count from second result set
        $total = count($cars);
        if ($this->db->connID->more_results() && $this->db->connID->next_result()) {
            $countResult = $this->db->connID->store_result();
            if ($countResult) {
                $row = $countResult->fetch_assoc();
                $total = $row['total_count'] ?? count($cars);
                $countResult->free();
            }
        }

        // Clean up any remaining results
        $this->cleanStoredProcedureResults();

        // Decode JSON fields and format dimensions
        foreach ($cars as &$car) {
            $car = $this->decodeJsonFields($car);
            $car = $this->formatDimensions($car);
        }

        return ['cars' => $cars, 'total' => $total];
    }

    /**
     * Get car detail by slug using stored procedure
     */
    public function getCarDetailBySlug($slug)
    {
        $slug = $this->db->escapeString($slug);
        $query = $this->db->query("CALL sp_GetCarDetailBySlug('{$slug}')");
        $result = $query->getRowArray();
        $query->freeResult();

        $this->cleanStoredProcedureResults();

        if ($result) {
            $result = $this->decodeJsonFields($result);
            $result = $this->formatDimensions($result);
        }

        return $result;
    }

    /**
     * Get car detail by ID using stored procedure
     */
    public function getCarDetailById($vehicleId)
    {
        $vehicleId = (int) $vehicleId;
        $query = $this->db->query("CALL sp_GetCarDetailById({$vehicleId})");
        $result = $query->getRowArray();
        $query->freeResult();

        $this->cleanStoredProcedureResults();

        if ($result) {
            $result = $this->decodeJsonFields($result);
            $result = $this->formatDimensions($result);
        }

        return $result;
    }

    /**
     * Get filter options with counts using stored procedure
     */
    public function getFilterOptions()
    {
        $query = $this->db->query("CALL sp_GetFilterOptions()");

        // First result set: fuel types
        $fuelTypes = $query->getResultArray();
        $query->freeResult();

        // Second result set: body types
        $bodyTypes = [];
        if ($this->db->connID->more_results() && $this->db->connID->next_result()) {
            $res = $this->db->connID->store_result();
            if ($res) {
                $bodyTypes = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
            }
        }

        // Third result set: makes
        $makes = [];
        if ($this->db->connID->more_results() && $this->db->connID->next_result()) {
            $res = $this->db->connID->store_result();
            if ($res) {
                $makes = $res->fetch_all(MYSQLI_ASSOC);
                $res->free();
            }
        }

        // Fourth result set: price range
        $priceRange = ['min_price' => 0, 'max_price' => 10000000];
        if ($this->db->connID->more_results() && $this->db->connID->next_result()) {
            $res = $this->db->connID->store_result();
            if ($res) {
                $priceRange = $res->fetch_assoc();
                $res->free();
            }
        }

        $this->cleanStoredProcedureResults();

        return [
            'fuel_types' => $fuelTypes,
            'body_types' => $bodyTypes,
            'makes' => $makes,
            'price_range' => $priceRange
        ];
    }

    /**
     * Search cars using stored procedure
     */
    public function searchCarsByTerm($searchTerm, $limit = 10)
    {
        $searchTerm = $this->db->escapeString($searchTerm);
        $limit = (int) $limit;
        $query = $this->db->query("CALL sp_SearchCars('{$searchTerm}', {$limit})");
        $results = $query->getResultArray();
        $query->freeResult();

        $this->cleanStoredProcedureResults();

        return $results;
    }

    /**
     * Clean up stored procedure result sets
     */
    private function cleanStoredProcedureResults()
    {
        while ($this->db->connID->more_results() && $this->db->connID->next_result()) {
            if ($res = $this->db->connID->store_result()) {
                $res->free();
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER METHODS
    |--------------------------------------------------------------------------
    */

    /**
     * Decode JSON fields
     */
    private function decodeJsonFields($data)
    {
        if (empty($data))
            return $data;

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
            'camera_features',
            'discount_offers'
        ];

        foreach ($jsonFields as $field) {
            if (isset($data[$field]) && !empty($data[$field]) && is_string($data[$field])) {
                $decoded = json_decode($data[$field], true);
                $data[$field] = (json_last_error() === JSON_ERROR_NONE) ? ($decoded ?? []) : [];
            } elseif (!isset($data[$field]) || empty($data[$field])) {
                $data[$field] = [];
            }
        }

        // Decode pros/cons/competitors from car_content
        foreach (['pros', 'cons', 'competitors'] as $field) {
            if (isset($data[$field]) && !empty($data[$field]) && is_string($data[$field])) {
                $decoded = json_decode($data[$field], true);
                $data[$field] = (json_last_error() === JSON_ERROR_NONE) ? ($decoded ?? []) : [];
            } elseif (isset($data[$field]) && empty($data[$field])) {
                $data[$field] = [];
            }
        }

        return $data;
    }

    /**
     * Format dimensions for display
     */
    private function formatDimensions($data)
    {
        if (empty($data))
            return $data;

        $convertToFeet = function ($mm) {
            if (!$mm)
                return null;
            return round((float) $mm / 304.8, 2);
        };

        // Get dimensions array
        $dimensions = $data['dimensions'] ?? [];

        // Format dimensions_formatted
        $data['dimensions_formatted'] = [
            'length' => isset($dimensions['length_mm']) && $dimensions['length_mm']
                ? $dimensions['length_mm'] . ' mm (' . $convertToFeet($dimensions['length_mm']) . ' ft)'
                : 'N/A',
            'width' => isset($dimensions['width_mm']) && $dimensions['width_mm']
                ? $dimensions['width_mm'] . ' mm (' . $convertToFeet($dimensions['width_mm']) . ' ft)'
                : 'N/A',
            'height' => isset($dimensions['height_mm']) && $dimensions['height_mm']
                ? $dimensions['height_mm'] . ' mm (' . $convertToFeet($dimensions['height_mm']) . ' ft)'
                : 'N/A',
            'wheelbase' => isset($dimensions['wheelbase_mm']) && $dimensions['wheelbase_mm']
                ? $dimensions['wheelbase_mm'] . ' mm (' . $convertToFeet($dimensions['wheelbase_mm']) . ' ft)'
                : 'N/A',
        ];

        // Format suspension
        $suspension = $data['suspension'] ?? [];
        $data['suspension_formatted'] = [
            'front' => $suspension['front'] ?? 'N/A',
            'rear' => $suspension['rear'] ?? 'N/A',
        ];

        // Format brakes
        $brakes = $data['brakes'] ?? [];
        $data['brakes_formatted'] = [
            'front' => $brakes['front'] ?? 'N/A',
            'rear' => $brakes['rear'] ?? 'N/A',
        ];

        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | LEGACY METHODS (for backward compatibility)
    |--------------------------------------------------------------------------
    */

    public function getCarsListWithFilters($limit, $offset, $sort, $fuel, $body, $search)
    {
        return $this->getAllCarsWithFilters($limit, $offset, $sort, $fuel, $body, $search);
    }

    public function getCompleteCarDetailBySlug($slug)
    {
        return $this->getCarDetailBySlug($slug);
    }

    public function getCompleteCarDetailById($vehicleId)
    {
        return $this->getCarDetailById($vehicleId);
    }

    public function getFilterOptionsWithCounts()
    {
        return $this->getFilterOptions();
    }

    public function searchCarsWithContent($searchTerm, $limit = 10)
    {
        return $this->searchCarsByTerm($searchTerm, $limit);
    }

    public function getFeaturedCars($limit = 6)
    {
        return $this->getAllCarsWithFilters($limit, 0, null, null, null, null)['cars'];
    }

    public function getRelatedCars($vehicleId, $limit = 4)
    {
        $current = $this->find($vehicleId);
        if (!$current)
            return [];

        return $this->where('vehicle_id !=', $vehicleId)
            ->groupStart()
            ->where('body_type', $current['body_type'])
            ->orWhere('fuel_type', $current['fuel_type'])
            ->groupEnd()
            ->limit($limit)
            ->findAll();
    }

    public function getCarsList($limit = 50)
    {
        $result = $this->getAllCarsWithFilters($limit, 0, null, null, null, null);
        return $result['cars'];
    }

    public function getVehicleDetail($vehicleId)
    {
        return $this->find($vehicleId);
    }

    public function getVehicleWithPricing($vehicleId)
    {
        return $this->getCarDetailById($vehicleId);
    }

    public function getCarContent($vehicleId)
    {
        return $this->db->table('car_content')
            ->where('vehicle_id', $vehicleId)
            ->get()
            ->getRowArray();
    }

    public function getVehicleBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getCarsByMake($make, $limit = 20)
    {
        return $this->where('make', $make)->limit($limit)->findAll();
    }

    public function searchCars($searchTerm)
    {
        return $this->like('make', $searchTerm)
            ->orLike('model', $searchTerm)
            ->orLike('variant', $searchTerm)
            ->limit(20)
            ->findAll();
    }

    public function getCarsByPrice($sort = 'asc', $limit = 50)
    {
        $order = $sort === 'desc' ? 'DESC' : 'ASC';
        return $this->db->table('vehicles v')
            ->select('v.*, p.ex_showroom_price')
            ->join('pricing p', 'p.vehicle_id = v.vehicle_id', 'left')
            ->orderBy('p.ex_showroom_price', $order)
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    public function getCarsByCategory($category = null, $limit = 20)
    {
        if ($category) {
            return $this->where('body_type', $category)->limit($limit)->findAll();
        }
        return $this->limit($limit)->findAll();
    }

    public function getCategories()
    {
        $results = $this->select('body_type')
            ->where('body_type IS NOT NULL')
            ->where('body_type !=', '')
            ->groupBy('body_type')
            ->findAll();
        return array_column($results, 'body_type');
    }

    public function getFuelTypes()
    {
        $results = $this->select('fuel_type')
            ->where('fuel_type IS NOT NULL')
            ->where('fuel_type !=', '')
            ->groupBy('fuel_type')
            ->findAll();
        return array_column($results, 'fuel_type');
    }

    public function getBodyTypes()
    {
        return $this->getCategories();
    }

    public function getVehiclesWithFeatures()
    {
        return $this->findAll();
    }

    public function getVehiclesByFeatureCategory($category)
    {
        return $this->findAll();
    }

    public function getRecentVehicles($userId)
    {
        return $this->orderBy('updated_at', 'DESC')->limit(5)->findAll();
    }

    public function getCarsForComparison($ids)
    {
        $idsArray = array_filter(explode(',', $ids));
        if (empty($idsArray)) {
            return [];
        }

        // Get vehicles with pricing data
        $results = $this->select('vehicles.*, p.ex_showroom_price, p.on_road_price, p.currency, p.emi_available, p.emi_amount, p.down_payment, p.insurance_cost, p.road_tax, p.discount_offers as pricing_discounts')
            ->join('pricing p', 'p.vehicle_id = vehicles.vehicle_id', 'left')
            ->whereIn('vehicles.vehicle_id', $idsArray)
            ->findAll();

        // If no pricing data found via join, fetch it separately
        foreach ($results as &$vehicle) {
            if (empty($vehicle['ex_showroom_price']) || $vehicle['ex_showroom_price'] == 0) {
                // Try to get pricing separately
                $pricingModel = new \App\Models\PricingModel();
                $pricing = $pricingModel->where('vehicle_id', $vehicle['vehicle_id'])->first();
                if ($pricing) {
                    $vehicle['ex_showroom_price'] = $pricing['ex_showroom_price'] ?? 0;
                    $vehicle['on_road_price'] = $pricing['on_road_price'] ?? 0;
                    $vehicle['currency'] = $pricing['currency'] ?? 'INR';
                    $vehicle['emi_available'] = $pricing['emi_available'] ?? 0;
                    $vehicle['emi_amount'] = $pricing['emi_amount'] ?? 0;
                    $vehicle['down_payment'] = $pricing['down_payment'] ?? 0;
                    $vehicle['insurance_cost'] = $pricing['insurance_cost'] ?? 0;
                    $vehicle['road_tax'] = $pricing['road_tax'] ?? 0;
                }
            }

            // Ensure all price fields exist with default values
            $vehicle['ex_showroom_price'] = $vehicle['ex_showroom_price'] ?? 0;
            $vehicle['on_road_price'] = $vehicle['on_road_price'] ?? 0;
            $vehicle['currency'] = $vehicle['currency'] ?? 'INR';
            $vehicle['emi_available'] = $vehicle['emi_available'] ?? 0;
            $vehicle['insurance_cost'] = $vehicle['insurance_cost'] ?? 0;
            $vehicle['road_tax'] = $vehicle['road_tax'] ?? 0;
        }

        return $results;
    }

    /**
     * Get all EVs with their features (simplified version without stored procedures)
     */
    public function getAllEVs($limit = 12, $offset = 0, $sort = null, $search = null, $minRange = null, $maxRange = null)
    {
        $builder = $this->db->table('vehicles v');
        $builder->select('v.*, p.ex_showroom_price, p.on_road_price, p.currency, 
                      e.battery_capacity_kwh, e.range_km, e.charging_time_80, e.fast_charging_time,
                      e.motor_power_kw, e.motor_power_hp, e.torque_nm, e.drive_type, 
                      e.acceleration_0_100, e.top_speed_kmh, e.charge_port_type, e.battery_warranty,
                      e.battery_type, e.thermal_management, e.regenerative_braking, e.vehicle_to_load,
                      e.real_world_range, e.efficiency_wh_km');
        $builder->join('pricing p', 'p.vehicle_id = v.vehicle_id', 'left');
        $builder->join('ev_features e', 'e.vehicle_id = v.vehicle_id', 'left');
        $builder->where('v.fuel_type', 'Electric');

        // Apply search filter
        if ($search && !empty($search)) {
            $builder->groupStart()
                ->like('v.make', $search)
                ->orLike('v.model', $search)
                ->orLike('v.variant', $search)
                ->groupEnd();
        }

        // Apply range filter
        if ($minRange && is_numeric($minRange)) {
            $builder->where('e.range_km >=', (int) $minRange);
        }
        if ($maxRange && is_numeric($maxRange)) {
            $builder->where('e.range_km <=', (int) $maxRange);
        }

        // Apply sorting
        if ($sort) {
            switch ($sort) {
                case 'price_low':
                    $builder->orderBy('p.ex_showroom_price', 'ASC');
                    break;
                case 'price_high':
                    $builder->orderBy('p.ex_showroom_price', 'DESC');
                    break;
                case 'range_high':
                    $builder->orderBy('e.range_km', 'DESC');
                    break;
                case 'range_low':
                    $builder->orderBy('e.range_km', 'ASC');
                    break;
                case 'battery_high':
                    $builder->orderBy('e.battery_capacity_kwh', 'DESC');
                    break;
                case 'newest':
                    $builder->orderBy('v.year', 'DESC');
                    break;
                default:
                    $builder->orderBy('v.make', 'ASC')->orderBy('v.model', 'ASC');
            }
        } else {
            $builder->orderBy('v.make', 'ASC')->orderBy('v.model', 'ASC');
        }

        // Get total count
        $total = $builder->countAllResults(false);

        // Apply pagination
        $builder->limit($limit, $offset);
        $query = $builder->get();
        $evs = $query->getResultArray();

        // Format EV specifications
        foreach ($evs as &$ev) {
            $ev = $this->formatEVSpecs($ev);
        }

        return ['evs' => $evs, 'total' => $total];
    }

    /**
     * Get EV by ID with all features
     */


    /**
     * Format EV specific specifications
     * This method should be added to your VehicleModel.php
     */
    public function formatEVSpecs($data)
    {
        if (empty($data))
            return $data;

        // Format battery capacity
        if (isset($data['battery_capacity_kwh']) && $data['battery_capacity_kwh']) {
            $data['battery_formatted'] = $data['battery_capacity_kwh'] . ' kWh';
        } else {
            $data['battery_formatted'] = 'N/A';
        }

        // Format range
        if (isset($data['range_km']) && $data['range_km']) {
            $data['range_formatted'] = number_format($data['range_km']) . ' km';
            $data['range_miles'] = round($data['range_km'] * 0.621371, 1) . ' miles';
        } else {
            $data['range_formatted'] = 'N/A';
        }

        // Format real world range
        if (isset($data['real_world_range']) && $data['real_world_range']) {
            $data['real_range_formatted'] = number_format($data['real_world_range']) . ' km';
        } else {
            $data['real_range_formatted'] = $data['range_formatted'] ?? 'N/A';
        }

        // Format charging time
        if (isset($data['charging_time_80']) && $data['charging_time_80']) {
            $data['charging_formatted'] = $data['charging_time_80'] . ' hours (0-80%)';
        } else {
            $data['charging_formatted'] = 'N/A';
        }

        // Format fast charging
        if (isset($data['fast_charging_time']) && $data['fast_charging_time']) {
            $data['fast_charging_formatted'] = $data['fast_charging_time'] . ' hours (0-80%)';
        } else {
            $data['fast_charging_formatted'] = 'N/A';
        }

        // Format motor power
        if (isset($data['motor_power_kw']) && $data['motor_power_kw']) {
            $data['power_formatted'] = number_format($data['motor_power_kw']) . ' kW';
            if (isset($data['motor_power_hp']) && $data['motor_power_hp']) {
                $data['power_formatted'] .= ' (' . number_format($data['motor_power_hp']) . ' HP)';
            }
        } else {
            $data['power_formatted'] = 'N/A';
        }

        // Format torque
        if (isset($data['torque_nm']) && $data['torque_nm']) {
            $data['torque_formatted'] = number_format($data['torque_nm']) . ' Nm';
        } else {
            $data['torque_formatted'] = 'N/A';
        }

        // Format acceleration
        if (isset($data['acceleration_0_100']) && $data['acceleration_0_100']) {
            $data['acceleration_formatted'] = $data['acceleration_0_100'] . ' seconds';
        } else {
            $data['acceleration_formatted'] = 'N/A';
        }

        // Format top speed
        if (isset($data['top_speed_kmh']) && $data['top_speed_kmh']) {
            $data['top_speed_formatted'] = $data['top_speed_kmh'] . ' km/h';
        } else {
            $data['top_speed_formatted'] = 'N/A';
        }

        // Format drive type with icon
        if (isset($data['drive_type']) && $data['drive_type']) {
            $driveIcons = [
                'FWD' => 'bi bi-arrow-right-circle',
                'RWD' => 'bi bi-arrow-left-circle',
                'AWD' => 'bi bi-arrow-left-right',
                '4WD' => 'bi bi-grid-3x3-gap-fill'
            ];
            $data['drive_icon'] = $driveIcons[$data['drive_type']] ?? 'bi bi-car-front';
        }

        // Format V2L capability
        $data['v2l_available'] = isset($data['vehicle_to_load']) && $data['vehicle_to_load'];
        $data['v2l_formatted'] = $data['v2l_available'] ? 'Yes' : 'No';

        // Format efficiency
        if (isset($data['efficiency_wh_km']) && $data['efficiency_wh_km']) {
            $data['efficiency_formatted'] = $data['efficiency_wh_km'] . ' Wh/km';
        } else {
            $data['efficiency_formatted'] = 'N/A';
        }

        // Format thermal management
        if (isset($data['thermal_management']) && $data['thermal_management']) {
            $data['thermal_formatted'] = $data['thermal_management'];
        } else {
            $data['thermal_formatted'] = 'Liquid Cooling';
        }

        // Format regenerative braking
        if (isset($data['regenerative_braking']) && $data['regenerative_braking']) {
            $data['regenerative_formatted'] = $data['regenerative_braking'];
        } else {
            $data['regenerative_formatted'] = 'Yes';
        }

        return $data;
    }


    /**
     * Get EV filter options for sidebar (makes, body types, drive types, ranges)
     */
    public function getEVFilterOptions()
    {
        $builder = $this->db->table('vehicles v');
        $builder->select('
        MIN(e.range_km) as min_range,
        MAX(e.range_km) as max_range,
        MIN(e.battery_capacity_kwh) as min_battery,
        MAX(e.battery_capacity_kwh) as max_battery,
        MIN(e.motor_power_kw) as min_power,
        MAX(e.motor_power_kw) as max_power
    ');
        $builder->join('ev_features e', 'e.vehicle_id = v.vehicle_id', 'left');
        $builder->where('v.fuel_type', 'Electric');
        $stats = $builder->get()->getRowArray();

        // Get makes with EV counts
        $makes = $this->select('make, COUNT(*) as count')
            ->where('fuel_type', 'Electric')
            ->groupBy('make')
            ->orderBy('count', 'DESC')
            ->findAll();

        // Get body types with EV counts
        $bodyTypes = $this->select('body_type, COUNT(*) as count')
            ->where('fuel_type', 'Electric')
            ->where('body_type IS NOT NULL')
            ->where('body_type !=', '')
            ->groupBy('body_type')
            ->orderBy('count', 'DESC')
            ->findAll();

        // Get drive types from ev_features
        $driveTypes = $this->db->table('ev_features e')
            ->select('e.drive_type, COUNT(*) as count')
            ->join('vehicles v', 'v.vehicle_id = e.vehicle_id')
            ->where('v.fuel_type', 'Electric')
            ->where('e.drive_type IS NOT NULL')
            ->where('e.drive_type !=', '')
            ->groupBy('e.drive_type')
            ->orderBy('count', 'DESC')
            ->get()
            ->getResultArray();

        // Get price range for EVs
        $priceRange = $this->db->table('vehicles v')
            ->select('MIN(p.ex_showroom_price) as min_price, MAX(p.ex_showroom_price) as max_price')
            ->join('pricing p', 'p.vehicle_id = v.vehicle_id', 'left')
            ->where('v.fuel_type', 'Electric')
            ->where('p.ex_showroom_price IS NOT NULL')
            ->get()
            ->getRowArray();

        return [
            'range' => [
                'min' => (int) ($stats['min_range'] ?? 0),
                'max' => (int) ($stats['max_range'] ?? 500)
            ],
            'battery' => [
                'min' => (float) ($stats['min_battery'] ?? 0),
                'max' => (float) ($stats['max_battery'] ?? 100)
            ],
            'power' => [
                'min' => (int) ($stats['min_power'] ?? 0),
                'max' => (int) ($stats['max_power'] ?? 500)
            ],
            'price' => [
                'min' => (int) ($priceRange['min_price'] ?? 0),
                'max' => (int) ($priceRange['max_price'] ?? 5000000)
            ],
            'makes' => $makes,
            'body_types' => $bodyTypes,
            'drive_types' => $driveTypes
        ];
    }
    /**
     * Get single EV by slug with all features
     */


    public function getCompleteEVDetails($id = null, $slug = null)
    {
        $builder = $this->db->table('vehicles v');
        $builder->select('
            v.*,
            vs.range_km,
            vs.battery_capacity,
            vs.acceleration,
            vs.charging_time,
            vs.fast_charging,
            vs.motor_power,
            vs.top_speed,
            vs.seating_capacity,
            vs.boot_space,
            vs.ground_clearance,
            vs.wheel_size,
            p.ex_showroom_price,
            p.on_road_price,
            p.currency
        ');

        $builder->join('vehicle_specifications vs', 'vs.vehicle_id = v.vehicle_id', 'left');
        $builder->join('pricing p', 'p.vehicle_id = v.vehicle_id', 'left');

        if ($id) {
            $builder->where('v.vehicle_id', $id);
        } elseif ($slug) {
            $builder->where('v.slug', $slug);
        }

        $builder->where('v.vehicle_type', 'EV');
        $builder->where('v.status', 1);

        $result = $builder->get()->getRowArray();

        if ($result) {
            // Get features
            $result['features'] = $this->getVehicleFeatures($result['vehicle_id']);

            // Get images
            $result['images'] = $this->getVehicleImages($result['vehicle_id']);
        }

        return $result;
    }

    /**
     * Get all EVs for comparison (basic info)
     */

    /**
     * Get vehicle features
     */
    private function getVehicleFeatures($vehicleId)
    {
        $builder = $this->db->table('vehicle_features');
        $builder->select('features.feature_id, features.feature_name, features.category');
        $builder->join('features', 'features.feature_id = vehicle_features.feature_id');
        $builder->where('vehicle_features.vehicle_id', $vehicleId);
        $builder->where('features.status', 1);
        $builder->orderBy('features.category', 'ASC');

        return $builder->get()->getResultArray();
    }

    /**
     * Get vehicle images
     */
    private function getVehicleImages($vehicleId)
    {
        $builder = $this->db->table('vehicle_images');
        $builder->select('image_id, image_url, alt_text, is_primary, sort_order');
        $builder->where('vehicle_id', $vehicleId);
        $builder->where('status', 1);
        $builder->orderBy('is_primary', 'DESC');
        $builder->orderBy('sort_order', 'ASC');

        return $builder->get()->getResultArray();
    }

    /**
     * Get multiple EVs for comparison by IDs
     */
    public function getEVsForComparison($ids)
    {
        if (empty($ids)) {
            return [];
        }

        $builder = $this->db->table('vehicles v');
        $builder->select('
            v.*,
            vs.range_km,
            vs.battery_capacity,
            vs.acceleration,
            vs.charging_time,
            vs.fast_charging,
            vs.motor_power,
            vs.top_speed,
            vs.seating_capacity,
            vs.boot_space,
            vs.ground_clearance,
            vs.wheel_size,
            p.ex_showroom_price,
            p.on_road_price,
            p.currency
        ');

        $builder->join('vehicle_specifications vs', 'vs.vehicle_id = v.vehicle_id', 'left');
        $builder->join('pricing p', 'p.vehicle_id = v.vehicle_id', 'left');
        $builder->whereIn('v.vehicle_id', $ids);
        $builder->where('v.vehicle_type', 'EV');
        $builder->where('v.status', 1);

        $results = $builder->get()->getResultArray();

        // Add features and images for each vehicle
        foreach ($results as &$result) {
            $result['features'] = $this->getVehicleFeatures($result['vehicle_id']);
            $result['images'] = $this->getVehicleImages($result['vehicle_id']);
        }

        return $results;
    }

    /**
     * Search EVs for comparison
     */
    public function searchEVsForComparison($searchTerm)
    {
        $builder = $this->db->table('vehicles v');
        $builder->select('
            v.vehicle_id,
            v.vehicle_name,
            v.brand_name,
            v.slug,
            vs.range_km,
            p.ex_showroom_price,
            p.currency
        ');

        $builder->join('vehicle_specifications vs', 'vs.vehicle_id = v.vehicle_id', 'left');
        $builder->join('pricing p', 'p.vehicle_id = v.vehicle_id', 'left');
        $builder->where('v.vehicle_type', 'EV');
        $builder->where('v.status', 1);
        $builder->groupStart()
            ->like('v.vehicle_name', $searchTerm)
            ->orLike('v.brand_name', $searchTerm)
            ->groupEnd();
        $builder->limit(10);

        return $builder->get()->getResultArray();
    }


    /**
     * Get EV features by vehicle ID from ev_features table
     */
    public function getEVFeatures($vehicleId)
    {
        $builder = $this->db->table('ev_features');
        $builder->where('vehicle_id', $vehicleId);
        $result = $builder->get()->getRowArray();
        return $result ?: [];
    }

    /**
     * Get all EVs for comparison (updated to use your actual schema)
     */

    /**
     * Get EV by ID (updated to use your schema)
     */
    public function getEVById($id)
    {
        $builder = $this->db->table('vehicles');
        $builder->where('vehicle_id', $id);
        $builder->where('fuel_type', 'Electric');
        $result = $builder->get()->getRowArray();

        if ($result) {
            $result['vehicle_name'] = trim($result['make'] . ' ' . $result['model'] . ' ' . ($result['variant'] ?? ''));
            $result['brand_name'] = $result['make'];
        }

        return $result;
    }

    /**
     * Get EV by slug (updated to use your schema)
     */
    public function getEVBySlug($slug)
    {
        $builder = $this->db->table('vehicles');
        $builder->where('slug', $slug);
        $builder->where('fuel_type', 'Electric');
        $result = $builder->get()->getRowArray();

        if ($result) {
            $result['vehicle_name'] = trim($result['make'] . ' ' . $result['model'] . ' ' . ($result['variant'] ?? ''));
            $result['brand_name'] = $result['make'];
        }

        return $result;
    }

    /**
     * Get all EVs for comparison (basic info)
     */
    public function getAllEVsForComparison()
    {
        $builder = $this->db->table('vehicles v');
        $builder->select('
        v.vehicle_id,
        v.make,
        v.model,
        v.variant,
        v.year,
        v.body_type,
        v.image_url,
        v.slug,
        e.range_km,
        e.battery_capacity_kwh,
        e.acceleration_0_100,
        e.real_world_range,
        p.ex_showroom_price,
        p.currency
    ');

        $builder->join('ev_features e', 'e.vehicle_id = v.vehicle_id', 'left');
        $builder->join('pricing p', 'p.vehicle_id = v.vehicle_id', 'left');
        $builder->where('v.fuel_type', 'Electric');
        $builder->orderBy('v.make', 'ASC');
        $builder->orderBy('v.model', 'ASC');

        $results = $builder->get()->getResultArray();

        // Format vehicle names
        foreach ($results as &$result) {
            $result['vehicle_name'] = trim($result['make'] . ' ' . $result['model'] . ' ' . ($result['variant'] ?? ''));
            $result['brand_name'] = $result['make'];
        }

        return $results;
    }

    /**
 * Get related EVs based on current vehicle
 */
public function getRelatedEVs($currentVehicleId, $make, $fuelType, $limit = 4)
{
    $builder = $this->db->table('vehicles v');
    $builder->select('v.*, e.range_km, e.battery_capacity_kwh, e.acceleration_0_100, e.real_world_range, e.efficiency_wh_km');
    $builder->join('ev_features e', 'e.vehicle_id = v.vehicle_id', 'left');
    $builder->where('v.vehicle_id !=', $currentVehicleId);
    $builder->where('v.fuel_type', 'Electric');
    
    // Get related by same make or similar body type
    $currentVehicle = $this->find($currentVehicleId);
    $bodyType = $currentVehicle['body_type'] ?? 'SUV';
    
    $builder->groupStart()
        ->where('v.make', $make)
        ->orWhere('v.body_type', $bodyType)
    ->groupEnd();
    
    $builder->limit($limit);
    $builder->orderBy('e.range_km', 'DESC');
    
    $results = $builder->get()->getResultArray();
    
    // Format each related vehicle
    foreach ($results as &$result) {
        $result = $this->formatEVSpecs($result);
    }
    
    return $results;
}

}

