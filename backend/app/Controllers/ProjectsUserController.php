<?php

namespace App\Controllers;

use App\Models\ProjectsUserModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class ProjectsUserController extends BaseController{
    use APIResponseTrait;

    private $projectsUserModel;

    public function __construct() {
        $this->projectsUserModel = new ProjectsUserModel();
    }

    public function getAll() {
        $projectsUser = $this->projectsUserModel->findAll();
        return $this->respond($projectsUser, 200);
    }

    public function getById($id) {
        $projectsUser = $this->projectsUserModel->find($id);
    
        if ($projectsUser) {
          return $this->respond($projectsUser, 200);
        } else {
          return $this->failNotFound('No projectsUser found with id ' . $id, 404);
        }
      }
    
      public function create() {
        $projectsUser = $this->request->getJSON();
    
        $newProjectsUser = $this->projectUserModel->insert([
          'id_project' => $projectsUser->id_project,
          'id_user'    => $projectsUser->id_user,
          'is_editor'  => $projectsUser->is_editor
        ]);
    
        if($newProjectsUser) {
          return $this->respondCreated($this->projectsUserModel->find($newProjectsUser), 'ProjectsUser created!');
        } else {
          return $this->fail($this->projectsUserModel->errors(), 400);
        }
      }
    
      public function edit($id) {
        $projectsUser = $this->request->getJSON();
    
        if ($this->projectsUserModel->update($id, [
            'id_project' => $projectsUser->id_project,
            'id_user'    => $projectsUser->id_user,
            'is_editor'  => $projectsUser->is_editor
        ])) {
          $projectsUser->id_projectsUser = $id;
    
          return $this->respondUpdated($projectsUser, 'ProjectsUser updated!');
        } else {
          return $this->fail($this->projectsUserModel->errors(), 400);
        }
      }
    
      public function delete($id) {
        if ($this->projectsUserModel->delete($id)) {
          return $this->respondDeleted(['id_projects_user' => $id], 'ProjectsUser deleted!');
        } else {
          return $this->fail($this->projectsUserModel->errors(), 400);
        }
      }
}