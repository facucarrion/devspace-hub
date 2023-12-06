<?php

namespace App\Controllers;

use App\Models\FollowsModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;

class FollowsController extends BaseController
{
  use APIResponseTrait;

  private $followsModel;

  public function __construct()
  {
    $this->followsModel = new FollowsModel();
  }

  public function getAll()
  {
    $follows = $this->followsModel->findAll();
    return $this->respond($follows, 200);
  }

  public function getById($id)
  {
    $follow = $this->followsModel->find($id);

    if ($follow) {
      return $this->respond($follow, 200);
    } else {
      return $this->failNotFound('No follow found with id ' . $id, 404);
    }
  }

  public function create()
  {
    $follow = $this->request->getJSON();

    $insertedFollow = $this->followsModel->insert([
      'id_user_followed' => $follow->id_user_followed,
      'id_user_follower' => $follow->id_user_follower,
      'created_at' => date('Y-m-d H:i:s')
    ]);

    if ($insertedFollow) {
      return $this->respondCreated($this->followsModel->find($insertedFollow), 'Follow created!');
    } else {
      return $this->fail($this->followsModel->errors(), 400);
    }
  }

  public function delete($id)
  {
    if ($this->followsModel->delete($id)) {
      return $this->respondDeleted(['id_follow' => $id], 'Follow deleted!');
    } else {
      return $this->fail($this->followsModel->errors(), 400);
    }
  }

  public function getFollowersOfUser($id)
  {
    return $this->respond(
      $this->followsModel->getFollowersOfUser($id)
    );
  }

  public function getFollowsOfUser($id)
  {
    return $this->respond($this->followsModel->getFollowsOfUser($id));
  }

  public function getFollowCounts($id)
  {
    return $this->respond([
      'followers' => $this->followsModel->getFollowersCount($id),
      'followings' => $this->followsModel->getFollowingsCount($id)
    ]);
  }

  public function isFollow()
  {
    $json = $this->request->getJSON();

    $id_user_followed = $json->id_user_followed;
    $id_user_follower = $json->id_user_follower;

    $follow = $this->followsModel->getFollows($id_user_followed, $id_user_follower);

    if (count($follow) == 0) {
      return $this->respond(["isFollow" => false]);
    } else {
      return $this->respond(["isFollow" => true]);
    }
  }

  public function follow()
  {
    $json = $this->request->getJSON();

    $id_user_followed = $json->id_user_followed;
    $id_user_follower = $json->id_user_follower;

    if ($id_user_followed == $id_user_follower) {
      return $this->respond(["error" => "You can't follow yourself"]);
    }

    $follow = $this->followsModel->getFollows($id_user_followed, $id_user_follower);

    if (count($follow) == 0) {
      $this->followsModel->insert([
        'id_user_followed' => $id_user_followed,
        'id_user_follower' => $id_user_follower,
        'created_at' => date('Y-m-d H:i:s')
      ]);

      return $this->respond(["followers" => $this->followsModel->getFollowersCount($id_user_followed)]);
    } else {
      $this->followsModel->delete($follow[0]["id_follow"]);
      return $this->respond(["followers" => $this->followsModel->getFollowersCount($id_user_followed)]);
    }
  }
}
