<?php

	// english language
	
	function lang( $word ){
		
		static $langArray = [
			
			// page title and description
			'DefaultPageTitle'	=> 'Jsouq | Shopping community',
			
			// for admin dashboard
			'dashboard_home' 	=> 'DASHBOARD',
			'categories' 		=> 'Categories',
			'items' 			=> 'Items',
			'memebers' 			=> 'Members',
			'statistics' 		=> 'Statistics',
			'logs' 				=> 'Logs',
			'comments' 			=> 'Comments',
			'' 					=> '',
			'' 					=> ''
			
			
		];
		
		return $langArray[$word];
	}
	
	
	
?>