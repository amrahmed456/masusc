<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>QR Code Checker</title>
		<link rel="stylesheet"href="css/bootstrap.min.css">
		<style>
			*{
				margin:0px;
				padding:0px
			}
			.full-screen{
				display:flex;
				justify-content:center;
				align-items:center;
				width:100%;
				background:#EEE
			}
			.sub-full{
				padding:40px 20px;
				border-radius:5px;
				box-shadow:2px 3px 12px #DDD;
				background-color:#FFF;
				min-width:80%;
			}
			.sub-full h2,h3{
				margin-bottom:8px
			}
			img{
				width: 210px;
				margin: auto;
				display: block;
			}
			h2{
				color:#535353
			}
			.text-center{text-align:center}
			.text-small{font-size:15px;font-style:italic}
			.line,.text-small{display:inline}
			.ticket-no div{
				width: 70px;
				height: 70px;
				border-radius: 50%;
				margin: 20px auto;
				background:#14B906;
				color:#FFF;
				font-size: 19px;
				font-weight: bold;
			}
			.status-img{width:50px}
			.my-status img{width:25px}
			.my-status{bottom:0px;right:45%}
		</style>
		
	</head>
	<body>
	<div class="full-screen" id="full">
		<div class="sub-full text-center">
<?php
	
	if(isset($_GET['id'])){
		
		$ticket_id = $_GET['id'];
		require_once 'db_connection.php';
		$stmt = $db->prepare("SELECT name,faculty,grade,university,email,phone,facebook,comments,status FROM cdc WHERE ticket_id = ? LIMIT 1");
		$stmt->execute(array($ticket_id));
		if($stmt->rowCount() > 0){
			// ticket found
			$row = $stmt->fetch();
			extract($row);
			if($status == '1'){
				// verified ticket
			?>
				
				<div class="ticket-no">
					<div class="d-flex justify-content-center align-items-center">
						<p class="number mb-0"><?php echo $ticket_id; ?></p>
					</div>
				</div>
				
				<h2><?php echo $name; ?></h2>
				<h3><?php echo $faculty . " (" . $grade . "), " . $university; ?></h3>
				<h3><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></h3>
				<h3><?php echo $phone; ?></h3>
				<a target="_blank" href="<?php echo $facebook; ?>" ><img src="imgs/facebook.png" style="width:32px"/></a>
				<br>
				<?php if(strlen(trim($comments)) > 0){
					echo '<p style="font-style:italic;font-size:15px;color:#8F8E8E">" ' . $comments . ' "</p><br><br>';
				}
				?>
				
				<div class="row" data-toggle="modal" data-target="#exampleModal">
					<div class="col">
						<div class="attend-reg position-relative">
							<img src="imgs/attendant-list.png" class="img-fluid status-img" />
							<div class="attendance-status position-absolute my-status">
								<img class="status-status" src="imgs/loading.gif" />
							</div>
							
						</div>
						<p class="text-center">Attendance</p>
					</div>
					
					<div class="col">
						<div class="package-reg">
							<div class="position-relative">
								<img src="imgs/box.png" class="img-fluid status-img" />
								<div class="package-status position-absolute my-status">
									<img class="status-status" src="imgs/loading.gif" />
								</div>
								
							</div>
							<p class="text-center">Package</p>
						</div>
					</div>
					
					<div class="col">
						<div class="lunch-reg">
							<div class="position-relative">
								<img src="imgs/lunch.png" class="img-fluid status-img" />
								<div class="lunch-status position-absolute my-status">
									<img class="status-status" src="imgs/loading.gif" />
									
								</div>
								
							</div>
							<p class="text-center">Lunch</p>
						</div>
					</div>
				</div>
				
				<div class="mt-4">
					<img class="line" src="imgs/verified.png" style="width:20px"><span class="text-small"> Verified</span>
				</div>
				
				
				
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Attendance Status</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						
						<div class="statistics">
							<div class="row">
								<div class="col">
									<div class="attend-reg position-relative">
										<img src="imgs/attendant-list.png" class="img-fluid status-img" />
										<div class="attendance-status position-absolute my-status">
											<img class="status-status" src="imgs/wrong.png" />
										</div>
										
									</div>
									<p class="text-center">Attendance</p>
								</div>
								
								<div class="col">
									<div class="package-reg">
										<div class="position-relative">
											<img src="imgs/box.png" class="img-fluid status-img" />
											<div class="package-status position-absolute my-status">
												<img class="status-status" src="imgs/wrong.png" />
											</div>
											
										</div>
										<p class="text-center">Package</p>
									</div>
								</div>
								
								<div class="col">
									<div class="lunch-reg">
										<div class="position-relative">
											<img src="imgs/lunch.png" class="img-fluid status-img" />
											<div class="lunch-status position-absolute my-status">
												<img class="status-status" src="imgs/wrong.png" />
											</div>
											
										</div>
										<p class="text-center">Lunch</p>
									</div>
								</div>
							</div>
							
							<div class="password mt-4">
								<input type="password" class="text-center input-pass form-control" placeholder="type password here...">
								<button class="mt-2 btn-block btn btn-primary submit-login">LOGIN</button>
								<div class="alert alert-danger text-center slide-up pass-error mt-2"></div>
							</div>
						</div>
						
						<div class="slide-up dashboard">
							<div class="row">
								<div class="col-12 col-md-4 mb-4">
									<div class="attend-reg position-relative">
										<img src="imgs/attendant-list.png" class="img-fluid status-img" />
										<div class="attendance-status position-absolute my-status">
											<img class="status-status" src="imgs/wrong.png" />
										</div>
									</div>
									<p class="text-center">Attendance</p>
									<div class="mt-2 btn-check attend-check">
										
									</div>
								</div>
								
								<div class="col-12 col-md-4 mb-4">
									<div class="package-reg">
										<div class="position-relative">
											<img src="imgs/box.png" class="img-fluid status-img" />
											<div class="package-status position-absolute my-status">
												<img class="status-status" src="imgs/wrong.png" />
											</div>
										</div>
										<p class="text-center">Package</p>
										<div class="mt-2 btn-check package-check">
										
										</div>
									</div>
								</div>
								
								<div class="col-12 col-md-4 mb-4">
									<div class="lunch-reg">
										<div class="position-relative">
											<img src="imgs/lunch.png" class="img-fluid status-img" />
											<div class="lunch-status position-absolute my-status">
												<img class="status-status" src="imgs/wrong.png" />
											</div>
										</div>
										<p class="text-center">Lunch</p>
										<div class="mt-2 btn-check lunch-check">
										
										</div>
									</div>
								</div>
							</div>
						</div>
						
					  </div>
					  
					</div>
				  </div>
				</div>
				
				
			<?php
				
			}else if($status == '0'){
				// not verified ticket
				
			?>
				<img src="imgs/under-review.png" />
				<h2><?php echo $name; ?></h2>
				<h3><?php echo $faculty . " (" . $grade . ")," . $university; ?></h3>
				<h3><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></h3>
				<h3><?php echo $phone; ?></h3>
				<a target="_blank" href="<?php echo $facebook; ?>" ><img src="imgs/facebook.png" style="width:32px"/></a>
				<br>
				<?php if(strlen(trim($comments)) > 0){
					echo '<p style="font-style:italic;font-size:15px;color:#8F8E8E">" ' . $comments . ' "</p><br><br>';
				}
				?>
				
				<img class="line" src="imgs/rejected.png" style="width:20px"><span class="text-small"> Not Verified</span>
			<?php
				
			}else if($status == '2'){
				// rejected ticket
			?>
				<img src="imgs/not-found.png" />
				<h2><?php echo $name; ?></h2>
				<h2 style="text-align:center">Ticket ( <?php echo $ticket_id; ?> ) Rejected.</h2>
				<p style="font-style:italic;font-size:15px;color:#8F8E8E">" <?php echo $comments; ?> "</p>
				<br>
				<br>
				<img class="line" src="imgs/rejected.png" style="width:20px"><span class="text-small"> Rejected</span>
			<?php
			}
			
		}else{
			// ticket not found
		?>
			<img src="imgs/not-found.png" />
			<h2 style="text-align:center">Ticket ( <?php echo $ticket_id; ?> ) Not Found.</h2>
		<?php
			
		}
		
		
	}else{
		?>
			<img src="imgs/not-found.png" />
			<h2 style="text-align:center">Qr code is corrupted.</h2>
		<?php
	}
	
?>
		</div>
	</div>
	
	<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js"></script>
		<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-auth.js"></script>
		<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-firestore.js"></script>

		<!-- TODO: Add SDKs for Firebase products that you want to use
			 https://firebase.google.com/docs/web/setup#config-web-app -->

		<script>
		  // Your web app's Firebase configuration
		  var firebaseConfig = {
			apiKey: "AIzaSyBYx52Ce5j9zuem7p7p2H3ig0iiD_Leuzk",
			authDomain: "test-456789.firebaseapp.com",
			databaseURL: "https://test-456789.firebaseio.com",
			projectId: "test-456789",
			storageBucket: "test-456789.appspot.com",
			messagingSenderId: "787061937512",
			appId: "1:787061937512:web:e84da515f1f422ba"
		  };
		  // Initialize Firebase
		  firebase.initializeApp(firebaseConfig);
		  
		  // make auth and db refrences
		  const auth = firebase.auth();
		  const db	= firebase.firestore();
		  
		</script>
	
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>