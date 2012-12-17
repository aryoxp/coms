<?php

class model_posts_categories extends model {
	
	public function __construct() {
		parent::__construct();	
	}
	
	public function getAllCategories() {
		$sql = "SELECT name, tag, "
				. "(SELECT count(*) FROM posts_categories WHERE category_tag = tag) AS count "
				. "FROM categories ";
		return $this->db->getResults($sql);
	}
	
	public function insert($name) {
		
		$tag = helper::getTag($name);
		
		$data['name'] = trim($name);
		$data['tag'] = $tag;
		
		if($this->db->insert("categories", $data)) {
			$cat->name = $data['name'];
			$cat->tag = $data['tag'];
			return $cat;
		} else return false;
	}
	
	public function getCategoriesStat() {
		$sql = "SELECT category_tag, c.name AS name, COUNT(category_tag) AS category_count FROM posts_categories pc "
		 		. "LEFT JOIN categories c ON pc.category_tag = c.tag GROUP BY category_tag ";
		return $this->db->getResults($sql);
	}
	
	public function delete($catname) {
		
		$columns['tag']	= $this->db->escape($catname);
		
		$affected_rows = $this->db->delete('categories', $columns);
		$this->error = $this->db->getLastError();
		
		return $affected_rows;
		
	}	
	
}