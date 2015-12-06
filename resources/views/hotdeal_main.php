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

		<div id="container">
			<div id="top">
				<div id="top_title">
					핫딜
				</div>
				<div id="top_content">
					핫딜 상품 코드 핫딜 상품 코드 핫딜 상품 코드
				</div>
			</div>

			<div id="hd_top_wrap">
				<div id="calendar_wrap" class="col-sm-4">
					<div id="calendar_top">
						세일캘린더
					</div>
					<div id="calendar_nav">
						<a id="prev_month"><img src="<?= $adr_img ?>left_arrow.png"></a>
						<div id="current_month"></div>
						<a id="next_month"><img src="<?= $adr_img ?>right_arrow.png"></a>
					</div>
					<div id="calendar"></div>
				</div>
				<div id="top_ad_wrap" class="col-sm-8">
					<img src="<?= $adr_img ?>guide_background.jpg">
					<div id="top_ad_inner">

					</div>
					<div id="slopy_div" hidden></div>
				</div>
			</div>

			<div id="hd_product_wrap">
				<div id="hd_product_top">
					<span>베스트 핫딜 상품</span>
				</div>
				<hr id="hd_product_hr">
				<div id="hd_product_all">
					더 많은 핫딜 상품은 여기에!&nbsp;
					<a onclick="">모두보기</a>
				</div>
				<hr id="hd_product_hr2" hidden>
				<div id="product_wrap">
					<div class="product_div col-xs-6 col-sm-4 col-md-2">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>product_ex.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_price text_overflow">
								[30%] ￦34,900
							</div>
						</div>
					</div>
					<div class="product_div col-xs-6 col-sm-4 col-md-2">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>product_ex.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_price text_overflow">
								[30%] ￦34,900
							</div>
						</div>
					</div>
					<div class="product_div col-xs-6 col-sm-4 col-md-2">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>product_ex.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_price text_overflow">
								[30%] ￦34,900
							</div>
						</div>
					</div>
					<div class="product_div col-xs-6 col-sm-4 col-md-2">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>product_ex.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_price text_overflow">
								[30%] ￦34,900
							</div>
						</div>
					</div>
					<div class="product_div2 col-xs-12 col-sm-8 col-md-4">
						<img src="<?= $adr_img ?>guide_background.jpg">
						<div class="product_div2_inner"></div>
					</div>
					<div class="product_div2 col-xs-12 col-sm-8 col-md-4">
						<img src="<?= $adr_img ?>guide_background.jpg">
						<div class="product_div2_inner2"></div>
					</div>
					<div class="product_div col-xs-6 col-sm-4 col-md-2">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>product_ex.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_price text_overflow">
								[30%] ￦34,900
							</div>
						</div>
					</div>
					<div class="product_div col-xs-6 col-sm-4 col-md-2">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>product_ex.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_price text_overflow">
								[30%] ￦34,900
							</div>
						</div>
					</div>
					<div class="product_div col-xs-6 col-sm-4 col-md-2">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>product_ex.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_price text_overflow">
								[30%] ￦34,900
							</div>
						</div>
					</div>
					<div class="product_div col-xs-6 col-sm-4 col-md-2">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>product_ex.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_price text_overflow">
								[30%] ￦34,900
							</div>
						</div>
					</div>

				</div>
			</div>

			<div id="hd_code_wrap">
				<div id="hd_code_all">
					더 많은 핫딜 상품은 여기에!&nbsp;
					<a onclick="">모두보기</a>
				</div>
				<div id="hd_code_top">
					베스트 핫딜 코드
				</div>
				<div id="code_wrap">
					<div class="code_div col-xs-12 col-sm-6 col-md-4">
						<div class="code_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>br_sample.png"></a>
							</div>
						</div>
						<div class="code_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_code_duration text_overflow">
								2015.12.12 ~ 2015.12.21
							</div>
							<div class="hd_code text_overflow">
								CODE: GIFT
							</div>
						</div>
					</div>
					<div class="code_div col-xs-12 col-sm-6 col-md-4">
						<div class="code_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>br_sample.png"></a>
							</div>
						</div>
						<div class="code_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_code_duration text_overflow">
								2015.12.12 ~ 2015.12.21
							</div>
							<div class="hd_code text_overflow">
								CODE: GIFT
							</div>
						</div>
					</div>
					<div id="move_target" class="code_div col-xs-12 col-sm-6 col-md-4">
						<div class="code_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>br_sample.png"></a>
							</div>
						</div>
						<div class="code_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_code_duration text_overflow">
								2015.12.12 ~ 2015.12.21
							</div>
							<div class="hd_code text_overflow">
								CODE: GIFT
							</div>
						</div>
					</div>
					<div id="move_target2" class="code_div2 col-xs-12 col-md-8">
						
					</div>
					<div id="move_div" class="code_div3 col-xs-12 col-sm-6 col-md-4">
						<div class="code_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>br_sample.png"></a>
							</div>
						</div>
						<div class="code_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_code_duration text_overflow">
								2015.12.12 ~ 2015.12.21
							</div>
							<div class="hd_code text_overflow">
								CODE: GIFT
							</div>
						</div>
					</div>
					<div class="code_div3 col-xs-12 col-sm-6 col-md-4">
						<div class="code_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>br_sample.png"></a>
							</div>
						</div>
						<div class="code_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_code_duration text_overflow">
								2015.12.12 ~ 2015.12.21
							</div>
							<div class="hd_code text_overflow">
								CODE: GIFT
							</div>
						</div>
					</div>
					<div class="code_div3 col-xs-12 col-sm-6 col-md-4">
						<div class="code_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>br_sample.png"></a>
							</div>
						</div>
						<div class="code_desc">
							<div class="hd_brand text_overflow">
								토리버치
							</div>
							<div class="hd_product_name">
								<div>
									상품명
									토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일 토리버치 잡화 제화 최고 25%까지 세일
								</div>
							</div>
							<div class="hd_code_duration text_overflow">
								2015.12.12 ~ 2015.12.21
							</div>
							<div class="hd_code text_overflow">
								CODE: GIFT
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		include ("footer.php");
		?>
	</body>
</html>

