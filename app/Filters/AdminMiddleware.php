<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use CodeIgniter\HTTP\ResponseInterface;

class AdminMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(session()->get('token')){
            // authenticade jwt token
            $key = getenv('JWT_SECRET');
            $token = session()->get('token');
            
            try {
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                if($decoded->data->role != 'admin'){
                    session()->setFlashdata('error', 'You are not authorized to access the page');
                    return redirect()->to('/login');
                }
            } catch (\Exception $e) {
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('error', 'Please login to access the page');
            return redirect()->to('/login');
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
        
    }
}