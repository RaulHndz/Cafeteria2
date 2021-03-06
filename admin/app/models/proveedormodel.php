<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProveedorModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get($codigo)
	{
		$sql = "SELECT * FROM proveedor WHERE codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function getEditable($codigo)
	{
		$sql = "SELECT * FROM proveedor WHERE codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function save($data)
	{
		if(is_array($data))
			return $this->db->insert('proveedor', $data); 
		else
			return false;
	}

	public function update($data, $codigo)
	{
		if(is_array($data))
		{
			$this->db->where('codigo', $codigo);
			return $this->db->update('proveedor', $data);
		}
		else
		{
			return false;
		}
	}

	public function getAll()
	{
		$sql = "SELECT * FROM proveedor LIMIT 0, 15";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

}

/* End of file proveedormodel.php */
/* Location: ./application/models/proveedormodel.php */