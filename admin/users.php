<?php
	session_start();
	$pageTitle = 'Jsouq | Users';
	
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
			$query = '';
			if(isset($_GET['page']) && $_GET['page'] == 'Pending'){
				$query = 'AND RegStatus = 0';
			}
		?>
			<h1 class="text-center mb-4 mt-4">Manage Members</h1>
			<a href="users.php?do=Add"><div class="add-button position-fixed d-flex justify-content-center align-items-center">+</div></a>
		<?php
			// getting users data
			$stmt = $db->prepare("SELECT uid,u_name,email,date,RegStatus  FROM users WHERE groupID != 1 $query;");
			$stmt->execute();
			if($stmt->rowCount() > 0){
				// there is users
				$rows = $stmt->fetchAll();
				
			?>
			<table class="table table-striped">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">ID</th>
				  <th scope="col">Name</th>
				  <th scope="col">Email</th>
				  <th scope="col">RegDate</th>
				  <th scope="col">Control</th>
				</tr>
			 </thead>
			 <tbody>
			<?php
				foreach($rows as $row){
			?>
				<tr class="<?php if($row['RegStatus'] == 0){ echo 'pending-member'; } ?>">
				  <th scope="row"><?php echo $row['uid']; ?></th>
				  <td><?php echo $row['u_name']; ?></td>
				  <td><?php echo $row['email']; ?></td>
				  <td><?php echo $row['date']; ?></td>
				  <td>
				  
					<?php
						if($row['RegStatus'] == 0){
							// user is not activated
					?>
						<a href="users.php?do=activate&user_id=<?php echo $row['uid']; ?>" class="btn btn-success btn-sm"><i class="fas fa-plug"></i> Activate</a>
					<?php
						}
					?>
					<a href="users.php?do=edit&user_id=<?php echo $row['uid']; ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
					<a href="users.php?do=delete&user_id=<?php echo $row['uid']; ?>" class="btn btn-danger confirm btn-sm"><i class="fas fa-trash-alt"></i> DELETE</a>
					
				  </td>
				</tr>
			<?php
				}
			?>
			  </tbody>
			</table>
			<?php
			}else{
				echo "<div class='alert alert-danger text-center'>No users were found.</div>";
				
			}	
		}else if($do == 'delete'){
			
			if(isset($_SERVER['HTTP_REFERER'])){
				
				$user_id = isset($_GET['user_id']) && is_numeric($_GET['user_id']) ? $_GET['user_id'] : 0;
				
				$count = checkItem('users' , 'uid' , $user_id );
				if($count > 0){
					$stmt = $db->prepare("DELETE FROM users WHERE uid = ?");
					$stmt->execute(array($user_id));
					if($stmt->rowCount() > 0){
						$msg = '<div class="alert alert-success text-center">User Deleted Successfully.</div>';
						redirect('' , $msg , 3);
					}else{
						$msg = '<div class="alert alert-danger text-center">Failed To Delete User.</div>';
						redirect('' , $msg , 3);
					}
				}else{
					// no user found
					$msg = '<div class="alert alert-danger text-center">There\'s No user Found With this ID</div>';
					redirect('' , $msg , 3);
				}
			
				
			}else{
				$msg = '<div class="alert alert-danger text-center">You Can\'t View This page Directly</div>';
				redirect('index.php' , $msg , 3);
			}
			
			
		}else if($do == 'activate'){
			
			if(isset($_SERVER['HTTP_REFERER'])){
				
				$user_id = isset($_GET['user_id']) && is_numeric($_GET['user_id']) ? $_GET['user_id'] : 0;
				
				$count = checkItem('users' , 'uid' , $user_id );
				if($count > 0){
					$stmt = $db->prepare("UPDATE users SET RegStatus = 1 WHERE uid = ?");
					$stmt->execute(array($user_id));
					if($stmt->rowCount() > 0){
						$msg = '<div class="alert alert-success text-center">User Activated Successfully.</div>';
						redirect('' , $msg , 3);
					}else{
						$msg = '<div class="alert alert-danger text-center">Failed To Activate User.</div>';
						redirect('' , $msg , 3);
					}
				}else{
					// no user found
					$msg = '<div class="alert alert-danger text-center">There\'s No user Found With this ID</div>';
					redirect('' , $msg , 3);
				}
			
				
			}else{
				$msg = '<div class="alert alert-danger text-center">You Can\'t View This page Directly</div>';
				redirect('index.php' , $msg , 3);
			}
			
		}else if($do == 'Add'){
		?>
		<h1 class="text-center mb-4 mt-4">Add New Member</h1>
			
			<form action="users.php?do=insert" method="POST">
			
					<div class="form-group row">
						<label for="userEmail" class="col-sm-2">Email Address</label>
						<div  class="col-sm-10  col-md-8">
							
							<input name="email" type="text" placeholder="Email..."  class="form-control" id="userEmail" required="">
						</div>
					</div>
				
					 <div class="form-group row">
						<label for="userNameEdit" class="col-sm-2">User Name</label>
						<div  class="col-sm-10 col-md-8">
							<input type="text" class="form-control" id="userNameEdit" aria-describedby="emailHelp" placeholder="User Name..."name="user_name" required="">
						</div>
						
					</div>
					
					<div class="form-group row">
						<label for="userpasswordEdit" class="col-sm-2">Password</label>
						<div  class="col-sm-10  col-md-8">
							<input type="password" class="form-control" id="userpasswordEdit" placeholder="new Password..." autocomplete="new-password"name="password" required="">
						</div>
					</div>
					<div class="form-group row">
						<label for="userRe-Pass" class="col-sm-2">Re-Enter Password</label>
						<div  class="col-sm-10  col-md-8">
							<input type="password" class="form-control" id="userRe-Pass" placeholder="re-enter new password..."name="re_password" required="">
						</div>
					</div>
						
					<button type="submit" class="btn btn-primary offset-md-2">Submit</button>
					
			</form>
		<?php
		}else if($do == 'insert'){
			
			// insert user sumbitted data
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// getting user data
				$user_name 	= $_POST['user_name'];
				$user_email = $_POST['email'];
				$password 	= $_POST['password'];
				$re_password = $_POST['re_password'];
				
				$count = checkItem('users' , 'email' , $user_email);
				if($count > 0){
					// user already exists
					$msg = '<div class="text-center alert alert-danger">This Email already exists.</div>';
					redirect('' , $msg , 3);
				}else{
					// user email is not found in the database
						$errs = array();
				
				$data_password = '';
				
				if(empty($_POST['password'])){
					$errs[] = 'password field is empty.';
					
				}else{
					if($_POST['password'] == $_POST['re_password']){
						
						$data_password = password_hash($_POST['password'] , PASSWORD_DEFAULT);
						
					}else{
						$errs[] = 'The New Password Not identical';
					}
				}
				
				if(empty(trim($user_name))){
					$errs[] = 'Username Must not be empty';
				}
				
					if(count($errs) == 0){
						
						$stmt = $db->prepare("INSERT INTO users ( u_name , email , password ,RegStatus, date) VALUES (? , ? , ? ,1, now())");
						$stmt->execute(array($user_name,$user_email , $data_password));
						if($stmt->rowCount() > 0){
							$msg = '<div class="alert alert-success text-center">user Info. Inserted</div>';
							redirect('' , $msg , 3);
						}else{
							echo '<div class="text-center alert alert-danger">Failed To add memeber.</div>';
							redirect('' , $msg , 3);
						}
					
						
					}else{
						foreach($errs as $er){
							echo '<div class="text-center alert alert-danger">' . $er . '</div>';
						}
						$msg = '';
						redirect('' , $msg , 3);
						
					}
					
				}
				
			}else{
				$msg = '<div class="text-center alert alert-danger">You Can\'t Access This Page Directly</div>';
				redirect('', $msg , 3);
			}
			
		}else if($do == 'edit'){
			
			$user_id = isset($_GET['user_id']) && is_numeric($_GET['user_id']) ? $_GET['user_id'] : 0;
			
			$stmt = $db->prepare("SELECT u_name,email,password FROM users WHERE uid = ?");
			$stmt->execute(array($user_id));
			
			if( $stmt->rowCount() > 0){
				$fetch = $stmt->fetch();
				$u_name = $fetch['u_name'];
				$u_email = $fetch['email'];
				$password = $fetch['password'];
				
				?>
		
			<h1 class="text-center mb-4 mt-4">Edit Member</h1>
			
			<form action="users.php?do=update" method="POST">
			
				<input type="hidden"class="d-none"name="user_id"value="<?php echo $user_id; ?>" />
				<input type="hidden"class="d-none"name="old-password"value="<?php echo $password; ?>" />
				
				
				
					<div class="form-group row">
						<label for="userEmailEdit" class="col-sm-2">Email Address</label>
						<div  class="col-sm-10  col-md-8">
							
							<input type="text" placeholder="Email..." readonly class="form-control-plaintext" id="userEmailEdit" value="<?php echo $u_email; ?>">
						</div>
					</div>
				
					 <div class="form-group row">
						<label for="userNameEdit" class="col-sm-2">User Name</label>
						<div  class="col-sm-10 col-md-8">
							<input type="text" class="form-control" id="userNameEdit" aria-describedby="emailHelp" placeholder="User Name..."name="user_name"value="<?php echo $u_name; ?>" required="">
						</div>
						
					</div>
					
					<div class="form-group row">
						<label for="userpasswordEdit" class="col-sm-2">Password</label>
						<div  class="col-sm-10  col-md-8">
							<input type="password" class="form-control" id="userpasswordEdit" placeholder="new Password..." autocomplete="new-password"name="u_password">
						</div>
					</div>
					<div class="form-group row">
						<label for="userRe-Pass" class="col-sm-2">Re-Enter Password</label>
						<div  class="col-sm-10  col-md-8">
							<input type="password" class="form-control" id="userRe-Pass" placeholder="re-enter new password..."name="u_r_password">
						</div>
					</div>
						
					<button type="submit" class="btn btn-primary offset-md-2">Submit</button>
					
			</form>
						
			
		<?php
				
			}else{
				$msg = "<div class='alert alert-danger text-center'>There's no such id</div>";
				redirect("users.php" , $msg , 5);
			}

			
		}else if($do == 'update'){
			// update user sumbitted data
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// getting user data
				$user_id 	= $_POST['user_id'];
				$user_name 	= $_POST['user_name'];
				$password 	= '';
				
				$errs = array();
				
				
				if(empty($_POST['u_password'])){
					$password = $_POST['old-password'];
					
				}else{
					if($_POST['u_password'] == $_POST['u_r_password']){
						
						$password = password_hash($_POST['u_password'] , PASSWORD_DEFAULT);
						
					}else{
						$errs[] = '<div class="alert alert-danger text-center">The New Password Not identical</div>';
					}
				}
				
				if(empty(trim($user_name))){
					$errs[] = '<div class="alert alert-danger text-center">Username Must not be empty</div>';
				}
				
					if(count($errs) == 0){
						$stmt = $db->prepare("UPDATE users SET u_name = ?, password = ? WHERE uid = ?");
						$stmt->execute(array($user_name,$password , $user_id));
						
						$msg = '<div class="alert alert-success text-center">user Info. Updated</div>';
						
						redirect("users.php" , $msg , 5);
					}else{
						foreach($errs as $er){
							echo $er;
						}
					}
					
				
				
			}
			
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