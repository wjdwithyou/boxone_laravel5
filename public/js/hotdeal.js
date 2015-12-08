$(document).ready(function(){
	
	
	$("#hotdeal_cate").on('change', function(){
		hotdealHref("","","1");
	});
	
	$("#order_list").on('change', function(){
		hotdealHref("","","1");
	});
});

// 이미지 바뀌는거 테스트 function
function add_heart(e) {
	if (e.attr('src') == '<?= $adr_img ?>heart.png')
		e.attr('src', '<?= $adr_img ?>heart_on.png');
	else
		e.attr('src', '<?= $adr_img ?>heart.png');
}

function hotdealHref(cate, sort, page)
{
	var adr_ctr = $("#adr_ctr").val();
	
	if (cate == "")
		cate = $("#hotdeal_cate").val();
	
	if (sort == "")
		sort = $("#order_list").val();
	
	if (page == "")
		page = $("#nowPage").val();
	
	location.href = (adr_ctr + "Hotdeal/indexCode?cate="+cate+"&page="+page+"&sort="+sort);
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
			console.log(result);
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