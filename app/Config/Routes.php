<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DashboardController::index');
$routes->group("dashboard/", function ($routes) {
    $routes->match(['get', 'post'], 'index', 'DashboardController::index');  
});
$routes->group("dashboard/customer/", function ($routes) {
    $routes->match(['get', 'post'], 'index', 'UserController::customer_index');  
    $routes->match(['get', 'post'], 'getdata/(:num)', 'UserController::get_data_table/$1');  //getData
    $routes->match(['get', 'post'], 'create/(:num)', 'UserController::create_user/$1');  //create
    $routes->match(['get', 'post'], 'edit/(:num)', 'UserController::edit_user/$1');  //edit
});

$routes->group("dashboard/employee/", function ($routes) {
    $routes->match(['get', 'post'], 'index', 'UserController::employee_index');  
    $routes->match(['get', 'post'], 'getdata/(:num)', 'UserController::get_data_table/$1');  //getData
    $routes->match(['get', 'post'], 'create/(:num)', 'UserController::create_user/$1');  //create
    $routes->match(['get', 'post'], 'edit/(:num)', 'UserController::edit_user/$1');  //edit
    $routes->match(['get', 'post'], 'delete/(:num)', 'UserController::delete_user/$1');  //delete
});

$routes->group("dashboard/owner/", function ($routes) {
    $routes->match(['get', 'post'], 'index', 'UserController::owner_index');  
    $routes->match(['get', 'post'], 'getdata/(:num)', 'UserController::get_data_table/$1');  //getData
    $routes->match(['get', 'post'], 'create/(:num)', 'UserController::create_user/$1');  //create
    $routes->match(['get', 'post'], 'edit/(:num)', 'UserController::edit_user/$1');  //edit
    $routes->match(['get', 'post'], 'delete/(:num)', 'UserController::delete_user/$1');  //delete
});

$routes->group("dashboard/admin/", function ($routes) {
    $routes->match(['get', 'post'], 'index', 'UserController::admin_index');  
    $routes->match(['get', 'post'], 'getdata/(:num)', 'UserController::get_data_table/$1');  //getData
    $routes->match(['get', 'post'], 'create/(:num)', 'UserController::create_user/$1');  //create
    $routes->match(['get', 'post'], 'edit/(:num)', 'UserController::edit_user/$1');  //edit
    $routes->match(['get', 'post'], 'delete/(:num)', 'UserController::delete_user/$1');  //delete
});