<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>COMS<?php if(isset($title)) echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="pragma" content="no-cache">

    <!-- Le styles -->
    <link href="<?php echo $this->asset('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="<?php echo $this->asset('bootstrap/css/bootstrap-responsive.min.css'); ?>" rel="stylesheet">


<?php
/*
$uri = new uri();	
$controller = $uri->getController();
$method = $uri->getMethod();
$controller = preg_replace("/^controller_/i", "", $controller, 1);
$controller = str_replace("_", "/", $controller);
*/
?>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo $this->asset('ico/favicon.ico'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->asset('ico/apple-touch-icon-144-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->asset('ico/apple-touch-icon-114-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->asset('ico/apple-touch-icon-72-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $this->asset('ico/apple-touch-icon-57-precomposed.png'); ?>">
  </head>

	<!-- Le base URL helper for javascript -->
	<script type="text/javascript">
		var base_url = '<?php echo $this->location(); ?>';
		var web_base_url = '<?php echo $this->config->web_base_url; ?>';
		var base_path = '<?php echo addslashes(getcwd()); ?>';
	</script>

  <body>
  
  <div class="container-fluid">
  	<div class="row-fluid">
  		<div class="span12">
  		<fieldset>
  			<legend style="text-align: right;">COMS Content Management System</legend>
  		</fieldset>
  		</div>
  	</div>
  </div>