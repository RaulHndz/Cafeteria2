<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MovesModel extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}

	public function buy_process($compra, $producto, $cantidad)
	{
		$this->db->query("UPDATE articulo SET existencia = existencia + ? WHERE codigo = ?", array($cantidad, $producto));

		$fecha = date('Y-m-d h:i:s');
		$sql = "INSERT INTO articulo_transaccion(cantidad, tipo, referencia, operacion, fecha, articulo_codigo) VALUES(?, 'COMPRA', ?, '+', ?, ? )";
		$this->db->query($sql, array($cantidad, $compra, $fecha, $producto));
		
		return true;
	}

	public function buy_procesed($compra)
	{
		$this->db->query("UPDATE compra SET procesada = 'S' WHERE codigo = ?", array($compra));		
		return true;
	}

}

/* End of file movesmodel.php */
/* Location: ./application/models/movesmodel.php */