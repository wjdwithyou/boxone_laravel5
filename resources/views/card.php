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
						<input type="text" id="card_name_search_input" class="form-control" placeholder="카드명 입력">
						<a onclick="getCardList(1);"><img src="<?= $adr_img ?>search_img_white.png"></a>
					</div>
					<div class="card_search_all" onclick="getCardListAll(1);">
						전체보기
					</div>
				</div>
				<div id="card_proxy_search" class="card_search_shape">
					<div class="card_search_title">
						배대지 제휴 신용카드
					</div>
					<div class="card_search_input">
						<select id="card_proxy_search_input" class="form-control">
							<option>배대지 선택</option>
							<?php foreach ($siteList as $site): ?>
								<option><?= $site->name?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="card_search_all" onclick="getCardListAll(2);">
						전체보기
					</div>
				</div>
				<div id="card_benefit_search" class="card_search_shape">
					<div class="card_search_title">
						해외결제 혜택카드
					</div>
					<div class="card_search_input">
						<select id="card_benefit_search_input" class="form-control">
							<option>카드사 선택</option>
							<?php foreach ($compList as $comp): ?>
								<option><?= $comp->support_card?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="card_search_all" onclick="getCardListAll(3);">
						전체보기
					</div>
				</div>
				<div class="clear_both"></div>
			</div>
		</div>

		<div id="card_result_wrap">
			<!-- 카드 내용 들어가는곳  -->
		</div>
		
		<?php
		include ("footer.php");
		?>
	</body>
</html>

