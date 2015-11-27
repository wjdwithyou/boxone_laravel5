$(document).ready(function(){	
	getCardListAll(1);
	
	$("#card_name_search_input").keyup(function(e){
		if (e.keyCode == 13)
			getCardList(1);
	});
	
	$("#card_proxy_search_input").on('change', function(){
		getCardList(2);
	});
	
	$("#card_benefit_search_input").on('change', function(){
		getCardList(3);
	});
});

function getCardList(type)
{
	var search;
	var adr_img = $("#adr_img").val();
	
	if (type == 1)
		search = $("#card_name_search_input").val();
	else if (type == 2)
		search = $("#card_proxy_search_input").val();
	else
		search = $("#card_benefit_search_input").val();
	
	$.ajax
	({
		url: adr_ctr+'Card/getCardList',
		type: 'post',
		data: {
			type: type,
			search: search,
			adr_img: adr_img
		},		 
		success: function(result)
		{
			$("#card_result_wrap").html(result);
		},	
		error:function(request,status,error)
		{
			//console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		    //alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			alert ("잠시 후에 다시 시도해 주세요.");
		}
	});
	
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("#token_renew").val()
        }
	});
}

function getCardListAll(type)
{
	var adr_img = $("#adr_img").val();
	
	$.ajax
	({
		url: adr_ctr+'Card/getCardListAll',
		type: 'post',
		data: {
			type: type,
			adr_img: adr_img
		},		 
		success: function(result)
		{
			$("#card_result_wrap").html(result);
		},	
		error:function(request,status,error)
		{
			//console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		    //alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			alert ("잠시 후에 다시 시도해 주세요.");
		}
	});
	
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("#token_renew").val()
        }
	});
}