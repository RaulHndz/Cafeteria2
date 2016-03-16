<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ExistenciaModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getAll()
	{
		$sql = "SELECT codigo,nombre,ifnull(codbarra,'') barra,tipo,estado,existencia cantidad,precio1 precio  
				FROM articulo";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	public function getFiltro($id)
	{

		$codigo = $id;
		$nombre = '%'.$id.'%';



		$sql = "SELECT codigo,nombre,ifnull(codbarra,'') barra,tipo,estado,existencia cantidad,precio1 precio  
				FROM articulo
				WHERE codigo = ? or nombre like ?";

		$query = $this->db->query($sql,array($codigo,$nombre));

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}

	public function getFiltroLimit($id)
	{

		$codigo = $id;
		$nombre = '%'.$id.'%';



		$sql = "SELECT codigo,nombre,ifnull(codbarra,'') barra,tipo,estado,existencia cantidad,precio1 precio  
				FROM articulo
				WHERE codigo = ? or nombre like ?
				LIMIT 0,10";

		$query = $this->db->query($sql,array($codigo,$nombre));

		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}



}