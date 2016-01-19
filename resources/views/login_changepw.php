<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>
</head>

<body>
<input type="hidden" id="temp_eid" value="<?=$eid?>">

<div id="wrap">
	<div id="header">
	<?php include ("header.php");?>
	</div>
	
	<div id="container">
		<div id="top">
			<h1 class="top_h1">비밀번호 변경</h1>
			<p class="top_p bo_color2">새 비밀번호를 입력해 주세요.</p>
		</div>
		<div id="content">
			<div class="input_wrap">
				<div>
					<div class="input_div">
						<input type="password" id="pw" class="bo_input1" placeholder="새 비밀번호">
					</div>
					<div>
						<span id="pw_input_msg" class="input_msg bo_color1"></span>
					</div>
					<div class="input_div">
						<input type="password" id="pwc" class="bo_input1" placeholder="새 비밀번호 확인">
					</div>
					<div>
						<span id="pwc_input_msg" class="input_msg bo_color1"></span>
					</div>
					<div class="btn_set2 after_send f_c">
						<div class="input_div grid grid_h">
							<button type="button" id="login_btn" class="bo_btn1 br_25" onclick="">취소</button>
						</div>
						<div class="input_div grid grid_h">
							<button type="button" id="login_btn" class="bo_btn2 br_25" onclick="changePw();">확인</button>
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
