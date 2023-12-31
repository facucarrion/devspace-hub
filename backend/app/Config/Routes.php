<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->group('api', ['filter' => 'cors'], function ($routes) {
    $routes->group('users', function ($routes) {
        $routes->get('/', 'UsersController::getAll');
        $routes->get('(:num)', 'UsersController::getById/$1');
        $routes->get('username/(:any)', 'UsersController::getByUsername/$1');

        $routes->post('/', 'UsersController::create');
        $routes->patch('(:num)', 'UsersController::edit/$1');
        $routes->delete('(:num)', 'UsersController::delete/$1');

        $routes->post('editAvatar/(:num)', 'UsersController::editAvatar/$1');
        $routes->patch('editPassword/(:num)', 'UsersController::editPassword/$1');

        $routes->get('random/(:num)', 'UsersController::getRandomUsers/$1');
        $routes->get('search', 'UsersController::searchUsers');

        $routes->get('links/(:any)', 'UserLinksController::getUserLinks/$1');
        $routes->post('links', 'UserLinksController::create');
        $routes->delete('links/(:num)', 'UserLinksController::delete/$1');
    });

    $routes->group('projects', function ($routes) {
        $routes->get('/', 'ProjectsController::getAll');
        $routes->get('(:num)', 'ProjectsController::getById/$1');
        $routes->post('/', 'ProjectsController::create');
        $routes->patch('(:num)', 'ProjectsController::edit/$1');
        $routes->delete('(:num)', 'ProjectsController::delete/$1');

        $routes->get('random/(:num)', 'ProjectsController::getRandomProjects/$1');

        $routes->get('search', 'ProjectsController::searchProjects');
        $routes->patch('collab', 'ProjectUsersController::collab');
        $routes->patch('editor', 'ProjectUsersController::collabEditor');

        $routes->patch('collab/check', 'ProjectUsersController::isCollaborator');
        $routes->patch('editor/check', 'ProjectUsersController::isEditor');

        $routes->get('collab/(:num)', 'ProjectsController::getProjectsByCollaborator/$1');
        $routes->get('creator/(:num)', 'ProjectsController::getProjectsByCreator/$1');
        $routes->get('getCollab/(:num)', 'ProjectUsersController::getCollaborators/$1');

        $routes->patch('edit/(:num)', 'ProjectsController::edit/$1');
        $routes->post('editLogo/(:num)', 'ProjectsController::editLogo/$1');
        $routes->post('editImage/(:num)', 'ProjectsController::editImage/$1');

        $routes->get('links/(:num)', 'ProjectLinksController::getLinksByProjectId/$1');
        $routes->post('links', 'ProjectLinksController::create');
        $routes->delete('links/(:num)', 'ProjectLinksController::delete/$1');

        $routes->post('imagen', 'ProjectsController::probar_imagen');
    });

    $routes->group('auth', function ($routes) {
        $routes->post('login', 'AuthController::login');
        $routes->post('register', 'AuthController::register');
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

    $routes->group('upvotes', function ($routes) {
        $routes->post('/', 'ProjectUsersController::upvote');
        $routes->post('check', 'ProjectUsersController::isUpvoted');
    });

    $routes->group('tags', function ($routes) {
        $routes->get('(:num)', 'TagsController::getAll/$1');
    });

    $routes->group('tag-projects', function ($routes) {
        $routes->get('/', 'TagsProjectController::getAll');
        $routes->get('(:num)', 'TagsProjectController::getById/$1');
        $routes->post('/', 'TagsProjectController::create');
        $routes->delete('(:num)', 'TagsProjectController::delete/$1');
        $routes->post('insert', 'TagsProjectController::insertTags');
        $routes->post('insert_alternative/(:num)', 'TagsProjectController::insertTagsAlternative/$1');
        $routes->get('getTagsByProject/(:num)', 'TagsProjectController::getTagsByProject/$1');
    });
});
