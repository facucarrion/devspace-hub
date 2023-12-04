<?php

namespace App\Controllers;

use App\Models\TagsProjectModel;
use App\Models\TagsModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class TagsProjectController extends BaseController
{
  use APIResponseTrait;

  private $tagsProjectModel;
  private $tagsModel;

  public function __construct()
  {
    $this->tagsProjectModel = new TagsProjectModel();
    $this->tagsModel = new TagsModel();
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

  public function insertTags()
  {
    $tagsProject = $this->request->getJSON();

    $insertedTagsProject = $this->tagsProjectModel->insertBatch($tagsProject);

    if ($insertedTagsProject) {
      return $this->respondCreated($this->tagsProjectModel->find($insertedTagsProject), 'TagsProject created!');
    } else {
      return $this->fail($this->tagsProjectModel->errors(), 400);
    }
  }

  public function insertTagsAlternative($id_project)
  {

    $json = $this->request->getJSON();

    $array_tags = [
      $json->alcance,
      $json->naturaleza,
      $json->proposito,
      $json->dominio,
      $json->tipo,
      $json->plataforma
    ];

    foreach ($array_tags as $id_tag) {
      $tag = $this->tagsModel->find($id_tag);


      if ($this->tagsProjectModel->projectHasTagType($id_project, $tag['id_tag_type'])) {
        $this->tagsProjectModel->deleteByTypeAndProject($id_project, $tag['id_tag_type']);
      }

      $this->tagsProjectModel->insert([
        'id_project' => $id_project,
        'id_tag' => $id_tag
      ]);
    }

    return $this->respond($this->tagsProjectModel->getTagsByProject($id_project));
  }


  public function getTagsByProject($id_project)
  {
    return $this->respond($this->tagsProjectModel->getTagsByProject($id_project));
  }
}
