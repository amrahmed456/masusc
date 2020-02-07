<?php

	// including connection to database file
	include 'db_connection.php';
	
	// Routes to included directory
	$tpls = 'includes/templates/'; // templates directory
	$css = 'layout/css/'; // css directory
	$js = 'layout/js/'; // js directory
	
	// langues directory
	$langs = 'includes/langs/';
	
	// functions directory
	$func = 'includes/funcs/';
	
	// included files
	include $langs 	. 'english.inc.php';
	include $func 	. 'functions.inc.php';
	include $tpls 	. 'header.inc.php';
	// include navbar only in needed pages except for nonavbar variable
	if(!isset($noNavbar)){ include $tpls . 'navbar.inc.php'; }
	

?>