<?php

namespace App\Controllers;

use App\Models\TagsModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class TagsController extends BaseController {
  use APIResponseTrait;

  private $tagsModel;

  public function __construct() {
    $this->tagsModel = new TagsModel();
  }

  public function getAll() {
    $tags = $this->tagsModel->findAll();
    return $this->respond($tags, 200);
  }

  public function getById($id) {
    $tag = $this->tagsModel->find($id);

    if ($tag) {
      return $this->respond($tag, 200);
    } else {
      return $this->failNotFound('No tag found with id ' . $id, 404);
    }
  }

  public function create() {
    $tag = $this->request->getJSON();

    if ($this->tagsModel->insert([
      'tag' => $tag->tag
    ])) {
      $tag->id_tag = $this->tagsModel->getInsertID();

      return $this->respondCreated($tag, 'Tag created!');
    } else {
      return $this->fail($this->tagsModel->errors(), 400);
    }
  }

  public function edit($id) {
    $tag = $this->request->getJSON();

    if ($this->tagsModel->update($id, [
      'tag' => $tag->tag
    ])) {
      $tag->id_tag = $id;

      return $this->respondUpdated($tag, 'Tag updated!');
    } else {
      return $this->fail($this->tagsModel->errors(), 400);
    }
  }

  public function delete($id) {
    if ($this->tagsModel->delete($id)) {
      return $this->respondDeleted(['id_tag' => $id], 'Tag deleted!');
    } else {
      return $this->fail($this->tagsModel->errors(), 400);
    }
  }
}