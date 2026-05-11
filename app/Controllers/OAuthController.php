<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OAuthTokenModel;
use App\Models\OAuthAuthCodeModel;
use App\Models\UserModel;
use App\Models\OAuthClientModel;

class OAuthController extends BaseController
{
    protected $tokenModel;
    protected $authCodeModel;
    protected $userModel;
    protected $clientModel;

    public function __construct()
    {
        $this->tokenModel = new OAuthTokenModel();
        $this->authCodeModel = new OAuthAuthCodeModel();
        $this->userModel = new UserModel();
        $this->clientModel = new OAuthClientModel();
    }

    /**
     * Get OAuth client config from DB
     */
    private function getOAuthClient()
    {
        $client = $this->clientModel->getGoogleClient();
        
        if (!$client) {
            log_message('critical', 'Google OAuth client missing from oauth_clients table');
            throw new \Exception('OAuth client not configured');
        }

        return (object) [
            'clientID' => $client['client_id'],
            'clientSecret' => $client['client_secret'],
            'redirectUri' => $client['redirect_uri'],
            'authUrl' => 'https://accounts.google.com/o/oauth2/v2/auth',
            'tokenUrl' => 'https://oauth2.googleapis.com/token',
            'userInfoUrl' => 'https://www.googleapis.com/oauth2/v3/userinfo'
        ];
    }

    public function login()
    {
        try {
            $config = $this->getOAuthClient();
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->to('/');
        }

        $authCode = bin2hex(random_bytes(32));
        $tempUserId = 0;

        $this->authCodeModel->save([
            'code' => $authCode,
            'client_id' => $config->clientID,
            'user_id' => $tempUserId,
            'expires_at' => date('Y-m-d H:i:s', time() + 600)
        ]);

        $state = bin2hex(random_bytes(16));
        session()->set([
            'oauth_auth_code' => $authCode,
            'oauth_state' => $state
        ]);

        $url = $config->authUrl . '?' . http_build_query([
            'response_type' => 'code',
            'client_id' => $config->clientID,
            'redirect_uri' => $config->redirectUri,
            'scope' => 'openid email profile',
            'state' => $state,
            'access_type' => 'offline',  // For refresh_token
            'prompt' => 'consent'        // Force refresh_token
        ]);

        log_message('info', 'Redirecting to Google: ' . substr($url, 0, 100) . '...');
        return redirect()->to($url);
    }

    public function callback()
    {
        $providerCode = $this->request->getVar('code');
        $state = $this->request->getVar('state');
        $error = $this->request->getVar('error');

        if ($error) {
            log_message('error', 'Google OAuth error: ' . $this->request->getVar('error_description'));
            return redirect()->to('/')->with('error', 'Login cancelled');
        }

        if (!$providerCode) {
            return redirect()->to('/')->with('error', 'No authorization code');
        }

        $storedState = session()->get('oauth_state');
        if ($state !== $storedState) {
            log_message('error', 'State validation failed');
            return redirect()->to('/')->with('error', 'Security check failed');
        }

        $storedAuthCode = session()->get('oauth_auth_code');
        if (!$this->authCodeModel->where('code', $storedAuthCode)->first()) {
            return redirect()->to('/')->with('error', 'Session expired');
        }

        try {
            $config = $this->getOAuthClient();
        } catch (\Exception $e) {
            return redirect()->to('/')->with('error', $e->getMessage());
        }

        $httpClient = \Config\Services::curlrequest();

        // Get tokens
        $response = $httpClient->post($config->tokenUrl, [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $providerCode,
                'redirect_uri' => $config->redirectUri,
                'client_id' => $config->clientID,
                'client_secret' => $config->clientSecret,
            ]
        ]);

        $tokenData = json_decode($response->getBody(), true);
        if (!isset($tokenData['access_token'])) {
            log_message('error', 'Token failed: ' . $response->getBody());
            return redirect()->to('/')->with('error', 'Authentication failed');
        }

        // Get user info
        $userinfoResponse = $httpClient->request('GET', $config->userInfoUrl, [
            'headers' => ['Authorization' => 'Bearer ' . $tokenData['access_token']],
            'http_errors' => false
        ]);

        if ($userinfoResponse->getStatusCode() !== 200) {
            log_message('error', 'Userinfo failed: ' . $userinfoResponse->getStatusCode() . ' - ' . $userinfoResponse->getBody());
            return redirect()->to('/')->with('error', 'Profile fetch failed');
        }

        $userInfo = json_decode($userinfoResponse->getBody(), true);
        if (!isset($userInfo['sub'])) {
            return redirect()->to('/')->with('error', 'Invalid profile data');
        }

        // Upsert user
        $userId = $this->userModel->upsertUserFromOAuth($userInfo);

        // Save token
        $this->tokenModel->save([
            'access_token' => $tokenData['access_token'],
            'refresh_token' => $tokenData['refresh_token'] ?? null,
            'client_id' => $config->clientID,
            'user_id' => $userId,
            'expires_at' => date('Y-m-d H:i:s', time() + ($tokenData['expires_in'] ?? 3600))
        ]);

        // Cleanup
        $this->authCodeModel->where('code', $storedAuthCode)->delete();
        session()->remove(['oauth_auth_code', 'oauth_state']);

        // Set session
        session()->set([
            'user_id' => $userId,
            'user_name' => $userInfo['name'] ?? $userInfo['given_name'] ?? $userInfo['preferred_username'] ?? 'User',
            'user_email' => $userInfo['email'] ?? '',
            'provider' => 'google',
            'access_token' => $tokenData['access_token'],
            'expires_in' => time() + ($tokenData['expires_in'] ?? 3600)
        ]);

        log_message('info', "OAuth success - User: {$userId} ({session()->get('user_name')})");
        return redirect()->to('/')->with('success', 'Welcome back!');
    }

    public function refreshToken()
    {
        $userId = session()->get('user_id');
        $tokenRecord = $this->tokenModel->where('user_id', $userId)->first();

        if (!$tokenRecord || !$tokenRecord['refresh_token']) {
            return redirect()->to('/')->with('error', 'No refresh token');
        }

        try {
            $config = $this->getOAuthClient();
        } catch (\Exception $e) {
            return redirect()->to('/')->with('error', $e->getMessage());
        }

        $httpClient = \Config\Services::curlrequest();
        $response = $httpClient->post($config->tokenUrl, [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $tokenRecord['refresh_token'],
                'client_id' => $config->clientID,
                'client_secret' => $config->clientSecret,
            ]
        ]);

        $tokenData = json_decode($response->getBody(), true);
        if (isset($tokenData['access_token'])) {
            $this->tokenModel->update($tokenRecord['id'], [
                'access_token' => $tokenData['access_token'],
                'expires_at' => date('Y-m-d H:i:s', time() + $tokenData['expires_in'])
            ]);
            session()->set([
                'access_token' => $tokenData['access_token'],
                'expires_in' => time() + $tokenData['expires_in']
            ]);
            return redirect()->to('/dashboard');
        }

        return redirect()->to('/')->with('error', 'Refresh failed');
    }

    public function logout()
    {
        $userId = session()->get('user_id');
        if ($userId) {
            $this->tokenModel->where('user_id', $userId)->delete();
        }
        session()->destroy();
        return redirect()->to('/')->with('message', 'Logged out successfully');
    }

    public function isAuthenticated()
    {
        $userId = session()->get('user_id');
        if (!$userId) return false;
        $tokenRecord = $this->tokenModel->where('user_id', $userId)->first();
        return $tokenRecord && strtotime($tokenRecord['expires_at']) > time();
    }
}