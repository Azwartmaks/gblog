<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller {

	public $loginbool = false;

	public function __construct()
	{
		parent::__construct();
		
		if($this->session->islogin)
		{
			$this->loginbool = true;
		}
	}

	public function index($page=null) 
	{
		$this->load->model('articles_model');
		$total = $this->articles_model->getArticlesNum();

		$config['base_url'] = base_url().'articles/index';
		$config['total_rows'] = $total + 1;
		$config['per_page'] = 50;

		$this->pagination->initialize($config);
		

		$data['partial'] = 'articles_list';
		$data['articles'] = $this->articles_model->getArticles($this->uri->segment(3));
		$data['is_login'] = $this->loginbool;

		$this->load->view('admin_tpl/main', $data);
	}

}