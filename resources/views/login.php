<!-- 로그인 통괄 팝업 -->
<div class="modal fade" id="login_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div id="login_modal_header" class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div id="login_header_1">
					<span>로그인</span>
				</div>
				<div id="login_header_2">
					<span>해외직구의 모든 것, 박스원에 오신걸 환영합니다</span>
				</div>
			</div>
			<div class="modal-body">
				<!-- 팝업 -->
				<div id="popup_body">
					
				</div>
			</div>
		</div>
	</div>
</div>


<!-- 로그인 팝업 -->
<div id="login" hidden>
  <input type="text" id="login_id" class="form_margin form-control" placeholder="아이디">
	<input type="password" id="login_pw" class="form_margin form-control" placeholder="비밀번호">
	<button type="button" rel="external" onclick="justLogin();" class="login_btn_set form_margin boxone_btn_1 btn btn-default">로그인</button>
	<div id="login_body_text">
		<span>소셜계정으로 로그인</span>
	</div>
	<hr>
	<div id="login_body_buttonset">
		<a rel="external" onclick="naverLogin();"><img class="social_btn" src="<?=$adr_img?>naver.png"></a>
		<a rel="external" onclick="kakaoLogin();"><img class="social_btn" src="<?=$adr_img?>katalk.png"></a>
		<a rel="external" onclick="facebookLogin();"><img class="social_btn" src="<?=$adr_img?>facebook.png"></a>
		<a rel="external" onclick="googleLogin();"><img class="social_btn" src="<?=$adr_img?>google.png"></a>
	</div>
	<ol class="breadcrumb">
		<li>
			<a onclick="move_join();">가입하기</a>
		</li>
		<li>
			<a onclick="move_find_pw();">비밀번호 찾기</a>
		</li>
	</ol>
	<div class="clear_both"></div>
	<div id="login_footer">
		<span>박스원에 가입하시면 회원이용약관과 개인정보보호정책에 동의하는 것으로 간주됩니다.</span>
	</div>
</div>

<!-- 비밀번호 찾기 팝업 -->
<div id="find_pw" hidden>
	<span class="popup_body_head">인증번호가 입력하신 이메일 계정으로 전송됩니다</span>
	<input type="text" id="find_pw_email" class="form_margin form-control" placeholder="이메일">
	<div class="btn_padding_right col-xs-6">
		<button type="button" class="boxone_btn_2 btn btn-default" onclick="close_popup('#login_modal');">취소</button>
	</div>
	<div class="btn_padding_left col-xs-6">
		<button type="button" rel="external" onclick="findPw();" class="boxone_btn_1 btn btn-default" onclick="">확인</button>
	</div>
	<div class="clear_both"></div>
</div>

<!-- 비밀번호 찾기 인증번호 입력 팝업-->
<div id="find_pw_certify" hidden>
	<span id="find_pw_certify_head" class="popup_body_head">인증번호를 입력하세요 (남은횟수 : 5)</span>
	<input type="text" id="find_pw_certify_num" class="form_margin form-control" placeholder="인증번호">
	<div class="btn_padding_right col-xs-6">
		<button type="button" class="boxone_btn_2 btn btn-default" onclick="close_popup('#login_modal');">취소</button>
	</div>
	<div class="btn_padding_left col-xs-6">
		<button type="button" rel="external" onclick="findPwCertify();" class="boxone_btn_1 btn btn-default" onclick="">확인</button>
	</div>
	<div class="clear_both"></div>
</div>

<!-- 새로운 비밀번호 입력 팝업-->
<div id="find_pw_new" hidden>
	<span id="find_pw_new_pw_msg" class="input_msg">&nbsp</span> <!-- 이메일 형식체크, 중복체크 메시지 -->
	<input type="password" id="find_pw_new_pw" class="form_margin form-control" placeholder="비밀번호">
	<span id="find_pw_new_pw_confirm_msg" class="input_msg">&nbsp</span> <!-- 이메일 형식체크, 중복체크 메시지 -->
	<input type="password" id="find_pw_new_pw_confirm" class="form_margin form-control" placeholder="비밀번호 확인">
	<div class="btn_padding_right col-xs-6">
		<button type="button" class="boxone_btn_2 btn btn-default" onclick="close_popup('#login_modal');">취소</button>
	</div>
	<div class="btn_padding_left col-xs-6">
		<button type="button" rel="external" onclick="changePw('#find_pw_new_');" class="boxone_btn_1 btn btn-default" onclick="">확인</button>
	</div>
	<div class="clear_both"></div>
	<script>
		$("#find_pw_new_pw").focusout(function(){
			checkPw("#find_pw_new_");
		});
		$("#find_pw_new_pw_confirm").focusout(function(){
			checkPwc("#find_pw_new_");
		});
	</script>
