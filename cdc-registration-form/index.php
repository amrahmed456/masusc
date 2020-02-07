<?php
	$pageTitle = 'CDC Registration Form | MA SUSC';
	require_once 'init.inc.php';
	$tickets = getLatestItems("tickets" , "tickets" , "", "tickets" , "1");
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
					<img src="imgs/ma-logo.png"  class="img-fluid"style="width:120px"/>
					<h3 class="mt-4">CDC Registration Form</h3>
					<p class="text-small">Please Fill Out All Fields Below.</p>
					
					<div class="row count">
						<div class="col dots position-relative">
							<div class="days">0</div>
							<div>Days</div>
						</div>
						
						<div class="col dots position-relative">
							<div class="hours">0</div>
							<div>Hours</div>
						</div>
						
						<div class="col dots position-relative">
							<div class="minutes">0</div>
							<div>Minutes</div>
						</div>
						
						<div class="col">
							<div class="seconds">0</div>
							<div>Seconds</div>
						</div>
						
						
					</div>
					
					
					
					<hr>
					
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
						<label class="position-absolute" for="input-name">Phone Number</label>
						<input type="text" class="input-phone form-control" placeholder="Phone Number" required />
						<p class="text-small text-left">we'll contact you later on this phone number.</p>
					</div>
					
					<div class="position-relative mt-4">
						<label class="position-absolute" for="input-name">Facebook Link</label>
						<input type="url" class="input-face form-control" placeholder="Facebook Link" required />
					</div>
					
					<button type="submit" class="submit-form mt-4 btn btn-success d-block btn-block">SUBMIT</button>
					
					<div class="slide-up alert-error"><p class='text-danger'>Please Fill all required fields.</p></div>

					
				</div>
			</div>
		</div>
		
		<div class="success slide-up">
			<div class="full-page d-flex justify-content-center align-items-center m-auto">
				<div class="mt-4 padd text-center content">
					<img src="imgs/form-sent.png" class="img-fluid m-auto" style="width:220px"/>
					
					<h2 class="mt-4 text-success">Thank you <span class="name-thank"></span>, We've recieved your application.</h2>
					<p class="text-small">we'll contact you soon to confirm your registration.</p>
						<a target="_blank" href=""><button class="mt-2 btn btn-primary">EVENT ON FACEBOOK</button></a>
					<br>
					<hr>
					<div class="row count">
						<div class="col dots position-relative">
							<div class="days">0</div>
							<div>Days</div>
						</div>
						
						<div class="col dots position-relative">
							<div class="hours">0</div>
							<div>Hours</div>
						</div>
						
						<div class="col dots position-relative">
							<div class="minutes">0</div>
							<div>Minutes</div>
						</div>
						
						<div class="col">
							<div class="seconds">0</div>
							<div>Seconds</div>
						</div>
						
						
					</div>
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
			
			var data_array = new Array(name , faculty , grade , university , email , phone , face);
			var element_array = new Array(".input-name",".input-faculty",".input-grade",".input-university",".input-email",".input-phone",".input-face");
			
			var errors = 0;
			
			// validate date
			for(var i = 0 ; i < data_array.length ; i++){
				if(i==4){
					// email verification
					if(data_array[i].length < 3 &&  data_array[i].indexOf("@") < 4){
						$(element_array[i]).addClass("input-not-full");
						errors++;
					}
				}else if(i==5){
					// phone verification
					if(data_array[i].length == 11 || data_array[i].length == 13){
					}else{
						$(element_array[i]).addClass("input-not-full");
						errors++;
					}
					
				}else if(i==6){
					// facebook verification
					if(data_array[i].indexOf(".com") <= 0){
						$(element_array[i]).addClass("input-not-full");
						errors++;
					}
					
				}else{
					if( data_array[i].length == 0 ){
						$(element_array[i]).addClass("input-not-full");
						errors++;
					}
				}
				
			}
			
			if(errors == 0){
				// send data
				$.ajax({
					url:	"save-data.php",
					method:	"POST",
					dataType:	"text",
					data:	{name:name,faculty:faculty,grade:grade,university:university,email:email,phone:phone,face:face},
					success:	function(text){
						if(text == 'success'){
							$(".form").slideUp();
							setTimeout(function(){
								$(".success").slideDown();
								$(".success .name-thank").text( name.split(" ")[0] );
							},400);
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
<script>
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
</script>