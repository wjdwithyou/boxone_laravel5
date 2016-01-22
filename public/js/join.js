$(document).ready(function(){
	$("#eid").focusout(function() {
		checkEmail();
	});
	$("#nick").focusout(function() {
		checkNickname();			
	});
	$("#pw").focusout(function() {			
		checkPw();
	});
	$("#pwc").focusout(function() {
		checkPwc();			
	});
});

function profileUpload(file)
{
	var img = $("#profile_img");
	
	if (window.FileReader && file[0].files && file[0].files[0])
	{
		var reader = new FileReader();
		reader.onload = function(e){
			img.attr("src", e.target.result);
		};
		reader.readAsDataURL(file[0].files[0]);
	}
	//img.attr("src", file.val());
}

/*
 * 2015.11.17
 * 작성자 : 박용호
 * 일반회원 가입 -> 각 정보 유효성 검사 후 회원가입
 */
function justSignIn()
{
	var email_msg = $("#eid_input_msg").text();
	var pw_msg = $("#pw_input_msg").text();
	var pwc_msg = $("#pwc_input_msg").text();
	var nickname_msg = $("#nick_input_msg").text();
	
	if (email_msg != "사용가능" || pw_msg != "사용가능" || pwc_msg != "일치" || nickname_msg != "사용가능")
		alert ("입력한 정보들을 다시 확인해주세요.");
	else
	{
		var type = 5;
		var id = $("#eid").val();
		var pw = $("#pw").val();
		var email = $("#eid").val();
		var nickname = $("#nick").val();
		var rec = "";
		/*var rec = $("#join_suggest").val();*/
		
		var imgFile = $("#profile_file");
		var img = "";
		if (imgFile[0].files && imgFile[0].files[0])
			var img = imgFile[0].files[0]; // 임시
		
		signIn(type, id, pw, email, nickname, img, rec);
	}
	
}


/*
 * 2015.11.17
 * 작성자 : 박용호
 * 회원가입 최종 -> 소셜/일반 회원가입 시 최종적으로 실행, DB에 정보 입력
 */
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