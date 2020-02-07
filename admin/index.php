<?php
	session_start();
	$noNavbar 	= '';
	$pageTitle 	= 'Dashboard | Login Admin';
	
	
	if(isset($_SESSION['user_type'])){
		if($_SESSION['user_type'] == '1'){
			// admin already logged in
			header("Location: dashboard.php");
			exit();
		}
	}
	
	include 'init.inc.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$uEmail = $_POST['admin_email'];
		$uPass = $_POST['admin_password'];
		
		$stmt = $db->prepare("SELECT uid,u_name,password FROM users WHERE email = ? AND groupID = '1'");
		$stmt->execute(array($uEmail));
		
		// check if there are results
		if( $stmt->rowCount() > 0){
			// admin found
			$fetch = $stmt->fetch();
			$uId = $fetch['uid'];
			$dPass = $fetch['password'];
			
			if(password_verify($uPass , $dPass) == true){
				
				$uName = $fetch['u_name'];
			
				$_SESSION['user_type'] 	= '1'; // user type is ( 1 ) only for admins
				$_SESSION['user_id'] 	= $uId;
				$_SESSION['user_name'] 	= $uName;
				header("Location: dashboard.php");
				exit();
			}
			
		}
		
	}
	
?>
	
	<!-- start login page -->
	<div class="login">
		
		<h2 class="text-center">Admin Login</h2>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<input type="text"name="admin_email"class="form-control"placeholder="Email">
			<input type="password"name="admin_password"class="form-control"placeholder="Password">
			<button type="submit"class="btn btn-primary btn-block">LOGIN</button>
		</form>
	</div>
	<!-- end login page -->
	

<?php
	include $tpls . '/footer.inc.php';
?>