$(document).ready(function(){


	// expand latest info
	$(".expand-lateset").click(function(){
		$(this).parent().next("ul").slideToggle();
	});
	
	// for required fields asterisk
	$("input[required='']").each(function(){
		$(this).after("<span class='asterisk'>*</span>");
	});

	// confirm any .confirm popup
	$(".confirm").click(function(){
		return confirm("Are you sure?");
	});
	
	
	$(".cat_card").click(function(){
		$(this).children(".full-view").toggleClass("d-none");
	});
	$(".expand").click(function(){
		// toggle between expand and collapse based on data-view options
		var data_view = $(this).attr("data-view");
		
		if(data_view == 'collapsed'){
			// turn to expand
			$(this).attr("data-view" , "expanded");
			$(".cat_card .full-view").removeClass("d-none");
			$(this).text("Collapse All");
		}else if(data_view == 'expanded'){
			// turn to collapse
			$(this).attr("data-view" , "collapsed");
			$(".cat_card .full-view").addClass("d-none");
			$(this).text("Expand All");
		}
	});
	
	/*// for rating stars in add items page
	$("body").on("mouseenter",".rating-star" , function(){
		$(this).removeClass("far").addClass("fas").css("color","orange").prevAll(".rating-star").removeClass("far").addClass("fas").css("color","orange");
		$(this).nextAll(".rating-star").removeClass("fas").addClass("far");
		var rate = $(this).data("number");
		
		$("input[name='rating']").attr("value" , rate);
		
	});
	*/
	// for real time category list while typing in items page the category name
	var select_pos = 0;
	$("input[name='cat_name']").on({
		"keydown": function(e){
			if( e.which == 13 ){
			// user clicked enter
				var input_val = $(".cat-result p.hovered").text();
				$(this).val(input_val);
				$(".cat-result").addClass("d-none");
			}
		},
		"keyup": function(e){
		
		// 40 down & 38 up && 13 enter
		
		if(e.which == 40){
			// user clicked down arrow
			
			if($(".cat-result p:eq(" + select_pos + ")").hasClass("hovered") && $(".cat-result p").length-1 != select_pos){
				select_pos += 1;
			}
			$(".cat-result p:eq(" + select_pos + ")").siblings().removeClass("hovered");
			$(".cat-result p:eq(" + select_pos + ")").addClass("hovered");
			
			
			if($(".cat-result p").length-1 > select_pos ){
				select_pos += 1;
			}
			
		}else if(e.which == 38){
			// user clicked up arrow
			if(select_pos > 0){
				select_pos -= 1;
			}
			$(".cat-result p:eq(" + select_pos + ")").siblings().removeClass("hovered");
			$(".cat-result p:eq(" + select_pos + ")").addClass("hovered");
			
			
			
		}else{
			select_pos = 0;
			var cat_name = $(this).val().trim();
			if(cat_name.length > 0){
				// send a request to same page with do=search_category & cat_name=val
				$.ajax({
					url:	"search_cat.php",
					method:	"POST",
					dataType:	"text",
					data:	{cat_name:cat_name},
					success:function(text){
						if(text != 'not_found'){
							// there's data found
							
							$(".cat-result").html(text).removeClass("d-none");
						}else if(text == 'not_found'){
							$(".cat-result").html("").addClass("d-none");
						}
					}
				});
			}else{
				$(".cat-result").addClass("d-none");
			}
		}
		
	}/*,
	
	"blur" :	function(){
			$(".cat-result").addClass("d-none");
	}*/
		
	});
	
	$("body").on("click",".cat-result p",function(){
	
		var select_text = $(this).text().trim();
		$("input[name='cat_name']").val(select_text);
		$(".cat-result").addClass("d-none");
		
	});
	
	
	$("input[name='articleImage']").on('change',function(){
		//get the file name
		
		var fileName = $(this).val();
		//replace the "Choose a file" label
		$(this).siblings('.custom-file-label').html(fileName);
	})
	
	
});