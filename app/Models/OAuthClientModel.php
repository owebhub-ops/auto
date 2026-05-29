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
        return $this->where('client_id', '154920762847-fmpjsdvihri17efjfu4alkfjibst640q.apps.googleusercontent.com')->first();
    }
}