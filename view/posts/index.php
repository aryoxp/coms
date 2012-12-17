<?php $this->view('header.php'); ?>
<?php $this->view('navbar.php'); ?>

<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Converter.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Sanitizer.js'); ?>"></script>
<script type="text/javascript" src="<?php echo $this->asset('pagedown/Markdown.Editor.js'); ?>"></script>

<?php $this->view('posts/markdown-help.php'); ?>

<div class="container-fluid">

<fieldset>
	<legend><a href="<?php echo $this->location('posts/write'); ?>" class="btn btn-primary pull-right">
    <i class="icon-pencil icon-white"></i>
    
    New Post</a> Post List
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
        	<th>Date and Time</th>
            <th>Title</th>
            <th width="30%">Contents Preview</th>
            <th>Comments</th>
            <th>&nbsp;</th>
        </thead>
    <?php
		foreach($posts as $post) {
		?>
        <tr id="post-<?php echo $post->id; ?>" data-id="<?php echo $post->id; ?>">
        	<td><p><?php echo $post->post_date; ?><br /><small>Modified: <?php echo $post->post_modified; ?></small></p></td>
            <td><p><?php echo $post->post_title; ?> <small><?php echo $post->post_subtitle; ?></small> <br />
            <?php if($post->post_status == 'published') 
				echo '<span class="label label-success">Published</span>'; 
				else echo '<span class="label label-warning">Draft</span>';
				?>
            <span class="label"><?php echo $post->comment_count; ?> comments</span>
            <span class="label label-info"><?php echo $post->hits; ?> hits</span></p></td>
            <td><?php echo $post->post_content; ?></td>
            <td>
            <?php switch($post->comment_status) { 
				case 'open':
					echo '<span class="label label-info">'.$post->comment_status.'</span>';
					break;
				case 'closed':
					echo '<span class="label label-warning">'.$post->comment_status.'</span>';
            } ?>
            </td>
            <td style="min-width:157px;"><p>
	            <a class="btn btn-danger pull-right btn-delete-post" style="margin-left:5px;"><i class="icon-remove icon-white"></i> Delete</a>
            	<a class="btn btn-warning pull-right btn-edit-post" href="<?php echo $this->location('posts/edit/'.$post->id); ?>"><i class="icon-pencil icon-white"></i> Edit</a>
                </p>
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

</div>

<?php $this->view('footer.php'); ?>