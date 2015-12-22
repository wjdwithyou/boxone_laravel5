<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php
		include ("libraries.php");
		?>

		<style>
			#hotdeal_cate {
				width: 188px;
				height: 40px;
				border: 0 !important;
				color: #FFF;
				background: #F15A63 url('<?=$adr_img ?>select_arrow.png') no-repeat 90% center;
				text-indent: 0.01px;
				text-overflow: "";
				padding-left: 6px;
				-webkit-appearance: none;
				-moz-appearance: none;
				appearance: none;
			}
			#order_list {
				width: 188px;
				height: 40px;
				border: 1px solid #F15A63 !important;
				color: #F15A63;
				background: #fff url('<?=$adr_img ?>select_arrow_pink.png') no-repeat 90% center;
				text-indent: 0.01px;
				text-overflow: "";
				padding-left: 6px;
				-webkit-appearance: none;
				-moz-appearance: none;
				appearance: none;
			}
			@media (max-width: 450px) {
				#hotdeal_cate, #order_list {
					width: 100%;
					background: #F15A63 url('<?=$adr_img ?>select_arrow.png') no-repeat 95% center;
				}
				#order_list {
					width: 100%;
					margin-top: 5px;
					background: #fff url('<?=$adr_img ?>select_arrow_pink.png') no-repeat 95% center;
				}
			}
		</style>
	</head>

	<body>
		<?php
		include ("header.php");
		?>

		<div id="container">
			<div id="top">
				<div id="top_title">
					쇼핑박스
				</div>
				<div id="top_content">
					전세계 모든 상품들을 클릭 한번에 내 입맛대로
				</div>
				<hr>
				<div id="current_cate">
					니트/스웨터
				</div>
				<div id="top_index">
					<a onclick=''>쇼핑박스</a>
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

			<div id="product_wrap">
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div2 col-xs-12 col-sm-8 col-md-4">
					<div class="large_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_1.jpg"></a>
						</div>
					</div>
					<div class="product_div2_inner"></div>
				</div>
				<div class="product_div2 col-xs-12 col-sm-8 col-md-4">
					<div class="large_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_2.jpg"></a>
						</div>
					</div>
					<div class="product_div2_inner2"></div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div2 col-xs-12 col-sm-8 col-md-4">
					<div class="large_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_3.jpg"></a>
						</div>
					</div>
					<div class="product_div2_inner"></div>
				</div>
				<div class="product_div2 col-xs-12 col-sm-8 col-md-4">
					<div class="large_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_4.jpg"></a>
						</div>
					</div>
					<div class="product_div2_inner2"></div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_4.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
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

