<?php
	
	if(isset($_GET['id'])){
		require_once 'db_connection.php';
		$id = $_GET['id'];
		$stmt = $db->prepare("UPDATE cdc SET status = '2',ticket_id = ' ' WHERE id = ?");
		$stmt->execute(array($id));
		
		$stms = $db->prepare("SELECT tickets FROM tickets LIMIT 1");
		$stms->execute(array());
		$row = $stms->fetch();
		extract($row);
		$av = explode(" " , $tickets);
		array_push($av , $id);
		$av = implode(" " , $av);
		
		$up = $db->prepare("UPDATE tickets SET tickets = ?");
		$up->execute(array($av));
		
		header("Location: data.php?pass=AstonWyld-NextLevel");
	}

?>