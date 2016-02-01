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

function prdtZZim(idx, is_hotdeal){
	var adr_ctr = $("#adr_ctr").val();
	
	$.ajax({
		async: false,
		data: {
			idx: idx,
			is_hotdeal: is_hotdeal
		},
		type: 'post',
		url: adr_ctr + 'Mypage/addZZim',
		success: function(result){
			result = JSON.parse(result);
			
			if (result.code == 1)
				alert('찜한 상품에 추가되었습니다.');
			else
				alert('잘못된 접근입니다.');
		},
		error: function(request, status, error){
			console.log(request.responseText);
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}