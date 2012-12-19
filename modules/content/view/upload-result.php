<?php $this->view('header.php'); ?>
<?php
function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}
?>
    	<div class="container" style="margin-top:1em;">
        	<div class="row">
            	<div class="span12">
                	
                        <?php if(count($_FILES)) : ?>
                        <div class="alert alert-info">
						<?php	
							for($i=0; $i < count($_FILES['files']['name']); $i++) : 
							$files = $_FILES['files'];
							chdir('../files/');
							@mkdir(date('Y'));
							@mkdir(date('Y/m'));
							if($files['tmp_name'][$i] != "") {
								$newfilename = preg_replace('/[^a-z0-9.]/i', '-', strtolower($files['name'][$i]));
								$newfilename = preg_replace('/-+/i', '-', $newfilename);
								$newfilename = preg_replace('/(^-)|(-$)/i', '', $newfilename);
								//echo $newfilename;
								move_uploaded_file($files['tmp_name'][$i], date('Y/m/').$newfilename);
							}
						?>
                        <p>
                        <?php echo $files['name'][$i]; ?> &mdash; <code><?php echo $files['type'][$i].' '.human_filesize($files['size'][$i], 2); ?></code> &mdash;
                        <?php 
							if($files['tmp_name'][$i] == "") 
								echo '<span class="label label-important">Error</span>'; 
							else echo '<span class="label label-success">OK</span> &mdash; <a href="'.$this->location('../files/'.date('Y/m/').$newfilename).'">Link</a>'; 
						?>
                        </p>
                        <?php endfor; ?>
                        </div>
						<?php else: ?>
                        <div class="alert alert-error">
                        <p><strong>Error: </strong>Uploaded file(s) exceeding filesize limits</p>
                        </div>
						<?php endif; ?>

                    <a href="<?php echo $this->location('file/uploadform'); ?>" class="btn btn-primary">Upload Again &rsaquo;</a>
                    <!--
                	<pre><?php var_dump($_FILES); ?></pre>
                    -->
        		</div>
        	</div>
        </div>
<?php $this->view('footer-blank.php'); ?>