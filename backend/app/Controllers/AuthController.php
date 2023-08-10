<?php 

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class AuthController extends BaseController {
  use APIResponseTrait;

  private $userModel;

  public function __construct() {
    $this->userModel = new UsersModel();
  }

  public function login() {
    $body = $this->request->getJSON();

    $user = $this->userModel->where('email', $body->email)->first();

    if($user) {
      if(password_verify($body->password, $user['password'])) {
        return $this->respond($user, 200);
      } else {
        return $this->fail('Wrong password', 400);
      }
    } else {
      return $this->fail('User not found', 404);
    }
  }
}