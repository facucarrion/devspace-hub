<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectLinksModel extends Model 
{
  protected $table = 'project_links';
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
      "SELECT * from project_links pl
      WHERE pl.id_project = $id"
    )->getResultArray();
  }

  public function deleteProjectLinks($id_project) {
    return $this->db->query(
      "DELETE FROM project_links
      WHERE id_project = $id_project"
    );
  }
}