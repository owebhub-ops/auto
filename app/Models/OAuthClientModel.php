<?php namespace App\Models;

use CodeIgniter\Model;

class OAuthClientModel extends Model
{
    protected $table = 'oauth_clients';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'client_secret', 'redirect_uri', 'name'];
    protected $useTimestamps = false;  // created_at handled by DB default

    /**
     * Get Google client config
     */
    public function getGoogleClient()
    {
        return $this->where('client_id', '740289682350-813p3180jastbro3geoe6gfsnebhbjlo.apps.googleusercontent.com')->first();
    }
}