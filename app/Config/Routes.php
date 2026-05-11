<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\admin\AdminCourseController;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('admin', ['namespace' => 'App\Controllers\admin'], function ($routes) {
    $routes->get('login', 'AdminLoginController::index');
    $routes->post('login/authenticate', 'AdminLoginController::authenticate');
    $routes->post('logout', 'AdminLoginController::logout');
});

$routes->group('admin', ['namespace' => 'App\Controllers\admin', 'filter' => 'admin'], function ($routes) {
    $routes->get('/', 'Admin_Dashboard_Controller::index');
    $routes->get('dashboard', 'Admin_Dashboard_Controller::index');
    $routes->get('profile', 'Admin_Dashboard_Controller::profile');
    $routes->get('settings', 'Admin_Dashboard_Controller::settings');
});
$routes->group('admin/contact', ['namespace' => 'App\Controllers\admin', 'filter' => 'admin'], function($routes) {
    $routes->get('/', 'AdminContactController::index');
    $routes->get('(:num)', 'AdminContactController::show/$1');
    $routes->post('delete/(:num)', 'AdminContactController::destroy/$1');
});

$routes->group('admin', ['namespace' => 'App\Controllers\admin', 'filter' => 'admin'], function ($routes) {

    // Course management (admin/course/*)
    $routes->group('course', function ($routes) {
        $routes->get('/', 'AdminCourseController::index');
        $routes->get('create', 'AdminCourseController::create');
        $routes->post('store', 'AdminCourseController::store');
        $routes->get('edit/(:num)', 'AdminCourseController::edit/$1');
        $routes->post('update/(:num)', 'AdminCourseController::update/$1');
        $routes->post('delete/(:num)', 'AdminCourseController::destroy/$1');
    });

    // Lesson management (admin/course/{id}/lesson/*) - Nested to avoid conflicts
    $routes->group('course/(:num)/lesson', ['namespace' => 'App\Controllers\admin'], function ($routes) {
        $routes->get('/', 'LessonController::index/$1');
        $routes->get('create', 'LessonController::create/$1');
        $routes->post('store', 'LessonController::store/$1');
        $routes->get('edit/(:num)', 'LessonController::edit/$1/$2');
        $routes->post('update/(:num)', 'LessonController::update/$1/$2');
        $routes->post('delete/(:num)', 'LessonController::delete/$1/$2');
    });
});


$routes->get('login', 'OAuthController::login');
$routes->get('callback', 'OAuthController::callback');
$routes->get('refresh', 'OAuthController::refreshToken');
$routes->get('logout', 'OAuthController::logout');



// Auth protected pages
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'UserController::dashboard');
    $routes->get('profile', 'UserController::profile');
    $routes->get('courses/my-courses', 'UserController::myCourses');
});


$routes->get('cars', 'CarsController::index');
$routes->get('cars/(:num)', 'CarsController::detail/$1');


// Static Pages Routes (SEO-friendly)
$routes->get('privacy', 'StaticPageController::privacy');
$routes->get('terms', 'StaticPageController::terms');
$routes->get('about', 'StaticPageController::about');
//$routes->get('contact', 'StaticPageController::contact');
$routes->get('faq', 'StaticPageController::faq');

// Dynamic static pages (legal/privacy/terms)
$routes->get('legal/(:segment)', 'StaticPageController::index/$1');



// Dynamic sitemap generator UI
$routes->add('sitemap', 'SitemapController::generator');

// Explicit /sitemap/download and /sitemap/save
$routes->add('sitemap/download', 'SitemapController::download');
$routes->add('sitemap/save', 'SitemapController::save');

// Static file endpoint
$routes->add('sitemap.xml', function () {
    $path = WRITEPATH . 'sitemap.xml';
    if (file_exists($path)) {
        $response = service('response');
        $response
            ->setHeader('Content-Type', 'application/xml')
            ->setBody(file_get_contents($path));
        return $response;
    }
    throw new \CodeIgniter\Exceptions\PageNotFoundException();
});



$routes->get('newsletter', 'NewsletterController::index');
$routes->post('newsletter/subscribe', 'NewsletterController::subscribe');
$routes->get('newsletter/confirm/(:segment)', 'NewsletterController::confirm/$1');

$routes->get('contact', 'ContactController::index');
$routes->post('contact/send', 'ContactController::send');
$routes->get('contact/captcha', 'ContactController::captcha');
$routes->get('captcha', 'CaptchaController::index');

// Global 404 override
$routes->set404Override('Errors::show404');


// Catch-all route AFTER specific routes
$routes->get('(:any)', 'Errors::catchAll/$1');