<?php

namespace App\Models;

use CodeIgniter\Model;

class FollowsModel extends Model
{
    protected $table            = 'follows';
    protected $primaryKey       = 'id_follow';

    protected $returnType       = 'array';
    
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        "id_follow",
        "id_user_followed",
        "id_user_follower",
        'created_at'
    ];

    protected $dateFormat = 'datetime';
    protected $createdField  = 'created_at';
}
