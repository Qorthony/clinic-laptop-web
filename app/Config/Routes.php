<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/cek', 'Home::cekStatus');

// Auth Routes
$routes->get('/login', 'Auth::index', ['filter'=>'guest']);
$routes->post('/login', 'Auth::login', ['filter'=>'guest']);
$routes->get('/logout', 'Auth::logout');

// Admin Routes
$routes->get('/admin', 'Admin\Dashboard::index',['filter'=>'auth']);

// Servis Route
$routes->get('/admin/servis', 'Admin\Servis::index', ['filter'=>'auth']);
$routes->post('/admin/servis/create', 'Admin\Servis::create', ['filter'=>'auth']);
$routes->post('/admin/servis/update/$1', 'Admin\Servis::update', ['filter'=>'auth']);
$routes->get('/admin/servis/delete/$1', 'Admin\Servis::delete', ['filter'=>'auth']);
$routes->get('/admin/servis/updateStatus/$1/$2', 'Admin\Servis::updateStatus', ['filter'=>'auth']);
$routes->post('/admin/servis/updateToSelesai/$1', 'Admin\Servis::updateToSelesai', ['filter'=>'auth']);
$routes->post('/admin/servis/updateToDiambil/$1', 'Admin\Servis::updateToDiambil', ['filter'=>'auth']);
$routes->get('/admin/servis/search', 'Admin\Servis::search', ['filter'=>'auth']);

//User Route
$routes->get('/admin/user', 'Admin\User::index',['filter'=>'role:1']);
$routes->post('/admin/user/add', 'Admin\User::add',['filter'=>'role:1']);
$routes->post('/admin/servis/edit/$1', 'Admin\Servis::edit', ['filter'=>'role:1']);
$routes->get('/admin/user/del/(:num)','Admin\User::delete/$1',["filter"=>"role:1"]);
$routes->get('/admin/user/search', 'Admin\User::search', ['filter'=>'role:1']);

// Profile Route
$routes->get('/admin/profile','Admin\User::profile',["filter"=>"auth"]);
$routes->post('/admin/profile/update','Admin\User::updateProfile',["filter"=>"auth"]);
$routes->post('/admin/profile/changePass','Admin\User::changePassword',["filter"=>"auth"]);

// Laporan Routes
$routes->get('/admin/laporan', 'Admin\Laporan::index', ["filter"=>"role:1"]);
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
