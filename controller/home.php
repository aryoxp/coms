<?php
class controller_home extends comscontroller {

	function __construct() {
		parent::__construct();
		$this->require_auth('auth');
	}
	
	function index() {
		$posts = new model_posts_post();
		$comments = new model_posts_comments();
		$categories = new model_posts_categories();
		
		$this->add_script('js/home.js');
		
		
		$data['post_count'] = $posts->getPostCount();
		$data['catstat'] = $categories->getCategoriesStat();
		$data['posts'] = $posts->getList(1, 5);
		$data['comments'] = $comments->getRecentList(1, 5);

		$this->head();
		$this->view( 'home.php', $data );
		$this->foot();
	}
}
?>
