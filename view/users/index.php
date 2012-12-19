<?php $this->head(); ?>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span8">
			<fieldset>
				<legend>User List</legend>
				<?php if( isset($users) ) : ?>
				<table class="table table-striped">
					<thead>
						<th>User</th>
						<th>Operation</th>
					</thead>
					<?php
					foreach($users as $user) {
						?>
						<tr id="user-<?php echo $user->id; ?>" data-id="<?php echo $user->id; ?>">
							<td>
							<?php echo $user->name; ?>
							<span class="badge badge-info">Level <?php echo $user->level; ?></span>
							<?php 
							switch($user->status) { 
								case 1:
								echo '<span class="label label-success">Active</span>';
								break;
								case 0:
								echo '<span class="label label-warning">Suspended</span>';
							} 
							?>
							<p>
							<code><?php echo $user->username; ?></code>
							<?php if( $user->email ) echo '<i class="icon-envelope"></i> <small>'.$user->email.'</small>'; ?>
							</p>
							</td>
							<td style="min-width: 100px;">
							  <ul class="nav nav-pills" style="margin:0;">
							  <li class="dropdown">
				                <a class="dropdown-toggle" id="drop4" role="button" data-toggle="dropdown" href="#">Action <b class="caret"></b></a>
				                <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
				                  <?php if( $user->level > 1 ) : ?>
				                  <li>
				                  <a class="btn-toggle-status-user" data-uid="<?php echo $user->id; ?>" data-loading-text="Toggling..." href="#"><i class="icon-refresh"></i> Toggle Status</a>	
				                  </li>
				                  <li class="divider"></li>
				                  <?php endif; ?>
				                  <li>
									<a class="btn-edit-user" href="<?php echo $this->location('user/edit/'.$user->id); ?>">
										<i class="icon-pencil"></i> Edit
									</a> 
				                  </li>
				                  <li>
									<?php if( $user->level > 1 ) : ?>
									<a class="btn-delete-user" data-uid="<?php echo $user->id; ?>" href="#">
									  <i class="icon-remove"></i> Delete
									</a>
									<a class="btn-change-password"href="<?php echo $this->location('user/edit/'.$user->id."#password"); ?>">
										<i class="icon-lock"></i> Change Password
									</a> 
									<?php endif; ?>				                  
				                  </li>
				                </ul>
				              </li>
							  </ul>
						</td>
					</tr>
					<?php	
				}
				?>
			</table>
		<?php else: ?>
		<div class="span3" align="center" style="margin-top:20px;">
			<div class="well">Sorry, no posts to show</div>
		</div>
	<?php endif; ?>
	
</fieldset>
</div><!--/span6-->
<div class="span4">
	<?php //var_dump($user->level); ?>
	<fieldset>
		<legend>Create New User</legend>
		<div class="alert">
			<p>Your current privileges level is: Level <?php echo $this->authenticatedUser->level; ?>.
				<br />The <strong>highest privileges level is 1</strong>
				<br />The <strong>lowest privileges level is 10</strong>.</p>
			</div>
			<form action="<?php echo $this->location(); ?>" method="post" id="form-create-user" class="form-vertical">
			   <div class="well">
			   	    <div class="control-group">
					<label class="control-label">Username</label>
					<div class="controls">
					  <input type="text" name="username" required="required" id="input-username" />
					</div>
				    </div><!--/control-group-->
					<div class="control-group">
						<label class="control-label">Password</label>
						<div class="controls">
						<input type="password" name="password" id="input-password" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Password (Again)</label>
						<div class="controls">
						<input type="password" name="password2" id="input-password2" />
						</div>
				    </div><!--/control-group-->
				</div>
				<div class="well">
					<div class="control-group">
						<label class="control-label">Name</label>
						<div class="controls">
						<input type="text" name="name" required="required" id="input-name" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">E-mail</label>
						<div class="controls">
						<input type="text" name="email" id="input-email" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Privileges Level</label>
						<div class="controls">
							<select name="level" class="input-small">
							   <?php for($level = ((int)$this->authenticatedUser->level)+1; $level <= 10; $level++) { ?>
							   <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
							   <?php } ?>
						   </select>
						</div>
					</div>
				    <div class="control-group">
					    <label class="control-label">Status</label>
					    <div class="controls">
					    <label class="checkbox">
					    <input type="checkbox" value="1" checked="checked" name="status" /> Active</label>
					    </div>
				    </div>
			   </div>
				   <div class="well">
					   <input type="submit" value="Create User" class="btn btn-primary btn-create-user" />
				   </div>
			   </form>
		   </fieldset>
	   </div>
   </div><!--/row-->
</div><!--/container-->

<?php $this->foot(); ?>