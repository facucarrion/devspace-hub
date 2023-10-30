<?php

namespace App\Models;

use CodeIgniter\Model;

class projectLinkModel extends Model
{
  protected $table = 'project_links';
  protected $primaryKey = 'id_project_link';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
    'id_project_link',
    'id_project',
    'link'
  ];
}
