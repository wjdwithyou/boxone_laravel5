$(document).ready(function(){
	var targetPage = $("#cm_target_page").val();
	checkCate(targetPage);

	$("#community_cate").on('change', function(){
		var cate = $("#community_cate").val();
		var pageType = $("#cm_page_type_button").attr("value");
		var adr_ctr = $("#adr_ctr").val();
		location.href = adr_ctr+'Community/index?cate='+cate+"&pageType="+pageType;
	});
	
	$("#cm_search_input").keyup(function(e){
		if (e.keyCode == 13)
			checkCate('');
	});
});

function changePageType()
{
	var value = $("#cm_page_type_button").attr("value");
	if (value != '0')
		$("#cm_page_type_button").attr("value", "0");
	else
		$("#cm_page_type_button").attr("value", "1");
	
	checkCate('');
}

function checkCate(page)
{
	var cate;
	if ($("input:checkbox[name='cc']").is(":checked") == false)
		cate = [$("#community_cate").val()];
	else
	{
		cate = [];
		$("input:checkbox[name='cc']").each(function(){
			//alert (this.checked);
			if (this.checked)
				cate.push(this.value);
		});
	}
	
	var adr_img = $("#adr_img").val();
	var page_type = $('#cm_page_type_button').attr("value");
	
	if (page == '')
		page = $("#cm_nowPage").val();
	
	var searchText = $("#cm_search_input").val();
	var searchType = $("#cm_cate_select").val();
	var pattern = /[^0-9a-zA-Zㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
	
	if (pattern.test(searchText))
		alert ("검색어는 숫자, 영문, 한글만 입력가능합니다.");
	else
		$.ajax
		({
			url: adr_ctr+"Community/getInfo",
			type: 'get',
			async: false,
			data:{
				cate: JSON.stringify(cate),
				adr_img: adr_img,
				page_type: page_type,
				paging: page,
				searchText: searchText,
				searchType: searchType
			},
			success: function(result)
			{
				$("#cm_contents").html(result);			
				if ($("#cm_page_type").val() != "0")
				{
					$("#cm_page_type_button").html("앨범형");
					$("#cm_page_type_button").attr("value", "1");
				}
				else
				{
					$("#cm_page_type_button").html("게시판형");
					$("#cm_page_type_button").attr("value", "0");
				}
				//alert (result);
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

function commWrite()
{
	var logined = $("#logined").val();
	var adr_ctr = $("#adr_ctr").val();
	
	if (logined == "0")
		moveLogin();
	else
		location.href = adr_ctr + "Community/indexWrite";
}

function commContent(idx)
{
	var adr_ctr = $("#adr_ctr").val();
	var page = $("#cm_nowPage").val();
	var cateS;
	if ($("input:checkbox[name='cc']").is(":checked") == false)
		cateS = $("#community_cate").val()+",";
	else
	{
		cateS = "";
		$("input:checkbox[name='cc']").each(function(){
			//alert (this.checked);
			if (this.checked)
				cateS += this.value + ",";
		});
	}
	
	var cate = $("#community_cate").val();
	var page_type = $('#cm_page_type_button').attr("value");
	
	var url = encodeURIComponent("page=" + page + "&cateS=" + cateS + "&cate=" + cate + "&pageType=" + page_type);
	
	location.href = adr_ctr + "Community/indexContent?idx=" + idx + "&url=" + url;
	
}








