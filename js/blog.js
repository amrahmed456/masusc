$(document).ready(function(){
	$(".top-hero,#particles-js").css("min-height" , winH*0.8);
	$(window).resize(function(){
		var winH = $(window).innerHeight();
		$(".top-hero,#particles-js").css("min-height" , winH*0.8);
	});
	
	
	$("body").on("click" , ".members li" , function(){
		$(".members ul li").each(function(){
			$(this).removeClass("active");
		});
		$(this).addClass("active");
		var filter_by = $(this).attr("data-by");
		$(".filter-by").text(filter_by);
	});
	var mixer = mixitup('.mixes');
	
});