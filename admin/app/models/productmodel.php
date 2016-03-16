<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get($codigo)
	{
		$sql = "SELECT a.*, c.nombre as categoria
				FROM articulo a inner join categoria c on a.categoria_codigo = c.codigo
				WHERE a.codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function getEditable($codigo)
	{
		$sql = "SELECT * FROM articulo WHERE codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function save($data)
	{
		if(is_array($data))
			return $this->db->insert('articulo', $data); 
		else
			return false;
	}

	public function update($data, $codigo)
	{
		if(is_array($data))
		{
			$this->db->where('codigo', $codigo);
			return $this->db->update('articulo', $data);
		}
		else
		{
			return false;
		}
	}

	public function getAll()
	{
		$sql = "SELECT a.codigo, a.nombre, a.estado, a.costo, c.nombre as categoria
				FROM articulo a inner join categoria c on a.categoria_codigo = c.codigo LIMIT 0, 15";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	public function getCategories()
	{
		$query = $this->db->query("SELECT codigo, nombre FROM categoria");
		return $query->result();
	}

}

/* End of file productmodel.php */
/* Location: ./application/models/productmodel.php */