<?php //var_dump($db); ?>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span6 offset3">
		<div style="font-size: 1.5em; margin-bottom: 1em;"><h1 style="display: inline; font-weight: normal;">Welcome</h1> <em>to COMS Installation</em></div>
		<?php $ok = false; ?>
		<?php if($db) : $ok = true; ?>
		<div class="alert alert-success">
			<p>Great! COMS is able to connect to configured database named <code><?php echo $this->config->db->default->database; ?></code> that is configured in <code>config.php</code> properly. You may now continue to install COMS.</p>
		</div>
		<?php else: ?>
		<div class="alert alert-error">
			<p>Whoops! COMS is UNABLE to connect to configured database named <code><?php echo $this->config->db->default->database; ?></code> that is configured in <code>config.php</code>.</p>
			<?php if(!$connect): ?>
			<p>And COMS is UNABLE to connect to the database server too. It seems that you had to put the correct username and password in <code>config.php</code> to the default database configuration.</p>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php if($connect and !$db): ?>
		<p class="alert alert-success">But it seems that COMS are ABLE to connect to database server. You may need to create a database named <code><?php echo $this->config->db->default->database; ?></code> on your database server.</p>
		<?php endif; ?>
		<?php if($ok) : ?>
		<form class="form-vertical well" action="<?php echo $this->location('install/doinstall'); ?>" method="post">
			<p class="box">This step will guide you through the COMS installation process.<br>Any existing COMS configuration and data (but not custom modules data) will be reset.</p>
			<p>By pressing Install Now button below you are going to install COMS directly to the configured database in <code>config.php</code>.</p>
			<p>COMS will be installed to the <code><?php echo ($this->config->db->default->database); ?></code> database.</p>
		    <button type="submit" class="btn btn-large btn-info">Install Now</button>
		</form>
		<?php else: ?>
		
		<div class="alert">
			<p>Please correct the error(s) as stated above and <a href="<?php echo $this->location('install'); ?>">reload this page</a> again.</p> 
		</div>
		
		<?php endif; ?>
		</div>
	</div>
</div>
