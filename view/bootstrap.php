<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->

    <link href="<?php echo $this->asset("bootstrap/css/bootstrap.min.css");?>" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="<?php echo $this->asset("bootstrap/css/bootstrap-responsive.min.css"); ?>" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">

          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">C</a>
          
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="#"><i class="icon-home icon-white"></i> Veranda</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Travels
                <b class="caret"></b>
                </a>
              	<ul class="dropdown-menu">
                	<li><a href=""><i class="icon-pencil"></i> Write New Posts</a></li>
                    <li><a href=""><i class="icon-list"></i> List</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Foods
                <b class="caret"></b>
                </a>
              	<ul class="dropdown-menu">
                	<li><a href=""><i class="icon-pencil"></i> Write New Posts</a></li>
                    <li><a href=""><i class="icon-list"></i> List</a></li>
                </ul>
              </li>
              <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Gadgets &amp; Techs
              <b class="caret"></b>
                </a>
              	<ul class="dropdown-menu">
                	<li><a href=""><i class="icon-pencil"></i> Write New Posts</a></li>
                    <li><a href=""><i class="icon-list"></i> List</a></li>
                </ul>
              </li>
            </ul>
            
            <ul class="nav pull-right">
              <li class="dropdown" id="menu1">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#menu1">
                  <i class="icon-cog icon-white"></i> Settings
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">User Management</a></li>
                  <li><a href="#">Modules</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Preferences</a></li>
                </ul>
              </li>
              
              <li><a href="#about"><i class="icon-user icon-white"></i> Profile</a></li>
              <li class="divider-vertical"></li>
              <li><button class="btn btn-danger">Logout</button></li>
            </ul>
            
          </div><!--/.nav-collapse -->
          
        </div>
      </div>

    </div>

    <div class="container-fluid">

	  <div class="row">
        <div class="well span4">
       	  <h2>Travels</h2>
          <ul>
              <li>This section has <span class="badge badge-info">234</span> posts and <span class="badge badge-success">22</span> comments</li>
              <li><span class="badge badge-error">2</span> comments marked as spam <a class="btn btn-danger btn-mini">Delete All</a></li>
              <li><span class="badge badge-warning">3</span> comments awaiting moderation</li>
          </ul>
		</div>
          <div class="well span4">
		  <h2>Foods</h2>
          <ul>
              <li>This section has 234 posts and 22 comments</li>
              <li>2 comments marked as spam</li>
              <li>3 comments awaiting moderation</li>
          </ul>
          </div>
          <div class="well span4">
		  <h2>Gadgets &amp; Techs</h2>
          <ul>
              <li>This section has 234 posts and 22 comments</li>
              <li>2 comments marked as spam</li>
              <li>3 comments awaiting moderation</li>
          </ul>          
          </div>
	  </div>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $this->asset("js/jquery-1.7.1.min.js"); ?>"></script>
    <script src="<?php echo $this->asset("bootstrap/js/bootstrap.min.js"); ?>"></script>
  </body>
</html>
