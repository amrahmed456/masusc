<?php
	session_start();
	$pageTitle = 'MA admin | Sponsors';
	
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
			<h1 class="text-center mb-4 mt-4">Manage Sponsors</h1>
			<a href="sponsors.php?do=add"><div class="add-button position-fixed d-flex justify-content-center align-articles-center">+</div></a>
		<?php
		// getting users data
		$stmt = $db->prepare("SELECT id,title,image FROM sponsors");
		$stmt->execute();
		if($stmt->rowCount() > 0){
				// there is users
				$rows = $stmt->fetchAll();
				
			?>
			<table class="table table-striped">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">id</th>
				  <th scope="col">title</th>
				  <th scope="col">image</th>
				  <th scope="col">Control</th>
				</tr>
			 </thead>
			 <tbody>
			<?php
				foreach($rows as $row){
			?>
				<tr>
				  <td><?php echo $row['id']; ?></td>
				  <td><?php echo $row['title']; ?></td>
				  <td><img src="<?php echo '../uploaded_files/' . $row['image']; ?>" style="width:90px"></td>
				  <td>
				  
					<a href="sponsors.php?do=edit&item_id=<?php echo $row['id']; ?>" class="mb-2 btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
					<a href="sponsors.php?do=delete&item_id=<?php echo $row['id']; ?>" class="mb-2 btn btn-danger confirm btn-sm"><i class="fas fa-trash-alt"></i> DELETE</a>
					
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
				
				$item_id = isset($_GET['item_id']) && is_numeric($_GET['item_id']) ? $_GET['item_id'] : 0;
				
				$count = checkItem('sponsors' , 'id' , $item_id );
				if($count > 0){
					$stmt = $db->prepare("DELETE FROM sponsors WHERE id = ?");
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
					$msg = '<div class="alert alert-danger text-center">There\'s No Item Found With this ID : ' . $cat_id . '</div>';
					redirect('' , $msg , 3);
				}
			
				
			}else{
				$msg = '<div class="alert alert-danger text-center">You Can\'t View This page Directly</div>';
				redirect('index.php' , $msg , 3);
			}
			
		}else if($do == 'add'){
		?>
		<h1 class="text-center mt-4">Add New sponsor</h1>
			<form action="sponsors.php?do=insert" enctype="multipart/form-data" method="POST"class="new-item-form">
			
				<div class="form-group row">
					<label for="userEmail" class="col-sm-2">Sponsor Title</label>
					<div  class="col-sm-10  col-md-8 position-relative">
						<!-- will be showing real time results with ajax -->
						<input name="title" type="text" placeholder="title..."  class="form-control" id="userEmail" required="">
						
					</div>
				</div>
				
				<div class="form-group row">
					<label for="userEmails" class="col-sm-2">image</label>
					<div  class="col-sm-10  col-md-8">
						<div class="input-group mb-3">
						  
						  <div class="custom-file">
							<input name="articleImage" type="file" required class="custom-file-input" id="inputGroupFile01">
							<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
						  </div>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary offset-md-2">Submit</button>
			</form>
				
				
		<?php
		}else if($do == 'insert'){
			
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$title 		= $_POST['title'];
				$files 		= $_FILES['articleImage'];
				$filename 	= $files['name'];
				$filetype 	= $files['type'];
				$filesize 	= $files['size'];
				$tmpname 	= $files['tmp_name'];
				$fileerror 	= $files['error'];
				$image_name = '';
				$errors = array();
				
				$dir = scandir(__DIR__ . '/../');
					if(!in_array('uploaded_files',$dir)){
						mkdir(__DIR__ . '/../uploaded_files/');
					}
					
					
					$acceptable_ext = ['jpg' , 'jpeg'  , 'gif' , 'png'];
					if($fileerror == 4){
						$errors[] = 'No Files Were Uploaded';
					}
					if( !in_array(strtolower(explode('/' ,$filetype)[1]) , $acceptable_ext) ){
						$errors[] = 'File Type not Acceptable';
						
					}
					
					if($filesize > 15000000){
						$errors[] = 'File Size is larger than 15MB';
					}
					
					if(count($errors) == 0){
						
						function compress($type ,$source, $destination, $quality) {
							$info = getimagesize($source);
							if($type == 'jpg'){
								$image = imagecreatefromjpeg($source);
								imagejpeg($image, $destination, $quality);
								
							}else if($type == 'png'){
								$image = imagecreatefrompng($source);
								imagepng($image, $destination, $quality);
							}
						}
						
						if($filetype == 'image/jpeg' || $filetype == 'image/jpg'){
							$image_name = $title . uniqid(true) . '.jpg';
							compress('jpg' , $tmpname , '../uploaded_files/' . $image_name , 20);
						}else if($filetype == 'image/png'){
							$image_name = $title . uniqid(true) . '.png';
							compress('png' , $tmpname , '../uploaded_files/' . $image_name , 7);
						}
						
						$stmt = $db->prepare("INSERT INTO sponsors (title,image) VALUES (?,?)");
						$stmt->execute(array($title , $image_name));
						
						$msg = '<div class="alert alert-success text-center">Item Updated Successfully</div>';
						redirect('' , $msg , 7);
						
					}else{
						
						foreach($errors as $err){
								echo '<div class="alert alert-danger text-center">' . $err . '</div>';
							}
							
							$msg = '';
							redirect('' , $msg , 7);
					
					}
					
			}
			
		}else if($do == 'edit'){
			
				$item_id = isset($_GET['item_id']) && is_numeric($_GET['item_id']) ? $_GET['item_id'] : 0;
			
				$stmt = $db->prepare("SELECT id,title,image FROM sponsors WHERE id = ?");
				$stmt->execute(array($item_id));
				
				if( $stmt->rowCount() > 0){
					$fetch = $stmt->fetch();
					extract($fetch);
					
					?>
					
			
				<h1 class="text-center mb-4 mt-4">Edit Sponsor</h1>
					
					<form action="sponsors.php?do=update" enctype="multipart/form-data" method="POST"class="new-item-form">
					<input type="text"name="item_id" class="d-none"hidden value="<?php echo $item_id; ?>"/>
					
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Title</label>
						<div  class="col-sm-10  col-md-8">
							<input name="title" type="text" placeholder="category name..."  class="form-control" id="userEmails" required="" value="<?php echo $title; ?>">
						</div>
					</div>
				
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">image</label>
						<div  class="col-sm-10  col-md-8">
							<div class="input-group mb-3">
							  
							  <div class="custom-file">
								<input name="articleImage" type="file"  class="custom-file-input" id="inputGroupFile01">
								<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
							  </div>
							</div>
						</div>
					</div>
					
					<button type="submit" class="btn btn-primary offset-md-2">Submit</button>
					
				</form>
				
			<?php
					
				}else{
					$msg = "<div class='alert alert-danger text-center'>There's no such id</div>";
					redirect('articles.php' , $msg , 5);
				}

		}else if($do == 'update'){
			
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$item_id 		= $_POST['item_id'];
				$title 		= $_POST['title'];
				$files 		= $_FILES['articleImage'];
				$filename 	= $files['name'];
				$filetype 	= $files['type'];
				$filesize 	= $files['size'];
				$tmpname 	= $files['tmp_name'];
				$fileerror 	= $files['error'];
				$image_name = '';
				$errors = array();
				
				$dir = scandir(__DIR__ . '/../');
					if(!in_array('uploaded_files',$dir)){
						mkdir(__DIR__ . '/../uploaded_files/');
					}
					
					
					$acceptable_ext = ['jpg' , 'jpeg' , 'png'];
					if($fileerror == 4){
						if(empty($title)){
							$errors[] = 'You Must at least Add a title';
						}
					}else{
						if( !in_array(strtolower(explode('/' ,$filetype)[1]) , $acceptable_ext) ){
							$errors[] = 'File Type not Acceptable';
							
						}
					
						if($filesize > 15000000){
							$errors[] = 'File Size is larger than 15MB';
						}
					}
					
					if(count($errors) == 0){
						
						if($fileerror == 4){
							// no photo updated
							$stmt = $db->prepare("UPDATE sponsors SET title = ? WHERE id = ?");
							$stmt->execute(array($title , $item_id));
						}else if($filesize > 0){
							// photo updated
							function compress($type ,$source, $destination, $quality) {
							$info = getimagesize($source);
							if($type == 'jpg'){
								$image = imagecreatefromjpeg($source);
								imagejpeg($image, $destination, $quality);
								
							}else if($type == 'png'){
								$image = imagecreatefrompng($source);
								imagepng($image, $destination, $quality);
							}
						}
						
						if($filetype == 'image/jpeg' || $filetype == 'image/jpg'){
							$image_name = $title . uniqid(true) . '.jpg';
							compress('jpg' , $tmpname , '../uploaded_files/' . $image_name , 20);
						}else if($filetype == 'image/png'){
							$image_name = $title . uniqid(true) . '.png';
							compress('png' , $tmpname , '../uploaded_files/' . $image_name , 7);
						}
							
							$stmt = $db->prepare("UPDATE sponsors SET title = ?,image = ? WHERE id = ?");
							$stmt->execute(array($title , $image_name , $item_id));
						}
						
						$msg = '<div class="alert alert-success text-center">Item Updated Successfully</div>';
						redirect('' , $msg , 7);
						
					}else{
						
						foreach($errors as $err){
								echo '<div class="alert alert-danger text-center">' . $err . '</div>';
							}
							
							$msg = '';
							redirect('' , $msg , 7);
					
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