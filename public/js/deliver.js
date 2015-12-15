
// naver 감사합니다.

var dtd_companys = new Array();
dtd_companys.push(new Array("CJ대한통운", 12, "http://www.doortodoor.co.kr"));
dtd_companys.push(new Array("우체국택배", 13, "http://parcel.epost.go.kr"));
dtd_companys.push(new Array("한진택배", 12, "http://hanex.hanjin.co.kr"));
dtd_companys.push(new Array("현대택배", 12, "http://www.hlc.co.kr"));
dtd_companys.push(new Array("로젠택배", 11, "http://www.ilogen.com"));
dtd_companys.push(new Array("KG로지스", 12, "http://www.kgbls.co.kr"));
dtd_companys.push(new Array("CVSnet 편의점택배", 10, "http://www.cvsnet.co.kr/"));
dtd_companys.push(new Array("KGB택배", 10, "http://www.kgbls.co.kr/"));
dtd_companys.push(new Array("경동택배", 12, "http://www.kdexp.com/"));
dtd_companys.push(new Array("대신택배", 13, "http://apps.ds3211.co.kr"));
dtd_companys.push(new Array("일양로지스", 9, "http://www.ilyanglogis.com/"));
dtd_companys.push(new Array("합동택배", 13, "http://www.hdexp.co.kr/"));
dtd_companys.push(new Array("GTX로지스", 11, "http://home.gtxlogis.co.kr/"));
dtd_companys.push(new Array("건영택배", 10, "http://www.kunyoung.com/"));
dtd_companys.push(new Array("천일택배", 11, "http://www.chunil.co.kr/"));
dtd_companys.push(new Array("한의사랑택배", 13, "http://www.hanips.com/"));
dtd_companys.push(new Array("굿투럭", 10, "http://www.goodstoluck.co.kr/"));
dtd_companys.push(new Array("FedEx", 30, "http://www.fedex.com/kr/"));
dtd_companys.push(new Array("EMS", 13, "http://service.epost.go.kr"));
dtd_companys.push(new Array("DHL", 13, "http://www.dhl.co.kr"));
dtd_companys.push(new Array("UPS", 13, "http://www.ups.com/content/kr/ko/index.jsx"));
dtd_companys.push(new Array("TNTExpress", 9, "http://www.tnt.com/express/ko_kr/site/home.html"));

$(document).ready(function(){
	$("#delivery_office").html("");
	var i = 0;
	for (i = 0 ; i < dtd_companys.length ; i++)
		$("#delivery_office").append("<option value='"+i+"'>"+dtd_companys[i][0]+"</option>");
	
	$("#entry_year").html("");
	var i = 0;
	for (i = 2015 ; i > 1995 ; i--)
		$("#entry_year").append("<option value='"+i+"-01-01"+"'>"+i+"년</option>");
	
	$(".deliver_header_").on('click', function(){
		$(".deliver_header_").removeClass("deliver_header_selected");
		$(this).addClass('deliver_header_selected');
	});
});

function delivery_popup()
{
	$("#deliver_body").html($("#delivery1").html());
	$('#deliver_modal').modal('show');
}

function entry_popup()
{
	$("#deliver_body").html($("#entry1").html());
	$('#deliver_modal').modal('show');
}

