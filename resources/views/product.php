<!DOCTYPE html>
<html lang="ko">
  <head>
  	<?php include("libraries.php"); ?>
  </head>

  <body>
    <?php include("header.php"); ?>

	<style>
		#product_wrap {
			max-width: 992px;
			margin: 0 auto;
		}
		.product_table tbody tr td {
			font-size: 12px;
			border: 0;
		}
		#product_img_wrap {
			height: 700px;
		}
		#product_img {
			width: 100%;
			height: 500px;
			position: relative;
			top: 50%;
			transform: translateY(-50%);
		}
		#product_img img {
			width: 100%;
			height: auto;
			position: relative;
			top: 50%;
			transform: translateY(-50%);
		}
		#plus_img {
			width: 100%;
			margin-top: 100px;
		}
		#plus_img div img {
			width: 80px;
			height: 50px;
		}
		#original_price {
			font-weight: bold;
			text-decoration: line-through;	
		}
		#sale_price {
			color: #f43497;
		}
		.select_wrap {
			padding-top: 0px !important;
			padding-bottom: 0px !important;
		}
		#size_select {
			max-width: 150px;
			float: left;
		}
		#size_table {
			float: left;
			margin-left: 10px;
			margin-top: 5px;
		}
		#product_brand {
			font-size: 16px;
		}
		#product_category {
			padding: 20px;
		}
		#product_category a {
			font-size: 12px;
		}
		#buy_btn {
			margin-top: 15px;
		}
		#plus_img_wrap {
			width: 100%;
			height: 200px;
		}
		#review_text {
			padding: 10px;
		    text-align: center;
		    border-top: 1px solid #ccc;
		    border-bottom: 1px solid #ccc;
		}
	</style>
	
	<div id="product_wrap">
		<div id="current_menu" class="col=xs-12">
			<span>쇼핑박스</span>
		</div>
		<div id="product_category" class="col=xs-12">
			<a>홈</a>&nbsp>&nbsp
			<a>패션잡화</a>&nbsp>&nbsp
			<a>가방</a>&nbsp>&nbsp
			<a>여성가방</a>&nbsp>&nbsp
			<a>파우치</a>
		</div>
		<div id="product_img_wrap" class="col-xs-12 col-sm-6">
			<div id="product_img">
				<a><img src="<?=$adr_img?>product_ex.jpg"/></a>		
			</div>
			<div id="plus_img">
				<div class="col-xs-3">
					<a><img src="<?=$adr_img?>product_ex.jpg"/></a>	
				</div>
				<div class="col-xs-3">
					<a><img src="<?=$adr_img?>product_ex.jpg"/></a>	
				</div>
				<div class="col-xs-3">
					<a><img src="<?=$adr_img?>product_ex.jpg"/></a>	
				</div>
				<div class="col-xs-3">
					<a><img src="<?=$adr_img?>product_ex.jpg"/></a>	
				</div>
				<div class="clear_both"></div>
			</div>
			<div class="clear_both"></div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<table class="product_table table">
				<tbody>
					<tr>
						<td colspan="2">
							<span id="product_brand" class="font_weight_bold">토리버치</span>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<span class="font_weight_bold">토리버치 핸드폰 지갑</span>
						</td>
					</tr>
					<tr>
						<td>가격</td>
						<td>
							<span id="original_price">$149.00</span>&nbsp
							<span id="sale_price">$79.00</span>
						</td>
					</tr>
					<tr>
						<td>배송비</td>
						<td>$5.00</td>
					</tr>
					<tr>
						<td>컬러</td>
						<td>STRIPE</td>
					</tr>
					<tr>
						<td>사이즈</td>
						<td class="select_wrap">
							<select id="size_select" class="form-control input-sm">
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
							</select>
							<a id="size_table">사이즈표</a>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<button type="button" id="buy_btn" class="boxone_btn_1 btn btn-default">구매하기</button>
						</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<table class="product_table table">
				<tbody>
					<tr>
						<td class="font_weight_bold" colspan="2">같은 가격의 쇼핑몰이 궁금하다면?</td>
					</tr>
					<tr>
						<td>REYOLE clothing
							<br>
							무료배송 면세 | 6ratings | ★★★☆☆	
						</td>
						<td>
							<button type="button" class="transparent_btn btn btn-default">구매하기</button>
						</td>
					</tr>
					<tr>
						<td>REYOLE clothing
							<br>
							무료배송 면세 | 6ratings | ★★★☆☆	
						</td>
						<td>
							<button type="button" class="transparent_btn btn btn-default">구매하기</button>
						</td>
					</tr>
					<tr>
						<td>REYOLE clothing
							<br>
							무료배송 면세 | 6ratings | ★★★☆☆	
						</td>
						<td>
							<button type="button" class="transparent_btn btn btn-default">구매하기</button>
						</td>
					</tr>				
					
				</tbody>
			</table>
			<hr>
			<table class="product_table table">
				<tbody>
					<tr>
						<td class="font_weight_bold">
							상품정보
						</td>
						
					</tr>
					<tr>
						<td>Imported Made of Coated Canvas Approx. 19" x 11" x 5 1/2". Approx. 7" strap drop. Magnetic Snap Closure
							Interior zip and two open pockets.
							Fabric Lining. Gold Tone Hardware.</td>
					</tr>					
					<tr>
						<td>FABRIC&CARE
							<ul>
								<li>100% cotton</li>
								<li>Machine-wash cold</li>
							</ul>
						</td>
					</tr>					
					<tr>
						<td>DETAILS&FIT
							<ul>
								<li>Cotton</li>
								<li>V-neck</li>
								<li>Short sleeves: sleeve length: 19.5"(49cm)</li>
								<li>27.5"(69cm) in length</li>
							</ul>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="clear_both"></div>
		
		<div id="review_wrap">
			<div id="review_text">
				<span>상품 리뷰</span>
			</div>
		</div>
	</div>
	
    <?php include("footer.php"); ?>
  </body>
</html>



