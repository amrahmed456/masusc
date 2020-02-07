$(document).ready(function(){
		
	// add class img-fluid to all imgs in content area
	$(".article-content .content img").each(function(){
		$(this).addClass("img-fluid");
	});
	
	var el = $(".content").text().trim().substr(0 , 1);
	
	if(/^[a-zA-Z]+$/.test(el)){
		// english content
		$(".content").css({
			"direction":"ltr",
			"text-align":"left"
		});
	}else{
		// arabic content
		$(".content").css({
			direction:"rtl",
			textAlign:"right",
			fontFamily: "Cairo, sans-serif"
		});
	}

	
});