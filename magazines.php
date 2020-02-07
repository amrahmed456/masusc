<?php
	$page_title = 'MA MAGAZINES';
	require_once 'includes/head.inc.php';
?>
<link rel="stylesheet"href="css/magazines.css">
<?php
	require_once 'includes/navbar.inc.php';
	require_once 'db_connection.php';
?>
	<div class="padd top-hero text-center">
		<h1 class="font">READ,LEARN AND SPREAD YOUR IDEAS</h1>
		<p class="lead">Devlope skills through technical,non-technical topics and discussions found in our magazines</p>
	</div>
	
	<div class="main padd">
		<div class="container">
			<div class="row">
			<?php
				$stmt = $db->prepare("SELECT id,name,image FROM magazines");
				$stmt->execute();
				if($stmt->rowCount() > 0 ){
					$rows = $stmt->fetchAll();
					foreach($rows as $row){
						extract($row);
				?>
				<div class="col-12 col-md-4 col-lg-3 mb-4">
					<div class="magazine"title="<?php echo $name; ?>">
						<a href="magazine.php?id=<?php echo $id; ?>">
							<div>
								<div class="img-cont">
									<img src="uploaded_files/<?php echo $image; ?>" class="img-fluid">
								</div>
								
							</div>
						</a>
					</div>
				</div>
				<?php
					}
				}
			?>
				
				
				
				
				
			</div>
		</div>
	</div>
	
	
	
	<div class="subscribe padd">
		<div class="container">
			<h1 class="font text-center">SUBSCRIBE FOR <span class="styled-font">LATEST EVENTS</span></h1>
			<p class="font text-center">get notified to latest and upcoming events to stay tuned and closer</p>
			
			
			<div class="prespective-subscribe container position-relative">
				
							<div class="prespective-subscribe">
								<div class="email-container first_subscribe_div position-absolute">
									<input type="email" placeholder="Email Address..." class="form-control">
									<button class="send-subscribe-email rotate-x"><i class="fas fa-paper-plane "style="color:white"></i></button>
								</div>
								
								<div class="faculty_subscribe position-relative email-container">
									<input type="text" placeholder="Faculty Name..." class="form-control">
									<button class="send-subscribe-faculty"><i class="fas fa-paper-plane "></i></button>
								</div>
							</div>
					
						
						</div>
			
			
			
			<div class="sub-result text-center"></div>
		</div>
	</div>
	
<?php
	require_once 'includes/footer.inc.php';
?>