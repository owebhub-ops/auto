<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class StaticPageController extends Controller
{
    public function __construct()
    {
        // No models needed for static pages
    }

    public function index($page_slug = 'privacy')
    {
        // Validate allowed pages
        $allowed_pages = ['privacy', 'terms', 'about', 'contact','faq'];
        if (!in_array($page_slug, $allowed_pages)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Page not found');
        }

        $page_data = $this->getPageData($page_slug);

        // Render the page content view
        $content = view('pages/static/' . $page_slug, $page_data);

        // Use same layout as LessonController
        return view('templates/layout_inner_home', [
            'pageData' => [
                'title' => $page_data['title'],
                'description' => $page_data['description'],
                'keywords' => $page_data['keywords'],
            ],
            'content' => $content
        ]);
    }

    // Specific methods for cleaner URLs
    public function privacy()
    {
        return $this->index('privacy');
    }

    public function terms()
    {
        return $this->index('terms');
    }

    public function about()
    {
        return $this->index('about');
    }

    public function contact()
    {
        return $this->index('contact');
    }

    public function faq()
    {
        return $this->index('faq');
    }
    /**
     * Get page-specific data
     */
    protected function getPageData(string $page_slug): array
    {
        $pages = [
            'privacy' => [
                'title' => 'Privacy Policy - Learn.OnlineWebHub.com',
                'description' => 'Read our Privacy Policy to understand how we collect, use, and protect your personal information on Learn.OnlineWebHub.com.',
                'keywords' => 'privacy policy, data protection, GDPR, Learn OnlineWebHub',
                'page_title' => 'Privacy Policy'
            ],
            'terms' => [
                'title' => 'Terms of Service - Learn.OnlineWebHub.com',
                'description' => 'Our Terms of Service govern your use of Learn.OnlineWebHub.com. Please read carefully before using our platform.',
                'keywords' => 'terms of service, terms, user agreement, Learn OnlineWebHub',
                'page_title' => 'Terms of Service'
            ],
            'about' => [
                'title' => 'About Us - Learn.OnlineWebHub.com',
                'description' => 'Learn about Learn.OnlineWebHub.com - your premier online learning platform with expert courses and certifications.',
                'keywords' => 'about us, online learning, e-learning platform',
                'page_title' => 'About Us'
            ],
            'contact' => [
                'title' => 'Contact Us - Learn.OnlineWebHub.com',
                'description' => 'Get in touch with our support team for help with courses, accounts, or platform issues.',
                'keywords' => 'contact us, support, help, customer service',
                'page_title' => 'Contact Us'
            ],
            'faq' => [
                'title' => 'Frequently Asked Questions - Learn.OnlineWebHub.com',
                'description' => 'Find answers to common questions about course access, certificates, payments, and account security.',
                'keywords' => 'faq, help center, course support, online learning help, certificate verify',
                'page_title' => 'Help Center & FAQ'
            ]

        ];

        return $pages[$page_slug] ?? $pages['privacy'];
    }
}