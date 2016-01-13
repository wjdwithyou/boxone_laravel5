<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php
		include ("libraries.php");
		?>

		<style>
			#hotdeal_cate {
				width: 188px;
				height: 40px;
				border: 0 !important;
				color: #FFF;
				background: #F15A63 url('<?=$adr_img ?>select_arrow.png') no-repeat 90% center;
				text-indent: 0.01px;
				text-overflow: "";
				padding-left: 6px;
				-webkit-appearance: none;
				-moz-appearance: none;
				appearance: none;
			}
			#order_list {
				width: 188px;
				height: 40px;
				border: 1px solid #F15A63 !important;
				color: #F15A63;
				background: #fff url('<?=$adr_img ?>select_arrow_pink.png') no-repeat 90% center;
				text-indent: 0.01px;
				text-overflow: "";
				padding-left: 6px;
				-webkit-appearance: none;
				-moz-appearance: none;
				appearance: none;
			}
			@media (max-width: 450px) {
				#hotdeal_cate, #order_list {
					width: 100%;
					background: #F15A63 url('<?=$adr_img ?>select_arrow.png') no-repeat 95% center;
				}
				#order_list {
					width: 100%;
					margin-top: 5px;
					background: #fff url('<?=$adr_img ?>select_arrow_pink.png') no-repeat 95% center;
				}
			}
		</style>
	</head>

	<body>
		<?php
		include ("header.php");
		?>

		<div id="container">
			<div id="top">
				<div id="top_title">
					쇼핑박스
				</div>
				<div id="top_content">
					전세계 모든 상품들을 클릭 한번에 내 입맛대로
				</div>
				<hr>
				<div id="current_cate">
					<?php if (count($nowCate)) :?>
						<?php echo ($nowCate[count($nowCate)-1][1]);?>
					<?php else :?>
						전체
					<?php endif;?>
				</div>
				<div id="top_index">
					<a href='<?=$adr_ctr?>Shoppingbox/index'>쇼핑박스</a>
					<?php foreach ($nowCate as $list) :?>
						&nbsp;>&nbsp;
						<a onclick="getPrdt('<?=$list[0]?>','',1);"><?=$list[1]?></a>
					<?php endforeach;?>
				</div>
				<div id="top_select">
					<select id="product_cate" class="form-control">
						<?php foreach ($cateList as $list) :?>
							<?php if ($list[2]) :?>
								<option value="<?=$list[0]?>" selected="selected"><?=$list[1]?></option>
							<?php else :?>
								<option value="<?=$list[0]?>"><?=$list[1]?></option>
							<?php endif;?>
						<?php endforeach;?>
					</select>
				</div>
				<div id="order_select">
					<select id="order_list" class="form-control">
						<option value="1"<?php if ($sort == 1) echo (" selected=\"selected\"");?>>인기 순</option>
						<option value="2"<?php if ($sort == 2) echo (" selected=\"selected\"");?>>가격: 낮은 순</option>
						<option value="3"<?php if ($sort == 3) echo (" selected=\"selected\"");?>>가격: 낮은 순</option>
						<option value="5"<?php if ($sort == 5) echo (" selected=\"selected\"");?>>나의 ♥</option>
					</select>
				</div>
			</div>

			<div id="product_wrap">
				<?php foreach ($prdt as $list) :?>
					<div class="product_div col-xs-6 col-sm-4 col-md-2">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick='location.href="<?=$adr_ctr ?>Product/detail?idx=<?=$list->idx?>"'><img src="<?=$list->img?>"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								<?=$list->brand?>
							</div>
							<div class="hd_product_name">
								<div>
									<?=$list->name?>
								</div>
							</div>
							<div class="hd_price text_overflow">
								￦<?=$list->fPrice?>
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

		<?php
		include ("footer.php");
		?>
	</body>
</html>

