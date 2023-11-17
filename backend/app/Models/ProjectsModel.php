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
      "SELECT p.*, u.username as creator_username, u.avatar as creator_avatar, u.id_user as creator_id, (
        SELECT count(*) FROM project_users pu
        WHERE pu.id_project = p.id_project AND pu.upvote = 1
      ) as upvotes
      FROM projects p
      INNER JOIN project_users pu ON p.id_project = pu.id_project
      INNER JOIN users u ON u.id_user = pu.id_user
      WHERE p.id_project = $id"
    )->getResultArray()[0];
  }

  public function getProjectsByCreator($id_creator) {
    return $this->db->query(
      "SELECT p.*, u.username as creator_username, u.avatar as creator_avatar,
      (
        SELECT count(*) FROM project_users pu
        WHERE pu.id_project = p.id_project AND pu.upvote = 1
      ) as upvotes
      FROM projects p
      INNER JOIN project_users pu ON p.id_project = pu.id_project
      INNER JOIN users u ON u.id_user = pu.id_user
      WHERE p.id_user_creator = $id_creator"
    )->getResultArray();
  }

  public function getRandomProjects($limit, $ownUser) {
    return $this->db->query(
      "SELECT p.*, u.username as creator_username, u.avatar as creator_avatar,

      (
        SELECT COUNT(DISTINCT pu.id_project_user) FROM project_users pu
        WHERE pu.id_project = p.id_project AND pu.upvote = 1
      ) as upvotes

      FROM projects p
      INNER JOIN project_users pu ON p.id_project = pu.id_project
      INNER JOIN users u ON u.id_user = pu.id_user

      WHERE u.id_user = (
        SELECT DISTINCT u.id_user FROM users u
        INNER JOIN project_users pu ON pu.id_user = u.id_user
		    WHERE p.id_project = pu.id_project AND pu.id_rol = 2 AND pu.id_user != $ownUser
      )

      ORDER BY RAND()
      LIMIT $limit"
    )->getResultArray();
  }

  public function searchProjects($name){
    return $this->db->query(
      "SELECT p.*, u.username as creator_username, u.avatar as creator_avatar,
      (
        SELECT count(*) FROM project_users pu
        WHERE pu.id_project = p.id_project AND pu.upvote = 1
      ) as upvotes
      FROM projects p
      INNER JOIN users u ON u.id_user = p.id_user_creator
      INNER JOIN project_users pu ON p.id_project = pu.id_project
      WHERE p.title LIKE '%$name%'"
    )->getResultArray();
  }

  public function searchProjectsByTag($tag){
    return $this->db->query(
      "SELECT p.*, u.username as creator_username, u.avatar as creator_avatar,
      (
        SELECT count(*) FROM project_users pu
        WHERE pu.id_project = p.id_project AND pu.upvote = 1
      ) as upvotes
      FROM projects p
      INNER JOIN users u ON u.id_user = p.id_user_creator
      INNER JOIN project_users pu ON p.id_project = pu.id_project
      WHERE p.title LIKE '$tag'"
    )->getResultArray();
  }
}