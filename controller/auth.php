<?php
class controller_auth extends comscontroller {

	function __construct() {
		parent::__construct();
		$this->session = new session( $this->config->session );
	}
	
	function index() {
		$this->add_script('js/auth/index.js');
		$this->view( 'auth.php' );
	}
	
	function logon() {
		$user = new model_user();
		if( $authenticatedUser = $user->authenticate( $_POST['username'], $_POST['password'] ) ) {
			echo "OK";
			$this->session->set("user", $authenticatedUser);
		} else echo "NOK";
		exit;
	}
	
	function logoff() {
		$this->session->destroy();
		$this->redirect("auth/index");
	}
}
?>