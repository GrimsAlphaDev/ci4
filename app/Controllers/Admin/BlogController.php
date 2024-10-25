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
        // dd($data);
        return view('admin/posts/create', $data);
    }

    public function insert()
    {
        $Post = new BlogModel();
        $request = service('request');

        // dd($request->getPost()); // get all post data
        // getvar for catch data from all request method (get, post, put, delete)

        // Aturan validasi

        if ($this->validate([
            'title' => 'required|min_length[3]|max_length[255]|alpha_numeric_space',
            'post_content' => 'required|alpha_numeric_space|min_length[3]',
            'image' => 'uploaded[image]|is_image[image]',
            'user_id' => 'required'
        ])) {

            $file = $request->getFile('image');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName() . '.' . $file->getExtension();
                $file->move('./uploads/images', $newName);
            }

            // Simpan data
            $Post->save([
                'post_title' => $request->getPost('title'),
                'post_description' => $request->getPost('post_content'),
                'post_image' => $file->getName(),
                'post_author' => $request->getPost('user_id')
            ]);

            if ($Post->errors()) {
                session()->setFlashdata('error', 'Post failed to save.');
                return redirect()->back()->withInput();
            }

            // Set session untuk sukses
            session()->setFlashdata('success', 'Post has been saved successfully.');
            return redirect()->to('/admin/blog');
        } else {
            // Set session untuk error
            $errors = $this->validator->getErrors();
            session()->setFlashdata('validation', $errors);
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $Post = new BlogModel();
        $data['post'] = $Post->find($id);

        $auth = new AuthController();
        $user = $auth->getUser();
        $data['user'] = $user;

        return view('admin/posts/edit', $data);
    }

    public function update($id)
    {
        $Post = new BlogModel();
        $request = service('request');

        // Aturan validasi
        if ($this->validate([
            'title' => 'required|min_length[3]|max_length[255]|alpha_numeric_space',
            'post_content' => 'required|alpha_numeric_space|min_length[3]',
            'user_id' => 'required'
        ])) {

            if($request->getFile('image')->isValid()){
                $file = $request->getFile('image');
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName() . '.' . $file->getExtension();
                    $file->move('./uploads/images', $newName);
                }

                // Hapus file lama
                $oldImage = $Post->find($id)['post_image'];
                if (file_exists('./uploads/images/' . $oldImage)) {
                    unlink('./uploads/images/' . $oldImage);
                }
                // Simpan data
                $Post->save([
                    'post_id' => $id,
                    'post_title' => $request->getPost('title'),
                    'post_description' => $request->getPost('post_content'),
                    'post_image' => $file->getName(),
                    'post_author' => $request->getPost('user_id')
                ]);
            } else {
                // Simpan data
                $Post->save([
                    'post_id' => $id,
                    'post_title' => $request->getPost('title'),
                    'post_description' => $request->getPost('post_content'),
                    'post_author' => $request->getPost('user_id')
                ]);
            }
            

            if ($Post->errors()) {
                session()->setFlashdata('error', 'Post failed to save.');
                return redirect()->back()->withInput();
            }

            // Set session untuk sukses
            session()->setFlashdata('success', 'Post has been saved successfully.');
            return redirect()->to('/admin/blog');
        } else {
            // Set session untuk error
            $errors = $this->validator->getErrors();
            session()->setFlashdata('validation', $errors);
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $Post = new BlogModel();

        // Hapus file
        $oldImage = $Post->find($id)['post_image'];
        if (file_exists('./uploads/images/' . $oldImage)) {
            unlink('./uploads/images/' . $oldImage);
        }

        $Post->delete($id);

        session()->setFlashdata('success', 'Post has been deleted successfully.');
        return redirect()->to('/admin/blog');
    }
}
