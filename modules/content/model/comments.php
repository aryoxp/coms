<?php
class model_posts_comments extends model {
	
	public function __construct() {
		parent::__construct();	
	}
	
	public function getList($post_id) {
		if( $post_id = $this->db->escape( $post_id ) ) {
			
			$columns = array('id','post_id','comment_date',
								'comment_name','comment_email', 
								'comment_web','comment_text',
								'comment_follow','comment_status'
							);

			$where['comment_status'] = 1;
			$where['post_id'] = $post_id;
			
			$result = $this->db->select('posts_comments', $columns, $where);
			
			//var_dump($this->db);
			return $result;
		} else return NULL;
	}
	
	public function getRecentList($page = 1, $perpage = 10) {
		if( $page = $this->db->escape( $page ) ) {
			
			$offset = ( $page - 1 ) * $perpage;
			
			$sql = "SELECT pc.id AS id, post_id, comment_date, comment_name, comment_email, "
					. "comment_web, "
					. "SUBSTRING_INDEX(comment_text, ' ', 60) AS comment_text, "
					. "comment_follow, pc.comment_status, "
					. "p.post_page, p.post_title "
					. "FROM posts_comments pc "
					. "LEFT JOIN posts p ON pc.post_id = p.id "
					. "LIMIT $offset, $perpage ";
			
			$result = $this->db->query( $sql );
			//var_dump($this->db);
			return $result;
		} else return NULL;
	}	
}