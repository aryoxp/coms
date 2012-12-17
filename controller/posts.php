<?php
class controller_posts extends comscontroller {

	function __construct() {
		parent::__construct();
		
		// this controller requires authentication
		// initialize it
		$this->require_auth('auth'); 
	}

	function write() {
		$mtags = new model_posts_tags();
		$mcats = new model_posts_categories();
				
		$data['user'] 	= $this->session->get("user");
		$data['tags'] 		= $mtags->getAllTags();
		$data['categories'] = $mcats->getAllCategories();
		
		$this->add_style('css/editor.css');
		$this->add_script('bootstrap/js/bootstrap-datepicker.js');
		$this->add_script('bootstrap/js/bootstrap-tab.js');
		$this->add_script('js/posts/write.js');
		
		$this->view('posts/write.php', $data);
	}
	
	function create($what, $value = NULL) {
		switch($what) {
			case 'tag':
				$mtags = new model_posts_tags();
				if( $mtags->insert($value) )
					echo "OK"; else echo "NOK";
				break;
			case 'category':
				$mcats = new model_posts_categories();
				$value = $_POST['category'];
				if( $cat = $mcats->insert($value) ) 
					echo '<label class="checkbox span3">
                    	<input type="checkbox" name="post_categories[]" checked="checked" value="'.$cat->tag.'" />
                        '.$cat->name.'
                    </label>'; 
				else echo "NOK";
				break;
		}
	}
	
	function getAllTags(){
		$mtags = new model_posts_tags();
		$tags = $mtags->getAllTags();
		$atags = array();
		foreach($tags as $tag)
			array_push( $atags, $tag->name );
		echo json_encode($atags);
	}
	
	function getAllCategories(){
		$mcats = new model_posts_categories();
		$cats = $mcats->getAllCategories();
		$acats = array();
		foreach($cats as $cat)
			array_push( $acats, $cat->name );
		echo json_encode($acats);
	}
	
	function save(){
		$mpost = new model_posts_post();
		
		$id = $_POST['id'];
		if(!$id) $id = NULL;
		
		// pretty URL processing
		if(!isset($_POST['post_page'])) {
			$post_page = preg_replace('/[^a-z0-9]+/i', '-', $_POST['post_title']);
			$post_page = preg_replace('/(-)+/i', '-', $post_page);
		} else $post_page = $_POST['post_page']; 
		$post_page = strtolower( $post_page );
		
		$post_title = $_POST['post_title'];
		$post_subtitle = $_POST['post_subtitle'];
		
		$post_date = implode("-", array_reverse(explode("/",trim($_POST['post_date']))));
		$post_date .= " " . trim($_POST['post_time']);
		
		$post_content = $_POST['post_content'];
		$post_status = $_POST['post_status'];
		$post_excerpt = $_POST['post_excerpt'];
		$post_author_id = $_POST['post_author_id'];
		$post_password = $_POST['post_password'];
		$comment_status = $_POST['comment_status'];
		
		if(isset($_POST['post_categories']))
			$post_categories = $_POST['post_categories'];
		else $post_categories = NULL;
		
		if(isset($_POST['post_tags']) && trim($_POST['post_tags'])!="")
			$post_tags = explode(",", $_POST['post_tags']);
		else $post_tags = NULL;
		
		$save = $mpost->save($post_page, $post_title, $post_subtitle, $post_date, $post_content, $post_status, 
							$post_excerpt, $post_author_id, $post_password, 
							$comment_status, $post_categories, $post_tags, $id);
		$result = array();
							
		if( $save ) {
			$result['status'] = "OK";
			$result['id'] = $mpost->id;
			$result['modified'] = "Last saved on " . date('d/m/Y H:i:s', strtotime($mpost->modified));
		} else {
			$result['status'] = "NOK";
			$result['id'] = $mpost->id;
			$result['error'] = $mpost->error;
		}
		
		echo json_encode($result);
	}
	
	function index($by = 'all', $keyword = NULL, $page = 1){
		
		$perpage = 10;
		
		$mpost = new model_posts_post();
		
		switch($by) {
			case 'all':		
				$data['posts'] = $mpost->getList($page, $perpage);
				break;
			case 'cat':
				$data['posts'] = $mpost->getListByCat($keyword, $page, $perpage);
				break;
			case 'tag':
				$data['posts'] = $mpost->getListByTag($keyword, $page, $perpage);
				break;				
			case 'search':
				$data['posts'] = $mpost->getListBySearch($keyword, $page, $perpage);
				break;
		}

		$data['page'] = $page;
		$data['by'] = $by;
		$data['keyword'] = $keyword;
		
		$this->add_script('js/posts/index.js');
		
		$this->view("posts/index.php", $data);
	}
	
	function delete() {
		$id = $_POST['id'];
		$mpost = new model_posts_post();
		$result = array();
		if($mpost->delete($id)) 
			$result['status'] = "OK";
		else {
			$result['status'] = "NOK";
			$result['error'] = $mpost->error;
		}
		echo json_encode($result);
	}
	
	public function discard() {
		$this->delete();
	}
	
	function edit($postid = NULL) {
		
		if( !$postid ) {
			$this->redirect('travel');
			exit;
		}
		
		$mtags = new model_posts_tags();
		$mcats = new model_posts_categories();
		$mpost = new model_posts_post();
				
		$data['user'] 	= $this->session->get("user");
		$data['tags'] 		= $mtags->getAllTags();
		$data['categories'] = $mcats->getAllCategories();
		
		$data['post']		= $mpost->getPost($postid);
		$data['post_categories'] = $mpost->getCategories($postid);

		$cats = array();
		if($data['post_categories']):
			foreach($data['post_categories'] as $cat)
				array_push($cats, $cat->tag);		
			$data['post_categories_tag'] = $cats;
		endif;
		
		$data['post_tags'] = $mpost->getTags($postid);

		$this->add_style('css/editor.css');
		$this->add_script('bootstrap/js/bootstrap-datepicker.js');
		$this->add_script('bootstrap/js/bootstrap-tab.js');		
		$this->add_script('js/posts/edit.js');
		
		$this->view('posts/edit.php', $data);
	}
	
	public function tags() {
		
		$mtags = new model_posts_tags();
		$mcats = new model_posts_categories();

		$data['tags'] = $mtags->getAllTags();
		$data['categories'] = $mcats->getAllCategories();
		
		$this->add_script('js/posts/tags.js');
		
		$this->view('posts/tags.php', $data);
	}
	
	public function deltag() {
		
		$tagname = $_POST['tagname'];
		$mtags = new model_posts_tags();

		$result = array();
		if( $mtags->delete( $tagname ) )
			$result['status'] = "OK";
		else {
			$result['status'] = "NOK";
			$result['error'] = $mtags->error;
		}
		echo json_encode($result);
	
	}
	
	public function delcat() {
		
		$catname = $_POST['catname'];
		$mtags = new model_posts_categories();

		$result = array();
		if( $mtags->delete( $catname ) )
			$result['status'] = "OK";
		else {
			$result['status'] = "NOK";
			$result['error'] = $mtags->error;
		}
		echo json_encode($result);
	
	}
	
}
?>