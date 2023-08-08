<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model {
  protected $table = 'tags';
  protected $primaryKey = 'id_tag';

  protected $useAutoIncrement = true;

  protected $returnType = 'array';

  protected $allowedFields = ['id_tag', 'tag'];
}