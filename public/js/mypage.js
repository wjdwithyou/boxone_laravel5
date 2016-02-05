function deleteWishlist(idx, is_hotdeal){
	$.ajax({
		async: false,
		data: {
			idx: idx,
			is_hotdeal: is_hotdeal
		},
		type: 'post',
		url: adr_ctr + 'Mypage/deleteWishlist',
		success: function(result){
			result = JSON.parse(result);
			
			if (result.code == 1){
				alert('찜한 상품이 삭제되었습니다.');
				location.href = adr_ctr + "Mypage/index";
			}
			else
				alert('잘못된 접근입니다.');
		},
		error: function(request, status, error){
			console.log(request.responseText);
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}