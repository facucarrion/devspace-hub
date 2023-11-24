<?php

namespace App\Controllers;

use App\Models\ProjectUsersModel;
use App\Models\ProjectsModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class ProjectUsersController extends BaseController
{
  use APIResponseTrait;

  private $projectsModel;
  private $projectUsersModel;

  public function __construct()
  {
    $this->projectUsersModel = new ProjectUsersModel();
    $this->projectsModel = new ProjectsModel();
  }

  public function getAll()
  {
    $projectsUser = $this->projectUsersModel->findAll();
    return $this->respond($projectsUser, 200);
  }

  public function getById($id)
  {
    $projectsUser = $this->projectUsersModel->find($id);

    if ($projectsUser) {
      return $this->respond($projectsUser, 200);
    } else {
      return $this->failNotFound('No projectsUser found with id ' . $id, 404);
    }
  }

  public function create()
  {
    $projectsUser = $this->request->getJSON();

    $newProjectsUser = $this->projectUsersModel->insert([
      'id_project' => $projectsUser->id_project,
      'id_user'    => $projectsUser->id_user,
      'is_editor'  => $projectsUser->is_editor
    ]);

    if ($newProjectsUser) {
      return $this->respondCreated($this->projectUsersModel->find($newProjectsUser), 'ProjectsUser created!');
    } else {
      return $this->fail($this->projectUsersModel->errors(), 400);
    }
  }

  public function edit($id)
  {
    $projectsUser = $this->request->getJSON();

    if ($this->projectUsersModel->update($id, [
      'id_project' => $projectsUser->id_project,
      'id_user'    => $projectsUser->id_user,
      'is_editor'  => $projectsUser->is_editor
    ])) {
      $projectsUser->id_projectsUser = $id;

      return $this->respondUpdated($projectsUser, 'ProjectsUser updated!');
    } else {
      return $this->fail($this->projectUsersModel->errors(), 400);
    }
  }

  public function delete($id)
  {
    if ($this->projectUsersModel->delete($id)) {
      return $this->respondDeleted(['id_project_users' => $id], 'ProjectsUser deleted!');
    } else {
      return $this->fail($this->projectUsersModel->errors(), 400);
    }
  }

  public function getCollaborators($id)
  {
    if (!$this->projectsModel->find($id)) {
      return $this->failNotFound('No project found with id ' . $id, 404);
    }

    $collaborators = $this->projectUsersModel->getCollaborators($id);
    return $this->respond($collaborators, 200);
  }

  public function getCollaboratorsWithLimit($id, $limit = 5)
  {
    $limit = $this->request->getVar('limit') ?? $limit;

    $collaborators = $this->projectUsersModel->getCollaboratorsWhitLimit($id, $limit);
    return $this->respond($collaborators, 200);
  }


  public function isUpvoted()
  {
    $json = $this->request->getJSON();

    $id_project = $json->id_project;
    $id_user = $json->id_user;

    $projectUsers = $this->projectUsersModel->getProjectUsers($id_project, $id_user);

    if (count($projectUsers) == 0 || $projectUsers[0]["upvote"] == 0) {
      return $this->respond(["isUpvoted" => false]);
    } else {
      return $this->respond(["isUpvoted" => true]);
    }
  }

  public function upvote()
  {
    $json = $this->request->getJSON();

    $id_project = $json->id_project;
    $id_user = $json->id_user;

    $projectUsers = $this->projectUsersModel->getProjectUsers($id_project, $id_user);

    if (count($projectUsers) == 0) {
      $this->projectUsersModel->insert([
        "id_rol" => 3,
        "id_project" => $id_project,
        "id_user" => $id_user,
        "is_editor" => 0,
        "upvote" => 0
      ]);

      $projectUsers = $this->projectUsersModel->getProjectUsers($id_project, $id_user);
    }

    if ($projectUsers[0]["upvote"] == 0) {
      $this->projectUsersModel->update($projectUsers[0]["id_project_user"], [
        "upvote" => 1
      ]);
    } else {
      $this->projectUsersModel->update($projectUsers[0]["id_project_user"], [
        "upvote" => 0
      ]);
    }

    return $this->respond(["upvotes" => $this->projectsModel->getProject($projectUsers[0]["id_project"])["upvotes"]]);
  }

  public function isCollaborator()
  {
    $json = $this->request->getJSON();

    $id_project = $json->id_project;
    $id_user = $json->id_user;

    $projectUsers = $this->projectUsersModel->getProjectUsers($id_project, $id_user);

    if (count($projectUsers) == 0 || $projectUsers[0]['id_rol'] != 1) {
      return $this->respond(["isCollaborator" => false]);
    } else {
      return $this->respond(["isCollaborator" => true]);
    }
  }

  public function collab()
  {
    $json = $this->request->getJSON();

    $id_project = $json->id_project;
    $id_user = $json->id_user;

    $projectUsers = $this->projectUsersModel->getProjectUsers($id_project, $id_user);

    if (count($projectUsers) == 0) {
      $this->projectUsersModel->insert([
        "id_rol" => 3,
        "id_project" => $id_project,
        "id_user" => $id_user,
        "is_editor" => 0,
        "upvote" => 0
      ]);

      $projectUsers = $this->projectUsersModel->getProjectUsers($id_project, $id_user);
    }

    if ($projectUsers[0]["id_rol"] == 1) {
      $this->projectUsersModel->update($projectUsers[0]["id_project_user"], [
        "id_rol" => 3
      ]);
    } else {
      $this->projectUsersModel->update($projectUsers[0]["id_project_user"], [
        "id_rol" => 1
      ]);
    }

    return $this->respond(['success' => true]);
  }
}
