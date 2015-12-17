function login_popup() {
	$("#login_header_1").children().text("로그인");
	$("#login_header_2").children().text("해외직구의 모든 것, 박스원에 오신걸 환영합니다");
	$("#popup_body").html($("#login").html());
	$('#login_modal').modal('show');
}
function join_popup() {
	$('#login_modal').modal('show');
	$("#login_header_1").children().text("회원가입");
	$("#login_header_2").children().text("회원가입을 하시면 다양한 혜택을 받을 수 있습니다");
	$("#popup_body").html($("#join").html());
	
	checkEmail("#join_");
	checkPw("#join_");
	checkPwc("#join_");
	checkNickname("#join_");
}
function move_join() {
	$("#login_header_1").children().text("회원가입");
	$("#login_header_2").children().text("회원가입을 하시면 다양한 혜택을 받을 수 있습니다");
	$("#popup_body").html($("#join").html());
}

function move_find_pw() {
	$("#login_header_1").children().text("회원 비밀번호 찾기");
	$("#login_header_2").children().text("");
	$("#popup_body").html($("#find_pw").html());
}

function move_find_pw_certify(email) {
	$("#login_header_1").children().text("인증번호 입력");
	$("#login_header_2").children().text(email+"로 인증번호가 전송되었습니다.");
	$("#popup_body").html($("#find_pw_certify").html());
}

function move_find_pw_new() {
	$("#login_header_1").children().text("새로운 비밀번호 입력");
	$("#login_header_2").children().text("");
	$("#popup_body").html($("#find_pw_new").html());
	
	checkPw("#find_pw_new_");
	checkPwc("#find_pw_new_");
}

function move_social_add_info(email, nickname) {
	$("#login_header_1").children().text("추가 정보 입력");
	$("#login_header_2").children().text("");
	$("#popup_body").html($("#social_add_info").html());
	
	$("#social_add_email").val(email);
	$("#social_add_nickname").val(nickname);
	
	checkEmail("#social_add_");
	checkNickname("#social_add_");
}
function move_join_success() {
	$("#popup_body").html($("#join_success").html());
}
function close_popup(str){
	$(str).modal('hide');
}

var adr_ctr = $("#adr_ctr").val();

/*
 * 2015.11.17 
 * 작성자 : 박용호 
 * 네이버 로그인 초기화(js) -> 로그인(js) -> 인증토큰 받기(php) -> 회원정보
 * 받기(php) -> 사이트 로그인/가입
 */
var naver = NaverAuthorize({
	client_id : "_uNsCw6pC_ItNTWfmVUD",
    redirect_uri : adr_ctr+"Login/naverLogin",
    client_secret : "0Mo8jpE38A"
});

function naverLogin()
{
	naver.login("stateChk");
}


/*
 * 2015.11.17
 * 작성자 : 박용호
 * 카카오 로그인
 * 초기화(js) -> 로그인(js) -> 회원정보 받기(js) -> 사이트 로그인/가입
 */
Kakao.init('28b2296f4a36fe8bd5568f32ad58b39e');	

function kakaoLogin()
{
	Kakao.Auth.login({
    	success: function(authObj) 
    	{
    		Kakao.API.request({
    	        url: '/v1/user/me',
    	        success: function(res) {
    	        	//alert(JSON.stringify(res));
    	        	var type = "2"; // 카카오는 2번
    	        	var id = res.id;
    	        	var nickname = res.properties.nickname;
    	        	var email = "";
    	        	var img = res.properties.profile_image;
    	        	socialLogin(type, id, email, nickname, img);
    	        },
    	        fail: function(error) {
    	        	alert(JSON.stringify(error));
    	        }
    	     });
    	},
    	fail: function(err) 
    	{
      		alert(JSON.stringify(err));
    	},
  	});
}


/*
 * 2015.11.17
 * 작성자 : 박용호
 * 페이스북 로그인
 * 초기화(js) -> 로그인(js) -> 회원정보 받기(js) -> 사이트 로그인/가입
 */
FB.init({
	appId      : '298621470308181',
	cookie     : true,
	xfbml      : true,
	version    : 'v2.2',
	language   : 'ko_KR'
});

function facebookLogin()
{				
	FB.getAuthResponse();		
	FB.login(function(res){
		if (res.status == "connected")
		{			
			
			FB.api('/me', {locale : 'ko_KR'}, function(res){
				//alert(JSON.stringify(res));
				var type = "3"; // fb은 3번
	        	var id = res.id;
	        	var nickname = "";
	        	var email = res.email;
	        	FB.api('/me/picture', function(res){
	        		var img = res.data.url;
					socialLogin(type, id, email, nickname, img);
				});	        	
			});
		}
	}, {scope: 'public_profile,email'});
	
}


