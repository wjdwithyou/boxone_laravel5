function sortByChar(cate, char)
{	
	var adr_img = $("#adr_img").val();
	$.ajax
	({
		url: adr_ctr+'Bestranking/sortByChar',
		type: 'post',
		data: {
			cate: cate,
			char: char,
			adr_img: adr_img
		},		 
		success: function(result)
		{
			$("#br_site_wrap").html(result);
		},	
		error:function(request,status,error)
		{
			//console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		    //alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			alert ("잠시 후에 다시 시도해 주세요.");
		}
	});
}

// 160203 Modified by J.Style
// No comment.
function clickBookmark(img, site){
	var logined = $("#logined").val();
	
	if (logined == "0")
		moveLogin();
	else{
		$.ajax({
			async: false,
			data: {
				site: site
			},
			type: 'post',
			url: adr_ctr + 'Bestranking/checkBookmark',
			success: function(result){
				//alert (JSON.stringify(result));
				result = JSON.parse(result);
				
				if (result.code == 1){
					var adr_img = $("#adr_img").val();
					
					if (result.data == 'create'){
						alert ("북마크에 추가되었습니다.");
						img.attr("src", adr_img+"bookmark_on.png");
					}
					else if (result.data == 'delete'){
						alert ("북마크에서 삭제되었습니다.");
						img.attr("src", adr_img+"bookmark.png");
					}
					else if (result.data == 'max_exceed')
						alert ('즐겨찾기는 최대 10개까지만 저장할 수 있습니다.');
					else
						alert ('잘못된 접근입니다.');
				}
				else
					alert ("잠시 후에 다시 시도해주세요.");
			},	
			error:function(request, status, error){
				//console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			    //alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				alert ("잠시 후에 다시 시도해 주세요.");
			}
		});
	}
}

