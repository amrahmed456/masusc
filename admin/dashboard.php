<?php
	session_start();
	$pageTitle = 'Jsouq | Dashboard';
	
	
	
	// check if admin is logged in
	if(isset($_SESSION['user_type'])){
		if($_SESSION['user_type'] != '1'){
			// admin not logged in
			// admins only will have type of (1) session value
			header("Location: index.php");
			exit();
		}
	}else{
		header("Location: index.php");
		exit();
	}
	
	include 'init.inc.php';
	
	
?>

<!-- start dashboard -->
<div class="container">


	<h1 class="text-center mb-4 mt-4">Dashboard</h1>
	<div class="row">
		
		<div class="col-12 col-md-6 col-lg-3 mb-4">
			<a href="articles.php?do=Manage">
				<div class="text-center stats st-items">
					<i class="fa fa-scroll fa-4x position-absolute"style="top:25px;left:10px;opacity:0.5"></i>
					<p class="lead">Total articles</p>
					<h3><?php echo countItems('articles' , 'item_id', ' WHERE approval = "1"'); ?></h3>
				</div>
			</a>
		</div>
		
		<div class="col-12 col-md-6 col-lg-3 mb-4">
			<a href="articles.php?do=Manage">
				<div class="text-center stats st-pending">
					<i class="fa fa-tags fa-4x position-absolute"style="top:25px;left:10px;opacity:0.5"></i>
					<p class="lead">Pending articles</p>
					<h3><?php echo countItems('articles' , 'item_id', ' WHERE approval = "0"'); ?></h3>
				</div>
			</a>
		</div>
		
		<div class="col-12 col-md-6 col-lg-3 mb-4">
			<a href="events.php?do=Manage">
				<div class="text-center stats st-pending">
					<i class="fa fa-globe-europe fa-4x position-absolute"style="top:25px;left:10px;opacity:0.5"></i>
					<p class="lead">Events</p>
					<h3><?php echo countItems('events' , 'id', ''); ?></h3>
				</div>
			</a>
		</div>
		
		<div class="col-12 col-md-6 col-lg-3 mb-4">
			<a href="subscriptions.php?do=Manage">
				<div class="text-center stats st-pending">
					<i class="fa fa-globe-europe fa-4x position-absolute"style="top:25px;left:10px;opacity:0.5"></i>
					<p class="lead">Subscribed Emails</p>
					<h3><?php echo countItems('email_subscribe' , 'email', ''); ?></h3>
				</div>
			</a>
		</div>
		
	</div>
	
	
	<div class="row">
	
		<div class="col-12 col-md-6 mb-4">
			<div class="pan">
				<div class="card">
				  <div class="card-header">
					<i class="fas fa-scroll"></i> Latest articles
					<span class="float-right expand-lateset"style="cursor:pointer">
						<i class="fa fa-plus"></i>
					</span>
				  </div>
				  <ul class="list-group list-group-flush">
					<?php
						$latest = getLatestItems('articles' , 'articles.name,articles.item_id,articles.approval,categories.name AS cat_name' , 'JOIN categories ON categories.cat_id = articles.cat_id' , 'item_id' , 5);
						if(count($latest) == 0){
							// no users found
							echo '<li class="list-group-item">No articles Were Found.</li>';
						}else{
							// there are users found
							foreach($latest as $row){
						?>
							<li class="list-group-item">
								<span><?php echo $row['name'] . ' [ ' . $row['cat_name'] . ' ]'; ?></span>
							<?php
								if($row['approval'] == 0){
									// user needs approval
							?>
								<a href="articles.php?do=approve&item_id=<?php echo $row['item_id']; ?>" class="btn btn-success float-right ml-2 btn-sm"><i class="fas fa-plug"></i> Approve</a>
							<?php
							?>
							
							<?php
								}
							?>
								<a href="items.php?do=edit&item_id=<?php echo $row['item_id']; ?>" class="btn btn-info float-right btn-sm"><i class="fas fa-edit"></i> Edit
								</a>
							</li>
					<?php
							}
						}
					?>
				  </ul>
				</div>
			</div>
		</div>
		
		<div class="col-12 col-md-6 mb-4">
			<div class="pan">
				<div class="card">
				  <div class="card-header">
					<i class="fas fa-globe-europe"></i> Latest Events
					<span class="float-right expand-lateset"style="cursor:pointer">
						<i class="fa fa-plus"></i>
					</span>
				  </div>
				  <ul class="list-group list-group-flush">
					<?php
						$latest = getLatestItems('events' , 'id,name,date' , '' , 'id' , 5);
						if(count($latest) == 0){
							// no users found
							echo '<li class="list-group-item">No articles Were Found.</li>';
						}else{
							// there are users found
							foreach($latest as $row){
						?>
							<li class="list-group-item">
								<span><?php echo $row['name'] . ' [ ' . $row['date'] . ' ]'; ?></span>
								<a href="events.php?do=edit&item_id=<?php echo $row['id']; ?>" class="btn btn-info float-right btn-sm"><i class="fas fa-edit"></i> Edit
								</a>
							</li>
					<?php
							}
						}
					?>
				  </ul>
				</div>
			</div>
		</div>
		
	</div>
</div>

<!-- end dashboard -->

<?php
	include $tpls . '/footer.inc.php';
?>