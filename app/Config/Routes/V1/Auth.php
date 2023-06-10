<?php

/* @var \CodeIgniter\Router\RouteCollection $routes  */


$routes->group('', ['namespace' => '\App\Controllers\V1'], static function (\CodeIgniter\Router\RouteCollection $routes) {
    $routes->get('/', 'AuthController::login');
    $routes->get('/register', 'AuthController::register');
    $routes->post('/register', 'AuthController::signUp');
    $routes->post('/authenticate', 'AuthController::authenticate');
    $routes->get('/logout', 'AuthController::logout', ['filter' => 'authFilter']);
});
