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
								<img src="<?=$adr_img?>profile/<?=$img?>" class="br_50" width="80" height="80">
							</div>
							<p class="font_14 mg_t8"><?=$nickname?>님</p>
						</div>
					</div>
					<div class="top_div2 f_l ta_c" onclick="location.href = '<?=$adr_ctr?>Mypage/index'">
						<div><span class="mp_badge fw_b br_20"><?=$alarmWish?></span></div>
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
					<div class="selected_mpdiv top_div2 f_l ta_c" onclick="location.href = '<?=$adr_ctr?>Mypage/infoIndex'">
						<div class="mpt_ico2">
							<img src="<?=$adr_img?>mp_info.png" class="mp_ico">
						</div>
						<p>내정보</p>
					</div>
				</nav>
			</div>
		</div>
		<div id="content">
			<div class="input_wrap">
				<div>
					<div id="profile" class="input_div">
						<img src="<?=$adr_img?>profile/<?=$img?>" width="100" height="100" id="profile_img" class="br_50">
						<input type="file" id="profile_file" accept="image/*" onchange="profileUpload($(this));">
					</div>
					<?php if ($result->type != 5) :	?>
					<div class="mypage_id f_c font_14">
						<div class="myinfo_title fw_b f_l">
							<div class="f_l">
								<?php switch ($result->type)
								{
									case 1:	$type = "naver"; break;
									case 2:	$type = "katalk"; break;
									case 3:	$type = "facebook"; break;
									case 4:	$type = "google"; break;
								}
								?>
								<img class="basis_img img_14" src="<?=$adr_img ?><?=$type?>.png">
							</div>
							<span class="f_l">&nbsp;아이디:</span>
						</div>
						<div class="f_l">
							<span>&nbsp;<?=$result->email?></span>
						</div>
					</div>
					<div class="input_div">
						<input type="email" id="eid" class="bo_input1" value="<?=$result->email?>" placeholder="이메일">
					</div>
					<?php else :?>
					<div class="mypage_id f_c font_14">
						<div class="myinfo_title fw_b f_l">
							<div class="f_l">
								<img class="basis_img img_14" src="<?=$adr_img ?>boxone.png">
							</div>
							<span class="f_l">&nbsp;아이디:</span>
						</div>
						<div class="f_l">
							<span>&nbsp;<?=$result->email?></span>
						</div>
					</div>
					<?php endif;?>
					<div>
						<span id="eid_input_msg" class="input_msg bo_color1"></span>
					</div>
					<div class="input_div">
						<input type="hidden", id="nicko" value="<?=$result->nickname?>"/>
						<input type="text" id="nick" class="bo_input1" value="<?=$result->nickname?>" placeholder="닉네임">
					</div>
					<div>
						<span id="nick_input_msg" class="input_msg bo_color1"></span>
					</div>
					<div class="input_div">
						<input type="password" id="pwo" class="bo_input1" placeholder="비밀번호">
					</div>
					<div>
						<span id="pwo_input_msg" class="input_msg bo_color1"></span>
					</div>
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
					<div class="btn_set2 f_c">
						<div class="input_div grid grid_h">
							<button type="button" id="login_btn" class="bo_btn1 br_25" onclick="goBack();">취소</button>
						</div>
						<div class="input_div grid grid_h">
							<button type="button" id="login_btn" class="bo_btn2 br_25" onclick="justModify();">확인</button>
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