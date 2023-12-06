<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait as APIResponseTrait;
use App\Models\UserLinksModel;
use App\Models\UsersModel;

class UserLinksController extends BaseController
{
  use APIResponseTrait;

  private $userLinksModel;
  private $usersModel;

  public function __construct()
  {
    $this->userLinksModel = new UserLinksModel();
    $this->usersModel = new UsersModel();
  }

  public function getByUser($id)
  {
    $userLinks = $this->userLinksModel->getByUser($id);
    return $this->respond($userLinks, 200);
  }

  public function getByUsername($username)
  {
    if (!$this->usersModel->getByUsername($username)) {
      return $this->failNotFound('User not found!');
    }

    $userLinks = $this->userLinksModel->getByUsername($username);
    return $this->respond($userLinks, 200);
  }

  public function create()
  {
    $userLink = $this->request->getJSON();

    $insertedUserLink = $this->userLinksModel->insert([
      'id_user' => $userLink->id_user,
      'link' => $userLink->link
    ]);

    if ($insertedUserLink) {
      return $this->respondCreated($this->userLinksModel->find($insertedUserLink), 'UserLink created!');
    } else {
      return $this->fail($this->userLinksModel->errors(), 400);
    }
  }

  public function delete($id)
  {
    if ($this->userLinksModel->delete($id)) {
      return $this->respondDeleted(['id_user_link' => $id], 'UserLink deleted!');
    } else {
      return $this->fail($this->userLinksModel->errors(), 400);
    }
  }

  public function getUserLinks($id)
  {
    $userLinks = $this->userLinksModel->getByUsername($id);
    return $this->respond($userLinks, 200);
  }
}
