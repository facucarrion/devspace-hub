<?php

namespace App\Controllers;

use App\Models\TagsModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class TagsController extends BaseController {
  use APIResponseTrait;

  private $tagModel;

  public function __construct() {
    $this->tagModel = new TagModel();
  }

  public function getAll() {
    $tags = $this->tagModel->findAll();
    return $this->respond($tags, 200);
  }

  public function getById($id) {
    $tag = $this->tagModel->find($id);

    if ($tag) {
      return $this->respond($tag, 200);
    } else {
      return $this->failNotFound('No tag found with id ' . $id, 404);
    }
  }

  public function create() {
    $tag = $this->request->getJSON();

    if ($this->tagModel->insert([
      'tag' => $tag->tag
    ])) {
      $tag->id_tag = $this->tagModel->getInsertID();

      return $this->respondCreated($tag, 'Tag created!');
    } else {
      return $this->fail($this->tagModel->errors(), 400);
    }
  }

  public function edit($id) {
    $tag = $this->request->getJSON();

    if ($this->tagModel->update($id, [
      'tag' => $tag->tag
    ])) {
      $tag->id_tag = $id;

      return $this->respondUpdated($tag, 'Tag updated!');
    } else {
      return $this->fail($this->tagModel->errors(), 400);
    }
  }

  public function delete($id) {
    if ($this->tagModel->delete($id)) {
      return $this->respondDeleted(['id_tag' => $id], 'Tag deleted!');
    } else {
      return $this->fail($this->tagModel->errors(), 400);
    }
  }
}