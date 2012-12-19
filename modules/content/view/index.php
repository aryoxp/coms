<?php $this->head(); ?>

<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Converter.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Sanitizer.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Editor.js'); ?>"></script>

<!--<div class="container-fluid" style="border: 1px solid red;">-->

<fieldset>
	<legend><a href="<?php echo $this->location('module/content/home/write'); ?>" class="btn btn-primary pull-right">
    <i class="icon-pencil icon-white"></i>
    
    New Content</a> Content List
    <?php if($by != 'all') : 
	switch($by) {
		case 'cat': echo '<small> / Category:<strong>' . $keyword . '</strong></small>'; 
			break;
		case 'tag': echo '<small> / Tag:<strong>' . $keyword . '</strong></small>'; 
			break;
			
	}
	endif; ?>    
    </legend>
    
    <?php if( isset($posts) ) : ?>
    <table class="table" style="width: 100%;">
    	<thead>
        	<tr>
            <th>Modified</th>
            <th>Content</th>
            <th>&nbsp;</th>
            </tr>
        </thead>
    <?php if(true) : foreach($posts as $post) { ?>
        <tr id="post-<?php echo $post->id; ?>" data-id="<?php echo $post->id; ?>">
        	<td><p><small><?php echo $post->content_modified; ?></small></p></td>
            <td>            
            <strong><?php echo $post->content_title; ?></strong>
            	<small><?php echo (@$post->content_subtitle)?$post->content_subtitle:'&nbsp;'; ?></small> 
            	<code><?php echo $post->content_page; ?></code>
            <?php if($post->content_status == 'published') 
				echo '<span class="label label-success">Published</span>'; 
				else echo '<span class="label label-warning">Draft</span>';
				?>
			<br>
			<small><?php echo strip_tags($post->content_content) . "..."; ?></small></td>
            <td style="min-width: 80px;">
            
				<ul class="nav nav-pills" style="margin:0;">
				<li class="dropdown">
				  <a class="dropdown-toggle" id="drop4" role="button" data-toggle="dropdown" href="#">Action <b class="caret"></b></a>
				  <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
				    <li>
				    <a class="btn-edit-post" href="<?php echo $this->location('module/content/home/edit/'.$post->id); ?>"><i class="icon-pencil"></i> Edit</a>	
				    </li>
				    <li>
					<a class="btn-delete-post"><i class="icon-remove"></i> Delete</a>
				    </li>
				  </ul>
				</li>
				</ul>            
            
            
            <p>
	            
            	
                </p>
            </td>
        </tr>
        <?php	
		} endif;
	?>
	</table>
    <?php else: ?>
    <div class="span3" align="center" style="margin-top:20px;">
	    <div class="well">Sorry, no content to show</div>
    </div>
    <?php endif; ?>
    
</fieldset>

<!--</div>-->

<?php $this->foot(); ?>