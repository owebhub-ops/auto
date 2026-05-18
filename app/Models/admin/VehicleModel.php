<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class VehicleModel extends Model
{
    protected $table      = 'vehicles';
    protected $primaryKey = 'vehicle_id';

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
        'brochure_url',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getVehiclesWithFeatures()
{
    return $this->select('vehicles.*, pricing.ex_showroom_price, pricing.on_road_price, pricing.currency')
        ->join('pricing', 'pricing.vehicle_id = vehicles.vehicle_id', 'left')
        ->findAll();
}

public function getVehiclesByFeatureCategory($category)
{
    $builder = $this->db->table('vehicles');

    switch ($category) {
        case 'Safety':
            $builder->like('safety_features', '%');
            break;
        case 'Infotainment':
            $builder->like('infotainment', '%');
            break;
        case 'Comfort':
            $builder->like('comfort_features', '%');
            break;
        case 'Interior':
            $builder->like('interior_features', '%');
            break;
        case 'Exterior':
            $builder->like('exterior_features', '%');
            break;
        case 'Camera':
            $builder->like('camera_features', '%');
            break;
    }

    return $builder->get()->getResultArray();
}

}
