<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReportsModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function cierres($year, $month)
	{
		$sql = "SELECT	c.nombre `caja`, cc.codigo cierre, cc.fecha_apertura, cc.fechas_cierre, u.nombre `usuario`, SUM(f.monto) monto
				FROM		factura f
							INNER JOIN cierre_caja cc ON f.cierre_caja_codigo = cc.codigo
							INNER JOIN caja c ON cc.caja_codigo = c.codigo
							INNER JOIN usuario u ON cc.usuario_codigo = u.codigo
				WHERE		year(cc.fechas_cierre) = ? AND month(cc.fechas_cierre) = ? -- AND cc.fechas_cierre IS NOT NULL
				GROUP		BY f.cierre_caja_codigo ORDER BY c.nombre";

		$query = $this->db->query($sql, array($year, $month));
		return $query->result();
	}

	public function totales_cierres($year, $month)
	{
		$sql = "SELECT
					(SELECT	IFNULL(SUM(IFNULL(f.monto, 0.00)), 0.00) 
					FROM		factura f
								INNER JOIN cierre_caja cc ON f.cierre_caja_codigo = cc.codigo
					WHERE		year(cc.fechas_cierre) = ? AND month(cc.fechas_cierre) = ?
								and f.id_formadepago = 1) no_credito,
					(SELECT	IFNULL(SUM(IFNULL(f.monto, 0.00)), 0.00) 
					FROM		factura f
								INNER JOIN cierre_caja cc ON f.cierre_caja_codigo = cc.codigo
					WHERE		year(cc.fechas_cierre) = ? AND month(cc.fechas_cierre) = ?
								and f.id_formadepago = 2) credito";

		$query = $this->db->query($sql, array($year, $month, $year, $month));
		return $query->row();
	}

	public function facturas($cierre)
	{
		$sql = "SELECT	f.documento, p.nombre pago, f.fecha, c.nombre `cliente`, f.monto
				FROM		factura f
							INNER JOIN cliente c on f.cliente_codigo = c.codigo
							INNER JOIN formas_pago p ON f.id_formadepago = p.codigo 
				WHERE		f.cierre_caja_codigo = ?";

		$query = $this->db->query($sql, $cierre);
		return $query->result();
	}

}

/* End of file reportsmodel.php */
/* Location: ./application/models/reportsmodel.php */