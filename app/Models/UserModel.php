<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password', 'username'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) return $data;

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    public function checkLogin($email, $password)
    {
        $user = $this->where('email', $email)->first();
        if($user && password_verify($password, $user['password'])){
            return $user;
        }
        return false;
    }
}