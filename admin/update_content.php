<?php

	include 'db_connection.php';
		if(isset($_GET['article_id'])){
			$article_id = $_GET['article_id'];
			$content = $_GET['data'];
			$up = $db->prepare("UPDATE articles SET content = ? WHERE item_id = ?");
			$up->execute(array($content , $article_id));
			
			if($up->rowCount() > 0){
				echo 'success';
			}else{
				echo 'failed';
			}
			
			
		}
	
?>