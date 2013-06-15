<div class="container-fluid">
	<div class="row-fluid">
		<div class="span6 offset3">
		<div style="font-size: 1.5em; margin-bottom: 1em;">Woops! COMS Installation Fail.</em></div>
				
		<div class="well">
			<p>Some part of COMS installation were fails. We were fail in executing the following queries: </p>
			<ul>
				<?php foreach ($fails as $s) {
					echo '<li>'.$s.'</li>';
				}
				?>
			</ul>
			<p>You may want to check your COMS configuration in <code>coms/config.php</code> file or you may try again.</p>
			<a class="btn btn-warning" href="<?php echo $this->location('install'); ?>">Reinstall</a>
		</div>
		
		</div>
	</div>
</div>