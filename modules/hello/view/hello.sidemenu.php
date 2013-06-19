<li class="dropdown-submenu">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-th"></i> Hello
  </a>
	<ul class="dropdown-menu pull-right">
      <li><a href="<?php echo $this->location($module_url); ?>"><i class="icon-list"></i> Module Index</a></li>
      <li><a href="<?php echo $this->location($module_url."home"); ?>">
      <i class="icon-list"></i> Index Example</a></li>
      <li><a href="<?php echo $this->location($module_url."home/path"); ?>">
      <i class="icon-list"></i> Path Example</a></li>
  </ul>
</li>