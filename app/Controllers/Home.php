<?php

namespace App\Controllers;
use CodeIgniter\Controller;
class Home extends Controller
{

    public function index()
    {
        // SEO data for home page
        $pageData = [
            'title' => 'AI Education & Web Development Courses',
            'description' => 'Master HTML, CSS, JavaScript, PHP with interactive quizzes, tutorials and exercises. Start your web development journey today.',
            'keywords' => 'coding tutorials, web development, HTML quiz, CSS quiz, JavaScript quiz, PHP learning'
        ];

        // Load home content and pass to layout
        $content = view('pages/home');

        echo view('templates/layout', [
            'pageData' => $pageData,
            'content' => $content
        ]);
    }
}
