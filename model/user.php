<?php

class model_user extends model {
	
	public $error = NULL;
	
	
	function __construct() {
		
		// we require database object for this model
		// so execute parent construct 
		
		parent::__construct();
	}
	
	// user table installation method
	public function install() {
		$sql = "CREATE TABLE `coms_user` (
				  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
				  `username` varchar(50) NOT NULL,
				  `password` varchar(32) NOT NULL,
				  `name` varchar(45) DEFAULT NULL,
				  `email` varchar(45) DEFAULT NULL,
				  `level` smallint(6) NOT NULL DEFAULT '0',
				  `status` tinyint(4) NOT NULL DEFAULT '1',
				  PRIMARY KEY (`id`),
				  UNIQUE KEY `u_user` (`username`,`password`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";	
				
		// installs		
		$this->db->query( $sql );
	}
	
	public function authenticate( $username, $password ) {
		
		// escaping submitted username and hashed password
		$username = $this->db->escape( $username );
		$password = md5($this->db->escape( $password ));
		
		// build authentication query
		$sql = "SELECT id, name, email, level 
				FROM coms_user 
				WHERE username = '$username' 
					AND password = '$password' 
					AND status = 1 ";
					
		// getting authentication query result			
		$result = $this->db->getRow( $sql );
		
		// checking query result
		if( $result === NULL ) return $result;
		else {
			
			// OK, authentication successful, 
			// create and return the authenticated user information object
			// from database
			$user = new stdClass;
			$user->id = $result->id;
			$user->username = $username;
			$user->name = $result->name;
			$user->email = $result->email;
			$user->level = $result->level;
			$user->status = 1;
			
			return $user;
			
		}
	}
	
	public function updatepassword( $username, $oldpassword, $newpassword ) {
		
		// escaping submitted username and hashed password
		$username = $this->db->escape( $username );
		$oldpassword = md5($this->db->escape( $oldpassword ));
		$newpassword = md5($this->db->escape( $newpassword ));
		
		$result = $this->db->update("coms_user", array('password'=>$newpassword), array("username"=>$username, "password"=>$oldpassword));
		
		//var_dump($this->db);
		if( ($result and !$this->db->getLastError()) ) 
			return true;
		else if(!$result) return false;
		
	}

	public function setPassword( $id, $newpassword ) {
		
		// escaping submitted username and hashed password
		$id = $this->db->escape( $id );
		$newpassword = md5($this->db->escape( $newpassword ));
		
		$result = $this->db->update("coms_user", array('password'=>$newpassword), array("id"=>$id));
		//var_dump($this->db);
		
		if( ($result and !$this->db->getLastError()) ) 
			return true;
		else if(!$result) {
			if($this->db->getLastError() == '') return true;
			return false;
		}
		
	}
	
	public function getList($page = 1, $perpage = 50) {
		$offset = ($page-1) * $perpage;
		$sql = "SELECT id, username, password, name, email, level, status FROM coms_user "
				. "ORDER BY level, username LIMIT $offset, $perpage ";
		$users = $this->db->query( $sql );
		return $users;
	}
	
	public function save($username, $password, $name, $email, $level, $status, $id = NULL) {
		
		$data['username'] = $this->db->escape($username);
		if( $password !== NULL )
			$data['password'] = md5($this->db->escape($password));
		$data['name'] = $this->db->escape($name);
		$data['email'] = $this->db->escape($email);
		$data['level'] = $this->db->escape($level);
		$data['status'] = $this->db->escape($status);		
		
		if(!$id) {
			$result = $this->db->insert("coms_user", $data);
			if( $result ) {
				return $result;
			} else {
				$this->error = $this->db->getLastError();
				return false;
			}
		} else {
			$where['id'] = $id;
			$result = $this->db->update("coms_user", $data, $where);
			if( $result ) {
				return $result;
			} else {
				$this->error = $this->db->getLastError();
				if($this->error == '') return true;
				return false;
			}
		}
	}
	
	public function delete($id) {
		$result = $this->db->delete("coms_user", array('id'=>$id));
		if( !$result )
			$this->error = $this->db->getLastError();
		return $result;
	}
	
	public function toggleStatus($id) {
		$sql = "UPDATE coms_user SET status = CASE status WHEN 0 THEN 1 ELSE 0 END WHERE id = '$id'";
		$result = $this->db->query( $sql );
		if( !$result )
			$this->error = $this->db->getLastError();
			
		$sql = "SELECT status FROM coms_user WHERE id = '$id'";
		$this->status = $this->db->getVar($sql);	
			
		return $result;
	}
	
	public function get($id) {
		
		$sql = "SELECT id, username, password, name, email, level, status FROM coms_user WHERE id = '$id'";
		
		$result = $this->db->getRow( $sql ); //var_dump($this->db);
		return $result;
	}
		
}