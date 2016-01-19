var patternEmail = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i; 
var emailMax = 50;
var patternNick = /[0-9a-zA-Z-_ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
var nickMin = 2;
var nickMax = 10;
var patternPw = /[0-9a-zA-Z~!@#$%^&*?-_]/;
var pwMin = 8;
var pwMax = 15;


/*
 * 2015.11.17
 * 작성자 : 박용호
 * 이메일 중복 검사 -> 검사함.
 */
function checkEmail()
{
	var email = $("#eid").val();
	//var pattern = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	
	if (email.length == 0)
		$("#eid_input_msg").text("미입력");
	else if (!patternEmail.test(email))
		$("#eid_input_msg").text("이메일 양식 불일치");
	else
		$.ajax
		({
			url: adr_ctr+'Login/checkEmail',
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
					// 이메일 사용 가능
					$("#eid_input_msg").text("사용가능");
				}
				else
				{
					$("#eid_input_msg").text("중복으로 인한 사용불가");
				}
			},	
			error:function(request,status,error)
			{
			    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
}

/*
 * 2015.11.17
 * 작성자 : 박용호
 * 닉네임 중복 검사 -> 검사함 화이팅
 */
function checkNickname()
{
	var nickname = $("#nick").val();
	//var pattern = /[^0-9a-zA-Z-_ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
	
	if (nickname.length == 0)
		$("#nick_input_msg").text("미입력");
	else if (!patternNick.test(nickname))
		$("#nick_input_msg").text("숫자, 영문, 한글, -_외 사용불가");
	else if (nickname.length > nickMax)
		$("#nick_input_msg").text("최대 "+nickMax+"자 까지 입력 가능");
	else
		$.ajax
		({
			url: adr_ctr+'Login/checkNickname',
			type: 'post',
			async: false,
			data: {
				nickname: nickname
			},		 
			success: function(result)
			{
				result = JSON.parse(result);
				if (result.code == 1)
				{
					// 닉네임 사용 가능
					$("#nick_input_msg").text("사용가능");
				}
				else
				{
					$("#nick_input_msg").text("중복으로 인한 사용불가");
				}
			},	
			error:function(request,status,error)
			{
				console.log(request.responseText);
			    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
}

/*
 * 2015.11.17
 * 작성자 : 박용호
 * 비밀번호 유효성 검사
 */
function checkPw()
{
	var pw = $("#pw").val();
	var pwc = $("#pwc").val();
	
	var patternNum = /[0-9]/;
	var patternEng = /[a-zA-Z]/;
	var patternX = /[^0-9a-zA-Z~!@#$%^&*?-_]/;
	
	if (pw.length == 0)
		$("#pw_input_msg").text("미입력");
	else if (!patternPw.test(pw))
		$("#pw_input_msg").text("영문 숫자 ~!@#$%^&*?-_");
	else if (pw.length < pwMin || pw.length > pwMax)
		$("#pw_input_msg").text("최소 2자, 최대 10자");
	else
		$("#pw_input_msg").text("사용가능");
	
	if (pwc.length != 0 && pwc != pw)
		$("#pwc_input_msg").text("불일치");
	else if (pwc.length != 0 && pwc == pw)
		$("#pwc_input_msg").text("일치");
}

/*
 * 2015.11.17
 * 작성자 : 박용호
 * 비밀번호 재입력란 유효성 검사
 */
function checkPwc()
{
	var pw = $("#pw").val();
	var pwc = $("#pwc").val();
	
	if (pwc.length == 0)
		$("#pwc_input_msg").text("미입력");
	else if (pw != pwc)
		$("#pwc_input_msg").text("불일치");
	else
		$("#pwc_input_msg").text("일치");
}
