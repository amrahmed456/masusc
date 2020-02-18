<?php
	if(isset($_GET['id'])){
		
		$ticket_id = $_GET['id'];
		$url = "../forms/cdc/chk.php?id=" . $ticket_id;
		header("Location: $url");
		
	}
?>