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

    /*
    |--------------------------------------------------------------------------
    | JSON Fields
    |--------------------------------------------------------------------------
    */

    protected $jsonFields = [
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

    /*
    |--------------------------------------------------------------------------
    | Decode JSON Helper
    |--------------------------------------------------------------------------
    */

    private function decodeJsonFields(array $data): array
    {
        foreach ($this->jsonFields as $field) {

            if (!isset($data[$field])) {
                $data[$field] = [];
                continue;
            }

            if (is_string($data[$field]) && !empty($data[$field])) {

                $decoded = json_decode($data[$field], true);

                $data[$field] = json_last_error() === JSON_ERROR_NONE
                    ? $decoded
                    : [];

            } elseif (empty($data[$field])) {

                $data[$field] = [];

            }
        }

        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | Cars Listing
    |--------------------------------------------------------------------------
    */

    public function getCarsList($limit = 50)
    {
        $results = $this->select('
            vehicles.*,
            pricing.ex_showroom_price,
            pricing.on_road_price,
            pricing.currency
        ')
            ->join('pricing', 'pricing.vehicle_id = vehicles.vehicle_id', 'left')
            ->orderBy('vehicles.make ASC')
            ->orderBy('vehicles.model ASC')
            ->orderBy('vehicles.variant ASC')
            ->findAll($limit);

        foreach ($results as &$row) {

            // =====================================================
            // ✅ Decode JSON fields
            // =====================================================

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

                if (!empty($row[$field])) {

                    if (is_array($row[$field])) {
                        continue;
                    }

                    $decoded = json_decode($row[$field], true);

                    $row[$field] = json_last_error() === JSON_ERROR_NONE
                        ? $decoded
                        : [];
                } else {

                    $row[$field] = [];
                }
            }

            // =====================================================
            // ✅ FORMAT DIMENSIONS
            // =====================================================

            $convertToFeet = function ($mm) {

                if (!$mm) {
                    return null;
                }

                return round($mm / 304.8, 2);
            };

            if (!empty($row['dimensions'])) {

                $dimensions = $row['dimensions'];

                $row['dimensions_formatted'] = [
                    'length' => isset($dimensions['length_mm'])
                        ? $dimensions['length_mm'] . ' mm (' . $convertToFeet($dimensions['length_mm']) . ' ft)'
                        : 'N/A',

                    'width' => isset($dimensions['width_mm'])
                        ? $dimensions['width_mm'] . ' mm (' . $convertToFeet($dimensions['width_mm']) . ' ft)'
                        : 'N/A',

                    'height' => isset($dimensions['height_mm'])
                        ? $dimensions['height_mm'] . ' mm (' . $convertToFeet($dimensions['height_mm']) . ' ft)'
                        : 'N/A',

                    'wheelbase' => isset($dimensions['wheelbase_mm'])
                        ? $dimensions['wheelbase_mm'] . ' mm (' . $convertToFeet($dimensions['wheelbase_mm']) . ' ft)'
                        : 'N/A',
                ];

            } else {

                $row['dimensions_formatted'] = [
                    'length' => 'N/A',
                    'width' => 'N/A',
                    'height' => 'N/A',
                    'wheelbase' => 'N/A',
                ];
            }

            // =====================================================
            // ✅ FORMAT SUSPENSION
            // =====================================================

            $row['suspension_formatted'] = [
                'front' => $row['suspension']['front'] ?? 'N/A',
                'rear' => $row['suspension']['rear'] ?? 'N/A',
            ];

            // =====================================================
            // ✅ FORMAT BRAKES
            // =====================================================

            $row['brakes_formatted'] = [
                'front' => $row['brakes']['front'] ?? 'N/A',
                'rear' => $row['brakes']['rear'] ?? 'N/A',
            ];

            // =====================================================
            // ✅ FORMAT PRICE
            // =====================================================

            $row['formatted_price'] = !empty($row['ex_showroom_price'])
                ? '₹' . number_format($row['ex_showroom_price'], 0)
                : 'Price Not Available';
        }

        return $results;
    }

    /*
    |--------------------------------------------------------------------------
    | Vehicle Detail
    |--------------------------------------------------------------------------
    */

    public function getVehicleDetail($vehicleId)
    {
        $result = $this->where('vehicle_id', $vehicleId)->first();

        if ($result) {
            $result = $this->decodeJsonFields($result);
        }

        return $result;
    }

    /*
    |--------------------------------------------------------------------------
    | Vehicle Detail With Pricing
    |--------------------------------------------------------------------------
    */

    public function getVehicleWithPricing($vehicleId)
    {
        $builder = $this->select('
        vehicles.*,
        pricing.ex_showroom_price,
        pricing.on_road_price,
        pricing.currency,
        pricing.emi_available,
        pricing.emi_amount,
        pricing.down_payment,
        pricing.insurance_cost,
        pricing.road_tax,
        pricing.discount_offers,
        pricing.price_validity
    ');

        $builder->join('pricing', 'pricing.vehicle_id = vehicles.vehicle_id', 'left');
        $builder->where('vehicles.vehicle_id', $vehicleId);

        $result = $builder->first();

        if ($result) {

            // ✅ ALL JSON FIELDS
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

            // ✅ Decode JSON safely
            foreach ($jsonFields as $field) {

                if (!empty($result[$field])) {

                    // already array
                    if (is_array($result[$field])) {
                        continue;
                    }

                    $decoded = json_decode($result[$field], true);

                    $result[$field] = json_last_error() === JSON_ERROR_NONE
                        ? $decoded
                        : [];
                } else {
                    $result[$field] = [];
                }
            }

            // =====================================================
            // ✅ DIMENSIONS EXTRA FORMATTING
            // =====================================================

            if (!empty($result['dimensions'])) {

                $dimensions = $result['dimensions'];

                $convertToFeet = function ($mm) {

                    if (!$mm) {
                        return null;
                    }

                    $feet = $mm / 304.8;

                    return round($feet, 2);
                };

                $result['dimensions_formatted'] = [
                    'length' => isset($dimensions['length_mm'])
                        ? $dimensions['length_mm'] . ' mm (' . $convertToFeet($dimensions['length_mm']) . ' ft)'
                        : 'N/A',

                    'width' => isset($dimensions['width_mm'])
                        ? $dimensions['width_mm'] . ' mm (' . $convertToFeet($dimensions['width_mm']) . ' ft)'
                        : 'N/A',

                    'height' => isset($dimensions['height_mm'])
                        ? $dimensions['height_mm'] . ' mm (' . $convertToFeet($dimensions['height_mm']) . ' ft)'
                        : 'N/A',

                    'wheelbase' => isset($dimensions['wheelbase_mm'])
                        ? $dimensions['wheelbase_mm'] . ' mm (' . $convertToFeet($dimensions['wheelbase_mm']) . ' ft)'
                        : 'N/A',
                ];
            } else {

                $result['dimensions_formatted'] = [
                    'length' => 'N/A',
                    'width' => 'N/A',
                    'height' => 'N/A',
                    'wheelbase' => 'N/A',
                ];
            }

            // =====================================================
            // ✅ SUSPENSION FORMATTING
            // =====================================================

            if (!empty($result['suspension'])) {

                $result['suspension_formatted'] = [
                    'front' => $result['suspension']['front'] ?? 'N/A',
                    'rear' => $result['suspension']['rear'] ?? 'N/A',
                ];
            } else {

                $result['suspension_formatted'] = [
                    'front' => 'N/A',
                    'rear' => 'N/A',
                ];
            }

            // =====================================================
            // ✅ BRAKES FORMATTING
            // =====================================================

            if (!empty($result['brakes'])) {

                $result['brakes_formatted'] = [
                    'front' => $result['brakes']['front'] ?? 'N/A',
                    'rear' => $result['brakes']['rear'] ?? 'N/A',
                ];
            } else {

                $result['brakes_formatted'] = [
                    'front' => 'N/A',
                    'rear' => 'N/A',
                ];
            }

            // =====================================================
            // ✅ PRICING ARRAY
            // =====================================================

            $result['pricing'] = [
                'ex_showroom_price' => $result['ex_showroom_price'] ?? 0,
                'on_road_price' => $result['on_road_price'] ?? 0,
                'currency' => $result['currency'] ?? 'INR',
                'emi_available' => $result['emi_available'] ?? 0,
                'emi_amount' => $result['emi_amount'] ?? 0,
                'down_payment' => $result['down_payment'] ?? 0,
                'insurance_cost' => $result['insurance_cost'] ?? 0,
                'road_tax' => $result['road_tax'] ?? 0,
                'discount_offers' => !empty($result['discount_offers'])
                    ? json_decode($result['discount_offers'], true)
                    : [],
                'price_validity' => $result['price_validity'] ?? null
            ];

            // =====================================================
            // ✅ REMOVE RAW PRICING FIELDS
            // =====================================================

            unset(
                $result['ex_showroom_price'],
                $result['on_road_price'],
                $result['currency'],
                $result['emi_available'],
                $result['emi_amount'],
                $result['down_payment'],
                $result['insurance_cost'],
                $result['road_tax'],
                $result['discount_offers'],
                $result['price_validity']
            );
        }

        return $result;
    }

    /*
    |--------------------------------------------------------------------------
    | Get Cars By Make
    |--------------------------------------------------------------------------
    */

    public function getCarsByMake($make, $limit = 20)
    {
        $results = $this->select('
                vehicles.*,
                pricing.ex_showroom_price
            ')
            ->join('pricing', 'pricing.vehicle_id = vehicles.vehicle_id', 'left')
            ->where('vehicles.make', $make)
            ->orderBy('vehicles.model')
            ->findAll($limit);

        foreach ($results as &$row) {
            $row = $this->decodeJsonFields($row);
        }

        return $results;
    }

    /*
    |--------------------------------------------------------------------------
    | Search Cars
    |--------------------------------------------------------------------------
    */

    public function searchCars($searchTerm)
    {
        $results = $this->select('
                vehicles.*,
                pricing.ex_showroom_price
            ')
            ->join('pricing', 'pricing.vehicle_id = vehicles.vehicle_id', 'left')
            ->groupStart()
            ->like('make', $searchTerm)
            ->orLike('model', $searchTerm)
            ->orLike('variant', $searchTerm)
            ->groupEnd()
            ->orderBy('make')
            ->findAll(20);

        foreach ($results as &$row) {
            $row = $this->decodeJsonFields($row);
        }

        return $results;
    }

    /*
    |--------------------------------------------------------------------------
    | Sort By Price
    |--------------------------------------------------------------------------
    */

    public function getCarsByPrice($sort = 'asc', $limit = 50)
    {
        $order = strtolower($sort) === 'desc' ? 'DESC' : 'ASC';

        $results = $this->select('
                vehicles.*,
                pricing.ex_showroom_price,
                pricing.on_road_price
            ')
            ->join('pricing', 'pricing.vehicle_id = vehicles.vehicle_id', 'left')
            ->orderBy('COALESCE(pricing.ex_showroom_price, 0)', $order)
            ->findAll($limit);

        foreach ($results as &$row) {
            $row = $this->decodeJsonFields($row);
        }

        return $results;
    }

    /*
    |--------------------------------------------------------------------------
    | Get Cars By Category
    |--------------------------------------------------------------------------
    */

    public function getCarsByCategory($category = null, $limit = 20)
    {
        $builder = $this->select('
                vehicles.*,
                pricing.ex_showroom_price
            ')
            ->join('pricing', 'pricing.vehicle_id = vehicles.vehicle_id', 'left');

        if (!empty($category)) {
            $builder->where('vehicles.body_type', $category);
        }

        $results = $builder
            ->orderBy('vehicles.make')
            ->orderBy('vehicles.model')
            ->findAll($limit);

        foreach ($results as &$row) {
            $row = $this->decodeJsonFields($row);
        }

        return $results;
    }

    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */

    public function getCategories()
    {
        $results = $this->select('body_type')
            ->where('body_type IS NOT NULL')
            ->where('body_type !=', '')
            ->groupBy('body_type')
            ->findAll();

        return array_column($results, 'body_type');
    }

    /*
|--------------------------------------------------------------------------
| Features Page Helpers
|--------------------------------------------------------------------------
*/

    public function getVehiclesWithFeatures()
    {
        $results = $this->select('
            vehicles.*,
            pricing.ex_showroom_price,
            pricing.on_road_price,
            pricing.currency
        ')
            ->join('pricing', 'pricing.vehicle_id = vehicles.vehicle_id', 'left')
            ->orderBy('vehicles.make ASC')
            ->findAll();

        foreach ($results as &$row) {
            $row = $this->decodeJsonFields($row);
        }

        return $results;
    }

    public function getVehiclesByFeatureCategory($category)
    {
        $column = strtolower($category) . '_features';

        // Handle specific naming exceptions
        if ($category === 'Camera')
            $column = 'camera_features';
        if ($category === 'Comfort')
            $column = 'comfort_features';
        if ($category === 'Infotainment')
            $column = 'infotainment';

        $builder = $this->select('
            vehicles.*,
            pricing.ex_showroom_price,
            pricing.on_road_price,
            pricing.currency
        ')
            ->join('pricing', 'pricing.vehicle_id = vehicles.vehicle_id', 'left');

        // Only fetch vehicles where this feature column exists/is not empty
        $builder->where($column . ' !=', '');
        $builder->where($column . ' IS NOT NULL');

        $results = $builder->orderBy('vehicles.make ASC')->findAll();

        foreach ($results as &$row) {
            $row = $this->decodeJsonFields($row);
        }

        return $results;
    }

}