<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'name', 'provider_id'];
    
    // ✅ DISABLE timestamps to avoid column issues
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function upsertUserFromOAuth($userInfo)
    {
        $user = $this->where('provider_id', $userInfo['sub'])->first();
        if (!$user) {
            $data = [
                'email' => $userInfo['email'] ?? '',
                'name' => $userInfo['name'] ?? $userInfo['preferred_username'] ?? '',
                'provider_id' => $userInfo['sub']
            ];
            $this->insert($data);
            return $this->getInsertID();
        }
        return $user['id'];
    }
}