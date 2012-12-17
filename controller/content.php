<?php
class controller_content extends comscontroller {

	function __construct() {
		parent::__construct();
		
		// this controller requires authentication
		// initialize it
		$this->require_auth('auth'); 
	}

	function write() {
		/*
		$mtags = new model_posts_tags();
		$mcats = new model_posts_categories();
		*/		
		$data['user'] 	= $this->session->get("user");
		/*
		$data['tags'] 		= $mtags->getAllTags();
		$data['categories'] = $mcats->getAllCategories();
		*/
		$this->add_style('css/editor.css');
		$this->add_script('bootstrap/js/bootstrap-datepicker.js');
		$this->add_script('bootstrap/js/bootstrap-tab.js');
		$this->add_script('js/contents/write.js');
		
		$this->view('contents/write.php', $data);
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
                    	<input type="checkbox" name="content_categories[]" checked="checked" value="'.$cat->tag.'" />
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
		$mpost = new model_contents_content();
		
		$id = $_POST['id'];
		if(!$id) $id = NULL;
				
		$content_page = $_POST['content_page'];
		$content_title = $_POST['content_title'];

		$content_date = implode("-", array_reverse(explode("/",trim($_POST['content_date']))));
		$content_date .= " " . trim($_POST['content_time']);
		
		$content_content = $_POST['content_content'];
		$content_status = $_POST['content_status'];
		$content_author_id = $_POST['content_author_id'];
		
		$save = $mpost->save($content_page, $content_title, $content_date, $content_content, 
							$content_status, $content_author_id, $id);
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
	
	function index($by = 'all', $keyword = NULL, $page = 1, $perpage = 100){
		
		$mpost = new model_contents_content();
		
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
		
		$this->add_script('js/contents/index.js');
		
		$this->view("contents/index.php", $data);
	}
	
	function delete() {
		$id = $_POST['id'];
		$mpost = new model_contents_content();
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
	
	function edit($contentid = NULL) {
		
		if( !$contentid ) {
			$this->redirect('content');
			exit;
		}
		
		$mcontent = new model_contents_content();
				
		$data['user'] 		= $this->session->get("user");		
		$data['content']	= $mcontent->getContent($contentid);

		$this->add_style('css/editor.css');
		$this->add_style('jqueryFileTree/jqueryFileTree.css');
		
		$this->add_script('bootstrap/js/bootstrap-datepicker.js');
		$this->add_script('bootstrap/js/bootstrap-tab.js');
		$this->add_script('jqueryFileTree/jqueryFileTree.js');
		$this->add_script('js/contents/edit.js');
		$this->add_script('js/upload.js');
		$this->add_script('js/filetree.js');
		
		$this->view('contents/edit.php', $data);
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