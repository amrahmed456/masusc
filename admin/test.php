<?php
	$file = file_get_contents(__DIR__ . '/blog-email.html');
	$file = str_replace('[[title]]' , 'Good' , $file);
	$file = str_replace('[[image]]' , 'image' , $file);
	$file = str_replace('[[description ]]' , 'my desc' , $file);
	$file = str_replace('[[id ]]' , 'id' , $file);
	
?>