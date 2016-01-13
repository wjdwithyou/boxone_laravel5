$(document).ready(function(){
	$("#pw").focusout(function() {			
		checkPw();
	});
	$("#pwc").focusout(function() {
		checkPwc();			
	});
});


/*
 * 2015.11.17
 * 작성자 : 박용호
 * 비밀번호 찾기 단계 3 -> 비밀번호 변경
 */
function changePw()
{
	var pw = $("#pw").val();
	var pw_msg = $("#pw_input_msg").text();
	var pwc = $("#pwc").val();
	var email = $("#temp_eid").val();
	
	if (pw.length == 0)
	{
		alert ("비밀번호를 입력해주세요.");
	}
	else if (pw_msg != "사용가능")
	{
		alert ("비밀번호 양식을 지켜주세요.");
	}
	else if (pw != pwc)
	{
		alert ("두 비밀번호가 일치하지 않습니다.");
	}
	else
	{
		$.ajax
		({
			url: adr_ctr+'Login/updatePw',
			type: 'post',
			async: false,
			data: {
				email: email,
				pw: pw
			},		 
			success: function(result)
			{
				result = JSON.parse(result);
				if (result.code == 1)
				{
					alert ("비밀번호가 변경되었습니다. 다시 로그인해 주세요.");
					logout();
					moveLogin();
				}
				else
				{
					alert ("비밀번호 변경에 실패하였습니다. 추후 다시 이용해주세요.");
				}
			},	
			error:function(request,status,error)
			{
			    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	}
}