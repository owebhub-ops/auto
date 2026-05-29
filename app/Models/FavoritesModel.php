<?php namespace App\Models;
use CodeIgniter\Model;

class FavoritesModel extends Model {
    protected $table = 'favorites';
    protected $primaryKey = 'favorite_id';
    protected $allowedFields = ['user_id','vehicle_id'];
}