</div>

<!-- 소셜로그인 추가입력 팝업 -->
<div id="social_add_info" hidden>
	<span id="social_add_email_msg" class="input_msg">&nbsp</span> <!-- 이메일 형식체크, 중복체크 메시지 -->
	<input type="text" id="social_add_email" value="" class="form_margin form-control" placeholder="이메일">
	<span id="social_add_nickname_msg" class="input_msg">&nbsp</span> <!-- 닉네임 중복체크 메시지 -->	
	<input type="text" id="social_add_nickname" value="" class="form_margin form-control" placeholder="닉네임">
	<span id="social_add_suggest_msg" class="input_msg">&nbsp</span> <!-- 닉네임 중복체크 메시지 -->
	<input type="text" id="social_add_suggest" class="form_margin form-control" placeholder="추천인">
	<div class="clear_both"></div>
	<div class="btn_padding_right col-xs-6">
		<button type="button" class="boxone_btn_2 btn btn-default" onclick="close_popup('#login_modal');">취소</button>
	</div>
	<div class="btn_padding_left col-xs-6">
		<button type="button" rel="external" onclick="socialSignIn();" class="boxone_btn_1 btn btn-default" onclick="">확인</button>
	</div>
	<div class="clear_both"></div>
	<script>
		$("#social_add_email").focusout(function(){
			checkEmail("#social_add_");
		});
		$("#social_add_nickname").focusout(function(){
			checkNickname("#social_add_");
		});
	</script>
</div>

<!-- 회원가입 팝업 -->
<div id="join" hidden>
	<span id="join_email_msg" class="input_msg">&nbsp</span> <!-- 이메일 형식체크, 중복체크 메시지 -->
	<input type="text" id="join_email" class="form_margin_msg form-control" placeholder="이메일">
	<span id="join_pw_msg" class="input_msg">&nbsp</span> <!-- 비밀번호 길이, 형식체크 메시지 -->
	<input type="password" id="join_pw" class="form_margin_msg form-control" placeholder="비밀번호">
	<span id="join_pw_confirm_msg" class="input_msg">&nbsp</span> <!-- 비밀번호 확인 메시지 -->
	<input type="password" id="join_pw_confirm" class="form_margin_msg form-control" placeholder="비밀번호 확인">
	<span id="join_nickname_msg" class="input_msg">&nbsp</span> <!-- 닉네임 중복 메시지 -->
	<input type="text" id="join_nickname" class="form_margin_msg form-control" placeholder="닉네임">
	<span id="join_suggest_msg" class="input_msg">&nbsp</span> <!-- 추천인 메시지 -->
	<input type="text" id="join_suggest" class="form_margin form-control" placeholder="추천인">
	<div id="join_profile">
		<a onclick=""><img src="<?=$adr_img?>profile_image.png"></a>
	</div>
	<span>프로필 사진</span>
	<br>
	<input type="file" id="">
	<div class="btn_padding_right col-xs-6">
		<button type="button" class="boxone_btn_2 btn btn-default" onclick="close_popup('#login_modal');">취소</button>
	</div>
	<div class="btn_padding_left col-xs-6">
		<button type="button" rel="external" onclick="justSignIn();" class="boxone_btn_1 btn btn-default" onclick="">확인</button>
	</div>
	<div class="clear_both"></div>
	<script>
		$("#join_email").focusout(function() {
			checkEmail("#join_");
		});
		$("#join_pw").focusout(function() {			
			checkPw("#join_");
		});
		$("#join_pw_confirm").focusout(function() {
			checkPwc("#join_");			
		});
		$("#join_nickname").focusout(function() {
			checkNickname("#join_");			
		});
	</script>
</div>