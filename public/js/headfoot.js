$(document).ready(function(){
	if ($("#need_login").val() == "1")
		login_popup();
});

function cal_toggle(){
	var adr_img = $("#adr_img").val();
	if($("#cal_popup").is(":visible")){
		$("#header_cal").attr("src", adr_img + "header_cal.png");
	}
	else {
		$("#header_cal").attr("src", adr_img + "header_cal_on.png");
	}
	
	if ($("#select_cate").html() == "")
	{
		get_cate_large();
		select_cate();
	}
	
	$("#cal_popup").toggle();
}
