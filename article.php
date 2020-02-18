<?php
	if(isset($_GET['p'])){
		$article_id = $_GET['p'];
		require_once 'db_connection.php';
		$stmt = $db->prepare("SELECT articles.name,articles.description,articles.content,articles.add_date,articles.image,articles.approval,categories.name AS cat_name,categories.cat_id
		FROM articles
		JOIN categories ON categories.cat_id = articles.cat_id
		WHERE articles.item_id = ? LIMIT 1");
		$stmt->execute(array($article_id));
		if($stmt->rowCount() > 0){
			$row = $stmt->fetch();
			extract($row);
			if($approval == 1){
			$page_title = $name;
			require_once 'includes/head.inc.php';
?>

<link rel="stylesheet"href="css/article.css">
<link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet"> 

<meta property="og:url"           content="<?php echo 'www.masusc.com/article.php?p=' . $article_id; ?>"  />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="<?php echo $page_title; ?>" />
<meta property="og:description"   content="<?php echo $description; ?>" />
<meta property="og:image"         content="<?php echo 'url/' . $image; ?>" />
<meta property="og:image:width" content="100" />
<meta property="og:image:height" content="100" />

<?php
	require_once 'includes/navbar.inc.php';
?>
	
	
	
	<div class="top-hero position-relative"style="background:url('uploaded_files/<?php echo $image; ?>') no-repeat center center;background-size:cover">
		<div class="overlay position-absolute d-flex justify-content-center align-items-center">
			<div class="container">
				<h1 class="font text-center article_title"><?php echo $name; ?></h1>
				<!--<p class="text-center"><?php /*echo $description; */?></p>-->
				<div class="m-auto mt-4 category-name text-center">
					<p><?php echo $cat_name; ?></p>
				</div>
			</div>
		</div>
	</div>
	
	<!-- start article section -->
	<div class="article-content padd">
		
		<div class="container content">
			<div class="share-button mb-4">
				<div class="container d-flex justify-content-center">
					<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
						<a class="a2a_button_facebook a2a_counter"></a>
						<a class="a2a_button_twitter "></a>
						<a class="a2a_button_linkedin "></a>
						<a class="a2a_button_whatsapp "></a>
					</div>
				</div>
				<script async src="https://static.addtoany.com/menu/page.js"></script>
			</div>
			<div class="content-content">
				<?php echo $content; ?>
			</div>
		</div>
	</div>
	<!-- end article section -->
	
	<!-- start comment section -->
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
	<!-- end comment section -->
	
	
	<div class="subscribe padd">
		<div class="container">
			<h1 class="font text-center">SUBSCRIBE FOR <span class="styled-font">LATEST ARTICLES</span></h1>
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
	
	
	<!-- start similar topics section -->
	<?php
		$stmt = $db->prepare("SELECT item_id,image,name,description,add_date FROM articles WHERE cat_id = ? AND item_id != ?");
		$stmt->execute(array($cat_id , $article_id));
		if($stmt->rowCount() > 0){
	?>
		<div class="similar padd">
			<div class="container">
				<h1 class="text-center font mb-4">RELATED TOPICS</h1>
				<div class="card-columns mixes">
	<?php
			$rows = $stmt->fetchAll();
				foreach($rows as $row){
					extract($row);
	?>
		
						
					<a href="article.php?p=<?php echo $item_id; ?>"class="mix marketing">
					  <div class="position-relative card shadow mb-5 bg-white rounded ">
						<img class="photo1 card-img-top" src="uploaded_files/<?php echo $image; ?>" alt="Card image cap">
						<div class="card-body p-3 text-center">
						  <h5 class="card-title font"><?php echo $name; ?></h5>
						  <p class="card-text card-para"><?php echo $description ?></p>
						  <p class="card-text"><small class="text-muted"><?php echo $add_date; ?></small></p>
						</div>
					  </div>
					</a>
	<?php
			}
		?>
		</div>
			</div>
		</div>
		<?php
		}
	?>
	
	<!-- end similar topics section -->


<?php
			}else{
				header("Location: blog.php");
				exit();
			}
		}else{
			header("Location: blog.php");
			exit();
		}

	require_once 'includes/footer.inc.php';
	}else{
		header("Location: blog.php");
		exit();
	}
?>

<script type="text/javascript" src="js/article.js"></script>
<script type="text/javascript" src="js/email_subscribe.js"></script>