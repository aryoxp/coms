<?php $this->view('header.php'); ?>
<?php $this->view('navbar.php'); ?>

<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Converter.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Sanitizer.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Editor.js'); ?>"></script>

<div class="container-fluid">

<fieldset>
	<legend><a href="<?php echo $this->location('content/write'); ?>" class="btn btn-primary pull-right">
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
    <table class="table table-striped">
    	<thead>
        	
            <th>Modified</th>
            <th>Identifier</th>
            <th>Title</th>
            <th width="30%">Contents Preview</th>
            
            <th>&nbsp;</th>
        </thead>
    <?php
		foreach($posts as $post) {
		?>
        <tr id="post-<?php echo $post->id; ?>" data-id="<?php echo $post->id; ?>">
        	<td><p><?php echo $post->content_modified; ?></p></td>
            <td><code><?php echo $post->content_page; ?></code></td>            
            <td><p><?php echo $post->content_title; ?> <small><?php echo (@$post->content_subtitle)?$post->content_subtitle:'&nbsp;'; ?></small> <br />
            <?php if($post->content_status == 'published') 
				echo '<span class="label label-success">Published</span>'; 
				else echo '<span class="label label-warning">Draft</span>';
				?>
            <td><?php echo $post->content_content; ?></td>
            <td style="min-width:157px;"><p>
	            <a class="btn btn-danger pull-right btn-delete-post" style="margin-left:5px;"><i class="icon-remove icon-white"></i> Delete</a>
            	<a class="btn btn-warning pull-right btn-edit-post" href="<?php echo $this->location('content/edit/'.$post->id); ?>"><i class="icon-pencil icon-white"></i> Edit</a>
                </p>
            </td>
        </tr>
        <?php	
		}
	?>
	</table>
    <?php else: ?>
    <div class="span3" align="center" style="margin-top:20px;">
	    <div class="well">Sorry, no content to show</div>
    </div>
    <?php endif; ?>
    
</fieldset>

</div>

<?php $this->view('footer.php'); ?>