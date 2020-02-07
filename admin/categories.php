<?php
	session_start();
	$pageTitle = 'MA | Categories';
	
	/*
	==========================================================
	== categories page											==
	== you can add | edit | delete | modifiy categories  	==
	==========================================================
	
	*/
	
	// check if user is logged in
	if(isset($_SESSION['user_type'])){
		if($_SESSION['user_type'] == 1){
			include 'init.inc.php';
			?>
			<div class="container">
			<?php
			$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

			if($do == 'Manage'){
			?>
			<h1 class="text-center mb-4 mt-4">Manage Categories</h1>
			
				<a href="categories.php?do=Add"><div class="add-button position-fixed d-flex justify-content-center align-items-center">+</div></a>
				
			<?php
				// check if there is categories and display them
				$count = countItems('categories' , 'cat_id' , '');
				if($count > 0){
					// there is categories
			?>
			<div class="card">
				  <div class="card-header">
					Categories
					<span class="float-right expand"data-view="collapsed">Expand All</span>
				  </div>
				  <div class="card-body">
			<?php
				$stmt = $db->prepare("SELECT cat_id,name,description,visability FROM categories");
				$stmt->execute();
				$rows = $stmt->fetchAll();
				foreach($rows as $row){
					extract($row);
				?>
					<div class="card-info cat_card">
						<div class="btn-options">
							<a href="categories.php?do=edit&cat_id=<?php echo $cat_id; ?>">
								<button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>
							</a>
							<a href="categories.php?do=delete&cat_id=<?php echo $cat_id; ?>"class="confirm">
								<button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
							</a>
						</div>
						<h5 class="card-title"><?php echo $name; ?></h5>
						<div class="full-view d-none">
							<p class="card-text"><?php echo $description; ?></p>
							<?php
								if($visability == 1 ){echo '<span class="info visiability-cat">Hidden</span>';}
							?>
						</div>
					</div>
				<?php
				}
			
				}else{
					// no results found
			?>
			<div class="alert alert-warning text-center">There's No Categories Found</div>
			<?php
				}
			?>
			
				  </div>
				</div>
				
			<?php
			}else if($do == 'delete'){
				
				if(isset($_SERVER['HTTP_REFERER'])){
				
				$cat_id = isset($_GET['cat_id']) && is_numeric($_GET['cat_id']) ? $_GET['cat_id'] : 0;
				
				$count = checkItem('categories' , 'cat_id' , $cat_id );
				if($count > 0){
					$stmt = $db->prepare("DELETE FROM categories WHERE cat_id = ?");
					$stmt->execute(array($cat_id));
					if($stmt->rowCount() > 0){
						$msg = '<div class="alert alert-success text-center">Category Deleted Successfully.</div>';
						redirect('' , $msg , 3);
					}else{
						$msg = '<div class="alert alert-danger text-center">Failed To Delete Category.</div>';
						redirect('' , $msg , 3);
					}
				}else{
					// no user found
					$msg = '<div class="alert alert-danger text-center">There\'s No Category Found With this ID : ' . $cat_id . '</div>';
					redirect('' , $msg , 3);
				}
			
				
			}else{
				$msg = '<div class="alert alert-danger text-center">You Can\'t View This page Directly</div>';
				redirect('index.php' , $msg , 3);
			}
			
			
				
				
			}else if($do == 'Add'){
			?>
				<h1 class="text-center mb-4 mt-4">Add New Category</h1>
			
			<form action="categories.php?do=insert" method="POST">
			
					<div class="form-group row">
						<label for="userEmail" class="col-sm-2">Category Name</label>
						<div  class="col-sm-10  col-md-8">
							
							<input name="name" type="text" placeholder="category name..."  class="form-control" id="userEmail" required="">
						</div>
					</div>
				
					 <div class="form-group row">
						<label for="userNameEdit" class="col-sm-2">Description</label>
						<div  class="col-sm-10 col-md-8">
							<textarea class="form-control"placeholder="Category Description..." name="description"></textarea>
						</div>
						
					</div>
					
					<div class="form-group row">
						<label for="userRe-Pass" class="col-sm-2">visability</label>
						<div  class="col-sm-10  col-md-8">
							<span>
								<input type="radio"name="visability"value="0" id="visible" checked=""/>
								<label for="visible">Visible</label>
							</span>
							<span>
								<input type="radio"name="visability"value="1" id="invisible"/>
								<label for="invisible">invisible</label>
							</span>
						</div>
					</div>
					
						
					<button type="submit" class="btn btn-primary offset-md-2">Submit</button>
					
				</form>
			<?php
			}else if($do == 'insert'){
				
				// insert categories sumbitted data
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					// getting category data
					$name 			= trim($_POST['name']);
					$description 	= trim($_POST['description']);
					$visability 	= $_POST['visability'];
					
					$count = checkItem('categories' , 'name' , $name);
					if($count > 0){
						// categoty already exists
						$msg = '<div class="text-center alert alert-danger">Category Name Already Exists.</div>';
						redirect('' , $msg , 3);
					}else{
						
						if(empty($name)){
							$msg = '<div class="text-center alert alert-danger">Category Name is Empty.</div>';
							redirect('' , $msg , 3);
						}else{
						
							$stmt = $db->prepare("INSERT INTO categories (name , description  ,visability  ) VALUES (? , ? , ? )");
							$stmt->execute(array($name,$description , $visability));
							if($stmt->rowCount() > 0){
								$msg = '<div class="alert alert-success text-center">Category Inserted Successfully</div>';
								redirect('' , $msg , 3);
							}else{
								echo '<div class="text-center alert alert-danger">Failed To add Category.</div>';
								redirect('' , $msg , 3);
							}
							
							
						}
							
					}
					
				}else{
					$msg = '<div class="text-center alert alert-danger">You Can\'t Access This Page Directly</div>';
					redirect('', $msg , 3);
				}
			
				
			}else if($do == 'edit'){
				
				$cat_id = isset($_GET['cat_id']) && is_numeric($_GET['cat_id']) ? $_GET['cat_id'] : 0;
			
				$stmt = $db->prepare("SELECT cat_id,name,description,visability FROM categories WHERE cat_id = ? LIMIT 1");
				$stmt->execute(array($cat_id));
				
				if( $stmt->rowCount() > 0){
					$fetch = $stmt->fetch();
					extract($fetch);
					?>
			
				<h1 class="text-center mb-4 mt-4">Edit category</h1>
				
				<form action="categories.php?do=update" method="POST">
				
					<input type="hidden"class="d-none"name="cat_id"value="<?php echo $cat_id; ?>" />
					
						<div class="form-group row">
							<label for="userEmailEdit" class="col-sm-2">Category Name</label>
							<div  class="col-sm-10  col-md-8">
								
								<input type="text" placeholder="Category Name ..." class="form-control" id="userEmailEdit" name="name"value="<?php echo $name; ?>">
							</div>
						</div>
					
						 <div class="form-group row">
							<label for="userNameEdit" class="col-sm-2">Description</label>
							<div  class="col-sm-10 col-md-8">
								<textarea class="form-control"name="description"placeholder="Description..."><?php echo $description; ?></textarea>
							</div>
							
						</div>
						
						
						<div class="form-group row">
							<label for="userRe-Pass" class="col-sm-2">Visability</label>
							<div  class="col-sm-10  col-md-8">
								<span>
									<input type="radio"name="visability"value="0" id="al-vis"<?php if($visability == 0){echo 'checked';}?>/>
									<label for="al-vis">Visible</label>
								</span>
								<span>
									<input type="radio"name="visability"value="1" id="al-vis1"<?php if($visability == 1){echo 'checked';}?>/>
									<label for="al-vis1">Invisible</label>
								</span>
							</div>
						</div>
						
						<button type="submit" class="btn btn-primary offset-md-2">Submit</button>
						
				</form>
							
				
			<?php
					
				}else{
					$msg = "<div class='alert alert-danger text-center'>There's no such id</div>";
					redirect('users.php' , $msg , 5);
				}

				
					
				
			}else if($do == 'update'){
				// update sumbitted data
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// getting user data
				$cat_id 		= $_POST['cat_id'];
				$name 			= $_POST['name'];
				$description 	= $_POST['description'];
				$visability 	= $_POST['visability'];
				
				$count = countItems('categories' , 'cat_id' , '');
				if($count > 0){
					if(empty($cat_id)){
						$msg = '<div class="alert alert-success text-center">Category Name Cannot Be Empty!</div>';
						redirect('' , $msg , 5);
					}else{
						
						$stmt = $db->prepare("UPDATE categories SET name = ?, description = ?, visability = ?  WHERE cat_id = ?");
						$stmt->execute(array($name,$description,$visability , $cat_id));
						
						$msg = '<div class="alert alert-success text-center">Category Updated Successfully</div>';
						redirect('categories.php' , $msg , 5);
						
					}

				}else{
					$msg = '<div class="alert alert-success text-center">Cannot Find This Category With ID : ' . $cat_id . '</div>';
					redirect('' , $msg , 8);
				}
				
			}else{
				$msg = '<div class="alert alert-success text-center">Can\'t Access Directly</div>';
				redirect('' , $msg , 8);
			}
		
			}
		}else{
			header("Location: index.php");
			exit();
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