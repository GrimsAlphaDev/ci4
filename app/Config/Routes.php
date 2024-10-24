<?php

use App\Controllers\TestController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/test', [TestController::class, 'index']);
$routes->get('/test/(:any)', [TestController::class, 'show']);
