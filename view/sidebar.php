<div class="container-fluid">
	<div class="span3">
	
	<ul class="nav nav-list">
	  <li class="nav-header">COMS</li>
	  <li><a href="<?php echo $this->location(); ?>"><i class="icon-fire"></i> Dashboard</a></li>
	  <li class="nav-header">Modules</li>
	
		<?php
		foreach ($modules as $modname) {
			$module_url = "module/" . $modname . "/";
			$menufile = MODULE . $modname . "/view/" . $modname . ".menu.php";
			//var_dump($menufile);
			if( is_readable( $menufile ) )
				include($menufile);
		}
		?>
      <li class="nav-header">Settings and Preferences</li>

	<li class="dropdown">
	  <a href="#about" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Profile
	  <b class="caret"></b>
	  </a>
	  <ul class="dropdown-menu">
	    <li><a href="<?php echo $this->location('user/profile'); ?>"><i class="icon-user"></i> My Profile</a></li>
	    <li class="divider"></li>
	    <li><a href="<?php echo $this->location('password/change'); ?>"><i class="icon-qrcode"></i> Change Password</a></li>
	  </ul>              
	</li>

      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> Settings
		<b class="caret"></b>
		</a>
			<ul class="dropdown-menu">
		    <li><a href="<?php echo $this->location($module_url); ?>"><i class="icon-user"></i> User Management</a></li>
		    <li><a href="<?php echo $this->location($module_url."home/write"); ?>">
		    <i class="icon-th"></i> Modules</a></li>
		</ul>      
      </li>



	</ul>

	</div><!--/span3-sidebar-->
	<div class="span9"><!--container-content-->
	