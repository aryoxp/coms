<?php
class model_posts_post extends model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public $error;
	public $id;
	public $modified;
	
	public function save($post_page, $post_title, $post_subtitle, $post_date, 
							$post_content, $post_status, $post_excerpt, 
							$post_author_id, $post_password, $comment_status, 
							$post_categories, $post_tags, $id) {
		
		$this->error = NULL;
		
		$data['post_page']		= $post_page;
		$data['post_date'] 		= $post_date;
		$data['post_modified'] 	= date('Y-m-d H:i:s');
		$data['post_title'] 	= $post_title;
		$data['post_subtitle'] 	= $post_subtitle;
		$data['post_content'] 	= $post_content;
		$data['post_status']	= $post_status;
		$data['post_excerpt']	= $post_excerpt;
		$data['post_password']	= $post_password;
		$data['comment_status']	= $comment_status;
			
		//$cats['post_categories'] = $post_categories;
		//$tags['post_tags'] = $post_tags;

		if($id == NULL) { // saving
		
			$data['post_author_id']	= $post_author_id;
			$data['post_page'] 	= helper::getTag($post_title);
		
			if( $affectedRows = $this->db->insert('posts', $data) ) {
				$this->id = $this->db->getLastInsertId();
				$this->saveCategories($this->id, $post_categories);
				$this->saveTags($this->id, $post_tags);
				
				$this->modified = $data['post_modified'];
				return true;
			} else $this->error = $this->db->getLastError();
			return false;
		} else { // updating
		
			$where['id'] = $id;
			$this->id = $id;
			$this->modified = $data['post_modified'];			
						
			if( $affected_rows = $this->db->update('posts', $data, $where) ) {
				$this->saveCategories($this->id, $post_categories);
				$this->saveTags($this->id, $post_tags);
				return true;
			} else if( $this->error = $this->db->getLastError() ) {
				return false;
			}
			return true;
		}

	}
	
	private function saveCategories($post_id, $post_cats) {
		if(is_array($post_cats)) {
			$pc = array();
			foreach($post_cats as $c)
				array_push($pc, "('".$post_id."','".$c."')");
			
			$sql = "INSERT IGNORE INTO posts_categories VALUES ".implode(", ", $pc) ;			
			return $this->db->query( $sql );
		} else return 0;
	}
	
	private function saveTags($post_id, $post_tags) {
		
		$this->db->query("DELETE FROM posts_tags WHERE post_id = '".$post_id."'");
		if(is_array($post_tags)) {
			$tag_tag = array();
			foreach($post_tags as $name) {
				$tag = helper::getTag($name);
				array_push($tag_tag, $tag);
				$this->db->query("INSERT IGNORE INTO tags VALUES ('".$name."','".$tag."')");
			}
	
			$pt = array();
			foreach($tag_tag as $tag)
				array_push($pt, "('".$post_id."','".$tag."')");
			
			$sql = "INSERT IGNORE INTO posts_tags VALUES ".implode(", ", $pt);
			
			return $this->db->query( $sql );
		} else return 0;
	}
	
	public function getList($page = 1, $perpage = 10){
		$offset = ($page-1)*$perpage;
		
		$sql = "SELECT id, post_page, post_title, post_subtitle, DATE_FORMAT(post_date, '%d/%m/%Y %H:%i') AS post_date, 
				DATE_FORMAT(post_modified, '%d/%m/%Y %H:%i') AS post_modified, 
				SUBSTRING(post_content, 1,100) AS post_content, 
				post_status, post_excerpt, post_author_id, post_password, 
				comment_status, 
				(SELECT COUNT(*) FROM posts_comments pc WHERE pc.post_id = p.id) AS comment_count, 
				hits
				FROM posts p
				ORDER BY id DESC 
				LIMIT $offset, $perpage ";
				
		$result = $this->db->getResults( $sql );
		return $result;
	}
	
	public function getListByCat($category, $page = 1, $perpage = 10){
		
		$category = $this->db->escape($category);
		$offset = ($page-1)*$perpage;
		
		$sql = "SELECT id, post_page, post_title, post_subtitle, DATE_FORMAT(post_date, '%d/%m/%Y %H:%i') AS post_date, 
				DATE_FORMAT(post_modified, '%d/%m/%Y %H:%i') AS post_modified, 
				SUBSTRING(post_content, 1,100) AS post_content, 
				post_status, post_excerpt, post_author_id, post_password, 
				comment_status,
				(SELECT COUNT(*) FROM posts_comments c WHERE c.post_id = p.id) as comment_count,
				hits
				FROM posts p LEFT JOIN posts_categories pc ON p.id = pc.post_id
				WHERE pc.category_tag = '$category'
				ORDER BY id DESC 
				LIMIT $offset, $perpage ";
				
		$result = $this->db->getResults( $sql ); //var_dump($this->db);
		return $result;
	}
	
	public function getListByTag($tag, $page = 1, $perpage = 10){
		
		$category = $this->db->escape($tag);
		$offset = ($page-1)*$perpage;
		
		$sql = "SELECT id, post_page, post_title, post_subtitle, DATE_FORMAT(post_date, '%d/%m/%Y %H:%i') AS post_date, 
				DATE_FORMAT(post_modified, '%d/%m/%Y %H:%i') AS post_modified, 
				SUBSTRING(post_content, 1,100) AS post_content, 
				post_status, post_excerpt, post_author_id, post_password, 
				comment_status,
				(SELECT COUNT(*) FROM posts_comments c WHERE c.post_id = p.id) as comment_count,
				hits
				FROM posts p LEFT JOIN posts_tags pt ON p.id = pt.post_id
				WHERE pt.tag_tag = '$tag'
				ORDER BY id DESC 
				LIMIT $offset, $perpage ";
				
		$result = $this->db->getResults( $sql ); //var_dump($this->db);
		return $result;
	}
	
	public function delete($id) {
		if($this->db->delete('posts', array('id'=>$id)))
			return true;
		else $this->error = $this->db->getLastError();
		return false;
	}
	
	// get a single post by a post id
	public function getPost($postid) {
		
		$columns = array("id", "post_page", "post_title", "post_subtitle", "DATE_FORMAT(post_date, '%d/%m/%Y') AS post_date", 
				"DATE_FORMAT(post_date, '%H:%i:%s') AS post_time", 
				"DATE_FORMAT(post_modified, '%d/%m/%Y %H:%i%s') AS post_modified", 
				"post_content", 
				"post_status", "post_excerpt", "post_author_id", "post_password", 
				"comment_status");
		
		$result = $this->db->select("posts", $columns, array("id"=>$postid));
		if($result)
			return $result[0];
	}	
	
	public function getCategories($postid) {
		$sql = "SELECT ct.name AS name, ct.tag AS tag " .
				"FROM posts_categories pct LEFT JOIN categories ct ON pct.category_tag = ct.tag " .
				"WHERE pct.post_id = '".$postid."'";
		return $this->db->query( $sql );
	}
	
	public function getTags($postid) {
		$sql = "SELECT tt.name AS name, tt.tag AS tag " .
				"FROM posts_tags ptt LEFT JOIN tags tt ON ptt.tag_tag = tt.tag " .
				"WHERE ptt.post_id = '".$postid."'";
		return $this->db->query( $sql );
	}
	
	public function getPostCount() {
		$sql = "SELECT count(*) FROM posts";
		return $this->db->getVar( $sql );
	}
}