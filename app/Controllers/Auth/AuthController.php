<?php

namespace App\Controllers\Auth;

use App\Models\UserModel;
use Firebase\JWT\JWT;

use App\Controllers\BaseController;

class AuthController extends BaseController
{

    public function login()
    {
        return view('auth/login');
    }


    public function validateLogin()
    {
        $userModel = new UserModel();

        $request = service('request');

        // validate request
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required',
        ];

        if ($request->getPost('honeypot') !== '') {
            session()->setFlashdata('error', 'You are not human');
            return redirect()->to('/login');
        }

        if (!$this->validate($rules)) {
            session()->setFlashdata('validation', $this->validator);
            return redirect()->to('/login')->withInput();
        }

        $email = $request->getPost('email');
        $password = $request->getPost('password');

        $user = $userModel->checkLogin($email, $password);
        if (!$user) {
            session()->setFlashdata('error', 'Invalid Credentials');
            return redirect()->to('/login')->withInput();
        }

        // create jwt token
        $key = getenv('JWT_SECRET');
        $iat = time();
        $exp = $iat + 3600; // 1 hour expiration

        $payload = [
            'iss' => base_url(),
            'aud' => base_url(),
            'iat' => $iat,
            'exp' => $exp,
            'data' => [
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
            ]
        ];

        $token = JWT::encode($payload, $key, 'HS256');

        session()->setFlashdata('success', 'Login Successful');
        // set token to session
        session()->set('token', $token);
        // continue to blog dashboard
        // get user role
        if ($user['role'] == 'admin') {
            return redirect()->to('/admin/blog');
        } else {
            return redirect()->to('/blog');
        }
    }

    public function logout()
    {
        session()->remove('token');
        session()->setFlashdata('success', 'Logout Successful');
        return redirect()->to('/login');
    }

    // get user detail
    public function getUser()
    {
        $key = getenv('JWT_SECRET');
        $token = session()->get('token');
        if ($token) {
            $decoded = JWT::decode($token, new \Firebase\JWT\Key($key, 'HS256'));
            // get only username and email
            $decoded = [
                'username' => $decoded->data->username,
                'email' => $decoded->data->email,
                'user_id' => $decoded->data->user_id,
                'role' => $decoded->data->role,
            ];
            return $decoded;
        } else {
            session()->setFlashdata('error', 'Token not found');
            return $this->response->setJSON(['error' => 'Token not found']);
        }
    }

}
