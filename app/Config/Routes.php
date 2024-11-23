<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->setDefaultController('Auth');
$routes->get('register', 'Auth::register');
$routes->get('login', 'Auth::login');
$routes->post('register', 'Auth::register');
$routes->post('login', 'Auth::login');
