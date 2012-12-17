<?php
class controller_methods extends comscontroller {

	function __construct() {
		parent::__construct();
		
		// this controller requires authentication
		// initialize it
		$this->require_auth('auth'); 
	}

	function write() {

		$data['user'] 	= $this->session->get("user");
		
		$this->add_style('css/editor.css');
		$this->add_script('bootstrap/js/bootstrap-datepicker.js');
		$this->add_script('bootstrap/js/bootstrap-tab.js');
		$this->add_script('js/tiny_mce/jquery.tinymce.js');
		$this->add_script('js/news/write.js');
		
		$this->view('news/write.php', $data);
	}
		
	function save(){
		$mnews = new model_news_post();
		
		$id = $_POST['id'];
		if(!$id) $id = NULL;
		
		// pretty URL processing
		if(!isset($_POST['post_page'])) {
			$post_page = preg_replace('/[^a-z0-9]+/i', '-', $_POST['post_title']);
			$post_page = preg_replace('/(-)+/i', '-', $post_page);
		} else $post_page = $_POST['post_page']; 
		$post_page = strtolower( $post_page );
		
		$post_title = $_POST['post_title'];
		
		$post_date = implode("-", array_reverse(explode("/",trim($_POST['post_date']))));
		$post_date .= " " . trim($_POST['post_time']);
		
		$post_content = $_POST['post_content'];
		$post_status = $_POST['post_status'];
		$post_url = $_POST['post_url'];
		
		$save = $mnews->save($post_page, $post_title, $post_date, 
							$post_content, $post_status, $post_url, $id);
		$result = array();
							
		if( $save ) {
			$result['status'] = "OK";
			$result['id'] = $mnews->id;
			$result['modified'] = "Last saved on " . date('d/m/Y H:i:s', strtotime($mnews->modified));
		} else {
			$result['status'] = "NOK";
			$result['id'] = $mnews->id;
			$result['error'] = $mnews->error;
		}
		
		echo json_encode($result);
	}
	
	function index($by = 'all', $keyword = NULL, $page = 1){
		
		$perpage = 50;
		
		$mnews = new model_news_post();
		
		switch($by) {
			case 'all':		
				$data['news'] = $mnews->getList($page, $perpage);
				break;
			case 'cat':
				$data['news'] = $mnews->getListByCat($keyword, $page, $perpage);
				break;
			case 'tag':
				$data['news'] = $mnews->getListByTag($keyword, $page, $perpage);
				break;				
			case 'search':
				$data['news'] = $mnews->getListBySearch($keyword, $page, $perpage);
				break;
		}

		$data['page'] = $page;
		$data['by'] = $by;
		$data['keyword'] = $keyword;
		
		$this->add_script('js/news/index.js');
		
		$this->view("news/index.php", $data);
	}
	
	function delete() {
		$id = $_POST['id'];
		$mnews = new model_news_post();
		$result = array();
		if($mnews->delete($id)) 
			$result['status'] = "OK";
		else {
			$result['status'] = "NOK";
			$result['error'] = $mnews->error;
		}
		echo json_encode($result);
	}
	
	public function discard() {
		$this->delete();
	}
	
	function edit($postid = NULL) {
		
		if( !$postid ) {
			$this->redirect('news');
			exit;
		}
		
		$mnews = new model_news_post();
				
		$data['user'] 	= $this->session->get("user");		
		$data['post']		= $mnews->getPost($postid);		

		$this->add_style('css/editor.css');
		$this->add_script('bootstrap/js/bootstrap-datepicker.js');
		$this->add_script('bootstrap/js/bootstrap-tab.js');
		$this->add_script('js/tiny_mce/jquery.tinymce.js');
		$this->add_script('js/news/edit.js');
		
		$this->view('news/edit.php', $data);
	}
	
	public function tags() {
		
		$mtags = new model_news_tags();
		$mcats = new model_news_categories();

		$data['tags'] = $mtags->getAllTags();
		$data['categories'] = $mcats->getAllCategories();
		
		$this->add_script('js/news/tags.js');
		
		$this->view('news/tags.php', $data);
	}
	
	public function deltag() {
		
		$tagname = $_POST['tagname'];
		$mtags = new model_news_tags();

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
		$mtags = new model_news_categories();

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