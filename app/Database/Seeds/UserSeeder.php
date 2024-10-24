<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'email'    => 'admin@admin.com',
            'password' => password_hash('asdasd', PASSWORD_DEFAULT),
        ];

        // Using Query Builder
        $this->db->table('users')->insert($data);

        // create factory
        $faker = Factory::create();

        for ($i=0; $i < 6 ; $i++) { 
            $data = [
                'username' => $faker->userName,
                'email'    => $faker->email,
                'password' => password_hash('asdasd', PASSWORD_DEFAULT),
            ];

            // save to db
            $this->db->table('users')->insert($data);
        }


    }
}
