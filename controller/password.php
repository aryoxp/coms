<?php
class controller_password extends comscontroller {
	function __construct() {
		parent::__construct();
		
		// this controller requires authentication
		// initialize it!
		$this->require_auth('auth'); 
	}
	
	public function change() {
		
		$this->add_script('js/password/change.js');
		$this->view('password/change.php');
	}
	
	public function update() {
		$muser = new model_user();
		
		$username = $_POST['username'];
		$oldpassword = $_POST['oldpassword'];
		$newpassword = $_POST['newpassword'];
		
		if($res = $muser->updatepassword($username, $oldpassword, $newpassword)) 
			$result['status'] = "OK";
		else {
			$result['status'] = "NOK";
			$result['error'] = 'Update failed! Probably you had wrong entering your old password.';
		}
		echo json_encode($result);
	}
}	