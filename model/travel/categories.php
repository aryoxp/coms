<?php

class model_travel_categories extends model {
	
	public function __construct() {
		parent::__construct();	
	}
	
	public function getAllCategories() {
		$sql = "SELECT name, tag, "
				. "(SELECT count(*) FROM posts_categories_travel WHERE category_tag = tag) AS count "
				. "FROM categories_travel ";
		return $this->db->getResults($sql);
	}
	
	public function insert($name) {
		
		$tag = helper::getTag($name);
		
		$data['name'] = trim($name);
		$data['tag'] = $tag;
		
		if($this->db->insert("categories_travel", $data)) {
			$cat->name = $data['name'];
			$cat->tag = $data['tag'];
			return $cat;
		} else return false;
	}
	
}