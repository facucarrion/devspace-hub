<?php 

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;
use Firebase\JWT\JWT;

class AuthController extends BaseController {
  use APIResponseTrait;

  private $usersModel;

  public function __construct() {
    $this->usersModel = new UsersModel();
  }

  public function login() {
    $body = $this->request->getJSON();

    $user = $this->usersModel->where('email', $body->email)->first();
    
    if($user) {
      if(password_verify($body->password, $user['password'])) {
        $tokenData = [
          'iss' => time(),
          'exp' => time() + 60 * 60 * 24,
          'user' => $user
        ];

        $token = JWT::encode($tokenData, $user['password'], 'HS256');

        return $this->respond([
          'user' => $user,
          'token' => $token
        ], 200);
      } else {
        return $this->fail('Wrong password', 400);
      }
    } else {
      return $this->fail('User not found', 404);
    }
  }

  public function register() {
    $user = $this->request->getJSON();

    if($user->password !== $user->repeat_password) {
      return $this->fail('Password confirmation does not match', 400);
    }

    $hashedPassword = password_hash($user->password, PASSWORD_BCRYPT);
    $sameMail = $this->usersModel->where('email', $user->email)->first();

    if($sameMail) {
      return $this->fail('User already exists', 400);
    }

    $newUser = $this->usersModel->insert([
      'username' => $user->username,
      'display_name' => $user->display_name,
      'email' => $user->email,
      'password' => $hashedPassword,
      'created_at' => date('Y-m-d H:i:s')
    ]);


    if($user) {
      return $this->respondCreated($this->usersModel->find($newUser));
    } else {
      return $this->fail('User not registered', 400);
    }
  }

  public function getJwtSecret($id) {
    $user = $this->usersModel->find($id);

    if ($user) {
      return $this->respond([
        'token' => $user['password']
      ], 200);
    } else {
      return $this->fail('User not found', 404);
    }
  }
}