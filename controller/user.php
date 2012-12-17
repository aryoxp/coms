<?php
class controller_user extends comscontroller {

	function __construct() {
		parent::__construct();
		
		// this controller requires authentication
		// initialize it
		$this->require_auth('auth');
	}
	
	function write() {
		$mtags = new model_travel_tags();
		$mcats = new model_travel_categories();
				
		$data['user'] 	= $this->session->get("user");
		$data['tags'] 		= $mtags->getAllTags();
		$data['categories'] = $mcats->getAllCategories();

		$this->view('travel/write.php', $data);
	}
	
	function create() {
		
		$muser = new model_user();
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$level = $_POST['level'];
		$status = 0; // suspended
		if( isset( $_POST['status'] ) ) 
			$status = $_POST['status'];
		
		if( $muser->save($username, $password, $name, $email, $level, $status ) ) 
			$result['status'] = 'OK';
		else {
			$result['status'] = "NOK";
			$result['error'] = $muser->error;
		}
		echo json_encode($result);
	}
	
	function getAllTags(){
		$mtags = new model_travel_tags();
		$tags = $mtags->getAllTags();
		$atags = array();
		foreach($tags as $tag)
			array_push( $atags, $tag->name );
		echo json_encode($atags);
	}
	
	function getAllCategories(){
		$mcats = new model_travel_categories();
		$cats = $mcats->getAllCategories();
		$acats = array();
		foreach($cats as $cat)
			array_push( $acats, $cat->name );
		echo json_encode($acats);
	}
	
	function save(){
		
		$id = $_POST['id'];
		$username = $_POST['username'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$level = $_POST['level'];
		$status = $_POST['status'];
		
		if(isset($_POST['password']))
			$password = $_POST['password'];
		else $password = NULL;
		
		$muser = new model_user();
		$save = $muser->save($username, $password, $name, $email, $level, $status, $id);
							
		if( $save ) {
			$result['status'] = "OK";
			$result['modified'] = "Last saved on " . date('d/m/Y H:i:s');
		} else {
			$result['status'] = "NOK";
			$result['error'] = $muser->error;
		}
		
		echo json_encode($result);
	}
	
	public function updatepassword() {
		$id = $_POST['id'];
		$password = $_POST['password'];
		$muser = new model_user();
		$save = $muser->setPassword($id, $password);
		$result['status'] = "OK";
		if( $save ) {
			$result['status'] = "OK";
			$result['modified'] = "Last saved on " . date('d/m/Y H:i:s');
		} else {
			$result['status'] = "NOK";
			$result['error'] = $muser->error;
		}		
		echo json_encode($result);
	}
	
	function index($page = 1){
		
		if($this->authenticatedUser->level > 1)
			$this->no_privileges();
		
		$muser = new model_user();
		$data['users'] = $muser->getList($page, 50);
		$data['page'] = $page;
		
		
		$this->add_script('js/user/index.js');
		$this->add_script('js/user/create.js');
		
		$this->view("users/index.php", $data);
	}
	
	function delete() {
		$id = $_POST['id'];
		$muser = new model_user();
		$result = array();
		if($muser->delete($id)) 
			$result['status'] = "OK";
		else {
			$result['status'] = "NOK";
			$result['error'] = $muser->error;
		}
		echo json_encode($result);
	}
	
	public function profile() {
		$this->edit($this->authenticatedUser->id);	
	}
	
	public function edit($id = NULL) {
		
		if( !$id ) {
			$this->redirect('user');
			exit;
		}

		$muser = new model_user();
		$data['user'] = $muser->get($id);

		$this->add_script('js/user/edit.js');

		$this->view('users/edit.php', $data);
	}
	
	
	function togglestatus() {
		$id = $_POST['id'];
		$muser = new model_user();
		$result = array();
		if($muser->toggleStatus($id)) {
			$result['status'] = "OK";
			if( $muser->status == 1 )
				$result['ustatus'] = "Active";
			else $result['ustatus'] = "Suspended";
		} else {
			$result['status'] = "NOK";
			$result['error'] = $muser->error;
		}
		echo json_encode($result);
	}
}
?>