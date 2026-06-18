<?php

namespace App\Controllers;

use App\Models\VehicleModel;
use App\Models\PricingModel;
use App\Models\CarContentModel;
use CodeIgniter\Controller;

class CarsController extends Controller
{
    protected $vehicleModel;
    protected $pricingModel;
    protected $carContentModel;

    public function __construct()
    {
        $this->vehicleModel = new VehicleModel();
        $this->pricingModel = new PricingModel();
        $this->carContentModel = new CarContentModel();
        // Disable DebugBar for AJAX requests
        // if ($this->request->isAJAX()) {
        //     if (function_exists('debug_bar')) {
        //         debug_bar()->setCollectors([]);
        //     }
        // }
    }
    /**
     * Display cars list with sorting, filtering, and pagination
     */
    public function index($sort = null, $category = null)
    {
        // Get filter parameters from request
        $fuelType = $this->request->getGet('fuel');
        $bodyType = $this->request->getGet('body');
        $search = $this->request->getGet('search');
        $page = (int) $this->request->getGet('page') ?: 1;
        $perPage = 12;
        $offset = ($page - 1) * $perPage;

        // Use stored procedure for better performance
        $result = $this->vehicleModel->getCarsListWithFilters($perPage, $offset, $sort, $fuelType, $bodyType, $search);

        $carsList = $result['cars'] ?? [];
        $totalCars = $result['total'] ?? 0;

        // Parse dimensions for each car
        foreach ($carsList as &$car) {
            $car = $this->formatVehicleDimensions($car);
        }

        $data = [
            'page_title' => 'Cars List',
            'cars' => $carsList,
            'stats' => ['total_cars' => $totalCars],
            'current_sort' => $sort,
            'current_category' => $category,
            'current_fuel' => $fuelType,
            'current_body' => $bodyType,
            'current_search' => $search,
            'current_page' => $page,
            'per_page' => $perPage,
            'total_pages' => ceil($totalCars / $perPage),
            'categories' => $this->vehicleModel->getCategories(),
            'fuel_types' => $this->vehicleModel->getFuelTypes(),
            'body_types' => $this->vehicleModel->getBodyTypes()
        ];

        $content = view('pages/cars/list', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'All Cars - Find Your Perfect Car',
                'description' => 'Explore complete list of cars with prices, specs and features',
                'keywords' => 'cars, vehicles, price, specs, new cars'
            ],
            'content' => $content
        ]);
    }

    /**
     * Get car details by ID (legacy method)
     */
    public function detail($vehicleId = 0)
    {
        if (!$vehicleId || !is_numeric($vehicleId)) {
            return redirect()->to('/cars')->with('error', 'Invalid car ID');
        }

        $result = $this->vehicleModel->getCompleteCarDetailById($vehicleId);

        if (!$result) {
            return redirect()->to('/cars')->with('error', 'Car not found');
        }

        // Parse all JSON fields including dimensions
        $result = $this->parseVehicleJsonFields($result);
        $result = $this->formatVehicleDimensions($result);

        $data = [
            'page_title' => esc($result['make'] . ' ' . $result['model'] . ' ' . ($result['variant'] ?? '') . ' - Details'),
            'vehicle' => $result,
            'pricing' => [
                'ex_showroom_price' => $result['ex_showroom_price'] ?? 0,
                'on_road_price' => $result['on_road_price'] ?? 0,
                'currency' => $result['currency'] ?? 'INR',
                'emi_available' => $result['emi_available'] ?? 0,
                'emi_amount' => $result['emi_amount'] ?? 0,
                'down_payment' => $result['down_payment'] ?? 0,
                'insurance_cost' => $result['insurance_cost'] ?? 0,
                'road_tax' => $result['road_tax'] ?? 0,
                'discount_offers' => $result['discount_offers'] ?? [],
                'price_validity' => $result['price_validity'] ?? null
            ],
            'car_content' => [
                'overview' => $result['overview'] ?? null,
                'pros' => $result['pros'] ?? [],
                'cons' => $result['cons'] ?? [],
                'competitors' => $result['competitors'] ?? []
            ]
        ];

        $content = view('pages/cars/detail', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => esc($result['make'] . ' ' . $result['model'] . ' ' . ($result['variant'] ?? '') . ' - Price, Specs & Features'),
                'description' => $result['make'] . ' ' . $result['model'] . ($result['variant'] ? ' ' . $result['variant'] : '') .
                    ' price starts at ₹' . number_format($result['ex_showroom_price'] ?? 0, 0, '.', ',') .
                    '. Check mileage, features, images and more.',
                'keywords' => $result['make'] . ' ' . $result['model'] . ', ' . ($result['variant'] ?? '') .
                    ', price, specs, mileage, features, review, ' . ($result['fuel_type'] ?? '')
            ],
            'content' => $content
        ]);
    }

    /**
     * Get car details by slug (SEO-friendly URL) - MAIN METHOD
     */
    public function details($slug = '')
    {
        if (!$slug) {
            return redirect()->to('/cars')->with('error', 'Invalid car URL');
        }

        $result = $this->vehicleModel->getCompleteCarDetailBySlug($slug);

        if (!$result) {
            return redirect()->to('/cars')->with('error', 'Car not found');
        }

        // Parse all JSON fields including dimensions
        $result = $this->parseVehicleJsonFields($result);
        $result = $this->formatVehicleDimensions($result);

        // Get related cars for recommendations
        $relatedCars = $this->vehicleModel->getRelatedCars($result['vehicle_id'], 4);
        foreach ($relatedCars as &$related) {
            $related = $this->formatVehicleDimensions($related);
        }

        $data = [
            'page_title' => esc($result['make'] . ' ' . $result['model'] . ' ' . ($result['variant'] ?? '') . ' - Details'),
            'vehicle' => $result,
            'pricing' => [
                'ex_showroom_price' => $result['ex_showroom_price'] ?? 0,
                'on_road_price' => $result['on_road_price'] ?? 0,
                'currency' => $result['currency'] ?? 'INR',
                'emi_available' => $result['emi_available'] ?? 0,
                'emi_amount' => $result['emi_amount'] ?? 0,
                'down_payment' => $result['down_payment'] ?? 0,
                'insurance_cost' => $result['insurance_cost'] ?? 0,
                'road_tax' => $result['road_tax'] ?? 0,
                'discount_offers' => $result['discount_offers'] ?? [],
                'price_validity' => $result['price_validity'] ?? null
            ],
            'car_content' => [
                'overview' => $result['overview'] ?? null,
                'pros' => $result['pros'] ?? [],
                'cons' => $result['cons'] ?? [],
                'competitors' => $result['competitors'] ?? []
            ],
            'related_cars' => $relatedCars,
            'schema_markup' => $this->generateSchemaMarkup($result)
        ];

        $content = view('pages/cars/detail', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => esc($result['make'] . ' ' . $result['model'] . ' ' . ($result['variant'] ?? '') . ' - Price, Specs & Features'),
                'description' => strip_tags(substr($result['overview'] ?? $result['make'] . ' ' . $result['model'], 0, 160)),
                'keywords' => $result['make'] . ' ' . $result['model'] . ', ' . ($result['variant'] ?? '') .
                    ', price, specs, mileage, features, review, ' . ($result['fuel_type'] ?? ''),
                'canonical_url' => current_url()
            ],
            'content' => $content
        ]);
    }

    /**
     * Load more cars for infinite scroll
     */
    /**
     * Load more cars for infinite scroll
     */
    public function loadMore()
    {
        // Disable DebugBar
        if (function_exists('debug_bar')) {
            debug_bar()->setCollectors([]);
        }

        // Clear output buffers
        while (ob_get_level()) {
            ob_end_clean();
        }

        // Set JSON headers
        $this->response->setHeader('Content-Type', 'application/json');
        $this->response->setHeader('Cache-Control', 'no-store');

        try {
            $perPage = (int) $this->request->getGet('limit') ?: 8;
            $page = (int) $this->request->getGet('page') ?: 1;
            $sort = $this->request->getGet('sort') ?? '';
            $fuel = $this->request->getGet('fuel');
            $body = $this->request->getGet('body');
            $search = $this->request->getGet('search');
            $offset = ($page - 1) * $perPage;

            // Use direct database query
            $db = \Config\Database::connect();

            // Build the query
            $sql = "SELECT v.vehicle_id, v.make, v.model, v.variant, v.slug, v.body_type, v.fuel_type, 
                       v.transmission, v.mileage_kmpl, v.seating_capacity, v.ncap_rating, v.image_url, 
                       COALESCE(p.ex_showroom_price, 0) as ex_showroom_price
                FROM vehicles v
                LEFT JOIN pricing p ON v.vehicle_id = p.vehicle_id
                WHERE 1=1";

            $params = [];

            if (!empty($fuel) && $fuel !== '') {
                $sql .= " AND v.fuel_type = ?";
                $params[] = $fuel;
            }
            if (!empty($body) && $body !== '') {
                $sql .= " AND v.body_type = ?";
                $params[] = $body;
            }
            if (!empty($search) && $search !== '') {
                $sql .= " AND (v.make LIKE ? OR v.model LIKE ? OR v.variant LIKE ?)";
                $searchParam = "%{$search}%";
                $params[] = $searchParam;
                $params[] = $searchParam;
                $params[] = $searchParam;
            }

            // Count total
            $countSql = str_replace("SELECT v.vehicle_id, v.make, v.model, v.variant, v.slug, v.body_type, v.fuel_type, 
                       v.transmission, v.mileage_kmpl, v.seating_capacity, v.ncap_rating, v.image_url, 
                       COALESCE(p.ex_showroom_price, 0) as ex_showroom_price", "SELECT COUNT(*) as total", $sql);

            $countQuery = $db->query($countSql, $params);
            $total = $countQuery->getRow()->total ?? 0;

            // Apply sorting
            if ($sort === 'price-low') {
                $sql .= " ORDER BY COALESCE(p.ex_showroom_price, 0) ASC";
            } elseif ($sort === 'price-high') {
                $sql .= " ORDER BY COALESCE(p.ex_showroom_price, 0) DESC";
            } elseif ($sort === 'mileage') {
                $sql .= " ORDER BY v.mileage_kmpl DESC";
            } else {
                $sql .= " ORDER BY v.make ASC, v.model ASC";
            }

            // Add pagination
            $sql .= " LIMIT ? OFFSET ?";
            $params[] = $perPage;
            $params[] = $offset;

            $query = $db->query($sql, $params);
            $cars = $query->getResultArray();

            $hasMore = ($page * $perPage) < $total;

            return $this->response->setJSON([
                'success' => true,
                'cars' => $cars,
                'hasMore' => $hasMore,
                'total' => $total,
                'currentPage' => $page
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Load more error: ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage(),
                'cars' => [],
                'hasMore' => false,
                'total' => 0
            ]);
        }
    }
    /**
     * Compare multiple cars
     */
    public function compare($ids = null)
    {
        if (!$ids) {
            $ids = $this->request->getGet('ids');
        }

        if (!$ids) {
            return redirect()->to('/cars/compare-home')->with('error', 'No cars selected for comparison');
        }

        $ids = str_replace(['/', '-'], ',', $ids);
        $vehicleIds = array_filter(explode(',', $ids));

        if (count($vehicleIds) < 2) {
            return redirect()->to('/cars/compare-home')->with('error', 'Select at least two cars to compare');
        }

        $vehicles = $this->vehicleModel->getCarsForComparison(implode(',', $vehicleIds));

        if (count($vehicles) < 2) {
            return redirect()->to('/cars/compare-home')->with('error', 'Selected cars not found');
        }

        // Parse JSON fields and format dimensions for each vehicle
        foreach ($vehicles as &$vehicle) {
            $vehicle = $this->parseVehicleJsonFields($vehicle);
            $vehicle = $this->formatVehicleDimensions($vehicle);
        }

        $data = [
            'page_title' => 'Compare Cars',
            'vehicles' => $vehicles,
            'compare_ids' => $vehicleIds
        ];

        $content = view('pages/cars/compare', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'Car Comparison - Compare specs, features, and pricing',
                'description' => 'Compare specifications, features, pricing, and more between selected cars',
                'keywords' => 'car comparison, specs, features, price, side by side'
            ],
            'content' => $content
        ]);
    }

    /**
     * Compare home page
     */
    public function compareHome()
    {
        $popularCars = $this->vehicleModel->getFeaturedCars(12);
        foreach ($popularCars as &$car) {
            $car = $this->formatVehicleDimensions($car);
        }

        $data = [
            'page_title' => 'Compare Cars - Select Vehicles',
            'popular_cars' => $popularCars
        ];

        $content = view('pages/cars/compareHome', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'Car Comparison - Select Cars to Compare',
                'description' => 'Select two or more cars to compare their specifications, features, and pricing',
                'keywords' => 'car comparison, select cars, compare specs'
            ],
            'content' => $content
        ]);
    }

    /**
     * AJAX search for cars
     */
    public function search()
    {
        $this->response->setHeader('Content-Type', 'application/json');

        if (function_exists('debug_bar')) {
            debug_bar()->setCollectors([]);
        }

        $query = $this->request->getGet('q');

        if (!$query || strlen($query) < 2) {
            return $this->response->setJSON([]);
        }

        $results = $this->vehicleModel->searchCarsWithContent($query, 10);

        return $this->response->setJSON($results);
    }

    /**
     * Get filter options for AJAX filtering
     */
    public function getFilterOptions()
    {
        $this->response->setHeader('Content-Type', 'application/json');

        $options = $this->vehicleModel->getFilterOptionsWithCounts();

        return $this->response->setJSON($options);
    }

    /**
     * Get featured cars for homepage
     */
    public function getFeaturedCars()
    {
        $this->response->setHeader('Content-Type', 'application/json');

        $limit = (int) $this->request->getGet('limit') ?: 6;
        $cars = $this->vehicleModel->getFeaturedCars($limit);

        foreach ($cars as &$car) {
            $car = $this->parseVehicleJsonFields($car);
            $car = $this->formatVehicleDimensions($car);
        }

        return $this->response->setJSON($cars);
    }

    /**
     * Format vehicle dimensions for display
     * Converts mm to feet and creates readable strings
     */
    private function formatVehicleDimensions($vehicle)
    {
        if (empty($vehicle)) {
            return $vehicle;
        }

        $convertToFeet = function ($mm) {
            if (!$mm || $mm == 'N/A')
                return null;
            return round((float) $mm / 304.8, 2);
        };

        // Get dimensions from array or JSON string
        $dimensions = [];
        if (isset($vehicle['dimensions'])) {
            if (is_string($vehicle['dimensions'])) {
                $dimensions = json_decode($vehicle['dimensions'], true) ?: [];
            } else {
                $dimensions = $vehicle['dimensions'];
            }
        }

        // Format dimensions_formatted array
        $vehicle['dimensions_formatted'] = [
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
        $suspension = [];
        if (isset($vehicle['suspension'])) {
            if (is_string($vehicle['suspension'])) {
                $suspension = json_decode($vehicle['suspension'], true) ?: [];
            } else {
                $suspension = $vehicle['suspension'];
            }
        }
        $vehicle['suspension_formatted'] = [
            'front' => $suspension['front'] ?? 'N/A',
            'rear' => $suspension['rear'] ?? 'N/A',
        ];

        // Format brakes
        $brakes = [];
        if (isset($vehicle['brakes'])) {
            if (is_string($vehicle['brakes'])) {
                $brakes = json_decode($vehicle['brakes'], true) ?: [];
            } else {
                $brakes = $vehicle['brakes'];
            }
        }
        $vehicle['brakes_formatted'] = [
            'front' => $brakes['front'] ?? 'N/A',
            'rear' => $brakes['rear'] ?? 'N/A',
        ];

        return $vehicle;
    }


    /**
     * Generate Schema.org markup for SEO
     */
    private function generateSchemaMarkup($vehicle)
    {
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Car",
            "name" => trim($vehicle['make'] . ' ' . $vehicle['model'] . ' ' . ($vehicle['variant'] ?? '')),
            "brand" => [
                "@type" => "Brand",
                "name" => $vehicle['make'] ?? ''
            ],
            "model" => $vehicle['model'] ?? '',
            "vehicleModelDate" => $vehicle['year'] ?? date('Y'),
            "bodyType" => $vehicle['body_type'] ?? '',
            "fuelType" => $vehicle['fuel_type'] ?? '',
            "vehicleTransmission" => $vehicle['transmission'] ?? '',
            "image" => $vehicle['image_url'] ?? '',
            "description" => strip_tags(substr($vehicle['overview'] ?? '', 0, 200)),
            "offers" => [
                "@type" => "Offer",
                "priceCurrency" => "INR",
                "price" => (float) ($vehicle['ex_showroom_price'] ?? 0),
                "availability" => "https://schema.org/InStock",
                "url" => current_url()
            ]
        ];

        // Add dimensions to schema if available
        if (!empty($vehicle['dimensions_formatted'])) {
            $schema['vehicleInterior'] = [
                "@type" => "VehicleInterior",
                "seatingCapacity" => $vehicle['seating_capacity'] ?? 'N/A'
            ];
        }

        // Add aggregate rating if available
        if (!empty($vehicle['ncap_rating'])) {
            $schema['aggregateRating'] = [
                "@type" => "AggregateRating",
                "ratingValue" => (float) $vehicle['ncap_rating'],
                "ratingCount" => 1,
                "bestRating" => "5"
            ];
        }

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Parse JSON fields for a vehicle
     */
    private function parseVehicleJsonFields($vehicle)
    {
        if (empty($vehicle))
            return $vehicle;

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
            if (isset($vehicle[$field]) && is_string($vehicle[$field])) {
                $decoded = json_decode($vehicle[$field], true);
                $vehicle[$field] = (json_last_error() === JSON_ERROR_NONE) ? ($decoded ?? []) : [];
            } elseif (!isset($vehicle[$field])) {
                $vehicle[$field] = [];
            }
        }

        return $vehicle;
    }

    /**
     * Format vehicle dimensions for display
     */

}