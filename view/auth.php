<?php $this->view("header-bare.php"); ?>

<div class="container">

	<div class="span4">

		<form id="logon-form" name="auth" method="post" action="<?php echo $this->location("auth/logon/"); ?>">

			<fieldset>
				<legend>COMS Authentication</legend>

				<div class="control-group">
					<div class="hide" id="notification-container"></div>
				</div>

				<div class="control-group">
					<label class="control-label" for="username" >Username</label>
					<div class="controls">
						<input type="text" name="username" id="username" value="" placeholder="Username" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="password">Password</label>
					<div class="controls">
						<input type="password" name="password" id="password" value="" placeholder="Password" />
					</div>
				</div>

				<div class="form-actions">
					<button type="submit" data-theme="a" class="btn btn-primary">OK</button>
				</div>

			</fieldset>

		</form>

	</div><!-- /span6 -->

</div><!-- /container -->

<?php $this->view("footer-bare.php"); ?>