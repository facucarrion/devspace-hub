<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait as APIResponseTrait;
use App\Models\UsersModel;
use App\Models\UserLinksModel;

class UsersController extends BaseController
{
  use ApiResponseTrait;

  private $usersModel;
  private $userLinksModel;

  public function __construct()
  {
    $this->usersModel = new UsersModel();
    $this->userLinksModel = new UserLinksModel();
  }

  public function getAll()
  {
    $users = $this->usersModel->findAll();
    return $this->respond($users, 200);
  }

  public function getById($id)
  {
    $user = $this->usersModel->find($id);

    if ($user) {
      return $this->respond($user, 200);
    } else {
      return $this->failNotFound('No user found with id ' . $id, 404);
    }
  }

  public function getByUsername($username)
  {
    $user = $this->usersModel->getByUsername($username);

    if ($user) {
      $user['links'] = $this->userLinksModel->getByUser($user['id_user']);
      return $this->respond($user, 200);
    } else {
      return $this->failNotFound('No user found with username ' . $username, 404);
    }
  }

  public function create()
  {
    $user = $this->request->getJSON();
    $hashedPassword = password_hash($user->password, PASSWORD_BCRYPT);

    $newUser = $this->usersModel->insert([
      'username' => $user->username,
      'display_name' => $user->display_name,
      'email' => $user->email,
      'password' => $hashedPassword,
      'created_at' => date('Y-m-d H:i:s')
    ]);

    if ($newUser) {
      return $this->respondCreated($this->usersModel->find($newUser), 'User created!');
    } else {
      return $this->fail($this->usersModel->errors(), 400);
    }
  }

  public function edit($id)
  {
    $json = $this->request->getJSON();

    $newData = [
      'username' => $json->username,
      'display_name' => $json->display_name,
      'email' => $json->email
    ];

    $query = $this->usersModel->update($id, $newData);

    if ($query) {
      return $this->respondUpdated($this->usersModel->find($id), 'User updated!');
    } else {
      return $this->fail($this->usersModel->errors(), 400);
    }
  }

  public function editAvatar($id)
  {
    $avatar = $this->request->getFile('avatar');

    $uploadPath = NULL;

    if (!$avatar->isValid()) {
      $avatar = NULL;
    } else if (!str_contains($avatar->getMimeType(), 'image')) {
      return $this->fail('File is not an image', 400);
    } else {
      $newAvatarName = $avatar->getRandomName();
      $uploads = 'img/avatars';
      $avatar->move($uploads, $newAvatarName);
      $uploadPath = base_url($uploads . '/' . $newAvatarName);
    }

    $newData = [
      'avatar' => $uploadPath
    ];

    $query = $this->usersModel->update($id, $newData);

    if ($query) {
      return $this->respondUpdated($this->usersModel->find($id), 'Avatar updated!');
    } else {
      return $this->fail($this->usersModel->errors(), 400);
    }
  }

  public function editPassword($id)
  {
    $json = $this->request->getJSON();

    $lastPassword = $json->last_password;
    $newPassword = $json->new_password;
    $repeatPassword = $json->repeat_new_password;

    $user = $this->usersModel->find($id);

    if ($newPassword != $repeatPassword) {
      return $this->fail('Password confirmation does not match', 400);
    }

    if (!password_verify($lastPassword, $user['password'])) {
      return $this->fail('Wrong password', 400);
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    $newData = [
      'password' => $hashedPassword
    ];

    $query = $this->usersModel->update($id, $newData);

    if ($query) {
      return $this->respondUpdated($this->usersModel->find($id), 'Password updated!');
    } else {
      return $this->fail($this->usersModel->errors(), 400);
    }
  }

  public function delete($id)
  {
    if ($this->usersModel->delete($id)) {
      return $this->respondDeleted(['id_user' => $id], 'User deleted!');
    } else {
      return $this->fail($this->usersModel->errors(), 400);
    }
  }

  public function getRandomUsers($ownUser)
  {
    $limit = $this->request->getVar('limit') ?? 5;

    $this->respond([
      'limit' => $limit,
      'ownUser' => $ownUser
    ]);

    $users = $this->usersModel->getRandomUsers($limit, $ownUser);

    return $this->respond($users, 200);
  }

  public function searchUsers()
  {
    $name = $this->request->getVar('q');

    $users = $this->usersModel->searchUsers($name);

    return $this->respond($users, 200);
  }
}
