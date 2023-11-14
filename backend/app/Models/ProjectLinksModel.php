<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectLinksModel extends Model 
{
  protected $table = 'projects_links';
  protected $primaryKey = 'id_project_link';

  protected $returnType = 'array';
  
  protected $useAutoIncrement = true;
  protected $allowedFields = [
    'id_project_link',
    'id_project',
    'link'
  ];

  public function getLinks($id) {
    return $this->db->query(
      "SELECT * from projects_links pl
      WHERE pl.id_project = $id"
    )->getResultArray();
  }
}