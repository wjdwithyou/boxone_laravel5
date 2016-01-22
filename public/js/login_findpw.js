/*
 * 2015.11.17
 * 작성자 : 박용호
 * 비밀번호 찾기 단계 1 -> 이메일로 인증번호 발송
 */
var email;
function findPw()
{
	email = $("#eid").val();
	var patternX = /[^0-9a-zA-Z~!@#$%^&*?-_]/;
	
	if (email.length == 0)
		alert ("이메일을 입력해주세요.");
	else
	{
		$.ajax
		({
			url: adr_ctr+'Login/findPw',
			type: 'post',
			async: false,
			data: {
				email: email
			},		 
			success: function(result)
			{
				result = JSON.parse(result);
				if (result.code == 1)
				{
					afterSend(email);
				}
				else
				{
					alert (result.msg);
				}
			},	
			error:function(request,status,error)
			{
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	}
}


/*
 * 2015.11.17
 * 작성자 : 박용호
 * 비밀번호 찾기 단계 2 -> 인증번호 입력 받고 검사, 5회 틀릴 시 창 닫기
 */
var cnt = 5;
function findPwCertify()
{
	var num = $("#certify_num").val();
	
	if (cnt != 0)
	{
		$.ajax
		({
			url: adr_ctr+'Login/checkSession',
			type: 'post',
			async: false,
			data: {
				email: email,
				num: num
			},		 
			success: function(result)
			{
				result = JSON.parse(result);
				if (result.code == 1)
				{
					$(location).attr('href', adr_ctr + 'Login/login_changepw?eid=' + email);
				}
				else
				{
					--cnt;
					alert ("잘못된 인증번호를 입력하셨습니다.");
					$("#remind_cnt").text(cnt);
					if (cnt == 0)
					{
						cnt = 5;
						alert ("인증번호를 새로 받아주세요.");
						$(location).attr('href', adr_ctr + 'Login/login_findpw');
					}
				}
			},	
			error:function(request,status,error)
			{
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	}
}

function afterSend(e){
	$(".after_send").show();
	$("#findpw_eid").text(e);
	$("#certify_num").val("").focus();
}