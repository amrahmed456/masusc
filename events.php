<?php
	$page_title = 'Events | MASUSC';
	require_once 'includes/head.inc.php';
?>
		<link rel="stylesheet" href="css/owl.carousel.min.css" />
		<link rel="stylesheet" href="css/owl.theme.default.min.css" />
		<link rel="stylesheet"href="css/events.css">
	
<?php
	require_once 'includes/navbar.inc.php';
?>
	<div class="top-talk padd">
		<div class="overlay"></div>
		<div class="container">
			<h1 class="font">EVENTS</h1>
			<p>Stay tuned for our events past and previous</p>
		
		</div>
		<div class="slope">
			<svg version="1.1" class="bg-white-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 5492.1021 581.185" enable-background="new 0 0 5492.1021 581.185" xml:space="preserve">
			  <path d="M5492.1021,0v581.185H0.0054c-0.0068,0-0.0073-0.01-0.0006-0.0107L5492.1021,0z"></path>
			</svg>
		</div>
		
	</div>
	<?php
		require_once 'db_connection.php';
		$upcoming = $db->prepare("SELECT id,name,description,location,cover,date,category FROM events WHERE status = '0' OR status = '2'");
		$upcoming->execute();
		$rows = $upcoming->fetchAll();
		if($upcoming->rowCount() > 0){
		?>
		<div class="upcoming-events padd">
		<div class="container-fluid">
		
			<div class="upcoming-talk text-center">
				<h1 class="font">Cuurent & Upcoming <span class="styled-font">Events</h1>
				
				<div class="seprator">
					<i class="fas fa-calendar-alt"style="color:#eaeaea;background:white;font-size:25px;transform:translateY(-10px);width:60px"></i>
				</div>
				
				<p class="lead">you can find the upcoming events in this section</p>
			</div>
			
			<div class="upcoming-event-container">
				<div class="owl-carousel upcoming-owl owl-theme">
		<?php
			foreach($rows as $row){
				extract($row);
				$image = 'uploaded_files/' . $cover;
		?>
		<div class="item">
					<a href="event.php?p=<?php echo $id; ?>">
						<div class="event">
						
							<div class="top-photo">
								<img src="<?php echo $image; ?>">
							</div>
							
							<div class="event-details">
								<h3><?php echo $name; ?></h3>
								<div class="spec">
									<span class="category"><?php echo $category; ?></span>
									<span class="lead"><i class="fas fa-calendar-alt"style="font-size:15px;color:#ff8588"></i> <?php echo $date; ?></span>
								</div>
								
								<p class="lead details-talk">
									<?php echo $description; ?>
								</p>
								
								<div class="icons">
									<span class="more-inf"><i class="fas fa-map-marker-alt"style="color:#ff8588"></i> <?php echo $location; ?></span>
								</div>
							</div>
							
						</div>
					</a>
					</div>
		<?php
			}
		?>
			</div>
		</div>
	</div>
	</div>
		<?php
		}
	?>

					
	<?php 
		if($upcoming->rowCount() > 0){
	?>
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
		}
		
		$stmt = $db->prepare("SELECT DISTINCT category FROM events WHERE status = '1'");
		$stmt->execute();
		$rows = $stmt->fetchAll();
		if($stmt->rowCount() > 0){
			
	?>
	<div class="prev-events padd">
		<div class="container">
			
			<h1 class="font text-center">Explore <span class="styled-font">More Events</span></h1>
			<p class="lead text-center">you can explore more events by category</p>
			
			<ul class="list-unstyled">
			<li class="active" data-filter="all">ALL</li>
	<?php
		foreach($rows as $row){
			extract($row);
	?>
		<li data-filter=".<?php echo $category; ?>"><?php echo $category; ?></li>
	<?php
		}
	?>
		</ul>
		<div class="row mixes">
	<?php
		$stmt = $db->prepare("SELECT id,name,description,location,date,category,cover FROM events WHERE status = '1'");
		$stmt->execute();
		$rows = $stmt->fetchAll();
		foreach($rows as $row){
			$category = str_replace(" " , "_" , $category);
			extract($row);
			$image = 'uploaded_files/' . $cover;
	?>
	<div class="col-12 col-md-4 mix <?php echo $category; ?> event-tt">
					<a href="event.php?p=<?php echo $id; ?>">
						<div class="event-cnt">
							<div class="event-thumb">
							
								<div class="top-photo">
									<img src="<?php echo $image; ?>" />
								</div>
								
								<div class="overlay">
									<div class="type lead">
										<?php echo $category; ?>
									</div>
									<div class="overlay-child text-center d-flex justify-content-center align-items-center">
										<div class="event-name">
											<h2 class="font"><b><?php echo $name; ?></b></h2>
										</div>
									</div>
								</div>
							</div>
							<div class="event-details">
								<span class="float-right"><span class="lead"><i class="fas fa-calendar-alt"style="font-size:15px;color:#ff8588"></i> <?php echo $date; ?></span></span>
								<h3><?php echo $name; ?></h3>
								
								
								<p class="lead details-talk">
									<?php echo $description; ?>
								</p>
								
								<div class="icons">
									<span class="more-inf"><i class="fas fa-map-marker-alt"style="color:#ff8588"></i> <?php echo $location; ?></span>
								</div>
							</div>
						</div>
					</a>
				</div>
	<?php
		}
	?>
			</div>
			
			
		</div>
	</div>
	<?php
		}
	?>
	
	<?php 
		if($upcoming->rowCount() == 0){
	?>
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
		}
	?>
	


<?php
	require_once 'includes/footer.inc.php';
?>
<script src="js/owl.carousel.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/events.js"></script>