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



}