<?php
class controller_contacts extends comscontroller {

	function __construct() {
		parent::__construct();
		
		// this controller requires authentication
		// initialize it
		$this->require_auth('auth'); 
	}
	
	function index($keyword = NULL, $page = 1){
		
		$perpage = 50;
		
		$mcontacts = new model_contacts_message();
		$data['messages'] = $mcontacts->getList($page, $perpage);
		$data['page'] = $page;
		$data['keyword'] = $keyword;
		
		$this->add_script('js/contacts/index.js');
		
		$this->view("contacts/index.php", $data);
	}
	
	function read($id = NULL){
		$mcontacts = new model_contacts_message();
		$data['message'] = $mcontacts->get($id);	
		
		$this->add_script('js/contacts/read.js');
			
		$this->view("contacts/read.php", $data);
	}
	
	function delete() {
		$id = $_POST['id'];
		$mcontacts = new model_contacts_message();
		$result = array();
		if($mcontacts->delete($id)) 
			$result['status'] = "OK";
		else {
			$result['status'] = "NOK";
			$result['error'] = $mcontacts->error;
		}
		echo json_encode($result);
	}
	
	public function discard() {
		$this->delete();
	}
	
}
?>