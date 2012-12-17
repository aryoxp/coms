<?php
class model_contacts_message extends model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public $error;
	public $id;
	public $modified;
	
	public function getList($page = 1, $perpage = 50){
		$offset = ($page-1)*$perpage;
		
		$sql = "SELECT id, name, email, address, phone, message
				FROM contact
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
				(SELECT COUNT(*) FROM contacts_comments c WHERE c.post_id = p.id) as comment_count,
				hits
				FROM contacts p LEFT JOIN contacts_categories pc ON p.id = pc.post_id
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
				(SELECT COUNT(*) FROM contacts_comments c WHERE c.post_id = p.id) as comment_count,
				hits
				FROM contacts p LEFT JOIN contacts_tags pt ON p.id = pt.post_id
				WHERE pt.tag_tag = '$tag'
				ORDER BY id DESC 
				LIMIT $offset, $perpage ";
				
		$result = $this->db->getResults( $sql ); //var_dump($this->db);
		return $result;
	}
	
	public function delete($id) {
		if($this->db->delete('contact', array('id'=>$id)))
			return true;
		else $this->error = $this->db->getLastError();
		return false;
	}
	
	// get a single post by a post id
	public function get($postid) {
		
		$columns = array("id", "name", "email", "address", 
				"phone", "message");
				
		$result = $this->db->select("contact", $columns, array("id"=>$postid));  //var_dump($this->db);
		
		if($result) return $result[0];
	}	
	
	public function getCategories($postid) {
		$sql = "SELECT ct.name AS name, ct.tag AS tag " .
				"FROM contacts_categories pct LEFT JOIN categories ct ON pct.category_tag = ct.tag " .
				"WHERE pct.post_id = '".$postid."'";
		return $this->db->query( $sql );
	}
	
	public function getTags($postid) {
		$sql = "SELECT tt.name AS name, tt.tag AS tag " .
				"FROM contacts_tags ptt LEFT JOIN tags tt ON ptt.tag_tag = tt.tag " .
				"WHERE ptt.post_id = '".$postid."'";
		return $this->db->query( $sql );
	}
	
	public function getPostCount() {
		$sql = "SELECT count(*) FROM contacts";
		return $this->db->getVar( $sql );
	}
}