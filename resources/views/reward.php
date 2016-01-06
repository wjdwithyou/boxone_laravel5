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
		<div id="rw_top">
			<div id="rw_top_title">
				리워드
			</div>
			<div id="rw_top_content">
				사이트를 경유하기만 해도 돈이 쌓이는 리워드 사이트 비교 검색
			</div>
		</div>

		<div id="rw_img_wrap">
			<img src="<?= $adr_img ?>reward_top.jpg">
		</div>

		<div id="rw_wrap">
			<div id="rw_search_wrap">
				<hr>
				<div id="rw_search_title">
					리워드 검색하기
				</div>
				<div id="rw_search">
					<a onclick="searchReward();"><img src="<?= $adr_img ?>search_img.png"></a>
					<input type="text" id="rw_search_text" class="form-control" placeholder="영어로 검색해주세요">
				</div>
			</div>
		</div>

		<hr id="rw_hr">

		<div id="rw_result_wrap">
			<div id="rw_result_title">
				검색결과
			</div>
			<div id="rw_result">
				<!-- 리워드 검색 결과 -->
			</div>
		</div>

		<?php
		include ("footer.php");
		?>
	</body>
</html>