/*
 * 2015.11.17
 * 작성자 : 박용호
 * 구글플러스 로그인
 * 자바스크립트 파일 넣기, 콜백(js) -> 버튼 클릭 시 로그인(js) -> 로그인 콜백에서 정보 가져오기 -> 사이트 로그인/가입
 */
function onLoadCallback()
{
    gapi.client.setApiKey('AIzaSyATt-1SHBwVagR4BrsWCzuDs3wq4Zfk4hg');
    gapi.client.load('plus', 'v1', function(){});
}
function googleLogin()
{
	var myParams = {
	    'clientid':'820303147305-o426cdkoh8pjcmcbdel67dj90fslp4k0.apps.googleusercontent.com', 
	    'cookiepolicy':'single_host_origin',
	    'callback':'loginCallback',
	    'approvalprompt':'force',
	    'scope':'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
	  };
	  gapi.auth.signIn(myParams);
}		
function loginCallback(result)
{
	if(result['status']['signed_in'])
    { 
		var request = gapi.client.plus.people.get(
        {
            'userId': 'me'
        });
        request.execute(function (resp)
        {			
            var email = '';
            if(resp['emails'])
            {
                for(i = 0; i < resp['emails'].length; i++)
                {
                    if(resp['emails'][i]['type'] == 'account')
                    {
                        email = resp['emails'][i]['value'];
                    }
                }
            }
 
            var type = "4";
            var id = resp['id'];
        	var nickname = resp['displayName'];
        	var img = resp['image']['url'];
        	socialLogin(type, id, email, nickname, img);
        });
    }   
}


/*
 * 2015.11.17
 * 작성자 : 박용호
 * 소셜 로그인 -> 로그인 시도, 로그인 정보 없으면 해당 소셜 정보로 가입
 */
