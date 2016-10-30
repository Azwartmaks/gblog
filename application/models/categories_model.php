<?php 

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories_model extends CI_Model 
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	}

	public function getCategoriesNum() 
	{
		$this->db->select('id');
		$query = $this->db->get('gblog_categories');
		return $query->num_rows();
	}

	public function getCategories($start, $per_page=50) 
	{
		$this->db->order_by('id','desc');
		$query = $this->db->get('gblog_categories',$per_page,$start);
		return $query->result_array();
	}

	public function getCategory($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('gblog_categories');
		return $query->result_array();
	}

	public function saveCategory($postData) 
	{
		$contentTrim = trim($postData['content']);
		$insertData = array(
			'meta_title'=>$postData['meta_title'],
			'meta_description'=>$postData['meta_descr'],
			'title'=>$postData['title'],
			'alias'=>$postData['alias'],
			'thumbnail'=>$postData['thumbnail'],
			'content'=>$contentTrim
		);
		$response = $this->db->insert('gblog_categories', $insertData);
		return $response;
	}


	public function updateCategory($postData) 
	{
		$contentTrim = trim($postData['content']);
		$updateData = array(
			'meta_title'=>$postData['meta_title'],
			'meta_description'=>$postData['meta_descr'],
			'title'=>$postData['title'],
			'is_active'=>$postData['is_active'],
			'thumbnail'=>$postData['thumbnail'],
			'content'=>$contentTrim
		);
		$this->db->where('alias', $postData['alias']);
		$response = $this->db->update('gblog_categories', $updateData);
		return $response;
	}

	public function removeCategory($id)
	{
		$relation_remove = $this->db->delete('gblog_relation', array('category_id' => $id));	
		$query = $this->db->delete('gblog_articles', array('id' => $id));
		return $query;
	}

}