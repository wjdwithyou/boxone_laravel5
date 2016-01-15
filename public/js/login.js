$(document).ready(function(){
	var cookie_eid = $.cookie('cookie_eid');
	if(cookie_eid != undefined) {
		$("#eid").val(cookie_eid);
		$("#save_eid").prop("checked",true);
	}
	
	$("#eid").keyup(function(e){
		if (e.keyCode == 13)
			justLogin();
	});	
	
	$("#pw").keyup(function(e){
		if (e.keyCode == 13)
			justLogin();
	});
});

function cookieEid(){
	if($("#save_eid").prop("checked")){
		$.cookie('cookie_eid', $("#eid").val(), {expires: 7});
	}
	else{
		$.removeCookie("cookie_eid");
	}
}

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
        	//alert (JSON.stringify(resp));
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
function socialLogin(type, id, email, nickname, img)
{
	console.log(img);
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
				moveMain();
			}
			else
			{
				alert ("첫 로그인이시네요. 추가정보를 입력해주세요.");
				opener.location.attr('href', adr_ctr + 'Login/login_addinfo?type=' + type + '&id=' + id + '&img=' + img);
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
 * 일반회원 로그인 -> 아이디와 패스워드로 로그인
 */
function justLogin()
{
	var type = 5;
	var id = $("#eid").val();
	var pw = $("#pw").val();
	
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
				cookieEid();
				moveMain();
			}
			else
			{
				alert ("잘못된 정보를 입력하셨습니다.");
				$("#pw").val("").focus();
			}
			 
		},
		error: function(request,status,error)
		{
			console.log(request.responseText);
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}