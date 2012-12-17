<?php
class controller_module extends comscontroller {

	public $module = NULL;

	function __construct() {
		parent::__construct();
		
		// this controller requires authentication
		// initialize it!
		$this->require_auth('auth');
		
		// re-route to module MVC
		if(!method_exists($this, $this->methodName))
			$this->start();
					
	}
	
	public function index( $status = NULL){
	
		$mmodule = new model_module();
		$moption = new model_options();
		
		$data['active_modules'] = $moption->read('coms-module');
		$data['modules'] = $mmodule->getAllAvailableModules();
		$data['status'] = $status;

		//var_dump($data);
		
		$this->add_script('js/modules.js');
		
		$this->view("modules/index.php", $data);
	}
	
	public function activate() {
		$mmodule = new model_module();
		
		if(isset($_POST['module']) && $result = $mmodule->activate( $_POST['module'] ) )
		{	
			echo json_encode(array('result'=>"OK"));
		} else echo json_encode(array('result'=>"NOK"));
		//var_dump($result);
	}
	
	public function deactivate() {
		$mmodule = new model_module();

		if( isset($_POST['module']) && $mmodule->deactivate( $_POST['module'] ) )
			echo json_encode(array('result'=>"OK"));
		else echo json_encode(array('result'=>"NOK"));
	}
		
	private function initRouter(){
		
		//echo "<pre>";
		
		//$this->config 		= config::instance();
		//$this->fulluristring 	= $_SERVER['REQUEST_URI'];

		$path = NULL;
		
		if(isset( $_SERVER['PATH_INFO'] )) $path = $_SERVER['PATH_INFO'];
		else {
			$prepath = str_replace("/index.php", "", $_SERVER['SCRIPT_NAME']);
			$path = str_replace($prepath, "", $_SERVER['REQUEST_URI']);
		} 
		
		$path = trim( $path, "/" ); // remove trailing and heading slash if any
		$patharray = explode("/", $path);
		$patharray = array_splice($patharray,1,count($patharray)-1);
		
		if( count( $patharray ) ) {
		
			$this->module->name = $patharray[0];
			$this->module->args = array();

			$patharray = array_splice($patharray,1,count($patharray)-1);
			
			if ( count( $patharray ) == 0 ) {
				$this->module->controller = $this->module->name."_"."home";
				$this->module->method = "index";
			} elseif ( count( $patharray ) > 0) {
				
				while(count($patharray)) {
								
					$p = "modules/".$this->module->name."/controller/".implode("/", $patharray).".php";
					
					if(file_exists( $p )) { //echo $p." exists!\n";
					
						$this->module->controller = $this->module->name
							."_".implode("_", $patharray);
						
						if( count($this->module->args) )						
							$this->module->method = array_pop($this->module->args);	
						else $this->module->method = "index";
						
						$this->module->args = array_reverse($this->module->args);
						
						break;
						
					} // else echo $p." not exists!\n";

					$this->module->args[] = array_pop($patharray);
				}
				
			}
	
		}
		
	}
	
	private function start() {
		
		$this->initRouter();
		//var_dump($this->module);
		if($this->module && $this->module->controller) {
			
			//parent::__construct();
		
			$mod = new $this->module->controller();

			if( $mod ) {
				if(method_exists($mod, $this->module->method)) {
					call_user_func_array(array($mod, $this->module->method), $this->module->args);
					exit;
				} else {
					// catch errors in case selected method is undefined
					$err = "Method ".$this->module->method." is undefined on controller: ".$this->module->controller;
					$error = new error( $err );
					$error->show();
					exit;
				}
			}
		}
	}
	
}