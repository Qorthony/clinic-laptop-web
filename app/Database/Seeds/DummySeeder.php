<?php namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class DummySeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {
            $this->call('UserSeeder');
            $this->call('ServisSeeder');
        }
}