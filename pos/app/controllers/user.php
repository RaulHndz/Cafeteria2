<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('logged_in2'))
        {
            redirect(base_url() . 'admin/');
        }
        else
        {
			$data = array(
				'assets_uri'   => base_url() . 'assets/admin/',
				'site_title'   => 'Administrador',
            );

			$this->load->view('admin/login', $data);
		}
	}

	public function sigin()
	{
		usleep(500000);
		$this->load->model('UserModel');
		$idcaja = $this->input->post('idcaja');
		$user = $this->input->post('user');
		$pwrd = md5($this->input->post('pwrd'));

		$user_data = $this->UserModel->login($user, $pwrd);
		if($user_data)
		{
			$logindata = array(
				'user_id2'  => $user_data->codigo,
            	'user_name2'  => $user_data->nombre,
            	'logged_in2' => true,
            	'codcaja' => $idcaja
            );

			$this->session->set_userdata($logindata);
			redirect(base_url());
		}
		else
		{
			redirect(base_url() . 'user/');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url() . 'user/');
	}

}

/* End of file sigin.php */
/* Location: app/controllers/sigin.php */