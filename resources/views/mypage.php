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
					<div class="selected_mpdiv top_div2 f_l ta_c" onclick="location.href = '<?=$adr_ctr?>Mypage/index'">
						<div><span class="mp_badge fw_b br_20">2</span></div>
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
			<div class="inner f_c">
			<?php for($i = 0 ;$i < count($prdtList); ++$i) :?>
				<?php foreach($prdtList[$i] as $j) :?>
				<div class="imglist_div grid grid_432">
					<div class="delete_img font_16">
						<a onclick="deleteBookmark(<?=$j->idx?>, <?=($j->saleP!=0)?1:0?>);"><i class="fa fa-times-circle bo_color2"></i></a>
					</div>
					<div class="imglist_img img_center">
						<div class="img_center_inner">
							<?php if ($j->saleP != 0) :?>
							<a onclick='location.href="<?=$adr_ctr ?>Hotdeal/productDetail?idx=<?=$j->idx?>"'><img src="<?=$j->img?>"></a>
							<?php else :?>
							<a onclick='location.href="<?=$adr_ctr ?>Shoppingbox/detail?idx=<?=$j->idx?>"'><img src="<?=$j->img?>"></a>
							<?php endif;?>
						</div>
					</div>
					<div class="imglist_desc_wrap">
						<div class="imglist_desc1 ta_c t_o bo_color2">
							<?=$j->brand?>
						</div>
						<div class="imglist_desc2 ta_c limit_line limit_line_2">
							<div>
								<?=$j->name?>
							</div>
						</div>
						<div class="imglist_desc3 ta_c t_o">
							￦<?=$j->price?><br>
						</div>
					</div>
				</div>
				<?php endforeach;?>
			<?php endfor;?>
			</div>
		</div>
	
	<div id="footer">
	<?php include ("footer.php");?>
	</div>
	
</div>

</body>
</html>