<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'mobile' => [
                'type' => 'VARCHAR',
                'constraint' => '15'
            ],
            'first_access_at' => [
                'type' => 'timestamp',
                'null' => true
            ],
            'last_access_at' => [
                'type' => 'timestamp',
                'null' => true
            ],
            'active' => [
                'type' => 'boolean',
                'default' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' => [
                'type' => 'timestamp',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
