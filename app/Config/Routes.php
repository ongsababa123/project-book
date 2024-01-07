<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index', ['filter' => ['CartCheck', 'HistoryCheck']]);

$routes->get('/login', 'LoginController::index_Login', ['filter' => ['CartCheck', 'HistoryCheck']]);
$routes->match(['get', 'post'], '/login/auth', 'LoginController::loginAuth');
$routes->match(['get', 'post'], '/logout', 'LoginController::logout');

$routes->get('/register', 'LoginController::index_Register', ['filter' => ['CartCheck', 'HistoryCheck']]);

$routes->get('/forgotpassword', 'LoginController::index_forgotpassword');
$routes->match(['get', 'post'], '/checkpin', 'LoginController::checkpin');

$routes->match(['get', 'post'], '/resetpassword/(:any)/(:any)', 'LoginController::index_resetpassword/$1/$2');
$routes->match(['get', 'post'], '/update/resetpassword', 'LoginController::update_resetpassword');

$routes->group("/", ['filter' => ['CartCheck', 'HistoryCheck']], function ($routes) {
    $routes->match(['get', 'post'], 'book/booklist', 'HomeController::index_listbook');
    $routes->match(['get', 'post'], 'book/booklist/addcart/(:num)', 'HomeController::add_cart/$1');

    $routes->match(['get', 'post'], 'book/details/(:num)', 'HomeController::index_bookdetails/$1');

    $routes->match(['get', 'post'], 'profile', 'HomeController::index_profile' , ['filter' => ['ISLogin']]);

    $routes->match(['get', 'post'], 'cart', 'HomeController::index_cart');

    $routes->match(['get', 'post'], 'history', 'HomeController::index_history');


    $routes->match(['get', 'post'], 'contact', 'HomeController::index_contact');
    $routes->match(['get', 'post'], '/contact/sendEmail', 'HomeController::sendMail');

});

$routes->group("dashboard/", ['filter' => ['CartCheck', 'HistoryCheck' , 'ISLogin']], function ($routes) {
    $routes->match(['get', 'post'], 'index', 'DashboardController::index');
    $routes->match(['get', 'post'], 'edit/user/profile/(:num)', 'UserController::edit_user_profile/$1');  //edit

});
$routes->group("dashboard/customer/", ['filter' => ['CartCheck', 'HistoryCheck']], function ($routes) {
    $routes->match(['get', 'post'], 'index', 'UserController::customer_index', ['filter' => ['authGuard' , 'ISLogin']]); //display
    $routes->match(['get', 'post'], 'getdata/(:num)', 'UserController::get_data_table/$1');  //getData
    $routes->match(['get', 'post'], 'create/(:num)', 'UserController::create_user/$1');  //create
    $routes->match(['get', 'post'], 'edit/(:num)', 'UserController::edit_user/$1');  //edit
});

$routes->group("dashboard/employee/", ['filter' => ['CartCheck', 'HistoryCheck']], function ($routes) {
    $routes->match(['get', 'post'], 'index', 'UserController::employee_index', ['filter' => ['authGuard' , 'ISLogin']]); //display
    $routes->match(['get', 'post'], 'getdata/(:num)', 'UserController::get_data_table/$1');  //getData
    $routes->match(['get', 'post'], 'create/(:num)', 'UserController::create_user/$1');  //create
    $routes->match(['get', 'post'], 'edit/(:num)', 'UserController::edit_user/$1');  //edit
    $routes->match(['get', 'post'], 'delete/(:num)', 'UserController::delete_user/$1');  //delete
});

$routes->group("dashboard/owner/", ['filter' => ['CartCheck', 'HistoryCheck']], function ($routes) {
    $routes->match(['get', 'post'], 'index', 'UserController::owner_index', ['filter' => ['authGuard' , 'ISLogin']]); //display
    $routes->match(['get', 'post'], 'getdata/(:num)', 'UserController::get_data_table/$1');  //getData
    $routes->match(['get', 'post'], 'create/(:num)', 'UserController::create_user/$1');  //create
    $routes->match(['get', 'post'], 'edit/(:num)', 'UserController::edit_user/$1');  //edit
    $routes->match(['get', 'post'], 'delete/(:num)', 'UserController::delete_user/$1');  //delete
});

