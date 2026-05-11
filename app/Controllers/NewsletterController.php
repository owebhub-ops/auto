<?php
// app/Controllers/NewsletterController.php - FULLY FIXED
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SubscriberModel;
use CodeIgniter\I18n\Time;

class NewsletterController extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [
            'success' => $this->session->getFlashdata('success') ?? null,
            'error' => $this->session->getFlashdata('error') ?? null,
            'csrf' => csrf_hash()
        ];
        return view('newsletter_form', $data);
    }

    public function subscribe()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['error' => 'AJAX only'], 400);
        }

        // Rate limiting - FIXED cache key
        $ip = $this->request->getIPAddress();
        $safeKey = 'newsletter_' . md5($ip);
        $cache = \Config\Services::cache();
        
        $attempts = (int) ($cache->get($safeKey) ?? 0);
        if ($attempts >= 5) {
            return $this->response->setJSON(['error' => 'Too many attempts. Try again in 1 hour.'], 429);
        }
        $cache->save($safeKey, $attempts + 1, 3600);

        // ✅ FIXED VALIDATION - No {id} for INSERT
        $rules = [
            'email' => 'required|valid_email|max_length[255]|is_unique[subscribers.email]'
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return $this->response->setJSON([
                'success' => false,
                'error' => $errors['email'] ?? 'Invalid email format'
            ]);
        }

        $email = trim($this->request->getPost('email'));
        $subscriberModel = new SubscriberModel();
        
        $data = [
            'email' => $email,
            'status' => 'pending',
            'subscribed_at' => Time::now()->toDateTimeString(),
            'ip_address' => $ip
        ];

        if ($subscriberModel->insert($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Success! Check your inbox for confirmation.'
            ]);
        }

        return $this->response->setJSON(['error' => 'Subscription failed'], 500);
    }
}