/*
 * 2015.11.24 
 * 작성자 : 박용호
 * 계산기  큰 카테고리 선택 시 작은 카테고리 가져오기
 */
var tax;
function selectHighcate(){
	var cate = $("#high_cate").val();
	
	$.ajax
	({
		url: adr_ctr+"Sidemenu/getCateMedium",
		type: 'post',
		data: {
			cate: cate
		},		
		success: function(result)
		{
			result = JSON.parse(result);
			var i;
			$("#low_cate").html('');
			for (i = 0 ; i < result.length ; i++)
				$("#low_cate").append('<option value="'+result[i].idx+'">'+result[i].name+'</option>');
		},
		error: function(request,status,error)
		{
			console.log(request.responseText);
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}

/*
 * 2015.11.24 
 * 작성자 : 박용호
 * 계싼기 작은 카테고리 선택 시, 국가선택이 이미 되어 있으면 안심구매금액 변경
 */
function selectLowcate(){
	var cur = $("#select_country").val();
	if (cur != "")
		change_ansim();
}

// 내가바로 환율이다!!!!!!!
var exchange_rate = 
{
	미선택:"",
	NLG:"561.0",
	DEM:"632.09",
	USD:"1156.89",
	ESP:"7.4301",
	GBP:"1761.85",
	EUR:"1236.34",
	JPY:"9.3965",
	CNY:"180.74",
	FRF:"188.47",
	AUD:"823.81",
	HKD:"149.23"
};

/*
 * 2015.11.24 
 * 작성자 : 박용HoHo
 * 국가선택 변경 시 환율 및 통화 변경, 카테고리 선택이 되어 있으면 안심구매금액 변경
 */
function select_country(){
	var cur = $("#select_country").val();
	var rate = exchange_rate[cur];

	if(cur !== "")
		$("#exchange_rate").show();
	else
		$("#exchange_rate").hide();
		
	$("#monetary").text(cur);
	$("#rate").text(rate);
	$("#input_price").val("");

	change_ansim();
	get_weight_cost();
}

/*
 * 2015.11.24 
 * 작성자 : 박용Ho!
 * 안심구매금액 처리
 */
var tax;
var ansim;
function change_ansim()
{
	var cur = $("#select_country").val();
	var cate = $("#low_cate").val();
	
	$.ajax
	({
		url: adr_ctr+"Sidemenu/getCateTax",
		type: 'get',
		data: {
			cate: cate
		},		
		success: function(result)
		{
			tax = JSON.parse(result);
			if (cur == "USD")
			{
				//alert (tax.status);
				if (Number(tax.status) == 1)
				{
					ansim = 200;
					$("#ansim").html("200&nbsp;USD");
				}
				else
				{
					ansim = 150;
					$("#ansim").html("150&nbsp;USD");
				}
			}
			else
			{
				ansim = parseFloat("200") * parseFloat(exchange_rate["USD"]) / parseFloat(exchange_rate[cur]);
				$("#ansim").html(ansim.toFixed(2)+"&nbsp;"+cur);
			}			
		},
		error: function(request,status,error)
		{
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});

	
}


/*
 * 2015.11.24 
 * 작성자 : 박용호
 * 상품가격, 선편요금, 관세, 부가세 계산
 */
function calculate_all()
{
	var cate = $("#low_cate").val();
	var cur = $("#select_country").val();
	var prdt_price = $("#input_price").val();
	var weight = $("#input_weight").val();
	var rate = parseFloat(exchange_rate[cur]);
	
	var patternNum = /[0-9]/;

	if (cur == "")
	{
		alert ("국가를 선택해주세요.");
	}
	else if (prdt_price == "")
	{
		alert ("상품 가격을 입력해주세요.");
	}
	else if (!patternNum.test(prdt_price))
	{
		alert ("상품 가격은 숫자만 입력가능합니다.");
	}
	else if (weight == "")
	{
		alert ("상품 무게를 입력해주세요.");
	}
	else if (!patternNum.test(weight))
	{
		alert ("상품 무게는 숫자만 입력가능합니다.");
	}
	else
	{
		// 상품가격 출력
		var price = parseFloat(prdt_price) * rate;
		$("#price_money").text(comma(price.toFixed(0)));
		
		// 선편요금 출력
		var weight_tax;
		var status;
		var region;
		var unit = $("#select_weight").val();
		
		if (unit == "lbs")
			weight *= 2;
		if (price <= 200000)
			status = 1;
		else
			status = 2;
		if (cur == "CNY" || cur == "HKD" || cur == "JPY")
			region = 1;
		else 
			region = 3;

		$.ajax
		({
			url: adr_ctr+'Sidemenu/getWeightTax',
			type: 'post',
			async: false,
			data: {
				status: status,
				region: region,
				weight: weight
			},
			success: function(result)
			{
				weight_tax = Number(result);
				$("#weight_money").text(comma(result));		
				
				// 관세, 부가세 출력
				var ks = 0;
				var bgs = 0;
				if ((Number(price)+weight_tax) > ansim * parseFloat(exchange_rate[cur]))
				{
					ks = Number((price + weight_tax) * parseFloat(tax.duty));
					bgs = (price + weight_tax + ks) * parseFloat(tax.surtax);
				}
				
				$("#duty_money").text(comma(ks.toFixed(0)));
				$("#surtax_money").text(comma(bgs.toFixed(0)));
				$("#cal_result_table").show();
				$(".modal-dialog").css("height", "auto");
				
			},
			error: function(request,status,error)
			{
			    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
					
		
	}
}

/*
 * 2015.11.24 
 * 작성자 : 박용호
 * 세자리마다 콤마 붙이기
 */
function comma(num){
    var len, point, str;
       
    num = num + "";  
    point = num.length % 3 ;
    len = num.length;  
   
    str = num.substring(0, point);  
    while (point < len) {  
        if (str != "") str += ",";  
        str += num.substring(point, point + 3);  
        point += 3;  
    }  
     
    return str;
 
}

