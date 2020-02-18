<?php
	
	if(isset($_POST['name'])){
		$name 		= $_POST['name'];
		$faculty 	= $_POST['faculty'];
		$grade 		= $_POST['grade'];
		$university = $_POST['university'];
		$email 		= $_POST['email'];
		$phone 		= $_POST['phone'];
		$face 		= $_POST['face'];
		$trans 		= $_POST['trans'];
		$nid 		= $_POST['nid'];
		$ticket 	= $_POST['ticket'];
		$comment 	= $_POST['comment'] . ' [ Offline Registration ] ';
		
		require_once 'db_connection.php';
		require_once 'includes/funcs/functions.inc.php';
		// check if user already exists
		$validate = 'WHERE name = "' . $name . '" AND phone="' . $phone . '"';
		$count = countItems('cdc' , 'name', $validate);
		if($count > 0){
			echo 'exists';
			exit();
		}
		
		
		$count = countItems("cdc" , "ticket_id" , " WHERE ticket_id = '$ticket'");
		
		if($count > 0){
			echo '<div class="alert alert-danger lead">Ticked Number ( ' . $ticket  . ' ) is already Recorded</div>';
		}else{
			$stmt = $db->prepare("INSERT INTO cdc ( ticket_id , name , faculty , grade , university , email , phone , facebook , date ,comments , status,nid,transportation) VALUES ( ?,?,?,?,?,?,?,? , NOW(), ? , '1',?,? )");
			$stmt->execute(array($ticket , $name , $faculty , $grade , $university , $email , $phone , $face , $comment,$nid,$trans));
					
			if($stmt->rowCount() > 0){
					echo 'success';
			}
		}
		
	
	
	}else{
		echo 'error';
	}
	
?>