<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>

<link rel="stylesheet" href="<?=$adr_css?>mypage_common.css">
</head>

<body>

<div id="wrap">
	<div id="header">
	<?php include ("header.php");?>
	</div>
	
	<div id="container">
		<div id="top">
			<h1 class="top_h1">마이페이지</h1>
			<hr class="top_hr">
			<p class="top_p bo_color2">전세계 모든 상품들을 클릭 한번에 내 입맛대로</p>
		</div>
		<div id="mypage_top">
			<div class="np_inner">
				<nav class="bo_colorw f_c mg_t32">
					<h1 id="mpt_tit" class="top_h1 ta_c bo_colorw pd_t16">마이페이지</h1>
					<div class="top_div1 f_l">
						<div class="top_div1_bl ta_c">
							<div>
								<span></span>
							</div>
							<div>
								<img src="<?=$adr_img?>info.png" class="br_50" width="80" height="80">
							</div>
							<p class="font_14 mg_t8"><?=$nickname?>님</p>
						</div>
					</div>
					<div class="selected_mpdiv top_div2 f_l ta_c" onclick="location.href = '<?=$adr_ctr?>Mypage/index'">
						<div><span class="mp_badge fw_b br_20">123</span></div>
						<div class="mpt_ico">
							<img src="<?=$adr_img?>mp_heart.png" class="mp_ico">
						</div>
						<p>찜한상품</p>
					</div>
					<div class="top_div2 f_l ta_c" onclick="location.href = '<?=$adr_ctr?>Mypage/deliveryIndex'">
						<div><span class="mp_badge fw_b br_20"><?=$alarmDc?></span></div>
						<div class="mpt_ico">
							<img src="<?=$adr_img?>mp_delivery.png" class="mp_ico">
						</div>
						<p>배송통관</p>
					</div>
					<div class="top_div2 f_l ta_c" onclick="location.href = '<?=$adr_ctr?>Mypage/infoIndex'">
						<div class="mpt_ico2">
							<img src="<?=$adr_img?>mp_info.png" class="mp_ico">
						</div>
						<p>내정보</p>
					</div>
				</nav>
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