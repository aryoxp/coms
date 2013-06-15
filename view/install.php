<div class="container-fluid">
	<div class="row-fluid">
		<div class="span6 offset3">
		<div style="font-size: 1.5em; margin-bottom: 1em;"><h1 style="display: inline; font-weight: normal;">Welcome</h1> <em>to COMS Installation</em></div>
				
		<form class="form-vertical well" action="<?php echo $this->location('install/doinstall'); ?>" method="post">
			<p class="box">This step will guide you through the COMS installation process.<br>Any existing COMS configuration and data (but not custom modules data) will be reset.</p>
			<p>By pressing Install Now button below you are going to install COMS directly to the configured database in <code>config.php</code>.</p>
			<p>COMS will be installed to the <code><?php echo ($this->config->db->default->database); ?></code> database.</p>
		    <button type="submit" class="btn btn-large btn-info">Install Now</button>
		</form>
		
		</div>
	</div>
</div>