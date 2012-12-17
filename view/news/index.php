<?php $this->view('header.php'); ?>
<?php $this->view('navbar.php'); ?>

<div class="container-fluid">

<fieldset>
	<legend><a href="<?php echo $this->location('news/write'); ?>" class="btn btn-primary pull-right">
    <i class="icon-pencil icon-white"></i>
    
    New News</a> News List
    <?php if($by != 'all') : 
	switch($by) {
		case 'cat': echo '<small> / Category:<strong>' . $keyword . '</strong></small>'; 
			break;
		case 'tag': echo '<small> / Tag:<strong>' . $keyword . '</strong></small>'; 
			break;
			
	}
	endif; ?>    
    </legend>    
    
    <?php if( isset($news) ) : ?>
    <table class="table table-striped">
    	<thead>
        	<th>Date and Time</th>
            <th>Title</th>
            <th>Contents Preview</th>
            <th>&nbsp;</th>
        </thead>
    <?php
		foreach($news as $post) {
		?>
        <tr id="post-<?php echo $post->id; ?>" data-id="<?php echo $post->id; ?>">
        	<td><p><?php echo $post->post_date; ?><br /><small>Modified: <?php echo $post->post_modified; ?></small></p></td>
            <td style="width:30%"><p><?php echo $post->post_title; ?><br />
            <?php if($post->post_status == 'published') 
				echo '<span class="label label-success">Published</span>'; 
				else echo '<span class="label label-warning">Draft</span>';
				?>
            <span class="label label-info"><?php echo $post->hits; ?> hits</span></p></td>
            <td style="width:30%"><?php echo strip_tags($post->post_content); ?></td>
            <td style="min-width:157px;"><p>
	            <a class="btn btn-danger pull-right btn-delete-post" style="margin-left:5px;"><i class="icon-remove icon-white"></i> Delete</a>
            	<a class="btn btn-warning pull-right btn-edit-post" href="<?php echo $this->location('news/edit/'.$post->id); ?>"><i class="icon-pencil icon-white"></i> Edit</a>
                </p>
            </td>
        </tr>
        <?php	
		}
	?>
	</table>
    <?php else: ?>
    <div class="span3" align="center" style="margin-top:20px;">
	    <div class="well">Sorry, no news to show</div>
    </div>
    <?php endif; ?>
    
</fieldset>

</div>

<?php $this->view('footer.php'); ?>