<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
	  <a class="navbar-brand" href="dashboard.php"><?php echo lang('dashboard_home'); ?></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav">
		
		   <li class="nav-item">
			<a class="nav-link" href="articles.php">Blog Articles</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="sponsors.php">Sponsors</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="speakers.php">Speakers</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="events.php">Events</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="magazines.php">Magazines</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="subscriptions.php">Emails</a>
		  </li>
		</ul>
		<ul class="navbar-nav ml-auto">
		  <li class="nav-item dropdown ml-auto">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  <?php echo $_SESSION['user_name']; ?>
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			  <a class="dropdown-item" href="users.php?do=edit&user_id=<?php echo $_SESSION['user_id'];?>">Edit Profile</a>
			  <div class="dropdown-divider"></div>
			  <a class="dropdown-item" href="logout.php">SignOut</a>
			</div>
		  </li>
		
		</ul>
	   
	  </div>
  </div>
</nav>