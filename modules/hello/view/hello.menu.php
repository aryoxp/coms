<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-envelope"></i> Hello
  <b class="caret"></b>
  </a>
	<ul class="dropdown-menu">
      <li><a href="<?php echo $this->location($module_url); ?>"><i class="icon-list"></i> Hello List!</a></li>
      <li><a href="<?php echo $this->location($module_url."home/path/to/index"); ?>">
      <i class="icon-list"></i> Path to Index!</a></li>
  </ul>
</li>