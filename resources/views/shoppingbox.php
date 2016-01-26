<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>
</head>

<body>
<div id="wrap">
	<div id="header">
	<?php include ("header.php");?>
	</div>
	
	<div id="container">
		<div id="top">
			<h1 class="top_h1">쇼핑박스</h1>
			<p class="top_p bo_color2">전세계 모든 상품들을 클릭 한번에 내 입맛대로</p>
			<hr class="top_hr">
			<h2 class="top_h2">
				<?php if (count($nowCate)) :?>
					<?php echo ($nowCate[count($nowCate)-1][1]);?>
				<?php else :?>
					전체
				<?php endif;?>
			</h2>
		</div>
		<div id="content">
			<div class="inner">
				<div class="f_c">
					<nav class="classify grid grid_211">
						<div class="classify_top">
							<a href='<?=$adr_ctr?>Shoppingbox/index'>쇼핑박스</a>
							<?php foreach ($nowCate as $list) :?>
								>
								<a onclick="getPrdt('<?=$list[0]?>','',1);"><?=$list[1]?></a>
							<?php endforeach;?>
						</div>
						<div id="cate_wrap" class="classify_div f_C">
							<?php foreach ($cateList as $list) :?>
								<?php if ($list[2]) :?>
								<input type="hidden" id="select_cate" value="<?=$list[0]?>">
								<?php else :?>
								<input type="hidden" id="select_cate" value="l0">
								<?php endif;?>
								<div class="grid grid_h">
									<a onclick="getPrdt('<?=$list[0]?>','',1);"><?=$list[1]?>&nbsp;<span class="bo_color2">123</span></a>
								</div>
							<?php endforeach;?>
						</div>
					</nav>
					<nav class="classify grid grid_211">
						<div class="classify_top f_c">
							<span>브랜드</span>
							<div id="collapse_brand" class="f_r">
								<a id="collapse_brand_btn" onclick="collapseBrand();"><img src="<?=$adr_img?>collapse_p.png" class="img_14"></a>
							</div>
						</div>
						<div id="brand_wrap" class="classify_div f_C">
							<?php foreach ($brandList as $list) :?>
							<div class="grid grid_h">
								<input type="checkbox" id="sc1" name="sc1" class="bo_checkbox bo_checkbox_1">
								<label for="sc1"><span></span><?=$list->brand?></label>
							</div>
							<?php endforeach;?>
						</div>
					</nav>
				</div>
				<div class="f_c mg_t32">
					<div class="font_14 mg_t12 fw_b f_l">
						<?php if (count($nowCate)) :?>
							<?php echo ($nowCate[count($nowCate)-1][1]);?>
						<?php else :?>
							전체
						<?php endif;?>
						 검색결과&nbsp;<span class="bo_color1"><?=$prdtCnt?></span>
					</div>
					<div class="f_r">
						<select id="select_orderby" class="bo_selectbox bo_selectbox_1">
							<option value="1"<?php if ($sort == 1) echo (" selected=\"selected\"");?>>인기 순</option>
							<option value="2"<?php if ($sort == 2) echo (" selected=\"selected\"");?>>가격: 낮은 순</option>
							<option value="3"<?php if ($sort == 3) echo (" selected=\"selected\"");?>>가격: 높은 순</option>
							<?php if ($nowCate[0][0] == "c") : ?>
								<option value="4"<?php if ($sort == 4) echo (" selected=\"selected\"");?>>할인율 순</option>
							<?php endif;?>
							<option value="5"<?php if ($sort == 5) echo (" selected=\"selected\"");?>>나의 ♥</option>
						</select>
					</div>
				</div>
				<hr class="sb_hr mg_t8">
			</div>
			<div id="imglist_wrap" class="f_c">
				<?php foreach ($prdt as $list) :?>
				<div class="imglist_div grid grid_432">
					<div class="imglist_img img_center">
						<div class="img_center_inner">
							<?php if ($nowCate[0][0] == "c") :?>
								<a onclick='location.href="<?=$adr_ctr ?>Hotdeal/productDetail?idx=<?=$list->idx?>"'><img src="<?=$list->img?>"></a>
							<?php else :?>
								<a onclick='location.href="<?=$adr_ctr ?>Shoppingbox/detail?idx=<?=$list->idx?>"'><img src="<?=$list->img?>"></a>
							<?php endif;?>
						</div>
					</div>
					<div class="imglist_desc_wrap">
						<div class="imglist_desc1 ta_c t_o bo_color2">
							<?=$list->brand?>
						</div>
						<div class="imglist_desc2 ta_c limit_line limit_line_2">
							<div>
								<?=$list->name?>
							</div>
						</div>
						<div class="imglist_desc3 ta_c t_o">
							<?php if (isset($list->fPrice)) : ?>
								￦<?=$list->fPrice?>
							<?php else :?>
								￦<?=$list->fPriceO?> -> ￦<?=$list->fPriceS?> (<?=$list->saleP?>%)
							<?php endif;?>
						</div>
					</div>
				</div>
				<?php endforeach;?>
			</div>
			<input type="hidden" id="nowPage" value="<?=$paging['now']?>"/>
			<div id="pagination_wrap">
				<a onclick="getPrdt('','',<?php echo ($paging['now'] - 1);?>);"><img src="<?= $adr_img ?>left_arrow.png"></a>
				<div id="pagination">
					<?php if ($paging['now'] > 3) :?>
						<a onclick="getPrdt('','',1);">1</a>
						<span>···</span>
						<a onclick="getPrdt('','',<?php echo ($paging['now'] - 1);?>);"><?php echo ($paging['now'] - 1);?></a>
					<?php else :?>
						<?php for($i = 1 ; $i < $paging['now'] ; $i++) :?>
							<a onclick="getPrdt('','','',<?=$i?>);"><?=$i?></a>
						<?php endfor;?>
					<?php endif;?>
					<a class="current_page"><?=$paging['now']?></a>
					<?php if ($paging['max'] - $paging['now'] > 3) :?>
						<a onclick="getPrdt('','',<?php echo ($paging['now'] + 1);?>);"><?php echo ($paging['now'] + 1);?></a>
						<span>···</span>
						<a onclick="getPrdt('','',<?=$paging['max']?>);"><?=$paging['max']?></a>
					<?php else :?>
						<?php for($i = $paging['now'] + 1 ; $i < $paging['max'] + 1 ; $i++) :?>
							<a onclick="getPrdt('','',<?=$i?>);"><?=$i?></a>
						<?php endfor;?>
					<?php endif;?>
				</div>
				<a onclick="getPrdt('','',<?php echo ($paging['now'] + 1);?>);"><img src="<?= $adr_img ?>right_arrow.png"></a>
			</div>
		</div>
	</div>
	
	<div id="footer">
	<?php include ("footer.php");?>
	</div>
	
</div>
</body>
</html>
