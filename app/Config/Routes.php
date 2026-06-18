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


// Admin Vehicle Routes
$routes->group('admin/vehicle', ['namespace' => 'App\Controllers\admin'], function($routes) {
    $routes->get('/', 'VehicleController::index');                  // list all vehicles
    $routes->get('create', 'VehicleController::create');            // show create form
    $routes->post('store', 'VehicleController::store');             // handle create form
    $routes->get('show/(:num)', 'VehicleController::show/$1');      // show single vehicle card
    $routes->get('edit/(:num)', 'VehicleController::edit/$1');      // show edit form
    $routes->post('update/(:num)', 'VehicleController::update/$1'); // handle update form
    $routes->post('delete/(:num)', 'VehicleController::delete/$1'); // delete vehicle
});




$routes->get('login', 'OAuthController::login');
$routes->get('callback', 'OAuthController::callback');
$routes->get('refresh', 'OAuthController::refreshToken');
$routes->get('logout', 'OAuthController::logout');



// Auth protected pages
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('mydashboard', 'UserController::dashboard');
    $routes->get('profile', 'UserController::profile');
    $routes->get('favorites', 'UserController::favorites');

});


$routes->get('cars/compareHome', 'CarsController::compareHome');
$routes->get('cars/compare', 'CarsController::compare');
$routes->get('cars/compare/(:any)', 'CarsController::compare/$1'); // For URL segment style
$routes->get('cars/search', 'CarsController::search'); 

$routes->get('cars-compareHome', 'CarsController::compareHome');
$routes->get('cars-compare', 'CarsController::compare');
$routes->get('cars-compare/(:any)', 'CarsController::compare/$1'); // For URL segment style
$routes->get('cars-search', 'CarsController::search'); 
// Cars listing and detail
$routes->get('cars', 'CarsController::index');
$routes->get('cars/sort/(:segment)', 'CarsController::index/$1');
$routes->get('cars/category/(:segment)', 'CarsController::index/null/$1');
$routes->get('cars/detail/(:num)', 'CarsController::detail/$1');
$routes->get('cars/detail/(:segment)', 'CarsController::details/$1');

$routes->get('car/(:num)', 'CarsController::detail/$1');
$routes->get('car/(:segment)', 'CarsController::details/$1');
// Load More endpoint for AJAX
// Add this at the top of your routes file
$routes->get('ajax/loadMore', 'Ajax::loadMore');
$routes->post('ajax/loadMore', 'Ajax::loadMore');




$routes->get('cars/features', 'FeaturesController::index');
$routes->get('cars/features/(:segment)', 'FeaturesController::index/$1');
$routes->get('cars/features/detail/(:num)', 'FeaturesController::detail/$1');
$routes->get('cars/features/search', 'FeaturesController::search');
$routes->get('cars/features/loadMore', 'FeaturesController::loadMore');

// EV Routes
$routes->get('ev', 'EVController::index');
$routes->get('ev/detail/(:segment)', 'EVController::detail/$1');
$routes->get('ev/compare', 'EVController::compare');
$routes->get('ev/compare/(:any)', 'EVController::compare/$1');
$routes->get('ev/search', 'EVController::search');


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
//$routes->set404Override('Errors::show404');


// Catch-all route AFTER specific routes
//$routes->get('(:any)', 'Errors::catchAll/$1');