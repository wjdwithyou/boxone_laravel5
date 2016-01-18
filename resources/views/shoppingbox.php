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
			<h1 class="top_h2">
				<?php if (count($nowCate)) :?>
					<?php echo ($nowCate[count($nowCate)-1][1]);?>
				<?php else :?>
					전체
				<?php endif;?>
			</h1>
		</div>
		<div id="content">
			<div class="inner">
				<nav id="index">
					<a href='<?=$adr_ctr?>Shoppingbox/index'>쇼핑박스</a>
					<?php foreach ($nowCate as $list) :?>
						&nbsp;>&nbsp;
						<a onclick="getPrdt('<?=$list[0]?>','',1);"><?=$list[1]?></a>
					<?php endforeach;?>
				</nav>
				<div id="select_wrap" class="f_c">
					<div>
						<select id="select_cate" class="bo_selectbox bo_selectbox_2">
							<?php foreach ($cateList as $list) :?>
								<?php if ($list[2]) :?>
									<option value="<?=$list[0]?>" selected="selected"><?=$list[1]?></option>
								<?php else :?>
									<option value="<?=$list[0]?>"><?=$list[1]?></option>
								<?php endif;?>
							<?php endforeach;?>
						</select>
					</div>
					<div>
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
						<div class="imglist_desc1 t_o bo_color2">
							<?=$list->brand?>
						</div>
						<div class="imglist_desc2 limit_line limit_line_2">
							<div>
								<?=$list->name?>
							</div>
						</div>
						<div class="imglist_desc3 t_o">
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
