<?php
	$pageTitle = 'CDC Offline Registration Form | MA SUSC';
	require_once 'init.inc.php';
	
?>
	<style>
		.padd{padding:60px 20px}
		.content{
			background:white;
			border-radius: 5px;
			box-shadow: 2px 3px 7px #EEE;
			min-width:664px
		}
		@media(max-width:680px){
			.content{
				min-width:200px
			}
		}
		.text-small{font-size: 14px;color:#6a6a6a;}
		label{
			background:#FFF;
			z-index: 2;
			left: 13px;
			top: 6px;
			transition: .4s;
		}
		.active-label{
			font-size: 13px;
			top: -13px;
			left: 7px;
		}
		.input-not-full{border-color:red}
	</style>
	<div class="form">
			<div class="full-page d-flex justify-content-center align-items-center m-auto">
				<div class="mt-4 padd text-center content">
					<img src="imgs/ma-logo.png"  class="img-fluid"style="width:120px"/>
					<h3 class="mt-4">CDC Offline Registration Form</h3>
					<p class="text-small">Please Fill Out All Fields Below.</p>
					<hr>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">Ticket Number</label>
						<input type="text" class="input-ticket form-control" placeholder="Ticket Number" required />
					</div>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">Apllicant Name</label>
						<input type="text" class="input-name form-control" placeholder="Your Name" required />
					</div>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">Faculty</label>
						<input type="text" class="input-faculty form-control" placeholder="Faculty" required />
					</div>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">Grade</label>
						<input type="text" class="input-grade form-control" placeholder="Grade" required />
					</div>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">University</label>
						<input type="text" class="input-university form-control" placeholder="University" required />
					</div>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">Email Address</label>
						<input type="email" class="input-email form-control" placeholder="Email Address"  />
					</div>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">National ID</label>
						<input onkeypress="return isNumber(event)" type="text" class="input-nid form-control" placeholder="National ID"  />
					</div>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">Phone Number</label>
						<input type="text" class="input-phone form-control" onkeypress="return isNumber(event)" maxlength="11" placeholder="Phone Number"  />
						<p class="text-small text-left">we'll contact you later on this phone number.</p>
					</div>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">Facebook Link</label>
						<input type="url" class="input-face form-control" placeholder="Facebook Link"  />
					</div>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">Transportation</label>
						<select class="form-control transportation" >
							<option value="unknown method">form...</option>
							<option value="from cairo">from Cairo</option>
							<option value="from suez">from Suez</option>
							
							
						</select>
					</div>
					<div class="position-relative mt-4">
						
						<textarea class="input-comment form-control" placeholder="Comments..."></textarea>
					</div>
					
					<button type="submit" class="submit-form mt-4 btn btn-primary d-block btn-block">SUBMIT</button>
					
					<div class="slide-up alert-error"><p class='text-danger'>Please Fill all required fields.</p></div>

					
				</div>
			</div>
		</div>
		
		<div class="success slide-up">
			<div class="full-page d-flex justify-content-center align-items-center m-auto">
				<div class="mt-4 padd text-center content">
					<img src="imgs/form-sent.png" class="img-fluid m-auto" style="width:220px"/>
					
					<h2 class="mt-4 text-success">Thank you, We've recieved your application.</h2>
					<p class="text-small">this application is listed as confirmed.</p>
				</div>
			</div>
		</div>
<?php
	include $tpls . '/footer.inc.php';
?>
<script>
function isNumber(evt) {
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
}
	$(document).ready(function(){
		
		$("input,textarea").each(function(){
			if( $(this).val().trim().length > 0 ){
				$(this).siblings("label").addClass("active-label");
			}
		});
		
		$(".slide-up").slideUp();
		
		
		$("input").on("focus" , function(){
			
			$(this).siblings("label").addClass("active-label").end().removeClass("input-not-full");
		});
		$("input").on("blur" , function(){
			if($(this).val().trim().length == 0){
				$(this).siblings("label").removeClass("active-label");
			}
			
		});
		
		$("label").click(function(){
			$(this).siblings("input").focus();
		});
		
		
		$(".submit-form").click(function(){
			$(this).html('<div class="spinner-border text-light" role="status"><span class="sr-only">Loading...</span></div>');
			$(this).attr("disabled" , true);
			// get date
			var name 		= $(".input-name").val().trim();
			var faculty 	= $(".input-faculty").val().trim();
			var grade 		= $(".input-grade").val().trim();
			var university 	= $(".input-university").val().trim();
			var email 		= $(".input-email").val().trim();
			var phone 		= $(".input-phone").val().trim();
			var face 		= $(".input-face").val().trim();
			var trans 		= $(".transportation").find(":selected").val().trim();
			var nid 		= $(".input-nid").val().trim();
			var ticket 		= $(".input-ticket").val().trim();
			var comment 	= $(".input-comment").val().trim();
			
			var data_array = new Array(name , faculty , grade , university , ticket);
			var element_array = new Array(".input-name",".input-faculty",".input-grade",".input-university" , ".input-ticket");
			
			var errors = 0;
			
			// validate date
			for(var i = 0 ; i < data_array.length ; i++){
				
				if( data_array[i].length == 0 ){
					$(element_array[i]).addClass("input-not-full");
					errors++;
				}
				
				
			}
			
			if(errors == 0){
				// send data
				$.ajax({
					url:	"save-offline-data.php",
					method:	"POST",
					dataType:	"text",
					data:	{name:name,faculty:faculty,grade:grade,university:university,email:email,phone:phone,face:face,nid:nid,trans:trans,ticket:ticket,comment:comment},
					success:	function(text){
						if(text == 'success'){
							$(".form").slideUp();
							setTimeout(function(){
								$(".success").slideDown();
							},400);
						}else if(text == 'exists'){
							$(".alert-error").slideDown().html("application already exists.");
							setTimeout(function(){
								$(".slide-up").slideUp();
								$(".alert-error").slideDown();
								$(".alert-error").html("<p class='text-danger'>Please Fill all required fields.</p>");
							},5000);
							$("button").html("SUBMIT").attr("disabled" , false);
							setTimeout(function(){
									$(".alert-error").slideUp();
								
								},3000);
							
						}else{
							$(".alert-error").slideDown().html(text);
							setTimeout(function(){
								$(".slide-up").slideUp();
								$(".alert-error").slideDown();
								$(".alert-error").html("<p class='text-danger'>Please Fill all required fields.</p>");
							},5000);
							$("button").html("SUBMIT").attr("disabled" , false);
						}
					}
					
				});
				
				
			}else{
				$(".alert-error").slideDown();
				setTimeout(function(){
					$(".slide-up").slideUp();
				},2000);
				$("button").html("SUBMIT").attr("disabled" , false);
			}
			
			
		});
		
		
	});
</script>