$(document).ready(function() {
	$("#select_orderby").on('change', function(){
		var sort = $("#select_orderby").val() + "";
		if (sort != "5")
			getPrdt('','',"1");
		else
		{
			var logined = $("#logined").val();
			if (logined == "0")
				location.href = adr_ctr + "Login/index";
			else
				getPrdt('','5','1');
		}
	});
});

function getPrdt(cate, sort, page)
{
	if (cate == '')
		cate = $("#select_cate").val();
	if (sort == '')
		sort = $("#select_orderby").val();
	if (page == '')
		page = d;
	
	location.href = adr_ctr + "Shoppingbox/index?cate=" + cate + "&sort=" + sort + "&page=" + page;
}

function collapseBrand(){
	if($("#brand_wrap").is(":visible")){
		$("#collapse_brand_btn img").attr("src", adr_img + "collapse_p.png");
		$("#brand_wrap").hide();
	}
	else{
		$("#collapse_brand_btn img").attr("src", adr_img + "collapse_m.png");
		$("#brand_wrap").show();
	}
}
