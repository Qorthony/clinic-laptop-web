<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
	public function index()
	{
		$user = new UserModel();
		$userAll = $user->findAll();
		return view('admin/user/index', ['data_users' => $userAll]);
	}

	//--------------------------------------------------------------------

	public function add()
	{
		if (!$this->validate([
			'email' 		=> "required|is_unique[users.email]|valid_email",
			'nama'  		=> 'required|alpha_numeric_space',
			'peran'			=> "required",
			'password'		=> "required"
		])) {
			return redirect()->to('/admin/user')->with('errors', $this->validator->getErrors());
		}

		$nama 		= $this->request->getPost('nama');
		$email 		= $this->request->getPost('email');
		$peran 		= $this->request->getPost('peran');
		$password 	= $this->request->getPost('password');

		$user = new UserModel;
		$data = [
			'nama_user'		=> $nama,
			'email'			=> $email,
			'password'		=> password_hash($password, PASSWORD_DEFAULT),
			'peran' 		=> $peran,
		];
		// dd($data);
		$user->insert($data);

		return redirect()->to('/admin/user')->with('success', 'Berhasil menambah user!');
	}

	//--------------------------------------------------------------------

	public function edit($id)
	{
		if (!$this->validate([
			'email' 		=> "required|valid_email",
			'nama'  		=> 'required|alpha_numeric_space',
			'peran'			=> "required",
		])) {
			return redirect()->to('/admin/user')->with('errors', $this->validator->getErrors());
		}

		$nama 		= $this->request->getPost('nama');
		$email 		= $this->request->getPost('email');
		$peran 		= $this->request->getPost('peran');
		$password 	= $this->request->getPost('password');

		$user = new UserModel;
		$data = [
			'nama_user'		=> $nama,
			'email'			=> $email,
			'peran' 		=> $peran,
		];
		if ($password != null) {
			$data['password'] = password_hash($password, PASSWORD_DEFAULT);
		}

		// dd($data);

		$user->update($id, $data);

		return redirect()->to('/admin/user')->with('success', 'Berhasil edit user!');
	}

	//--------------------------------------------------------------------

	public function delete($id)
	{
		$user = new UserModel();
		$user->delete($id);
		return redirect()->to('/admin/user')->with('success', 'Data berhasil dihapus!');
	}

	//--------------------------------------------------------------------

	public function search()
	{
		$keyword = $this->request->getVar('keyword');

		$servis = new UserModel();
		$result =  $servis->like('nama_user', $keyword)
			->orLike('email', $keyword)
			->findAll();

		$data = [
			'data_users' => $result
		];

		// dd($data); 
		return view('admin/user/index', $data);
	}

	//--------------------------------------------------------------------

	public function profile()
	{	
		$user = new UserModel();
		$profile = $user->find(session('user_id'));
		// dd($profile);
		return view('admin/user/profile',["profile"=>$profile	]);
	}

	//--------------------------------------------------------------------

	public function updateProfile()
	{
		$nama 		= $this->request->getPost('nama');
		$email 		= $this->request->getPost('email');

		if (!$this->validate([
			'email' 		=> "required|is_unique[users.email,email,{$email}]|valid_email",
			'nama'  		=> "required|alpha_numeric_space",
		])) {
			return redirect()->to('/admin/profile')->with('errors', $this->validator->getErrors());
		}

		$user = new UserModel();
		$data = [
			"nama_user"		=> $nama,
			"email"			=> $email,
		];
		$user->update(session("user_id"), $data);

		return redirect()->to('/admin/profile')->with('success', 'Berhasil edit profile!');
	}

	//--------------------------------------------------------------------

	public function changePassword()
	{
		$pw_baru 		= $this->request->getPost("password_baru");

		if (!$this->validate([
			"password_baru"			=> "required",
			"konfirmasi_password"	=> "required|matches[password_baru]"
		])) {
			return redirect()->to('/admin/profile')->with('errors', $this->validator->getErrors());
		}
		
		$user = new UserModel();
		$user->update(session("user_id"), ["password"=>password_hash($pw_baru, PASSWORD_DEFAULT)]);

		return redirect()->to('/admin/profile')->with('success', 'Berhasil ganti password!');

	}
}
