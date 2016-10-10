<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	}

	public function validate($postData)
	{
		$query = $this->db->get_where('gblog_users', array('login' => $postData['login'],'password' => $postData['password']));
		return $query->result_array();
	}

	public function getArticlesCount() 
	{
		$this->db->select('id');
		$query = $this->db->get('gblog_articles');
		return $query->num_rows();
	}

	/*
	* $type = articles or categories
	*/
	public function getAliasById($id,$type)
	{
		$this->db->select('alias');
		if ($type === 'articles')
		{
			$query = $this->db->get_where('gblog_articles',array('id'=>$id));
		}
		elseif($type === 'categories')
		{
			$query = $this->db->get_where('gblog_categories',array('id'=>$id));
		}
		return $query->result_array();
	}

	public function getCategoryCount() {
		$this->db->select('id');
		$query = $this->db->get('gblog_categories');
		return $query->num_rows();
	}

	public function getAllArticles()
	{
		$query = $this->db->get('gblog_articles');
		return $query->result_array();
	}

	public function getAllCategories()
	{
		$query = $this->db->get('gblog_categories');
		return $query->result_array();
	}

	public function getCategories()
	{
		$query = $this->db->get_where('gblog_categories', array('is_active'=>1));
		return $query->result_array();
	}

	public function getArticle($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('gblog_articles');
		return $query->result_array();
	}

	public function getRelation($articleAlias) {
		$this->db->select('category_id');
		$this->db->where('article_alias', $articleAlias);
		$query = $this->db->get('gblog_relation');
		$result = $query->result_array();

		$responseData = array();
		foreach ($result as $item) 
		{
			$responseData[] = $item['category_id'];
		}

		return $responseData;
	}

	public function saveArticle($postData) 
	{

		$checkQuery = true;

		foreach ($postData['genre'] as $genre) {
			$relationData = array(
				'category_id' => $genre,
				'article_alias' => $postData['alias']
			);
			$insert = $this->db->insert('gblog_relation', $relationData);
			if(!$insert) {
				$checkQuery = false;
				break;
			}
		}

		if($checkQuery) 
		{
			$contentTrim = trim($postData['content']);
			$insertData = array(
				'meta_title'=>$postData['meta_title'],
				'meta_description'=>$postData['meta_descr'],
				'title'=>$postData['title'],
				'alias'=>$postData['alias'],
				'thumbnail'=>$postData['thumbnail'],
				'text'=>$contentTrim
			);
			$response = $this->db->insert('gblog_articles', $insertData);
			return $response;
		} 
		else 
		{
			return false;
		}
	}


	public function updateArticle($postData) 
	{

		$checkQuery = true;
		$this->db->delete('gblog_relation', array('article_alias' => $postData['alias']));

		foreach ($postData['genre'] as $genre) {
			$relationData = array(
				'category_id' => $genre,
				'article_alias' => $postData['alias']
			);
			$insert = $this->db->insert('gblog_relation', $relationData);
			if(!$insert) {
				$checkQuery = false;
				break;
			}
		}

		if($checkQuery) 
		{
			$contentTrim = trim($postData['content']);
			$updateData = array(
				'meta_title'=>$postData['meta_title'],
				'meta_description'=>$postData['meta_descr'],
				'title'=>$postData['title'],
				'is_active'=>$postData['is_active'],
				'thumbnail'=>$postData['thumbnail'],
				'text'=>$contentTrim
			);
			$this->db->where('alias', $postData['alias']);
			$response = $this->db->update('gblog_articles', $updateData);
			return $response;
		} 
		else 
		{
			return false;
		}
	}

	public function removeArticle($id)
	{
		$alias = $this->getAliasById($id,'articles');
		$alias = $alias[0]['alias'];
		$relation_remove = $this->db->delete('gblog_relation', array('article_alias' => $alias));	
		$query = $this->db->delete('gblog_articles', array('id' => $id));
		return $query;
	}
}