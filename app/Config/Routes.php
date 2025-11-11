<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::attemptLogin');
$routes->get('/logout', 'Login::logout');

$routes->group('admin', ['filter' => 'role:admin'], static function ($routes) {
    $routes->get('users', 'UserController::index');
    $routes->post('users/create', 'UserController::create');
    $routes->post('users/edit/(:num)', 'UserController::edit/$1');
    $routes->post('users/delete/(:num)', 'UserController::delete/$1');
});
