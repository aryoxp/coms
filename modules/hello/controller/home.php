<?php

class hello_home extends comsmodule {
	
	public function __construct() {
		parent::__construct();
		//var_dump($this);
	}
	
	public function path() {
		$this->head();
		echo "Hello, from hello home path!";
		$this->foot();
	}
	
	public function index() {
$this->head();
echo "Hello, from index!";
$this->foot();		
	}
}