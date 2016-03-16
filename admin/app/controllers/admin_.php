<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('logged_in'))
        {
            redirect(base_url() . 'user/');
            exit;
        }
    }

	public function index()
	{
		$data = array( 'assets_uri' => base_url() . 'assets/admin/', 'option' => 'admin/home' );
		$this->load->view('admin/master', $data);
	}

    //ADMINISTRACION DE ARTICULOS
    public function products()
    {
        $this->load->model('ProductModel');
        $categories = $this->ProductModel->getCategories();
        $products = $this->ProductModel->getAll();

        $data = array( 
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/products/products',
            'categories' => $categories,
            'products' => $products
        );

        $this->load->view('admin/master', $data);
    }

    public function categories()
    {
        $this->load->model('CategoryModel');
        $categories = $this->CategoryModel->getAll();

        $data = array( 
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/products/categories',
            'categories' => $categories
        );

        $this->load->view('admin/master', $data);
    }

    public function cellars()
    {
        $this->load->model('CellarModel');
        $cellars = $this->CellarModel->getAll();

        $data = array( 
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/products/cellars',
            'cellars' => $cellars
        );

        $this->load->view('admin/master', $data);
    }

    public function clients()
    {
        $this->load->model('ClientModel');
        $clients = $this->ClientModel->getAll();

        $data = array(
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/clients/clients',
            'clients' => $clients
        );
        $this->load->view('admin/master', $data);
    }

    // ADMINISTRACION DE ARTICULOS


    // ADMINISTRACION

    public function users()
    {
        $this->load->model('UserModel');
        $usuarios = $this->UserModel->getAll();

        $data = array(
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/administracion/users',
            'usuarios' => $usuarios
        );
        $this->load->view('admin/master', $data);
    }

    public function proveedores()
    {
        $this->load->model('ProveedorModel');
        $proveedores = $this->ProveedorModel->getAll();
        //$clients = $this->ProveedorModel->getAll();

        $data = array(
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/administracion/proveedores',
            'proveedores' => $proveedores
        );
        $this->load->view('admin/master', $data);
    }

    public function cajas()
    {
        $this->load->model('CajaModel');
        $cajas = $this->CajaModel->getAll();
        $tiendas = $this->CajaModel->getTiendas();

        $data = array( 
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/administracion/cajas',
            'cajas' => $cajas,
            'tiendas' => $tiendas
        );

        $this->load->view('admin/master', $data);
    }

    public function cajeros()
    {
        $this->load->model('CajeroModel');
        $cajeros = $this->CajeroModel->getAll();
        $tiendas = $this->CajeroModel->getTiendas();
        $usuarios = $this->CajeroModel->getUsuarios();

        $data = array(
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/administracion/cajeros',
            'cajeros' => $cajeros,
            'usuarios' => $usuarios,
            'tiendas' => $tiendas
        );
        $this->load->view('admin/master', $data);
    }

    public function tiendas()
    {
        $this->load->model('TiendaModel');
        $tiendas = $this->TiendaModel->getAll();

        $data = array( 
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/administracion/tiendas',
            'tiendas' => $tiendas
        );

        $this->load->view('admin/master', $data);
    }

    public function tipo_pagos()
    {
        $this->load->model('TipoPagoModel');
        $tipopagos = $this->TipoPagoModel->getAll();

        $data = array( 
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/administracion/tipo_pagos',
            'tipopagos' => $tipopagos
        );

        $this->load->view('admin/master', $data);
    }

    // ADMINISTRACION

    public function inventory()
    {
        $data = array( 'assets_uri' => base_url() . 'assets/admin/', 'option' => 'admin/inventory/inventory' );
        $this->load->view('admin/master', $data);
    }

    public function buys()
    {
        $this->load->model('BuyModel');
        $buys = $this->BuyModel->getAll();
        
        $data = array( 
            'assets_uri' => base_url() . 'assets/admin/', 
            'option'     => 'admin/inventory/buys',
            'buys'       => $buys
        );

        $this->load->view('admin/master', $data);
    }

    public function buy($codigo = null)
    {
        $this->load->model('BuyModel');
        if($codigo == null)
        {
            $codigo = $this->BuyModel->create();
        }

        //$this->load->model('BuyModel');
        $buy = $this->BuyModel->getDetail($codigo);
        $providers = $this->BuyModel->getProviders();
        $data = array(
            'compra_codigo' => $codigo,
            'assets_uri'    => base_url() . 'assets/admin/',
            'option'        => 'admin/inventory/buy',
            'buy'           => $buy,
            'providers'     => $providers
        );
        $this->load->view('admin/master', $data);
    }

    public function adjust()
    {
        $data = array( 'assets_uri' => base_url() . 'assets/admin/', 'option' => 'admin/inventory/adjust' );
        $this->load->view('admin/master', $data);
    }

    public function kardex()
    {
        $data = array( 'assets_uri' => base_url() . 'assets/admin/', 'option' => 'admin/inventory/kardex' );
        $this->load->view('admin/master', $data);
    }

    public function reports()
    {
        $this->load->model('ReportsModel');

        $year = ($this->input->post('year')) ? '2015' : $this->input->post('year');
        $month = ($this->input->post('month')) ? '8' : $this->input->post('month');

        $cierres = $this->ReportsModel->cierres($year, $month);
        $totales = $this->ReportsModel->totales_cierres($year, $month);
        $data = array(
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/reports/reports',
            'cierres' => $cierres,
            'total_credito' => $totales->credito,
            'total_no_credito' => $totales->no_credito,
            'year' => $year,
            'month' => $month
        );

        $this->load->view('admin/master', $data);
    }

    public function facturas($cierre)
    {
        $this->load->model('ReportsModel');

        $facturas = $this->ReportsModel->facturas($cierre);
        //$totales = $this->ReportsModel->totales_cierres($year, $month);
        $data = array(
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/reports/facturas',
            'facturas' => $facturas/*,
            'total_credito' => $totales->credito,
            'total_no_credito' => $totales->no_credito,
            'year' => $year,
            'month' => $month*/
        );

        $this->load->view('admin/master', $data);
    }

}

/* End of file admin.php */
/* Location: app/controllers/admin.php */