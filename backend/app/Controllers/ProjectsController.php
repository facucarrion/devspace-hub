<?php

namespace App\Controllers;

use App\Models\ProjectsModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class ProjectsController extends BaseController{
  use APIResponseTrait;

  private $projectsModel;

  public function __construct() {
    $this->projectsModel = new ProjectsModel();
  }

  public function getAll() {
    $projects = $this->projectsModel->findAll();
    return $this->respond($projects, 200);
  }

  public function getById($id) {
    $project = $this->projectsModel->find($id);

    if ($project) {
      return $this->respond($project, 200);
    } else {
      return $this->failNotFound('No project found with id ' . $id, 404);
    }
  }

  public function create() {
    $project = $this->request->getJSON();

    
    $newProject = $this->projectsModel->insert([
      'title' => $project->title,
      'description' => $project->description,
      'upvotes' => 0,
      'id_user_creator' => $project->id_user_creator,
      'created_at' => date('Y-m-d H:i:s')
    ]);

    if ($newProject) {
      return $this->respondCreated($this->projectsModel->find($newProject), 'Project created!');
    } else {
      return $this->fail($this->projectsModel->errors(), 400);
    }
  }

  public function edit($id) {
    $project = $this->request->getJSON();
    $projectToEdit = $this->projectsModel->find($id);

    if (!$projectToEdit) {
      return $this->failNotFound('No project found with id ' . $id, 404);
    }

    $newProject = [
      'title' => $project->title ?? $projectToEdit['title'],
      'description' => $project->description ?? $projectToEdit['description'],
      'upvotes' => $project->upvotes ?? $projectToEdit['upvotes'],
      'id_user_creator' => $project->id_user_creator ?? $projectToEdit['id_user_creator']
    ];

    $updatedProject = $this->projectsModel->update($id, $newProject);

    if ($updatedProject) {
      return $this->respondUpdated($project, 'Project updated!');
    } else {
      return $this->fail($this->projectsModel->errors(), 400);
    }
  }

  public function delete($id) {
    if ($this->projectsModel->delete($id)) {
      return $this->respondDeleted(['id_project' => $id], 'Project deleted!');
    } else {
      return $this->fail($this->projectsModel->errors(), 400);
    }
  }

}