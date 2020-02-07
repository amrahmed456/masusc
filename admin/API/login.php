<?php
	require_once 'db_connection.php';

	
	if(isset($_GET['user_email']) && isset($_GET['user_password'])){
		
		$user_email 	= $_GET['user_email'];
		$user_password 	= $_GET['user_password'];
		
		$stmt = $db->prepare("SELECT uid,u_name,email,password,date,RegStatus FROM users WHERE email = ?");
		$stmt->execute(array($user_email));
		
		$count = $stmt->rowCount();
		if($count > 0){
			// user found
			$row = $stmt->fetch();
			
			if(password_verify($user_password , $row['password']) == true){
				// password is ok
				extract($row);
				$result = array(
							"result" => "found",
							"password" => "ok",
							"uid" => $uid,
							"u_name" => $u_name,
							"email" => $email,
							"date" => $date,
							"RegStatus" =>	$RegStatus
						);
				
			}else{
				// password is wrong
				$result = array("result"=> "found" ,"password"=> "not_ok");
			}
			
			
		}else{
			// no user found
			$result = array("result"=> "not_found");
		}
		
		
	}else{
		// no results found
		$result = array("result"=> "not_found");
	}
	echo json_encode($result);
	
?>