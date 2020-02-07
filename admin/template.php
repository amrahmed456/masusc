<?php
	session_start();
	$pageTitle = 'Jsouq | Categories';
	
	/*
	==================================================
	== users page									==
	== you can add | edit | delete | modifiy users  ==
	==================================================
	
	*/
	
	// check if user is logged in
	if(isset($_SESSION['user_type'])){
		include 'init.inc.php';
		?>
		<div class="container">
		<?php
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		if($do == 'Manage'){
			
		}else if($do == 'delete'){
			
		}else if($do == 'activate'){
			
		}else if($do == 'Add'){
		
		}else if($do == 'insert'){
			
		}else if($do == 'edit'){
			
		}else if($do == 'update'){
			
		}
		
		
	}else{
		header("Location: index.php");
		exit();
	}
	?>
	</div>
	<?php
	include $tpls . '/footer.inc.php';
?>