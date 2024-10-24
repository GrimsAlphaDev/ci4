<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PostSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i=0; $i < 10 ; $i++) { 
            $data = [
                'post_title' => $faker->sentence(3),
                'post_description' => $faker->paragraph(3),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            // save to db
            $this->db->table('posts')->insert($data);
        }
    }
}
