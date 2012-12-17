<?php $this->view('header.php'); ?>
<?php $this->view('navbar.php'); ?>

<script>
	var tinymcejs = '<?php echo $this->assets('js/tiny_mce/tiny_mce.js'); ?>';
	var tinymcecss = '<?php echo $this->assets('css/tinymce-content.css'); ?>';
</script>

<div class="container-fluid">
    
    <form id="write-form" name="auth" method="post" action="<?php echo $this->location('news/post'); ?>" class="form-inline">
    <input type="hidden" name="id" id="id" value="<?php echo $post->id; ?>" />
    <input type="hidden" name="post_author_id" id="post-author-id" value="<?php echo $user->username; ?>" />
    <fieldset style="width:99%">
    	<legend>
        <a href="<?php echo $this->location('news'); ?>" class="btn btn-info pull-right"><i class="icon-list icon-white"></i> News List</a>
        <a href="<?php echo $this->location('news/write'); ?>" class="btn pull-right" style="margin:0px 5px"><i class="icon-pencil"></i> Write New News</a>
        
        Edit News
        </legend>    
        
    <div class="row-fluid">
    
        <div class="span8">
        
            <div class="control-group">
                <div class="hide" id="notification-container"></div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="post_title" >Title</label>
                <div class="controls">
                <input type="text" name="post_title" id="post_title" class="input-xlarge" value="<?php echo $post->post_title; ?>" placeholder="News Title" style="width:98%" /> 
                </div>
            </div><!-- /control-group -->
            

            <div class="control-group">
                <label class="control-label" for="post_title">Source URL</label>
                <div class="controls">
                <input type="text" name="post_url" id="post_url" class="input-xlarge" value="<?php echo $post->post_url; ?>" placeholder="News Source URL" 
                style="width:98%" />     
                </div>
            </div><!-- /control-group -->


            <div class="control-group">
				<div class="accordion-group">
                	<div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" href="#collapsePageURL">
                            <i class="icon-bookmark"></i> <strong>Page URL</strong>
                        </a>
                    </div>
                    <div id="collapsePageURL" class="accordion-body collapse">
                    	<div class="accordion-inner">
                        	<label for="password">Current page URL: </label>
                            <div class="controls">
	                        <input type="text" name="post_page" id="post_page" class="input-xlarge" value="<?php echo $post->post_page; ?>" placeholder="Page URL" style="width:80%" />
                            </div>
                            <div class="controls" style="margin-top:3px;">
                            <p><a href="#" id="btn-generate-pageurl" class="btn btn-primary">Generate Page URL</a><small> A post page URL will be this post pretty URL. Defaulting generated from post's title.</small></p>
                            </div>
                        </div>
                    </div>                    
                </div>                 
            </div><!-- /control-group -->
            
            <div class="control-group">
                               
                <ul class="nav nav-tabs" id="writeTab">
                  <li class="active"><a href="#tab-write" data-toggle="tab">Write Contents</a></li>
                  <li><a href="#tab-preview" data-toggle="tab" data-tabname="preview">Preview</a></li>
                  <li><a href="#tab-upload" data-toggle="tab">Upload</a></li>
                </ul>
                 
                <div class="tab-content">
                  <div class="tab-pane active" id="tab-write">
                    <div class="controls">
                    
                        <div id="wmd-editor" class="wmd-panel">
                            <div id="wmd-button-bar"></div>
                            <textarea name="post_content" class="tinymce input-xxlarge" id="wmd-input" style="height:300px;" ><?php echo $post->post_content; ?></textarea>    
                        </div>
        
                    </div>                  
                  </div><!--/tab-write-->
                  <div class="tab-pane" id="tab-preview">
	                  <div id="wmd-preview" style="height:300px; overflow-y:auto;"></div>
                  </div>
                  <div class="tab-pane" id="tab-upload">
	                  <?php $this->view('upload-frame.php'); ?>
                  </div>
                </div>
                
            </div><!-- /control-group -->
                    
        </div><!-- /span8 -->    
    
        <div class="span4">
            
            <div class="control-group">

              	<div class="accordion-group">
                	<div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" href="#collapseDateTime">
                            <i class="icon-time"></i> <strong>Date and Time</strong>
                        </a>
                    </div>
                    <div id="collapseDateTime" class="accordion-body collapse">
                    	<div class="accordion-inner">
                            <div class="control-group">
                                <div class="controls">
                                <div style="margin-right:10px;">
                                <label>Date
                                    <input type="text" name="post_date" size="12" value="<?php echo $post->post_date; ?>" id="date-time" />
                                </label>
                                </div>
                                <div>
                                <label>Time
                                    <input type="text" name="post_time" size="12" value="<?php echo $post->post_time; ?>" />
                                </label>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div><!-- /accordion-group -->        
                        
            </div><!-- /control-group -->
    
        </div><!-- /span4 -->
               
    </div><!-- /row-fluid -->

    	<div class="row-fluid">
            <div class="span12">
                <div class="form-actions">
                    <a class="btn btn-danger pull-right" id="btn-discard">
                    <i class="icon-minus icon-white"></i> Discard</a>            
					<a href="<?php echo $this->location('news'); ?>" class="btn btn-info pull-right" style="margin-right:5px">
                    <i class="icon-list icon-white"></i> News List</a>                            
                    <a href="<?php echo $this->location('news/write'); ?>" class="btn pull-right" style="margin-right:5px;"><i class="icon-pencil"></i> Write New News</a>
                    <button class="btn btn-primary" data-loading-text="Publishing..." id="btn-publish">Save and Publish</button>
                    <button class="btn" data-loading-text="Saving..." id="btn-draft">Save as Draft</button>
                </div>    
            </div>
    	</div>
        <div class="row-fluid">
        	<div class="span12" id="save-status">
            News status: 
			<?php 
				if($post->post_status == 'published')
					echo '<span class="label label-success">Published</span>';
				else echo '<span class="label label-warning">Draft</span>';
			?>
            </div>
        </div>
        </fieldset>            
    </form>
    
    </div><!-- /container -->

<?php $this->view('footer.php'); ?>