<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Servis extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'no_servis'			=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 20,
			],
			'tgl_masuk'       	=> [
				'type'           	=> 'DATE',
			],
			'jenis_kerusakan'	=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 100
			],
			'pemilik'			=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 30
			],
			'seri_laptop'		=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 20
			],
			'kelengkapan_unit'	=> [
				'type'				=> 'TEXT'
			],
			'status_servis'		=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 20
			],
			'biaya_servis'		=> [
				'type'				=> 'INT',
				'null'				=> true
			],
			'ket_perbaikan'		=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 255,
				'null'				=> true
			],
			'tgl_diambil'		=> [
				'type'				=> 'DATE',
				'null'				=> true
			],
			'id_user'			=> [
				'type'				=> 'INT',
				'constraint'     	=> 11,
				'unsigned'       	=> true
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
		$this->forge->addKey('no_servis', true);
		$this->forge->createTable('servis');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('servis');
	}
}
