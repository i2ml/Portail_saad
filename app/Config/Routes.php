<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('saads', 'SaadController::index');
$routes->get('connexion', 'NouvelleConnexionController::index');
$routes->get('connexionReussie', 'NouvelleConnexionController::success', ['filter' => 'authGuard']);
$routes->match(['get', 'post'],'userList', 'AdminController::userList', ['filter' =>  ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'saadsList', 'AdminController::saadsList', ['filter' =>  ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'disconnect', 'AdminController::disconnect', ['filter' => 'authGuard']);

$routes->match(['get', 'post'],'saadsList', 'AdminController::saadsList', ['filter' =>  ['authGuard','superAdminGuard']]);

//Supprimer saad
$routes->match(['get', 'post'],'AdminController/saadDelete/(:segment)', 'AdminController::saadDelete/$1', ['filter' => ['authGuard','superAdminGuard']]);

//Créer saad
$routes->match(['get', 'post'],'AdminController/storeSaad/', 'AdminController::storeSaad', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'createSaad', 'AdminController::createSaad', ['filter' => ['authGuard','superAdminGuard']]);

//Modifier saad
$routes->match(['get', 'post'],'AdminController/storeSaad/(:segment)', 'AdminController::storeSaad/$1', ['filter' => ['authGuard']]);
$routes->match(['get', 'post'],'AdminController/createSaad/(:segment)', 'AdminController::createSaad/$1', ['filter' => ['authGuard']]);
$routes->match(['get', 'post'],'createSaad/(:segment)', 'AdminController::createSaad', ['filter' => ['authGuard']]);

//Supprimer user
$routes->match(['get', 'post'],'AdminController/userDelete/(:segment)', 'AdminController::userDelete/$1', ['filter' => ['authGuard','superAdminGuard']]);

//Créer user
$routes->match(['get', 'post'],'AdminController/store/', 'AdminController::store', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'AdminController/createUser/', 'AdminController::createUser', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'AdminController/createUser/(:any)', 'AdminController::createUser', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'createUser', 'AdminController::createUser', ['filter' => ['authGuard','superAdminGuard']]);

//Modifier user
$routes->match(['get', 'post'],'AdminController/upgradeUser/(:segment)', 'AdminController::userDowngrade/$1', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'AdminController/downgradeUser/(:segment)', 'AdminController::userUpgrade/$1', ['filter' => ['authGuard','superAdminGuard']]);

/*
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
