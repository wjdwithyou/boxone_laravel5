$(document).ready(function(){
	checkCate(1);

	$("#community_cate").on('change', function(){
		var cate = $("#community_cate").val();
		var adr_ctr = $("#adr_ctr").val();
		location.href = adr_ctr+'Community/index?cate='+cate;
	});
});

function changePageType()
{
	var value = $("#cm_page_type_button").attr("value");
	if (value != '0')
		$("#cm_page_type_button").attr("value", "0");
	else
		$("#cm_page_type_button").attr("value", "1");
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
				cate.push(this.id);
		});
	}
	
	var adr_img = $("#adr_img").val();
	
	var page_type = $('#cm_page_type_button').attr("value");
	
	if (page == '')
		page = $("#cm_nowPage").val();
	
	$.ajax
	({
		url: adr_ctr+"Community/getInfo",
		type: 'post',
		async: false,
		data:{
			cate: JSON.stringify(cate),
			adr_img: adr_img,
			page_type: page_type,
			paging: page
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

