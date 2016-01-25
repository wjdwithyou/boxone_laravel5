<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>
</head>

<body>
<div id="wrap">
	<div id="header">
	<?php include ("header.php");?>
	</div>
	
	<div id="container">
		<div id="top">
			<h1 class="top_h1">비밀번호 찾기</h1>
			<p class="top_p bo_color2">인증번호가 입력하신 이메일 계정으로 전송됩니다.</p>
		</div>
		<div id="content">
			<div class="input_wrap">
				<div>
					<div class="input_div">
						<input type="email" id="eid" class="bo_input1" placeholder="아이디(이메일)">
					</div>
					<div class="input_div">
						<button type="button" id="email_btn" class="bo_btn5 br_25" onclick="findPw();">인증메일 전송</button>
					</div>
					<div class="input_div after_send">
						<span><span id="findpw_eid"></span>로 인증메일을 발송했습니다. 아래에 인증번호를 입력해 주세요. (남은 횟수: <span id="remind_cnt">5</span>)</span>
					</div>
					<div class="input_div after_send">
						<input type="text" id="certify_num" class="bo_input1" placeholder="인증번호">
					</div>
					<div class="btn_set2 after_send f_c">
						<div class="input_div grid grid_h">
							<button type="button" id="login_btn" class="bo_btn1 br_25" onclick="goBack();">취소</button>
						</div>
						<div class="input_div grid grid_h">
							<button type="button" id="login_btn" class="bo_btn2 br_25" onclick="findPwCertify();">확인</button>
						</div>
					</div>
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
