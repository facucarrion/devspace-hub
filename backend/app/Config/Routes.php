<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('api', ['filter' => 'cors'], function($routes) {
    $routes->group('tags', function($routes) {
        $routes->get('/', 'TagsController::getAll');
        $routes->get('(:num)', 'TagsController::getById/$1');
        $routes->post('/', 'TagsController::create');
        $routes->delete('(:num)', 'TagsController::delete/$1');
        $routes->put('(:num)', 'TagsController::edit/$1');
    });

    $routes->group('follows', function($routes) {
        $routes->get('/', 'FollowsController::getAll');
        $routes->get('(:num)', 'FollowsController::getById/$1');
        $routes->post('/', 'FollowsController::create');
        $routes->delete('(:num)', 'FollowsController::delete/$1');
        $routes->get('followers/(:num)', 'FollowsController::getFollowersOfUser/$1');
        $routes->get('follows/(:num)', 'FollowsController::getFollowsOfUser/$1');
        $routes->get('count/(:num)', 'FollowsController::getFollowCounts/$1');
        $routes->post('follow/(:num)','FollowsController::follow/$1');
        $routes->delete('unfollow/(:num)','FollowsController::unFollow/$1');
    });

    $routes->group('tag_projects', function($routes) {
        $routes->get('/', 'TagsProjectController::getAll');
        $routes->get('(:num)', 'TagsProjectController::getById/$1');
        $routes->post('/', 'TagsProjectController::create');
        $routes->delete('(:num)', 'TagsProjectController::delete/$1');
    });

    $routes->group('users', function($routes) {
        $routes->get('/', 'UsersController::getAll');
        $routes->post('/', 'UsersController::create');
        $routes->get('(:num)', 'UsersController::getById/$1');
        $routes->get('username/(:any)', 'UsersController::getByUsername/$1');
        $routes->delete('(:num)', 'UsersController::delete/$1');
        $routes->put('(:num)', 'UsersController::edit/$1');
        $routes->get('random/(:num)', 'UsersController::getRandomUsers/$1');
    });

    $routes->group('projects', function($routes) {
        $routes->get('/', 'ProjectsController::getAll');
        $routes->get('(:num)', 'ProjectsController::getById/$1');
        $routes->post('/', 'ProjectsController::create');
        $routes->delete('(:num)', 'ProjectsController::delete/$1');
        $routes->patch('(:num)', 'ProjectsController::edit/$1');
        $routes->get('random/(:num)', 'ProjectsController::getRandomProjects/$1');
    });

    $routes->group('projects-user', function($routes){
        $routes->get('/', 'projectsUserController::getAll');
        $routes->get('(:num)', 'ProjectsUserController::getById/$1');
        $routes->get('collab/(:num)', 'ProjectsUserController::getCollaborators/$1');
        $routes->post('/', 'ProjectsUserController::create');
        $routes->delete('(:num)', 'ProjectsUserController::delete/$1');
        $routes->patch('(:num)', 'ProjectsUserController::edit/$1');
    });

    $routes->group('auth', function ($routes) {
        $routes->post('login', 'AuthController::login');
        $routes->post('register', 'AuthController::register');
    });

    $routes->group('images', function ($routes) {
        $routes->post('/', 'ImagesController::loadImage');
    });
});

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
