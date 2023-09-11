<?php
namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class UsersController extends BaseController{
  use ApiResponseTrait; 

  private $usersModel;

  public function __construct(){
    $this->usersModel = new UsersModel();
  }

  public function getAll(){
    $users = $this->usersModel->findAll();
    return $this->respond($users, 200);
  }

  public function getById($id){
    $user = $this->usersModel->find($id);

    if($user){
      return $this->respond($user, 200);
    }else{
      return $this->failNotFound('No user found with id ' . $id, 404);
    }
  }

  public function getByUsername($username){
    $user = $this->usersModel->where('username', $username)->first();

    if($user){
      return $this->respond($user, 200);
    }else{
      return $this->failNotFound('No user found with username ' . $username, 404);
    }
  }

  public function create(){
    $user = $this->request->getJSON();
    $hashedPassword = password_hash($user->password, PASSWORD_BCRYPT);

    $newUser = $this->usersModel->insert([
      'username' => $user->username,
      'display_name' => $user->display_name,
      'email' => $user->email,
      'password' => $hashedPassword,
      'created_at' => date('Y-m-d H:i:s')
    ]);

    if($newUser){
      return $this->respondCreated($this->usersModel->find($newUser), 'User created!');
    }else{
      return $this->fail($this->usersModel->errors(), 400);
    }
  }

  public function edit($id){
    $user = $this->request->getJSON();

    if($this->usersModel->update($id, [
      'username' => $user->username,
      'display_name' => $user->display_name,
      'email' => $user->email,
      'password' => $user->password
    ])){
      $user->id_user = $id;

      return $this->respondUpdated($user, 'User updated!');
    }else{
      return $this->fail($this->usersModel->errors(), 400);
    }
  }

  public function delete($id){
    if($this->usersModel->delete($id)){
      return $this->respondDeleted(['id_user' => $id], 'User deleted!');
    }else{
      return $this->fail($this->usersModel->errors(), 400);
    }
  }

  public function getRandomUsers($limit = 5){
    $users = $this->usersModel->getRandomUsers($limit);

    return $this->respond($users, 200);
  }
}