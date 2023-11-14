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
      return $this->respondDeleted(['id_projects_user' => $id], 'ProjectsUser deleted!');
    } else {
      return $this->fail($this->projectUsersModel->errors(), 400);
    }
  }

  public function getCollaborators($id) {
    if (!$this->projectsModel->find($id)) {
      return $this->failNotFound('No projectsUser found with id ' . $id, 404);
    }

    $collaborators = $this->projectUsersModel->getCollaborators($id);
    return $this->respond($collaborators, 200);
  }

  public function getCollaboratorsWithLimit($id, $limit = 5) {
    $limit = $this->request->getVar('limit') ?? $limit;

    $collaborators = $this->projectUsersModel->getCollaboratorsWhitLimit($id, $limit);
    return $this->respond($collaborators, 200);
  }
  public function upvotes($id)
  {
    $upvotes = $this->projectsModel->upvotes($id);

    if ($upvotes) {
      return $this->respondUpdated([
        "upvotes" => $this->projectsModel->find($id)['upvotes']
      ]);
    } else {
      return $this->fail([
        "upvotes" => $this->projectsModel->errors()
      ]);
    }
  }
  
  public function unvotes($id)
  {
    $unvotes = $this->projectsModel->unvotes($id);

    if ($unvotes) {
      return $this->respondUpdated([
        "upvotes" => $this->projectsModel->find($id)['upvotes']
      ]);
    } else {
      return $this->fail([
        "upvotes" => $this->projectsModel->errors()
      ]);
    }
  }

  public function checkUpvote()
  {
    $json = $this->request->getJSON();

    $id_project = $json->id_project;
    $id_user = $json->id_user;

    $projectUsers = $this->projectUsersModel->isUpvoted($id_project, $id_user);
    
    $isUpvoted = false;

    if(count($projectUsers) == 0) {
      $this->projectUsersModel->insert([
        'id_project' => $id_project,
        'id_user'    => $id_user,
        'upvotes'    => 1
      ]);
    } else {
      $isUpvoted = true;
    }

    return $this->respond($projectUsers, 200);
  }

}
