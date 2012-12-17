<?php
class controller_subcontroller_home extends controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$this->view( 'home.php' );
	}
}
?>