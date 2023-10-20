<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsUserModel extends Model
{
  protected $table            = 'projects_user';
  protected $primaryKey       = 'id_projects_user';

  protected $returnType       = 'array';

  protected $useAutoIncrement = true;
  protected $allowedFields    = [
    'projects_user',
    "id_project",
    "id_user",
    "is_editor"
  ];

  public function getDataOfProject($id)
  {
    return $this->db->query(
      "SELECT p.* FROM projects_user pu
        INNER JOIN projects p ON pu.id_project = p.id_project
        WHERE pu.id_project = $id"
    );
  }

  public function getDataOfUser($id)
  {
    return $this->db->query(
      "SELECT u.* FROM projects_user pu
            INNER JOIN users u ON pu.id_user = u.id_user
            INNER JOIN projects p ON pu.id_project = p.id_project
            WHERE pu.id_project = $id"
    );
  }

  public function getCollaborators($id)
  {
    return $this->db->query(
      "SELECT u.* FROM projects_user pu
        INNER JOIN users u ON pu.id_user = u.id_user
        INNER JOIN projects p ON pu.id_project = p.id_project
        WHERE pu.id_project = $id"
    );
  }
}
