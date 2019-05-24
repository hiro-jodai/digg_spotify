<?php
return array(
	'_root_'  => 'index/index',  // The default route
	'_404_'   => 'error/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	'start' => array('index/start', 'name' => 'start'),
	'playlist' => array('playlist/index', 'name' => 'playlist'),
);
