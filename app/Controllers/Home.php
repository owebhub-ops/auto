<?php

namespace App\Controllers;
use CodeIgniter\Controller;
class Home extends Controller
{

    public function index()
    {
        // SEO data for home page
        $pageData = [
            'title' => 'AutoOWH | Expert Car Reviews, Compare Models & Specs',
            'description' => 'AutoOWH - Discover detailed car specifications, expert reviews, side-by-side comparisons, and the latest automotive insights. Find the perfect SUV, Sedan, or EV for your lifestyle.',
            'keywords' => 'car reviews, car specifications, compare cars, SUV, sedan, electric vehicles, car mileage, safety ratings, AutoOWH'

        ];

        // Load home content and pass to layout
        $content = view('pages/home');

        echo view('templates/layout', [
            'pageData' => $pageData,
            'content' => $content
        ]);
    }
}
