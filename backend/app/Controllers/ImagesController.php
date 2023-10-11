<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait as APIResponseTrait;
use App\Models\ImagesModel;

class ImagesController extends BaseController {
  use APIResponseTrait;

  private $imagesModel;

  public function __construct() {
    $this->imagesModel = new ImagesModel();
  }

  public function loadImage() {
    $file = $this->request->getFile('avatar');

    $fileName = $file->getRandomName();
    $avatarPath = 'uploads/avatars';

    $file->move($avatarPath, $fileName);

    $newAvatarPath = base_url($avatarPath . '/' . $fileName);

    $data = [
      'path' => $newAvatarPath
    ];

    $this->imagesModel->insert($data);

    return $this->respondCreated($data);
  }
}