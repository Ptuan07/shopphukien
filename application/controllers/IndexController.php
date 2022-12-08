<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexController extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		
		$this->load->model('IndexModel');
		$this->load->library('cart');
		$this->data['category']= $this->IndexModel->getCategoryHome();
		$this->data['brand']= $this->IndexModel->getBrandHome();
       
    }

	public function index()
	{
		$this->data['allproduct']= $this->IndexModel->getAllProduct();
	
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/template/slider');
		$this->load->view('pages/home1', $this->data);
		$this->load->view('pages/template/footer');
	}

	public function category($id)
	{
		$this->data['category_product']= $this->IndexModel->getCategoryProduct($id);
		$this->data['title']= $this->IndexModel->getCategoryTitle($id);
	
		$this->load->view('pages/template/header' , $this->data);
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/category', $this->data);
		$this->load->view('pages/template/footer');
		
	}

	public function brand($id) 
	{
		$this->data['brand_product']= $this->IndexModel->getBrandProduct($id);
		$this->data['title']= $this->IndexModel->getBrandTitle($id);
	
		$this->load->view('pages/template/header', $this->data);
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/brand', $this->data);
		$this->load->view('pages/template/footer');
	}

	public function cart()
	{
	
		$this->load->view('pages/template/header',$this->data);
		$this->load->view('pages/template/slider');
		$this->load->view('pages/cart',$this->data);
		$this->load->view('pages/template/footer');
	} 

	public function checkout(){ 
		//nếu tồn tại nội dung sản phẩm
		if($this->session->userdata('LoggedInCustomer')&& $this->cart->contents()){
		$this->load->view('pages/template/header',$this->data);
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/checkout');
		$this->load->view('pages/template/footer');
		}else{
			redirect(base_url().'gio-hang');
		}
	}

	public function add_to_cart(){
		$this->load->view('pages/product_details');
		$this->load->view('pages/brand');
		 $product_id = $this->input->post('product_id');
		 $quantity = $this->input->post('quantity'); 
		$this->data['product_details']= $this->IndexModel->getProductDetails($product_id);
		//Dat Hang
		foreach($this->data['product_details'] as $key => $pro){
		$cart = array(
			'id'      => $pro->id,
			'qty'     => $quantity,
			'price'   => $pro->price,
			'name'    => $pro->title,
			'options' => array('image' => $pro->image)
	);  
		}
		$this->cart->insert($cart);
		redirect(base_url().'gio-hang','refresh');
	}

	public function delete_all_cart()
	{
		$this->cart->destroy();
		redirect(base_url().'gio-hang','refresh');
	}

	public function delete_item($rowid)
	{
		$this->cart->remove($rowid);
		redirect(base_url().'gio-hang','refresh');
	}

	public function update_cart_item()
	{
		$rowid=$this->input->post('rowid');
		$quantity = $this->input->post('quantity');
		foreach ($this->cart->contents() as $items){
			if($rowid == $items['rowid']){
				$cart = array(
					'rowid'  => $rowid,
					'qty'     => $quantity
			);  
			}
	  	}
		$this->cart->update($cart);
	//	redirect(base_url().'gio-hang','refresh');
		redirect($_SERVER['HTTP_REFERER']);
    	}

	public function login()
	{
	
		$this->load->view('pages/template/header');
	//	$this->load->view('pages/template/slider');
		$this->load->view('pages/login');
		$this->load->view('pages/template/footer');
	}

	public function product($id)
	{
	
		$this->data['product_details']= $this->IndexModel->getProductDetails($id);

		$this->load->view('pages/template/header' , $this->data);
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/product_details', $this->data);
		$this->load->view('pages/template/footer');
	}

	public function thanks()
	{
	
		$this->load->view('pages/template/header' , $this->data);
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/thanks');
		$this->load->view('pages/template/footer');
	}

	public function login_customer()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required',['required'=>'Bạn chưa nhập %s']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required',['required'=>'Bạn chưa nhập %s']);
		if ($this->form_validation->run() == TRUE)
		{
				$email = $this->input->post('email');
				$password = md5($this->input->post('password'));
				$this->load->model('LoginModel');
				$result = $this->LoginModel->checkLoginCustomer($email,$password);
				// print_r("<pre>");
				// print_r($result);
				// die();
				if(count($result)>0)
				{
					$session_array =array(
						'id' => $result[0]->id,
						'username' => $result[0]->name,
						'email' => $result[0]->email,
					);
					$this->session->set_userdata('LoggedInCustomer',$session_array);
					$this->session->set_flashdata('success','Đăng Nhập thành công');
					redirect(base_url('/checkout'));
				}
				else
				{
					$this->session->set_flashdata('error','Sai tài khoản hoặc mật khẩu, Vui lòng nhập lại!');
					redirect(base_url('/dang-nhap'));
				}
		}
		else
		{
			$this->login();
		}
	}

	public function dang_ky()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required',['required'=>'Bạn chưa nhập %s']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required',['required'=>'Bạn chưa nhập %s']);
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required',['required'=>'Bạn chưa nhập %s']);
		$this->form_validation->set_rules('name', 'Name', 'trim|required',['required'=>'Bạn chưa nhập %s']);
		$this->form_validation->set_rules('address', 'Address', 'trim|required',['required'=>'Bạn chưa nhập %s']);
		if ($this->form_validation->run() == TRUE)
		{
				$email = $this->input->post('email');
				$password = md5($this->input->post('password'));
				$phone = $this->input->post('phone');
				$address = $this->input->post('address');
				$name = $this->input->post('name');
				// vd 26/9:22
				$data = array(
					'name' => $name,
					'email' => $email,
					'password' => $password,
					'address' => $address,
					'phone' => $phone,

				);
				$this->load->model('LoginModel');
				
				$result = $this->LoginModel->NewCustomer($data);
				// print_r("<pre>");
				// print_r($result);
				// die();
				if($result)
				{
					$session_array =array(
						'username' => $name,
						'email' => $email,
					);
					$this->session->set_userdata('LoggedInCustomer',$session_array);
					$this->session->set_flashdata('success','Đăng Nhập thành công');
					redirect(base_url('/checkout'));
				}
				else
				{
					$this->session->set_flashdata('error','Sai tài khoản hoặc mật khẩu, Vui lòng nhập lại!');
					redirect(base_url('/dang-nhap'));
				}
		}
		else
		{
			$this->login();
		}
	}

	public function confirm_checkout()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required',['required'=>'Bạn chưa nhập %s']);
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required',['required'=>'Bạn chưa nhập %s']);
		$this->form_validation->set_rules('name', 'Name', 'trim|required',['required'=>'Bạn chưa nhập %s']);
		$this->form_validation->set_rules('address', 'Address', 'trim|required',['required'=>'Bạn chưa nhập %s']);
		if ($this->form_validation->run() == TRUE)
		{
			
			$email = $this->input->post('email');
			$shipping_method = $this->input->post('shipping_method');
			$phone = $this->input->post('phone');
			$address = $this->input->post('address');
			$name = $this->input->post('name');
			$data = array(
				'name' => $name,
				'email' => $email,
				'method' => $shipping_method,
				'address' => $address,
				'phone' => $phone,

			);
			$this->load->model('LoginModel');
				$result = $this->LoginModel->NewShipping($data);
				if($result)
				{
					// order
					$order_code=rand(00,9999);
					$data_order = array(
						'order_code' => $order_code,
						'ship_id' =>$result,
						'status' => 1,
					);
				$insert_order = $this->LoginModel->insert_order($data_order);
				//order details
				foreach ($this->cart->contents() as $items){
					$data_order_details = array(
						'order_code' => $order_code,
						'product_id' =>$items['id'],
						'quantity' => $items['qty'],
					);
				$insert_order_details = $this->LoginModel->insert_order_details($data_order_details);
				}
					$this->session->set_flashdata('success','Đặt hàng thành công!');
					$this->cart->destroy();
					redirect(base_url('/thanks'));
				}
				else
				{
					$this->session->set_flashdata('error','Thanh toán đơn hàng thất bại!');
					redirect(base_url('/checkout'));
				}
		}
		else{
			$this->checkout();
		}
	}
	
	public function dang_xuat()
	{//vd 25/13:23
		$this->session->unset_userdata('LoggedInCustomer');
		$this->session->set_flashdata('success','Đăng xuất thành công');

		redirect(base_url('/dang-nhap'));
	}
	
	public function tim_kiem()
	{
		if(isset($_GET['keyword'])&& $_GET['keyword']!=''){
			$keyword=$_GET['keyword'];
		}
		$this->load->view('pages/template/header' , $this->data);
		$this->data['product']= $this->IndexModel->getProductByKeyword($keyword);
		$this->data['title']= $keyword;
		$this->config->config["pageTitle"]='Tìm kiếm từ khóa: '.$keyword;
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/timkiem', $this->data);
		$this->load->view('pages/template/footer');
	}
}