<?php
	
	if(isset($_POST['name'])){
		$name 		= $_POST['name'];
		$faculty 	= $_POST['faculty'];
		$grade 		= $_POST['grade'];
		$university = $_POST['university'];
		$email 		= $_POST['email'];
		$phone 		= $_POST['phone'];
		$face 		= $_POST['face'];
		$ticket 	= $_POST['ticket'];
		$comment 	= $_POST['comment'] . ' [ Offline Registration ] ';
		
		require_once 'db_connection.php';
		require_once 'includes/funcs/functions.inc.php';
		$count = countItems("cdc" , "ticket_id" , " WHERE ticket_id = '$ticket'");
		
		if($count > 0){
			echo '<div class="alert alert-danger lead">Ticked Number ( ' . $ticket  . ' ) is already Recorded</div>';
		}else{
			$stmt = $db->prepare("INSERT INTO cdc ( ticket_id , name , faculty , grade , university , email , phone , facebook , date ,comments , status) VALUES ( ?,?,?,?,?,?,?,? , NOW(), ? , '1' )");
			$stmt->execute(array($ticket , $name , $faculty , $grade , $university , $email , $phone , $face , $comment));
					
			if($stmt->rowCount() > 0){
					echo 'success';
			}
		}
		
	
	
	}else{
		echo 'error';
	}
	
?>