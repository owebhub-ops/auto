<?php

namespace App\Controllers;

use App\Models\VehicleModel;
use App\Models\PricingModel;
use CodeIgniter\Controller;

class FeaturesController extends Controller
{
    protected $vehicleModel;
    protected $pricingModel;

    public function __construct()
    {
        $this->vehicleModel = new VehicleModel();
        $this->pricingModel = new PricingModel();
    }

    public function index($category = null)
    {
        $vehicles = [];

        if ($category && in_array($category, ['Safety', 'Infotainment', 'Comfort', 'Interior', 'Exterior', 'Camera'])) {
            $vehicles = $this->vehicleModel->getVehiclesByFeatureCategory($category);
        } else {
            $vehicles = $this->vehicleModel->getVehiclesWithFeatures();
        }

        $data = [
            'page_title' => 'Car Features',
            'vehicles' => $vehicles,
            'current_category' => $category,
            'categories' => ['Safety', 'Infotainment', 'Comfort', 'Interior', 'Exterior', 'Camera'],
            'stats' => ['total_vehicles' => count($vehicles)]
        ];

        $content = view('pages/features/list', $data);

        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => 'Car Features - Explore Vehicle Features',
                'description' => 'Explore safety, infotainment, comfort, interior, exterior and camera features of cars.',
                'keywords' => 'car features, safety features, infotainment, comfort, interior, exterior, camera'
            ],
            'content' => $content
        ]);
    }

    public function detail($vehicleId = 0)
    {
        if (!$vehicleId || !is_numeric($vehicleId)) {
            return redirect()->to('/features')->with('error', 'Invalid vehicle ID');
        }

        $vehicle = $this->vehicleModel->getVehicleWithPricing($vehicleId);

        if (!$vehicle) {
            return redirect()->to('/features')->with('error', 'Vehicle not found');
        }

        $pricing = $vehicle['pricing'] ?? [];
        unset($vehicle['pricing']);

        $data = [
            'page_title' => esc($vehicle['make'] . ' ' . $vehicle['model'] . ' Features'),
            'vehicle' => $vehicle,
            'pricing' => $pricing
        ];

        $content = view('pages/features/detail', $data);

        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => esc($vehicle['make'] . ' ' . $vehicle['model'] . ' Features'),
                'description' => $vehicle['make'] . ' ' . $vehicle['model'] . ' feature details, safety, comfort, infotainment and more.',
                'keywords' => $vehicle['make'] . ', ' . $vehicle['model'] . ', features, safety, infotainment, comfort'
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

        $builder = $this->vehicleModel
            ->select('vehicle_id, make, model, variant')
            ->groupStart()
            ->like('make', $query)
            ->orLike('model', $query)
            ->orLike('variant', $query)
            ->groupEnd();

        $results = $builder->findAll(10);

        return $this->response->setJSON($results);
    }

    public function loadMore()
    {
        $perPage = 20;
        $page = $this->request->getGet('page')['features'] ?? 1;

        $vehicles = $this->vehicleModel
            ->select('vehicle_id, make, model, variant, image_url')
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage, 'features', $page);

        $pager = $this->vehicleModel->pager;

        return $this->response->setJSON([
            'vehicles' => $vehicles,
            'hasMore' => $page < $pager->getPageCount('features'),
        ]);
    }
}
