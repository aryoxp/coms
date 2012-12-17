<?php
// define that we're in Panada!
define('PANADA', true);

// define your panada application and system name
define('APPLICATION', dirname(__FILE__) . "/");
define('SYS', '../panadalite');

// Load bootstrap to start Panada, simple.
require_once SYS . '/' . 'gear.php';