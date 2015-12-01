$(document).ready(function(){	
	$("#rw_search_text").keyup(function(e){
		if (e.keyCode == 13)
			searchReward();
	});
});

function searchReward()
{	
	var text = $("#rw_search_text").val();
	var adr_img = $("#adr_img").val();
	
	$.ajax
	({
		url: adr_ctr+'Reward/searchReward',
		type: 'post',
		data: {
			text: text,
			adr_img: adr_img
		},		 
		success: function(result)
		{
			$("#rw_result").html(result);
		},	
		error:function(request,status,error)
		{
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		    //alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			//alert ("잠시 후에 다시 시도해 주세요.");
		}
	});
}
