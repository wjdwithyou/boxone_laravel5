<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>
<script type="text/javascript" src="<?=$adr_btstrp?>js/jquery.cookie.js"></script>
</head>

<body>
<div id="wrap">
	<div id="header">
	<?php include ("header.php");?>
	</div>
	
	<div id="container">
		<div id="top">
			<h1 class="top_h1">로그인</h1>
			<p class="top_p bo_color2">해외직구의 모든 것, 박스원에 오신걸 환영합니다.</p>
		</div>
		<div id="content">
			<div class="input_wrap">
				<div>
					<div class="input_div">
						<input type="email" id="eid" class="bo_input1" placeholder="아이디(이메일)" maxlength="50">
					</div>
					<div class="input_div">
						<input type="password" id="pw" class="bo_input1" placeholder="비밀번호" maxlength="15" onkeypress="if(event.keyCode==13){justLogin('<?=$spb?>');return false;}">
					</div>
					<div class="input_div">
						<input type="checkbox" id="save_eid" name="save_eid" class="bo_checkbox bo_checkbox_1">
						<label for="save_eid"><span></span>아이디 저장</label>
					</div>
					<div class="input_div">
						<input type="hidden" id="prev_url" value="<?=$prev_url?>"/>
						<button type="button" id="login_btn" class="bo_btn2 br_25" onclick="justLogin('<?=$prev_url?>');">로그인</button>
					</div>
				</div>
				<div>
					<h2 id="social_txt">소셜계정으로 로그인</h2>
					<hr id="social_hr">
					<nav class="f_c">
						<div class="social_div">
							<a rel="external" onclick="naverLogin();"><img class="social_btn" src="<?=$adr_img?>naver.png"></a>
						</div>
						<div class="social_div">
							<a rel="external" onclick="kakaoLogin();"><img class="social_btn" src="<?=$adr_img?>katalk.png"></a>
						</div>
						<div class="social_div">
							<a rel="external" onclick="facebookLogin();"><img class="social_btn" src="<?=$adr_img?>facebook.png"></a>
						</div>
						<div class="social_div">
							<a rel="external" onclick="googleLogin();"><img class="social_btn" src="<?=$adr_img?>google.png"></a>
						</div>
					</nav>
				</div>
				<nav id="sign_find">
					<a href="<?=$adr_ctr?>Login/join">가입하기</a>
					<span class="li_bar2"></span>
					<a href="<?=$adr_ctr?>Login/login_findpw">비밀번호 찾기</a>
				</nav>
				<div id="login_txt">
					<span>박스원에 가입하시면 회원이용약관과 개인정보보호정책에 동의하는 것으로 간주됩니다.</span>
				</div>
			</div>
		</div>
	</div>
	
	<div id="footer">
	<?php include ("footer.php");?>
	</div>
	
</div>
</body>
</html>