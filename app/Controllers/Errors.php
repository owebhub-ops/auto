<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Errors extends Controller
{
    public function show404()
    {
        $data = $this->getErrorData('404');
        $content = view('errors/html/404', $data);
        return view('templates/layout_inner_home', [
            'pageData' => $data,
            'content' => $content
        ]);
    }

    public function show500()
    {
        $data = $this->getErrorData('500');
        $content = view('errors/html/500', $data);
        return view('templates/layout_inner_home', [
            'pageData' => $data,
            'content' => $content
        ]);
    }

    public function show503()
    {
        $data = $this->getErrorData('503');
        $content = view('errors/html/503', $data);
        return view('templates/layout_inner_home', [
            'pageData' => $data,
            'content' => $content
        ]);
    }

    public function catchAll($slug)
    {
        return $this->show404();
    }

    private function getErrorData(string $code): array
    {
        return match($code) {
            '404' => [
                'code' => $code,
                'title' => '404 - Page Not Found | Learn.OnlineWebHub.com',
                'description' => 'The page you requested could not be found.',
                'keywords' => '404 error, page not found',
                'message' => 'Page Not Found',
                'icon' => 'exclamation-triangle-fill',
                'color' => 'warning'
            ],
            '500' => [
                'code' => $code,
                'title' => '500 - Server Error | Learn.OnlineWebHub.com',
                'description' => 'Internal server error. Try refreshing.',
                'keywords' => '500 error, server error',
                'message' => 'Server Error',
                'icon' => 'bug-fill',
                'color' => 'danger'
            ],
            '503' => [
                'code' => $code,
                'title' => '503 - Service Unavailable | Learn.OnlineWebHub.com',
                'description' => 'Platform temporarily down for maintenance.',
                'keywords' => '503 maintenance',
                'message' => 'Service Unavailable',
                'icon' => 'gear-hourglass',
                'color' => 'warning'
            ],
            default => [
                'code' => $code,
                'title' => "Error {$code} | Learn.OnlineWebHub.com",
                'description' => 'Something went wrong.',
                'keywords' => 'error'
            ]
        };
    }
}