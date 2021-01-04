<?php namespace App\Controllers;

use App\Models\ServisModel;

class Home extends BaseController
{
	public function index()
	{
		return view('home');
	}

	//--------------------------------------------------------------------

	public function cekStatus()
	{	
		if (!$this->validate([
			'nomor'=>'required|numeric'
		])) {
			return redirect()->to('/')->with('errors', $this->validator->getErrors());
		}

		$no_servis = $this->request->getVar('nomor');

		$servis 	= new ServisModel();
		$cekServis	= $servis->where('no_servis',$no_servis)->first();

		if ($cekServis==null) {
			return redirect()->to('/')->with('errors', 'Servis tidak ditemukan!');
		}
		// dd($cekServis);
		return view('home', ['servis'=>$cekServis]);
	}

}
