<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ClientModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get($codigo)
	{
		$sql = "SELECT c.*, t.nombre tipo_doc FROM cliente c INNER JOIN tipo_documento t on c.tipo_documento_codigo = t.codigo WHERE c.codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function getEditable($codigo)
	{
		$sql = "SELECT * FROM cliente WHERE codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function save($data)
	{
		if(is_array($data))
			return $this->db->insert('cliente', $data); 
		else
			return false;
	}

	public function update($data, $codigo)
	{
		if(is_array($data))
		{
			$this->db->where('codigo', $codigo);
			return $this->db->update('cliente', $data);
		}
		else
		{
			return false;
		}
	}

	public function getAll()
	{
		$sql = "SELECT c.*, t.nombre tipo_doc FROM cliente c INNER JOIN tipo_documento t on c.tipo_documento_codigo = t.codigo LIMIT 0, 15";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	public function getDocTypes()
	{
		$query = $this->db->query("SELECT codigo, nombre FROM tipo_documento");
		return $query->result();
	}

}

/* End of file clientmodel.php */
/* Location: ./application/models/clientmodel.php */