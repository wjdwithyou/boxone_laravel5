<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php
		include ("libraries.php");
		?>
		<link  href="<?=$adr_ctr ?>fotorama/fotorama.css" rel="stylesheet">
		<script src="<?=$adr_ctr ?>fotorama/fotorama.js"></script>
	</head>

	<body>
		<?php
		include ("header.php");
		?>

		<div id="product_wrap">
			<div id="product_category" class="col=xs-12">
				<a>홈</a>&nbsp>&nbsp <a>패션잡화</a>&nbsp>&nbsp <a>가방</a>&nbsp>&nbsp <a>여성가방</a>&nbsp>&nbsp <a>파우치</a>
			</div>
			<div id="product_img_wrap" class="col-xs-12 col-sm-6">
				<div class="fotorama" data-width="100%" data-height="500px" data-nav="thumbs" data-allowfullscreen="true">
					<a href="<?=$adr_img ?>product_1.jpg"><img src="<?=$adr_img ?>product_1.jpg"></a>
					<a href="<?=$adr_img ?>product_2.jpg"><img src="<?=$adr_img ?>product_2.jpg"></a>
					<a href="<?=$adr_img ?>product_3.jpg"><img src="<?=$adr_img ?>product_3.jpg"></a>
					<a href="<?=$adr_img ?>product_4.jpg"><img src="<?=$adr_img ?>product_4.jpg"></a>
				</div>
			</div>
			<div id="product_desc_wrap" class="col-xs-12 col-sm-6">
				<div id="product_brand">
					토리버치
				</div>
				<div id="product_name">
					Smathers & Branson for J.Crew card case for j.Crew card case
				</div>
				<hr>
				<div id="product_site">
					amazon
				</div>
				<div id="product_price">
					<div class="desc_title">가격</div>
					<div id="original_price">￦134,000</div>
					<div id="sale_price">￦34,000</div>
				</div>
				<div id="product_ship_price">
					<div class="desc_title">배송비</div>
					<div id="ship_price">￦14,000</div>
				</div>
				<hr>
				<div class="desc_title">
					컬러
				</div>
				<div id="product_color">
					Wht/Bright gold
				</div>
				<div>
					<div class="desc_title">사이즈</div>
					<a onclick="">사이즈표</a>
				</div>
				<div id="product_size">
					<select id="size_select" class="form-control" onchange="">
						<option value="">사이즈</option>
						<option value="">S</option>
						<option value="">M</option>
						<option value="">L</option>
						<option value="">XL</option>
					</select>
				</div>
				<div id="product_buy">
					<button type="button" class="btn btn-default" onclick="">
						구매하기
					</button>
				</div>
				<hr>
				<div class="desc_title">
					같은 가격의 쇼핑몰이 궁금하다면?
				</div>
				<div id="compare_same_wrap">
					<div class="compare_same">
						<div class="compare_same_site">
							REVOLVE clothing
						</div>
						<div class="compare_same_desc">
							<div class="ship_condition">무료배송 면세</div>
							<button type="button" class="btn btn-default" onclick="">
								후기 6
							</button>
						</div>
					</div>
					<div class="compare_same">
						<div class="compare_same_site">
							REVOLVE clothing
						</div>
						<div class="compare_same_desc">
							<div class="ship_condition">무료배송 면세</div>
							<button type="button" class="btn btn-default" onclick="">
								후기 6
							</button>
						</div>
					</div>
					<div class="compare_same">
						<div class="compare_same_site">
							REVOLVE clothing
						</div>
						<div class="compare_same_desc">
							<div class="ship_condition">무료배송 면세</div>
							<button type="button" class="btn btn-default" onclick="">
								후기 6
							</button>
						</div>
					</div>
					<div class="compare_same">
						<div class="compare_same_site">
							REVOLVE clothing
						</div>
						<div class="compare_same_desc">
							<div class="ship_condition">무료배송 면세</div>
							<button type="button" class="btn btn-default" onclick="">
								후기 6
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="clear_both"></div>

			<div id="review_wrap">
				<div id="review_text">
					상품 리뷰
				</div>
			</div>
		</div>

		<?php
		include ("footer.php");
		?>
	</body>
</html>

