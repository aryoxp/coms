<?php

class model_module extends model {

	public function __construct() {} // this model doesn't require DB connection
	
	public function getAllAvailableModules(){
		
		$mods = array();
		
		if ($handle = opendir('modules/')) {
		    while (false !== ($entry = readdir($handle))) {
		        if ($entry != "." && $entry != ".." && is_dir('modules/'.$entry)) {
		        
		        	include_once("modules/".$entry."/".$entry.".php");
		        
		        	$mod = new stdClass();
					$mod->id = $entry;
					$mod->name = $module[$mod->id]['name'];
					$mod->description = $module[$mod->id]['description'];
					$mod->author = $module[$mod->id]['author'];
					$mod->version = $module[$mod->id]['version'];
					$mod->version_index = $module[$mod->id]['version_index'];
					$mod->active = false;
					$mods[] = $mod;
		        }
		    }
		    closedir($handle);
		}
		
		return $mods;
	}
	
	public function getAllActiveModules(){
		$moptions = new model_options();
		$mods = $moptions->read('coms-module');
		return $mods;
	}
	
	public function activate( $id = NULL ) {
		$moptions = new model_options();
		$mods = $moptions->read('coms-module');
		if(!is_array($mods)) $mods = array();
		if(is_array($mods) and !in_array($id, $mods))
			$mods[] = $id;
		
		return $moptions->save('coms-module', $mods);
	}
	
	public function deactivate( $id = NULL ) {
		$moptions = new model_options();
		$mods = $moptions->read('coms-module');
		if(in_array($id, $mods))
		{
			if(($key = array_search($id, $mods)) !== false) {
			    unset($mods[$key]);
			}
			
			// clean up
			if(($key = array_search(NULL, $mods)) !== false){
				unset($mods[$key]);
			}
			
			return $moptions->save('coms-module', $mods);
		}		
	}
	
}