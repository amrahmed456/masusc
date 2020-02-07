$(document).ready(function(){
	// for mixitup gallery shuffle
	if($(".mixes").length > 0){
			var mixer = mixitup('.mixes');
	}
	// for sorting events
	$(".prev-events li").click(function(){
		
		$(this).siblings("li").each(function(){
			$(this).removeClass("active");
		});
		$(this).addClass("active");
		
	});
	
	
	$('.upcoming-owl').owlCarousel({
		loop:false,
		margin:10,
		nav:true,
		dots:true,
		center:true,
		autoplay:true,
		autoplayTimeout:6000,
		responsive:{
			0:{
				items:1.1
			},
			600:{
				items:2.2
			},
			1000:{
				items:3.3
			}
		}
	});
});