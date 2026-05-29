<?php
namespace App\Models;
use CodeIgniter\Model;

class ComparisonModel extends Model
{
    protected $table = 'comparisons';
    protected $primaryKey = 'comparison_id';
    protected $allowedFields = ['user_id', 'vehicle_id'];
}
