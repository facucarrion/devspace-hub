<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesModel extends Model
{
  protected $table            = 'roles';
  protected $primaryKey       = 'id_rol';

  protected $returnType       = 'array';

  protected $useAutoIncrement = true;
  protected $allowedFields    = [
    'id_rol',
    "rol",
  ];
}