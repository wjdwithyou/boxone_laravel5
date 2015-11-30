<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php
		include ("libraries.php");
		?>
	</head>

	<body>
		<?php
		include ("header.php");
		?>

		<div id="br_wrap">
			<div id="static_menu_wrap">
				<div class="br_menu" onclick=''>
					BEST 랭킹
				</div>
				<div class="br_menu" onclick=''>
					패션
				</div>
				<div class="br_menu" onclick=''>
					잡화
				</div>
				<div class="br_menu" onclick=''>
					유아동
				</div>
				<div class="br_menu" onclick=''>
					뷰티/헬스/식품
				</div>
				<div class="br_menu" onclick=''>
					디지털가전
				</div>
				<div class="br_menu" onclick=''>
					종합몰/백화점
				</div>
				<div class="br_menu" onclick=''>
					주방/생활/취미
				</div>
				<div class="br_menu" onclick=''>
					배송대행
				</div>
				<div class="br_menu" onclick=''>
					구매대행
				</div>
			</div>

			<div id="br_content" class="tab-content">
				<div id="br_top">
					<div id="br_top_title">
						베스트랭킹
					</div>
					<div id="br_top_content">
						박스원이 알선한 이번 주 해외직구 사이트 배스트 랭킹 순위!
					</div>
				</div>

				<div id="br_nav_wrap">
					<div class="nav_menu col-xs-6 col-sm-4" onclick=''>
						BEST 브랜드
					</div>
					<div class="nav_menu col-xs-6 col-sm-4" onclick="">
						패션
					</div>
					<div class="nav_menu col-xs-6 col-sm-4" onclick=''>
						잡화
					</div>
					<div class="nav_menu col-xs-6 col-sm-4" onclick=''>
						유아동
					</div>
					<div class="nav_menu col-xs-6 col-sm-4" onclick=''>
						뷰티/헬스/식품
					</div>
					<div class="nav_menu col-xs-6 col-sm-4" onclick=''>
						디지텉가전
					</div>
					<div class="nav_menu col-xs-6 col-sm-4" onclick=''>
						종합몰/백화점
					</div>
					<div class="nav_menu col-xs-6 col-sm-4" onclick=''>
						주방/생활/취미
					</div>
					<div class="nav_menu col-xs-6 col-sm-4" onclick=''>
						배송대행
					</div>
					<div class="nav_menu col-xs-6 col-sm-4" onclick=''>
						구매대행
					</div>
					<div class="clear_both"></div>
				</div>

				<div id="br_rank_wrap">
					<!-- 랭킹 1위 -->
					<div class="rank_div_top">
						<div class="rank_border">
							<div class="rank">
								<div class="rank_bookmark">
									<a onclick=""><img src="<?= $adr_img ?>bookmark.png"></a>
								</div>
								<div class="rank_no">
									BEST 1
								</div>
								<div class="rank_img">
									<a onclick=""><img src="<?= $adr_img ?>br_sample.png"></a>
								</div>
							</div>
							<div class="rank_desc">
								<div class="rank_desc_title">
									boxoneboxone
								</div>
								<div class="rank_desc_content">
									박스원박스원박스원
								</div>
							</div>
						</div>
					</div>
					
					<!-- 랭킹 2~9위 -->
					<div class="rank_div">
						<div class="rank_border">
							<div class="rank">
								<div class="rank_bookmark">
									<a onclick=""><img src="<?= $adr_img ?>bookmark.png"></a>
								</div>
								<div class="rank_no">
									BEST&nbsp;
									<span><!-- 랭크 no --></span>
								</div>
								<div class="rank_img">
									<a onclick=""><img src="<?= $adr_img ?>br_sample.png"></a>
								</div>
							</div>
							<div class="rank_desc">
								<div class="rank_desc_title">
									boxoneboxone
								</div>
								<div class="rank_desc_content">
									박스원박스원박스원
								</div>
							</div>
						</div>
					</div>
					
					<div class="clear_both"></div>
				</div>

				<div id="br_site_title">
					박스원박스원박스원
				</div>
				<div id="br_site_atoz">
					<a onclick="">A - E</a>
					<a onclick="">F - J</a>
					<a onclick="">K - O</a>
					<a onclick="">P - T</a>
					<a onclick="">U - Z</a>
				</div>
				
				<div id="site_list">
					<div class="site_set col-xs-6 col-sm-4">
						<div class="site_img">
							<a onclick=""><img src="<?= $adr_img ?>br_sample.png"></a>
						</div>
						<div class="site_name_set">
							<div class="site_bookmark">
								<a onclick=""><img src="<?= $adr_img ?>bookmark.png"></a>
							</div>
							<div class="site_name_en">
								boxoneboxone
							</div>
							<div class="site_name_kr">
								박스원박스원박스원
							</div>
							<div class="clear_both"></div>
						</div>
					</div>
					<div class="clear_both"></div>
				</div>
			</div>
		</div>
		
		<?php
		include ("footer.php");
		?>
	</body>
</html>

