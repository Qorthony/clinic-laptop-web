<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ServisModel;
use App\Models\UserModel;

class Servis extends BaseController
{
	public function index()
	{   
        $servis = new ServisModel();
        $antrian = $servis->where('status_servis','antrian')->orderBy('tgl_masuk','DESC')->findAll();
        $proses = $servis->where('status_servis','proses')->orderBy('tgl_masuk','DESC')->findAll();
        $selesai = $servis->where('status_servis','selesai')->orderBy('tgl_masuk','DESC')->findAll();
        $diambil = $servis->where('status_servis','diambil')->orderBy('tgl_masuk','DESC')->findAll();
        $data = [
            'antrian'   => $antrian,
            'proses'    => $proses,
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
			'tgl_masuk'			    => "required|date",
			'jenis_kerusakan'  		=> 'required|alpha_numeric_space',
            'pemilik'		        => "required|alpha_numeric_space",
            'seri_laptop'           => "required|alpha_numeric_space",
            'kelengkapan_unit'      => "required"
		])) {
			return redirect()->to('/admin/servis')->with('errors', $this->validator->getErrors());
        }
        
        $no_servis          = strtotime('now');
        $tgl_masuk          = $this->request->getPost('tgl_masuk');
        $jenis_kerusakan    = $this->request->getPost('jenis_kerusakan');
        $pemilik            = $this->request->getPost('pemilik');
        $seri_laptop        = $this->request->getPost('seri_laptop');
        $kelengkapan_unit   = $this->request->getPost('kelengkapan_unit');
        $status_servis      = "antrian";
        $id_user            = session('user_id');

        $data = [
            'no_servis'         => $no_servis,
            'tgl_masuk'         => $tgl_masuk,
            'jenis_kerusakan'   => $jenis_kerusakan,
            'pemilik'           => $pemilik,
            'seri_laptop'       => $seri_laptop,
            'kelengkapan_unit'  => $kelengkapan_unit,
            'status_servis'     => $status_servis,
            'id_user'           => $id_user
        ];

        $servis = new ServisModel();
        $servis->insert($data);
 
        return redirect()->to('/admin/servis')->with('success', 'Berhasil! no servis = '.$no_servis);
    }

    //--------------------------------------------------------------------

    public function update($no_servis)
    {
        if (!$this->validate([
			'tgl_masuk'			    => "required|date",
			'jenis_kerusakan'  		=> 'required|alpha_numeric_space',
            'pemilik'		        => "required|alpha_numeric_space",
            'seri_laptop'           => "required|alpha_numeric_space",
            'kelengkapan_unit'      => "required"
		])) {
			return redirect()->to('/admin/servis')->with('errors', $this->validator->getErrors());
        }
        
        $tgl_masuk          = $this->request->getPost('tgl_masuk');
        $jenis_kerusakan    = $this->request->getPost('jenis_kerusakan');
        $pemilik            = $this->request->getPost('pemilik');
        $seri_laptop        = $this->request->getPost('seri_laptop');
        $kelengkapan_unit   = $this->request->getPost('kelengkapan_unit');
        $id_user            = session('user_id');

        $data = [
            'tgl_masuk'         => $tgl_masuk,
            'jenis_kerusakan'   => $jenis_kerusakan,
            'pemilik'           => $pemilik,
            'seri_laptop'       => $seri_laptop,
            'kelengkapan_unit'  => $kelengkapan_unit,
            'id_user'           => $id_user
        ];

        $servis = new ServisModel();
        $servis->update($no_servis, $data);
 
        return redirect()->to('/admin/servis')->with('success', 'Berhasil update no servis = '.$no_servis);
    }

    //--------------------------------------------------------------------

    public function delete($no_servis)
	{
		$servis = new ServisModel();
		$servis->delete($no_servis);
		return redirect()->to('/admin/servis')->with('success','Data berhasil dihapus!');
    }
    
    //--------------------------------------------------------------------

    public function updateStatus($no_servis, $status)
    {
        $servis = new ServisModel();
		$servis->update($no_servis, ['status_servis'=>$status]);
		return redirect()->to('/admin/servis')->with('success','Data berhasil diupdate menjadi '.$status);
    }

}
