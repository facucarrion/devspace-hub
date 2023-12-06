<?php

namespace App\Controllers;

use App\Models\ProjectsModel;
use App\Models\ProjectUsersModel;
use App\Models\ProjectLinksModel;
use App\Models\TagsProjectModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class ProjectsController extends BaseController
{
  use APIResponseTrait;

  private $projectsModel;
  private $projectUsersModel;
  private $projectLinksModel;
  private $projectTagsModel;

  public function __construct()
  {
    $this->projectsModel = new ProjectsModel();
    $this->projectUsersModel = new ProjectUsersModel();
    $this->projectLinksModel = new ProjectLinksModel();
    $this->projectTagsModel = new TagsProjectModel();
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
      $project['links'] = $this->projectLinksModel->getLinksById($id);
      $project['tags'] = $this->projectTagsModel->getTagsByProject($id);
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

    if (!$logo->isValid()) {
      $logo = NULL;
    } else if (!str_contains($logo->getMimeType(), 'image')) {
      return $this->fail('File is not an image', 400);
    } else {
      $newlogoName = $logo->getRandomName();
      $uploads = 'img/logos';
      $logo->move($uploads, $newlogoName);
      $logoUploadPath = base_url($uploads . '/' . $newlogoName);
    }

    if (!$image->isValid()) {
      $image = NULL;
    } else if (!str_contains($image->getMimeType(), 'image')) {
      return $this->fail('File is not an image', 400);
    } else {
      $newimageName = $image->getRandomName();
      $uploads = 'img/images';
      $image->move($uploads, $newimageName);
      $imageUploadPath = base_url($uploads . '/' . $newimageName);
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

    if (!$newProjectUser) {
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
    $json = $this->request->getJSON();

    $newData = [
      'title' => $json->title,
      'description' => $json->description,
      'url' => $json->url,
    ];

    $query = $this->projectsModel->update($id, $newData);

    if ($query) {
      return $this->respondUpdated($this->projectsModel->find($id), 'Project updated!');
    } else {
      return $this->fail($this->projectsModel->errors(), 400);
    }
  }

  public function editLogo($id)
  {
    $logo = $this->request->getFile('logo');

    $uploadPath = NULL;

    if (!$logo->isValid()) {
      $logo = NULL;
    } else if (!str_contains($logo->getMimeType(), 'image')) {
      return $this->fail('File is not an image', 400);
    } else {
      $newlogoName = $logo->getRandomName();
      $uploads = 'img/logos';
      $logo->move($uploads, $newlogoName);
      $uploadPath = base_url($uploads . '/' . $newlogoName);
    }

    $newData = [
      'logo' => $uploadPath
    ];

    $query = $this->projectsModel->update($id, $newData);

    if ($query) {
      return $this->respondUpdated($this->projectsModel->find($id), 'Logo updated!');
    } else {
      return $this->fail($this->projectsModel->errors(), 400);
    }
  }

  public function editImage($id)
  {
    $image = $this->request->getFile('image');

    $uploadPath = NULL;

    if (!$image->isValid()) {
      $image = NULL;
    } else if (!str_contains($image->getMimeType(), 'image')) {
      return $this->fail('File is not an image', 400);
    } else {
      $newimageName = $image->getRandomName();
      $uploads = 'img/images';
      $image->move($uploads, $newimageName);
      $uploadPath = base_url($uploads . '/' . $newimageName);
    }

    $newData = [
      'image' => $uploadPath
    ];

    $query = $this->projectsModel->update($id, $newData);

    if ($query) {
      return $this->respondUpdated($this->projectsModel->find($id), 'image updated!');
    } else {
      return $this->fail($this->projectsModel->errors(), 400);
    }
  }

  public function delete($id)
  {

    $projectToDelete = $this->projectsModel->find($id);

    if (!$projectToDelete) {
      return $this->failNotFound('No project found with id ' . $id, 404);
    }

    $this->projectLinksModel->deleteProjectLinks($id);
    $this->projectUsersModel->deleteProjectUsers($id);
    $this->projectTagsModel->deleteTagsProject($id);

    $this->projectsModel->delete($id);

    return $this->respondDeleted($projectToDelete, 'Project deleted!');
  }

  public function getRandomProjects($ownUser)
  {
    $limit = $this->request->getVar('limit') ?? 5;

    $projects = $this->projectsModel->getRandomProjects($limit, $ownUser);

    $projects = array_map(function ($project) {
      $project['collaborators'] = $this->projectUsersModel->getCollaborators($project['id_project'], 5);
      $project['links'] = $this->projectLinksModel->getLinksById($project['id_project']);
      return $project;
    }, $projects);

    return $this->respond($projects, 200);
  }

  public function searchProjects()
  {
    $name = $this->request->getVar('q') ?? '';

    $projects = $this->projectsModel->searchProjects($name);

    $projects = array_map(function ($project) {
      $project['collaborators'] = $this->projectUsersModel->getCollaborators($project['id_project']);
      $project['links'] = $this->projectLinksModel->getLinksById($project['id_project']);
      return $project;
    }, $projects);

    return $this->respond($projects, 200);
  }

  public function searchProjectsByTag($tag)
  {
    $projects = $this->projectsModel->searchProjectsByTag($tag);

    $projects = array_map(function ($project) {
      $project['collaborators'] = $this->projectUsersModel->getCollaborators($project['id_project']);
      $project['links'] = $this->projectLinksModel->getLinksById($project['id_project']);
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
