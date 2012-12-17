<?php
class comscontroller extends controller {
    
	private $scripts = array();
	private $styles = array();
	
	private $page_title = NULL;
	private $isAuthenticated = false;
	
	public $session = NULL;
	public $authenticatedUser = NULL;
	
	private $comsmodules = NULL;
	
    public function __construct(){

        parent::__construct();    
  		if(!defined('MODULE'))
  			define('MODULE','modules/');
  		      
		$this->page_title = $this->config->page_title;		
		$this->loadAllModules();
		
	}
	
	public function loadAllModules() {

		$mmodule = new model_module();
		$this->comsmodules = $mmodule->getAllActiveModules(); //var_dump($this->comsmodules);
		
		autoloader::register(array($this, 'autoload_module_controller'));
		autoloader::register(array($this, 'autoload_module_model'));
		autoloader::register(array($this, 'autoload_module_library'));	
	}
	
	public function require_auth($authcontroller = false) {
		$this->session = new session( $this->config->session );
		if( $authcontroller !== false ) {
				
			$this->authenticatedUser = $this->session->get('user');
			if($this->authenticatedUser) {
				$this->headerdata['authenticated'] = true;
			} else {
				$this->redirect($authcontroller);
				exit;
			}		
			
		} else {
			$this->headerdata['authenticated'] = false;
			$this->headerdata['user'] = NULL;
		}		
	}
	
	public function head() {
		$navbar['user'] = $this->authenticatedUser;   //$this->session->get("user");
		$navbar['modules'] = $this->comsmodules;
		$navbar['userid'] = $this->authenticatedUser->username;
		
		$this->view('header.php');
		$this->view('navbar.php', $navbar);		
	}
	
	public function foot() {
		$this->view('footer.php');		
	}
	
	public function add_style($stylepath) {
		if(file_exists( $this->config->assets_folder . "/" . $stylepath ))
			$this->styles[]	= $stylepath;
	}
	
	public function add_script($scriptpath) {
		if(file_exists( $this->config->assets_folder . "/" . $scriptpath ))
			$this->scripts[] = $scriptpath;
	}
	
	public function get_scripts() {
		return $this->scripts;
	}
	
	public function get_styles() {
		return $this->styles;	
	}
	
	public function page_title($appended_string = NULL) {
		return $this->page_title . $appended_string;	
	}
	
	public function no_privileges() {
		$this->view('error/noprivileges.php');
		exit;
	}
	
	public function autoload_module_controller( $className ) {
		// convert the given class name to it's path
		$classPath = trim( str_replace("_", "/", $className), "/" );
		@include_once MODULE . $this->module->name . "/controller/" 
			. trim( strstr( $classPath, "/" ), "/" ) .'.php';
			
	}
	
	public function autoload_module_model( $className ) {
		// convert the given class name to it's path
		$classPath = trim( str_replace("_", "/", $className), "/" );
		@include_once MODULE . $this->module->name . "/model/" 
			. trim( strstr( $classPath, "/" ), "/" ) .'.php';
			
	}
	
	public function autoload_module_library( $className ) {
		// convert the given class name to it's path
		$classPath = trim( str_replace("_", "/", $className), "/" );
		@include_once MODULE . $this->module->name . "/library/" 
			. trim( strstr( $classPath, "/" ), "/" ) .'.php';
				
	}
	
}