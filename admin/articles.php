<?php
	session_start();
	$pageTitle = 'MA | Manage articles';
	
	/*
	======================================================
	== articles page									==
	== you can add | edit | delete | modifiy articles 	==
	======================================================
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
			<h1 class="text-center mb-4 mt-4">Manage Articles</h1>
			<a href="articles.php?do=add"><div class="add-button position-fixed d-flex justify-content-center align-articles-center">+</div></a>
		<?php
			// getting users data
			$stmt = $db->prepare("SELECT 					articles.approval,articles.item_id,articles.name,articles.description,articles.add_date, articles.cat_id, categories.name AS cat_name FROM articles JOIN categories ON articles.cat_id = categories.cat_id");
			
			$stmt->execute();
			if($stmt->rowCount() > 0){
				// there is users
				$rows = $stmt->fetchAll();
				
			?>
			<table class="table table-striped">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">Name</th>
				  <th scope="col">Description</th>
				  <th scope="col">Category Name</th>
				  <th scope="col">Adding Date</th>
				  <th scope="col">Control</th>
				</tr>
			 </thead>
			 <tbody>
			<?php
				foreach($rows as $row){
			?>
				<tr>
				  <td><?php echo $row['name']; ?></td>
				  <td><?php echo $row['description']; ?></td>
				  <td><?php echo $row['cat_name']; ?></td>
				  <td><?php echo $row['add_date']; ?></td>
				  <td>
				  
					<?php
						if($row['approval'] == '1'){
							// waiting for approval
							echo '<a href="../article.php?p=' . $row['item_id'] . '" class="mb-2 btn btn-primary btn-sm"><i class="fas fa-eye"></i> view</a>';
						}
					?>
					
					
					<a href="articles.php?do=edit&item_id=<?php echo $row['item_id']; ?>" class="mb-2 btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
					<a href="articles.php?do=delete&item_id=<?php echo $row['item_id']; ?>" class="mb-2 btn btn-danger confirm btn-sm"><i class="fas fa-trash-alt"></i> DELETE</a>
					
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
		}else if($do == 'add'){
			?>
			<h1 class="text-center mt-4">Add New article</h1>
			
			<form action="articles.php?do=insert" enctype="multipart/form-data" method="POST"class="new-item-form">
			
					<div class="form-group row">
						<label for="userEmail" class="col-sm-2">Category Name</label>
						<div  class="col-sm-10  col-md-8 position-relative">
							<!-- will be showing real time results with ajax -->
							<input name="cat_name" type="text" placeholder="category name..."  class="form-control" id="userEmail" required="">
							<div class="cat-result position-absolute d-none">
								
							</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">article Name</label>
						<div  class="col-sm-10  col-md-8">
							<input name="item_name" type="text" placeholder="article name..."  class="form-control" id="userEmails" required="">
						</div>
					</div>
				
					 <div class="form-group row">
						<label for="userNameEdit" class="col-sm-2">Description</label>
						<div  class="col-sm-10 col-md-8">
							<textarea class="form-control"placeholder="Item Description..." name="description" required=""></textarea>
						</div>
						
					</div>
					
					
					<!--<div class="form-group row rating-my-stars">
						<label for="userEmailss" class="col-sm-2">Rating</label>
						<div  class="col-sm-10  col-md-8">
							<input type="text"name="rating"value="0"hidden class="d-none">
							<i class="far fa-star rating-star fa-2x"data-number="1"style="color:orange"></i>
							<i class="far fa-star rating-star fa-2x"data-number="2"style="color:orange"></i>
							<i class="far fa-star rating-star fa-2x"data-number="3"style="color:orange"></i>
							<i class="far fa-star rating-star fa-2x"data-number="4"style="color:orange"></i>
							<i class="far fa-star rating-star fa-2x"data-number="5"style="color:orange"></i>
							<i class="far fa-star rating-star fa-2x"data-number="6"style="color:orange"></i>
							<i class="far fa-star rating-star fa-2x"data-number="7"style="color:orange"></i>
							<i class="far fa-star rating-star fa-2x"data-number="8"style="color:orange"></i>
							<i class="far fa-star rating-star fa-2x"data-number="9"style="color:orange"></i>
							<i class="far fa-star rating-star fa-2x"data-number="10"style="color:orange"></i>
						</div>
					</div>-->
						
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
		}else if($do == 'edit'){
			
				
				$item_id = isset($_GET['item_id']) && is_numeric($_GET['item_id']) ? $_GET['item_id'] : 0;
			
				$stmt = $db->prepare("SELECT articles.item_id,articles.name,articles.description,
					categories.name AS cat_name

					FROM articles
					JOIN categories ON categories.cat_id = articles.cat_id
                    WHERE articles.item_id = ?");
				$stmt->execute(array($item_id));
				
				if( $stmt->rowCount() > 0){
					$fetch = $stmt->fetch();
					extract($fetch);
					
					?>
					
			
				<h1 class="text-center mb-4 mt-4">Edit Article</h1>
					
					<form action="articles.php?do=update" enctype="multipart/form-data" method="POST"class="new-item-form">
						<input type="text"name="item_id" class="d-none"hidden value="<?php echo $item_id; ?>"/>
					<div class="form-group row">
						<label for="userEmail" class="col-sm-2">Category Name</label>
						<div  class="col-sm-10  col-md-8 position-relative">
							<!-- will be showing real time results with ajax -->
							<input name="cat_name" type="text" placeholder="category name..."  class="form-control" id="userEmail" required="" value="<?php echo $cat_name; ?>">
							<div class="cat-result position-absolute d-none">
								
							</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Item Name</label>
						<div  class="col-sm-10  col-md-8">
							<input name="item_name" type="text" placeholder="category name..."  class="form-control" id="userEmails" required="" value="<?php echo $name; ?>">
						</div>
					</div>
				
					 <div class="form-group row">
						<label for="userNameEdit" class="col-sm-2">Description</label>
						<div  class="col-sm-10 col-md-8">
							<textarea class="form-control"placeholder="Item Description..." name="description" required="" ><?php echo $description; ?></textarea>
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
					
				}else{
					$msg = "<div class='alert alert-danger text-center'>There's no such id</div>";
					redirect('articles.php' , $msg , 5);
				}

			
		}else if($do == 'insert'){
				
				// insert categories sumbitted data
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					// getting category data
					$cat_name 		= trim($_POST['cat_name']);
					$item_name		= trim($_POST['item_name']);
					$description 	= trim($_POST['description']);
					$countErrors 	= 0;
					$errors = array();
					
					$files 		= $_FILES['articleImage'];
					$filename 	= $files['name'];
					$filetype 	= $files['type'];
					$filesize 	= $files['size'];
					$tmpname 	= $files['tmp_name'];
					$fileerror 	= $files['error'];
					$image_name = '';
					
					
					
					$dir = scandir(__DIR__ . '/../');
					if(!in_array('uploaded_files',$dir)){
						mkdir(__DIR__ . '/../uploaded_files/');
					}
					
					$acceptable_ext = ['jpg' , 'jpeg'  , 'png'];
					
						if($fileerror == 4){
							$countErrors++;
							$errors[] = 'No Files Were Uploaded';
						}else{
							
							if( !in_array(strtolower(explode('/' ,$filetype)[1]) , $acceptable_ext) ){
								$countErrors++;
								$errors[] = 'File Type not Acceptable';
								
							}
							
							if($filesize > 25000000){
								$countErrors++;
								$errors[] = 'File Size is larger than 15MB';
							}
							
						}
						
						
					
					function Validate($cat_name , $item_name , $description   , $countErrors){
						
						global $errors;
						
						if(empty($cat_name)){
							$errors[] = 'Category Name Can\'t Be Empty';
							$countErrors++;
						}
						
						if(empty($item_name)){
							$errors[] = 'Item Name Can\'t Be Empty';
							$countErrors++;
						}
						
						if(empty($description)){
							$errors[] = 'Description Can\'t Be Empty';
							$countErrors++;
						}
						
						
						if(count($errors) > 0){
							foreach($errors as $err){
								echo '<div class="alert alert-danger text-center">' . $err . '</div>';
							}
							
							$msg = '';
							redirect('' , $msg , 7);
						
						}
						
					}
					
					
					// send email to subscribers using php mailer
					function send_email_to_subscribers($template = 'blog-email.html' , $title , $image , $description){
						// check if there are subscribers
						global $db;
						$stmt = $db->prepare("SELECT email FROM email_subscribe");
						$stmt->execute();
						if($stmt->rowCount() > 0){
							$rows = $stmt->fetchAll();
							$emailList;
							foreach($rows as $row){
								$emailList[] = $row['email'];
							}
							// send email to those subscribers
							// get template body
							$stmt = $db->prepare("SELECT item_id FROM articles WHERE name = ? AND description = ? AND image = ? LIMIT 1");
							$stmt->execute(array($title , $description , $image));
							$row = $stmt->fetch();
							$id = $row['item_id'];
							$template = __DIR__ . '/' . $template;
							$file = file_get_contents($template);
							$file = str_replace('[[title]]' , $title , $file);
							$file = str_replace('[[image]]' , $image , $file);
							$file = str_replace('[[description ]]' , $description , $file);
							$file = str_replace('[[id ]]' , $id , $file);
							require 'phpMailer.php';
							sendEmail($emailList ,'new article releases' ,$file);
							
						}else{
							// no subscribers 
						}
					}
					
					$count = checkItem('categories' , 'name' , $cat_name);
					if($count > 0){
						$stmt = $db->prepare("SELECT cat_id FROM categories WHERE name = ? LIMIT 1;");
						$stmt->execute(array($cat_name));
						$row = $stmt->fetch();
						$cat_id = $row['cat_id'];
						
						
						Validate($cat_name , $item_name , $description   , $countErrors);
						if($countErrors == 0){
							
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
								$image_name = $item_name . uniqid(true) . '.jpg';
								compress('jpg' , $tmpname , '../uploaded_files/' . $image_name , 20);
							}else if($filetype == 'image/png'){
								$image_name = $item_name . uniqid(true) . '.png';
								compress('png' , $tmpname , '../uploaded_files/' . $image_name , 7);
							}
							
							
							$stmt = $db->prepare("INSERT INTO articles (name,description,add_date,cat_id,image,approval) VALUES (?,?,NOW(),? , ?,?)");
							$stmt->execute(array($item_name , $description , $cat_id , $image_name , "1"));
							
							$msg = "<div class='alert alert-success text-center'>Article Added Successfully</div>";
							send_email_to_subscribers( "blog-email.html" , $item_name , $image_name , $description);
							redirect("articles.php", $msg , 5);
							
						}
						
						
						
					}else{
						Validate($cat_name , $item_name , $description   , $countErrors);
						if($countErrors == 0){
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
								$image_name = $item_name . uniqid(true) . '.jpg';
								compress('jpg' , $tmpname , '../uploaded_files/' . $image_name , 20);
							}else if($filetype == 'image/png'){
								$image_name = $item_name . uniqid(true) . '.png';
								compress('png' , $tmpname , '../uploaded_files/' . $image_name , 7);
							}
							
							$ins = $db->prepare("INSERT INTO categories (name) VALUES (?)");
							$ins->execute(array($cat_name));
							
							$stmt = $db->prepare("SELECT cat_id FROM categories WHERE name = ? LIMIT 1;");
							$stmt->execute(array($cat_name));
							$row = $stmt->fetch();
							$cat_id = $row['cat_id'];
							
							$stmt2 = $db->prepare("INSERT INTO articles (name,description,add_date,cat_id,image,approval) VALUES (?,?,NOW(),? ,?, ?)");
							$stmt2->execute(array($item_name , $description , $cat_id , $image_name, "1"));
							
							$msg = "<div class='alert alert-success text-center'>Article Added Successfully</div>";
							send_email_to_subscribers( "blog-email.html" , $item_name , $image_name , $description);
							redirect("articles.php", $msg , 5);
						}
							
					}
					/* redirect to ckeditor
					if($countErrors == 0){
						move_uploaded_file($tmpname , __DIR__ . '/../uploaded_files/' . $image_name );
						
						$stmt = $db->prepare("SELECT item_id FROM articles WHERE name = ? AND cat_id = ? AND description = ? ORDER BY item_id DESC LIMIT 1");
						$stmt->execute(array($item_name , $cat_id , $description));
						$row = $stmt->fetch();
						$item_id = $row['item_id'];
						
						$msg = '';
						redirect('ckeditor.php?article_id=' . $item_id , $msg , 0);
					}*/
					
				}else{
					$msg = '<div class="text-center alert alert-danger">You Can\'t Access This Page Directly</div>';
					redirect('', $msg , 3);
				}
			
		
		}else if($do == 'update'){

				// insert categories sumbitted data
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					// getting category data
					$item_id 		= $_POST['item_id'];
					$cat_name 		= trim($_POST['cat_name']);
					$item_name		= trim($_POST['item_name']);
					$description 	= trim($_POST['description']);
					
					$countErrors 	= 0;
					
					function Validate($cat_name , $item_name , $description   , $countErrors){
						
						$errors = array();
						
						if(empty($cat_name)){
							$errors[] = 'Category Name Can\'t Be Empty';
							$countErrors++;
						}
						
						if(empty($item_name)){
							$errors[] = 'Item Name Can\'t Be Empty';
							$countErrors++;
						}
						
						if(empty($description)){
							$errors[] = 'Description Can\'t Be Empty';
							$countErrors++;
						}
						
						
						
						if(count($errors) > 0){
							foreach($errors as $err){
								echo '<div class="alert alert-danger text-center">' . $err . '</div>';
							}
							
							$msg = '';
							redirect('' , $msg , 7);
						
						}
						
					}
					
					
					$count = checkItem('categories' , 'name' , $cat_name);
					if($count > 0){
						$stmt = $db->prepare("SELECT cat_id FROM categories WHERE name = ? LIMIT 1;");
						$stmt->execute(array($cat_name));
						$row = $stmt->fetch();
						$cat_id = $row['cat_id'];
						
						
						Validate($cat_name , $item_name , $description   , $countErrors);
						if($countErrors == 0){
							$stmt = $db->prepare("UPDATE articles SET name = ?,description = ?,cat_id = ? WHERE item_id = ?");
							$stmt->execute(array($item_name , $description, $cat_id  , $item_id));
							
						}
					}else{
						Validate($cat_name , $item_name , $description   , $countErrors);
						if($countErrors == 0){
							
							$ins = $db->prepare("INSERT INTO categories (name) VALUES (?)");
							$ins->execute(array($cat_name));
							
							$stmt = $db->prepare("SELECT cat_id FROM categories WHERE name = ? LIMIT 1;");
							$stmt->execute(array($cat_name));
							$row = $stmt->fetch();
							$cat_id = $row['cat_id'];
							
							$stmt2 = $db->prepare("UPDATE articles SET name = ?,description = ?,cat_id = ? WHERE item_id = ?");
							$stmt2->execute(array($item_name , $description,$cat_id , $item_id));
						}
							
					}
					if($countErrors == 0){
						$msg = '';
						redirect('ckeditor.php?article_id=' . $item_id , $msg , 0);
					}
					
				}else{
					$msg = '<div class="text-center alert alert-danger">You Can\'t Access This Page Directly</div>';
					redirect('', $msg , 3);
				}
			
			
		}else if($do == 'delete'){
			
				
				if(isset($_SERVER['HTTP_REFERER'])){
				
				$item_id = isset($_GET['item_id']) && is_numeric($_GET['item_id']) ? $_GET['item_id'] : 0;
				
				$count = checkItem('articles' , 'item_id' , $item_id );
				if($count > 0){
					$stmt = $db->prepare("DELETE FROM articles WHERE item_id = ?");
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
				
			
		}else if($do == 'approve'){
			if(isset($_SERVER['HTTP_REFERER'])){
				$item_id = isset($_GET['item_id']) && is_numeric($_GET['item_id']) ? $_GET['item_id'] : 0;
				
				$count = checkItem('articles' , 'item_id' , $item_id );
				if($count > 0){
					$stmt = $db->prepare("UPDATE articles SET approval = 1 WHERE item_id = ?");
					$stmt->execute(array($item_id));
					if($stmt->rowCount() > 0){
						$msg = '<div class="alert alert-success text-center">Item Approved.</div>';
						redirect('' , $msg , 3);
					}else{
						$msg = '<div class="alert alert-danger text-center">Failed To Delete Item.</div>';
						redirect('' , $msg , 3);
					}
				}else{
					// no user found
					$msg = '<div class="alert alert-danger text-center">There\'s No Item Found With this ID : ' . $item_id . '</div>';
					redirect('' , $msg , 3);
				}
			
				
			}else{
				$msg = '<div class="alert alert-danger text-center">You Can\'t View This page Directly</div>';
				redirect('index.php' , $msg , 3);
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