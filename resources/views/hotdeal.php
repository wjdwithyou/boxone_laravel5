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
					핫딜상품 <!-- or 핫딜코드 -->
				</div>
				<div id="top_content">
					핫딜 상품과 코드를 모아놨어용:)
				</div>
				<hr>
				<div id="current_cate">
					니트/스웨터
				</div>
				<div id="top_index">
					<a onclick=''>핫딜상품 <!-- or 핫딜코드 --></a>
					&nbsp;>&nbsp;
					<a onclick=''>여성의류</a>
					&nbsp;>&nbsp;
					<a onclick=''>상의</a>
					&nbsp;>&nbsp;
					<a onclick=''>니트/스웨터</a>
				</div>
				<div id="top_select">
					<select id="hotdeal_cate" class="form-control" onchange="hotdeal_cate();">
						<option value="">전체</option>
						<option value="">니트/스웨터</option>
						<option value="">셔츠</option>
						<option value="">티셔츠</option>
						<option value="">가디건/베스트</option>
					</select>
				</div>
				<!-- 핫딜상품 -->
				<!-- <div id="brand_select">
					<select id="brand_cate" class="form-control" onchange="">
						<option value="">브랜드</option>
						<option value="">Polo</option>
						<option value="">Nike</option>
						<option value="">Adidas</option>
						<option value="">Reebok</option>
					</select>
				</div> -->
				<!-- 핫딜코드 -->
				<div id="site_select">
					<select id="site_cate" class="form-control" onchange="">
						<option value="">사이트</option>
						<option value="">Amazon</option>
						<option value="">Polo</option>
						<option value="">ebay</option>
						<option value="">auction</option>
					</select>
				</div>
				<div id="order_select">
					<select id="order_list" class="form-control" onchange="order_list();">
						<option value="">모두보기</option>
						<option value="">인기 순</option>
						<option value="">할인율: 높은 순</option>
						<option value="">할인율: 낮은 순</option>
						<option value="">나의 ♥</option>
					</select>
				</div>
			</div>

			<div id="hd_result_wrap">

				<!-- 핫딜상품 -->
				<div class="hd_result_div_wrap">
					<div class="hd_result_div">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>calculator.jpg"></a>
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
								[30%] 34,900 원
							</div>
						</div>
					</div>
				</div>
				<!--  -->

				<!-- 핫딜코드 -->
				<div class="hd_result_div_wrap">
					<div class="hd_result_div">
						<div class="hd_code_img center_box">
							<div class="hd_bookmark">
								<a onclick="add_heart($(this).children());"><img src="<?= $adr_img ?>heart.png"></a>
							</div>
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>br_sample.png"></a>
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
							<div class="hd_code_duration text_overflow">
								2015.12.12 ~ 2015.12.21
							</div>
							<div class="hd_code text_overflow">
								CODE: REDHOT231
							</div>
						</div>
					</div>
				</div>
				<!--  -->

				<div class="clear_both"></div>
			</div>

			<div id="pagination_wrap">
				<a onclick=""><img src="<?= $adr_img ?>left_arrow.png"></a>
				<div id="pagination">
					<a class="current_page" onclick="">1</a>
					<a onclick="">2</a>
					<a onclick="">3</a>
					<span>···</span>
					<a onclick="">7</a>
				</div>
				<a onclick=""><img src="<?= $adr_img ?>right_arrow.png"></a>
			</div>
		</div>
		
		<?php
		include ("footer.php");
		?>
	</body>
</html>

