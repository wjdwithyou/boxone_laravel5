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
			$("#site_list").html(result);
		},	
		error:function(request,status,error)
		{
			//console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		    //alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			alert ("잠시 후에 다시 시도해 주세요.");
		}
	});
}