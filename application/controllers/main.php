<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index($type=null)
	{
		if(!$type) 
		{
			$this->load->model('main_model');
			$data = $this->main_model->index();
			$this->load->view('main',$data[0]);
		}
		elseif($type != null)
		{
			// var_dump($type);
		}
	}
}
