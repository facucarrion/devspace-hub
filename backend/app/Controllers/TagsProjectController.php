<?php

namespace App\Controllers;

use App\Models\TagsProjectModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class TagsProjectController extends BaseController
{
  use APIResponseTrait;

  private $tagsProjectModel;

  public function __construct()
  {
    $this->tagsProjectModel = new TagsProjectModel();
  }

  public function getAll()
  {
    $tagsProject = $this->tagsProjectModel->findAll();
    return $this->respond($tagsProject, 200);
  }

  public function getById($id)
  {
    $tagProject = $this->tagsProjectModel->find($id);

    if ($tagProject) {
      return $this->respond($tagProject, 200);
    } else {
      return $this->failNotFound('No tagProject found with id ' . $id, 404);
    }
  }

  public function create()  
  {
    $tagProject = $this->request->getJSON();

    $insertedTagProject = $this->tagsProjectModel->insert([
      'id_project' => $tagProject->id_project,
      'id_tag' => $tagProject->id_tag
    ]);

    if ($insertedTagProject) {
      return $this->respondCreated($this->tagsProjectModel->find($insertedTagProject), 'TagProject created!');
    } else {
      return $this->fail($this->tagsProjectModel->errors(), 400);
    }
  }

  public function delete($id)
  {
    if ($this->tagsProjectModel->delete($id)) {
      return $this->respondDeleted(['id_tags_project' => $id], 'TagProject deleted!');
    } else {
      return $this->fail($this->tagsProjectModel->errors(), 400);
    }
  }

  public function insertTags(){
    $tags = $this->request->getJson();

    for($i = 0; $i < count($tags); $i++){
      $this->tagsProjectModel->insert([
        'id_project' => $tags[$i]->id_project,
        'id_tag' => $tags[$i]->id_tag
      ]);
    }
  }
}
