$(document).ready(function(){
	//$("#pwo_input_msg").val('미입력');
	//$("#pw_input_msg").val('미입력');
	//$("#pwc_input_msg").val('미입력');
	
	/*
	$("#eid").focusout(function(){
		checkEmail();
	});
	*/
	
	$("#nick").focusout(function(){
		checkNickname();
	});
	$("#pwo").focusout(function(){
		checkPwo();
	});
	$("#pw").focusout(function(){
		checkPw();
	})
	$("#pwc").focusout(function() {
		checkPwc();
	});
});

// 160129 J.Style
// Modify profile in MyPage.
function justModify(){
	var adr_ctr = $("#adr_ctr").val();
	
	//var email_msg = $("#eid_input_msg").text();
	var nickname_msg = $("#nick_input_msg").text();
	var pwo_msg = $("#pwo_input_msg").text();
	var pw_msg = $("#pw_input_msg").text();
	var pwc_msg = $("#pwc_input_msg").text();
	
	if (/*email_msg*/nickname_msg != '사용가능' || pwo_msg != '일치' || pw_msg != '사용가능' || pwc_msg != '일치')
		alert('입력한 정보들을 다시 확인해주세요.');
	else{
		//var type = 5;
		
		var nicknameo = $("#nicko").val();
		
		//var eid = $("#eid").val();	// social+
		var nickname = $("#nick").val();
		var pw = $("#pw").val();
		
		var imgFile = $("#profile_file");
		var img = (imgFile[0].files && imgFile[0].files[0])? imgFile[0].files[0]: '';
		/*
		var img = '';
		
		if (imgFile[0].files && imgFile[0].files[0])
			var img = imgFile[0].files[0]; // 임시
		else
			var img = '';
		*/
		
		// second move
		
		var data = new FormData();
		
		//data.append("type", type);	// social+
		data.append("nicknameo", nicknameo);
		//data.append("email", eid);
		data.append("nickname", nickname);
		data.append("pw", pw);
		data.append("img", img);
		
		$.ajax({
			async: false,
			cache: false,
			contentType: false,
			data: data,
			processData: false,
			type: 'post',
			url: adr_ctr + 'Login/modifyInfo',
			success: function(result){
				// alert(JSON.stringify(result));
				result = JSON.parse(result);
				
				if (result.code == 1){
					alert('정보 수정이 완료되었습니다.');
					/*top.document.*/location.href = adr_ctr + "Mypage/index";
				}
				else
					alert('정보 수정 실패');
			},
			error: function(request, status, error){
				alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			    console.log(request.responseText);
			}
		});
	}
}

/*
 * 2015.11.18
 * 작성자 : 박용호
 * 소셜 회원 이메일 수정 팝업 열기 
 */
function open_email_modal()
{
	$("#social_basis_modal").modal('show');
	//$("#social_basis_modal_email").val($("#social_basis_email").val());
	checkEmail("#social_basis_modal_");
	$("#social_basis_modal_email").focusout(function() {
		checkEmail("#social_basis_modal_");
	});
}

/*
 * 2015.11.18
 * 작성자 : 박용호
 * 자체 회원 비밀번호 수정 팝업 열기 
 */
function open_pw_modal()
{
	$("#boxone_basis_modal").modal('show');
	checkPw("#boxone_basis_");
	checkPwc("#boxone_basis_");
	$("#boxone_basis_pw").focusout(function() {
		checkPw("#boxone_basis_");
	});
	$("#boxone_basis_pw_confirm").focusout(function() {
		checkPwc("#boxone_basis_");
	});
}

/*
 * 2015.11.18
 * 작성자 : 박용호
 * 회원 닉네임 수정 팝업 열기 
 */
function open_nickname_modal()
{
	$("#profile_modal").modal('show');
	checkNickname("#profile_modal_");
	$("#profile_modal_nickname").focusout(function() {
		checkNickname("#profile_modal_");
	});
}

