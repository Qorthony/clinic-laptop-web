<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_user'     => 'admin',
                'email'         => 'admin@admin.com',
                'password'      => password_hash('ayoservis123', PASSWORD_DEFAULT) ,
                'peran'         => 1,
                'created_at'    => Time::now(),
                'updated_at'    => Time::now()
            ],
            [
                'nama_user'     => 'toto',
                'email'         => 'toto@toto.com',
                'password'      => password_hash('ayoservis123', PASSWORD_DEFAULT),
                'peran'         => 2,
                'created_at'    => Time::now(),
                'updated_at'    => Time::now()
            ]
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
