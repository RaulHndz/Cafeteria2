<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CajaModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get($codigo)
	{
		$sql = "SELECT c.codigo, c.nombre, c.estado, t.nombre tienda FROM caja c INNER JOIN tienda t on c.tienda_codigo = t.codigo WHERE c.codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function getEditable($codigo)
	{
		$sql = "SELECT codigo, nombre, estado, tienda_codigo FROM caja WHERE codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function save($data)
	{
		if(is_array($data))
			return $this->db->insert('caja', $data); 
		else
			return false;
	}

	public function update($data, $codigo)
	{
		if(is_array($data))
		{
			$this->db->where('codigo', $codigo);
			return $this->db->update('caja', $data);
		}
		else
		{
			return false;
		}
	}

	public function getAll()
	{
		$sql = "SELECT codigo, nombre, estado
				FROM caja LIMIT 0, 15";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	public function getTiendas()
	{
		$query = $this->db->query("SELECT codigo, nombre FROM tienda");
		return $query->result();
	}

}

/* End of file cajamodel.php */
/* Location: ./application/models/cajamodel.php */