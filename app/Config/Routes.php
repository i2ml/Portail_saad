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
$routes->match(['get', 'post'],'userList', 'PersonController::userList', ['filter' =>  ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'saadsList', 'SaadController::saadsList', ['filter' =>  ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'disconnect', 'PersonController::disconnect', ['filter' => 'authGuard']);

$routes->match(['get', 'post'],'saadsList', 'SaadController::saadsList', ['filter' =>  ['authGuard','superAdminGuard']]);

//Envoyer un email
$routes->match(['get', 'post'],'PersonController/sendEmailTest', 'PersonController::sendEmailTest', ['filter' =>  ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'PersonController/resetPassword/(:segment)', 'PersonController::resetPassword/$1', ['filter' => ['authGuard','superAdminGuard']]);

//Supprimer saad
$routes->match(['get', 'post'],'SaadController/saadDelete/(:segment)', 'SaadController::saadDelete/$1', ['filter' => ['authGuard','superAdminGuard']]);

//lier des saads à des managers
$routes->match(['get', 'post'],'SaadListController/saadLink/', 'SaadListController::saadLink', ['filter' =>  ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'SaadController/saadLink/(:segment)', 'SaadListController::saadLink/$1', ['filter' =>  ['authGuard','superAdminGuard']]);

//Créer saad
$routes->match(['get', 'post'],'SaadController/storeSaad/', 'SaadController::storeSaad', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'createSaad', 'SaadController::createSaad', ['filter' => ['authGuard','superAdminGuard']]);

//Modifier saad
$routes->match(['get', 'post'],'SaadController/storeSaad/(:segment)', 'SaadController::storeSaad/$1', ['filter' => ['authGuard']]);
$routes->match(['get', 'post'],'SaadController/createSaad/(:segment)', 'SaadController::createSaad/$1', ['filter' => ['authGuard']]);
$routes->match(['get', 'post'],'createSaad/(:segment)', 'SaadController::createSaad', ['filter' => ['authGuard']]);

//Supprimer user
$routes->match(['get', 'post'],'PersonController/userDelete/(:segment)', 'PersonController::userDelete/$1', ['filter' => ['authGuard','superAdminGuard']]);

//Créer user
$routes->match(['get', 'post'],'PersonController/store/', 'PersonController::store', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'PersonController/createUser/', 'PersonController::createUser', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'PersonController/createUser/(:any)', 'PersonController::createUser', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'createUser', 'PersonController::createUser', ['filter' => ['authGuard','superAdminGuard']]);

//Modifier user
$routes->match(['get', 'post'],'PersonController/upgradeUser/(:segment)', 'PersonController::userDowngrade/$1', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'PersonController/downgradeUser/(:segment)', 'PersonController::userUpgrade/$1', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'PersonController/changePassword', 'PersonController::changePassword', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'changePassword', 'PersonController::changePassword', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'PersonController/changePassword/(:segment)', 'PersonController::changePassword/$1', ['filter' => ['authGuard','superAdminGuard']]);
$routes->match(['get', 'post'],'changePassword/(:segment)', 'PersonController::changePassword/$1', ['filter' => ['authGuard','superAdminGuard']]);

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
