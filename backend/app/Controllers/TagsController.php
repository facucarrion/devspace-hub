<?php

namespace App\Controllers;

use App\Models\TagsModel;
use App\Models\TagsProjectModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class TagsController extends BaseController
{
  use APIResponseTrait;

  private $tagsModel;
  private $tagsProjectModel;

  public function __construct()
  {
    $this->tagsModel = new TagsModel();
    $this->tagsProjectModel = new TagsProjectModel();
  }

  public function getAll($id_project)
  {
    $tagsData = $this->tagsModel->getTags();

    $tags = [];

    foreach ($tagsData as $item) {
      $type = $item['type'];

      if (!isset($tags[$type])) {
        $tags[$type] = [];
      }

      $tags[$type][] = [
        'id_tag' => $item['id_tag'],
        'tag' => $item['tag'],
        'checked' => $this->tagsProjectModel->projectHasTag($id_project, $item['id_tag'])
      ];
    }

    return $this->respond($tags, 200);
  }
}
