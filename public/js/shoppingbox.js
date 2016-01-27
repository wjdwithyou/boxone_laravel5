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
	
	var search = $("#integrated_search").val();
	var brand = [];
	$("input:checkbox[name='sc']").each(function(){
		//alert ($("#span"+$("this").attr("id")).css("background"));
		if (this.checked)
			brand.push(this.value);
	});
	brand = JSON.stringify(brand);
	
	location.href = adr_ctr + "Shoppingbox/index?cate=" + cate + "&search=" + search + "&brand=" + brand + "&sort=" + sort + "&page=" + page;
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
