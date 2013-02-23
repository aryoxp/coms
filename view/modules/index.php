<?php $this->head(); ?>
<div class="container-fluid">

<fieldset>
	<legend> Modules </legend>    
    
    <?php if( isset($modules) ) : ?>
    
    <table class="table table-striped">
    	<thead>
        	<th>Identifier</th>
            <th>Description</th>
            <th>Version</th>
            <th>Status</th>
            <th>Operation</th>
        </thead>
        
    <?php 
    $modname = array();
    if(!isset($active_modules) or !is_array($active_modules))
    	$active_modules = array();
    foreach($modules as $mod) { 
    	$modname[] = $mod->id;
    ?>
    
        <tr id="module-<?php echo $mod->id; ?>" 
        	data-id="<?php echo $mod->id; ?>">
        	<td><code><?php echo $mod->id; ?></code></td>
            <td><strong><?php echo $mod->name; ?></strong><br><?php echo $mod->description; ?>
            <em>Author:</em> <?php echo $mod->author; ?>
            </td>
            <td><?php echo $mod->version; ?>. Build <?php echo $mod->version_index; ?></td>
            <td style="width: 80px;"><?php echo in_array($mod->id, $active_modules) ? 
            	'<div class="label label-success" id="status-'.$mod->id.'">Active</a>' : 
            	'<div class="label" id="status-'.$mod->id.'">Inactive</a>'; ?></td>
            <td>
            
				<ul class="nav nav-pills" style="margin:0;">
				<li class="dropdown">
				  <a class="dropdown-toggle" id="drop4" role="button" data-toggle="dropdown" href="#">Action <b class="caret"></b></a>
				  <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
				    <li>
				    <a class="btn-toggle-status" data-loading-text="Toggling..." href="#"><i class="icon-refresh"></i> Toggle Status</a>	
				    </li>
				    <li class="divider"></li>
				    <li>
					<a class="btn-uninstall" href="#">
					  <i class="icon-remove"></i> Uninstall
					</a>
				    </li>
				  </ul>
				</li>
				</ul>            
            
            </td>
        </tr>
        <?php	
		}
	?>
	</table>
	
    <?php else: ?>
    
    <div class="row-fluid">
        <div class="span12" align="center" style="margin-top:20px;">
            <div class="well">Sorry, no modules to show. There are nothing in modules directory.</div>
        </div>
    </div>
    
    <?php endif; ?>
    
    <div class="well">Active Modules: 
    <?php 
    if(!count($active_modules)) echo 'No module loaded.';
    foreach ($active_modules as $amod) {
    	if(!in_array($amod, $modname))
    	echo '<div class="label label-warning" data-modname="'.$amod.'" style="cursor:pointer">'.$amod.'</div> '; 
    	else
		echo '<div class="label label-info">'.$amod.'</div> ';    	
    }
    ?>
    </div>
    
</fieldset>

</div>

<?php $this->foot(); ?>