<?php
	$pageTitle = 'CDC Registration Form | MA SUSC';
	require_once 'init.inc.php';
	$tickets = getLatestItems("tickets" , "tickets" , "", "tickets" , "1");
	?>
	<style>
		
		*{
			outline:none
		}
		.padd{padding:60px 20px}
		.content{
			background:white;
			border-radius: 5px;
			box-shadow: 2px 3px 7px #EEE;
			min-width:664px
		}
		@media(max-width:680px){
			.content{
				min-width:200px;
				height:100%;
				overflow-y:scroll
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
		.dots::after{
			content: " : ";
			position:absolute;
			right:0px;
			top:12px
		}
		.logo-st img{
			margin:13px;
			width:130px;
			height:130px
		}
	</style>
	<?php
	foreach($tickets as $ticket){
		extract($ticket);
		$availabe_tickets = explode(" " , $tickets );
		if(count($availabe_tickets) > 0){
			// there is availabe_tickets
		?>
		
		<div class="form">
			<div class="full-page d-flex justify-content-center align-items-center m-auto">
				<div class="mt-4 padd text-center content">
					<img src="imgs/cdc.png"  class="img-fluid"style="width:320px"/>
					<h3 style="font-style:italic;font-weight:bold;color:#555;font-size:19px">" THINK BUSINESS "</h3>
					<h3 class="mt-4">CDC Registration Form</h3>
					<p class="text-small">Please Fill Out All Fields Below.</p>
					
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">Your Name</label>
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
						<input type="email" class="input-email form-control" placeholder="Email Address" required />
					</div>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">National ID</label>
						<input onkeypress="return isNumber(event)" type="text" class="input-nid form-control" placeholder="National ID"  />
					</div>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">Phone Number</label>
						<input type="text" class="input-phone form-control" onkeypress="return isNumber(event)" maxlength="11" placeholder="Phone Number" required />
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
					
					<button type="submit" class="submit-form mt-4 btn btn-success d-block btn-block">SUBMIT</button>
					
					<div class="slide-up alert-error"><p class='text-danger'>Please Fill all required fields.</p></div>
					
					<div class="logo-st d-flex justify-content-center">
						<img src="imgs/ma-logo.png"  class="img-fluid" title="MA SUSC" />
						<img src="imgs/er-logo.png"  class="img-fluid" title="Egyptian russian university, student union"/>
					</div>
					
					
				</div>
			</div>
		</div>
		
		<div class="success slide-up">
			<div class="full-page d-flex justify-content-center align-items-center m-auto">
				<div class="mt-4 padd text-center content">
					<img src="imgs/form-sent.png" class="img-fluid m-auto" style="width:220px"/>
					
					<h2 class="mt-4 text-success">Thank you <span class="name-thank"></span>, We've recieved your application.</h2>
					<p class="text-small">we'll contact you soon to confirm your registration.</p>
						
					<br>
					
				</div>
			</div>
		</div>
		<?php
		}else{
			// sorry no availabe_tickets
		?>
			<div class="full-page d-flex justify-content-center align-items-center m-auto">
				<div class="mt-4 padd text-center content">
					<img src="imgs/tickets-out.png" class="img-fluid m-auto" style="width:210px"/>
					
					<h1 class="mt-4 text-danger">Sorry, There's No Availabile Tickets.</h1>
					<p class="text-small">You Can Contact Us On <a href="">Facebook</a> for help.</p>
				</div>
			</div>
		<?php
		}
	}
	
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
		winH = $(window).innerHeight();
		$(".full-page").css("height" , winH);
		$(window).resize(function(){
			winH = $(window).innerHeight();
			$(".full-page").css("height" , winH);
		});
		
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
			
			var data_array = new Array(name , faculty , grade , university , email , phone);
			var element_array = new Array(".input-name",".input-faculty",".input-grade",".input-university",".input-email",".input-phone");
			
			var errors = 0;
			
			// validate date
			for(var i = 0 ; i < data_array.length ; i++){
				if(i==4){
					// email verification
					if(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(data_array[i]) ){
						
					} else {
						$(element_array[i]).addClass("input-not-full");
						errors++;
					}
					/*
					if(data_array[i].length < 3 &&  data_array[i].indexOf("@") < 4){
						$(element_array[i]).addClass("input-not-full");
						errors++;
					}
					*/
				}else if(i==5){
					// phone verification
					if(data_array[i].length == 11 || data_array[i].length == 13){
					}else{
						$(element_array[i]).addClass("input-not-full");
						errors++;
					}
					
				}else{
					if( data_array[i].length < 4 ){
						$(element_array[i]).addClass("input-not-full");
						errors++;
					}
				}
				
			}
			
			if(errors == 0){
				$("button[type='submit']").attr("disabled" , true);
				// send data
				$.ajax({
					url:	"save-data.php",
					method:	"POST",
					dataType:	"text",
					data:	{name:name,faculty:faculty,grade:grade,university:university,email:email,phone:phone,face:face,trans:trans,nid:nid},
					success:	function(text){
						if(text == 'success'){
							$(".form").slideUp();
							setTimeout(function(){
								$(".success").slideDown();
								$(".success .name-thank").text( name.split(" ")[0] );
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
								setTimeout(function(){
									$(".alert-error").slideUp();
								
								},3000);
							$("button").html("SUBMIT").attr("disabled" , false);
						}
					}
					
				});
				
				
			}else{
				$(".alert-error").slideDown();
				setTimeout(function(){
					$(".slide-up").slideUp();
					
				},3000);
				$(this).html("SUBMIT");
				$("button[type='submit']").attr("disabled" , false);
			}
			
			
		});
		
		
	});
</script>
<!--<script>
var end = new Date('12/12/2019 10:00 AM');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            $('.count').html('Event Started Already!');

            return;
        }
		
        var days = Math.floor(distance / _day) >= 10 ? Math.floor(distance / _day) : "0" + Math.floor(distance / _day);
		
        var hours = Math.floor((distance % _day) / _hour) >= 10 ? Math.floor((distance % _day) / _hour) : "0" + Math.floor((distance % _day) / _hour);
		
        var minutes = Math.floor((distance % _hour) / _minute) >= 10 ? Math.floor((distance % _hour) / _minute) : "0" + Math.floor((distance % _hour) / _minute);
		
        var seconds = Math.floor((distance % _minute) / _second) >= 10 ? Math.floor((distance % _minute) / _second) : "0" + Math.floor((distance % _minute) / _second);

        $(".days").html(days);
        $(".hours").html(hours);
        $(".minutes").html(minutes);
        $(".seconds").html(seconds);
        
    }

    timer = setInterval(showRemaining, 1000);
</script>-->
