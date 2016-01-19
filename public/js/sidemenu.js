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

function openModal(addr){
	switch(addr){
		case "love":
			$("#modal_title").text("찜한상품");
			break;
		case "bookmark":
			$("#modal_title").text("즐겨찾기");
			break;
		case "recently":
			$("#modal_title").text("최근본상품");
			break;
		case "calculator":
			$("#modal_title").text("관세계산");
			break;
		case "deliver":
			$("#modal_title").text("배송통관");
			break;
	}
	loadDialog(addr);
	$("#bo_modal").modal("show");
}
