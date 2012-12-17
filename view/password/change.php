<?php $this->head(); ?>
<?php 
	$user = $this->session->get('user');
	//var_dump($user);
?>
<div class="container-fluid">
	<div class="row-fluid">
        <div class="span12">
        	<h2>Change Password <small>for COMS Content Management System</small></h2>
            <hr />
        </div>
        <div class="span6">
            <h3>Name: <span style="font-weight:normal"><?php echo $user->name; ?></span></h3>
            
            <div class="alert" style="box-shadow:0 2px 2px #CCC;margin-top:1em;">
              <button class="close" data-dismiss="alert">×</button>
              <strong>Warning!</strong> Passwords are <strong>cAsE SeNsiTiVe</strong>.
            </div>            
            
        	<form action="<?php echo $this->location('password/update'); ?>" method="post" id="change-password-form" style="margin-top:1em;" class="form-horizontal">
            	<fieldset>
                	<input type="hidden" name="username" value="<?php echo $user->username; ?>" />
                	<div class="well">
	                    <div class="control-group">
	                        <label class="control-label">Current Password:</label>
	                        <div class="controls">
	                        <input name="oldpassword" type="password" class="old-password"  />
	                        </div>
	                    </div>
					</div>
                    <div class="well">
	                    <div class="control-group">
	                        <label class="control-label">New Password:</label>
	                        <div class="controls">
	                        <input name="newpassword" type="password" class="new-password" />
	                        </div>
	                    </div>
	                    <div class="control-group">
	                        <label class="control-label">New Password (again):</label>
	                        <div class="controls">
	                        <input name="newpassword2" type="password" class="new-password2" />
	                        </div>
	                    </div>    
                    </div>
                    <div class="well">
                    <input type="submit" value="Change My Password" class="btn btn-primary btn-update" />
                    </div>
                </fieldset>
            </form>
		</div>
    </div>
</div>
<?php $this->foot(); ?>