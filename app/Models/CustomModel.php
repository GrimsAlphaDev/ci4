<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CustomModel {

    protected $db;

    public function __construct(ConnectionInterface &$db )
    {
        $this->db =& $db;
    }

    function all()
    {
        // use query builder

        return $this->db->table('posts')->get()->getResult();
    }

    function where(){
        return $this->db->table('posts')
        ->where(['post_id >' => 8])
        ->where(['post_id <' => 12])
        ->orderBy('post_id', 'DESC')
        ->get()
        ->getResult();
    }

    function join()
    {
        return $this->db->table('posts')
                        ->where('post_id >', 1)
                        ->where('post_id <', 10)
                        ->join('users', 'posts.post_author = users.user_id')
                        ->get()
                        ->getResult();
    }

    function getPosts()
    {
        $builder = $this->db->table('posts');
        $builder->join('users', 'posts.post_author = users.user_id');
        $posts = $builder->get();
        return $posts->getResult();
    }

    function like()
    {
        return $this->db->table('posts')
                        ->like('post_title', 'Title', 'both') // both are for both side %Title%
                        ->orLike('post_description', 'Content')
                        ->get()
                        ->getResult();
    }

    function grouping()
    {
        // Select * from posts where post_id = 2 AND post_date > '2024-01-01' OR post_atuhor = 4
        return $this->db->table('posts')
                        ->groupStart()
                            ->where(['post_id' => 2], ['created_at' > '2024-01-01'])
                        ->groupEnd()
                        ->orWhere('post_author', 4)
                        ->join('users', 'posts.post_author = users.user_id')
                        ->get()
                        ->getResult();
    }

    function wherein()
    {
        // Select * from posts where post_id = 2 AND created_at > '2024-01-01' OR post_atuhor = 4
        $emails = ['user1@gmail.com', 'admin@admin.com'];
        return $this->db->table('posts')
                        ->groupStart()
                            ->where(['post_id' => 2], ['created_at' > '2024-01-01'])
                        ->groupEnd()
                        ->WhereIn('email', $emails)
                        ->join('users', 'posts.post_author = users.user_id')
                        ->get()
                        ->getResult();
    }
}