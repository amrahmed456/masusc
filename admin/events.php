<?php
	session_start();
	$pageTitle = 'Jsouq | Categories';
	
	/*
	==================================================
	== events page									==
	== you can add | edit | delete | modifiy events  ==
	==================================================
	
	*/
	
	// check if user is logged in
	if(isset($_SESSION['user_type'])){
		include 'init.inc.php';
		?>
		<link rel="stylesheet" href="layout/css/multi-select.css" />
		<div class="container">
		<?php
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		if($do == 'Manage'){
		?>
			<h1 class="text-center mb-4 mt-4">Manage Events</h1>
			<a href="events.php?do=add"><div class="add-button position-fixed d-flex justify-content-center align-articles-center">+</div></a>
		<?php
		
		// getting users data
		$stmt = $db->prepare("SELECT id,name,status FROM events");
		$stmt->execute();
		if($stmt->rowCount() > 0){
				// there is users
				$rows = $stmt->fetchAll();
				
			?>
			<table class="table table-striped">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">id</th>
				  <th scope="col">name</th>
				  <th scope="col">status</th>
				  <th scope="col">Control</th>
				</tr>
			 </thead>
			 <tbody>
			<?php
				foreach($rows as $row){
					if($row['status'] == '0'){
						// upcoming
						$status = 'Upcoming';
					}else if($row['status'] == '1'){
						// upcoming
						$status = 'Done';
					}else if($row['status'] == '2'){
						// upcoming
						$status = 'Currently Running';
					}
			?>
				<tr>
				  <td><?php echo $row['id']; ?></td>
				  <td><?php echo $row['name']; ?></td>
				  <td><?php echo $status; ?></td>
				  <td>
				  
					<a href="../event.php?p=<?php echo $row['id']; ?>" class="mb-2 btn btn-primary btn-sm"><i class="fas fa-eye"></i> view</a>
					
					<a href="events.php?do=edit&item_id=<?php echo $row['id']; ?>" class="mb-2 btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
					
					<a href="events.php?do=delete&item_id=<?php echo $row['id']; ?>" class="mb-2 btn btn-danger confirm btn-sm"><i class="fas fa-trash-alt"></i> DELETE</a>
					
					<?php
						if($row['status'] == '0'){
							// upcoming event
					?>
						<a href="events.php?do=approve&item_id=<?php echo $row['id']; ?>" class="mb-2 btn btn-success btn-sm"><i class="fas fa-plug"></i> Done</a>
					<?php
						}
					?>
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
				
				$count = checkItem('events' , 'id' , $item_id );
				if($count > 0){
					$stmt = $db->prepare("DELETE FROM events WHERE id = ?");
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
				
				$count = checkItem('events' , 'id' , $item_id );
				if($count > 0){
					$stmt = $db->prepare("UPDATE events SET status = 1 WHERE id = ?");
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
			
		}else if($do == 'add'){
			$photo_key_input = "<input type='text'class='photo-key-genrate'name='photo-key'value='" . time() . "' hidden>";
			
		?>
			<script src="<?php echo $js . 'dropzone.js';?>"></script>
			<link rel="stylesheet" href="<?php echo $css . 'dropzone.css'; ?>">
			<h1 class="text-center mt-4">Add New Event</h1>
			<div class="container">
			
				<div class="input-element photos-uploader mb-4">
					
					<form action="dropzone-upload.php" class="dropzone"id="dropzone"enctype="multipart/form-data">
						<?php
							echo $photo_key_input;
						?>
					</form>
					
				</div>
				
				
				<form action="events.php?do=insert" enctype="multipart/form-data" method="POST"class="new-item-form">
				<?php
					echo $photo_key_input;
				?>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Event Cover</label>
						<div  class="col-sm-10  col-md-8">
							<div class="input-group mb-3">
							  
							  <div class="custom-file">
								<input name="articleImage" type="file" required class="custom-file-input" id="inputGroupFile01">
								<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
							  </div>
							</div>
						</div>
					</div>
					
					
					<div class="form-group row">
						<label for="userEmail" class="col-sm-2">Event Name</label>
						<div  class="col-sm-10  col-md-8 position-relative">
							<input name="event_name" type="text" placeholder="Event name..."  class="form-control" id="userEmail" required="">
							
						</div>
					</div>
					
					 <div class="form-group row">
						<label for="userNameEdit" class="col-sm-2">Description</label>
						<div  class="col-sm-10 col-md-8">
							<textarea class="form-control"placeholder="Event Description..." name="description" required=""></textarea>
						</div>
						
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Start Date</label>
						<div  class="col-sm-10  col-md-8">
							<input name="date" type="date" placeholder="category name..."  class="form-control" id="userEmails" required="">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">End Date</label>
						<div  class="col-sm-10  col-md-8">
							<input name="end_date" type="date" placeholder="category name..."  class="form-control" id="userEmails" required="">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Location</label>
						<div  class="col-sm-10  col-md-8">
							<input name="location" type="text" placeholder="Location of the event..."  class="form-control" id="userEmails" required="">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Category Name</label>
						<div  class="col-sm-10  col-md-8">
							<input name="category" type="text" placeholder="Category Name..."  class="form-control" id="userEmails" required="">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmailss" class="col-sm-2">Status</label>
						<div  class="col-sm-10  col-md-8">
							<select class="form-control"name="status" required="">
								<option value="0"disabled selected>Status...</option>
								<option value="0">Upcoming</option>
								<option value="1">Done</option>
								<option value="2">Currently Running</option>
							</select>
						</div>
					</div>
					
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Facebook Link</label>
						<div  class="col-sm-10  col-md-8">
							<input name="facebook" type="url" placeholder="Event Link on Facebook ...."  class="form-control" id="userEmails">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Registration Link</label>
						<div  class="col-sm-10  col-md-8">
							<input name="registeration" type="url" placeholder="Registration Link ...."  class="form-control" id="userEmails">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">phone Number</label>
						<div  class="col-sm-10  col-md-8">
							<input name="phone" type="text" placeholder="Phone Number..."  class="form-control" id="userEmails">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Email </label>
						<div  class="col-sm-10  col-md-8">
							<input name="email" type="email" placeholder="Email Address..."  class="form-control" id="userEmails">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Topics </label>
						<div  class="col-sm-10  col-md-8">
							<input name="topics" type="text" placeholder="Add topics split with ( , ) ex.( Design , Programming , Presentation )"  class="form-control" id="userEmails">
							<p><small>Please Note That split between topics with the " , " sympol</small></p>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmailss" class="col-sm-2">Speakers</label>
						<div  class="col-sm-10  col-md-8">
							<select id="speakers-select" multiple="multiple" class="form-control"name="speakers[]" >
								<option value="0"disabled>select speakers...</option>
								<?php
									$spek = $db->prepare("SELECT id,name,position FROM speakers");
									$spek->execute();
									$speks = $spek->fetchAll();
									foreach($speks as $sp){
								?>
									<option value="<?php echo $sp['id']; ?>"><?php echo $sp['name'] . " [ " . $sp['position'] . " ]"; ?></option>
								<?php
									}
								?>
							</select>
							<p><small>Add more speakers From <a href="speakers.php?do=add">Here</a></small></p>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmailss" class="col-sm-2">Sponsors</label>
						<div  class="col-sm-10  col-md-8">
							<select id="sponsors-select" multiple="multiple" class="form-control"name="sponsors[]" >
								<option value="0"disabled>select sponsors...</option>
								<?php
									$spek = $db->prepare("SELECT id,title FROM sponsors");
									$spek->execute();
									$speks = $spek->fetchAll();
									foreach($speks as $sp){
								?>
									<option value="<?php echo $sp['id']; ?>"><?php echo $sp['title']; ?></option>
								<?php
									}
								?>
							</select>
							<p><small>Add more sponsors From <a href="sponsors.php?do=add">Here</a></small></p>
						</div>
					</div>
					
					
					
					<button type="submit" class=" btn-block mb-4 btn btn-primary">Submit</button>
					
					
				</form>
				
			
			</div>
		<?php
		}else if($do == 'insert'){
				
				// insert categories sumbitted data
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					// getting category data
					$event_name 	= trim($_POST['event_name']);
					$description	= $_POST['description'];
					$date 			= $_POST['date'];
					$end_date 		= $_POST['end_date'];
					$location 		= trim($_POST['location']);
					$category 		= trim($_POST['category']);
					$status 		= trim($_POST['status']);
					$facebook 		= trim($_POST['facebook']);
					$registeration 	= trim($_POST['registeration']);
					$phone 			= $_POST['phone'];
					$email 			= trim($_POST['email']);
					$topics 		= trim($_POST['topics']);
					$speakers		= isset($_POST['speakers']) ? $_POST['speakers'] : '0';
					$sponsors		= isset($_POST['sponsors']) ? $_POST['sponsors'] : '0';
					
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
					$acceptable_ext = ['jpg' , 'jpeg' , 'png'];
					
						if($fileerror == 4){
							$countErrors++;
							$errors[] = 'No Image Cover was Uploaded';
						}else{
							
							if( !in_array(strtolower(explode('/' ,$filetype)[1]) , $acceptable_ext) ){
								$countErrors++;
								$errors[] = 'Cover File Type not Acceptable';
								
							}
							
							if($filesize > 15000000){
								$countErrors++;
								$errors[] = 'Cover File Size is larger than 15MB';
							}
							
						}
					
					
					function Validate($event_name , $description , $date , $end_date , $location , $category ){
						
						global $errors;
						
						if(empty($date)){
							$errors[] = 'Date Must be Specified';
							$countErrors++;
						}
						if(empty($end_date)){
							$errors[] = 'End Date Must be Specified';
							$countErrors++;
						}
						
						if(empty($description)){
							$errors[] = 'Description Can\'t Be Empty';
							$countErrors++;
						}
						
						if(empty($location)){
							$errors[] = 'location Can\'t Be Empty';
							$countErrors++;
						}
						if(empty($category)){
							$errors[] = 'category Can\'t Be Empty';
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
					
					
				
					Validate($event_name , $description , $date , $end_date , $location , $category);
					if($countErrors == 0){
						
						
						$photos_key = filter_var(trim($_POST['photo-key']), FILTER_SANITIZE_STRING);
						$pattern = "ab78sawew4";
						$photos_dir = scandir(__DIR__ . '/../uploaded_files/');
						rsort($photos_dir);
						$photos = array();
						$num_photos = 0;
						// searching for photos and puts them into an array
						for($i = 0 ; $i < count($photos_dir) -2 ; $i++){
							if(explode($pattern , $photos_dir[$i])[0] == $photos_key){
								$photos[] = $photos_dir[$i];
								$num_photos++;
							}
							
						}
						if($num_photos == 0){
							$msg = '<div class="text-center alert alert-danger">Event Must Contain at least one picture</div>';
							redirect('', $msg , 3);
						}else{
							
							
							$photos = implode("," , $photos) . ',';
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
								$image_name = $event_name . uniqid(true) . '.jpg';
								compress('jpg' , $tmpname , '../uploaded_files/' . $image_name , 20);
							}else if($filetype == 'image/png'){
								$image_name = $event_name . uniqid(true) . '.png';
								compress('png' , $tmpname , '../uploaded_files/' . $image_name , 7);
							}
							
							$stmt = $db->prepare("INSERT INTO events (name,description,date,end_date,facebook , registeration,location,category , images , status , phone , email,topics,cover) VALUES (? ,? ,? ,? ,? ,?,?,?,? ,? ,? ,? ,?, ?)");
							$stmt->execute(array($event_name , $description , $date , $end_date , $facebook , $registeration, $location , $category , $photos , $status , $phone , $email , $topics, $image_name));
							if($stmt->rowCount() > 0){
								$sel = $db->prepare("SELECT MAX(id) AS event_id FROM events LIMIT 1");
								$sel->execute();
								$fetch = $sel->fetch();
								$event_id = $fetch['event_id'];
								if($speakers != '0'){
									foreach($speakers as $speaker){
										$ins = $db->prepare("INSERT INTO events_speakers (event_id , speaker_id) VALUES (? , ?)");
										$ins->execute(array($event_id,$speaker));
									}
								}
								
								if($sponsors != '0'){
									foreach($sponsors as $sponsor){
										$ins = $db->prepare("INSERT INTO events_sponsorers (event_id , sponsor_id ) VALUES (? , ?)");
										$ins->execute(array($event_id,$sponsor));
									}
								}
								
							}
							
							$msg = '<div class="text-center alert alert-success">Event Inserted Successfully</div>';
							
							$msg = '';
							redirect('events.php', $msg , 5);
						}
						
						
					}
					
				}else{
					$msg = '<div class="text-center alert alert-danger">You Can\'t Access This Page Directly</div>';
					redirect('', $msg , 3);
				}
			
		}else if($do == 'edit'){
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				if(isset($_GET['item_id'])){
					$event_id = $_GET['item_id'];
					$count = countItems('events' , 'id' , ' WHERE id = ' . $event_id . '');
					if($count > 0){
						$stmt = $db->prepare("SELECT * FROM events WHERE id = ? LIMIT 1");
						$stmt->execute(array($event_id));
						$row = $stmt->fetch();
						extract($row);
						$images = explode("," , $images);
						$photo_key_input = "<input type='text'class='photo-key-genrate'name='photo-key'value='" . explode("ab78sawew4",$images[0])[0] . "' hidden>";
					?>
			<h1 class="text-center mt-4">Edit Event</h1>
			<div class="row mb-4 mt-4 prev_photos">
			<?php
				for($i = 0 ; $i < count($images)-1; $i++){
					$image = $images[$i];
			?>
				<div class="col-12 col-md-4 col-lg-3">
					<div class="img-prev position-relative">
						<div class="d-flex justify-content-center align-items-center position-absolute"style="width:100%;height:100%;color:#FFF;background-color:rgba(0,0,0,0.4)"><button data-src="<?php echo $image; ?>" data-id="<?php echo $event_id; ?>" class="delete-image confirm btn-sm btn btn-danger"><i class="fas fa-trash-alt"></i> DELETE</button></div>
						<img src="<?php echo '../uploaded_files/' . $image; ?>" class="img-fluid">
					</div>
				</div>
			<?php
				}
			?>
				
			</div>
			<script src="<?php echo $js . 'dropzone.js';?>"></script>
			<link rel="stylesheet" href="<?php echo $css . 'dropzone.css'; ?>">
			<div class="container">
				<input type="text"value="<?php echo $event_id; ?>" hidden />
				<div class="input-element photos-uploader mb-4">
					
					<form action="dropzone-upload.php" class="dropzone"id="dropzone"enctype="multipart/form-data">
						<?php
							echo $photo_key_input;
						?>
					</form>
					
				</div>
				
				
				<form action="events.php?do=insert" enctype="multipart/form-data" method="POST"class="new-item-form">
				<?php
					echo $photo_key_input;
				?>
			
					<div class="form-group row">
						<label for="userEmail" class="col-sm-2">Event Name</label>
						<div  class="col-sm-10  col-md-8 position-relative">
							<input name="event_name" type="text" placeholder="Event name..."  class="form-control" id="userEmail" required="" value="<?php echo $name; ?>">
							
						</div>
					</div>
					
					 <div class="form-group row">
						<label for="userNameEdit" class="col-sm-2">Description</label>
						<div  class="col-sm-10 col-md-8">
							<textarea class="form-control"placeholder="Event Description..." name="description" required=""><?php echo $description; ?></textarea>
						</div>
						
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Event Date</label>
						<div  class="col-sm-10  col-md-8">
							<input name="date" type="date" placeholder="category name..."  class="form-control" id="userEmails" required="" value="<?php echo $date; ?>">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Location</label>
						<div  class="col-sm-10  col-md-8">
							<input name="location" type="text" placeholder="Location of the event..."  class="form-control" id="userEmails" required="" value="<?php echo $location; ?>">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Category Name</label>
						<div  class="col-sm-10  col-md-8">
							<input name="category" type="text" placeholder="Category Name..."  class="form-control" id="userEmails" required="" value="<?php echo $category; ?>">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmailss" class="col-sm-2">Status</label>
						<div  class="col-sm-10  col-md-8">
							<select class="form-control"name="status" required="">
								
								<option value="0"<?php if($status == '0'){echo ' selected';} ?>>Upcoming</option>
								<option value="1"<?php if($status == '1'){echo ' selected';} ?>>Done</option>
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">phone Number</label>
						<div  class="col-sm-10  col-md-8">
							<input name="phone" type="text" placeholder="Phone Number..."  class="form-control" id="userEmails"value="<?php echo $phone; ?>">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Email </label>
						<div  class="col-sm-10  col-md-8">
							<input name="email" type="email" placeholder="Email Address..."  class="form-control" id="userEmails"value="<?php echo $email; ?>">
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmails" class="col-sm-2">Topics </label>
						<div  class="col-sm-10  col-md-8">
							<input name="topics" type="text" placeholder="Add topics split with ( , ) ex.( Design , Programming , Presentation )"  class="form-control" id="userEmails" value="<?php echo $topics; ?>">
							<p><small>Please Note That split between topics with the " , " sympol</small></p>
						</div>
					</div>
			
					<div class="form-group row">
						<label for="userEmailss" class="col-sm-2">Speakers</label>
						<div  class="col-sm-10  col-md-8">
							<select id="speakers-select" multiple="multiple" class="form-control"name="speakers[]" >
								<option value="0"disabled>select speakers...</option>
								<?php
									$speakers_array = array();
									$multi = $db->prepare("SELECT speakers.id,speakers.name,speakers.position FROM events_speakers JOIN speakers ON speakers.id = events_speakers.speaker_id
									JOIN events ON events.id = events_speakers.event_id
									WHERE events_speakers.event_id = ?");
									$multi->execute(array($event_id));
									if($multi->rowCount() > 0 ){
										
										$fetchmulti = $multi->fetchAll();
										foreach($fetchmulti as $mult){
											$speakers_array[] = $mult['id'];
									?>
									<option selected value="<?php echo $mult['id']; ?>"><?php echo $mult['name'] . " [ " . $mult['position'] . " ]"; ?></option>
									<?php
										}
									}
								
									$spek = $db->prepare("SELECT id,name,position FROM speakers");
									$spek->execute();
									$speks = $spek->fetchAll();
									foreach($speks as $sp){
										if(!in_array($sp['id'] , $speakers_array)){
								?>
									<option value="<?php echo $sp['id']; ?>"><?php echo $sp['name'] . " [ " . $sp['position'] . " ]"; ?></option>
								<?php
										}
									}
								?>
							</select>
							<p><small>Add more speakers From <a href="speakers.php?do=add">Here</a></small></p>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="userEmailss" class="col-sm-2">Sponsors</label>
						<div  class="col-sm-10  col-md-8">
							<select id="sponsors-select" multiple="multiple" class="form-control"name="sponsors[]" >
								<option value="0"disabled>select sponsors...</option>
								<?php
									$sponsors_array = array();
									$multi = $db->prepare("SELECT sponsors.id,sponsors.title FROM events_sponsorers JOIN sponsors ON sponsors.id = events_sponsorers.sponsor_id
									JOIN events ON events.id = events_sponsorers.event_id
									WHERE events_sponsorers.event_id = ?");
									$multi->execute(array($event_id));
									if($multi->rowCount() > 0 ){
										
										$fetchmulti = $multi->fetchAll();
										foreach($fetchmulti as $mult){
											$sponsors_array[] = $mult['id'];
									?>
									<option selected value="<?php echo $mult['id']; ?>"><?php echo $mult['title']; ?></option>
									<?php
										}
									}
								
									$spek = $db->prepare("SELECT id,title FROM sponsors");
									$spek->execute();
									$speks = $spek->fetchAll();
									foreach($speks as $sp){
										if(!in_array($sp['id'] , $sponsors_array)){
								?>
									<option value="<?php echo $sp['id']; ?>"><?php echo $sp['title']; ?></option>
								<?php
										}
									}
								?>
								
							</select>
							<p><small>Add more sponsors From <a href="sponsors.php?do=add">Here</a></small></p>
						</div>
					</div>
					
					
					
					<button type="submit" class=" btn-block mb-4 btn btn-primary">Submit</button>
					
					
				</form>
				
			
			</div>
					<?php
					}else{
					$msg = '<div class="text-center alert alert-danger">Event Not Found</div>';
					redirect('', $msg , 3);
					}
				}else{
					$msg = '<div class="text-center alert alert-danger">Event Not Found</div>';
					redirect('', $msg , 3);
				}
			}else{
				$msg = '<div class="text-center alert alert-danger">You Can\'t Access This Page Directly</div>';
				redirect('', $msg , 3);
			}
			
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
<script src="layout/js/jquery.multi-select.js"></script>
<script src="layout/js/jquery.quicksearch.js"></script>
<script>
	$(document).ready(function(){
		$('#speakers-select,#sponsors-select').multiSelect({
  selectableHeader: "<input type='text' class='form-control mb-2 search-input' autocomplete='off' placeholder='Search ...'>",
  selectionHeader: "<input type='text' class='form-control mb-2 search-input' autocomplete='off' placeholder='Search ...'>",
  afterInit: function(ms){
    var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
    .on('keydown', function(e){
      if (e.which === 40){
        that.$selectableUl.focus();
        return false;
      }
    });

    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
    .on('keydown', function(e){
      if (e.which == 40){
        that.$selectionUl.focus();
        return false;
      }
    });
  },
  afterSelect: function(){
    this.qs1.cache();
    this.qs2.cache();
  },
  afterDeselect: function(){
    this.qs1.cache();
    this.qs2.cache();
  }
});
	});
	
	
	
	$(".delete-image").click(function(){
		var image_src = $(this).attr("data-src"),
			event_id = $(this).attr("data-id");
		
		$.ajax({
			url:	"delete_event_photo.php",
			method:	"POST",
			dataType:	"text",
			context: this,
			data:	{event_id:event_id,image_src:image_src},
			success:function(text){
				if(text.indexOf("success") >= 0){
					$(this).parent().parent().parent().remove();
				}else{
					$(this).replaceWith("<p>" + text + "</p>");
				}
			}
			
		});
	});
	
</script>