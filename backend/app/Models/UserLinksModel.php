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

  public function getByUser($id)
  {
    $query = $this->db->query(
      "SELECT link FROM user_links WHERE id_user = $id"
    )->getResultArray();

    $links = [];

    foreach ($query as $link) {
      array_push($links, $link['link']);
    }

    return $links;
  }

  public function getByUsername($username)
  {
    return $this->db->query(
      "SELECT * FROM user_links
      WHERE id_user = (
        SELECT id_user FROM users WHERE username = '$username'
      )"
    )->getResultArray();
  }

  public function deleteByUser($id)
  {
    return $this->db->query(
      "DELETE FROM user_links WHERE id_user = $id"
    );
  }
}
