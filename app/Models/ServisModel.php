<?php

namespace App\Models;

use CodeIgniter\Model;

class ServisModel extends Model
{
    protected $table      = 'servis';
    protected $primaryKey = 'no_servis';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'no_servis', 
        'tgl_masuk',
        'keluhan',
        'jenis_kerusakan',
        'pemilik',
        'kontak',
        'tipe_laptop',
        'serial_number',
        'kelengkapan_unit',
        'status_servis',
        'biaya_servis',
        'ket_perbaikan',
        'tgl_diambil',
        'id_user',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
