<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
	public function index()
	{
		return view('auth/login');
	}

    //--------------------------------------------------------------------
    
    public function login()
	{
		$session 	= session();
		$model 		= new UserModel();
		$email 		= $this->request->getVar('email');
		$password 	= $this->request->getVar('password');
		$data 		= $model->where('email', $email)->first();

		if ($data) {
			$pass = $data['password'];
			$verify_pass = password_verify($password, $pass);

			if ($verify_pass) {
				// echo "<h1>Berhasil login</h1>";
				$ses_data = [
					'user_id'		=> $data['id_user'],
					'user_name'		=> $data['nama_user'],
					'user_email' 	=> $data['email'],
					'user_role'		=> $data['peran'],
					'logged_in'		=> TRUE
				];

				$session->set($ses_data);
				return redirect()->to('/admin');
			} else {
				// echo "<h1>Password salah</h1>";
				$session->setFlashdata('errors', 'Password salah!');
				return redirect()->to('/login');
			}
		} else {
			// echo "<h1>Email salah</h1>";
			$session->setFlashdata('errors', 'Email salah!');
			return redirect()->to('/login');
		}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to('/login');
	}

}
