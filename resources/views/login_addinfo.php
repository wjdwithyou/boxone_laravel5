<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>
</head>

<body>
<input type="hidden" id="temp_type" value="<?=$type?>">
<input type="hidden" id="temp_id" value="<?=$id?>">
<input type="hidden" id="temp_img" value="<?=$img?>">

<div id="wrap">
	<div id="header">
	<?php include ("header.php");?>
	</div>
	
	<div id="container">
		<div id="top">
			<h1 class="top_h1">추가 정보 입력</h1>
			<p class="top_p bo_color2">사이트 사용을 위해 간단한 추가 정보를 입력해 주세요.</p>
		</div>
		<div id="content">
			<div class="input_wrap">
				<div>
					<div class="input_div">
						<input type="email" id="eid" class="bo_input1" placeholder="이메일" value="<?=$email?>">
					</div>
					<div>
						<span id="eid_input_msg" class="input_msg bo_color1"></span>
					</div>
					<div class="input_div">
						<input type="text" id="nick" class="bo_input1" placeholder="닉네임" value="<?=$nickname?>">
					</div>
					<div>
						<span id="nick_input_msg" class="input_msg bo_color1"></span>
					</div>
					<div class="btn_set2 f_c">
						<div class="input_div grid grid_h">
							<button type="button" id="login_btn" class="bo_btn1 br_25" onclick="goBack();">취소</button>
						</div>
						<div class="input_div grid grid_h">
							<button type="button" id="login_btn" class="bo_btn2 br_25" onclick="socialSignIn();">확인</button>
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
