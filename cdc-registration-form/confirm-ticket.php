<?php
	
	if(isset($_GET['id'])){
		require_once 'db_connection.php';
		$id = $_GET['id'];
		$stmt = $db->prepare("UPDATE cdc SET status = '1' WHERE id = ?");
		$stmt->execute(array($id));
		header("Location: data.php?pass=AstonWyld-NextLevel");
	}

?>