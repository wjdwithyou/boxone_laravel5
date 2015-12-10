$(document).ready(function(){	
	getCardListAll(1);
	
	/*
	 * 2015.11.27
	 * 작성자 : 박용호
	 * 카드 이름으로 검색 작성 후 엔터 키 누를 시 결과 노출
	 */
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


/*
 * 2015.11.27
 * 작성자 : 박용호
 * 카드 리스트 가져오기
 * type 1:이름으로 검색, 2:배송대행지로 검색, 3:카드사로 검색
 */
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
}

/*
 * 2015.11.27
 * 작성자 : 박용호
 * 카드 리스트 전체 가져오기
 * type 1:모든 전체, 2:배송대행지 해당 카드 전체, 3:해외 직구 카드 전체
 */
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
}