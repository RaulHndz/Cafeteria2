<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BuyModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getAll()
	{
		$query = $this->db->query("SELECT c.codigo, c.descripcion, p.nombre proveedor FROM compra c inner join proveedor p on c.proveedor_codigo = p.codigo WHERE c.procesada = 'N' ORDER BY c.codigo DESC LIMIT 0, 15");
		return $query->result();
	}

	public function getProducts($q)
	{
		$q = '%' . $q . '%';
		$query = $this->db->query("SELECT codigo, nombre FROM articulo WHERE (codigo LIKE ? OR nombre LIKE ?) AND estado = 'ACTIVO' AND tipo = 'Producto' LIMIT 0, 25", array($q, $q));
		return $query->result();
	}

	public function getDetail($codigo_compra)
	{
		$query = $this->db->query("SELECT d.codigo, a.nombre producto, d.cantidad FROM articulo a inner join compra_detalle d on d.articulo_codigo = a.codigo where d.compra_codigo = ?", $codigo_compra);
		return $query->result();
	}

	public function saveProduct($compra, $producto, $cantidad)
	{
		$data = array(
			'compra_codigo'   => $compra,
			'articulo_codigo' => $producto,
			'cantidad'        => $cantidad,
		);
		$this->db->insert('compra_detalle', $data);

		$query = $this->db->query("SELECT d.codigo, a.nombre producto, d.cantidad FROM articulo a inner join compra_detalle d on d.articulo_codigo = a.codigo WHERE d.compra_codigo = ?", $compra);
		return $query->result();
	}

	public function saveBuy($compra, $provider, $description)
	{
		$data = array(
			'proveedor_codigo' => $provider,
			'descripcion'      => $description
		);

		$this->db->where('codigo', $compra);
		$this->db->update('compra', $data); 

		return true;
	}

	public function deleteProduct($codigo, $compra)
	{
		$this->db->delete('compra_detalle', array('codigo' => $codigo));

		$query = $this->db->query("SELECT d.codigo, a.nombre producto, d.cantidad FROM articulo a inner join compra_detalle d on d.articulo_codigo = a.codigo where d.compra_codigo = ?", $compra);
		return $query->result();
	}

	public function getProviders()
	{
		$query = $this->db->query("SELECT codigo, nombre FROM proveedor");
		return $query->result();
	}

	public function create()
	{
		$data = array(
			'descripcion' => 'Nueva compra',
			'proveedor_codigo' => '1',
			'procesada' => 'N',
			'fecha' => date('Y-m-d h:i:s')
		);
		$this->db->insert('compra', $data);

		$query = $this->db->query("SELECT max(codigo) codigo FROM compra");

		$compra = $query->row();
		return $compra->codigo;
	}

	public function delete($codigo_compra)
	{
		$this->db->delete('compra_detalle', array('compra_codigo' => $codigo_compra));
		$this->db->delete('compra', array('codigo' => $codigo_compra));
		return true;
	}

	public function getForProcess($compra)
	{
		$query = $this->db->query("SELECT a.codigo, d.cantidad FROM articulo a inner join compra_detalle d on d.articulo_codigo = a.codigo where d.compra_codigo = ?", $compra);
		$this->db->delete('compra_detalle', array('compra_codigo' => $compra));
		return $query->result();
	}

}

/* End of file buymodel.php */
/* Location: ./application/models/buymodel.php */