<?php

namespace App\Models;

use CodeIgniter\Model;

class PricingModel extends Model
{
    protected $table = 'Pricing';
    protected $primaryKey = 'price_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'vehicle_id',
        'ex_showroom_price',
        'on_road_price',
        'currency',
        'emi_available',
        'emi_amount',
        'down_payment',
        'insurance_cost',
        'road_tax',
        'discount_offers',
        'price_validity'
    ];

    protected $useTimestamps = true;
    protected $updatedField = 'last_updated';

    // ✅ Get pricing for specific vehicle (used in controller)
    public function getPricingByVehicle($vehicleId)
    {
        return $this->where('vehicle_id', $vehicleId)
            ->orderBy('last_updated', 'DESC')
            ->first();
    }

    // Bonus: Get active pricing (valid today)
    public function getActivePricing($vehicleId)
    {
        return $this->where('vehicle_id', $vehicleId)
            ->where('price_validity >=', date('Y-m-d'))
            ->orderBy('last_updated', 'DESC')
            ->first();
    }

    // Bonus: Get EMI details
    public function getEmiDetails($vehicleId)
    {
        $pricing = $this->where('vehicle_id', $vehicleId)
            ->where('emi_available', 1)
            ->first();

        return $pricing ? [
            'emi_amount' => $pricing['emi_amount'],
            'down_payment' => $pricing['down_payment']
        ] : null;
    }


    public function updateVehiclePricing($vehicleId, $data)
    {
        return $this->where('vehicle_id', $vehicleId)->set($data)->update();
    }

}