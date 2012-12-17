
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">

          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo $this->location(); ?>">COMS</a>
          
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="<?php echo $this->location(); ?>"><i class="icon-home"></i> Dashboard</a></li>

<?php
foreach ($modules as $modname) {
	$module_url = "module/" . $modname . "/";
	$menufile = MODULE . $modname . "/view/" . $modname . ".menu.php";
	//var_dump($menufile);
	if( is_readable( $menufile ) )
		include($menufile);
}
?>

			  <!--
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $this->location('content'); ?>">Contents
                <b class="caret"></b>
                </a>
              	<ul class="dropdown-menu">
                	<li><a href="<?php echo $this->location('content/write'); ?>"><i class="icon-pencil"></i> Write New Content</a></li>
                    <li><a href="<?php echo $this->location('content'); ?>"><i class="icon-list"></i> List Content</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $this->location('news'); ?>">News
                <b class="caret"></b>
                </a>
              	<ul class="dropdown-menu">
                	<li><a href="<?php echo $this->location('news/write'); ?>"><i class="icon-pencil"></i> Write New News</a></li>
                    <li><a href="<?php echo $this->location('news'); ?>"><i class="icon-list"></i> List News</a></li>
                </ul>
              </li>
              
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-envelope"></i> Contacts
                <b class="caret"></b>
                </a>
              	<ul class="dropdown-menu">
                    <li><a href="<?php echo $this->location('contacts'); ?>"><i class="icon-list"></i> Message List</a></li>
                </ul>
              </li>
              -->              
              <!--

              <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Gadgets &amp; Techs
              <b class="caret"></b>
                </a>
              	<ul class="dropdown-menu">
                	<li><a href=""><i class="icon-pencil"></i> Write New Posts</a></li>
                    <li><a href=""><i class="icon-list"></i> List</a></li>
                    <li><a href=""><i class="icon-comment"></i> Comments</a></li>
                </ul>
              </li>
              -->
            </ul>
            
            <ul class="nav pull-right">
              <li class="dropdown" id="menu1">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#menu1">
                  <i class="icon-cog"></i> Settings
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo $this->location('user'); ?>"><i class="icon-user"></i> User Management</a></li>
                  <li><a href="<?php echo $this->location('module'); ?>"><i class="icon-th"></i> Modules</a></li>
                  <!--
                  <li class="divider"></li>
                  <li><a href="#">Preferences</a></li>
                  -->
                </ul>
              </li>
              
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
              <li class="divider-vertical"></li>
              <li><a href="<?php echo $this->location('auth/logoff'); ?>"><i class="icon-off"></i> Logout</a></li>
            </ul>
            
          </div><!--/.nav-collapse -->
          
        </div>
      </div>

    </div>
