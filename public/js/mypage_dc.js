function toggleState(e){
	if(e.siblings(".dc_state_wrap").is(":visible")){
		e.siblings(".dc_state_wrap").hide();
		e.children().eq(1).children().addClass("fa-chevron-circle-down").removeClass("fa-chevron-circle-up").css("color", "#8c8b8b");
	}
	else{
		e.siblings(".dc_state_wrap").show();
		e.children().eq(1).children().addClass("fa-chevron-circle-up").removeClass("fa-chevron-circle-down").css("color", "#92a9dd");
	}
}


function deleteDelivery(idx)
{
	$.ajax
	({
		url: adr_ctr+"Deliver/deleteDelivery",
		type: 'post',
		async: false,
		data:{
			idx: idx
		},
		success: function(result)
		{
			console.log(result);
			result = JSON.parse(result);
			if (result.code == "1")
			{
				alert ("정상적으로 삭제되었습니다.");
				location.reload();
			}
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

function deleteEntry(idx)
{
	$.ajax
	({
		url: adr_ctr+"Deliver/deleteEntry",
		type: 'post',
		async: false,
		data:{
			idx: idx
		},
		success: function(result)
		{
			console.log(result);
			result = JSON.parse(result);
			if (result.code == "1")
			{
				alert ("정상적으로 삭제되었습니다.");
				location.reload();
			}
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