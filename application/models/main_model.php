<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model 
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	}

	public function index()
	{
		$response = $this->db->get('gblog_homepage')->result_array();
		return $response;
	}
}