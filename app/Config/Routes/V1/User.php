<?php

/* @var \CodeIgniter\Router\RouteCollection $routes  */


$routes->group('user', ['namespace' => '\App\Controllers\V1', 'filter' => 'authFilter'], static function (\CodeIgniter\Router\RouteCollection $routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('/', 'UserController::store');
    $routes->put('(:num)', 'UserController::update/$1');
});

$routes->group('api/user', ['namespace' => '\App\Controllers\V1', 'filter' => 'authFilter'], static function (\CodeIgniter\Router\RouteCollection $routes) {
    $routes->get('/', 'UserController::list');
    $routes->put('change-status/(:num)', 'UserController::changeStatus/$1');
    $routes->delete('(:num)', 'UserController::delete/$1');
});
