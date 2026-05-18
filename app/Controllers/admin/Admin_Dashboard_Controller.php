<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\admin\PricingModel;
use App\Models\admin\VehicleModel;

class Admin_Dashboard_Controller extends BaseController
{
    public function index()
    {
        $pricingModel = new PricingModel();
        $vehicleModel = new VehicleModel();

        // Count totals
        $totalVehicles = $vehicleModel->countAllResults();
        $totalPricings = $pricingModel->countAllResults();

        // Example chart data
        $chartData = [
            'labels' => ['Vehicles', 'Pricing Records'],
            'values' => [$totalVehicles, $totalPricings],
        ];

        $pageData = [
            'title' => 'Vehicle Pricing Dashboard',
            'description' => 'Manage ex-showroom and on-road prices, EMI options, and discounts for all vehicles.',
            'keywords' => 'vehicle pricing, car prices, EMI, discounts, Hyundai Creta',
            'totalVehicles' => $totalVehicles,
            'totalPricings' => $totalPricings,
            'chartData' => $chartData,
        ];

        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => view('pages/admin/admin_dashboard', $pageData),
        ]);
    }

    public function profile()
    {
        $pageData = [
            'title' => 'Admin Profile - Vehicle Pricing',
            'description' => 'View and manage your admin profile for vehicle pricing system.',
            'keywords' => 'admin profile, vehicle pricing, car management'
        ];

        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => view('pages/admin/admin_profile', $pageData),
        ]);
    }

    public function settings()
    {
        $pageData = [
            'title' => 'Admin Settings - Vehicle Pricing',
            'description' => 'Configure system settings for vehicle pricing, EMI, and discounts.',
            'keywords' => 'admin settings, vehicle pricing, EMI, discounts'
        ];

        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => view('pages/admin/admin_settings', $pageData),
        ]);
    }
}
