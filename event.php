<?php
	if(isset($_GET['p'])){
		$event_id = $_GET['p'];
		require_once 'db_connection.php';
		$stmt = $db->prepare("SELECT name,description,date,end_date,cover,registeration,facebook,location,category,images,status,phone,email,topics FROM events WHERE id = ? LIMIT 1");
		$stmt->execute(array($event_id));
		$row = $stmt->fetch();
		if($stmt->rowCount() > 0){
			extract($row);
			$page_title = $name;
			require_once 'includes/head.inc.php';
			$images = explode("," , $images);
			if($status == '0'){
				$status = 'Upcoming';
			}else if($status == '1'){
				$status = 'Past Event';
			}else if($status == '2'){
				$status = 'Currently Running';
			}
	
?>
	<link type="text/css" href="css/skitter.css" media="all" rel="stylesheet" />
	<link type="text/css" href="css/jquery.fancybox.min.css" media="all" rel="stylesheet" />
	<link rel="stylesheet"href="css/events.css">
	<link rel="stylesheet"href="css/event.css">
	
<meta property="og:url"           content="<?php echo 'url?p=' . $event_id; ?>"  />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="<?php echo $page_title; ?>" />
<meta property="og:description"   content="<?php echo $description; ?>" />
<meta property="og:image"         content="<?php echo 'url/' . $cover; ?>" />
<meta property="og:image:width" content="100" />
<meta property="og:image:height" content="100" />
	
	
<?php
	require_once 'includes/navbar.inc.php';
?>

	<div class="top-hero padd"style='background:url("uploaded_files/<?php echo $cover; ?>") no-repeat top center fixed;background-size: cover;'>
		<div class="overlay"></div>
		<div class="container position-relative text-center">
			<h1 class="font"><?php echo $name; ?></h1>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
		
			<div class="col-12 col-lg-8">
				<div class="event-full">
					<div class="imgs-slider">
						<div class="slider">
							<div class="skitter skitter-large">
							  <ul>
							<?php
								for($i = 0 ; $i < count($images)-1 ; $i++){
							?>
								<li>
								  <a href="uploaded_files/<?php echo $images[$i]; ?>" data-fancybox="gallery"><img src="uploaded_files/<?php echo $images[$i]; ?>" class="random" /></a>
								  
								</li>
							<?php
								}
							?>
							  </ul>
							</div>
						</div>
					</div>
					
					<div class="event-talk">
						<p class="lead">
							<?php echo $description; ?>
						</p>
						
					<?php
						
						if(strlen($topics) > 0){
							$topics = explode("," , $topics);
					?>
						<div class="topics-discuessed">
							<h3 class="font">Topics</h3>
							<?php
								for($i = 0 ; $i < count($topics) ; $i++){
							?>
									<span><?php echo $topics[$i]; ?></span>
							<?php
								}
							?>
						</div>
					<?php
						}
					?>
						
						
						<div class="share">
							<h3 class="font">Share this event</h3>
							<div class="container">
								<div class="a2a_kit a2a_kit_size_32 a2a_default_style mb-2">
									<a class="a2a_button_facebook a2a_counter"></a>
									<a class="a2a_button_twitter mb-2"></a>
									<a class="a2a_button_linkedin mb-2"></a>
									<a class="a2a_button_whatsapp mb-2"></a>
								</div>
							</div>
							<script async src="https://static.addtoany.com/menu/page.js"></script>
						</div>
					</div>
					
				</div>
				
				<?php
					$speakers = $db->prepare("SELECT speakers.name,speakers.position,speakers.description,speakers.image FROM events_speakers JOIN speakers ON events_speakers.speaker_id = speakers.id
					JOIN events ON events_speakers.event_id = events.id
					WHERE events_speakers.event_id = ?");
					$speakers->execute(array($event_id));
					if($speakers->rowCount() > 0){
					?>
					<div class="speakers padd">
						<h2 class="font text-center">Speakers</h2>
						<div class="container">
							<div class="row">
					<?php
						$speakersFetch = $speakers->fetchAll();
						foreach($speakersFetch as $speaker){
					?>
						<div class="col-12 col-md-6">
							<div class="speaker">
								<img src="uploaded_files/<?php echo $speaker['image']; ?>">
								<div class="overlay">
									<h3 class="font"><?php echo $speaker['name']; ?></h3>
									<p><?php echo $speaker['position']; ?></p>
									<span><?php echo $speaker['description']; ?></span>
								</div>
							</div>
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
						
						
				
			</div>
			
			<div class="col-12 col-lg-4">
				<div class="position-sticky"style="top:60px;margin-bottom: 35px;">
			
					<div class="event-detail">
						<div class="card-top">
					
							<h3 class="font d-inline">Event Details</h3>
						
						</div>
						<ul class="list-unstyled">
							
							<?php
							
								if($date != $end_date){
								?>
								<li>
									<div class="icon d-inline-block">
										<i class="fas fa-calendar-alt fa-2x"></i>
									</div>
									<div class="info d-inline-block">
										<p class="inf">Start Date</p>
										<p class="inf-ans lead"><?php echo $date; ?></p>
									</div>
								</li>
								<li>
									<div class="icon d-inline-block">
										<i class="fas fa-calendar-alt fa-2x"></i>
									</div>
									<div class="info d-inline-block">
										<p class="inf">End Date</p>
										<p class="inf-ans lead"><?php echo $end_date; ?></p>
									</div>
								</li>
								<?php
								}else{
								?>
									<li>
										<div class="icon d-inline-block">
											<i class="fas fa-calendar-alt fa-2x"></i>
										</div>
										<div class="info d-inline-block">
											<p class="inf">Date</p>
											<p class="inf-ans lead"><?php echo $date; ?></p>
										</div>
									</li>
								<?php
								}
							
							?>
							<li>
								<div class="icon d-inline-block">
									<i class="fas fa-step-forward fa-2x"></i>
								</div>
								<div class="info d-inline-block">
									<p class="inf">status</p>
									<p class="inf-ans lead"><?php echo $status; ?></p>
								</div>
							</li>
							
							<li>
								<div class="icon d-inline-block">
									<i class="fas fa-compass fa-2x"></i>
								</div>
								<div class="info d-inline-block">
									<p class="inf">Location</p>
									<p class="inf-ans lead"><?php echo $location; ?></p>
								</div>
							</li>
							
							<li>
								<div class="icon d-inline-block">
									<i class="fas fa-folder-open fa-2x"></i>
								</div>
								<div class="info d-inline-block">
									<p class="inf">category</p>
									<p class="inf-ans lead"><?php echo $category; ?></p>
								</div>
							</li>
							<?php 
								if(strlen($phone) >= 11){
							?>
							<li>
								<div class="icon d-inline-block">
									<i class="fas fa-phone fa-2x"></i>
								</div>
								<div class="info d-inline-block">
									<p class="inf">phone</p>
									<p class="inf-ans lead"><?php echo $phone; ?></p>
								</div>
							</li>
							<?php
								}
								if(strlen($email) > 3){
							?>
							<li>
								<div class="icon d-inline-block">
									<i class="fas fa-envelope fa-2x"></i>
								</div>
								<div class="info d-inline-block">
									<p class="inf">email</p>
									<p class="inf-ans lead"><a href="mailto:<?php echo $email; ?>" ><?php echo $email; ?></a></p>
								</div>
							</li>
							<?php
								
								}
								if(strlen($facebook) > 5){
							?>
							<li>
								<div class="icon d-inline-block">
									<i class="fab fa-facebook fa-2x"></i>
								</div>
								<div class="info d-inline-block">
									<p class="inf">event on facebook</p>
									<p class="inf-ans lead"><a target="_blank" href="<?php echo $facebook; ?>"><?php echo $name; ?><a></p>
								</div>
							</li>
							<?php
								}if($status == 'Upcoming' && strlen($registeration) > 5){
							?>
							<li>
								<div class="icon d-inline-block">
									<i class="fas fa-receipt fa-2x"></i>
								</div>
								<div class="info d-inline-block">
									<p class="inf">Registration</p>
									<p class="inf-ans lead"><a target="_blank" href="<?php echo $registeration; ?>"><button class="btn btn-primary btn-sm">Register Now</button><a></p>
								</div>
							</li>
							<?php
								}
							?>
							
							
						</ul>
						
					</div>
					
					
					
					<?php
					$sponsors = $db->prepare("SELECT sponsors.id,sponsors.title,sponsors.image FROM events_sponsorers JOIN sponsors ON events_sponsorers.sponsor_id = sponsors.id
					JOIN events ON events_sponsorers.event_id = events.id
					WHERE events_sponsorers.event_id = ?");
					$sponsors->execute(array($event_id));
					if($sponsors->rowCount() > 0){
					?>
					<div class="sponsores">
						<div class="card-top">
								<h3 class="font d-inline">Sponsors</h3>
						</div>
						<div class="container">
							<div class="row">
					<?php
						$sponsorsFetch = $sponsors->fetchAll();
						foreach($sponsorsFetch as $sponsor){
					?>
						<div class="col-6">
							<div class="sponser d-flex justify-content-center align-items-center">
								<img src="uploaded_files/<?php echo $sponsor['image']; ?>" title="<?php echo $sponsor['title']; ?>">
							</div>
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
					
					
								
								
					</div>
				</div>
				
			</div>
		
		</div>
	</div>
	
	<div class="container">
				<div id="disqus_thread"></div>
		<script>

		/**
		*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
		*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
		
		var disqus_config = function () {
		this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
		this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
		};
		
		(function() { // DON'T EDIT BELOW THIS LINE
		var d = document, s = d.createElement('script');
		s.src = 'https://https-www-talebshaqa-com.disqus.com/embed.js';
		s.setAttribute('data-timestamp', +new Date());
		(d.head || d.body).appendChild(s);
		})();
		</script>
		<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
					
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
	$stmt = $db->prepare("SELECT id,name,description,location,date,category,cover FROM events WHERE ( category = ? OR location = ? ) AND ( id != ? ) LIMIT 3");
		$stmt->execute(array($category , $location , $event_id));
		if($stmt->rowCount() > 0){
	?>
	<div class="prev-events upcoming-events padd">
		
		<div class="container">
		
			<div class="upcoming-talk text-center">
				<h1 class="font">Related <span class="styled-font">Events</h1>
				
				<div class="seprator">
					<i class="fas fa-calendar-alt"style="color:#eaeaea;background:transparent;font-size:25px;transform:translateY(-10px);width:60px"></i>
				</div>
				
				<p class="lead">You might also love these events.</p>
			</div>
			
			<div class="upcoming-event-container">
			<div class="row">
	<?php
		
		$rows = $stmt->fetchAll();
		foreach($rows as $row){
			extract($row);
			$image = 'uploaded_files/' . $cover;
			
		
	?>
					<div class="col-12 col-md-4 mix Technical event-tt">
						<a href="event.php?p=<?php echo $id; ?>">
							<div class="event-cnt">
								<div class="event-thumb">
								
									<div class="top-img">
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
									<h3><?php echo $name; ?></h3>
									<div class="spec">
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
				
		
	</div>
	</div>


<?php
	require_once 'includes/footer.inc.php';
		}else{
			header("Location: events.php");
			exit();
		}
	}else{
		header("Location: events.php");
		exit();
	}
?>

<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.skitter.min.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="js/event.js"></script>
<script type="text/javascript" src="js/email_subscribe.js"></script>