<?php
// app/Models/SubscriberModel.php
namespace App\Models;

use CodeIgniter\Model;

class SubscriberModel extends Model
{
    protected $table = 'subscribers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'email', 'status', 'subscribed_at', 'confirmed_at', 'unsubscribed_at', 
        'ip_address', 'user_agent', 'confirm_token'
    ];
    protected $useTimestamps = false;

    protected $validationRules = [
        'email' => 'required|valid_email|max_length[255]',
        'status' => 'in_list[pending,confirmed,unsubscribed]'
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Valid email required'
        ]
    ];

    public function getStats()
    {
        return [
            'total' => $this->countAll(),
            'confirmed' => $this->where('status', 'confirmed')->countAllResults(),
            'pending' => $this->where('status', 'pending')->countAllResults(),
            'conversion_rate' => $this->countAll() > 0 
                ? round(($this->where('status', 'confirmed')->countAllResults() / $this->countAll()) * 100, 1)
                : 0
        ];
    }
}