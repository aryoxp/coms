<?php $this->head(); ?>
<div class="container-fluid">

<fieldset>
	<legend> Contact Form Message List</legend>    
    
    <?php if( isset($messages) ) : ?>
    <table class="table table-striped">
    	<thead>
        	<th>From</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Message Preview</th>
        </thead>
    <?php
		foreach($messages as $message) {
		?>
        <tr id="message-<?php echo $message->id; ?>" data-id="<?php echo $message->id; ?>">
        	<td><p><?php echo $message->name; ?> <small><?php echo $message->email; ?></small></p></td>
            <td style="width:30%"><p><?php echo $message->address; ?></p></td>
            <td style="width:30%"><p><?php echo $message->phone; ?></p></td>
            <td style="width:30%"><?php echo preg_replace('/(\\\r)?\\\n/i', '<br>', strip_tags($message->message)); ?></td>
            <td style="min-width:157px;"><p>
	            <a class="btn btn-danger pull-right btn-delete-post" style="margin-left:5px;"><i class="icon-remove icon-white"></i> Delete</a>
            	<a class="btn btn-warning pull-right btn-edit-post" href="<?php echo $this->location('contacts/read/'.$message->id); ?>"><i class="icon-search icon-white"></i> Read</a>
                </p>
            </td>
        </tr>
        <?php	
		}
	?>
	</table>
    <?php else: ?>
    <div class="row-fluid">
        <div class="span12" align="center" style="margin-top:20px;">
            <div class="well">Sorry, no contact messages to show. There is nothing in contact message database.</div>
        </div>
    </div>
    <?php endif; ?>
    
</fieldset>

</div>

<?php $this->foot(); ?>