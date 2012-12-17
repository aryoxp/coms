<?php
class model_news_post extends model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public $error;
	public $id;
	public $modified;
	
	public function save($post_page, $post_title, $post_date, 
							$post_content, $post_status, $post_url, $id) {
		
		$this->error = NULL;
		
		$data['post_page']		= $post_page;
		$data['post_date'] 		= $post_date;
		$data['post_modified'] 	= date('Y-m-d H:i:s');
		$data['post_title'] 	= $post_title;
		$data['post_content'] 	= $post_content;
		$data['post_status']	= $post_status;
		$data['post_url']		= $post_url;
			
		if($id == NULL) { // saving
			
			if( $affectedRows = $this->db->insert('news', $data) ) {
				$this->id = $this->db->getLastInsertId();
				
				$this->modified = $data['post_modified'];
				return true;
			} else $this->error = $this->db->getLastError();
			return false;
		} else { // updating
		
			$where['id'] = $id;
			$this->id = $id;
			$this->modified = $data['post_modified'];			
						
			if( $affected_rows = $this->db->update('news', $data, $where) ) {
				return true;
			} else if( $this->error = $this->db->getLastError() ) {
				return false;
			}
			return true;
		}

	}
	
	public function getList($page = 1, $perpage = 10){
		$offset = ($page-1)*$perpage;
		
		$sql = "SELECT id, post_page, post_title, DATE_FORMAT(post_date, '%d/%m/%Y %H:%i') AS post_date, 
				DATE_FORMAT(post_modified, '%d/%m/%Y %H:%i') AS post_modified, 
				SUBSTRING(post_content, 1,100) AS post_content, 
				post_status, post_url,
				hits
				FROM news p
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
				(SELECT COUNT(*) FROM news_comments c WHERE c.post_id = p.id) as comment_count,
				hits
				FROM news p LEFT JOIN news_categories pc ON p.id = pc.post_id
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
				(SELECT COUNT(*) FROM news_comments c WHERE c.post_id = p.id) as comment_count,
				hits
				FROM news p LEFT JOIN news_tags pt ON p.id = pt.post_id
				WHERE pt.tag_tag = '$tag'
				ORDER BY id DESC 
				LIMIT $offset, $perpage ";
				
		$result = $this->db->getResults( $sql ); //var_dump($this->db);
		return $result;
	}
	
	public function delete($id) {
		if($this->db->delete('news', array('id'=>$id)))
			return true;
		else $this->error = $this->db->getLastError();
		return false;
	}
	
	// get a single post by a post id
	public function getPost($postid) {
		
		$columns = array("id", "post_page", "post_title", "DATE_FORMAT(post_date, '%d/%m/%Y') AS post_date", 
				"DATE_FORMAT(post_date, '%H:%i:%s') AS post_time", 
				"DATE_FORMAT(post_modified, '%d/%m/%Y %H:%i%s') AS post_modified", 
				"post_content", 
				"post_status", "post_url");
		
		$result = $this->db->select("news", $columns, array("id"=>$postid)); 
		//var_dump($this->db);
		if($result)
			return $result[0];
	}	
	
	public function getCategories($postid) {
		$sql = "SELECT ct.name AS name, ct.tag AS tag " .
				"FROM news_categories pct LEFT JOIN categories ct ON pct.category_tag = ct.tag " .
				"WHERE pct.post_id = '".$postid."'";
		return $this->db->query( $sql );
	}
	
	public function getTags($postid) {
		$sql = "SELECT tt.name AS name, tt.tag AS tag " .
				"FROM news_tags ptt LEFT JOIN tags tt ON ptt.tag_tag = tt.tag " .
				"WHERE ptt.post_id = '".$postid."'";
		return $this->db->query( $sql );
	}
	
	public function getPostCount() {
		$sql = "SELECT count(*) FROM news";
		return $this->db->getVar( $sql );
	}
}