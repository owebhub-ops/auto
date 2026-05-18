<?php

namespace App\Controllers;

use App\Models\VehicleModel;
use App\Models\PricingModel;
use CodeIgniter\Controller;

class CarsController extends Controller
{
    protected $vehicleModel;
    protected $pricingModel;

    public function __construct()
    {
        $this->vehicleModel = new VehicleModel();
        $this->pricingModel = new PricingModel();
    }

    public function index($sort = null, $category = null)
    {
        $carsList = [];

        if ($sort === 'price-low' || $sort === 'price-high') {
            $carsList = $this->vehicleModel->getCarsByPrice($sort === 'price-low' ? 'asc' : 'desc');
        } elseif ($category && in_array($category, ['Sedan', 'SUV', 'Hatchback', 'MPV'])) {
            $carsList = $this->vehicleModel->getCarsByCategory($category);
        } else {
            $carsList = $this->vehicleModel->getCarsList();
        }

        $data = [
            'page_title' => 'Cars List',
            'cars' => $carsList,
            'stats' => ['total_cars' => count($carsList)],
            'current_sort' => $sort,
            'current_category' => $category,
            'categories' => $this->vehicleModel->getCategories()
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

    public function detail($vehicleId = 0)
    {
        // Validate vehicle ID
        if (!$vehicleId || !is_numeric($vehicleId)) {
            return redirect()->to('/cars')->with('error', 'Invalid car ID');
        }

        // ✅ Fetch vehicle details with pricing - OPTIMIZED SINGLE CALL
        $vehicle = $this->vehicleModel->getVehicleWithPricing($vehicleId);

        if (!$vehicle) {
            return redirect()->to('/cars')->with('error', 'Car not found');
        }

        // ✅ Extract pricing data safely
        $pricing = $vehicle['pricing'] ?? [];
        unset($vehicle['pricing']); // Clean up for view

        $data = [
            'page_title' => esc($vehicle['make'] . ' ' . $vehicle['model'] . ' ' . ($vehicle['variant'] ?? '') . ' - Details'),
            'vehicle' => $vehicle,
            'pricing' => $pricing
        ];

        $content = view('pages/cars/detail', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => esc($vehicle['make'] . ' ' . $vehicle['model'] . ' ' . ($vehicle['variant'] ?? '') . ' - Price, Specs & Features'),
                'description' => $vehicle['make'] . ' ' . $vehicle['model'] . ($vehicle['variant'] ? ' ' . $vehicle['variant'] : '') .
                    ' price starts at ₹' . number_format($pricing['ex_showroom_price'] ?? 0, 0, '.', ',') .
                    '. Check mileage, features, images and more.',
                'keywords' => $vehicle['make'] . ' ' . $vehicle['model'] . ', ' . ($vehicle['variant'] ?? '') .
                    ', price, specs, mileage, features, review, ' . $vehicle['fuel_type']
            ],
            'content' => $content
        ]);
    }

    public function loadMore()
    {
        $perPage = 50;
        $page = $this->request->getGet('page')['cars'] ?? 1;

        $vehicles = $this->vehicleModel
            ->select('vehicles.vehicle_id, vehicles.make, vehicles.model')
            ->orderBy('vehicles.created_at', 'DESC')
            ->paginate($perPage, 'cars', $page);

        $pager = $this->vehicleModel->pager;

        return $this->response->setJSON([
            'cars' => $vehicles,
            'hasMore' => $page < $pager->getPageCount('cars'),
        ]);
    }


    public function compare($ids = null)
    {
        // If no path param, check query string
        if (!$ids) {
            $ids = $this->request->getGet('ids'); // handles ?ids=74,76,72
        }
    
        if (!$ids) {
            return redirect()->to('/cars/compareHome')->with('error', 'No cars selected for comparison');
        }
    
        // Normalize: convert slashes to commas
        $ids = str_replace('/', ',', $ids);
    
        // Split into array and filter out empties
        $vehicleIds = array_filter(explode(',', $ids));
    
        $vehicles = [];
        foreach ($vehicleIds as $id) {
            if (is_numeric($id)) {
                $vehicle = $this->vehicleModel->getVehicleWithPricing($id);
                if ($vehicle) {
                    // Ensure pricing is always present
                    $vehicle['pricing'] = $vehicle['pricing'] ?? [];
                    $vehicles[] = $vehicle;
                }
            }
        }
    
        if (count($vehicles) < 2) {
            return redirect()->to('/cars/compareHome')->with('error', 'Select at least two cars to compare');
        }
    
        $data = [
            'page_title' => 'Compare Cars',
            'vehicles'   => $vehicles
        ];
        
        
        $content = view('pages/cars/compare', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title'       => 'Car Comparison',
                'description' => 'Compare specs, features, and pricing of selected cars',
                'keywords'    => 'car comparison, specs, features, price'
            ],
            'content' => $content
        ]);
    }
    

    public function compareHome()
    {
        $data = [
            'page_title' => 'Compare Cars',
            'vehicles' => [] // empty list for initial page
        ];

        $content = view('pages/cars/compareHome', $data);
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'Car Comparison',
                'description' => 'Compare specs, features, and pricing of selected cars',
                'keywords' => 'car comparison, specs, features, price'
            ],
            'content' => $content
        ]);
    }

    public function search()
    {
        $query = $this->request->getGet('q');
        if (!$query) {
            return $this->response->setJSON([]);
        }

        // Build query properly with grouping
        $builder = $this->vehicleModel
            ->select('vehicle_id, make, model, variant')
            ->groupStart()
            ->like('make', $query)
            ->orLike('model', $query)
            ->groupEnd();

        $results = $builder->findAll(10);

        return $this->response->setJSON($results);
    }


}