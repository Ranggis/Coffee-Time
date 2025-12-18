<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/menu', 'Home::menu');          
$routes->get('/view-menu', 'Home::showcase'); 
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/products', 'Admin::products');
$routes->post('/admin/products/stock', 'Admin::updateStock');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/process_login', 'Auth::process_login');
$routes->post('auth/process_register', 'Auth::process_register');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('admin/transaksi', 'Admin::transaksi');
$routes->get('admin/pelanggan', 'Admin::pelanggan');
$routes->post('admin/products/update_stock', 'Admin::update_stock');
$routes->get('checkout', 'Checkout::index');
$routes->post('checkout/process', 'Checkout::process');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
$routes->get('/products', 'Home::products');
$routes->get('/gallery', 'Home::gallery');
$routes->get('/blog', 'Home::blog');