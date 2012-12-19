<?php
class model_content extends model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public $error;
	public $id;
	public $modified;
	
	public function save($content_page, $content_title, $content_date, 
							$content_content, $content_status,
							$content_author_id, $id) {
		
		$this->error = NULL;
		
		$data['content_page']		= $content_page;
		$data['content_modified'] 	= date('Y-m-d H:i:s'); //$content_date;
		$data['content_title'] 		= $content_title;
		$data['content_content'] 	= $content_content;
		$data['content_status']		= $content_status;
			
		//$cats['content_categories'] = $content_categories;
		//$tags['content_tags'] = $content_tags;

		if($id == NULL) { // saving
		
			$data['content_author_id']	= $content_author_id;
			$data['content_page'] 		= $content_page;
		
			if( $affectedRows = $this->db->insert('contents', $data) ) {
				$this->id = $this->db->getLastInsertId();
				//$this->saveCategories($this->id, $content_categories);
				//$this->saveTags($this->id, $content_tags);
				$this->modified = $data['content_modified'];
				return true;
			} else $this->error = $this->db->getLastError();
			return false;
		} else { // updating
		
			$where['id'] = $id;
			$this->id = $id;
			$this->modified = $data['content_modified'];			
						
			if( $affected_rows = $this->db->update('contents', $data, $where) ) {
				return true;
			} else if( $this->error = $this->db->getLastError() ) {
				return false;
			}
			return true;
		}

	}
	
	private function saveCategories($content_id, $content_cats) {
		if(is_array($content_cats)) {
			$pc = array();
			foreach($content_cats as $c)
				array_push($pc, "('".$content_id."','".$c."')");
			
			$sql = "INSERT IGNORE INTO contents_categories VALUES ".implode(", ", $pc) ;			
			return $this->db->query( $sql );
		} else return 0;
	}
	
	private function saveTags($content_id, $content_tags) {
		
		$this->db->query("DELETE FROM contents_tags WHERE content_id = '".$content_id."'");
		if(is_array($content_tags)) {
			$tag_tag = array();
			foreach($content_tags as $name) {
				$tag = helper::getTag($name);
				array_push($tag_tag, $tag);
				$this->db->query("INSERT IGNORE INTO tags VALUES ('".$name."','".$tag."')");
			}
	
			$pt = array();
			foreach($tag_tag as $tag)
				array_push($pt, "('".$content_id."','".$tag."')");
			
			$sql = "INSERT IGNORE INTO contents_tags VALUES ".implode(", ", $pt);
			
			return $this->db->query( $sql );
		} else return 0;
	}
	
	public function getList($page = 1, $perpage = 10){
		$offset = ($page-1)*$perpage;
		
		$sql = "SELECT id, content_page, content_title,
				DATE_FORMAT(content_modified, '%d/%m/%Y %H:%i') AS content_modified, 
				SUBSTRING(content_content, 1,100) AS content_content, 
				content_status, content_author_id
				FROM contents c
				ORDER BY id DESC
				LIMIT $offset, $perpage ";
				
		$result = $this->db->getResults( $sql ); //var_dump($this->db);
		return $result;
	}
	
	public function getListByCat($category, $page = 1, $perpage = 10){
		
		$category = $this->db->escape($category);
		$offset = ($page-1)*$perpage;
		
		$sql = "SELECT id, content_page, content_title, content_subtitle, DATE_FORMAT(content_date, '%d/%m/%Y %H:%i') AS content_date, 
				DATE_FORMAT(content_modified, '%d/%m/%Y %H:%i') AS content_modified, 
				SUBSTRING(content_content, 1,100) AS content_content, 
				content_status, content_excerpt, content_author_id, content_password, 
				comment_status,
				(SELECT COUNT(*) FROM contents_comments c WHERE c.content_id = p.id) as comment_count,
				hits
				FROM contents p LEFT JOIN contents_categories pc ON p.id = pc.content_id
				WHERE pc.category_tag = '$category'
				ORDER BY id DESC 
				LIMIT $offset, $perpage ";
				
		$result = $this->db->getResults( $sql ); //var_dump($this->db);
		return $result;
	}
	
	public function getListByTag($tag, $page = 1, $perpage = 10){
		
		$category = $this->db->escape($tag);
		$offset = ($page-1)*$perpage;
		
		$sql = "SELECT id, content_page, content_title, content_subtitle, DATE_FORMAT(content_date, '%d/%m/%Y %H:%i') AS content_date, 
				DATE_FORMAT(content_modified, '%d/%m/%Y %H:%i') AS content_modified, 
				SUBSTRING(content_content, 1,100) AS content_content, 
				content_status, content_excerpt, content_author_id, content_password, 
				comment_status,
				(SELECT COUNT(*) FROM contents_comments c WHERE c.content_id = p.id) as comment_count,
				hits
				FROM contents p LEFT JOIN contents_tags pt ON p.id = pt.content_id
				WHERE pt.tag_tag = '$tag'
				ORDER BY id DESC 
				LIMIT $offset, $perpage ";
				
		$result = $this->db->getResults( $sql ); //var_dump($this->db);
		return $result;
	}
	
	public function delete($id) {
		if($this->db->delete('contents', array('id'=>$id)))
			return true;
		else $this->error = $this->db->getLastError();
		return false;
	}
	
	// get a single post by a post id
	public function getContent($postid) {
		
		$columns = array("id", "content_page", "content_title",
				"DATE_FORMAT(content_modified, '%d/%m/%Y') AS content_date",
				"DATE_FORMAT(content_modified, '%H:%i:%s') AS content_time",
				"DATE_FORMAT(content_modified, '%d/%m/%Y %H:%i:%s') AS content_modified",
				
				"content_content", 
				"content_status", "content_author_id");
		
		$result = $this->db->select("contents", $columns, array("id"=>$postid));
		if($result)
			return $result[0];
	}	
	
	public function getCategories($postid) {
		$sql = "SELECT ct.name AS name, ct.tag AS tag " .
				"FROM contents_categories pct LEFT JOIN categories ct ON pct.category_tag = ct.tag " .
				"WHERE pct.content_id = '".$postid."'";
		return $this->db->query( $sql );
	}
	
	public function getTags($postid) {
		$sql = "SELECT tt.name AS name, tt.tag AS tag " .
				"FROM contents_tags ptt LEFT JOIN tags tt ON ptt.tag_tag = tt.tag " .
				"WHERE ptt.content_id = '".$postid."'";
		return $this->db->query( $sql );
	}
	
	public function getPostCount() {
		$sql = "SELECT count(*) FROM contents";
		return $this->db->getVar( $sql );
	}
}