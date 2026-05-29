<?php
namespace App\Models;
use CodeIgniter\Model;

class WishlistModel extends Model
{
    protected $table = 'wishlist';
    protected $primaryKey = 'wishlist_id';
    protected $allowedFields = ['user_id', 'vehicle_id'];
}
