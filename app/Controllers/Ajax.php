<?php

namespace App\Controllers;

use App\Models\VehicleModel;

class Ajax extends BaseController
{
    public function loadMore()
    {
        // Clear any output buffers
        while (ob_get_level()) {
            ob_end_clean();
        }
        
        // Set headers
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        
        try {
            $vehicleModel = new VehicleModel();
            
            // Get parameters
            $page = (int) ($this->request->getGet('page') ?? 1);
            $limit = (int) ($this->request->getGet('limit') ?? 8);
            $sort = $this->request->getGet('sort') ?? '';
            $fuel = $this->request->getGet('fuel');
            $body = $this->request->getGet('body');
            $search = $this->request->getGet('search');
            $offset = ($page - 1) * $limit;
            
            // Build query using Query Builder directly
            $db = \Config\Database::connect();
            $builder = $db->table('vehicles v')
                ->select('v.vehicle_id, v.make, v.model, v.variant, v.slug, v.body_type, v.fuel_type, v.transmission, v.mileage_kmpl, v.seating_capacity, v.ncap_rating, v.image_url, p.ex_showroom_price')
                ->join('pricing p', 'p.vehicle_id = v.vehicle_id', 'left');
            
            // Apply filters
            if (!empty($fuel) && $fuel !== '') {
                $builder->where('v.fuel_type', $fuel);
            }
            if (!empty($body) && $body !== '') {
                $builder->where('v.body_type', $body);
            }
            if (!empty($search) && $search !== '') {
                $builder->groupStart()
                    ->like('v.make', $search)
                    ->orLike('v.model', $search)
                    ->orLike('v.variant', $search)
                    ->groupEnd();
            }
            
            // Apply sorting
            if ($sort === 'price-low') {
                $builder->orderBy('p.ex_showroom_price', 'ASC');
            } elseif ($sort === 'price-high') {
                $builder->orderBy('p.ex_showroom_price', 'DESC');
            } elseif ($sort === 'mileage') {
                $builder->orderBy('v.mileage_kmpl', 'DESC');
            } else {
                $builder->orderBy('v.make', 'ASC')->orderBy('v.model', 'ASC');
            }
            
            // Get total count
            $tempBuilder = clone $builder;
            $total = $tempBuilder->countAllResults();
            
            // Get paginated results
            $cars = $builder->limit($limit, $offset)->get()->getResultArray();
            
            $hasMore = ($page * $limit) < $total;
            
            echo json_encode([
                'success' => true,
                'cars' => $cars,
                'hasMore' => $hasMore,
                'total' => $total,
                'currentPage' => $page,
                'perPage' => $limit
            ]);
            exit;
            
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage(),
                'cars' => [],
                'hasMore' => false,
                'total' => 0
            ]);
            exit;
        }
    }
}