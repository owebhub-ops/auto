<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\admin\CourseModel;
use App\Models\admin\LessonModel;

class Admin_Dashboard_Controller extends BaseController
{
    public function index()
    {
        $courseModel = new CourseModel();
        $lessonModel = new LessonModel();

        $totalCourses = $courseModel->countAllResults();
        $totalLessons = $lessonModel->countAllResults();

        $chartData = [
            'labels' => ['Courses', 'Lessons'],
            'values' => [$totalCourses, $totalLessons],
        ];

        $pageData = [
            'title' => 'AI Education & Web Development Courses',
            'description' => 'Master HTML, CSS, JavaScript, PHP with interactive quizzes, tutorials and exercises. Start your web development journey today.',
            'keywords' => 'coding tutorials, web development, HTML quiz, CSS quiz, JavaScript quiz, PHP learning',
            'totalCourses' => $totalCourses,
            'totalLessons' => $totalLessons,
            'chartData' => $chartData,
        ];

        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => view('pages/admin/admin_dashboard', $pageData),
        ]);
    }

    public function profile()
    {
        $pageData = [
            'title' => 'AI Education & Web Development Courses',
            'description' => 'Master HTML, CSS, JavaScript, PHP with interactive quizzes, tutorials and exercises. Start your web development journey today.',
            'keywords' => 'coding tutorials, web development, HTML quiz, CSS quiz, JavaScript quiz, PHP learning'
        ];

        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => view('pages/admin/admin_profile', $pageData),
        ]);
    }

    public function settings()
    {
        $pageData = [
            'title' => 'AI Education & Web Development Courses',
            'description' => 'Master HTML, CSS, JavaScript, PHP with interactive quizzes, tutorials and exercises. Start your web development journey today.',
            'keywords' => 'coding tutorials, web development, HTML quiz, CSS quiz, JavaScript quiz, PHP learning'
        ];

        return view('templates/admin/layout_admin', [
            'pageData' => $pageData,
            'content' => view('pages/admin/admin_settings', $pageData),
        ]);
    }

}