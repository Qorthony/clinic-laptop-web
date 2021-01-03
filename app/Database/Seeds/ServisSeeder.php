<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class ServisSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'no_servis'         => strtotime('now') . '01',
                'tgl_masuk'         => '2020-12-9',
                'jenis_kerusakan'   => 'layar mati',
                'pemilik'           => 'asrul',
                'seri_laptop'       => 'lenovo',
                'kelengkapan_unit'  => 'ram 4gb, harddisk 500gb',
                'status_servis'     => 'diambil',
                'biaya_servis'      => 300000,
                'ket_perbaikan'     => 'ganti layar',
                'tgl_diambil'       => '2020-12-20',
                'id_user'           => 1,
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'no_servis'         => strtotime('now') . '02',
                'tgl_masuk'         => '2020-12-9',
                'jenis_kerusakan'   => 'blue screen',
                'pemilik'           => 'hahan',
                'seri_laptop'       => 'asus',
                'kelengkapan_unit'  => 'ram 2gb, harddisk 500gb',
                'status_servis'     => 'selesai',
                'biaya_servis'      => 60000,
                'ket_perbaikan'     => 'install ulang',
                'tgl_diambil'       => null,
                'id_user'           => 1,
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'no_servis'         => strtotime('now') . '05',
                'tgl_masuk'         => '2020-12-10',
                'jenis_kerusakan'   => 'motherboard rusak',
                'pemilik'           => 'ivan',
                'seri_laptop'       => 'asus',
                'kelengkapan_unit'  => 'ram 2gb, harddisk 500gb',
                'status_servis'     => 'batal',
                'biaya_servis'      => null,
                'ket_perbaikan'     => null,
                'tgl_diambil'       => null,
                'id_user'           => 1,
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'no_servis'         => strtotime('now') . '03',
                'tgl_masuk'         => '2020-12-10',
                'jenis_kerusakan'   => 'keyboard error',
                'pemilik'           => 'nafi',
                'seri_laptop'       => 'asus',
                'kelengkapan_unit'  => 'ram 2gb, harddisk 500gb',
                'status_servis'     => 'proses',
                'biaya_servis'      => null,
                'ket_perbaikan'     => null,
                'tgl_diambil'       => null,
                'id_user'           => 1,
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ],
            [
                'no_servis'         => strtotime('now') . '04',
                'tgl_masuk'         => '2020-12-11',
                'jenis_kerusakan'   => 'virus',
                'pemilik'           => 'cecek',
                'seri_laptop'       => 'asus',
                'kelengkapan_unit'  => 'ram 2gb, harddisk 500gb',
                'status_servis'     => 'antrian',
                'biaya_servis'      => null,
                'ket_perbaikan'     => null,
                'tgl_diambil'       => null,
                'id_user'           => 1,
                'created_at'        => Time::now(),
                'updated_at'        => Time::now()
            ]

        ];

        // Using Query Builder
        $this->db->table('servis')->insertBatch($data);
    }
}
