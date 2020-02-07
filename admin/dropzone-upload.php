<?php
ini_set("session_.cookie_httponly" , True);
session_start();
if(isset($_SESSION['user_type'])){
		$target_dir = "../uploaded_files/";
		$pattern = "ab78sawew4";
		$photo_id = uniqid(true);

		$tmp_name = $_FILES['file']['tmp_name'];

		if($_FILES['file']['type'] == 'image/jpeg'){
			
			
			function compress($source, $destination, $quality) {

			$info = getimagesize($source);

			if ($info['mime'] == 'image/jpeg')
				$image = imagecreatefromjpeg($source);
			
			imagejpeg($image, $destination, $quality);
			

			return $destination;
		}

			
		}else if($_FILES['file']['type'] == 'image/png'){
			
			function compress($source, $destination, $quality) {

				$info = getimagesize($source);

				if ($info['mime'] == 'image/png')
					$image = imagecreatefrompng($source);
				
				imagepng($image, $destination, $quality);
				

				return $destination;
			
			}
		}
		
		if($_FILES['file']['type'] == 'image/jpeg'){
			
			$photo_name = filter_var(trim($_POST['photo-key']) , FILTER_SANITIZE_STRING) . $pattern . $photo_id . '.jpg';
			$d = compress($tmp_name, $target_dir.$photo_name, 20);
			
		}else if($_FILES['file']['type'] == 'image/png'){
			
			$photo_name = filter_var(trim($_POST['photo-key']) , FILTER_SANITIZE_STRING) . $pattern . $photo_id . '.png';
			$d = compress($tmp_name, $target_dir.$photo_name, 7);
			
		}
		
		
	echo $photo_name;
	}else{
		header("Location: index.php");
		exit();
	}
?>