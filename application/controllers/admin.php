<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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

	/*Action functions*/
	public function index()
	{
		$data['is_login'] = $this->loginbool;
		if($this->loginbool) {
			$this->load->model('admin_model');
			$data['articles_count'] = $this->admin_model->getArticlesCount();
			$data['cat_count'] = $this->admin_model->getCategoryCount();
		}
		$this->load->view('admin_tpl/main', $data);
	}

	public function validate()
	{
		$postData = null;
		$this->load->model('admin_model');

		if($this->input->post('login')) 
		{
			$postData = array(
					'login' => $this->input->post('login'),
					'password' => $this->input->post('password')
				);
		}
		$validate_result = $this->admin_model->validate($postData);

		if(!empty($validate_result))
		{
			$this->session->set_userdata('islogin','true');
		}
		redirect(base_url() . 'admin');
	}

	public function logOut()
	{
		$this->session->unset_userdata('islogin');
		redirect(base_url() . 'admin');
	}

	public function newArticle()
	{	
		$this->islogin();
		$this->load->model('admin_model');
		$data['categories'] = $this->admin_model->getCategories();

		$data['partial']='add_article';
		$data['is_login'] = $this->loginbool;
		$this->load->view('admin_tpl/main', $data);
	}

	public function editArticle($id) 
	{
		$this->islogin();
		$this->load->model('admin_model');
		$data['article_data'] = $this->admin_model->getArticle($id);

		$articleAlias = $data['article_data'][0]['alias'];
		$data['relations'] = $this->admin_model->getRelation($articleAlias);
		$data['categories'] = $this->admin_model->getCategories();

		$data['mode'] = 'edit';
		$data['partial']='add_article';
		$data['is_login'] = $this->loginbool;
		$this->load->view('admin_tpl/main', $data);
	}
	public function saveArticle()
	{
		$this->islogin();
		$this->load->model('admin_model');

		if($this->input->post('is_active'))
		{
			$update = $this->admin_model->updateArticle($this->input->post(null, true));

			$this->redirectAfterActionDone($update);
		}
		else
		{
			$save = $this->admin_model->saveArticle($this->input->post(null, true));

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