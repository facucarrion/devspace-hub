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
    'tag',
    'id_tag_type'
  ];

  public function getTags()
  {
    return $this->db->query(
      "SELECT * FROM tags t
      INNER JOIN tag_type tt ON t.id_tag_type = tt.id_tag_type"
    )->getResultArray();
  }
}
