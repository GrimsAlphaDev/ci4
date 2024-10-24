<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\Auth\AuthController;
use App\Models\BlogModel;

class BlogController extends BaseController
{
    public function index(): string
    {
        // get userdetails from getUser from authcontroller
        $auth = new AuthController();
        $user = $auth->getUser();
        $data['user'] = $user;

        // get all posts
        $PostModel = new BlogModel();
        $data['posts'] = $PostModel->getPostsWithAuthor();

        return view('admin/posts/index', $data);
    }

    public function createNew(): string
    {
        $auth = new AuthController();
        $user = $auth->getUser();
        $data['user'] = $user;

        return view('admin/posts/create', $data);
    }

    public function insert()
    {
        $Post = new BlogModel();
        $request = service('request');

        // dd($request->getPost()); // get all post data
        // getvar for catch data from all request method (get, post, put, delete)

        // Aturan validasi

        // if ($this->validate([
        //     'title' => 'required|min_length[3]|max_length[255]|alpha_numeric_space',
        //     'post_content' => 'required|alpha_numeric_space|min_length[3]',
        //     'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]'
        // ])) {
        //     // Simpan data
        //     $Post->save([
        //         'post_title' => $request->getPost('title'),
        //         'post_description' => $request->getPost('post_content'),
        //     ]);

        //     if ($Post->errors()) {
        //         session()->setFlashdata('error', 'Post failed to save.');
        //         return redirect()->back()->withInput();
        //     }

        //     // Set session untuk sukses
        //     session()->setFlashdata('success', 'Post has been saved successfully.');
        //     return redirect()->to('/blog');
        // } else {
        //     // Set session untuk error
        //     $errors = $this->validator->getErrors();
        //     session()->setFlashdata('validation', $errors);
        //     return redirect()->back()->withInput();
        // }
    }
}
