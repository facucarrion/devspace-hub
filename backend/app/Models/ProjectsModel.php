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
    'url',
    'logo',
    'upvotes',
    'id_user_creator',
    'created_at'
  ];

  protected $dateFormat = 'datetime';
  protected $createdField  = 'created_at';

  public function getDatesOfUserCreator($id){
    return $this->db
        ->table('projects') 
        ->select('u.*')
        ->join('users u', 'u.id_user = projects.id_user_creator')
        ->where('projects.id_user_creator', $id)
        ->get()
        -getResult();
  }
  public function getRandomProjects($limit = 5) {
    $query = $this->db->query("SELECT * FROM projects ORDER BY RAND() LIMIT $limit");
 
    return $query->getResultArray();
  }
}