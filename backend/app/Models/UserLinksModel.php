<?php

namespace App\Models;

use CodeIgniter\Model;

class UserLinksModel extends Model
{
  protected $table = 'user_links';
  protected $primaryKey = 'id_user_link';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
    'id_user_link',
    'id_user',
    'link'
  ];

  public function getUserLinks($id)
  {
    return $this->where('id_user',$id)->findAll();
  }
}
