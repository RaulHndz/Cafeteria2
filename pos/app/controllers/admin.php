<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('logged_in2'))
        {
            redirect(base_url() . 'user/');
            exit;
        }
    }

    /********************************************** FACTURACION */


     public function aperturarcaja(){

        $monto = $this->input->post('txtApertura');
        $caja = $this->input->post('idcaja');
        $usuario =  $this->session->userdata('user_id2');


        

        $this->load->model('ConfigCajaModel');
        $datafac = $this->ConfigCajaModel->aperturarcaja($caja,$monto,$usuario);

        $cajadata = array(
                'codcaja'  => $caja
            );

        $this->session->set_userdata($cajadata);

        redirect(base_url().'admin/index');

    }

    public function cerrarcaja_ok(){

        $cierre = $this->session->userdata('cierre');
        $monto = $this->input->post('txtPPago');
        $venta = $this->input->post('txtventa_');  

        $this->load->model('ConfigCajaModel');
        $datafac = $this->ConfigCajaModel->cerrarcaja_($cierre,$monto,1,$venta);

        redirect(base_url().'user/logout');

    }

    public function dcierrecaja(){
      
        $cierre = $this->input->post('cierre');
        
        $this->load->model('ConfigCajaModel');
        $datafac = $this->ConfigCajaModel->datacierre($cierre);

        print(json_encode($datafac));        

    }

    public function detfac_guardar(){
      
        $factura = $this->input->post('codfact');
        $articulo = $this->input->post('codart');
        $precio = $this->input->post('preciof');
        $cantidad = $this->input->post('cantidadf');

        $this->load->model('ConfigCajaModel');
        $datafac = $this->ConfigCajaModel->detfac($factura,$articulo,$cantidad,$precio);

        print(json_encode($datafac));        

    }

    public function masterfac_guardar(){
      

        $cierre_caja = $this->input->post('cod_cierre');
        $forma_pago = $this->input->post('forma_pago');
        $total_p = $this->input->post('total_p');
        $codigoemp = $this->input->post('codigoemp');

        $this->load->model('ConfigCajaModel');
        $datafac = $this->ConfigCajaModel->masterfac($cierre_caja,$forma_pago,$total_p,$codigoemp);

        print(json_encode($datafac));        

    }

  

    public function facturacion(){

        if($this->session->userdata('codcaja') != true || $this->session->userdata('codcaja') == 0)
        {
            redirect(base_url() . 'admin/configcaja');
            exit;
        }
      

        $data = array(  'assets_uri' => base_url() . 'assets/admin/', 
                        'option' => 'admin/facturacion'
                        );
        $this->load->view('admin/master', $data);

    }

    public function ventacierre(){

        $cierre = $this->session->userdata('cierre');
        $this->load->model('ConfigCajaModel');
        $dataventa = $this->ConfigCajaModel->ventacierre($cierre);

        print(json_encode($dataventa));    

    }


    public function ventaempleado(){

        $idempleado = $this->input->post('idempleado');
        $this->load->model('ConfigCajaModel');
        $dataempleado = $this->ConfigCajaModel->ventaempleado($idempleado);

        print(json_encode($dataempleado));    

    }


    public function detalleempleado(){
      
        $idempleado = $this->input->post('idempleado');
        $this->load->model('ConfigCajaModel');
        $dataempleado = $this->ConfigCajaModel->datosEmpleado($idempleado);

        print(json_encode($dataempleado));        

    }

     public function detarticulo(){
      
        $idarticulo = $this->input->post('idarticulo');
        $this->load->model('ConfigCajaModel');
        $dataarticulo = $this->ConfigCajaModel->datosArticulo($idarticulo);

        print(json_encode($dataarticulo));        

    }



    /************************************************************/

    /********************************************** EXISTENCIA */

    public function existencias(){

        $this->load->model('ExistenciaModel');
        $articulos = $this->ExistenciaModel->getAll();
        $data = array( 
                    'assets_uri' => base_url() . 'assets/admin/', 
                    'option' => 'admin/existencia',
                    'articulos' => $articulos
                );
        $this->load->view('admin/master', $data);

    }

    public function existfiltrolimit(){

        $id = $this->input->post('busqueda');
        $this->load->model('ExistenciaModel');
        $articulos = $this->ExistenciaModel->getFiltroLimit($id);

        $data = array(
            'articulos' => $articulos
        );

        print(json_encode($data));
        //var_dump($data);

    }

    public function existfiltro(){

        $id = $this->input->post('busqueda');
        $this->load->model('ExistenciaModel');
        $articulos = $this->ExistenciaModel->getFiltro($id);

        $data = array(
            'articulos' => $articulos
        );

        print(json_encode($data));
        //var_dump($data);

    }



    /*****************************************************/


  /**************************************************** CAJA */

  public  function configcaja(){

        if($this->session->userdata('codcaja') != 0)
        {
            redirect(base_url() . 'admin/index');
            exit;
        }

        $data = array(  'assets_uri' => base_url() . 'assets/admin/', 
                        'option' => 'admin/configcaja'
                        );
        $this->load->view('admin/master', $data);

  }   

  public function validarcaja(){

        $identificador = $this->input->post('identificador');
        $this->load->model('ConfigCajaModel');
        $cajas = $this->ConfigCajaModel->validarCaja($identificador);

        $data = array(
            'caja' => $cajas
        );

        print(json_encode($cajas));

  }

  public function datoscaja(){

        $idcaja = $this->input->post('idcaja');
        $this->load->model('ConfigCajaModel');
        $dcaja = $this->ConfigCajaModel->datosCaja($idcaja);
     

        print(json_encode($dcaja));


  }

  public function entrarcaja(){

        $idcaja = $this->input->post('idcaja');
        $cajadata = array(
                'codcaja'  => $idcaja
            );

        $this->session->set_userdata($cajadata);
        redirect(base_url(). 'admin/index');
  }



  /*****************************************************/

	public function index()
	{

    

        if($this->session->userdata('codcaja') != true || $this->session->userdata('codcaja') == 0)
        {
            redirect(base_url() . 'admin/configcaja');
            exit;
        }

        $idcaja = $this->session->userdata('codcaja');
        $this->load->model('ConfigCajaModel');
        $dcaja = $this->ConfigCajaModel->cajaAbierta($idcaja);

        $datacierre = array(
                'cierre'  => $dcaja->cierre
            );

        $this->session->set_userdata($datacierre);


		$data = array(  'assets_uri' => base_url() . 'assets/admin/', 
                        'option' => 'admin/home',
                        'caja' => $dcaja
                        );
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
        $doctypes = $this->ClientModel->getDocTypes();
        $clients = $this->ClientModel->getAll();

        $data = array(
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/clients',
            'doctypes' => $doctypes,
            'clients' => $clients
        );
        $this->load->view('admin/master', $data);
    }

    // ADMINISTRACION DE ARTICULOS


    // ADMINISTRACION

    public function users()
    {
        $this->load->model('ClientModel');
        $doctypes = $this->ClientModel->getDocTypes();
        $clients = $this->ClientModel->getAll();

        $data = array(
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/administracion/users',
            'doctypes' => $doctypes,
            'clients' => $clients
        );
        $this->load->view('admin/master', $data);
    }

    public function proveedores()
    {
        $this->load->model('ClientModel');
        $doctypes = $this->ClientModel->getDocTypes();
        $clients = $this->ClientModel->getAll();

        $data = array(
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/administracion/proveedores',
            'doctypes' => $doctypes,
            'clients' => $clients
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
        $this->load->model('ClientModel');
        $doctypes = $this->ClientModel->getDocTypes();
        $clients = $this->ClientModel->getAll();

        $data = array(
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/administracion/cajeros',
            'doctypes' => $doctypes,
            'clients' => $clients
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
        $this->load->model('CategoryModel');
        $categories = $this->CategoryModel->getAll();

        $data = array( 
            'assets_uri' => base_url() . 'assets/admin/', 
            'option' => 'admin/administracion/tipo_pagos',
            'categories' => $categories
        );

        $this->load->view('admin/master', $data);
    }

    // ADMINISTRACION

    public function menus()
    {
        $data = array( 'assets_uri' => base_url() . 'assets/admin/', 'option' => 'admin/menus' );
        $this->load->view('admin/master', $data);
    }

    public function inventory()
    {
        $data = array( 'assets_uri' => base_url() . 'assets/admin/', 'option' => 'admin/inventory' );
        $this->load->view('admin/master', $data);
    }

    public function reports()
    {
        $data = array( 'assets_uri' => base_url() . 'assets/admin/', 'option' => 'admin/reports' );
        $this->load->view('admin/master', $data);
    }

}

/* End of file admin.php */
/* Location: app/controllers/admin.php */