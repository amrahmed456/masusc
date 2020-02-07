<?php
	if(isset($_POST['id'])){
		require_once 'db_connection.php';
		$id 		= $_POST['id'];
		$comment 	= $_POST['comment'];
		
		$stmt = $db->prepare("UPDATE cdc SET comments = ? WHERE id = ?");
		$stmt->execute(array($comment,$id));
		
	}
?>