function deliverySearch() 
{
	var company_info = dtd_companys[$("#delivery_office").val()];
	var company = company_info[0];
	var num = $("#delivery_num").val();

	/* 운송장 번호 값 확인 */
	if (company == "UPS") 
	{
		var pattern1 = /^[0-9a-zA-Z]{9,12}$/i;
		var pattern2 = /^[0-9a-zA-Z]{18}$/i;
		var pattern3 = /^[0-9a-zA-Z]{25}$/i;
		if (pattern1.test(num) && pattern2.test(num) && pattern3.test(num)) 
		{
			alert(company + "의 운송장 번호 패턴에 맞지 않습니다.");
			$("#delivery_num").focus();
			return false;
		}
	} 
	else if (company == "FedEx") 
	{
		if (!isNumeric(num)) 
		{
			alert("운송장 번호는 숫자만 입력해 주세요.");
			$("#delivery_num").focus();
			return false;
		} 
		else if (company_info[1] > 0 && company_info[1] < num.length) 
		{
			alert(company + "의 운송장 번호는 " + company_info[1] + "자리의 숫자로 입력해 주세요.");
			$("#delivery_num").focus();
			return false;
		}
	}
	else if (company == "EMS") 
	{
		var pattern = /^[a-zA-Z]{2}[0-9]{9}[a-zA-Z]{2}$/;
		if (!pattern.test(num)) 
		{
			alert(company + "의 운송장 번호 패턴에 맞지 않습니다.");
			$("#delivery_num").focus();
			return false;
		}
	} 
	else if (company == "TNT Express") 
	{
		var pattern1 = /^[a-zA-Z]{2}[0-9]{9}[a-zA-Z]{2}$/;
		var pattern2 = /^[0-9]{9}$/;
		if (num.search(pattern1) == -1 && num.search(pattern2) == -1) 
		{
			alert(company + "의 운송장 번호 패턴에 맞지 않습니다.");
			$("#delivery_num").focus();
			return false;
		}
	} 
	else 
	{
		if (!isNumeric(num)) 
		{
			alert("운송장 번호는 숫자만 입력해 주세요.");
			$("#delivery_num").focus();
			return false;
		} 
		else if (company_info[1] > 0 && company_info[1] != num.length) 
		{
			alert(company + "의 운송장 번호는 " + company_info[1] + "자리의 숫자로 입력해 주세요.");
			$("#delivery_num").focus();
			return false;
		}
	}
	
	var adr_ctr = $("#adr_ctr").val();
	$.ajax
	({
		url: adr_ctr+"Deliver/getInfoDelivery",
		type: 'post',
		async: false,
		data:{
			adr_ctr: adr_ctr,
			company: company,
			num: num
		},
		success: function(result)
		{
			console.log(result);
			$("#deliver_body").html(result).trigger("create");
			$('#deliver_modal').modal('show');
			//alert (JSON.stringify(result));
			//result = JSON.parse(result);
		},
		error: function(request,status,error)
		{
			console.log(request.responseText);
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
	//window.open(url, "_blank");
}

function entrySearch()
{
	var adr_ctr = $("#adr_ctr").val();
	var num = $("#entry_num").val();
	var year = $("#entry_year").val();
	
	$.ajax
	({
		url: adr_ctr+"Deliver/getInfoEntry",
		type: 'post',
		async: false,
		data:{
			year: year,
			num: num
		},
		success: function(result)
		{
			console.log(result);
			$("#deliver_body").html(result).trigger("create");
			$('#deliver_modal').modal('show');
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

function isNumeric(s) {
	var count = 0;
	
	for (i = 0; i < s.length; i++) 
		if (s.charAt(i) < '0' || s.charAt(i) > '9') 
			count++;
	
	if (count > 0) 
		return 0;
	else 
		return 1;
}

function createDelivery()
{
	var logined = $("#logined").val();
	if (logined == "0")
	{
		$('#deliver_modal').modal('hide');
		login_popup();
	}
	else
	{	
		var num = $("#entry_num_value").val();
		var year = $("#entry_num_value").val();
		
		//alert (office+" "+num+" "+prdt);
		
		$.ajax
		({
			url: adr_ctr+"Deliver/createEntry",
			type: 'post',
			async: false,
			data:{
				num: num,
				year: year
			},
			success: function(result)
			{
				console.log(result);
				result = JSON.parse(result);
				if (result.code == "1")
					alert ("정상적으로 추가되었습니다.");
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
}


function createEntry()
{
	var logined = $("#logined").val();
	if (logined == "0")
	{
		$('#deliver_modal').modal('hide');
		login_popup();
	}
	else
	{	
		var num = $("#delivery_office_value").val();
		var num = $("#delivery_num_value").val();
		var prdt = $("#delivery_prdt_value").html();
		
		//alert (office+" "+num+" "+prdt);
		
		$.ajax
		({
			url: adr_ctr+"Deliver/createDelivery",
			type: 'post',
			async: false,
			data:{
				office: office,
				num: num,
				prdt: prdt
			},
			success: function(result)
			{
				console.log(result);
				result = JSON.parse(result);
				if (result.code == "1")
					alert ("정상적으로 추가되었습니다.");
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
}




