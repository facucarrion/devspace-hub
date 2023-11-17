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
        $routes->post('follow/(:num)', 'FollowsController::follow/$1');
        $routes->delete('unfollow/(:num)', 'FollowsController::unFollow/$1');
        $routes->get('count/(:num)', 'FollowsController::getFollowCounts/$1');

        $routes->get('followers/(:num)', 'FollowsController::getFollowersOfUser/$1');
        $routes->get('follows/(:num)', 'FollowsController::getFollowsOfUser/$1');

        $routes->post('check', 'FollowsController::isFollow');
        $routes->post('/', 'FollowsController::follow');
    });

    $routes->group('tag-projects', function ($routes) {
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
        $routes->get('search/(:any)', 'UsersController::searchUsers/$1/$2');
    });

    $routes->group('projects', function ($routes) {
        $routes->get('/', 'ProjectsController::getAll');
        $routes->get('(:num)', 'ProjectsController::getById/$1');
        $routes->post('/', 'ProjectsController::create');
        $routes->patch('(:num)', 'ProjectsController::edit/$1');
        $routes->delete('(:num)', 'ProjectsController::delete/$1');

        $routes->get('random/(:num)', 'ProjectsController::getRandomProjects/$1');

        $routes->get('search/(:any)', 'ProjectsController::searchProjects/$1');

        $routes->get('collab/(:num)', 'ProjectsController::getProjectsByCollaborator/$1');
        $routes->get('creator/(:num)', 'ProjectsController::getProjectsByCreator/$1');
    });

    $routes->group('project-users', function ($routes) {
        $routes->get('getupvote', 'ProjectUsersController::checkUpvote');
    });

    $routes->group('auth', function ($routes) {
        $routes->post('login', 'AuthController::login');
        $routes->post('register', 'AuthController::register');
    });

    $routes->group('upvotes', function ($routes) {
        $routes->post('/', 'ProjectUsersController::upvote');
        $routes->post('check', 'ProjectUsersController::isUpvoted');
    });

});
