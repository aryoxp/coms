<div class="container-fluid">
	<div class="span3">
	
	<ul class="nav nav-list">
	  <li class="nav-header">COMS</li>
	  <li><a href="<?php echo $this->location(); ?>"><i class="icon-fire"></i> Dashboard</a></li>
	  <li class="nav-header">Modules</li>
	
		<?php
		ob_start();
		if(isset($modules) and count($modules)):
			foreach ($modules as $modname) {
				$module_url = "module/" . $modname . "/";
				$menufile = MODULE . $modname . "/view/" . $modname . ".sidemenu.php";
				if( is_readable( $menufile ) )
					include($menufile);
			}
		endif;
		$con = ob_get_clean();
		if(!trim($con))
			echo '<li class="muted"><small><em>No modules</em></small></li>';
		else echo $con;
		?>
      <li class="nav-header">Settings and Preferences</li>

		<?php
		ob_start();
		if(isset($modules) and count($modules)):
			foreach ($modules as $modname) {
				$module_url = "module/" . $modname . "/";
				$menufile = MODULE . $modname . "/view/" . $modname . ".settingmenu.php";
				//var_dump($menufile);
				if( is_readable( $menufile ) )
					include($menufile);
			}
		endif;
		$con = ob_get_clean();
		if(trim($con)) {
			echo $con;
			echo '<li class="divider"></li>';
		}
		?>


	<li class="dropdown-submenu">
	  <a href="#about" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> 
	  Profile
	  </a>
	  <ul class="dropdown-menu" role="menu">
	    <li><a href="<?php echo $this->location('user/profile'); ?>"><i class="icon-user"></i> My Profile</a></li>
	    <li><a href="<?php echo $this->location('password/change'); ?>"><i class="icon-qrcode"></i> Change Password</a></li>
	  </ul>              
	</li>

      <li class="dropdown-submenu">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> 
        Settings
		</a>
			<ul class="dropdown-menu">
		    <li><a href="<?php echo $this->location('user'); ?>"><i class="icon-user"></i> User Management</a></li>
		    <li><a href="<?php echo $this->location('module'); ?>">
		    <i class="icon-th"></i> Modules</a></li>
		</ul>      
      </li>
	</ul>

	</div><!--/span3-sidebar-->
	<div class="span9"><!--container-content-->
	