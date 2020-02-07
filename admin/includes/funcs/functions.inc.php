<?php

	// getting title of each page that has a variable $pageTitle
	function getTitle(){
		global $pageTitle;
		
		if(isset($pageTitle)){
			echo $pageTitle;
			
		}else{
			echo lang('DefaultPageTitle');
		}
	}
	
	// redirect function
	/*
		== accepts direct to url , leave blank to redirect to previous page
		== message to show
		== seconds before redirect
	*/
	function redirect($to , $mssg , $seconds = 5 ){
		
		
		if( $to == null || $to == '' ){
			
			if( isset($_SERVER['HTTP_REFERER']) ){
				$to = $_SERVER['HTTP_REFERER'];
				
			}else{
				$to = 'index.php';
			}
		}
		
		echo $mssg;
		echo '<div class="alert alert-info text-center"> You will be redirected after ( ' . $seconds . ' ) seconds...</div>';
		
		header("refresh:$seconds;url=$to");
		
	}
	
	
	/*
		// check if a specific item is already in the database
		== checkitem($tableName , $colName , $val)
	*/
	function checkItem($tableName , $colName , $val){
		global $db;
		
		$statment = $db->prepare("SELECT $colName FROM $tableName WHERE $colName = ?");
		$statment->execute(array($val));
		
		$checkCount = $statment->rowCount();
		return $checkCount;
		
	}
	
	/*
		// count items in table
		== accepts [ tableName , colName ]
	*/
	
	function countItems($tableName , $colName , $moreParam){
		
		if($moreParam == null || $moreParam == ''){
			$moreParam = '';
		}
		
		global $db;
		$st = $db->prepare("SELECT COUNT($colName) AS count FROM $tableName $moreParam");
		$st->execute();
		return $st->fetchColumn();
	}
	
	/* get latest items 
		// getLatestItems [ tableName , colName , extOpt , orderBy , LIMIT ]
	*/
	function getLatestItems($tableName , $colName ,$extOpt , $orderBy , $limit){
		global $db;
		$stmt = $db->prepare("SELECT $colName FROM $tableName $extOpt ORDER BY $orderBy DESC LIMIT $limit");
		$stmt->execute();
		$rows = $stmt->fetchAll();
		return $rows;
	}
?>