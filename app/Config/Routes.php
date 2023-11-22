<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/login', 'LoginController::index_Login');
$routes->get('/register', 'LoginController::index_Register');
$routes->get('/forgotpassword', 'LoginController::index_forgotpassword');
$routes->get('/resetpassword', 'LoginController::index_resetpassword');

$routes->group("/", function ($routes) {
    $routes->match(['get', 'post'], 'book/booklist', 'HomeController::index_listbook');

    $routes->match(['get', 'post'], 'profile', 'HomeController::index_profile');

    $routes->match(['get', 'post'], 'cart', 'HomeController::index_cart');


    $routes->match(['get', 'post'], 'contact', 'HomeController::index_contact');  
    $routes->match(['get', 'post'], '/contact/sendEmail', 'HomeController::sendMail');

});

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

$routes->group("dashboard/book/", function ($routes) {
    $routes->match(['get', 'post'], 'index', 'BookController::index');  
    $routes->match(['get', 'post'], 'create', 'BookController::create_book');  //create
    $routes->match(['get', 'post'], 'edit/(:num)', 'BookController::edit_book/$1');  //edit
    $routes->match(['get', 'post'], 'delete/(:num)', 'BookController::delete_book/$1');  //delete
});

$routes->group("dashboard/category/", function ($routes) {
    $routes->match(['get', 'post'], 'index', 'CategoryController::index');  
    $routes->match(['get', 'post'], 'getdata', 'CategoryController::get_data_table');  //getData
    $routes->match(['get', 'post'], 'create', 'CategoryController::create_category');  //create
    $routes->match(['get', 'post'], 'edit/(:num)', 'CategoryController::edit_category/$1');  //edit
    $routes->match(['get', 'post'], 'delete/(:num)', 'CategoryController::delete_category/$1');  //delete
});

$routes->group("dashboard/history/", function ($routes) {
    $routes->match(['get', 'post'], 'index', 'HistoryController::history_index');  
    $routes->match(['get', 'post'], 'create', 'HistoryController::create_history');   //create
    $routes->match(['get', 'post'], 'getdata', 'HistoryController::get_data_table');  //getData
    $routes->match(['get', 'post'], 'edit/return_date/(:num)', 'HistoryController::edit_retrun_date/$1');  //edit
    $routes->match(['get', 'post'], 'cancel/(:num)', 'HistoryController::cancel_his/$1');  //cancel
    $routes->match(['get', 'post'], 'submit/(:num)/(:num)', 'HistoryController::submit_his/$1/$2');  //submit
    $routes->match(['get', 'post'], 'billview/(:num)', 'HistoryController::billview/$1');  //submit
    $routes->match(['get', 'post'], 'history/user/(:num)', 'HistoryController::history_user/$1');  //hisuser
});

$routes->group("dashboard/late-price/", function ($routes) {
    $routes->match(['get', 'post'], 'index', 'LatePriceController::index');  
    $routes->match(['get', 'post'], 'getdata', 'LatePriceController::get_data_table');  //getData
    $routes->match(['get', 'post'], 'edit/(:num)', 'LatePriceController::edit_lateprice/$1');  //edit
});

$routes->group("dashboard/promotion/", function ($routes) {
    $routes->match(['get', 'post'], 'index', 'PromotionController::index');  
    $routes->match(['get', 'post'], 'getdata', 'PromotionController::get_data_table');  //getData
    $routes->match(['get', 'post'], 'edit/(:num)/(:num)', 'PromotionController::edit_promotion/$1/$2');  //edit
    $routes->match(['get', 'post'], 'calculate', 'PromotionController::cal_promotion');  //promotion1
});