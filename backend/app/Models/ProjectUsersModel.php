<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectUsersModel extends Model
{
  protected $table            = 'project_users';
  protected $primaryKey       = 'id_project_user';

  protected $returnType       = 'array';

  protected $useAutoIncrement = true;
  protected $allowedFields    = [
    "id_project_user",
    "id_rol",
    "id_project",
    "id_user",
    "is_editor",
    "upvote"
  ];

  public function getCollaborators($id)
  {
    return $this->db->query(
      "SELECT u.username, u.avatar, pu.is_editor FROM projects_user pu
      INNER JOIN users u ON pu.id_user = u.id_user
      INNER JOIN projects p ON pu.id_project = p.id_project
      WHERE pu.id_project = $id"
    )->getResultArray();
  }
  
  public function getCollaboratorsWhitLimit($id, $limit)
  {
    return $this->db->query(
      "SELECT u.username,u.avatar FROM projects_user pu
      INNER JOIN users u ON pu.id_user = u.id_user
      INNER JOIN projects p ON pu.id_project = p.id_project
      WHERE pu.id_project = $id
      LIMIT $limit"
    )->getResultArray();
  }

  public function getProjectsByCreator($id) {
    return $this->db->query(
      "SELECT p.*, u.username as creator_username, u.avatar as creator_avatar
      FROM projects p
      INNER JOIN project_users pu ON p.id_project = pu.id_project
      INNER JOIN users u ON pu.id_user = u.id_user
      WHERE pu.id_rol = 2 AND pu.id_user = $id"
    )->getResultArray();
  }
  
  public function getProjectsByCollaborator($id) {
    return $this->db->query(
      "SELECT p.*, u.username as creator_username, u.avatar as creator_avatar
      FROM projects p
      INNER JOIN project_users pu ON p.id_project = pu.id_project
      INNER JOIN users u ON pu.id_user = u.id_user
      WHERE pu.id_rol = 1 AND pu.id_user = $id"
    )->getResultArray();
  }

  public function isUpvoted($id_project, $id_user){
    return $this->db->query(
      "SELECT *
      FROM projects_user 
      WHERE id_project=$id_project AND id_user=$id_user"
    )->getResultArray();
  }
}