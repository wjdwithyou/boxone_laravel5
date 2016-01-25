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
			<h1 class="top_h1">회원가입</h1>
			<p class="top_p bo_color2">회원가입을 하시면 다양한 혜택을 받을 수 있습니다.</p>
		</div>
		<div id="content">
			<div class="input_wrap">
				<div>
					<div id="profile" class="input_div">
						<img src="<?=$adr_img?>profile/default.png" width="100" height="100" id="profile_img" class="br_50">
						<input type="file" id="profile_file" accept="image/*" onchange="profileUpload($(this));">
					</div>
					<div class="input_div">
						<input type="email" id="eid" class="bo_input1" placeholder="아이디(이메일)">
					</div>
					<div>
						<span id="eid_input_msg" class="input_msg bo_color1"></span>
					</div>
					<div class="input_div">
						<input type="text" id="nick" class="bo_input1" placeholder="닉네임">
					</div>
					<div>
						<span id="nick_input_msg" class="input_msg bo_color1"></span>
					</div>
					<div class="input_div">
						<input type="password" id="pw" class="bo_input1" placeholder="비밀번호">
					</div>
					<div>
						<span id="pw_input_msg" class="input_msg bo_color1"></span>
					</div>
					<div class="input_div">
						<input type="password" id="pwc" class="bo_input1" placeholder="비밀번호 확인">
					</div>
					<div>
						<span id="pwc_input_msg" class="input_msg bo_color1"></span>
					</div>
					<div class="btn_set2 f_c">
						<div class="input_div grid grid_h">
							<button type="button" id="login_btn" class="bo_btn1 br_25" onclick="goBack();">취소</button>
						</div>
						<div class="input_div grid grid_h">
							<button type="button" id="login_btn" class="bo_btn2 br_25" onclick="justSignIn();">확인</button>
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