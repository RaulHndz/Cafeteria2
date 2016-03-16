<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Procesator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect(base_url(),'refresh');
	}

	public function saveproduct()
	{
		if($this->input->post('codigo') != '' &&
			$this->input->post('descripcion') != '' &&
			$this->input->post('peso') != '' &&
			$this->input->post('dimen') != '' &&
			$this->input->post('tipo') != '' &&
			$this->input->post('costo') != '' &&
			$this->input->post('categoria') != '' &&
			$this->input->post('precio1') != '' &&
			$this->input->post('precio2') != '' &&
			$this->input->post('estado') != '')
		{
			$data = array(
				'codigo'           => $this->input->post('codigo'),
				'nombre'           => $this->input->post('descripcion'),
				'peso'             => $this->input->post('peso'),
				'dimenciones'      => $this->input->post('dimen'),
				'tipo'             => $this->input->post('tipo'),
				'costo'            => $this->input->post('costo'),
				'fecha'            => date('Y-m-d h:i:s'),
				'categoria_codigo' => $this->input->post('categoria'),
				'precio1'          => $this->input->post('precio1'),
				'precio2'          => $this->input->post('precio2'),
				'estado'           => $this->input->post('estado')
			);

			$this->load->model('ProductModel');
	        $this->ProductModel->save($data);
		}

		redirect(base_url() . 'admin/products/');
	}

	public function updateproduct()
	{
		$codigo = $this->input->post('codigo');
		$data = array(
			'nombre'           => $this->input->post('descripcion'),
			'peso'             => $this->input->post('peso'),
			'dimenciones'      => $this->input->post('dimen'),
			'tipo'             => $this->input->post('tipo'),
			'costo'            => $this->input->post('costo'),
			'precio1'          => $this->input->post('precio1'),
			'precio2'          => $this->input->post('precio2'),
			'categoria_codigo' => $this->input->post('categoria'),
			'estado'           => $this->input->post('estado')
		);

		$this->load->model('ProductModel');
        $this->ProductModel->update($data, $codigo);

        redirect(base_url() . 'admin/products/', 'refresh');
	}

	public function savecategory()
	{
		$data = array(
			'nombre' => $this->input->post('descripcion'),
			'estado' => $this->input->post('estado')
		);

		$this->load->model('CategoryModel');
        $this->CategoryModel->save($data);

        redirect(base_url() . 'admin/categories/', 'refresh');
	}

	public function updatecategory()
	{
		$codigo = $this->input->post('codigo');
		$data = array(
			'nombre' => $this->input->post('descripcion'),
			'estado' => $this->input->post('estado')
		);

		$this->load->model('CategoryModel');
        $this->CategoryModel->update($data, $codigo);

        redirect(base_url() . 'admin/categories/', 'refresh');
	}
	

	public function savecellar()
	{
		$data = array(
			'nombre'         => $this->input->post('nombre'),
			'descripcion'    => $this->input->post('descripcion'),
			'fecha_creacion' => date('Y-m-d h:i:s'),
			'estado'         => $this->input->post('estado')
		);

		$this->load->model('CellarModel');
        $this->CellarModel->save($data);

        redirect(base_url() . 'admin/cellars/', 'refresh');
	}

	public function updatecellar()
	{
		$codigo = $this->input->post('codigo');
		$data = array(
			'nombre'      => $this->input->post('nombre'),
			'descripcion' => $this->input->post('descripcion'),
			'estado'      => $this->input->post('estado')
		);

		$this->load->model('CellarModel');
        $this->CellarModel->update($data, $codigo);

        redirect(base_url() . 'admin/cellars/', 'refresh');
	}

	public function saveclient()
	{
		if($this->input->post('nombre') != '' &&
			$this->input->post('telefono') != '' &&
			$this->input->post('direccion') != '' &&
			$this->input->post('dui') != '' &&
			$this->input->post('carnet') != '' &&
			$this->input->post('estado') != '' &&
			$this->input->post('credito') != '')
		{
			$data = array(
				'nombre'    => $this->input->post('nombre'),
				'telefono'  => $this->input->post('telefono'),
				'direccion' => $this->input->post('direccion'),
				'dui'       => $this->input->post('dui'),
				'carnet'    => $this->input->post('carnet'),
				'fecha'     => date('Y-m-d h:i:s'),
				'estado'    => $this->input->post('estado'),
				'credito'   => $this->input->post('credito')
			);

			$this->load->model('ClientModel');
	        $this->ClientModel->save($data);
		}
		

        redirect(base_url() . 'admin/clients/', 'refresh');
	}

	public function updateclient()
	{
		$codigo = $this->input->post('codigo');
		$data = array(
			'nombre'                => $this->input->post('nombre'),
			'telefono'              => $this->input->post('telefono'),
			'direccion'             => $this->input->post('direccion'),
			'dui'                   => $this->input->post('dui'),
			'carnet'                => $this->input->post('carnet'),
			'estado'                => $this->input->post('estado'),
			'credito'               => $this->input->post('credito')
		);

		$this->load->model('ClientModel');
        $this->ClientModel->update($data, $codigo);

        redirect(base_url() . 'admin/clients/');
	}

	public function savecaja()
	{
		$data = array(
			'nombre'        => $this->input->post('nombre'),
			'fecha'         => date('Y-m-d h:i:s'),
			'tienda_codigo' => $this->input->post('tienda'),
			'estado'        => $this->input->post('estado')
		);

		$this->load->model('CajaModel');
        $this->CajaModel->save($data);

        redirect(base_url() . 'admin/cajas/', 'refresh');
	}

	public function updatecaja()
	{
		$codigo = $this->input->post('codigo');
		$data = array(
			'nombre'        => $this->input->post('nombre'),
			'tienda_codigo' => $this->input->post('tienda'),
			'estado'        => $this->input->post('estado')
		);

		$this->load->model('CajaModel');
        $this->CajaModel->update($data, $codigo);

        redirect(base_url() . 'admin/cajas/', 'refresh');
	}

	public function savetienda()
	{
		$data = array(
			'nombre'    => $this->input->post('nombre'),
			'direccion' => $this->input->post('direccion'),
			'telefono'  => $this->input->post('telefono'),
			'estado'    => $this->input->post('estado'),
			'fecha'     => date('Y-m-d h:i:s')
		);

		$this->load->model('TiendaModel');
        $this->TiendaModel->save($data);

        redirect(base_url() . 'admin/tiendas/', 'refresh');
	}

	public function updatetienda()
	{
		$codigo = $this->input->post('codigo');
		$data = array(
			'nombre'        => $this->input->post('nombre'),
			'direccion' => $this->input->post('direccion'),
			'telefono' => $this->input->post('telefono'),
			'estado'        => $this->input->post('estado')
		);

		$this->load->model('TiendaModel');
        $this->TiendaModel->update($data, $codigo);

        redirect(base_url() . 'admin/tiendas/', 'refresh');
	}

	public function savetipopago()
	{
		$data = array(
			'nombre'    => $this->input->post('nombre'),
			'estado'    => $this->input->post('estado'),
			'fecha'     => date('Y-m-d h:i:s')
		);

		$this->load->model('TipoPagoModel');
        $this->TipoPagoModel->save($data);

        redirect(base_url() . 'admin/tipo_pagos/', 'refresh');
	}

	public function updatetipopago()
	{
		$codigo = $this->input->post('codigo');
		$data = array(
			'nombre'    => $this->input->post('nombre'),
			'estado'    => $this->input->post('estado')
		);

		$this->load->model('TipoPagoModel');
        $this->TipoPagoModel->update($data, $codigo);

        redirect(base_url() . 'admin/tipo_pagos/', 'refresh');
	}

	public function saveproveedor()
	{
		$data = array(
			'nombre'    => $this->input->post('nombre'),
			'contacto'    => $this->input->post('contacto'),
			'telefono'    => $this->input->post('telefono'),
			'estado'    => $this->input->post('estado'),
			'fecha'     => date('Y-m-d h:i:s')
		);

		$this->load->model('ProveedorModel');
        $this->ProveedorModel->save($data);

        redirect(base_url() . 'admin/proveedores/', 'refresh');
	}

	public function updateproveedor()
	{
		$codigo = $this->input->post('codigo');
		$data = array(
			'nombre'    => $this->input->post('nombre'),
			'contacto'    => $this->input->post('contacto'),
			'telefono'    => $this->input->post('telefono'),
			'estado'    => $this->input->post('estado')
		);

		$this->load->model('ProveedorModel');
        $this->ProveedorModel->update($data, $codigo);

        redirect(base_url() . 'admin/proveedores/', 'refresh');
	}

	public function saveusuario()
	{
		$data = array(
			'nombre'    => $this->input->post('nombre'),
			'usuario'    => $this->input->post('usuario'),
			'clave'    => md5($this->input->post('clave')),
			'tipo'    => $this->input->post('tipo'),
			'estado'    => $this->input->post('estado'),
			'fecha'     => date('Y-m-d h:i:s')
		);

		$this->load->model('UserModel');
        $this->UserModel->save($data);

        redirect(base_url() . 'admin/users/', 'refresh');
	}

	public function updateusuario()
	{
		$codigo = $this->input->post('codigo');

		if($this->input->post('clave') == '********')
		{
			$data = array(
				'nombre'    => $this->input->post('nombre'),
				'usuario'    => $this->input->post('usuario'),
				'tipo'    => $this->input->post('tipo'),
				'estado'    => $this->input->post('estado')
			);
		}
		else
		{
			$data = array(
				'nombre'    => $this->input->post('nombre'),
				'usuario'    => $this->input->post('usuario'),
				'clave'    => md5($this->input->post('clave')),
				'tipo'    => $this->input->post('tipo'),
				'estado'    => $this->input->post('estado')
			);
		}

		

		$this->load->model('UserModel');
        $this->UserModel->update($data, $codigo);

        redirect(base_url() . 'admin/users/', 'refresh');
	}

	public function savecajero()
	{
		$data = array(
			'usuario_codigo'    => $this->input->post('usuario'),
			'tienda_codigo'    => $this->input->post('sucursal'),
			'fecha'     => date('Y-m-d h:i:s')
		);

		$this->load->model('CajeroModel');
        $this->CajeroModel->save($data);

        redirect(base_url() . 'admin/cajeros/', 'refresh');
	}

	public function updatecajero()
	{
		$codigo = $this->input->post('codigo');

		$data = array(
			'usuario_codigo' => $this->input->post('usuario'),
			'tienda_codigo'  => $this->input->post('sucursal')
		);

		$this->load->model('CajeroModel');
        $this->CajeroModel->update($data, $codigo);

        redirect(base_url() . 'admin/cajeros/', 'refresh');
	}

	public function delete_buy($codigo)
	{
		$this->load->model('BuyModel');
        $this->BuyModel->delete($codigo);

        redirect(base_url() . 'admin/buys');
	}

	public function process_buy($compra)
	{
		if($compra)
		{
			$this->load->model('BuyModel');
			$this->load->model('MovesModel');
	        $products = $this->BuyModel->getForProcess($compra);

	        foreach ($products as $product) {
	        	$this->MovesModel->buy_process($compra, $product->codigo, $product->cantidad);
	        }

	        $this->MovesModel->buy_procesed($compra);
		}
		
        redirect(base_url() . 'admin/buys');
	}

	public function carga_creditos()
	{
		$uploaddir = '';
		$uploadfile = 'lote.xls'; //$uploaddir . basename($_FILES['lote']['name']);

		echo '<pre>';
		if (move_uploaded_file($_FILES['lote']['tmp_name'], $uploadfile)) {
		    
			$this->load->model('ClientModel');
			require_once "Classes/PHPExcel/IOFactory.php";
			
			
			$objPHPExcel = PHPExcel_IOFactory::load("lote.xls");
			$objHoja = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true); // <- obtenemos los datos de la hoja activa (la primera)

			foreach ($objHoja as $iIndice=>$objCelda) {
				$client = $objCelda['A'];
				$credit = $objCelda['B'];

				$this->ClientModel->updateCredit($client, $credit);
			}
		}

		redirect(base_url() . 'admin/clients');
	}

}

/* End of file procesator.php */
/* Location: ./application/controllers/procesator.php */