<?php
	$page_title = 'MA Blog';
	require_once 'includes/head.inc.php';
?>
	<link rel="stylesheet" href="css/owl.carousel.min.css" />
	<link rel="stylesheet" href="css/owl.theme.default.min.css" />
	<link rel="stylesheet" media="screen" href="css/particles.css">
	<link rel="stylesheet"href="css/blog.css">
<?php
	require_once 'includes/navbar.inc.php';
	require_once 'db_connection.php';
?>

<div class="top-hero position-relative">
	<!-- particles.js container -->
	<div id="particles-js"></div>
	
	<div class="position-absolute top-talk d-flex align-items-center justify-content-center">
		<div class="talk text-center">
			<h1 class="font">MA BLOG</h1>
			<p class="lead">Learn,Develop And Enjoy</p>
		</div>

	</div>
	
</div>

<div class="categories mt-4">
	<div class="container members">
		<ul class="list-unstyled">
				<li class="mr-2 active" data-filter="all" data-by="all articles">All Articles</li>
				<?php
					$cat = $db->prepare("SELECT name FROM categories");
					$cat->execute();
					if($cat->rowCount() > 0){
						$categories = $cat->fetchAll();
						foreach($categories as $category){
							extract($category);
							
							$categoryClass = str_replace(" " , "_" , $name);
							
						?>
							<li class="mr-2" data-filter=".<?php echo $categoryClass; ?>" data-by="<?php echo $name . ' Articles'; ?>"><?php echo $name; ?></li>
						<?php
						}
					}
				?>
				
			</ul>
	</div>

</div>



<!-- start blog posts -->
<?php
	$stmt = $db->prepare("SELECT articles.item_id,articles.image,articles.name,articles.description,articles.add_date,categories.name AS cat_name FROM articles JOIN categories ON articles.cat_id = categories.cat_id WHERE articles.approval = '1'");
		$stmt->execute(array());
		if($stmt->rowCount() > 0){
			
		?>
			<div class="blog-posts padd">
				<div class="container text-center">
					<h1 class="font filter-by">all articles</h1>
					<p class="lead l-info">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s been the industry's standard orem Ipsum is simply dummy</p>
					
					<div class="card-columns mixes">
		<?php
			$rows = $stmt->fetchAll();
				$count = 1;
				foreach($rows as $row){
					if($count == 5){$count = 1;}
					extract($row);
					$categoryClass = str_replace(" " , "_" , $cat_name);
?>
			
						<a href="article.php?p=<?php echo $item_id; ?>"class="mix <?php echo $categoryClass; ?>">
						  <div class="position-relative card shadow mb-5 bg-white rounded ">
							<div class="article-cat position-absolute"><?php echo $cat_name; ?></div>
							<img class="photo<?php echo $count; ?> card-img-top" src="uploaded_files/<?php echo $image; ?>" alt="Card image cap">
							<div class="card-body p-3">
							  <h5 class="card-title font"><?php echo $name; ?></h5>
							  <p class="card-text card-para"><?php echo trim($description); ?></p>
							  <p class="card-text"><small class="text-muted"><?php echo $add_date; ?></small></p>
							</div>
						  </div>
						</a>
						
			<?php
				$count++;
			}	
			?>
					  
					</div>
				</div>
			</div>
		<?php
		}
		?>
		
		
		<!-- end blog posts -->

<?php
	require_once 'includes/footer.inc.php';
?>
<script src="js/owl.carousel.min.js"></script>
<script src="js/particles.js"></script>
<script src="js/particles-app.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/blog.js"></script>