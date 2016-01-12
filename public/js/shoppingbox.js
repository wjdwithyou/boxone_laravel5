$(document).ready(function() {
	$(".product_div2").height($(".product_div").height());
	
	$(window).resize(function() {
		$(".product_div2").height($(".product_div").height());
	});
	
	$("#product_cate").on('change', function(){
		getPrdt('','',"1");
	});
	
	$("#order_list").on('change', function(){
		var sort = $("#order_list").val() + "";
		if (sort != "5")
			getPrdt('','',"1");
		else
			getPrdt('1','5','1');
	});
});

function getPrdt(cate, sort, page)
{
	if (cate == '')
		cate = $("#product_cate").val();
	if (sort == '')
		sort = $("#order_list").val();
	if (page == '')
		page = d;
	
	var adr_ctr = $("#adr_ctr").val();
	
	location.href = adr_ctr + "Shoppingbox/index?cate=" + cate + "&sort=" + sort + "&page=" + page;
}