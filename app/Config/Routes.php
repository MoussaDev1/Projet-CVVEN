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
$routes->setAutoRoute(false);


/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
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



$routes->get('/', 'Auth::index');
$routes->get('/header', 'Home::view/header');
$routes->get('/Auth', 'Auth::index');
$routes->get('/Auth/view/(:segment)','Auth::view/$1');
$routes->get('/Auth/deconnexion', 'Auth::deconnexion');
$routes->get('/home', 'Auth::view/home');
$routes->post('/Auth/connexion', 'Auth::connexion');
$routes->post('/Auth/registerForm', 'Auth::registerForm');
$routes->post('/Auth/forgetPassword', 'Auth::forgetPassword');
$routes->post('/Auth/password_reset_confirmation', 'Auth::formPassword');

$routes->get('/MyReservations', 'MyReservations::index');
$routes->post('/MyReservations/annulerReservation', 'MyReservations::annulerReservation');
$routes->get('/Administration', 'Administration::index');
$routes->post('/Administration', 'Administration::index');
$routes->post('/Administration/valideeReservation', 'Administration::valideeReservation');
$routes->get('/Affichage','Affichage::index');
$routes->post('affichage/create-reservation', 'Affichage::createReservation');
$routes->post('MyReservations/contactez-administration', 'MyReservation::contactez-administration');

