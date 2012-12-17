<?php
class controller_file extends comscontroller {

	function __construct() {
		parent::__construct();
		
		// this controller requires authentication
		// initialize it
		$this->require_auth('auth');
	}
	
	function uploadform() {
		$this->view('upload-form.php');
	}
	
	public function upload() {
		$this->view('upload-result.php');
	}
	
	public function tree() {
		$this->library('jqueryFileTree.php');
	}
}
?>