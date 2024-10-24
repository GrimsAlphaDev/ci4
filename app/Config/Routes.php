<?php

use App\Controllers\ShopController;
use App\Controllers\TestController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->setAutoRoute(true); // akses controller tanpa menambahkan route
$routes->get('/', 'Home::index');
$routes->get('validation', 'Home::validation');
$routes->get('test', 'TestController::index' );
$routes->get('test/(:any)/(:any)', 'TestController::show/$1/$2');

// shop
$routes->get('shop', 'ShopController::index');

// product
$routes->get('blog', 'BlogController::index');
$routes->get('blog/post/(:num)', 'BlogController::post/$1');
$routes->get('blog/new', 'BlogController::new');
$routes->post('blog/new', 'BlogController::savePost');
$routes->delete('blog/post/(:num)', 'BlogController::delete/$1');
$routes->get('blog/edit/(:alphanum)', 'BlogController::edit/$1');
$routes->put('blog/update/(:alphanum)', 'BlogController::update/$1');

$routes->group('admin', function($routes){
    $routes->get('user', 'Admin\UsersController::index');
    $routes->get('users', 'Admin\UsersController::getAllUsers');
    $routes->add('product', 'Admin\ShopController::index');

    $routes->get('admin/shop', 'Admin\ShopController::index');
    $routes->get('product/(:alphanum)/(:num)', 'Admin\ShopController::product/$1/$2');

    // BLOG Routes
    $routes->get('blog', 'Admin\BlogController::index');
    $routes->get('blog/new', 'Admin\BlogController::createNew');
});