<?php
namespace App\Models;

use CodeIgniter\Model;

class OAuthTokenModel extends Model
{
    protected $table = 'oauth_access_tokens';
    protected $primaryKey = 'id';
    protected $allowedFields = ['access_token', 'refresh_token', 'client_id', 'user_id', 'expires_at'];
    protected $useTimestamps = false;  // ✅ Add this
}