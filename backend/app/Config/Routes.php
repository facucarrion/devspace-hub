<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->group('api', ['filter' => 'cors'], function ($routes) {
    $routes->group('tags', function ($routes) {
        $routes->get('/', 'TagsController::getAll');
        $routes->get('(:num)', 'TagsController::getById/$1');
        $routes->post('/', 'TagsController::create');
        $routes->delete('(:num)', 'TagsController::delete/$1');
        $routes->put('(:num)', 'TagsController::edit/$1');
    });

    $routes->group('follows', function ($routes) {
        $routes->get('/', 'FollowsController::getAll');
        $routes->get('(:num)', 'FollowsController::getById/$1');
        $routes->post('/', 'FollowsController::create');
        $routes->delete('(:num)', 'FollowsController::delete/$1');
        $routes->get('followers/(:num)', 'FollowsController::getFollowersOfUser/$1');
        $routes->get('follows/(:num)', 'FollowsController::getFollowsOfUser/$1');
        $routes->get('count/(:num)', 'FollowsController::getFollowCounts/$1');
        $routes->post('follow/(:num)', 'FollowsController::follow/$1');
        $routes->delete('unfollow/(:num)', 'FollowsController::unFollow/$1');
    });

    $routes->group('tag_projects', function ($routes) {
        $routes->get('/', 'TagsProjectController::getAll');
        $routes->get('(:num)', 'TagsProjectController::getById/$1');
        $routes->post('/', 'TagsProjectController::create');
        $routes->delete('(:num)', 'TagsProjectController::delete/$1');
    });

    $routes->group('users', function ($routes) {
        $routes->get('/', 'UsersController::getAll');
        $routes->post('/', 'UsersController::create');
        $routes->get('(:num)', 'UsersController::getById/$1');
        $routes->get('username/(:any)', 'UsersController::getByUsername/$1');
        $routes->delete('(:num)', 'UsersController::delete/$1');
        $routes->put('(:num)', 'UsersController::edit/$1');
        $routes->get('random/(:num)', 'UsersController::getRandomUsers/$1');
    });

    $routes->group('projects', function ($routes) {
        $routes->get('/', 'ProjectsController::getAll');
        $routes->get('(:num)', 'ProjectsController::getById/$1');
        $routes->post('/', 'ProjectsController::create');
        $routes->delete('(:num)', 'ProjectsController::delete/$1');
        $routes->patch('(:num)', 'ProjectsController::edit/$1');
        $routes->get('random/(:num)', 'ProjectsController::getRandomProjects/$1');
        $routes->patch('upvotes/(:num)', 'ProjectsController::upvotes/$1');
    });

    $routes->group('projects-user', function ($routes) {
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

    $routes->group('user_links', function ($routes) {
        $routes->get('/', 'UserLinksController::getAll');
        $routes->get('(:num)', 'UserLinksController::getById/$1');
        $routes->post('/', 'UserLinksController::create');
        $routes->delete('(:num)', 'UserLinksController::delete/$1');
    });

    $routes->group('project_links', function ($routes) {
        $routes->get('/', 'ProjectLinksController::getAll');
        $routes->get('(:num)', 'ProjectLinksController::getById/$1');
        $routes->post('/', 'ProjectLinksController::create');
        $routes->delete('(:num)', 'ProjectLinksController::delete/$1');
    });
});
