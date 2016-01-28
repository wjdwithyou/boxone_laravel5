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
	$("input:checkbox[name='brandList']").each(function(){
		if (this.checked)
			brand.push(this.value);
	});
	brand = JSON.stringify(brand);
	var mall = [];
	$("input:checkbox[name='mallList']").each(function(){
		if (this.checked)
			mall.push(this.value);
	});
	mall = JSON.stringify(mall);
	
	location.href = adr_ctr + "Shoppingbox/index?cate=" + cate + "&search=" + search + "&brand=" + brand + "&mall=" + mall + "&sort=" + sort + "&page=" + page;
}

function collapseOption(type){
	var t = "#" + type;
	
	if($(t + "_wrap").is(":visible")){
		$(t + "_collapse_btn img").attr("src", adr_img + "collapse_p.png");
		$(t + "_wrap").hide();
	}
	else{
		$(t + "_collapse_btn img").attr("src", adr_img + "collapse_m.png");
		$(t + "_wrap").show();
	}
}
