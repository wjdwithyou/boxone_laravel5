<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>

<link rel="stylesheet" href="<?=$adr_css?>mypage_common.css">
</head>

<body>
<input type="hidden" id="member_idx" value="<?=$result->idx?>"/>

<div id="wrap">
	<div id="header">
	<?php include ("header.php");?>
	</div>
	
	<div id="container">
		<div id="mypage_top">
			<div id="mypage_top_wrap">
				<div class="inner">
					<h1 class="top_h1 ta_c bo_colorw">마이페이지</h1>
					<nav class="bo_colorw f_c mg_t32 font_14">
						<div class="top_div1 f_l ta_c">
							<div>
								<img src="<?=$adr_img?>member/default.png" class="br_50" width="80" height="80">
							</div>
							<p><?=$nickname?>님</p>
						</div>
						<div class="top_div2 f_l ta_c" onclick="">
							<div>
								<img src="<?=$adr_img?>mp_heart.png" class="mp_ico">
							</div>
							<p>찜한상품</p>
							<div class="mp_alarm">
								<span>12</span>
							</div>
						</div>
						<div class="top_div2 f_l ta_c" onclick="">
							<div>
								<img src="<?=$adr_img?>mp_delivery.png" class="mp_ico">
							</div>
							<p>배송통관</p>
							<div class="mp_alarm">
								<span>2</span>
							</div>
						</div>
						<div class="top_div2 f_l ta_c" onclick="location.href = '<?=$adr_ctr?>Mypage/info'">
							<div>
								<img src="<?=$adr_img?>mp_info.png" class="mp_ico">
							</div>
							<p>내정보</p>
							<div class="mp_alarm">
								<span>5</span>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</div>
		<div id="content">
			
		</div>
	</div>
	
	<div id="footer">
	<?php include ("footer.php");?>
	</div>
	
</div>
	
</body>
</html>