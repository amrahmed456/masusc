<?php
	
	if(isset($_POST['name'])){
		$name 		= $_POST['name'];
		$faculty 	= $_POST['faculty'];
		$grade 		= $_POST['grade'];
		$university = $_POST['university'];
		$email 		= $_POST['email'];
		$phone 		= $_POST['phone'];
		$face 		= $_POST['face'];
		
		require_once 'db_connection.php';
		require_once 'includes/funcs/functions.inc.php';
		
		$tickets = getLatestItems("tickets" , "tickets" , "", "tickets" , "1");
		
		foreach($tickets as $ticket){
			extract($ticket);
			$availabe_tickets = explode(" " , $tickets );
			if(count($availabe_tickets) > 0){
				// there is availabe_tickets
				
				$ticket_id = $availabe_tickets[0];
				unset($availabe_tickets[0]);
				$remaning_tickets = implode(" " , $availabe_tickets);
				
				
				
				$stmt = $db->prepare("INSERT INTO cdc ( ticket_id , name , faculty , grade , university , email , phone , facebook , date ) VALUES ( ?,?,?,?,?,?,?,? , NOW() )");
				$stmt->execute(array($ticket_id , $name , $faculty , $grade , $university , $email , $phone , $face));
				
				if($stmt->rowCount() > 0){
					
					$stms = $db->prepare("UPDATE tickets SET tickets = ?");
					$stms->execute(array($remaning_tickets));
					if($stms->rowCount() > 0){
						echo 'success';
					}
					
				}
				
				
			}else{
				// no availabe_tickets
				echo 'Tickets were sold out while while you were filling the form.';
			}
		}
		
	}else{
		echo 'error';
	}
	
?>