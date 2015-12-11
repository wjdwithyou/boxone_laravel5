$(document).ready(function(){
	
	
	$("#hotdeal_cate").on('change', function(){
		hotdealHref("","","1");
	});
	
	$("#order_list").on('change', function(){
		hotdealHref("","","1");
	});
});

function hotdealHref(cate, sort, page)
{
	var adr_ctr = $("#adr_ctr").val();
	
	if (cate == "")
		cate = $("#hotdeal_cate").val();
	
	if (sort == "")
		sort = $("#order_list").val();
	
	if (page == "")
		page = $("#nowPage").val();
	
	if (sort != "5")
		location.href = (adr_ctr + "Hotdeal/indexCode?cate="+cate+"&page="+page+"&sort="+sort);
	else
		location.href = (adr_ctr + "Hotdeal/indexCode?sort="+sort);
}

function hotdealConnect(idx, url)
{
	$.ajax
	({
		url: adr_ctr+"Hotdeal/hitCountPlus",
		type: 'post',
		async: false,
		data:{
			idx: idx
		},
		success: function(result)
		{
			window.open(url);
			//alert (JSON.stringify(result));
			//result = JSON.parse(result);
		},
		error: function(request,status,error)
		{
			console.log(request.responseText);
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}

function hotdealBookmark(adr, idx)
{
	var logined = $("#logined").val();
	if (logined == 0)
		login_popup();
	else
		$.ajax
		({
			url: adr_ctr+"Hotdeal/hotdealBookmark",
			type: 'post',
			async: false,
			data:{
				idx: idx
			},
			success: function(result)
			{
				result = JSON.parse(result);
				var adr_img = $("#adr_img").val();
				if (result.code == 1 || result.code == "1")
				{
					adr.attr("src", adr_img+"heart_on.png");
					alert ("핫딜 북마크에 추가되었습니다.");
				}
				else
				{
					adr.attr("src", adr_img+"heart.png");
					alert ("핫딜 북마크에서 삭제되었습니다.");
				}
					
				window.open(url);
				//alert (JSON.stringify(result));
				//result = JSON.parse(result);
			},
			error: function(request,status,error)
			{
				console.log(request.responseText);
			    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
}