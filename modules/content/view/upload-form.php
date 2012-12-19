<?php $this->view('header.php'); ?>
    	<div class="container" style="margin-top:1em;">
        	<div class="row">
            	<div class="span12">
                <form action="<?php echo $this->location('file/upload'); ?>" method="post" enctype="multipart/form-data">
				<fieldset>
                    <input type="file" name="files[]"><br>
                    <input type="file" name="files[]"><br>
                    <p class="pull-right">Maximum total filesize of uploaded file(s): <span class="badge badge-info"><?php echo ini_get('upload_max_filesize'); ?>B</span></p>
                    <input type="submit" class="btn btn-primary btn-large" value="Upload">
                </fieldset>    
                </form>
        		</div>
        	</div>
        </div>
<?php $this->view('footer-blank.php'); ?>