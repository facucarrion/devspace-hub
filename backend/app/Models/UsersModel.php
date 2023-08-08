<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model {
  protected $table = 'users';
  protected $primaryKey = 'id_user';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
    'id_user',
    'username',
    'display_name',
    'email',
    'password',
    'created_at',
  ];

  protected $dateFormat = 'datetime';
  protected $createdField = 'created_at';
}