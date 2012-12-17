<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $this->page_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="cache-control" content="no-cache">
    
    <!-- Le styles -->

    <style>
		body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		}
    </style>
    <link href="<?php echo $this->asset("bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo $this->asset("bootstrap/css/bootstrap-responsive.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo $this->asset("css/base.css"); ?>" rel="stylesheet">
    <?php $styles = $this->get_styles(); if(is_array( $styles )) : 
		foreach($styles as $s) : 
	?><link href="<?php echo $this->asset($s); ?>" rel="stylesheet">
	<?php endforeach; endif; ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
	
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    
    <!-- Le base URL helper for javascript -->
    <script type="text/javascript">
		var base_url = '<?php echo $this->location(); ?>';
		var web_base_url = '<?php echo $this->config->web_base_url; ?>';
		var base_path = '<?php echo addslashes(getcwd()); ?>';
    </script>
    
  </head>

  <body>