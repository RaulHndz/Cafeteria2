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
		$data = array(
			'codigo'           => $this->input->post('codigo'),
			'nombre'           => $this->input->post('descripcion'),
			'peso'             => $this->input->post('peso'),
			'dimenciones'      => $this->input->post('dimen'),
			'tipo'             => $this->input->post('tipo'),
			'costo'            => $this->input->post('costo'),
			'fecha'            => date('Y-m-d h:i:s'),
			'categoria_codigo' => $this->input->post('categoria'),
			'estado'           => $this->input->post('estado')
		);

		$this->load->model('ProductModel');
        $this->ProductModel->save($data);

        redirect(base_url() . 'admin/products/', 'refresh');
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
		$data = array(
			'nombre'                => $this->input->post('nombre'),
			'telefono'              => $this->input->post('telefono'),
			'direccion'             => $this->input->post('direccion'),
			'documento'             => $this->input->post('documento'),
			'fecha'                 => date('Y-m-d h:i:s'),
			'tipo_documento_codigo' => $this->input->post('doctype'),
			'estado'                => $this->input->post('estado')
		);

		$this->load->model('ClientModel');
        $this->ClientModel->save($data);

        redirect(base_url() . 'admin/clients/', 'refresh');
	}

	public function updateclient()
	{
		$codigo = $this->input->post('codigo');
		$data = array(
			'nombre'                => $this->input->post('nombre'),
			'telefono'              => $this->input->post('telefono'),
			'direccion'             => $this->input->post('direccion'),
			'documento'             => $this->input->post('documento'),
			'tipo_documento_codigo' => $this->input->post('doctype'),
			'estado'                => $this->input->post('estado')
		);

		$this->load->model('ClientModel');
        $this->ClientModel->update($data, $codigo);

        redirect(base_url() . 'admin/clients/', 'refresh');
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

}

/* End of file procesator.php */
/* Location: ./application/controllers/procesator.php */