function toggleState(e){
	if(e.siblings(".dc_state_wrap").is(":visible")){
		e.siblings(".dc_state_wrap").hide();
		e.children().eq(1).children().addClass("fa-chevron-circle-down").removeClass("fa-chevron-circle-up").css("color", "#8c8b8b");
	}
	else{
		e.siblings(".dc_state_wrap").show();
		e.children().eq(1).children().addClass("fa-chevron-circle-up").removeClass("fa-chevron-circle-down").css("color", "#92a9dd");
	}
}
