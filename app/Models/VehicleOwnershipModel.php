<?php namespace App\Models;
use CodeIgniter\Model;

class VehicleOwnershipModel extends Model {
    protected $table = 'vehicle_ownership';
    protected $primaryKey = 'ownership_id';
    protected $allowedFields = ['user_id','vehicle_id'];

    public function getOwnedVehicles($userId)
    {
        return $this->select('vehicles.*, pricing.ex_showroom_price')
                    ->join('vehicles', 'vehicles.vehicle_id = vehicle_ownership.vehicle_id')
                    ->join('pricing', 'pricing.vehicle_id = vehicles.vehicle_id', 'left')
                    ->where('vehicle_ownership.user_id', $userId)
                    ->findAll();
    }
}
