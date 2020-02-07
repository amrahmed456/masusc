$(document).ready(function(){
	
	var winH = window.innerHeight;
	var el = document.getElementById("full");
	el.style.height = winH + "px";
	
	$(".slide-up").slideUp(1);
	
	
	// signing in a user
	$(".submit-login").click(function(){
		
		$(this).attr("disabled" , true);
		$(this).text("loging in...");
		
		var email = 'amr@yahoo.com',
			password = $(".input-pass").val();
			
			
		firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error) {
			$(".submit-login").attr("disabled" , false);
			$(".submit-login").text("LOGIN");
		  // Handle Errors here.
		  var errorCode = error.code;
		  var errorMessage = error.message;
		  $(".pass-error").text(errorMessage);
		  $(".pass-error").slideDown().delay(2500).slideUp();
		  
		  // ...
		});
	});
	
	
	auth.onAuthStateChanged(function(user) {
	  if (user) {
		
			$(".modal-body .statistics").slideUp();
			$(".modal-body .dashboard").slideDown();
		
	  }
	  
	});
	
	
	// check if ticket id has document
	var ticket_id = $(".ticket-no .number").text();
	var docRef = db.collection("cdc").doc(ticket_id);
	docRef.get().then(function(doc) {
		if (doc.exists) {
			// doc exists call listenFunction here
			listenForStatus();
			
		} else {
			// doc.data() will be undefined in this case
			// create new document with name if ticket_id
			
			db.collection("cdc").doc(ticket_id).set({
				ticket: ticket_id,
				attendance: "0",
				pack: "0",
				lunch: "0"
			})
			.then(function() {
				// call listenFunction here
				listenForStatus();
				
			})
			.catch(function(error) {
				console.error("Error writing document: ", error);
			});
			
		}
	}).catch(function(error) {
		console.log("Error getting document:", error);
	});
	
	
	// listen for real time status changes
	function listenForStatus(){
		
		db.collection("cdc").where("ticket", "==", ticket_id)
		.onSnapshot(function(snapshot) {
			
			snapshot.docChanges().forEach(function(change) {
				if (change.type === "added") {
					if(change.doc.id == ticket_id){
						var attend_status 	= change.doc.data().attendance;
						var package_status 	= change.doc.data().pack;
						var lunch_status 	= change.doc.data().lunch;
						
						handleFront(attend_status,package_status,lunch_status);
					}
					
				}
				if (change.type === "modified") {
					
					if(change.doc.id == ticket_id){
						var attend_status 	= change.doc.data().attendance;
						var package_status 	= change.doc.data().pack;
						var lunch_status 	= change.doc.data().lunch;
						
						handleFront(attend_status,package_status,lunch_status);
					}
				}
				
			});
		});
		
	};
	
	
	// handle front end results based on values back from database
	function handleFront(attend_status , package_status , lunch_status){
		
		if(attend_status == '0'){
			$(".attend-reg .status-status").attr("src" , "imgs/wrong.png");
			
		}else if(attend_status == '1'){
			$(".attend-reg .status-status").attr("src" , "imgs/check.png");
		}
		
		if(package_status == '0'){
			$(".package-reg .status-status").attr("src" , "imgs/wrong.png");
		}else if(package_status == '1'){
			$(".package-reg .status-status").attr("src" , "imgs/check.png");
		}
		
		if(lunch_status == '0'){
			$(".lunch-reg .status-status").attr("src" , "imgs/wrong.png");
		}else if(lunch_status == '1'){
			$(".lunch-reg .status-status").attr("src" , "imgs/check.png");
			
		}
		
		
		$(".dashboard .status-status").each(function(){
			
			if( $(this).attr("src") == 'imgs/wrong.png' ){
				$(this).parent().parent().siblings(".btn-check").html('<button class="btn btn-success">CHECK</button>');
			}else{
				$(this).parent().parent().siblings(".btn-check").html('');
			}
			
		});
		
	}
	
	// clicking check btns
	$("body").on("click" , ".dashboard .attend-check button" , function(){
		
		$(this).attr("disabled" , true).text("saving...");
		docRef.update({
			attendance : '1'
		});
		
	});
	
	$("body").on("click" , ".dashboard .package-check button" , function(){
		
		$(this).attr("disabled" , true).text("saving...");
		docRef.update({
			pack : '1'
		});
		
	});
	
	$("body").on("click" , ".dashboard .lunch-check button" , function(){
		
		$(this).attr("disabled" , true).text("saving...");
		docRef.update({
			lunch : '1'
		});
		
	});
	
	
});
