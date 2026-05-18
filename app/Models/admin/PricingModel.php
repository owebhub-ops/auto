<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class PricingModel extends Model
{
    protected $table      = 'pricing';
    protected $primaryKey = 'price_id';

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
        'price_validity',
        'last_updated',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'last_updated';
    protected $updatedField  = 'last_updated';
}
