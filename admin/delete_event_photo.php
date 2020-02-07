<?php
ini_set("session_.cookie_httponly" , True);
	session_start();
	if(isset($_SESSION['user_type'])){
		if(isset($_POST['image_src'])){
			require_once 'db_connection.php';
			
			$event_id 		= $_POST['event_id'];
			$image_src 		= $_POST['image_src'];
			
			$stmt = $db->prepare("SELECT images FROM events WHERE id = ? LIMIT 1");
			$stmt->execute(array($event_id));
			if($stmt->rowCount() > 0){
				$row = $stmt->fetch();
				
					$data_photos = $row['images'];
					
					$data_photos = explode("," , $data_photos);
					
					$search_text = array_search($image_src , $data_photos);
					
					if($search_text > -1){
						// image is in the database
						// check if it was in the directory or not
						unset($data_photos[$search_text]);
						$data_photos = implode("," , $data_photos);
						
						$up = $db->prepare("UPDATE events SET images = ? WHERE id = ?");
						$up->execute(array($data_photos , $event_id));
	
						$photos_dir = scandir(__DIR__ . '/../uploaded_files/');
						
						$search_dir = array_search($image_src , $photos_dir);
						
						if($search_dir > -1){
							// photos is in the directory already
							unlink(__DIR__ . '/../uploaded_files/' . $image_src);
							echo 'success';
							exit();
							
						}else{
							echo 'Error While Deleting Image, Source Not Found' . $image_src;
							exit();
						}
						
					}else{
						echo 'Image Not Found In the Database name : ' . $image_src;
						exit();
					}
					
			}else{
				echo 'Can\'t Find Event In the database :(';
				exit();
			}
			
		}else{
			echo 'Unknown Error :(';
			exit();
		}
		
	}else{
		echo 'Unknown Error :(';
		exit();
	}

?>