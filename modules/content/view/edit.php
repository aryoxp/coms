<?php $this->head(); ?>

<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Converter.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Sanitizer.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Editor.js'); ?>"></script>

<div class="container-fluid">
    
    <form id="write-form" name="auth" method="post" action="<?php echo $this->location('module/content/home/post'); ?>" class="form-inline">
    <input type="hidden" name="id" id="id" value="<?php echo $content->id; ?>" />
    <input type="hidden" name="content_author_id" id="content-author-id" value="<?php echo $user->username; ?>" />
    <fieldset style="width:99%">
    	<legend>
        <a href="<?php echo $this->location('module/content'); ?>" class="btn btn-info pull-right"><i class="icon-list icon-white"></i> Content List</a>
        <a href="<?php echo $this->location('module/content/home/write'); ?>" class="btn pull-right" style="margin:0px 5px"><i class="icon-pencil"></i> Write New Content</a>
        
        Edit Content
        </legend>    
        
    <div class="row-fluid">
    
        <div class="span12">
        
            <div class="control-group">
                <div class="hide" id="notification-container"></div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="content_subtitle" >Content Identifier</label>
                <div class="controls">
                <input type="text" name="content_page" id="content_page" class="input-xlarge" value="<?php echo $content->content_page; ?>" placeholder="Content Identifier" style="width:98%" />     
                </div>
            </div><!-- /control-group -->                
            
            <div class="control-group">
                <label class="control-label" for="content_title" >Title</label>
                <div class="controls">
                <input type="text" name="content_title" id="content_title" class="input-xlarge" value="<?php echo $content->content_title; ?>" placeholder="Content Title" style="width:98%" /> 
                </div>
            </div><!-- /control-group -->
            
            <div class="control-group">
                               
                <ul class="nav nav-tabs" id="writeTab">
                  <li class="active"><a href="#tab-write" data-toggle="tab">Write Contents</a></li>
                  <li><a href="#tab-preview" data-toggle="tab" data-tabname="preview">Preview</a></li>
                  <li><a href="#tab-upload" data-toggle="tab">Upload</a></li>
                  <li><a href="#tab-file" data-toggle="tab">Files</a></li>
                </ul>
                 
                <div class="tab-content">
                  <div class="tab-pane active" id="tab-write">
                    <div class="controls">
                    
                        <textarea name="content_content" class="tinymce" id="tinymce" style="height:300px;" ><?php echo $content->content_content; ?></textarea>
                    </div>                  
                  </div><!--/tab-write-->
                  <div class="tab-pane" id="tab-preview">
	                  <div id="wmd-preview" style="height:300px; overflow-y:auto;"></div>
                  </div>
                  <div class="tab-pane" id="tab-upload">

						<?php $this->view('upload-frame.php'); ?>
                      
                  </div>
                  <div class="tab-pane" id="tab-file">
                  		<div id="file-tree" style="width:80%; height:200px; overflow:auto; margin:1em auto; padding:1em; border:1px solid #CCC; border-radius:5px;"></div>
                        <div><strong>File URL:</strong></div>
                        <div class="well"><code><span id="path-url"></span></code></div>
                  </div>
                </div>
                
            </div><!-- /control-group -->                
            
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
                                    <input type="text" name="content_date" size="12" value="<?php echo $content->content_date; ?>" id="date-time" />
                                </label>
                                </div>
                                <div>
                                <label>Time
                                    <input type="text" name="content_time" size="12" value="<?php echo $content->content_time; ?>" />
                                </label>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div><!-- /accordion-group -->
                        
            </div><!-- /control-group -->
    
        </div><!-- /span12 -->
               
    </div><!-- /row-fluid -->

    	<div class="row-fluid">
            <div class="span12">
                <div class="form-actions">
                
                	<div class="btn-group pull-right">
                	  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                	    Action
                	    <span class="caret"></span>
                	  </a>
                	  <ul class="dropdown-menu">
                	  
                	    <li><a id="btn-discard"><i class="icon-minus"></i> Discard</a></li>
                	    <li><a href="<?php echo $this->location('module/content'); ?>"><i class="icon-list"></i> Back to Content List</a></li>
                	    <li><a href="<?php echo $this->location('module/content/home/write'); ?>"><i class="icon-pencil"></i> Write New Content</a></li>
                	    
                	  </ul>
                	</div>
                
                    
                               
					                          
                    
                    
                    <button class="btn btn-primary" data-loading-text="Publishing..." id="btn-publish">Save and Publish</button>
                    <button class="btn btn-warning" data-loading-text="Saving..." id="btn-draft">Save as Draft</button>
                </div>    
            </div>
    	</div>
        <div class="row-fluid">
        	<div class="span12" id="save-status">
            Content status: 
			<?php 
				if($content->content_status == 'published')
					echo '<span class="label label-success">Published</span>';
				else echo '<span class="label label-warning">Draft</span>';
			?>
            </div>
        </div>
        </fieldset>            
    </form>
    
    </div><!-- /container -->

<script type="text/javascript" src="<?php echo $this->asset('pagedown/pagedown.js'); ?>"></script>

<?php $this->foot(); ?>