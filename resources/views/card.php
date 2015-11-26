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

		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img class="first-slide" src="<?=$adr_img ?>main_image_1.jpg" alt="First slide">
				</div>
				<div class="item">
					<img class="second-slide" src="<?=$adr_img ?>main_image_2.jpg" alt="Second slide">
				</div>
				<div class="item">
					<img class="third-slide" src="<?=$adr_img ?>main_image_3.jpg" alt="Third slide">
				</div>
			</div>
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
		</div>

		<div id="card_search_wrap">
			<div id="card_set">
				<div id="card_name_search" class="card_search_shape">
					<div class="card_search_title">
						카드검색
					</div>
					<div class="card_search_input">
						<input type="text" id="" class="form-control" placeholder="카드명 입력">
						<a onclick=""><img src="<?= $adr_img ?>search_img_white.png"></a>
					</div>
					<div class="card_search_all">
						전체보기
					</div>
				</div>
				<div id="card_proxy_search" class="card_search_shape">
					<div class="card_search_title">
						배대지 제휴 신용카드
					</div>
					<div class="card_search_input">
						<select class="form-control">
							<option>배대지 선택</option>
							<option>뉴욕걸즈</option>
							<option>몰테일</option>
							<option>세븐존</option>
							<option>아이딜리버</option>
							<option>아이포터</option>
							<option>위메프박스</option>
							<option>오마이짐</option>
							<option>이하넥스</option>
						</select>
					</div>
					<div class="card_search_all">
						전체보기
					</div>
				</div>
				<div id="card_benefit_search" class="card_search_shape">
					<div class="card_search_title">
						해외결제 혜택카드
					</div>
					<div class="card_search_input">
						<select class="form-control">
							<option>카드사 선택</option>
							<option>뉴욕걸즈</option>
							<option>몰테일</option>
							<option>세븐존</option>
							<option>아이딜리버</option>
							<option>아이포터</option>
							<option>위메프박스</option>
							<option>오마이짐</option>
							<option>이하넥스</option>
						</select>
					</div>
					<div class="card_search_all">
						전체보기
					</div>
				</div>
				<div class="clear_both"></div>
			</div>
		</div>

		<div id="card_result_wrap">
			<div id="card_result">
				<div id="result_title">
					<span>해외결제 혜택 신용카드</span>
					&nbsp;(<span>20</span>)
				</div>
				<div class="result_sub_title">
					신한카드
				</div>
				<div class="result_content">
					<div class="col-xs-4">
						<img src="<?= $adr_img?>card_sample.jpg">
					</div>
					<div class="col-xs-8">
						<div class="card_desc">
							<div class="card_name">신한 SMART GLOBAL 카드</div>
							<div class="card_title">아이포터 (해외직구 배송대행 서비스)</div>
							<div class="card_content">
								배송비 할인: 3% 쿠폰 제공, 묶음 배송비 할인 : $2 쿠폰 제공, 사진 촬영비 할인: $1 쿠폰제공 *이용 실적 조건 및 금액 한도, 이용 횟수 제한 없음 "아이포터 URL:www.iporter.com"
							</div>
						</div>
					</div>
					<div class="clear_both"></div>
				</div>
				<div class="result_content">
					<div class="col-xs-4">
						<img src="<?= $adr_img?>card_sample.jpg">
					</div>
					<div class="col-xs-8">
						<div class="card_desc">
							<div class="card_name">신한 SMART GLOBAL 카드</div>
							<div class="card_title">아이포터 (해외직구 배송대행 서비스)</div>
							<div class="card_content">
								배송비 할인: 3% 쿠폰 제공, 묶음 배송비 할인 : $2 쿠폰 제공, 사진 촬영비 할인: $1 쿠폰제공 *이용 실적 조건 및 금액 한도, 이용 횟수 제한 없음 "아이포터 URL:www.iporter.com"
								배송비 할인: 3% 쿠폰 제공, 묶음 배송비 할인 : $2 쿠폰 제공, 사진 촬영비 할인: $1 쿠폰제공 *이용 실적 조건 및 금액 한도, 이용 횟수 제한 없음 "아이포터 URL:www.iporter.com"
								배송비 할인: 3% 쿠폰 제공, 묶음 배송비 할인 : $2 쿠폰 제공, 사진 촬영비 할인: $1 쿠폰제공 *이용 실적 조건 및 금액 한도, 이용 횟수 제한 없음 "아이포터 URL:www.iporter.com"
								배송비 할인: 3% 쿠폰 제공, 묶음 배송비 할인 : $2 쿠폰 제공, 사진 촬영비 할인: $1 쿠폰제공 *이용 실적 조건 및 금액 한도, 이용 횟수 제한 없음 "아이포터 URL:www.iporter.com"
							</div>
						</div>
					</div>
					<div class="clear_both"></div>
				</div>
				<div class="result_content">
					<div class="col-xs-4">
						<img src="<?= $adr_img?>card_sample.jpg">
					</div>
					<div class="col-xs-8">
						<div class="card_desc">
							<div class="card_name">신한 SMART GLOBAL 카드</div>
							<div class="card_title">아이포터 (해외직구 배송대행 서비스)</div>
							<div class="card_content">
								배송비 할인: 3% 쿠폰 제공, 묶음 배송비 할인 : $2 쿠폰 제공, 사진 촬영비 할인: $1 쿠폰제공 *이용 실적 조건 및 금액 한도, 이용 횟수 제한 없음 "아이포터 URL:www.iporter.com"
							</div>
						</div>
					</div>
					<div class="clear_both"></div>
				</div>
				<div class="result_content">
					<div class="col-xs-4">
						<img src="<?= $adr_img?>card_sample.jpg">
					</div>
					<div class="col-xs-8">
						<div class="card_desc">
							<div class="card_name">신한 SMART GLOBAL 카드</div>
							<div class="card_title">아이포터 (해외직구 배송대행 서비스)</div>
							<div class="card_content">
								배송비 할인: 3% 쿠폰 제공, 묶음 배송비 할인 : $2 쿠폰 제공, 사진 촬영비 할인: $1 쿠폰제공 *이용 실적 조건 및 금액 한도, 이용 횟수 제한 없음 "아이포터 URL:www.iporter.com"
							</div>
						</div>
					</div>
					<div class="clear_both"></div>
				</div>
				<div class="result_content">
					<div class="col-xs-4">
						<img src="<?= $adr_img?>card_sample.jpg">
					</div>
					<div class="col-xs-8">
						<div class="card_desc">
							<div class="card_name">신한 SMART GLOBAL 카드</div>
							<div class="card_title">아이포터 (해외직구 배송대행 서비스)</div>
							<div class="card_content">
								배송비 할인: 3% 쿠폰 제공, 묶음 배송비 할인 : $2 쿠폰 제공, 사진 촬영비 할인: $1 쿠폰제공 *이용 실적 조건 및 금액 한도, 이용 횟수 제한 없음 "아이포터 URL:www.iporter.com"
							</div>
						</div>
					</div>
					<div class="clear_both"></div>
				</div>
			</div>
		</div>

		<style>
			#myCarousel, #myCarousel .carousel-inner {
				height: 300px;
			}
			#myCarousel {
				margin-bottom: 20px;
			}
			#card_search_wrap {
				max-width: 992px;
				margin: 0 auto;
			}
			@media (max-width: 500px) {
				#card_set {
					width: 250px;
					margin: 0 auto;
				}
				.card_search_shape:nth-of-type(2) {
					clear: both;
				}
			}
			@media (min-width: 501px) and (max-width: 750px) {
				#card_set {
					width: 500px;
					margin: 0 auto;
				}
				.card_search_shape:nth-of-type(3) {
					clear: both;
				}
			}
			@media (min-width: 751px){
				#card_set {
					width: 750px;
					margin: 0 auto;
				}
			}
			.card_search_shape {
				width: 230px;
				height: 140px;
				border-radius: 10px !important;
				float: left;
				margin: 10px;
			}
			.card_search_title {
				padding: 10px;
				color: #fff;
			}
			.card_search_all {
				margin-top: 40px;
				font-size: 11px;
				text-decoration: underline;
				text-align: center;
				cursor: pointer;
				color: #fff;
			}
			#card_name_search {
				background-color: #8352fa;
			}
			#card_name_search input {
				background-color: #b597fc;
				border: 0;
				color: #fff;
			}
			#card_name_search img {
				width: 16px;
				height: 16px;
				position: absolute;
				z-index: 99;
				margin-top: -25px;
				margin-left: 200px;
			}
			#card_proxy_search {
				background-color: #66d3c6;
			}
			#card_proxy_search select {
				background-color: #a3e5dd;
				border: 0;
			}
			#card_benefit_search {
				background-color: #ffc849;
			}
			#card_benefit_search select {
				background-color: #ffde92;
				border: 0;
			}
			#card_result_wrap {
				max-width: 750px;
				margin: 0 auto;
				padding: 20px 10px;
			}
			#card_result {
				width: 100%;
				border: 2px solid #ddd;
			}
			#result_title {
				width: 100%;
				padding: 10px;
				border-bottom: 2px solid #ddd;
				background-color: #eee;
			}
			.result_sub_title {
				width: 100%;
				padding: 10px;
				border-bottom: 2px solid #ddd;
				font-size: 16px;
				font-weight: bold;
			}
			.result_content {
				width: 100%;
				padding: 20px 10px;
				margin: 20px 0;
			}
			.result_content img {
				width: 100%;
			}
			.card_name {
				font-size: 16px;
				font-weight: bold;
				padding-bottom: 10px;
			}
			.card_title {
				font-weight: bold;
			}
			.card_content {
				font-size: 12px;
			}
		</style>
		<?php
		include ("footer.php");
		?>
	</body>
</html>

