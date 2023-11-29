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
    'id_tag_type',
    'type'
  ];
}
