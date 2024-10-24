<?php

use App\Controllers\ShopController;
use App\Controllers\TestController;
use CodeIgniter\Router\RouteCollection;
use PHPUnit\Util\Filter;

/**
 * @var RouteCollection $routes
 */

// $routes->setAutoRoute(true); // akses controller tanpa menambahkan route
$routes->get('/', 'Home::index');
$routes->get('validation', 'Home::validation');
// $routes->get('test', 'TestController::index' );
$routes->get('test/(:any)/(:any)', 'TestController::show/$1/$2');

// shop
$routes->get('shop', 'ShopController::index');

$routes->group('', ['filter' => 'user'], function ($routes) {
    // posts
    $routes->get('blog', 'BlogController::index');
    $routes->get('blog/post/(:num)', 'BlogController::post/$1');
    $routes->get('blog/new', 'BlogController::new');
    $routes->post('blog/new', 'BlogController::savePost');
    $routes->delete('blog/post/(:num)', 'BlogController::delete/$1');
    $routes->get('blog/edit/(:alphanum)', 'BlogController::edit/$1');
    $routes->put('blog/update/(:alphanum)', 'BlogController::update/$1');
});

// testquery
$routes->get('posts', 'PostsController::index');
$routes->get('posts/where', 'PostsController::where');
$routes->get('posts/join', 'PostsController::join');
$routes->get('posts/like', 'PostsController::like');
$routes->get('posts/grouping', 'PostsController::grouping');
$routes->get('posts/wherein', 'PostsController::whereIn');

$routes->get('logout', 'Auth\AuthController::logout');

$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('login', 'Auth\AuthController::login');
    $routes->post('login', 'Auth\AuthController::validateLogin');
});

$routes->group('admin', ['filter' => ['auth', 'admin']], function ($routes) {

    // BLOG Routes
    $routes->get('blog', 'Admin\BlogController::index');
    $routes->get('blog/new', 'Admin\BlogController::createNew');
    $routes->post('blog/new', 'Admin\BlogController::insert');

    // get userdata
    $routes->get('getUser', 'Auth\AuthController::getUser');
});
