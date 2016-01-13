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