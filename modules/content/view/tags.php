<?php $this->view('header.php'); ?>
<?php $this->view('navbar.php'); ?>
<div class="container-fluid">
	<div class="row-fluid">
        <div class="span12">
            <h2>Post Categories</h2>
            <hr />            
        </div>
    </div>
    
	<div class="row-fluid">
    	<div class="span6">
        	<?php if($categories && count($categories)) : ?>
            <table class="table">
            	<thead>
            	<tr>
                	<th>Name</th>
                    <th>Count</th>
                    <th style="max-width:150px; min-width:150px;">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
            <?php foreach($categories as $c) : ?>
				<tr data-name="<?php echo $c->tag; ?>">
				<td><?php echo $c->name; ?></td>
                <td><?php echo $c->count ?></td>
                <td style="text-align:right;">
                	<a href="<?php echo $this->location('posts/index/cat/' . $c->tag); ?>" class="btn">Show Posts</a>
                	<a href="<?php echo $this->location('posts/delcat'); ?>"
                    	class="btn btn-danger btn-delete-cat">Delete</a>
                </td>
                </tr>
            <?php endforeach; ?>
	            </tbody>
            </table>
            <?php else: ?>
            <div class="well">
            <p>Sorry, no categories. Go add one while writing new post or edit an existing one.</p>
            </div>
           
            <?php endif; ?>
        </div>

        <div class="span4 offset2">
        <h3>Add New Categories</h3>
        <hr />
        </div>
        
	</div>
    <hr />
    <div class="row-fluid">
    	<div class="span12">
		    <h2>Post Tags</h2>
    	</div>
	</div>
    <hr />
    <div class="row-fluid">
    	<div class="span6">
            <?php if($tags && count($tags)): ?>
            <table class="table">
            	<thead>
            	<tr>
                	<th>Name</th>
                    <th>Count</th>
                    <th style="max-width:150px; min-width:150px;">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                
            <?php foreach($tags as $t) : ?>
				<tr data-name="<?php echo $t->tag; ?>">
				<td><?php echo $t->name; ?></td>
                <td><?php echo $t->count ?></td>
                <td style="text-align:right;">
                	<a href="<?php echo $this->location('posts/index/tag/' . $t->tag); ?>" class="btn">Show Posts</a>
                	<a href="<?php echo $this->location('posts/deltag'); ?>"
                    	class="btn btn-danger btn-delete-tag">Delete</a>
                </td>
                </tr>
            <?php endforeach; ?>
	            </tbody>
            </table>
            <?php else: ?>
            <div class="well">
            <p>Sorry, no tags. Go add one while writing new post or edit an existing one.</p>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="span4 offset2">
        <h3>Add New Tags</h3>
        <hr />
        </div>
    </div>
</div>
<?php $this->view('footer.php'); ?>