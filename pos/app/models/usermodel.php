<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}

	public function get_user_data($user_id)
	{
		$query = $this->db->query("SELECT id, code, name FROM user WHERE id = ? AND level = 0", array($user_id));

		if($query->num_rows() > 0)
			return $query->row();

		return false;
	}

	public function get_users()
	{
		$query = $this->db->query("SELECT	id, code, name 
								   FROM		user 
								   WHERE	level = 0");

		if ($query->num_rows() > 0)
			return $query->result();

		return false;
	}

	public function login($user, $pwrd)
	{
		$query = $this->db->query("SELECT codigo, nombre FROM usuario WHERE usuario = ? AND clave = ? AND estado = 'ACTIVO' and tipo = 'CAJERO'", array($user, $pwrd));

		if($query->num_rows() > 0)
			return $query->row();

		return false;
	}

}

/* End of file usermodel.php */
/* Location: ./application/models/usermodel.php */