function daum_post() {
    new daum.Postcode({
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var fullAddr = ''; // 최종 주소 변수
            var extraAddr = ''; // 조합형 주소 변수

            // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                fullAddr = data.roadAddress;

            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                fullAddr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
            if(data.userSelectedType === 'R'){
                //법정동명이 있을 경우 추가한다.
                if(data.bname !== ''){
                    extraAddr += data.bname;
                }
                // 건물명이 있을 경우 추가한다.
                if(data.buildingName !== ''){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById('post').value = data.zonecode; //5자리 새우편번호 사용
            document.getElementById('address').value = fullAddr;

            // 커서를 상세주소 필드로 이동한다.
            document.getElementById('address_detail').focus();
        }
    }).open();
}

/*
 * 2015.11.19
 * 작성자 : 박용호
 * 자체 회원 비밀번호 업데이트 하기  (기존 비밀번호 검사)
 */
function updatePw()
{
	var id = $("#boxone_basis_id").text();
	var pw = $("#boxone_basis_pw_origin").val();
	
	$.ajax
	({
		url: adr_ctr+'Mypage/checkPw',
		type: 'post',
		async: false,
		data: {
			id: id,
			pw: pw
		},		 
		success: function(result)
		{
			result = JSON.parse(result);
			if (result.code == 1)
			{
				changePw('#boxone_basis_');
			}
			else
			{
				alert ("기존 비밀번호를 잘못 입력하셨습니다.");
			}
		},	
		error:function(request,status,error)
		{
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}

/*
 * 2015.11.18
 * 작성자 : 박용호
 * 소셜 회원 이메일 업데이트 하기 
 */
function updateEmail()
{
	var adr_ctr = $("#adr_ctr").val();
	var email = $("#social_basis_modal_email").val();
	var email_msg = $("#social_basis_modal_email_msg").text();
	
	if (email.length == 0)
	{
		alert ("이메일을 입력해주세요.");
	}
	else if (email_msg == "이메일 양식 불일치")
	{
		alert ("이메일 양식을 지켜주세요.");
	}
	else
	{
		var idx = $("#member_idx").val();
		
		$.ajax
		({
			url: adr_ctr+'Mypage/update',
			type: 'post',
			async: false,
			data: {
				idx: idx,
				col: "email",
				val: email
			},		 
			success: function(result)
			{
				result = JSON.parse(result);
				if (result.code == 1)
				{
					alert ("이메일 주소가 정상적으로 변경되었습니다.");
					location.reload();
				}
				else
				{
					alert ("조금 후에 다시 이용해주세요.");
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
 * 2015.11.18
 * 작성자 : 박용호
 * 회원 닉네임 업데이트 하기 
 */
function updateNickname()
{
	var adr_ctr = $("#adr_ctr").val();
	var nickname = $("#profile_modal_nickname").val();
	var nick_msg = $("#profile_modal_nickname_msg").text();
	
	if (nickname.length == 0)
	{
		alert ("닉네임을 입력해주세요.");
	}
	else if (nick_msg == "사용불가")
	{
		alert ("이미 사용되고 있는 닉네임입니다.");
	}
	else if (nick_msg != "사용가능")
	{
		alert ("닉네임은 숫자, 영문, 한글, -_외 사용이 불가능합니다.");
	}
	else
	{
		var idx = $("#member_idx").val();
		
		$.ajax
		({
			url: adr_ctr+'Mypage/update',
			type: 'post',
			async: false,
			data: {
				idx: idx,
				col: "nickname",
				val: nickname
			},		 
			success: function(result)
			{
				result = JSON.parse(result);
				if (result.code == 1)
				{
					alert ("닉네임이 정상적으로 변경되었습니다.");
					location.reload();
				}
				else
				{
					alert ("조금 후에 다시 이용해주세요.");
				}
			},	
			error:function(request,status,error)
			{
			    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	}
}

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