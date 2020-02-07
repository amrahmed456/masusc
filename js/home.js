$(document).ready(function(){
	
	
	$(".main").css("min-height",winH);
	
	$(window).resize(function(){
		winH = $(window).innerHeight();
		$(".main").css("min-height",winH);
	});
	
	// to top button
	$(".leave-main").click(function(){
		$("html,body").animate({
			scrollTop:$(".feat").offset().top - 50
		},500);
	});
	
	// for writing effect on main screen
	var sentences = new Array("Material Advantage SUSC" , "Outstanding Chapter #1" , "#GoBeyondLimits");
	var sentenceNum = 0;
	var sentsLen = sentences.length;
	var currentSentence,exploded,currentLoc,curSentLen;
	
	function writeToMain(){
			
			$(".main .writing-jam").html("");
			currentSentence = sentences[sentenceNum];
			exploded = currentSentence.split("");
			currentLoc = 0;
			curSentLen = currentSentence.length;
		
		var interval = setInterval(function(){
			
			if(currentLoc == curSentLen){
				
				if(sentenceNum == sentsLen-1){
					sentenceNum = 0;
					clearInterval(interval);
					setTimeout(function(){
						var myPos = curSentLen;
						var clrStr = setInterval(function(){
							if(myPos == 0){
								
								clearInterval(clrStr);
								writeToMain();
							}else{
								var myStr = currentSentence.substr(0,myPos);
								myPos--;
								$(".main .writing-jam").html(myStr);
							}
							
						},15);
						
						
					},4000);
				}else{
					
					clearInterval(interval);
					setTimeout(function(){
						var myPos = curSentLen;
						var clrStr = setInterval(function(){
							if(myPos == 0){
								
								clearInterval(clrStr);
								writeToMain();
							}else{
								var myStr = currentSentence.substr(0,myPos);
								myPos--;
								$(".main .writing-jam").html(myStr);
							}
							
						},15);
						
						
					},4000);
					sentenceNum++;
				}
				
			}else{
				$(".main .writing-jam").append(exploded[currentLoc]);
				currentLoc++;
			}
			
		},60);
		
		
	};
	writeToMain();
	
	// for committies carousel plugin
	$('.owl-committe').owlCarousel({
		loop:true,
		margin:10,
		nav:false,
		dots:false,
		autoplay:true,
		autoplayTimeout:4000,
		responsive:{
			0:{
				items:1.1
			},
			600:{
				items:2.25
			},
			1000:{
				items:3.25
			}
		}
	});
	$('.sayings').owlCarousel({
		loop:true,
		margin:10,
		nav:true,
		dots:false,
		autoplay:true,
		autoplayTimeout:6000,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
	
});