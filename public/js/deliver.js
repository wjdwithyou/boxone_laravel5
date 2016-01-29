
// naver 감사합니다.

var dtd_companys = new Array();
dtd_companys.push(new Array("CJ대한통운", 12, "http://www.doortodoor.co.kr", "CJ"));
dtd_companys.push(new Array("우체국택배", 13, "http://parcel.epost.go.kr", "postbox"));
dtd_companys.push(new Array("한진택배", 12, "http://hanex.hanjin.co.kr", "hanjin"));
dtd_companys.push(new Array("현대택배", 12, "http://www.hlc.co.kr", "hyundai"));
dtd_companys.push(new Array("로젠택배", 11, "http://www.ilogen.com", "logen"));
dtd_companys.push(new Array("KG로지스", 12, "http://www.kgbls.co.kr", "KG"));
dtd_companys.push(new Array("CVSnet편의점택배", 10, "http://www.cvsnet.co.kr/", "CVS"));
dtd_companys.push(new Array("KGB택배", 10, "http://www.kgbls.co.kr/", "KGB"));
dtd_companys.push(new Array("경동택배", 12, "http://www.kdexp.com/", "kd"));
dtd_companys.push(new Array("대신택배", 13, "http://apps.ds3211.co.kr", "ds"));
dtd_companys.push(new Array("일양로지스", 9, "http://www.ilyanglogis.com/", "ilyang"));
dtd_companys.push(new Array("합동택배", 13, "http://www.hdexp.co.kr/", "hapdong"));
dtd_companys.push(new Array("GTX로지스", 11, "http://home.gtxlogis.co.kr/", "GTX"));
dtd_companys.push(new Array("건영택배", 10, "http://www.kunyoung.com/", "kunyoung"));
dtd_companys.push(new Array("천일택배", 11, "http://www.chunil.co.kr/", "chunil"));
dtd_companys.push(new Array("한의사랑택배", 13, "http://www.hanips.com/", "han"));
dtd_companys.push(new Array("굿투럭", 10, "http://www.goodstoluck.co.kr/", "gtl"));
dtd_companys.push(new Array("FedEx", 30, "http://www.fedex.com/kr/", "FedEx"));
dtd_companys.push(new Array("EMS", 13, "http://service.epost.go.kr", "EMS"));
dtd_companys.push(new Array("DHL", 13, "http://www.dhl.co.kr", "DHL"));
dtd_companys.push(new Array("UPS", 13, "http://www.ups.com/content/kr/ko/index.jsx", "UPS"));
dtd_companys.push(new Array("TNTExpress", 9, "http://www.tnt.com/express/ko_kr/site/home.html", "TNT"));

$(document).ready(function(){
	$("#delivery_office").html("");
	var i = 0;
	for (i = 0 ; i < dtd_companys.length ; i++)
		$("#delivery_office").append("<option value='"+i+"'>"+dtd_companys[i][0]+"</option>");
	
	$("#entry_year").html("");
	var i = 0;
	for (i = 2015 ; i > 1995 ; i--)
		$("#entry_year").append("<option value='"+i+"-01-01"+"'>"+i+"년</option>");
});

function parcel()
{
	$("#parcel").show();
	$("#customs").hide();
	$("#parcel_tab").removeClass("notselected_tab").addClass("selected_tab");
	$("#customs_tab").removeClass("selected_tab").addClass("notselected_tab");
}

function customs()
{
	$("#parcel").hide();
	$('#customs').show();
	$("#parcel_tab").removeClass("selected_tab").addClass("notselected_tab");
	$("#customs_tab").removeClass("notselected_tab").addClass("selected_tab");
}

function deliverySearch() 
{
	var company_info = dtd_companys[$("#delivery_office").val()];
	var company = company_info[0];
	var num = $("#delivery_num").val();
	
	if (company == "경동택배" || company == "대신택배" || company == "일양로지스" || company == "한의사랑택배" || company == "FedEx" || company == "DHL" || company == "UPS")
	{
		if (confirm("위 사이트는 새창으로 연결됩니다. 연결하시겠습니까?"))
			window.open(company_info[2]);
	}
	else
	{
		/* 운송장 번호 값 확인 */
		if (company == "UPS") 
		{
			var pattern1 = /^[0-9a-zA-Z]{9,12}$/i;
			var pattern2 = /^[0-9a-zA-Z]{18}$/i;
			var pattern3 = /^[0-9a-zA-Z]{25}$/i;
			if (pattern1.test(num) && pattern2.test(num) && pattern3.test(num)) 
			{
				alert(company + "의 운송장 번호 패턴에 맞지 않습니다.");
				$("#delivery_num").val("").focus();
				return false;
			}
		} 
		else if (company == "FedEx") 
		{
			if (!isNumeric(num)) 
			{
				alert("운송장 번호는 숫자만 입력해 주세요.");
				$("#delivery_num").val("").focus();
				return false;
			} 
			else if (company_info[1] > 0 && company_info[1] < num.length) 
			{
				alert(company + "의 운송장 번호는 " + company_info[1] + "자리의 숫자로 입력해 주세요.");
				$("#delivery_num").val("").focus();
				return false;
			}
		}
		else if (company == "EMS") 
		{
			var pattern = /^[a-zA-Z]{2}[0-9]{9}[a-zA-Z]{2}$/;
			if (!pattern.test(num)) 
			{
				alert(company + "의 운송장 번호 패턴에 맞지 않습니다.");
				$("#delivery_num").val("").focus();
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
				$("#delivery_num").val("").focus();
				return false;
			}
		} 
		else 
		{
			if (!isNumeric(num)) 
			{
				alert("운송장 번호는 숫자만 입력해 주세요.");
				$("#delivery_num").val("").focus();
				return false;
			} 
			else if (company_info[1] > 0 && company_info[1] != num.length) 
			{
				alert(company + "의 운송장 번호는 " + company_info[1] + "자리의 숫자로 입력해 주세요.");
				$("#delivery_num").val("").focus();
				return false;
			}
		}
		
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
				$("#bo_dialog_content").html(result).trigger("create");
			},
			error: function(request,status,error)
			{
				console.log(request.responseText);
			    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	}
	//window.open(url, "_blank");
}

function entrySearch()
{
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
			$("#bo_dialog_content").html(result).trigger("create");
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
		moveLogin();
	}
	else
	{	
		var office = $("#delivery_office_value").val();		
		var num = $("#delivery_num_value").val();
		var prdt = $("#delivery_prdt_value").val();
		var state = $("#delivery_state_value").val();
		
		//alert (office+" "+num+" "+prdt);
		
		$.ajax
		({
			url: adr_ctr+"Deliver/createDelivery",
			type: 'post',
			async: false,
			data:{
				office: office,
				num: num,
				prdt: prdt,
				state: state
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
		moveLogin();
	}
	else
	{	
		var num = $("#entry_num_value").val();
		var year = $("#entry_year_value").val();
		var state = $("#entry_state_value").val();
		
		//alert (office+" "+num+" "+prdt);
		
		$.ajax
		({
			url: adr_ctr+"Deliver/createEntry",
			type: 'post',
			async: false,
			data:{
				num: num,
				year: year,
				state: state
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





