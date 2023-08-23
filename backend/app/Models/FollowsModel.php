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

    public function getFollowsById($id) {
        $followers = $this->where('id_user_follower', $id)->select(
            'count(id_user_follower) as followers'
        )->first();

        $followed = $this->where('id_user_followed', $id)->select(
            'count(id_user_followed) as followed'
        )->first(); 

        return [
            'followers' => (int)$followed['followed'],
            'followed' => (int)$followers['followers'],
        ];
    }
}
