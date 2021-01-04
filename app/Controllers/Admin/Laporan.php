<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ServisModel;
use CodeIgniter\I18n\Time;

class Laporan extends BaseController
{
	public function index()
	{   
        $servis = new ServisModel();
        $data_pendapatan = $servis->where('status_servis','diambil')->findAll();

        $pendapatanTotal = $servis->selectSum('biaya_servis')->first();

        $pendapatanTahunIni = $servis->selectSum('biaya_servis')
			->where('tgl_diambil >', date('Y-m-d', strtotime(date('Y')."-01-01")))
			->where('tgl_diambil <', date('Y-m-d', strtotime(date('Y')."-12-31")))
            ->first();

        $pendapatanBulanIni = $servis->selectSum('biaya_servis')
			->where('tgl_diambil >', date('Y-m-', strtotime(Time::now())) . '1')
			->where('tgl_diambil <', date('Y-m-t', strtotime(Time::now())))
            ->first();
            
        $data = [
            'data_pendapatan'       => $data_pendapatan,
            'pendapatan_bulan_ini'  =>$pendapatanBulanIni['biaya_servis'],
            'pendapatan_tahun_ini'  => $pendapatanTahunIni['biaya_servis'],
            'pendapatan_total'      => $pendapatanTotal['biaya_servis']
        ];
        // dd($data);
		return view('admin/laporan/index', $data);
	}

	//--------------------------------------------------------------------

}
