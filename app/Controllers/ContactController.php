<?php
// app/Controllers/ContactController.php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ContactMessageModel;

class ContactController extends Controller
{
    protected $session;
    protected $contactModel;

    public function __construct()
    {
        helper(['form', 'url', 'captcha']);  // Remove 'captcha' helper (not needed)
        $this->session = \Config\Services::session();
        $this->contactModel = new ContactMessageModel();
    }

    public function index1()
    {
        // ✅ SEO Data
        $pageData = [
            'title' => 'Contact Us - Learn.OnlineWebHub.com',
            'description' => 'Get in touch with our support team for help with courses, accounts, or platform issues.',
            'keywords' => 'contact us, support, help, customer service, technical support'
        ];

        // ✅ Contact-specific data
        $contactData = [
            'success' => $this->session->getFlashdata('success'),
            'error' => $this->session->getFlashdata('error'),
            'old' => $this->request->getPost(),
            'csrf' => csrf_hash(),
            'support_email' => 'support@onlinewebhub.com',
            'chat_hours' => '10AM - 8PM IST',
            'response_time' => 'Response within 24 hours',
            'current_year' => date('Y'),
            'timestamp' => date('F d, Y \a\t g:i A')
        ];
        $initial_captcha = strtoupper(substr(md5(uniqid(rand(), true)), 0, 5));
        $this->session->set('captcha_code', $initial_captcha);
        
        $contactData['captcha_image'] = base64_encode(captcha_image($initial_captcha));

        $content = view('pages/contact', $contactData);

        return view('templates/layout', [
            'pageData' => $pageData,
            'content' => $content
        ]);
    }

    public function index()
{
    // ✅ SEO Data
    $pageData = [
        'title'       => 'Contact Us - Learn.OnlineWebHub.com',
        'description' => 'Get in touch with our support team for help with courses, accounts, or platform issues.',
        'keywords'    => 'contact us, support, help, customer service, technical support'
    ];

    // ✅ Contact-specific data
    $contactData = [
        'success'        => $this->session->getFlashdata('success'),
        'error'          => $this->session->getFlashdata('error'),
        'old'            => $this->request->getPost(),
        'csrf'           => csrf_hash(),
        'support_email'  => 'support@onlinewebhub.com',
        'chat_hours'     => '10AM - 8PM IST',
        'response_time'  => 'Response within 24 hours',
        'current_year'   => date('Y'),
        'timestamp'      => date('F d, Y \a\t g:i A')
    ];

    // ✅ Generate initial CAPTCHA
    $initial_captcha = strtoupper(substr(md5(uniqid(rand(), true)), 0, 5));
    $this->session->set('captcha_code', $initial_captcha);

    $captchaData = captcha_image($initial_captcha);

    // ✅ Detect type (PNG vs SVG)
    if (strpos($captchaData, '<svg') !== false) {
        $contactData['captcha_image'] = base64_encode($captchaData);
        $contactData['captcha_type']  = 'svg+xml';
    } else {
        $contactData['captcha_image'] = base64_encode($captchaData);
        $contactData['captcha_type']  = 'png';
    }

    $content = view('pages/contact', $contactData);

    return view('templates/layout', [
        'pageData' => $pageData,
        'content'  => $content
    ]);
}



    public function captcha()
    {
        // Generate new CAPTCHA code
        $captcha_code = strtoupper(substr(md5(uniqid(rand(), true)), 0, 5));
        $this->session->set('captcha_code', $captcha_code);  // ✅ Use CI4 session

        // Generate SVG image
        $svg_data = $this->generateCaptchaImage($captcha_code);

        return $this->response->setJSON([
            'success' => true,
            'image' => base64_encode($svg_data)
        ]);
    }

    
    public function send()
    {
        $rules = [
            'name' => 'required|min_length[2]',
            'email' => 'required|valid_email',
            'subject' => 'required',
            'message' => 'required|min_length[10]',
            'captcha' => 'required|min_length[4]|max_length[5]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        $post = $this->request->getPost();

        // ✅ CAPTCHA Server-side Validation (using CI4 session)
        $stored_captcha = $this->session->get('captcha_code');

        if (
            !$stored_captcha ||
            strtolower(trim($post['captcha'])) !== strtolower(trim($stored_captcha))
        ) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => ['captcha' => 'Invalid CAPTCHA code. Please try again.']
            ]);
        }

        // Clear CAPTCHA session after successful validation
        $this->session->remove('captcha_code');

        $data = [
            'name' => trim($post['name']),
            'email' => trim($post['email']),
            'subject' => trim($post['subject']),
            'message' => trim($post['message']),
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => (string) $this->request->getUserAgent(),
            'captcha_verified' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        try {
            if ($this->contactModel->insert($data)) {
                $this->session->setFlashdata('success', 'Message sent! We\'ll respond within 24 hours.');

                // Regenerate CAPTCHA for next submission
                $new_captcha = strtoupper(substr(md5(uniqid(rand(), true)), 0, 5));
                $this->session->set('captcha_code', $new_captcha);

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Thank you! Your message has been sent successfully.'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Contact form error: ' . $e->getMessage());
        }

        return $this->response->setJSON([
            'success' => false,
            'errors' => ['general' => 'Server error. Please try again later.']
        ]);
    }

    // ✅ Helper method to generate SVG CAPTCHA image
    private function generateCaptchaImage($code)
    {
        return captcha_image($code);
    }

}