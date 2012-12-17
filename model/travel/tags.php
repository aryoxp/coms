<?php

class model_travel_tags extends model {
	
	public function __construct() {
		parent::__construct();	
	}
	
	public function getAllTags() {
		$sql = "SELECT name, tag, "
				. "(SELECT count(*) FROM posts_tags_travel WHERE tag_tag = tag) AS count "
				. "FROM tags_travel ";
		return $this->db->getResults($sql);
	}
	
	public function insert($name) {
		
		$tag = helper::getTag($name);
		
		$data['name'] = trim($name);
		$data['tag'] = $tag;
		
		if($this->db->insert("tags_travel", $data))
			return true;
		else return false;
	}
	
}