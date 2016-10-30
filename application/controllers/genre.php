<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Genre  extends CI_Controller 
{
	function index ()
	{
		$this->load->model('articles_model');
		$total = $this->articles_model->getArticlesNum();

		$config['base_url'] = base_url().'genre/index';
		$config['total_rows'] = $total + 1;
		$config['per_page'] = 10;

		$this->pagination->initialize($config);
		
		$data['genres'] = $this->articles_model->getArticles($this->uri->segment(3));
		$this->load->view('genre', $data);
	}
}