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
				<div class="br_menu" onclick='location.href="<?= $adr_ctr?>Bestranking/index?cate=0&char=1"'>
					BEST 랭킹
				</div>
				<?php foreach($cate as $cateList):?>
					<div class="br_menu" onclick='location.href = "<?= $adr_ctr?>Bestranking/index?cate=<?= $cateList->idx?>"'>
						<?= $cateList->name?>
					</div>
				<?php endforeach;?>
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
					<div class="nav_menu col-xs-6 col-sm-4" onclick='location.href = "<?= $adr_ctr?>Bestranking/index?cate=0&char=1"'>
						BEST 랭킹
					</div>
					<?php foreach($cate as $cateList):?>
						<div class="nav_menu col-xs-6 col-sm-4" onclick='location.href = "<?= $adr_ctr?>Bestranking/index?cate=<?= $cateList->idx?>"'>
							<?= $cateList->name?>
						</div>
					<?php endforeach;?>
					<div class="clear_both"></div>
				</div>

				<div id="br_rank_wrap">
					<!-- 랭킹 1위 -->
					<?php if ($best1 != null) :?>
						<div class="rank_div_top">
							<div class="rank_border">
								<div class="rank">
									<div class="rank_bookmark">
										<a onclick=""><img src="<?= $adr_img ?>bookmark.png"></a>
									</div>
									<div class="clear_both"></div>
									<div class="rank_no">
										BEST 1
									</div>
									<div class="rank_img">
										<a onclick="location.href = '<?= $best1->website_link?>'"><img src="<?= $adr_img ?>site/<?= $best1->idx?>.png"></a>
									</div>
								</div>
								<div class="rank_desc">
									<div class="rank_desc_title">
										<?= $best1->name_eng?>
									</div>
									<div class="rank_desc_content">
										<?= $best1->name?>
									</div>
								</div>
							</div>
						</div>
					<?php endif;?>
					
					<!-- 랭킹 2~10위 -->
					<?php for($i = 1 ; $i < count($upper) ; $i++) :?>
						<div class="rank_div">
							<div class="rank_border">
								<div class="rank">
									<div class="rank_bookmark">
										<a onclick=""><img src="<?= $adr_img ?>bookmark.png"></a>
									</div>
									<div class="clear_both"></div>
									<div class="rank_no">
										BEST <?= ($i+1)?>
										<span><!-- 랭크 no --></span>
									</div>
									<div class="rank_img">
										<a onclick="location.href = '<?= $upper[$i]->website_link?>'"><img src="<?= $adr_img ?>site/<?= $upper[$i]->idx?>.png"></a>
									</div>
								</div>
								<div class="rank_desc">
									<div class="rank_desc_title">
										<?= $upper[$i]->name_eng?>
									</div>
									<div class="rank_desc_content">
										<?= $upper[$i]->name?>
									</div>
								</div>
							</div>
						</div>
					<?php endfor;?>
					
					<div class="clear_both"></div>
				</div>

				<div id="br_site_title">
					더 많은 사이트를 알고 싶어요!
				</div>
				<div id="br_site_atoz">
					<a onclick="sortByChar(<?= $nowCate?>, 1);">0 - 9</a>
					<a onclick="sortByChar(<?= $nowCate?>, 2);">A - E</a>
					<a onclick="sortByChar(<?= $nowCate?>, 3);">F - L</a>
					<a onclick="sortByChar(<?= $nowCate?>, 4);">M - S</a>
					<a onclick="sortByChar(<?= $nowCate?>, 5);">T - Z</a>
				</div>
				
				<div id="site_list">
					<?php foreach ($lower as $charList) :?>
						<div class="site_set col-xs-6 col-sm-4">
							<div class="site_img">
								<a onclick="location.href = '<?= $charList->website_link?>'"><img src="<?= $adr_img ?>site/<?= $charList->idx?>.png"></a>
							</div>
							<div class="site_name_set">
								<div class="site_bookmark">
									<a onclick=""><img src="<?= $adr_img ?>bookmark.png"></a>
								</div>
								<div class="site_name_en">
									<?= $charList->name_eng?>
								</div>
								<div class="site_name_kr">
									<?= $charList->name?>
								</div>
								<div class="clear_both"></div>
							</div>
						</div>
					<?php endforeach;?>
					<div class="clear_both"></div>
				</div>
			</div>
		</div>
		
		<?php
		include ("footer.php");
		?>
	</body>
</html>

