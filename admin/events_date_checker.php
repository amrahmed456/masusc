<?php
	$current_date = date("Y-m-d");
	require_once 'db_connection.php';
	$stmt = $db->prepare("SELECT id,date,end_date FROM events");
	$stmt->execute();
	if($stmt->rowCount() > 0){
		$rows = $stmt->fetchAll();
		foreach($rows as $row){
			extract($row);
			
			if($current_date >= $date && $current_date <= $end_date){
				// running now event
				$status = '2';
				$up = $db->prepare("UPDATE events SET status = ? WHERE id = ?");
				$up->execute(array($status , $id));
				
			}else if($current_date < $date && $current_date < $end_date){
				// upcoming event
				$status = '0';
				$up = $db->prepare("UPDATE events SET status = ? WHERE id = ?");
				$up->execute(array($status , $id));
			}else if($current_date > $end_date && $current_date > $date){
				// passed event
				$status = '1';
				$up = $db->prepare("UPDATE events SET status = ? WHERE id = ?");
				$up->execute(array($status , $id));
			}
			
			
		}
	}
?>