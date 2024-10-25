<?php

namespace App\Controllers;

use App\Controllers\Auth\AuthController;
use App\Models\BlogModel;
use App\Models\CustomModel;
use CodeIgniter\HTTP\Request;

class BlogController extends BaseController
{
    public function index(): string
    {
        
        $model = new BlogModel();
        // get userdetails
        $auth = new AuthController();
        $user = $auth->getUser();
        
        $data = [
            'meta_title' => 'Codeigniter 4 Blog',
            'title' => 'This is ' . $user['username'] . ' blog',
        ];
        
        $data['user'] = $user;
        $data['posts'] = $model->getUserPosts($user['user_id']);

        return view('blog', $data);
    }

    public function post($id): string
    {

        $postModel = new BlogModel();
        $post = $postModel->find($id);

        if ($post) {

            $data = [
                'meta_title' => $post['post_title'],
                'title' => $post['post_title'],
                'post' => $post
            ];
        } else {
            $data = [
                'meta_title' => 'Post not found',
                'title' => 'Post not found',
            ];

        }

        return view('single_post', $data);
    }

    public function new(): string
    {
        // get userdetails
        $auth = new AuthController();
        $user = $auth->getUser();
        
        $data = [
            'meta_title' => 'New Post',
            'title' => 'Create new post'
        ];
        $data['user'] = $user;
        return view('new_post', $data);
    }

    public function edit($id){
        // get userdetails
        $auth = new AuthController();
        $user = $auth->getUser();
        
        $PostModel = new BlogModel();
        $post = $PostModel->find($id);
        $data = [
            'meta_title' => $post['post_title'],
            'title' => $post['post_title'],
            'post' => $post,
            'user' => $user
        ];

        return view('edit_post', $data);
    }

    public function update($id){
        $Post = new BlogModel();
        $request = service('request');

        // dd($request->getPost()); // get all post data
        // getvar for catch data from all request method (get, post, put, delete)

        // Aturan validasi

        if ($this->validate([
            'title' => 'required|min_length[3]|max_length[255]|alpha_numeric_space',
            'post_content' => 'required|alpha_numeric_space|min_length[3]'
        ])) {

            $cekPost = $Post->find($id);
            if(!$cekPost){
                session()->setFlashdata('error', 'Post not found.');
                return redirect()->to('/blog');
            }
            
            // Simpan data
            $Post->save([
                'post_title' => $request->getPost('title'),
                'post_description' => $request->getPost('post_content'),
                'post_id' => $id
            ]);

            if ($Post->errors()) {
                session()->setFlashdata('error', 'Post failed to save.');
                return redirect()->back()->withInput();
            }

            // Set session untuk sukses
            session()->setFlashdata('success', 'Post has been saved successfully.');
            return redirect()->to('/blog/post/'.$id);
        } else {
            // Set session untuk error
            $errors = $this->validator->getErrors();
            session()->setFlashdata('validation', $errors);
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $PostModel = new BlogModel();
        $post = $PostModel->find($id);
        if($post){
            $PostModel->delete($id);
            session()->setFlashdata('success', 'Post has been deleted successfully.');
            return redirect()->to('/blog');
        } else {
            session()->setFlashdata('error', 'Post not found.');
            return redirect()->to('/blog');
        }
    }
}
