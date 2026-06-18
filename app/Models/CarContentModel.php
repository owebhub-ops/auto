<?php

namespace App\Models;

use CodeIgniter\Model;

class CarContentModel extends Model
{
    protected $table = 'car_content';
    protected $primaryKey = 'content_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;

    protected $allowedFields = [
        'vehicle_id',
        'overview',
        'pros',
        'cons',
        'competitors',
        'created_by',
        'updated_by'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Get content by vehicle ID
     */
    public function getContentByVehicleId($vehicleId)
    {
        return $this->where('vehicle_id', $vehicleId)->first();
    }

    /**
     * Get content by vehicle slug (join with vehicles)
     */
    public function getContentBySlug($slug)
    {
        return $this->select('car_content.*')
            ->join('vehicles', 'vehicles.vehicle_id = car_content.vehicle_id')
            ->where('vehicles.slug', $slug)
            ->first();
    }

    /**
     * Update or create content for a vehicle
     */
    public function updateOrCreateContent($vehicleId, $data)
    {
        $existing = $this->where('vehicle_id', $vehicleId)->first();
        
        if ($existing) {
            return $this->update($existing['content_id'], $data);
        }
        
        $data['vehicle_id'] = $vehicleId;
        return $this->insert($data);
    }
}