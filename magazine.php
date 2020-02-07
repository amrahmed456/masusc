<?php
	if(isset($_GET['id']) ){
		$id = $_GET['id'];
		require_once 'db_connection.php';
		$stmt = $db->prepare("SELECT name,description,image,url FROM magazines WHERE id = ? LIMIT 1");
		$stmt->execute(array($id));
		if($stmt->rowCount() > 0){
			$row = $stmt->fetch();
			extract($row);
			$page_title = $name;
			require_once 'includes/head.inc.php';
			?>
			<link rel="stylesheet"href="css/magazines.css">
			
			<meta property="og:url"           content="<?php echo 'url?p=' . $id; ?>"  />
			<meta property="og:type"          content="website" />
			<meta property="og:title"         content="<?php echo $page_title; ?>" />
			<meta property="og:description"   content="<?php echo $description; ?>" />
			<meta property="og:image"         content="<?php echo 'url/' . $image; ?>" />
			<meta property="og:image:width" content="100" />
			<meta property="og:image:height" content="100" />
			
			<?php
				require_once 'includes/navbar.inc.php';
			?>
				<div class="padd frame-container">
				<iframe  style="width:700px;height:555px" src="<?php echo $url; ?>"  seamless="seamless" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true" ></iframe>
				</div>
				
				
				<!-- AddToAny BEGIN -->
<div class="d-flex justify-content-center">
	<div>
		<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
		<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
		<a class="a2a_button_facebook"></a>
		<a class="a2a_button_twitter"></a>
		<a class="a2a_button_email"></a>
		<a class="a2a_button_linkedin"></a>
		<a class="a2a_button_whatsapp"></a>
		<a class="a2a_button_pinterest"></a>
		<a class="a2a_button_yahoo_mail"></a>
		</div>
		<script async src="https://static.addtoany.com/menu/page.js"></script>
	</div>
</div>
	<!-- AddToAny END -->
				
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
				
				
				<!-- select all magazines except this one -->
				<?php
					$stmt = $db->prepare("SELECT name,id,image FROM magazines WHERE id != ?");
					$stmt->execute(array($id));
					if($stmt->rowCount() > 0){
				?>
				<div class="main padd">
					<div class="container">
						<div class="row">
				<?php
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
					?>
						</div>
					</div>
				</div>
					<?php
					}
				?>
			<?php
		}else{
			header("Location: magazines.php");
			exit();
		}
	}

	require_once 'includes/footer.inc.php';
?>
<script src="js/fitframe.min.js"></script>
<script>
	$(document).ready(function(){
		$(".navbar").removeClass("very-top");
		$(window).on("scroll",function(){
			$(".navbar").removeClass("very-top");
		});
		
		$('.frame-container').fitFrame({
				mode: 'resize'
			});
		
	});
</script>
