<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'post_id';

    protected $allowedFields = ['post_title', 'post_description', 'post_image', 'post_author'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    // protected $beforeInsert = ['checkName'];

    // protected function checkName(array $data)
    // {
    //     $newTitle = $data['data']['post_title'] . 'Extra Features';
    //     $data['data']['post_title'] = $newTitle;

    //     return $data;
    // }

    public function getPostsWithAuthor()
    {
        return  $this->select('posts.*, users.email, users.username, users.user_id')
            ->join('users', 'posts.post_author = users.user_id')
            ->findAll();
    }

    public function getUserPosts($userId)
    {
        return $this->where('post_author', $userId)->findAll();
    }
}
