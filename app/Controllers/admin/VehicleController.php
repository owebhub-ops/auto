<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\admin\VehicleModel;
use App\Models\admin\PricingModel;

class VehicleController extends BaseController
{
    protected $vehicleModel;
    protected $pricingModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->vehicleModel = new VehicleModel();
        $this->pricingModel = new PricingModel();
    }

    public function index()
    {
        $vehicles = $this->vehicleModel
            ->select('vehicles.*, pricing.ex_showroom_price, pricing.currency')
            ->join('pricing', 'pricing.vehicle_id = vehicles.vehicle_id', 'left')
            ->orderBy('vehicles.created_at', 'DESC')
            ->paginate(10, 'vehicles');

        $pageData = [
            'vehicles' => $vehicles,
            'pager' => $this->vehicleModel->pager,
        ];

        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => view('pages/admin/vehicle/index', $pageData),
        ]);
    }

    public function show($vehicleId)
    {
        $vehicle = $this->vehicleModel
            ->select('vehicles.*, pricing.*')
            ->join('pricing', 'pricing.vehicle_id = vehicles.vehicle_id', 'left')
            ->find($vehicleId);

        if (!$vehicle) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Vehicle not found');
        }

        $pageData = [
            'vehicle' => $vehicle,
            'pricing' => $this->pricingModel->where('vehicle_id', $vehicleId)->first()
        ];

        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => view('pages/admin/vehicle/show', $pageData),
        ]);
    }

    public function create()
    {
        return view('templates/admin/layout_admin', [
            'content' => view('pages/admin/vehicle/create'),
        ]);
    }

    public function store()
    {
        $validation = $this->validate([
            'make' => 'required|max_length[100]',
            'model' => 'required|max_length[100]',
            'year' => 'required|integer',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $vehicleId = $this->vehicleModel->insert([
            'make' => $this->request->getPost('make'),
            'model' => $this->request->getPost('model'),
            'variant' => $this->request->getPost('variant'),
            'year' => $this->request->getPost('year'),
            'fuel_type' => $this->request->getPost('fuel_type'),
            'image_url' => $this->request->getPost('image_url'),
            'brochure_url' => $this->request->getPost('brochure_url'),
            'suspension' => $this->request->getPost('suspension'),
            'brakes' => $this->request->getPost('brakes'),
            'safety_features' => $this->request->getPost('safety_features'),
            'infotainment' => $this->request->getPost('infotainment'),
            'comfort_features' => $this->request->getPost('comfort_features'),
            'interior_features' => $this->request->getPost('interior_features'),
            'exterior_features' => $this->request->getPost('exterior_features'),
            'color_options' => $this->request->getPost('color_options'),
            'warranty' => $this->request->getPost('warranty'),
        ]);

        if ($this->request->getPost('ex_showroom_price')) {
            $this->pricingModel->insert([
                'vehicle_id' => $vehicleId,
                'ex_showroom_price' => $this->request->getPost('ex_showroom_price'),
                'on_road_price' => $this->request->getPost('on_road_price'),
                'emi_available' => $this->request->getPost('emi_available'),
                'emi_amount' => $this->request->getPost('emi_amount'),
                'down_payment' => $this->request->getPost('down_payment'),
                'insurance_cost' => $this->request->getPost('insurance_cost'),
                'road_tax' => $this->request->getPost('road_tax'),
                'discount_offers' => $this->request->getPost('discount_offers'),
                'price_validity' => $this->request->getPost('price_validity'),
                'currency' => $this->request->getPost('currency') ?: 'INR',
            ]);
        }

        return redirect()->to(site_url("admin/vehicle"))
            ->with('success', 'Vehicle created successfully.');
    }

    public function generateSlug($vehicle)
    {
        return strtolower(
            url_title(
                $vehicle['make'] . '-' .
                $vehicle['model'] . '-' .
                ($vehicle['variant'] ?? '') . '-' .
                $vehicle['fuel_type'] . '-' .
                $vehicle['transmission'],
                '-',
                true
            )
        );
    }


    public function edit($vehicleId)
    {
        $vehicle = $this->vehicleModel->find($vehicleId);
        if (!$vehicle) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Vehicle not found');
        }

        $pricing = $this->pricingModel->where('vehicle_id', $vehicleId)->first();

        $pageData = [
            'vehicle' => $vehicle,
            'pricing' => $pricing ?? []
        ];

        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => view('pages/admin/vehicle/edit', $pageData),
        ]);
    }

    public function update($vehicleId)
    {
        $vehicle = $this->vehicleModel->find($vehicleId);
        if (!$vehicle) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Vehicle not found');
        }

        $validation = $this->validate([
            'make' => 'required|max_length[100]',
            'model' => 'required|max_length[100]',
            'year' => 'required|integer',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->vehicleModel->update($vehicleId, [
            'make' => $this->request->getPost('make'),
            'model' => $this->request->getPost('model'),
            'variant' => $this->request->getPost('variant'),
            'year' => $this->request->getPost('year'),
            'fuel_type' => $this->request->getPost('fuel_type'),
            'image_url' => $this->request->getPost('image_url'),
            'brochure_url' => $this->request->getPost('brochure_url'),
            'suspension' => $this->request->getPost('suspension'),
            'brakes' => $this->request->getPost('brakes'),
            'safety_features' => $this->request->getPost('safety_features'),
            'infotainment' => $this->request->getPost('infotainment'),
            'comfort_features' => $this->request->getPost('comfort_features'),
            'interior_features' => $this->request->getPost('interior_features'),
            'exterior_features' => $this->request->getPost('exterior_features'),
            'color_options' => $this->request->getPost('color_options'),
            'warranty' => $this->request->getPost('warranty'),
        ]);

        $pricing = $this->pricingModel->where('vehicle_id', $vehicleId)->first();
        $pricingData = [
            'vehicle_id' => $vehicleId,
            'ex_showroom_price' => $this->request->getPost('ex_showroom_price'),
            'on_road_price' => $this->request->getPost('on_road_price'),
            'emi_available' => $this->request->getPost('emi_available'),
            'emi_amount' => $this->request->getPost('emi_amount'),
            'down_payment' => $this->request->getPost('down_payment'),
            'insurance_cost' => $this->request->getPost('insurance_cost'),
            'road_tax' => $this->request->getPost('road_tax'),
            'discount_offers' => $this->request->getPost('discount_offers'),
            'price_validity' => $this->request->getPost('price_validity'),
            'currency' => $this->request->getPost('currency') ?: 'INR',
        ];

        if ($pricing) {
            $this->pricingModel->update($pricing['price_id'], $pricingData);
        } elseif ($this->request->getPost('ex_showroom_price')) {
            $this->pricingModel->insert($pricingData);
        }

        return redirect()->to(site_url("admin/vehicle"))
            ->with('success', 'Vehicle updated successfully.');
    }

    public function delete($vehicleId)
    {
        $vehicle = $this->vehicleModel->find($vehicleId);

        if (!$vehicle) {
            return redirect()->to(site_url("admin/vehicle"))->with('error', 'Vehicle not found.');
        }

        $this->pricingModel->where('vehicle_id', $vehicleId)->delete();
        $this->vehicleModel->delete($vehicleId);

        return redirect()->to(site_url("admin/vehicle"))->with('success', 'Vehicle deleted successfully.');
    }
}
