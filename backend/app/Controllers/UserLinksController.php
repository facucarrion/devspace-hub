<?php

namespace App\Controllers;

use App\Models\UserLinksModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class UserLinksController extends BaseController
{
  use APIResponseTrait;

  private $usersLinkModel;

  public function __construct()
  {
    $this->usersLinkModel = new UserLinksModel();
  }

  public function getAll()
  {
    $usersLink = $this->usersLinkModel->findAll();
    return $this->respond($usersLink, 200);
  }

  public function getById($id)
  {
    $userLink = $this->usersLinkModel->find($id);

    if ($userLink) {
      return $this->respond($userLink, 200);
    } else {
      return $this->failNotFound('No userLink found with id ' . $id, 404);
    }
  }

  public function create()
  {
    $userLink = $this->request->getJSON();

    $insertedUserLink = $this->usersLinkModel->insert([
      'id_user' => $userLink->id_user,
      'link' => $userLink->link
    ]);

    if ($insertedUserLink) {
      return $this->respondCreated($this->usersLinkModel->find($insertedUserLink), 'UserLink created!');
    } else {
      return $this->fail($this->usersLinkModel->errors(), 400);
    }
  }

  public function delete($id)
  {
    if ($this->usersLinkModel->delete($id)) {
      return $this->respondDeleted(['id_user_link' => $id], 'UserLink deleted!');
    } else {
      return $this->fail($this->usersLinkModel->errors(), 400);
    }
  }

  public function getUserLinks($id)
  {
    $userLinks = $this->usersLinkModel->getUserLinks($id);
    return $this->respond($userLinks, 200);
  }
}
