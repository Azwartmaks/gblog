<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller 
{

	public $loginbool = false;

	public function __construct()
	{
		parent::__construct();
		
		if($this->session->islogin)
		{
			$this->loginbool = true;
		}
	}

	/*Common functions**/
	private function islogin() 
	{
		if(!$this->session->islogin) 
		{
			redirect(base_url() . 'admin');
		}
	}

	private function redirectAfterActionDone($action) 
	{
		if($action)
		{
			redirect(base_url() . 'admin');
		} 
		else 
		{
			echo 'Not saved, check fileds in queries, or alias not unique';
		}
	}

	public function index($page=null) 
	{
		$this->load->model('categories_model');
		$total = $this->categories_model->getCategoriesNum();

		$config['base_url'] = base_url().'articles/index';
		$config['total_rows'] = $total + 1;
		$config['per_page'] = 50;

		$this->pagination->initialize($config);
		

		$data['partial'] = 'categories_list';
		$data['categories'] = $this->categories_model->getCategories($this->uri->segment(3));
		$data['is_login'] = $this->loginbool;

		$this->load->view('admin_tpl/main', $data);
	}

	public function newCategory()
	{	
		$this->islogin();
		$this->load->model('categories_model');

		$data['partial']='add_category';
		$data['is_login'] = $this->loginbool;
		$this->load->view('admin_tpl/main', $data);
	}

	public function editCategory($id) 
	{
		$this->islogin();
		$this->load->model('categories_model');
		$data['category_data'] = $this->categories_model->getCategory($id);

		$data['mode'] = 'edit';
		$data['partial']='add_category';
		$data['is_login'] = $this->loginbool;
		$this->load->view('admin_tpl/main', $data);
	}
	public function saveCategory()
	{
		$this->islogin();
		$this->load->model('categories_model');

		if($this->input->post('is_active'))
		{
			$update = $this->categories_model->updateCategory($this->input->post(null, true));

			$this->redirectAfterActionDone($update);
		}
		else
		{
			$save = $this->categories_model->saveCategory($this->input->post(null, true));

			$this->redirectAfterActionDone($save);
		}	
	}
	public function removeArticle($id) 
	{
		$this->islogin();
		$this->load->model('admin_model');
		$action = $this->admin_model->removeArticle($id);
		redirectAfterActionDone($action);
	}

}