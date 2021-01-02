<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_user'          	=> [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true,
				'auto_increment' 	=> true,
			],
			'nama_user'       	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 100,
			],
			'email'				=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 100
			],
			'password'			=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 255
			],
			'peran' 			=> [
				'type'           	=> 'INT',
				'constraint'		=> 11
			],
			'created_at' => [
				'type'			 => 'DATETIME',
				'null'			 => true,
			],
			'updated_at' => [
				'type'			 => 'DATETIME',
				'null'			 => true
			]
		]);
		$this->forge->addKey('id_user', true);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
