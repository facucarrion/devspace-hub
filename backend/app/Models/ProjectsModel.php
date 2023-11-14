<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsModel extends Model{
  protected $table = 'projects';
  protected $primaryKey = 'id_project';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
    'id_project',
    'title',
    'description',
    'image',
    'url',
    'logo',
    'created_at'
  ];

  protected $dateFormat = 'datetime';
  protected $createdField  = 'created_at';

  public function getProject($id) {
    return $this->db->query(
      "SELECT p.*, u.username as creator_username, u.avatar as creator_avatar,count(pu.upvote) as upvotes
      FROM projects p
      INNER JOIN users u ON u.id_user = p.id_user_creator
      INNER JOIN projects_user pu ON p.id_project = pu.id_project
      WHERE p.id_project = $id"
    )->getResultArray()[0];
  }

  public function getProjectsByCreator($id_creator) {
    return $this->db->query(
      "SELECT p.*, u.username as creator_username, u.avatar as creator_avatar,count(pu.upvote) as upvotes
      FROM projects p
      INNER JOIN users u ON u.id_user = p.id_user_creator
      INNER JOIN projects_user pu ON p.id_project = pu.id_project
      WHERE p.id_user_creator = $id_creator"
    )->getResultArray();
  }

  public function getRandomProjects($limit, $ownUser) {
    $query = $this->db->query(
      "SELECT p.*, u.username as creator_username, u.avatar as creator_avatar,count(pu.upvote) as upvotes
      FROM projects p
      INNER JOIN users u ON u.id_user = p.id_user_creator
      INNER JOIN projects_user pu ON p.id_project = pu.id_project
      WHERE p.id_user_creator != $ownUser
      ORDER BY RAND()
      LIMIT $limit"
    );

    return $query->getResultArray();
  }

  public function searchProjects($name){
    return $this->db->query(
      "SELECT p.*, u.username as creator_username, u.avatar as creator_avatar,count(pu.upvote) as upvotes
      FROM projects p
      INNER JOIN users u ON u.id_user = p.id_user_creator
      INNER JOIN projects_user pu ON p.id_project = pu.id_project
      WHERE p.title LIKE '%$name%'"
    )->getResultArray();
  }

  public function searchProjectsByTag($tag){
    return $this->db->query(
      "SELECT p.*, u.username as creator_username, u.avatar as creator_avatar,count(pu.upvote) as upvotes
      FROM projects p
      INNER JOIN users u ON u.id_user = p.id_user_creator
      INNER JOIN projects_user pu ON p.id_project = pu.id_project
      WHERE p.title LIKE '$tag'"
    )->getResultArray();
  }
}