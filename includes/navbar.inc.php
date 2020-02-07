</head>
	<body>
		<!-- preloader -->
		<div class="preloader"id="preloader">
			<div class="inerload d-flex justify-content-center align-items-center">
				<div class="loader">
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>
		</div>
		<script>
			var winH = window.innerHeight;
			var el = document.getElementById("preloader");
			el.style.height = winH + "px";
		</script>
		<!-- end preloader -->
	
	<!-- start to top arrow key -->
	<div class="to_top to_top_bottom">
		<i class="fas fa-arrow-up"></i>
	</div>
	<!-- end to to top arrow key -->
	
	<!-- start navbar -->
		<div class="navbar very-top">
			<div class="container">
				<a href="index.php"><img src="imgs/ma-logo.png"class="img-fluid" /></a>
				<div class="menu-spanner">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
		</div>
		
		<div class="side-navigation">
			
			<div class="side-list">
				<img src="imgs/ma-logo.png"class="img-fluid d-block m-auto" />
				
				<ul class="list-unstyled font">
					<a href="index.php">
						<li class="lead <?php if($page_title == 'MASUSC | #GoBeyondLimits'){echo 'selected';}?>"><i class="fas fa-home mr-3"></i> HOME</li>
					</a>
					<a href="events.php">
						<li class="lead <?php if($page_title == 'Events | MASUSC'){echo 'selected';}?>"><i class="fas fa-calendar-alt mr-3"></i> EVENTS</li>
					</a>
					<a href="magazines.php">
						<li class="lead <?php if($page_title == 'MA MAGAZINES'){echo 'selected';}?>"><i class="fas fa-book-open mr-3"></i> MAGAZINES</li>
					</a>
					<a href="blog.php">
						<li class="lead <?php if($page_title == 'MA Blog'){echo 'selected';}?>"><i class="fab fa-blogger-b mr-3"></i> BLOG</li>
					</a>
					<a href="team.php">
						<li class="lead <?php if($page_title == 'TEAM | MASUSC'){echo 'selected';}?>"><i class="fa fa-users mr-3"></i> TEAM</li>
					</a>
					<a href="about.php">
						<li class="lead <?php if($page_title == 'ABOUT | MASUSC'){echo 'selected';}?>"><i class="fas fa-info-circle mr-3"></i> ABOUT</li>
					</a>
				</ul>
				
				<div class="social-btns">
					<a class="btn facebook" href="#"><i class="icon fab fa-facebook-f"></i></a>
					<a class="btn linkedin" href="#"><i class="icon fab fa-linkedin-in"></i></a>
					<a class="btn twitter" href="#"><i class="icon fab fa-twitter"></i></a>
					<a class="btn instagram" href="#"><i class="icon fab fa-instagram"></i></a>
				</div>
				
			</div>
			
		</div>
		
	<!-- end navbar -->