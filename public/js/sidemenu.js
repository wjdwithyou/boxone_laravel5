$(document).ready(function(){
	
});
$(window).load(function(){
	$(".collapse_menu").each(function(){
		var cm_i = "#" + $(this).attr("id");
		var cm_it = "#sb_menu" + cm_i.substring(8, 9);
		$(cm_it).css("display", "block");
		$(cm_i).append($(cm_it));
	});
});

function collapseMenu(e){
	if(e.siblings(".collapse_menu").is(":visible")){
		e.children("img").attr("src", adr_img + "collapse_p.png");
		e.siblings(".collapse_menu").hide();
	}
	else{
		if($(".collapse_menu").is(":visible")){
			$(".collapse_menu").hide();
			$(".sm_menu_arrow").attr("src", adr_img + "collapse_p.png");
		}
		e.children("img").attr("src", adr_img + "collapse_m.png");
		e.siblings(".collapse_menu").show();
	}
	
}
