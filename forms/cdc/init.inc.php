<?php

	// including connection to database file
	if(!isset($noDb)){ require_once 'db_connection.php'; }
	
	// Routes to included directory
	$tpls = 'includes/templates/'; // templates directory
	$css = 'layout/css/'; // css directory
	$js = 'layout/js/'; // js directory
		
	// functions directory
	$func = 'includes/funcs/';
	
	include $func 	. 'functions.inc.php';
	include $tpls 	. 'header.inc.php';
	
	
	

?>