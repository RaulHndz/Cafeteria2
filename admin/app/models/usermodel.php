<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {

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
								   WHERE	tipo = 'ADMINISTRADOR' ");

		if ($query->num_rows() > 0)
			return $query->result();

		return false;
	}

	public function login($user, $pwrd)
	{
		$query = $this->db->query("SELECT codigo, nombre FROM usuario WHERE usuario = ? AND clave = ? AND estado = 'ACTIVO' and tipo = 'ADMINISTRADOR'", array($user, $pwrd));

		if($query->num_rows() > 0)
			return $query->row();

		return false;
	}


	// MODEL
	public function get($codigo)
	{
		$sql = "SELECT * FROM usuario WHERE codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function getEditable($codigo)
	{
		$sql = "SELECT * FROM usuario WHERE codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function save($data)
	{
		if(is_array($data))
			return $this->db->insert('usuario', $data); 
		else
			return false;
	}

	public function update($data, $codigo)
	{
		if(is_array($data))
		{
			$this->db->where('codigo', $codigo);
			return $this->db->update('usuario', $data);
		}
		else
		{
			return false;
		}
	}

	public function getAll()
	{
		$sql = "SELECT *
				FROM usuario LIMIT 0, 15";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}


}

/* End of file usermodel.php */
/* Location: ./application/models/usermodel.php */