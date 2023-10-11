<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagesModel extends Model {
  protected $table = 'images';
  protected $primaryKey = 'id_image';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
    'id',
    'path'
  ];
}