<?php

namespace App\Models;

use CodeIgniter\Model;

class TagsProjectModel extends Model {
  protected $table = 'tags_project';
  protected $primaryKey = 'id_tags_project';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
    'id_tags_project',
    'id_project',
    'id_tag'
  ];
}