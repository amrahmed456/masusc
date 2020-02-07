$(document).ready(function(){
	
	$(".preloader").fadeOut(600).removeClass("d-flex");
	$("body").css("overflow-y" , "scroll");
	var winH = $(window).innerHeight();
	$(".side-navigation").css("height",winH);
	
	$(window).resize(function(){
		winH = $(window).innerHeight();
		$(".side-navigation").css("height",winH);
	});
	
	// to top button
		$(".to_top").click(function(){
			$("html,body").animate({
				scrollTop:0
			},500);
		});

	// for opening sidebar
	$(".menu-spanner").click(function(){
		$(".side-navigation").css("left","0px");
		$(".side-navigation .side-list").css("left","0px");
		$("body").css("overflow-y","hidden");
		
			setTimeout(function(){
				$(".side-navigation .side-list ul li").each(function(){
				$(this).css("transform","translateX(0px)");
				});
			},200);
			
	});
	// for clicking and closing sidebar
	$(window).click(function(e){
		if(e.target.className == 'side-navigation'){
			// closing sidebar menu
			closeSideBar();
		}
	});
	// for closing sidebar
	function closeSideBar(){
		
		$(".side-navigation .side-list").css("left","-800px");
		$("body").css("overflow-y","scroll");
		$(".side-navigation .side-list ul li").each(function(){
			$(this).css("transform","translateX(-600px)");
		});
		setTimeout(function(){
			$(".side-navigation").css("left","-1500px");
		},300);
	};
	// for navbar scrolling down
	$(window).on("scroll",function(){
		
		if($(window).scrollTop() > 150){
			// add fixed option to navbar
			$(".navbar").removeClass("very-top");
			$(".to_top").removeClass("to_top_bottom");
		}else{
			// remove fixed option for navbar
			$(".navbar").addClass("very-top");
			$(".to_top").addClass("to_top_bottom");
		}
		
	});
	

	// for email subscription
	var email;
	$("body").on("click" , ".prespective-subscribe .send-subscribe-email" , function(){
		
		$(this).html('<p class="lead"style="color:#FFF;font-size:15px;margin-bottom:0px">Sending...</p>');

		email 	= $(".prespective-subscribe input[type='email']").val().trim();
		if(email.length > 0 && email.indexOf("@") > 2){
			$.ajax({
				url:	"php/email_subscribe.php",
				method:	"POST",
				dataType:	"text",
				data:	{email:email},
				success:	function(text){
					if(text == 'success'){
						
						$(".prespective-subscribe .prespective-subscribe").addClass("rotated_perspective");
						$(".sub-result").html("");
						
					}else if(text == 'exist'){
						$(".sub-result").html('<p class="text-danger">This Email Is Already Exists.</p>');
						$(".send-subscribe-email").html('<i class="fas fa-paper-plane "style="color:white"></i>');
					}
				}
			});
		}else{
			$(".sub-result").html('<p class="text-danger">Email Is Not Valid.</p>');
			$(".send-subscribe-email").html('<i class="fas fa-paper-plane "style="color:white"></i>');
		}
	});
	
	// for sending faculty name
	$("body").on("click" , ".prespective-subscribe .send-subscribe-faculty" , function(){
		
		$(this).html('<p class="lead"style="color:#000;font-size:15px;margin-bottom:0px">Sending...</p>');

		var faculty	= $(".prespective-subscribe input[type='text']").val().trim();
		if(faculty.length > 2 ){
			$.ajax({
				url:	"php/email_subscribe.php",
				method:	"POST",
				dataType:	"text",
				data:	{faculty:faculty,email:email},
				success:	function(text){
					
					if(text == 'success'){
						
						$(".prespective-subscribe .prespective-subscribe").fadeOut(400 , function(){
							$(this).replaceWith("<div class='text-center alert alert-success'>You Have Successfully Subscribed To Our News Letter.");
							$(".sub-result").remove();
						});
						
					}else if(text == 'error'){
						$(".sub-result").html('<p class="text-danger">Error While Sending Subscription Form.</p>');
						$(".send-subscribe-faculty").html('<i class="fas fa-paper-plane "style="color:white"></i>');
					}
				}
			});
		}else{
			$(".sub-result").html('<p class="text-danger">Please Provid a valid faculty name.</p>');
			$(".send-subscribe-faculty").html('<i class="fas fa-paper-plane "style="color:white"></i>');
		}
		
		
	});
	
	
	
});