<?php

class model_posts_tags extends model {
	
	public $error = NULL;
	
	public function __construct() {
		parent::__construct();	
	}
	
	public function getAllTags() {
		$sql = "SELECT name, tag, "
				. "(SELECT count(*) FROM posts_tags WHERE tag_tag = tag) AS count "
				. "FROM tags ";
		$res = $this->db->getResults($sql); //var_dump($res);
		return $res;
	}
	
	public function insert($name) {
		
		$tag = helper::getTag($name);
		
		$data['name'] = trim($name);
		$data['tag'] = $tag;
		
		if($this->db->insert("tags", $data))
			return true;
		else return false;
	}
	
	public function delete($tagname) {
		
		$columns['tag']	= $this->db->escape($tagname);
		
		$affected_rows = $this->db->delete('tags', $columns);
		$this->error = $this->db;
		
		return $affected_rows;
		
	}
	
}