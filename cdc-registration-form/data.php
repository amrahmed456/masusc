<?php
	if(isset($_GET['pass'])){
		if($_GET['pass'] ==  'MASUSC20192020'){
			$pageTitle = 'CDC Data | MA SUSC';
			require_once 'init.inc.php';
		?>
		<style>
		.stats{background: #4D4D4D;margin-bottom:15px}
		.selected{border: 4px solid #000;background: #DDD;}
		.thead-dark{top:0px}
		textarea{background:transparent;border:none}
		.status-img{width:50px}
		.my-status img{width:25px}
		.my-status{bottom:0px;right:45%}
		
		</style>
		
		
			<h2 class="text-center mb-4">CDC DATASHEET</h2>
			<div class="container mb-4">
				<div class="row">
				
					<div class="col-12 col-md-4 col-lg-3">
						<div class="stats text-center" style="background:#0c6faa;">
							<h5>Available Tickets</h5>
							<?php
								$tickets = getLatestItems("tickets" , "tickets" , "", "tickets" , "1");
								
								foreach($tickets as $ticket){
									extract($ticket);
									$availabe_tickets = explode(" " , $tickets );
									$availabe_tickets = count($availabe_tickets);
								}
								
							?>
							<p class="mt-4 lead"><?php echo $availabe_tickets; ?></p>
						</div>
					</div>
					
					
					<div class="col-12 col-md-4 col-lg-3">
						<div class="stats text-center" style="background:#aa8a0c;">
							<h5>Pending Tickets</h5>
							<?php
								$count = countItems("cdc" , "status" , "WHERE status = '0'");
							?>
							<p class="mt-4 lead"><?php echo $count; ?></p>
						</div>
					</div>
					
					<div class="col-12 col-md-4 col-lg-3">
						<div class="stats text-center" style="background:#1c8440;">
							<h5>Confirmed Tickets</h5>
							<?php
								$count = countItems("cdc" , "status" , "WHERE status = '1'");
							?>
							<p class="mt-4 lead"><?php echo $count; ?></p>
						</div>
					</div>
					
					<div class="col-12 col-md-4 col-lg-3">
						<div class="stats text-center" style="background:#712121">
							<h5>Cancelled Tickets</h5>
							<?php
								$count = countItems("cdc" , "status" , "WHERE status = '2'");
							?>
							<p class="mt-4 lead"><?php echo $count; ?></p>
						</div>
					</div>
					
				</div>
			</div>
			
			<?php
				$count = countItems("cdc" , "id" , "");
				if($count > 0){
			?>
			
				<table class="table">
				  <thead class="thead-dark position-sticky">
					<tr>
					  <th scope="col">Ticket</th>
					  <th scope="col">Name</th>
					  <th scope="col">Faculty</th>
					  <th scope="col">Grade</th>
					  <th scope="col">University</th>
					  <th scope="col">Email</th>
					  <th scope="col">Phone</th>
					  <th scope="col">Facebook</th>
					  <th scope="col">Status</th>
					  <th scope="col">Comments</th>
					  <th scope="col">Date</th>
					  <th scope="col">Options</th>
					</tr>
				  </thead>
				  <tbody>
			<?php
				// select data
				$stmt = $db->prepare("SELECT id,ticket_id,name,faculty,grade,university,email,phone,facebook,comments,date,status FROM cdc ORDER BY status ASC");
				$stmt->execute();
				$rows = $stmt->fetchAll();
				foreach($rows as $row){
					extract($row);
					
			?>
					<tr id="<?php echo $id; ?>" class="table-row <?php if($status == '1'){echo 'table-success';}else if($status == '2'){echo 'table-danger';}?>">
					  <th scope="row">
						<?php
							if($status == '0' || $status == '1'){
								// has a ticket
								echo $ticket_id;
								
							}else{
								// no ticket
								echo 'No Ticket';
							}
							
						?>
					  </th>
					  <td><?php echo $name; ?></td>
					  <td><?php echo $faculty; ?></td>
					  <td><?php echo $grade; ?></td>
					  <td><?php echo $university; ?></td>
					  <td><a href="mailto:<?php echo $email; ?>" ><?php echo $email; ?></a></td>
					  <td><?php echo $phone; ?></td>
					  <td><a target="_blank" href="<?php echo $facebook; ?>" ><?php echo $facebook; ?></td>
					  
					  <td class="td-status">
						
					<?php if($status == '1'){
					?>
						<div class="attend-reg position-relative mb-2">
							<img src="imgs/attendant-list.png" class="img-fluid status-img" />
							<div class="attendance-status position-absolute my-status">
								<img class="status-status" src="imgs/wrong.png" />
							</div>
						</div>
					
					
					
						<div class="package-reg mb-2">
							<div class="position-relative">
								<img src="imgs/box.png" class="img-fluid status-img" />
								<div class="package-status position-absolute my-status">
									<img class="status-status" src="imgs/wrong.png" />
								</div>
							</div>
						</div>
					
					
					
						<div class="lunch-reg mb-2">
							<div class="position-relative">
								<img src="imgs/lunch.png" class="img-fluid status-img" />
								<div class="lunch-status position-absolute my-status">
									<img class="status-status" src="imgs/wrong.png" />
									
								</div>
							</div>
						</div>
					<?php
						}
					?>	
						
					  </td>
					  
					  <td><textarea data-id="<?php echo $id; ?>" class="textarea" autocomplete="off"><?php echo $comments; ?></textarea></td>
					  <td><?php echo $date; ?></td>
					  <td>
						<?php
							if($status == '0'){
								echo '<a href="confirm-ticket.php?id=' . $id . '"> <button class="mb-2 btn btn-success btn-sm confirm-btn">Confirm</button></a>';
								echo '<a href="deny-ticket.php?id=' . $id . '"><button class="confirm btn btn-danger btn-sm deny-btn">Reject</button></a>';
								
							}
						?>
					  </td>
					</tr>
			<?php
				
				}
			
			?>
				</tbody>
			</table>

			<?php
				}else{
			?>
				<div class="alert alert-danger text-center">No Data Was Found</div>
			<?php
				}
			
		
			include $tpls . '/footer.inc.php';
		
		}else{
			exit();
		}
	}else{
		exit();
	}
	
?>

<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-firestore.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
	 https://firebase.google.com/docs/web/setup#config-web-app -->

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
	apiKey: "AIzaSyBYx52Ce5j9zuem7p7p2H3ig0iiD_Leuzk",
	authDomain: "test-456789.firebaseapp.com",
	databaseURL: "https://test-456789.firebaseio.com",
	projectId: "test-456789",
	storageBucket: "test-456789.appspot.com",
	messagingSenderId: "787061937512",
	appId: "1:787061937512:web:e84da515f1f422ba"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  
  // make auth and db refrences
  const db	= firebase.firestore();
  
</script>

<script>
	$(document).ready(function(){
		
		$(".table-row").click(function(){
			$(".table-row").each(function(){
				$(this).removeClass("selected");
			});
			$(this).addClass("selected");
		});
		
		$("textarea").on({
			"blur" : function(){
				var id = $(this).data("id");
				var comment = $(this).val().trim();
				updateComments(id,comment);
			},
			"keyup" : function(e){
				if(e.which == '13'){
					e.preventDefault();
					var id = $(this).data("id");
					var comment = $(this).val().trim();
					updateComments(id,comment);
				}
			}
		});
		
		function updateComments(id , comment){
			$.ajax({
				url:	"update-comment.php",
				method:	"POST",
				dataType:	"text",
				data:	{id:id,comment:comment}
			});
		}
		
		
		
		// get all successful attendance ids and listen to changes
		$(".table-success").each(function(){
			
			var ticket_id = $(this).attr("id");
			listenForStatus(ticket_id);
			// listen for real time status changes
			function listenForStatus(ticket_id){
				
				db.collection("cdc").where("ticket", "==", ticket_id)
				.onSnapshot(function(snapshot) {
					if(snapshot._snapshot.docChanges.length == 0){
						
						db.collection("cdc").doc(ticket_id).set({
							ticket: ticket_id,
							attendance: "0",
							pack: "0",
							lunch: "0"
						})
						
						listenForStatus(ticket_id);
					}else{
						snapshot.docChanges().forEach(function(change) {
							if (change.type === "added") {
									var doc_id = change.doc.id;
									var attend_status 	= change.doc.data().attendance;
									var package_status 	= change.doc.data().pack;
									var lunch_status 	= change.doc.data().lunch;
									
									handleFront(doc_id , attend_status,package_status,lunch_status);
								
								
							}
							if (change.type === "modified") {
								
									var doc_id = change.doc.id;
									var attend_status 	= change.doc.data().attendance;
									var package_status 	= change.doc.data().pack;
									var lunch_status 	= change.doc.data().lunch;
									
									handleFront(doc_id,attend_status,package_status,lunch_status);
								
							}
						
						});
					}
				
					
				});
				
			};
			
			
			
		});
		
		function handleFront(element_id , attend_status , package_status , lunch_status){
			
			if(attend_status == '0'){
			$("#" + element_id + " .attend-reg .status-status").attr("src" , "imgs/wrong.png");
			
			}else if(attend_status == '1'){
				$("#" + element_id + " .attend-reg .status-status").attr("src" , "imgs/check.png");
			}
			
			if(package_status == '0'){
				$("#" + element_id + " .package-reg .status-status").attr("src" , "imgs/wrong.png");
			}else if(package_status == '1'){
				$("#" + element_id + " .package-reg .status-status").attr("src" , "imgs/check.png");
			}
			
			if(lunch_status == '0'){
				$("#" + element_id + " .lunch-reg .status-status").attr("src" , "imgs/wrong.png");
			}else if(lunch_status == '1'){
				$("#" + element_id + " .lunch-reg .status-status").attr("src" , "imgs/check.png");
			}
			
		};
		
		
	});
</script>