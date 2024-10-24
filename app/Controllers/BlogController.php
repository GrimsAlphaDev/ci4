<?php

namespace App\Controllers;

class BlogController extends BaseController
{
    public function index(): void
    {
        $data = [
            'meta_title' => 'Codeigniter 4 Blog',
            'title' => 'This is a Blog page'
        ];

        $posts =  ['Title 1', 'Title 2', 'Title 3'];

        $data['posts'] = $posts;

        echo view('templates/header', $data);
        echo view('blog');
        echo view('templates/footer');
    }

    public function post(): void
    {
        $data = [
            'meta_title' => 'Codeigniter 4 Blog',
            'title' => 'This is an Awesome Blog'
        ];

        echo view('templates/header', $data);
        echo view('single_post');
        echo view('templates/footer');
    }
}
