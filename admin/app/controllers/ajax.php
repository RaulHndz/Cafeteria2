<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

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
		redirect(base_url(), 'refresh');
	}

	public function get_product()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('ProductModel');
        $product = $this->ProductModel->get($codigo);
        if($product)
			echo json_encode($product);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function edit_product()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('ProductModel');
        $product = $this->ProductModel->getEditable($codigo);
        
        if($product)
			echo json_encode($product);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function get_category()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('CategoryModel');
        $category = $this->CategoryModel->get($codigo);
        if($category)
			echo json_encode($category);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function edit_category()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('CategoryModel');
        $category = $this->CategoryModel->getEditable($codigo);
        
        if($category)
			echo json_encode($category);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function get_cellar()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('CellarModel');
        $cellar = $this->CellarModel->get($codigo);
        if($cellar)
			echo json_encode($cellar);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function edit_cellar()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('CellarModel');
        $cellar = $this->CellarModel->getEditable($codigo);
        
        if($cellar)
			echo json_encode($cellar);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function get_client()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('ClientModel');
        $client = $this->ClientModel->get($codigo);
        if($client)
			echo json_encode($client);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function edit_client()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('ClientModel');
        $client = $this->ClientModel->getEditable($codigo);
        
        if($client)
			echo json_encode($client);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function get_caja()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('CajaModel');
        $caja = $this->CajaModel->get($codigo);
        if($caja)
			echo json_encode($caja);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function edit_caja()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('CajaModel');
        $caja = $this->CajaModel->getEditable($codigo);
        
        if($caja)
			echo json_encode($caja);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function get_tienda()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('TiendaModel');
        $tienda = $this->TiendaModel->get($codigo);
        if($tienda)
			echo json_encode($tienda);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function edit_tienda()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('TiendaModel');
        $tienda = $this->TiendaModel->getEditable($codigo);
        
        if($tienda)
			echo json_encode($tienda);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function get_tipopago()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('TipoPagoModel');
        $tipopago = $this->TipoPagoModel->get($codigo);
        if($tipopago)
			echo json_encode($tipopago);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function edit_tipopago()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('TipoPagoModel');
        $tipopago = $this->TipoPagoModel->getEditable($codigo);
        
        if($tipopago)
			echo json_encode($tipopago);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function get_proveedor()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('ProveedorModel');
        $proveedor = $this->ProveedorModel->get($codigo);
        if($proveedor)
			echo json_encode($proveedor);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function edit_proveedor()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('ProveedorModel');
        $proveedor = $this->ProveedorModel->getEditable($codigo);
        
        if($proveedor)
			echo json_encode($proveedor);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function get_usuario()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('UserModel');
        $user = $this->UserModel->get($codigo);
        if($user)
			echo json_encode($user);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function edit_usuario()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('UserModel');
        $user = $this->UserModel->getEditable($codigo);
        
        if($user)
			echo json_encode($user);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function get_cajero()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('CajeroModel');
        $cajero = $this->CajeroModel->get($codigo);
        if($cajero)
			echo json_encode($cajero);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function edit_cajero()
	{
		$codigo = $this->input->post('codigo');

		$this->load->model('CajeroModel');
        $cajero = $this->CajeroModel->getEditable($codigo);
        
        if($cajero)
			echo json_encode($cajero);
		else
			echo json_encode(array('status' => 'error'));
	}

	public function buy_get_products()
	{
		$q = $this->input->post('q');
		if($q)
		{
			$this->load->model('BuyModel');
	        $products = $this->BuyModel->getProducts($q);
	        if($products)
				echo json_encode($products);
			else
				echo json_encode(array('status' => 'error'));
		}
	}

	public function buy_save_data()
	{
		$compra = $this->input->post('buy');
		$provider = $this->input->post('provider');
		$desc = $this->input->post('descpt');
		if($compra && $provider && $desc)
		{
			$this->load->model('BuyModel');
	        return $this->BuyModel->saveBuy($compra, $provider, $desc);
		}
	}

	public function buy_save_product()
	{
		$compra = $this->input->post('buy');
		$producto = $this->input->post('product');
		$cantidad = $this->input->post('quantity');
		if($compra && $producto && $cantidad)
		{
			$this->load->model('BuyModel');
	        $products = $this->BuyModel->saveProduct($compra, $producto, $cantidad);

	        if($products)
				echo json_encode($products);
		}
	}

	public function buy_delete_product()
	{
		$compra = $this->input->post('buy');
		$producto = $this->input->post('product');
		if($compra && $producto)
		{
			$this->load->model('BuyModel');
	        $products = $this->BuyModel->deleteProduct($producto, $compra);
	        
	        if($products)
				echo json_encode($products);
		}
	}

}

/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */