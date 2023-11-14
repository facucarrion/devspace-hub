<?php

namespace App\Controllers;

use App\Models\ProjectsModel;
use App\Models\ProjectUsersModel;
use App\Models\ProjectLinksModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class ProjectsController extends BaseController
{
  use APIResponseTrait;

  private $projectsModel;
  private $projectUsersModel;
  private $projectLinksModel;

  public function __construct()
  {
    $this->projectsModel = new ProjectsModel();
    $this->projectUsersModel = new ProjectUsersModel();
    $this->projectLinksModel = new ProjectLinksModel();
  }

  public function getAll()
  {
    $projects = $this->projectsModel->findAll();
    return $this->respond($projects, 200);
  }

  public function getById($id)
  {
    $project = $this->projectsModel->getProject($id);

    if ($project) {
      $project['collaborators'] = $this->projectUsersModel->getCollaborators($id);
      $project['links'] = $this->projectLinksModel->getLinks($id);
      return $this->respond($project, 200);
    } else {
      return $this->failNotFound('No project found with id ' . $id, 404);
    }
  }

  public function create()
  {
    $title = $this->request->getPost('title');
    $url = $this->request->getPost('url');
    $logo = $this->request->getFile('logo');
    $image = $this->request->getFile('image');
    $id_user_creator = $this->request->getPost('id_user_creator');
    $description = $this->request->getPost('description');

    $logoUploadPath = null;
    $imageUploadPath = null;

    if(!$logo->isValid()) {
      $logo = NULL;
    } else {
      $newLogoName = $logo->getRandomName();
      $logoUploads = 'img/logos';
      $logo->move($logoUploads, $newLogoName);
      $logoUploadPath = base_url($logoUploads . '/' . $newLogoName);
    }

    if(!$image->isValid()) {
      $image = NULL;
    } else {
      $newImageName = $image->getRandomName();
      $imageUploads = 'img/project_images';
      $image->move($imageUploads, $newImageName);
      $imageUploadPath = base_url($imageUploads . '/' . $newImageName);
    }

    $newProject = $this->projectsModel->insert([
      'title' => $title,
      'description' => $description,
      'url' => $url,
      'image' => $imageUploadPath,
      'logo' => $logoUploadPath,
      'created_at' => date('Y-m-d H:i:s')
    ]);
    $newProjectUser = $this->projectUsersModel->insert([
      'id_rol' => 2,
      'id_project' => $newProject,
      'id_user' => $id_user_creator,
      'is_editor' => true,
      'upvote' => false
    ]);

    if(!$newProjectUser) {
      return $this->fail($this->projectUsersModel->errors(), 400);
    }

    if ($newProject) {
      return $this->respondCreated($this->projectsModel->find($newProject), 'Project created!');
    } else {
      return $this->fail($this->projectsModel->errors(), 400);
    }
  }

  public function edit($id)
  {
    $project = $this->request->getJSON();
    $projectToEdit = $this->projectsModel->find($id);

    if (!$projectToEdit) {
      return $this->failNotFound('No project found with id ' . $id, 404);
    }

    $newProject = [
      'title' => $project->title ?? $projectToEdit['title'],
      'description' => $project->description ?? $projectToEdit['description'],
      'id_user_creator' => $project->id_user_creator ?? $projectToEdit['id_user_creator']
    ];

    $updatedProject = $this->projectsModel->update($id, $newProject);

    if ($updatedProject) {
      return $this->respondUpdated($project, 'Project updated!');
    } else {
      return $this->fail($this->projectsModel->errors(), 400);
    }
  }

  public function delete($id)
  {
    if ($this->projectsModel->delete($id)) {
      return $this->respondDeleted(['id_project' => $id], 'Project deleted!');
    } else {
      return $this->fail($this->projectsModel->errors(), 400);
    }
  }

  public function getRandomProjects($ownUser)
  {
    $limit = $this->request->getVar('limit') ?? 5;
    
    $projects = $this->projectsModel->getRandomProjects($limit, $ownUser);

    $projects = array_map(function ($project) {
      $project['collaborators'] = $this->projectUsersModel->getCollaborators($project['id_project'], 5);
      $project['links'] = $this->projectLinksModel->getLinks($project['id_project']);
      return $project;
    }, $projects);

    return $this->respond($projects, 200);
  }

  public function searchProjects($name)
  {
    $projects = $this->projectsModel->searchProjects($name);

    $projects = array_map(function ($project) {
      $project['collaborators'] = $this->projectUsersModel->getCollaborators($project['id_project']);
      $project['links'] = $this->projectLinksModel->getLinks($project['id_project']);
      return $project;
    }, $projects);

    return $this->respond($projects, 200);
  }

  public function searchProjectsByTag($tag)
  {
    $projects = $this->projectsModel->searchProjectsByTag($tag);

    $projects = array_map(function ($project) {
      $project['collaborators'] = $this->projectUsersModel->getCollaborators($project['id_project']);
      $project['links'] = $this->projectLinksModel->getLinks($project['id_project']);
      return $project;
    }, $projects);

    return $this->respond($projects, 200);
  }


  public function getProjectsByCreator($id)
  {
    $projects = $this->projectUsersModel->getProjectsByCreator($id);

    return $this->respond($projects);
  }

  public function getProjectsByCollaborator($id)
  {
    $projects = $this->projectUsersModel->getProjectsByCollaborator($id);

    return $this->respond($projects);
  }

  public function getProjectsByTag($id)
  {
    $projects = $this->projectsModel->getProjectsByTag($id);

    return $this->respond($projects);
  }

}
