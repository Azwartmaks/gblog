<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles_model extends CI_Model 
{

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	}

	public function getArticlesNum() 
	{
		$this->db->select('id');
		$query = $this->db->get('gblog_articles');
		return $query->num_rows();
	}
	public function getArticles($start) 
	{
		$this->db->order_by('id','desc');
		$query = $this->db->get('gblog_articles',50,$start);
		return $query->result_array();
	}
}