<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TipoPagoModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get($codigo)
	{
		$sql = "SELECT codigo, nombre, estado FROM formas_pago WHERE codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function getEditable($codigo)
	{
		$sql = "SELECT codigo, nombre, estado FROM formas_pago WHERE codigo = ?";
		$query = $this->db->query($sql, $codigo);

		if($query->num_rows() > 0)
			return $query->row();
		else
			return false;
	}

	public function save($data)
	{
		if(is_array($data))
			return $this->db->insert('formas_pago', $data); 
		else
			return false;
	}

	public function update($data, $codigo)
	{
		if(is_array($data))
		{
			$this->db->where('codigo', $codigo);
			return $this->db->update('formas_pago', $data);
		}
		else
		{
			return false;
		}
	}

	public function getAll()
	{
		$sql = "SELECT codigo, nombre, estado
				FROM formas_pago LIMIT 0, 15";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

}

/* End of file tipopagomodel.php */
/* Location: ./application/models/tipopagomodel.php */