<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
  protected $table = 'users';
  protected $primaryKey = 'id_user';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
    'id_user',
    'username',
    'display_name',
    'email',
    'avatar',
    'password',
    'created_at',
  ];

  protected $dateFormat = 'datetime';
  protected $createdField = 'created_at';

  public function getRandomUsers($limit, $ownUser)
  {
    $query = $this->db->query(
      "SELECT * FROM users 
      WHERE id_user != $ownUser ORDER BY 
      RAND() LIMIT $limit"
    );

    return $query->getResultArray();
  }

  public function searchUsers($name)
  {
    return $this->db->query(
      "SELECT u.* FROM users u
      WHERE username LIKE '%$name%' OR display_name LIKE '%$name%'"
    )->getResultArray();
  }
}
