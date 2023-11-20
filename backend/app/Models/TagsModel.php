<?php

namespace App\Models;

use CodeIgniter\Model;

class TagsModel extends Model
{
  protected $table = 'tags';
  protected $primaryKey = 'id_tag';

  protected $useAutoIncrement = true;

  protected $returnType = 'array';

  protected $allowedFields = [
    'id_tag',
    'tag'
  ];

  public function getTagIdByName($name)
  {
    return $this->db->query(
      "SELECT id_tag FROM tags 
      WHERE tag LIKE '%$name%'"
    )->getResultArray();
  }
}
