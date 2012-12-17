<?php $this->head(); ?>
<div class="container-fluid">
	<div class="row-fluid">
        <div class="span12">
        	<a href="<?php echo $this->location('contacts'); ?>" class="btn btn-primary pull-right"><i class="icon-list icon-white"></i> Message Index</a>
            <h2>Read Contact Message</h2>
            <hr />
        </div>
    </div>
    
	<div class="row-fluid">
    	<div class="span6">
        	<?php if( $message and is_object( $message )): ?>
            <div class="well">
            	<p><strong>Message From:</strong> <?php echo $message->name; ?> &mdash; <code><?php echo $message->email; ?></code></p>
                <p><strong>Address:</strong> <?php echo nl2br($message->address); ?></p>
                <p><strong>Phone:</strong> <?php echo $message->phone; ?></p>
                <p><strong>Message:</strong></p>
                <div class="message well" style="background-color:#fafafa;">
                	<div style="font-family:Menlo, Monaco, monospace;">
                	<?php echo preg_replace('/(\\\r)?\\\n/i','<br>',strip_tags($message->message)); ?>
                    </div>
                </div>
            </div>
            <?php else: ?>	
            <div class="well">Sorry, specified message could not be found</div>
            <?php endif; ?>
        </div>

        <div class="span4 offset2">
        &nbsp;
        </div>
        
	</div>
    <hr />
    <div class="row-fluid">
        <div class="span12">
        <div class="well">
        <a href="#" class="btn btn-danger pull-right btn-delete" data-id="<?php echo $message->id; ?>">
        	<i class="icon-trash icon-white"></i> Delete Message
        </a>
        <a href="<?php echo $this->location('contacts'); ?>" class="btn btn-primary" style="margin-right:5px;"><i class="icon-list icon-white"></i> Message Index</a>
        </div>
        </div>
    </div>
</div>
<?php $this->foot(); ?>