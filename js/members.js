$(document).ready(function(){
	
	var mixer = mixitup('.mixes');
	
	// for sorting members
	$(".members li").click(function(){
		var clas = $(this).attr("data-filter");
		$(clas + " img").each(function(){
			var src = $(this).attr("data-src");
			$(this).attr("src" , src);
		});
		
		$(this).siblings("li").each(function(){
			$(this).removeClass("active");
		});
		$(this).addClass("active");
		var title 		= $(this).attr("data-title");
		var description = $(this).attr("data-description");
		$(".c-title").text(title);
		$(".c-description").text(description);
		
	});
	
	var search = location.search;
	if(	search.indexOf("c") >= 1){
		
		search = "." + search.split("=")[1];
		
		$(".members li[data-filter='" + search + "']").click();
		$(window).scrollTop(500);
	}else{
		$(".members li:nth-of-type(1)").click();
	}
	
	
});