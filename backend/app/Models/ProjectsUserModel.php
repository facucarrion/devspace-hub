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

    public function getDatesOfProject($id){
      return $this->db
          ->table('projects_user')
          ->select('p.*')
          ->join('projects p', 'p.id_project = projects_user.id_project')
          ->where('projects_user.id_project', $id)
          ->get()
          ->getResult();
    }

    public function getDatesOfUser($id){
      return $this->db
          ->table('projects_user')
          ->select('u.*')
          ->join('user u', 'u.id_user = projects_user.id_user')
          ->where('projects_user.id_user', $id)
          ->get()
          ->getResult();
    }
}