<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('', ['filter' => 'afterlogin'], function($routes){
    $routes->get('/', 'Home::index');
    $routes->get('daftarone/index', 'DaftarOne::index');
    $routes->get('daftarone/detail(:num)', 'DaftarOne::index/$1');
});
$routes->group('', ['filter' => 'beforelogin'], function($routes){
    $routes->get('/login', 'Login::index');
});


// $routes->get('ipp/ambildata/(:num)', 'Ipp::ambildata/$1');
// $routes->get('isi/(:num)', 'Ipp::isi/$1');

// $routes->get('/', 'Ipp::create');
// $routes->get('/home', 'Home::index');
// $routes->get('/login/logout', 'Login::index');
$routes->setAutoRoute(true);
$routes->get('/daftarprocsum/index', 'DaftarProcsum::index');
$routes->get('/daftarstrong/index', 'DaftarStrong::index');
$routes->get('/daftarmid/index', 'DaftarMid::index');