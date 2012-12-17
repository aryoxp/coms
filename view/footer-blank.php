 
	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo $this->asset("js/jquery-1.7.1.min.js"); ?>"></script>
	<script src="<?php echo $this->asset("bootstrap/js/bootstrap.min.js"); ?>"></script>
	<?php $scripts = $this->get_scripts(); 
	foreach( $scripts as $s) : ?><script src="<?php echo $this->asset($s); ?>"></script>
	<?php endforeach; ?>
    </body>
</html>