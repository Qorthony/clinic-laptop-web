<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ServisModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class Servis extends BaseController
{
    public function __construct()
    {
        helper(['dataservis']);   
    }
    public function index()
    {
        $servis = new ServisModel();
        $antrian = $servis->where('status_servis', 'antrian')->orderBy('tgl_masuk')->findAll();
        $proses = $servis->where('status_servis', 'proses')->orderBy('tgl_masuk')->findAll();
        $batal = $servis->where('status_servis', 'batal')->orderBy('tgl_masuk', 'DESC')->findAll();
        $selesai = $servis->where('status_servis', 'selesai')->orderBy('tgl_masuk', 'DESC')->findAll();
        $diambil = $servis->where('status_servis', 'diambil')->orderBy('tgl_masuk', 'DESC')->findAll();
        $data = [
            'antrian'   => $antrian,
            'proses'    => $proses,
            'batal'     => $batal,
            'selesai'   => $selesai,
            'diambil'   => $diambil
        ];
        // dd($data);
        return view('admin/servis/index', $data);
    }

    //--------------------------------------------------------------------

    public function create()
    {
        if (!$this->validate([
            'tgl_masuk'             => "required|date",
            'keluhan'               => "required",
            'jenis_kerusakan'       => 'required|alpha_numeric_space',
            'pemilik'               => "required|alpha_numeric_space",
            'kontak'                => "required",
            'tipe_laptop'           => "required|alpha_numeric_space",
            'serial_number'         => "required|alpha_numeric_space",
            'kelengkapan_unit'      => "required",
        ])) {
            return redirect()->to('/admin/servis')->with('errors', $this->validator->getErrors());
        }

        $no_servis          = uniqid("se");
        $tgl_masuk          = $this->request->getPost('tgl_masuk');
        $keluhan            = $this->request->getPost('keluhan');
        $jenis_kerusakan    = $this->request->getPost('jenis_kerusakan');
        $pemilik            = $this->request->getPost('pemilik');
        $kontak             = $this->request->getPost('kontak');
        $tipe_laptop        = $this->request->getPost('tipe_laptop');
        $kelengkapan_unit   = $this->request->getPost('kelengkapan_unit');
        $serial_number      = $this->request->getPost('serial_number');
        $status_servis      = "antrian";
        $id_user            = session('user_id');

        $data = [
            'no_servis'         => $no_servis,
            'tgl_masuk'         => $tgl_masuk,
            'keluhan'           => $keluhan,
            'jenis_kerusakan'   => $jenis_kerusakan,
            'pemilik'           => $pemilik,
            'kontak'            => $kontak,
            'tipe_laptop'       => $tipe_laptop,
            'serial_number'     => $serial_number,
            'kelengkapan_unit'  => $kelengkapan_unit,
            'status_servis'     => $status_servis,
            'id_user'           => $id_user
        ];

        // dd($data);

        $servis = new ServisModel();

        //cek apakah sudah pernah diservis
        $message = 'Berhasil! no servis = ' . $no_servis;
        $exist_serial = $servis->where('serial_number',$serial_number)->first();
        if (!empty($exist_serial)) {
            $message = '<p>Berhasil! no servis = ' . $no_servis.'</p><p> Laptop sudah pernah diservis disini !</p>';
        }

        //tambah data servis
        $servis->insert($data);

        return redirect()->to('/admin/servis')->with('success', $message);
    }

    //--------------------------------------------------------------------

    public function update($no_servis)
    {
        /*
            controller untuk update servis di status apapun
        */

        if (!$this->validate([
            'tgl_masuk'             => "required|date",
            'keluhan'               => "required",
            'jenis_kerusakan'       => 'required|alpha_numeric_space',
            'pemilik'               => "required|alpha_numeric_space",
            'kontak'                => "required",
            'tipe_laptop'           => "required|alpha_numeric_space",
            'serial_number'         => "required|alpha_numeric_space",
            'kelengkapan_unit'      => "required",
        ])) {
            return redirect()->to('/admin/servis')->with('errors', $this->validator->getErrors());
        }

        $tgl_masuk          = $this->request->getPost('tgl_masuk');
        $keluhan            = $this->request->getPost('keluhan');
        $jenis_kerusakan    = $this->request->getPost('jenis_kerusakan');
        $pemilik            = $this->request->getPost('pemilik');
        $kontak             = $this->request->getPost('kontak');
        $tipe_laptop        = $this->request->getPost('tipe_laptop');
        $kelengkapan_unit   = $this->request->getPost('kelengkapan_unit');
        $serial_number      = $this->request->getPost('serial_number');
        $biaya_servis       = $this->request->getVar('biaya_servis') ? $this->request->getVar('biaya_servis') : null;
        $ket_perbaikan      = $this->request->getVar('ket_perbaikan') ? $this->request->getVar('ket_perbaikan') : null;
        $id_user            = session('user_id');

        $data = [
            'tgl_masuk'         => $tgl_masuk,
            'keluhan'           => $keluhan,
            'jenis_kerusakan'   => $jenis_kerusakan,
            'pemilik'           => $pemilik,
            'kontak'            => $kontak,
            'tipe_laptop'       => $tipe_laptop,
            'serial_number'     => $serial_number,
            'kelengkapan_unit'  => $kelengkapan_unit,
            'id_user'           => $id_user,
            'biaya_servis'      => $biaya_servis,
            'ket_perbaikan'     => $ket_perbaikan
        ];

        $servis = new ServisModel();
        $servis->update($no_servis, $data);

        return redirect()->to('/admin/servis')->with('success', 'Berhasil update no servis = ' . $no_servis);
    }

    //--------------------------------------------------------------------

    public function delete($no_servis)
    {
        $servis = new ServisModel();
        $servis->delete($no_servis);
        return redirect()->to('/admin/servis')->with('success', 'Data berhasil dihapus!');
    }

    //--------------------------------------------------------------------

    public function updateStatus($no_servis, $status)
    {
        $servis = new ServisModel();
        $servis->update($no_servis, ['status_servis' => $status]);
        return redirect()->to('/admin/servis')->with('success', 'Data berhasil diupdate menjadi ' . $status);
    }

    //--------------------------------------------------------------------

    public function updateToSelesai($no_servis)
    {
        if (!$this->validate([
            'biaya'                 => "required|numeric",
            'ket_perbaikan'         => 'required',
        ])) {
            return redirect()->to('/admin/servis')->with('errors', $this->validator->getErrors());
        }

        $biaya          = $this->request->getPost('biaya');
        $ket_perbaikan  = $this->request->getPost('ket_perbaikan');

        $servis = new ServisModel();
        $data = [
            'status_servis' => 'selesai',
            'biaya_servis'  => $biaya,
            'ket_perbaikan' => $ket_perbaikan
        ];
        $servis->update($no_servis, $data);
        return redirect()->to('/admin/servis')->with('success', 'Data berhasil diupdate menjadi selesai');
    }

    //--------------------------------------------------------------------

    public function updateToDiambil($no_servis)
    {
        $servis = new ServisModel();
        $data = [
            'status_servis' => 'diambil',
            'tgl_diambil'   => Time::now()
        ];
        $servis->update($no_servis, $data);
        return redirect()->to('/admin/servis')->with('success', 'Data berhasil diupdate menjadi diambil');
    }

    //--------------------------------------------------------------------

    public function search()
    {
        $keyword = $this->request->getVar('keyword');
        $field = $this->request->getVar('field');
        
        $data = [
            'antrian'   => search_servis($field, $keyword,'antrian'),
            'proses'    => search_servis($field, $keyword,'proses'),
            'batal'     => search_servis($field, $keyword,'batal'),
            'selesai'   => search_servis($field, $keyword,'selesai'),
            'diambil'   => search_servis($field, $keyword,'diambil')
        ];

        // dd(uri_string()); 
        return view('admin/servis/index', $data);
    }
}
