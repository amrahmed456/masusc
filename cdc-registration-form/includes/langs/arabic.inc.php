<?php

	function lang( $word ){
		
		static $langArray = [
			'home' 	=> 'الرئيسية',
			'login'	=> 'تسجيل الدخول'
		];
		
		return $langArray[$word];
	}
	
	
	
?>