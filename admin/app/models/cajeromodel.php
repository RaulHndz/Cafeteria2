<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CajeroModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get($codigo)
	{
		$sql = "SELECT	cs.codigo, u.nombre, u.usuario, t.nombre tienda, u.estado
				FROM	cajeros_sucursal cs INNER JOIN
						usuario u on cs.usuario_codigo = u.codigo
						INNER JOIN tienda t on t.codigo = cs.tienda_codigo 
				WHERE	cs.codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function getEditable($codigo)
	{
		$sql = "SELECT * FROM cajeros_sucursal WHERE codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function save($data)
	{
		if(is_array($data))
			return $this->db->insert('cajeros_sucursal', $data); 
		else
			return false;
	}

	public function update($data, $codigo)
	{
		if(is_array($data))
		{
			$this->db->where('codigo', $codigo);
			return $this->db->update('cajeros_sucursal', $data);
		}
		else
		{
			return false;
		}
	}

	public function getAll()
	{
		$sql = "SELECT	cs.codigo, u.nombre, u.usuario, t.nombre tienda, u.estado
				FROM	cajeros_sucursal cs INNER JOIN
						usuario u on cs.usuario_codigo = u.codigo
						INNER JOIN tienda t on t.codigo = cs.tienda_codigo LIMIT 0, 15";
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

	public function getUsuarios()
	{
		$sql = "SELECT codigo, usuario
				FROM usuario WHERE tipo = 'CAJERO' LIMIT 0, 15";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

}

/* End of file cajeromodel.php */
/* Location: ./application/models/cajeromodel.php */