$routes->group("dashboard/admin/", ['filter' => ['CartCheck', 'HistoryCheck']], function ($routes) {
    $routes->match(['get', 'post'], 'index', 'UserController::admin_index', ['filter' => ['authGuard' , 'ISLogin']]);  //display
    $routes->match(['get', 'post'], 'getdata/(:num)', 'UserController::get_data_table/$1');  //getData
    $routes->match(['get', 'post'], 'create/(:num)', 'UserController::create_user/$1');  //create
    $routes->match(['get', 'post'], 'edit/(:num)', 'UserController::edit_user/$1');  //edit
    $routes->match(['get', 'post'], 'delete/(:num)', 'UserController::delete_user/$1');  //delete
});

$routes->group("dashboard/book/", ['filter' => ['CartCheck', 'HistoryCheck']], function ($routes) {
    $routes->match(['get', 'post'], 'index', 'BookController::index', ['filter' => ['authGuard' , 'ISLogin']]); //display
    $routes->match(['get', 'post'], 'create', 'BookController::create_book');  //create
    $routes->match(['get', 'post'], 'edit/(:num)', 'BookController::edit_book/$1');  //edit
    $routes->match(['get', 'post'], 'delete/(:num)', 'BookController::delete_book/$1');  //delete
});

$routes->group("dashboard/category/", ['filter' => ['CartCheck', 'HistoryCheck']], function ($routes) {
    $routes->match(['get', 'post'], 'index', 'CategoryController::index', ['filter' => ['authGuard' , 'ISLogin']]);  //display 
    $routes->match(['get', 'post'], 'getdata', 'CategoryController::get_data_table');  //getData
    $routes->match(['get', 'post'], 'create', 'CategoryController::create_category');  //create
    $routes->match(['get', 'post'], 'edit/(:num)', 'CategoryController::edit_category/$1');  //edit
    $routes->match(['get', 'post'], 'delete/(:num)', 'CategoryController::delete_category/$1');  //delete
});

$routes->group("dashboard/history/", ['filter' => ['CartCheck', 'HistoryCheck']], function ($routes) {
    $routes->match(['get', 'post'], 'index', 'HistoryController::history_index', ['filter' => ['authGuard' , 'ISLogin']]); //display
    $routes->match(['get', 'post'], 'create', 'HistoryController::create_history');   //create
    $routes->match(['get', 'post'], 'getdata/(:num)', 'HistoryController::get_data_table/$1');  //getData
    $routes->match(['get', 'post'], 'edit/edit_history/(:num)', 'HistoryController::edit_history/$1');  //edit
    $routes->match(['get', 'post'], 'cancel/(:num)', 'HistoryController::cancel_his/$1');  //cancel
    $routes->match(['get', 'post'], 'submit/(:num)/(:num)/(:num)', 'HistoryController::submit_his/$1/$2/$3');  //submit
    $routes->match(['get', 'post'], 'billview/(:num)', 'HistoryController::billview/$1');  //billview
    $routes->match(['get', 'post'], 'history/user/(:num)', 'HistoryController::history_user/$1');  //hisuser
    $routes->match(['get', 'post'], 'cartcancel', 'HistoryController::delete_create_history');  //cancel cart
    $routes->match(['get', 'post'], 'update_status_his/(:num)', 'HistoryController::update_status_his/$1');  //update_status
});

$routes->group("dashboard/late-price/", ['filter' => ['CartCheck', 'HistoryCheck']], function ($routes) {
    $routes->match(['get', 'post'], 'index', 'LatePriceController::index', ['filter' => ['authGuard' , 'ISLogin']]); //display
    $routes->match(['get', 'post'], 'getdata', 'LatePriceController::get_data_table');  //getData
    $routes->match(['get', 'post'], 'edit/(:num)', 'LatePriceController::edit_lateprice/$1');  //edit
});

$routes->group("dashboard/promotion/", ['filter' => ['CartCheck', 'HistoryCheck']], function ($routes) {
    $routes->match(['get', 'post'], 'index', 'PromotionController::index', ['filter' => ['authGuard' , 'ISLogin']]);  //display
    $routes->match(['get', 'post'], 'create', 'PromotionController::create_promotion');  //getData
    $routes->match(['get', 'post'], 'getdata', 'PromotionController::get_data_table');  //getData
    $routes->match(['get', 'post'], 'edit/(:num)/(:num)', 'PromotionController::edit_promotion/$1/$2');  //edit
    $routes->match(['get', 'post'], 'calculate', 'PromotionController::cal_promotion');  //promotion1
});

$routes->group("dashboard/profile/", ['filter' => ['CartCheck', 'HistoryCheck']], function ($routes) {
    $routes->match(['get', 'post'], 'index', 'UserController::profile_index', ['filter' => ['authGuard' , 'ISLogin']]);  //display

});