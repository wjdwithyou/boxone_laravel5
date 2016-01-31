$(document).ready(function(){
	$("#eid").focusout(function() {
		checkEmail();
	});
	$("#nick").focusout(function() {
		checkNickname();			
	});
});

/*
 * 2015.11.17
 * 작성자 : 박용호
 * 소셜 회원 가입 -> 소셜 로그인 실패 시 추가정보 입력 받아 가입
 */
function socialSignIn()
{
	var email_msg = $("#eid_input_msg").text();
	var nickname_msg = $("#nick_input_msg").text();
	
	if (email_msg != "사용가능" || nickname_msg != "사용가능")
		alert ("이메일과 닉네임을 다시 확인해주세요.");
	else
	{
		var type = $("#temp_type").val();
		var id = $("#temp_id").val();
		var pw = $("#temp_id").val();
		var email = $("#eid").val();
		var nickname = $("#nick").val();
		var img = $("#temp_img").val();
		var rec = '';
		
		signIn(type, id, pw, email, nickname, img, rec);
	}
}

/*
// 20160131 J.Style
// ctrl C+V from join.js
function signIn(type, id, pw, email, nickname, img, rec)
{
	alert(type+'/'+id+'/'+pw+'/'+email+'/'+nickname+'/'+img+'/'+rec);
	var data = new FormData();
	data.append("type", type);
	data.append("id", id);
	data.append("pw", pw);
	data.append("email", email);
	data.append("nickname", nickname);
	data.append("img", img);
	data.append("rec", rec);

	$.ajax
	({
		url: adr_ctr+'Login/signIn',
		type: 'post',
		cache: false,
		processData: false,
		contentType: false,
		data: data,
		success: function(result)
		{
			//alert (JSON.stringify(result));
			result = JSON.parse(result);
			if (result.code == 1)
			{
				alert ("회원가입 및 로그인 되었습니다.");
				moveMain();
			}
			else
			{
				alert ("회원 가입 실패.");
			}
		},	
		error:function(request,status,error)
		{
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		    console.log(request.responseText);
		}
	});
}
*/