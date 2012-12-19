<?php $this->head(); ?>

<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Converter.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Sanitizer.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Editor.js'); ?>"></script>

<div class="container-fluid">
    
    <form id="write-form" name="auth" method="post" action="<?php echo $this->location('module/content/home/post'); ?>" class="form-inline">
    <input type="hidden" name="id" id="id" value="" />
    <input type="hidden" name="content_author_id" id="content-author-id" value="<?php echo $user->username; ?>" />
    <fieldset style="width:99%">
    	<legend>
    		Write New Content
        	<a href="<?php echo $this->location('module/content'); ?>" class="btn pull-right"><i class="icon-list"></i> Contents List</a>
        </legend>    
        
    <div class="row-fluid">
    
        <div class="span12">
        
            <div class="control-group">
                <div class="hide" id="notification-container"></div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="content_title">Content Identifier</label>
                <div class="controls">
                <input type="text" name="content_page" id="content_page" class="input-xlarge" value="" placeholder="This value will be used as content identifier" style="width:98%" />     
                </div>
            </div><!-- /control-group -->            
            
            <div class="control-group">
                <label class="control-label" for="content_title">Title</label>
                <div class="controls">
                <input type="text" name="content_title" id="content_title" class="input-xlarge" value="" placeholder="Content Title" style="width:98%" />     
                </div>
            </div><!-- /control-group -->
            
            <div class="control-group">
                
                <ul class="nav nav-tabs" id="writeTab">
                  <li class="active"><a href="#tab-write">Write Contents</a></li>
                  <li><a href="#tab-upload">Upload</a></li>
                </ul>
                 
                <div class="tab-content">
                  <div class="tab-pane active" id="tab-write">
                    <div class="controls">
                    
	                    <textarea name="content_content" class="tinymce" id="tinymce" style="height:300px;" ></textarea>
                    </div>                  
                  </div><!--/tab-write-->
                  <div class="tab-pane" id="tab-upload">
                  	  <?php $this->view('upload-frame.php'); ?>
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
                                    <input type="text" name="content_date" size="12" value="<?php echo date('d/m/Y'); ?>" id="date-time" />
                                </label>
                                </div>
                                <div>
                                <label>Time
                                    <input type="text" name="content_time" size="12" value="<?php echo date('H:i:s'); ?>" />
                                </label>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div><!-- /accordion-group -->        
                                                    
            </div><!-- /control-group -->
    
        </div><!-- /span8 -->
               
    </div><!-- /row-fluid -->

    	<div class="row-fluid">
        <div class="span12">
        <div class="form-actions">
            <button class="btn btn-danger pull-right">Discard</button>
            <button class="btn btn-primary" data-loading-text="Publishing..." id="btn-publish">Save and Publish</button>
            <button class="btn" data-loading-text="Saving..." id="btn-draft">Save as Draft</button>
            <span id="save-status"></span>
        </div>    
        </div>
    	</div>
    
        </fieldset>            
    </form>
        
    </div><!-- /container -->

<?php $this->foot(); ?>