<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PostMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'post_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'post_title' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'post_description' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'post_author' => [
                'type' => 'int',
                'constraint' => 5,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],


        ]);
        $this->forge->addKey('post_id', true);
        $this->forge->createTable('posts');
    }

    public function down()
    {
        $this->forge->dropTable('posts');
    }
}
