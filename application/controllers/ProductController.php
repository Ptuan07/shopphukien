<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

   

    public function checkLogin()
    {
        if(!$this->session->userdata('LoggedIn'))
        {
            redirect(base_url('/login'));
        }
      
    }
	
	public function index()
	{
            $this->checkLogin();
            $this->load->view('admin_template/header');
            $this->load->view('admin_template/navbar'); 
            
            $this->load->model('ProductModel');
            $data['product'] = $this->ProductModel->selectAllProduct();

            $this->load->view('product/list',$data);
            $this->load->view('admin_template/footer');
       
	}

    public function create()
	{
            $this->checkLogin();
            $this->load->view('admin_template/header');
            $this->load->view('admin_template/navbar');
            //gọi category
            $this->load->model('CategoryModel');
            $data['category'] = $this->CategoryModel->selectCategory();
            //gọi brand
            $this->load->model('BrandModel');
            $data['brand'] = $this->BrandModel->selectBrand();

            $this->load->view('product/create',$data);
            $this->load->view('admin_template/footer');
       
	}

    public function store()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required',['required'=>'Bạn chưa nhập %s']);
        $this->form_validation->set_rules('price', 'Price', 'trim|required',['required'=>'Bạn chưa nhập %s']);
        $this->form_validation->set_rules('description', 'Description', 'trim|required',['required'=>'Bạn chưa nhập %s']);
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required',['required'=>'Bạn chưa nhập %s']);
       // $this->form_validation->set_rules('status', 'Status', 'required');
		if ($this->form_validation->run())
		{
            //upload ảnh
            $ori_filename = $_FILES['image']['name']; // lấy ảnh
            $new_name = time()."".str_replace(' ','-',$ori_filename);// chỉnh tên ảnh
            $config = [
                'upload_path' => './uploads/product',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'file_name' => $new_name,
            ];
            //move_uploaded_file(path,$new_name)
            $this->load->library('upload',$config);
            if( ! $this->upload->do_upload('image'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin_template/header');
                $this->load->view('admin_template/navbar');
                $this->load->view('product/create',$error);
                $this->load->view('admin_template/footer');
              //  $this->load->view('upload_form',$error);
            }
            else
            {
                $product_filename = $this->upload->data('file_name');
                $data = [
                    'title' => $this->input->post('title'),
                    'price' => $this->input->post('price'),
                    'description' => $this->input->post('description'),
               //     'slug' => $this->input->post('slug'),
                    'status' => $this->input->post('status'),
                    'category_id' => $this->input->post('category_id'),
                    'brand_id' => $this->input->post('brand_id'),
                    'quantity' => $this->input->post('quantity'),
                    'image' => $product_filename
                ];
                
                $this->load->model('ProductModel');
                $this->ProductModel->insertProduct($data);
                $this->session->set_flashdata('success','Thêm Thành công');
                redirect(base_url('product/list'));
            }
        }
        else
        {
            $this->create();
        }
    }
    
    public function edit($id)
    {
        $this->checkLogin();
        $this->load->view('admin_template/header');
        $this->load->view('admin_template/navbar');

        //gọi category
        $this->load->model('CategoryModel');
        $data['category'] = $this->CategoryModel->selectCategory();
        //gọi brand
        $this->load->model('BrandModel');
        $data['brand'] = $this->BrandModel->selectBrand();
        //gọi theo id
        $this->load->model('ProductModel');
        $data['product'] = $this->ProductModel->selectProductByID($id);

        $this->load->view('product/edit',$data);
        $this->load->view('admin_template/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required',['required'=>'Bạn chưa nhập %s']);
        $this->form_validation->set_rules('price', 'Price', 'trim|required',['required'=>'Bạn chưa nhập %s']);
        $this->form_validation->set_rules('description', 'Description', 'trim|required',['required'=>'Bạn chưa nhập %s']);
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required',['required'=>'Bạn chưa nhập %s']);
       // $this->form_validation->set_rules('status', 'Status', 'required');
		if ($this->form_validation->run() == TRUE)
		{
            if(!empty($_FILES['image']['name'])){
            //upload ảnh
            $ori_filename = $_FILES['image']['name']; // lấy ảnh
            $new_name = time()."".str_replace(' ','-',$ori_filename);// chỉnh tên ảnh
            $config = [
                'upload_path' => './uploads/product',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'file_name' => $new_name,
            ];
            //move_uploaded_file(path,$new_name)
            $this->load->library('upload',$config);
            if( ! $this->upload->do_upload('image'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin_template/header');
                $this->load->view('admin_template/navbar');
                $this->load->view('product/create',$error);
                $this->load->view('admin_template/footer');
              //  $this->load->view('upload_form',$error);
            }
            else
            {
                $product_filename = $this->upload->data('file_name');
                $data = [
                    'title' => $this->input->post('title'), 
                    'description' => $this->input->post('description'),
                   // 'slug' => $this->input->post('slug'),
                    'quantity' => $this->input->post('quantity'),
                    'price' => $this->input->post('price'),
                    'category_id' => $this->input->post('category_id'),
                    'brand_id' => $this->input->post('brand_id'),
                    'status' => $this->input->post('status'),
                    'image' => $product_filename
                ];
                
               
            }
        }else{
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'price' => $this->input->post('price'),
             //   'slug' => $this->input->post('slug'),
                'quantity' => $this->input->post('quantity'),
                'category_id' => $this->input->post('category_id'),
                'brand_id' => $this->input->post('brand_id'),
                'status' => $this->input->post('status'),

                //'image' => $brand_filename
            ];
            
        }
        $this->load->model('ProductModel');
        $this->ProductModel->updateProduct($id,$data);
        $this->session->set_flashdata('success','Sửa Thành công');
        redirect(base_url('product/list'));
        
    }
    else
        {
            $this->edit($id);
        }
}
    public function delete($id){
        $this->load->model('ProductModel');
        $this->ProductModel->deleteProduct($id);
        $this->session->set_flashdata('success','Xóa Thành công');
        redirect(base_url('product/list'));
    }
}