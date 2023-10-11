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

    public function getFollowersOfUser($id) {
        return $this->db
            ->table('follows')
            ->select('u.*')
            ->join('users u', 'u.id_user = follows.id_user_follower')
            ->where('follows.id_user_followed', $id)
            ->get()
            ->getResult();
    }

    public function getFollowsOfUser($id) {
        return $this->db
            ->table('follows')
            ->select('u.*')
            ->join('users u', 'u.id_user = follows.id_user_followed')
            ->where('follows.id_user_follower', $id)
            ->get()
            ->getResult();
    }

    public function getFollowersCount($id) {
        return $this->db
            ->table('follows')
            ->select('count(*) as followers_count')
            ->where('follows.id_user_followed', $id)
            ->get()
            ->getRow()
            ->followers_count;
    }

    public function getFollowingsCount($id) {
        return $this->db
            ->table('follows')
            ->select('count(*) as following_count')
            ->where('follows.id_user_follower', $id)
            ->get()
            ->getRow()
            ->following_count;
    }
    public function follow($id,$id_followed) {
        return $this->db
            ->table('follows')
            ->insert($id,$id_followed)
            ->get()
            ->getRow()
            ->following;
            
    }
    public function unFollow($id) {
        return $this->db
            ->table('follows')
            ->delete("*")
            ->where("follows.id_followed",$id)
            ->get()
            ->getRow()
            ->unFollowing;
            
    }
}
