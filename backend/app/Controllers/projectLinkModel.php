<?php

namespace App\Controllers;

use App\Models\projectLinkModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class projectLinkController extends BaseController
{
  use APIResponseTrait;

  private $projectsLinkModel;

  public function __construct()
  {
    $this->projectsLinkModel = new projectLinkModel();
  }

  public function getAll()
  {
    $projectsLink = $this->projectsLinkModel->findAll();
    return $this->respond($projectsLink, 200);
  }

  public function getById($id)
  {
    $projectLink = $this->projectsLinkModel->find($id);

    if ($projectLink) {
      return $this->respond($projectLink, 200);
    } else {
      return $this->failNotFound('No projectLink found with id ' . $id, 404);
    }
  }

  public function create()
  {
    $projectLink = $this->request->getJSON();

    $insertedProjectLink = $this->projectsLinkModel->insert([
      'id_project' => $projectLink->id_project,
      'link' => $projectLink->link
    ]);

    if ($insertedProjectLink) {
      return $this->respondCreated($this->projectsLinkModel->find($insertedProjectLink), 'projectLink created!');
    } else {
      return $this->fail($this->projectsLinkModel->errors(), 400);
    }
  }

  public function delete($id)
  {
    if ($this->projectsLinkModel->delete($id)) {
      return $this->respondDeleted(['id_project_link' => $id], 'projectLink deleted!');
    } else {
      return $this->fail($this->projectsLinkModel->errors(), 400);
    }
  }
}
