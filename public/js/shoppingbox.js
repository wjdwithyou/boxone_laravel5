$(document).ready(function() {
	$("#select_cate").on('change', function(){
		getPrdt('','',"1");
	});
	
	$("#select_orderby").on('change', function(){
		var sort = $("#select_orderby").val() + "";
		if (sort != "5")
			getPrdt('','',"1");
		else
			getPrdt('','5','1');
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