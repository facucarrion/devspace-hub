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

    public function getFollows($id_user_followed, $id_user_follower)
    {
        return $this->db->query(
            "SELECT * FROM follows
            WHERE id_user_followed=$id_user_followed AND id_user_follower=$id_user_follower"
        )->getResultArray();
    }
    public function getFollowersOfUser($id)
    {
        return $this->db->query(
            "SELECT u.* FROM follows f
            INNER JOIN users u ON u.id_user = f.id_user_follower
            WHERE f.id_user_followed = $id"
        )->getResultArray();
    }

    public function getFollowsOfUser($id)
    {
        return $this->db->query(
            "SELECT u.* FROM follows f
            INNER JOIN users u ON u.id_user = f.id_user_followed
            WHERE f.id_user_follower = $id"
        )->getResultArray();
    }

    public function getFollowersCount($id)
    {
        return $this->db->query(
            "SELECT count(*) as followers_count
            FROM follows f
            WHERE f.id_user_followed = $id"
        )->getResultArray()[0]['followers_count'];
    }

    public function getFollowingsCount($id)
    {
        return $this->db->query(
            "SELECT count(*) as following_count
            FROM follows f
            WHERE f.id_user_follower = $id"
        )->getResultArray()[0]['following_count'];
    }
}
