<?php
	session_start();
	$pageTitle = 'MA | Add articles';
	// check if user is logged in
	if(isset($_SESSION['user_type'])){
		include 'init.inc.php';

		if(isset($_GET['article_id'])){
			$article_id = $_GET['article_id'];
			$stmt = $db->prepare("SELECT content FROM articles WHERE item_id = ?");
			$stmt->execute(array($article_id));
			$row = $stmt->fetch();
			$content = $row['content'];
			
?>
<div class="container">
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<script src="ckeditor/ckeditor.js"></script>
		<script src="ckfinder/ckfinder.js"></script>
		<script src="js/jquery-3.3.1.min.js"></script>
	</head>
	<body>
		<div class="overlay-screen">
			
			<div class="loading position-absolute d-flex justify-content-center align-items-center">
				
			</div>
		</div>
		<textarea name="content" id="editor"  placeholder="type your content here...">
		   <?php echo $content; ?>
		</textarea>
		<button data-id="<?php echo $article_id; ?>" class="btn btn-primary btn-block mt-2 send mb-2"id="send">Submit</button>
		<div class="alert alert-info slideUp sending">Sending data, Please Wait...</div>
		<div class="alert alert-success slideUp sent">Data sent successfully</div>
		<div class="alert alert-danger slideUp wrong">Oops, Something Went Wrong</div>
		<script>
			$(".slideUp").slideUp();
			var editor = CKEDITOR.replace( 'editor');
			$(".send").click(function(){
				$(".sending").slideDown();
				// getting data
				var data 		= CKEDITOR.instances.editor.getData().trim();
				var article_id 	= $("#send").attr("data-id");
				
				// sending data with ajax
				$.ajax({
					url:	"update_content.php",
					method:	"GET",
					dataType:	"text",
					data:	{article_id:article_id,data:data},
					success:function(text){
						$(".sending").slideUp();
						if(text == 'success'){
							$(".sent").slideDown().delay(2500).slideUp();
						}else{
							$(".wrong").slideDown().delay(2500).slideUp();
						}
						
					}
				});
			});
			
			CKFinder.setupCKEditor( editor );
		   
			
				
		</script>
	</body>
	</html>
</div>
<?php	
		}
	
	}else{
		header("Location: index.php");
		exit();
	}

	include $tpls . '/footer.inc.php';

?>