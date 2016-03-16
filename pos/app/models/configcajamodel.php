<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ConfigCajaModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function aperturarcaja($caja,$monto,$usuario){

		
		$sql ="CALL AperturarCaja(?,?,?)";


		$query = $this->db->query($sql,array($caja,$monto,$usuario));

		return 'listo';



	}

	public function cerrarcaja_($cierre,$monto,$tipo,$venta){

		
		$sql ="CALL ControlCaja(?,?,?,?)";


		$query = $this->db->query($sql,array($cierre,$monto,$tipo,$venta));

		return 'listo';



	}

	public function datacierre($cierre){

		
		$sql ="CALL DatosCerraCaja (?)";


		$query = $this->db->query($sql,$cierre);

		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}




	}

	public function detfac($factura,$articulo,$cantidad,$precio){

		
		$sql ="CALL GuardarFactura_det(?,?,?,?)";


		$query = $this->db->query($sql,array($factura,$articulo,$cantidad,$precio));

		return 'listo';



	}

	public function masterfac($cierre_caja,$forma,$total,$cliente){

		
		$sql ="CALL GuardarFactura(?,?,?,?)";


		$query = $this->db->query($sql,array($cierre_caja,$forma,$total,$cliente));

		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}



	}

	public function datosArticulo($articulo){

		
		$sql ="SELECT * FROM articulo where codigo = ? ";

		$query = $this->db->query($sql,$articulo);

		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}



	}

	public function datosEmpleado($empleado){

		
		$sql ="SELECT * FROM cliente where carnet = ? ";

		$query = $this->db->query($sql,$empleado);

		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}



	}


	public function validarCaja($identificador){

		
		$sql ="SELECT codigo FROM caja where identificador = ? ";

		$query = $this->db->query($sql,$identificador);

		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}



	}

	

	public function datosCaja($idcaja){

		
		$sql =" SELECT 	u.nombre usuario,fecha_apertura fecha,monto 
				from 	cierre_caja  cc 
						inner join usuario u on cc.usuario_codigo = u.codigo
				where caja_codigo = ? and fechas_cierre is null";

		$query = $this->db->query($sql,$idcaja);

		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}


	}

	public function cajaAbierta($idcaja){

		$sql =" SELECT 	c.nombre caja, u.nombre usuario,fecha_apertura fecha,monto,cc.codigo cierre
				from 	cierre_caja  cc 
						inner join usuario u on cc.usuario_codigo = u.codigo
						inner join caja c on cc.caja_codigo = c.codigo
				where caja_codigo = ? and fechas_cierre is null";

		$query = $this->db->query($sql,$idcaja);

		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function ventaEmpleado($idmepleado){

		
		$sql ="SELECT 	f.documento,
						c.carnet,
				        c.nombre,
				        f.id_formadepago as tipopago, 
				        f.fecha,
				        f.monto
				from 	factura f 
						inner join cliente c on f.cliente_codigo = c.codigo
				where 	c.carnet = ?
				order by f.fecha DESC
				LIMIT 0,30;";


		$query = $this->db->query($sql,$idmepleado);

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}



	}

	public function ventaCierre($cierre){

		
		$sql ="SELECT 	f.documento,
						c.carnet,
				        c.nombre,
				        f.id_formadepago as tipopago, 
				        f.fecha,
				        f.monto
				from 	factura f 
						inner join cliente c on f.cliente_codigo = c.codigo
				where 	f.cierre_caja_codigo = ?
				order by f.fecha DESC
				LIMIT 0,30;";


		$query = $this->db->query($sql,$cierre);

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}



	}


}




/* End of file configcajamodel.php */
/* Location: ./application/models/configcajamodel.php */