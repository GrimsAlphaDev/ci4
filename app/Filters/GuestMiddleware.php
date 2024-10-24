<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class GuestMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // check if user doesn't have a session
        if(session()->get('token')){
            // authenticade jwt token
            $key = getenv('JWT_SECRET');
            $token = session()->get('token');

            try {
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                return redirect()->to('/admin/blog');
            } catch (\Exception $e) {
                return $request;
            }
            
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){

    }
}
