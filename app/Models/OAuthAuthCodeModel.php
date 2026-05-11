<?php
namespace App\Models;

use CodeIgniter\Model;

class OAuthAuthCodeModel extends Model
{
    protected $table = 'oauth_auth_codes';  // ✅ Fixed table name
    protected $primaryKey = 'id';
    protected $allowedFields = ['code', 'client_id', 'user_id', 'expires_at'];
    protected $useTimestamps = false;  // ✅ Add this
}