<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsModel extends Model{
  protected $table = 'projects';
  protected $primaryKey = 'id_project';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
    'id_project',
    'title',
    'description',
    'upvotes',
    'id_user_creator',
    'created_at'
  ];

  protected $dateFormat = 'datetime';
  protected $createdField  = 'created_at';
}