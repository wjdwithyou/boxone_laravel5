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
					핫딜상품 <?=$type?><!-- or 핫딜코드 -->
				</div>
				<div id="top_index">
					<a href='<?=$adr_ctr?>Hotdeal/indexCode'>핫딜<?=$type?><!-- or 핫딜코드 --></a>
					&nbsp;>&nbsp;
					<a href='<?=$adr_ctr?>Hotdeal/indexCode?cate=<?=$nowCate['idx']?>'><?=$nowCate['name']?></a>
					&nbsp;>&nbsp;
				</div>
				<div id="top_select">
					<select id="hotdeal_cate" class="form-control" onchange="hotdeal_cate();">
						<option value="0">전체</option> 
						<?php foreach($cateList as $list) :?>
							<?php if ($list->idx == $nowCate['idx']) :?>
								<option value="<?=$list->idx?>" selected="selected"><?=$list->name?></option>
							<?php else :?>
								<option value="<?=$list->idx?>"><?=$list->name?></option>
							<?php endif;?>
						<?php endforeach;?>
					</select>
				</div>
				<div id="order_select">
					<select id="order_list" class="form-control" onchange="order_list();">
						<?php if ($type == '상품') :?>
							<option value="1">인기 순</option>
							<option value="2">기한 순</option>
							<option value="3">할인율: 높은 순</option>
							<option value="4">할인율: 낮은 순</option>
						<?php else :?>
							<?php if ($sort == 1 || $sort == '1') :?>
								<option value="1" selected="selected">인기 순</option>
								<option value="2">기한 순</option>
								<option value="3">사이트 순</option>
							<?php endif;?>
							<?php if ($sort == 2 || $sort == '2') :?>
								<option value="1">인기 순</option>
								<option value="2" selected="selected">기한 순</option>
								<option value="3">사이트 순</option>
							<?php endif;?>
							<?php if ($sort == 3 || $sort == '3') :?>
								<option value="1">인기 순</option>
								<option value="2">기한 순</option>
								<option value="3" selected="selected">사이트 순</option>
							<?php endif;?>
							
						<?php endif;?>
						<?php if ($logined) :?> 
							<option value="5">나의 ♥</option> 
						<?php endif;?>
					</select>
				</div>
			</div>

			<div id="hd_result_wrap">
				<!-- 핫딜상품 -->
				<?php if ($type == '상품') :?>
					<div class="hd_result_div_wrap">
						<div class="hd_result_div">
							<div class="hd_product_img center_box">
								<div class="hd_bookmark">
									<a onclick="add_heart($(this).children());"><img src="<?= $adr_img ?>heart.png"></a>
								</div>
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
				<?php endif;?>

				<!-- 핫딜코드 -->
				<?php if ($type == '코드') : foreach($prdt as $prdtList) :?>
					<div class="hd_result_div_wrap">
						<div class="hd_result_div">
							<div class="hd_code_img center_box">
								<div class="hd_bookmark">
									<a onclick="add_heart($(this).children());"><img src="<?= $adr_img ?>heart.png"></a>
								</div>
								<div class="center_content">
									<a onclick="hotdealConnect('<?=$prdtList->idx?>', '<?=$prdtList->website_link?>');"><img src="<?=$prdtList->image?>"></a>
								</div>
							</div>
							<div class="hd_site_desc">
								<div class="hd_brand text_overflow">
									<?=$prdtList->site_name?>
								</div>
								<div class="hd_code_name">
									<div>
										<?=$prdtList->title?><br>
										기한 : <?=$prdtList->deadline?> 까지
									</div>
								</div>
								<div class="hd_code text_overflow">
									<?php if (trim($prdtList->promo_code) != "") :?>
										CODE: <?=$prdtList->promo_code?>
									<?php else :?>
										쿠폰이 필요하지 않아요!
									<?php endif;?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; endif;?>
				
				<div class="clear_both"></div>
			</div>

			<input type="hidden" id="nowPage" value="<?=$paging['now']?>"/>
			<div id="pagination_wrap">
				<a onclick="hotdealHref('','',<?php echo ($paging['now'] - 1);?>);"><img src="<?= $adr_img ?>left_arrow.png"></a>
				<div id="pagination">
					<?php if ($paging['now'] > 3) :?>
						<a onclick="hotdealHref('','',1);">1</a>
						<span>···</span>
						<!-- <a onclick="hotdealHref('','',<?php echo ($paging['now'] - 2);?>);"><?php echo ($paging['now'] - 2);?></a> -->
						<a onclick="hotdealHref('','',<?php echo ($paging['now'] - 1);?>);"><?php echo ($paging['now'] - 1);?></a>
					<?php else :?>
						<?php for($i = 1 ; $i < $paging['now'] ; $i++) :?>
							<a onclick="hotdealHref('','',<?=$i?>);"><?=$i?></a>
						<?php endfor;?>
					<?php endif;?>
					<a class="current_page"><?=$paging['now']?></a>
					<?php if ($paging['max'] - $paging['now'] > 3) :?>
						<a onclick="hotdealHref('','',<?php echo ($paging['now'] + 1);?>);"><?php echo ($paging['now'] + 1);?></a>
						<!-- <a onclick="hotdealHref('','',<?php echo ($paging['now'] + 2);?>);"><?php echo ($paging['now'] + 2);?></a> -->
						<span>···</span>
						<a onclick="hotdealHref('','',<?=$paging['max']?>);"><?=$paging['max']?></a>
					<?php else :?>
						<?php for($i = $paging['now'] + 1 ; $i < $paging['max'] + 1 ; $i++) :?>
							<a onclick="hotdealHref('','',<?=$i?>);"><?=$i?></a>
						<?php endfor;?>
					<?php endif;?>
				</div>
				<a onclick="hotdealHref('','',<?php echo ($paging['now'] + 1);?>);"><img src="<?= $adr_img ?>right_arrow.png"></a>
			</div>
		</div>
		
		<?php
		include ("footer.php");
		?>
	</body>
</html>

