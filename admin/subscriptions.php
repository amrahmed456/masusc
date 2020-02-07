<?php
	session_start();
	$pageTitle = 'Jsouq | subscriptions';
	
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
		?>
			<h1 class="text-center mb-4 mt-4">Manage Subscribed Emails</h1>
			<a href="subscriptions.php?do=add"><div class="add-button position-fixed d-flex justify-content-center align-articles-center">+</div></a>
		<?php
		// getting users data
		$stmt = $db->prepare("SELECT email,faculty,date FROM email_subscribe");
		$stmt->execute();
		if($stmt->rowCount() > 0){
				// there is users
				$rows = $stmt->fetchAll();
				
			?>
			<table class="table table-striped">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">email</th>
				  <th scope="col">faculty</th>
				  <th scope="col">date</th>
				  <th scope="col">Control</th>
				</tr>
			 </thead>
			 <tbody>
			<?php
				foreach($rows as $row){
			?>
				<tr>
				  <td><?php echo $row['email']; ?></td>
				  <td><?php echo $row['faculty']; ?></td>
				  <td><?php echo $row['date']; ?></td>
				  <td>
					<a href="subscriptions.php?do=delete&item_id=<?php echo $row['email']; ?>" class="mb-2 btn btn-danger confirm btn-sm"><i class="fas fa-trash-alt"></i> DELETE</a>
					
				  </td>
				</tr>
			<?php
				}
			?>
			  </tbody>
			</table>
			<?php
			}else{
				echo "<div class='alert alert-danger text-center'>No Data was found.</div>";
				
			}
		}else if($do == 'delete'){
			
			
			if(isset($_SERVER['HTTP_REFERER'])){
				
				$item_id = isset($_GET['item_id']) ? $_GET['item_id'] : 0;
				
				$count = checkItem('email_subscribe' , 'email' , $item_id );
				if($count > 0){
					$stmt = $db->prepare("DELETE FROM email_subscribe WHERE email = ?");
					$stmt->execute(array($item_id));
					if($stmt->rowCount() > 0){
						$msg = '<div class="alert alert-success text-center">Item Deleted Successfully.</div>';
						redirect('' , $msg , 3);
					}else{
						$msg = '<div class="alert alert-danger text-center">Failed To Delete Item.</div>';
						redirect('' , $msg , 3);
					}
				}else{
					// no user found
					$msg = '<div class="alert alert-danger text-center">There\'s No Item Found With this email : ' . $item_id . '</div>';
					redirect('' , $msg , 3);
				}
			
				
			}else{
				$msg = '<div class="alert alert-danger text-center">You Can\'t View This page Directly</div>';
				redirect('index.php' , $msg , 3);
			}
				
			
		}else if($do == 'activate'){
			
		}else if($do == 'add'){
			
		?>
		<h1 class="text-center mt-4">Add New Email</h1>
			<form action="subscriptions.php?do=insert" enctype="multipart/form-data" method="POST"class="new-item-form">
			
				<div class="form-group row">
					<label for="userEmail" class="col-sm-2">Email</label>
					<div  class="col-sm-10  col-md-8 position-relative">
						<!-- will be showing real time results with ajax -->
						<input name="email" type="email" placeholder="Email Address..."  class="form-control" id="userEmail" required="">
						
					</div>
				</div>
				
				<button type="submit" class="btn btn-primary offset-md-2">Submit</button>
			</form>
				
				
		<?php
		}else if($do == 'insert'){
			
			
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$email 		= $_POST['email'];

					if(!empty($email)){
						
						$count = checkItem('email_subscribe' , 'email' , $email);
						if($count > 0){
							// email already exist
							echo '<div class="alert alert-danger text-center">This Email Is Already Exists.</div>';
						
							$msg = '';
							redirect('' , $msg , 7);
						}else{
							$stmt = $db->prepare("INSERT INTO email_subscribe (email , date) VALUES (?,NOW())");
							$stmt->execute(array($email));
							
							$msg = '<div class="alert alert-success text-center">Item Added Successfully</div>';
							redirect('' , $msg , 7);
						}
						
						
					}else{
						
						
						echo '<div class="alert alert-danger text-center">Email Is Empty.</div>';
						
						$msg = '';
						redirect('' , $msg , 7);
					
					}
					
			}
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