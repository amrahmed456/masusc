<?php
	require_once 'db_connection.php';
	if(isset($_POST['cat_name'])){
		$cat_name = $_POST['cat_name'];
		$stmt = $db->prepare("SELECT name FROM categories WHERE name LIKE '%$cat_name%';");
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0){
			// there's data
			$rows = $stmt->fetchAll();
			foreach($rows as $row){
				echo '<p class="lead">' . $row['name'] . '</p>';
			}
			
		}else{
			// no data found
			echo 'not_found';
		}
	}
?>