var profile;
function socialLogin(type, id, email, nickname, img)
{
	//console.log(img);
	alert ("type:"+type+", id:"+id+", email:"+email+", nickname:"+nickname+", img:"+img);
	
	// 로그인으로 회원가입 여부 체크
	$.ajax
	({
		url: adr_ctr+'Login/login',
		type: 'post',
		async: false,
		data: {
			type: type,
			id: id,
			pw: id
		},
		success: function(result)
		{
			result = JSON.parse(result);
			if (result.code == 1)
			{
				alert ("로그인 되었습니다.");
				location.reload(false);
			}
			else
			{
				alert ("첫 로그인이시네요. 추가정보를 입력해주세요.");
				profile = [type, id, img];
				// 추가정보 받기
				move_social_add_info(email, nickname);
			}
			 
		},
		error: function(request,status,error)
		{
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}


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
		var type = profile[0];
		var id = profile[1];
		var pw = profile[1];
		var email = $("#social_add_email").val();
		var nickname = $("#social_add_nickname").val();
		var img = profile[2];
		var rec = $("#social_add_suggest").val();
		
		signIn(type, id, pw, email, nickname, img, rec);
	}
}


/*
 * 2015.11.17
 * 작성자 : 박용호
 * 일반회원 로그인 -> 아이디와 패스워드로 로그인
 */
function justLogin()
{
	var type = 5;
	var id = $("#login_id").val();
	var pw = $("#login_pw").val();
	
	$.ajax
	({
		url: adr_ctr+'Login/login',
		type: 'post',
		async: false,
		data: {
			type: type,
			id: id,
			pw: pw
		},
		success: function(result)
		{
			result = JSON.parse(result);
			if (result.code == 1)
			{
				alert ("로그인 되었습니다.");
				location.reload(false);
			}
			else
			{
				alert ("잘못된 정보를 입력하셨습니다.");
				profile = [type, id, img];
				// 추가정보 받기
				move_social_add_info(email, nickname);
			}
			 
		},
		error: function(request,status,error)
		{
			console.log(request.responseText);
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
	
}

/*
 * 2015.11.17
 * 작성자 : 박용호
 * 일반회원 가입 -> 각 정보 유효성 검사 후 회원가입
 */
function justSignIn()
{
	var email_msg = $("#join_email_msg").text();
	var pw_msg = $("#join_pw_msg").text();
	var pwc_msg = $("#join_pw_confirm_msg").text();
	var nickname_msg = $("#join_nickname_msg").text();
	
	if (email_msg != "사용가능" || pw_msg != "사용가능" || pwc_msg != "일치" || nickname_msg != "사용가능")
		alert ("입력한 정보들을 다시 확인해주세요.");
	else
	{
		var type = 5;
		var id = $("#join_email").val();
		var pw = $("#join_pw").val();
		var email = $("#join_email").val();
		var nickname = $("#join_nickname").val();
		var img = ""; // 임시
		var rec = $("#join_suggest").val(); // 임시
		
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
	$.ajax
	({
		url: adr_ctr+'Login/signIn',
		type: 'post',
		async: false,
		data: {
			type: type,
			id: id,
			pw: pw,
			email: email,
			nickname: nickname,
			img: img,
			rec: rec
		},		 
		success: function(result)
		{
			//alert (JSON.stringify(result));
			result = JSON.parse(result);
			if (result.code == 1)
			{
				alert ("회원가입 및 로그인 되었습니다.");
				location.reload(false);
			}
			else
			{
				alert ("회원 가입 실패.");
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
 * 이메일 중복 검사 -> 검사함.
 */
function checkEmail(adr)
{
	var email = $(adr+"email").val();
	var pattern = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	
	if (email.length == 0)
		$(adr+"email_msg").text("미입력");
	else if (!pattern.test(email))
		$(adr+"email_msg").text("이메일 양식 불일치");
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
					$(adr+"email_msg").text("사용가능");
				}
				else
				{
					$(adr+"email_msg").text("사용불가");
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
function checkNickname(adr)
{
	var nickname = $(adr+"nickname").val();
	var pattern = /[^0-9a-zA-Z-_ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
	
	if (nickname.length == 0)
		$(adr+"nickname_msg").text("미입력");
	else if (pattern.test(nickname))
		$(adr+"nickname_msg").text("숫자, 영문, 한글, -_외 사용불가");
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
					$(adr+"nickname_msg").text("사용가능");
				}
				else
				{
					$(adr+"nickname_msg").text("사용불가");
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
 * 비밀번호 유효성 검사
 */
function checkPw(adr)
{
	var pw = $(adr+"pw").val();
	var pwc = $(adr+"pw_confirm").val();
	
	var patternNum = /[0-9]/;
	var patternEng = /[a-zA-Z]/;
	var patternX = /[^0-9a-zA-Z~!@#$%^&*?-_]/;
	
	if (pw.length == 0)
		$(adr+"pw_msg").text("미입력");
	else if (!patternNum.test(pw) || !patternEng.test(pw))
		$(adr+"pw_msg").text("영문, 숫자 반드시 포함");
	else if (patternX.test(pw))
		$(adr+"pw_msg").text("()=+\|<>/{}등 사용 불가");
	else
		$(adr+"pw_msg").text("사용가능");
	
	if (pwc.length != 0 && pwc != pw)
		$(adr+"pw_confirm_msg").text("불일치");
	else if (pwc.length != 0 && pwc == pw)
		$(adr+"pw_confirm_msg").text("일치");
}


/*
 * 2015.11.17
 * 작성자 : 박용호
 * 비밀번호 재입력란 유효성 검사
 */
function checkPwc(adr)
{
	var pw = $(adr+"pw").val();
	var pwc = $(adr+"pw_confirm").val();
	
	if (pwc.length == 0)
		$(adr+"pw_confirm_msg").text("미입력");
	else if (pw != pwc)
		$(adr+"pw_confirm_msg").text("불일치");
	else
		$(adr+"pw_confirm_msg").text("일치");
}


/*
 * 2015.11.17
 * 작성자 : 박용호
 * 비밀번호 찾기 단계 1 -> 이메일로 인증번호 발송
 */
var email;
function findPw()
{
	email = $("#find_pw_email").val();
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
					move_find_pw_certify(email);
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
	var num = $("#find_pw_certify_num").val();
	
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
					alert ("인증 완료되었습니다. 새로운 비밀번호를 설정해주세요.");
					move_find_pw_new();
				}
				else
				{
					--cnt;
					alert ("잘못된 인증번호를 입력하셨습니다.");
					$("#find_pw_certify_head").text("인증번호를 입력하세요 (남은횟수 : "+cnt+")");
					if (cnt == 0)
					{
						cnt = 5;
						alert ("인증번호를 새로 받아주세요.");
						close_popup("#boxone_basis_modal");
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


/*
 * 2015.11.17
 * 작성자 : 박용호
 * 비밀번호 찾기 단계 3 -> 비밀번호 변경
 */
function changePw(str)
{
	var pw = $(str + "pw").val();
	var pw_msg = $(str + "pw_msg").text();
	var pwc = $(str + "pw_confirm").val();
	
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
					if (str == '#find_pw_new_')
					{
						alert ("비밀번호가 변경되었습니다. 다시 로그인해 주세요.");
						login_popup();
					}
					else if (str == '#boxone_basis_')
					{
						alert ("비밀번호 변경이 완료되었습니다.");
						close_popup('#boxone_basis_modal');
					}
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

/*
 * 2015.11.17
 * 작성자 : 박용호
 * 로그아웃 -> 세션 파괴..
 */
function logout()
{
	$.ajax
	({
		url: adr_ctr+'Login/logout',
		type: 'post',
		async: false,
		success: function(result)
		{
			alert ("안녕히가세요 빠빠");
			location.reload(false);
		},	
		error:function(request,status,error)
		{
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}