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
	var email_msg = $("#social_add_email_msg").text();
	var nickname_msg = $("#social_add_nickname_msg").text();
	
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