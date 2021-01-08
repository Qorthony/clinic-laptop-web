<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateServis extends Migration
{
	public function up()
	{
		/*
			ubah nama kolom seri laptop menjadi tipe laptop
		*/
		$seri_laptop = [
			'seri_laptop'=>[
				'name' 			=> 'tipe_laptop',
				'type'			=> 'VARCHAR',
				'constraint'	=> 50
			]
		];
		$this->forge->modifyColumn('servis', $seri_laptop);

		/*
			Menamabah kolom keluhan, serial number, kontak
		*/

		$kolom_baru = [
			'keluhan' => [
				'type'			=> 'VARCHAR',
				'constraint'	=> 255,
				'null'			=> true,
				'after'			=> 'tgl_masuk'
			],
			'serial_number' => [
				'type'			=> 'VARCHAR',
				'constraint'	=> 255,
				'after'			=> 'tipe_laptop'
			],
			'kontak' => [
				'type'			=> 'VARCHAR',
				'constraint'	=> 100,
				'after'			=> 'pemilik'
			]
		];

		$this->forge->addColumn('servis', $kolom_baru);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
