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
					<a onclick=""><img src="<?= $adr_img ?>search_img.png"></a>
					<input type="text" class="form-control">
				</div>
			</div>
		</div>

		<hr id="rw_hr">

		<div id="rw_result_wrap">
			<div id="rw_result_title">
				검색결과
			</div>
			<div id="rw_result">
				<div id="rw_result_top_wrap">
					<div id="rw_result_top">
						아마존 (amazon)
					</div>
				</div>
				
				<!-- 리워드 사이트 -->
				<div class="rw_result_div_wrap">
					<div class="rw_result_div">
						<div class="rw_site_img">
							<a onclick=""><img src="<?= $adr_img ?>br_sample.png"></a>
						</div>
						<div class="rw_site_desc">
							<div class="rw_site_name">
								<span class="site_name_kr">이베이츠</span>&nbsp;( <span class="site_name_en">ebates</span>)
							</div>
							<div class="rw_site_reward">
								<span class="reward_percent">5.5%</span> 리워드
							</div>
						</div>
					</div>
				</div>
				<!--  -->
				
				<div class="clear_both"></div>
			</div>
		</div>

		<?php
		include ("footer.php");
		?>
	</body>
</html>