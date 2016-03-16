<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ClientModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get($codigo)
	{
		$sql = "SELECT * FROM cliente WHERE codigo = ?";
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


	public function getCliente($cliente)
	{

		$codigo = $cliente;
		$nombre = '%'.$cliente.'%';
		$carnet = '%'.$cliente.'%';

		$sql = "SELECT * FROM cliente where codigo = ? or nombre like ? or carnet like ? LIMIT 0, 30";
		$query = $this->db->query($sql,array($codigo,$nombre,$carnet));

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	public function getAll()
	{
		$sql = "SELECT * FROM cliente LIMIT 0, 30";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	public function updateCredit($client, $credit)
	{
		//$this->db->where('carnet', $client);
		//return $this->db->update('cliente', array('credito' => $credit));

		$this->db->query("UPDATE cliente set credito = credito+? where carnet = ?",array($credit,$client));
	}

}

/* End of file clientmodel.php */
/* Location: ./application/models/clientmodel.php */