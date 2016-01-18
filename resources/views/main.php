<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>
<script src="<?=$adr_ctr?>bxslider/jquery.bxslider.min.js"></script>
<link rel="stylesheet" href="<?=$adr_ctr?>bxslider/jquery.bxslider.css" />
</head>

<body>
<div id="wrap">
	<div id="header">
	<?php include ("header.php");?>
	</div>
	
	<div id="container">
		<div id="content">
			<div id="main_slide">
				<div id="c1" class="slide"></div>
				<div id="c2" class="slide"></div>
				<div id="c3" class="slide"></div>
			</div>
			<div id="br_wrap" class="inner">
				<div class="ta_c mg_t32">
					<h2 class="top_h2 bo_color2">인기 쇼핑몰 랭킹</h2>
				</div>
				<div id="br_content" class="mg_t16">
					<div id="br_slide">
						<div class="slide"><a href=""><img src="<?=$adr_img?>site/1.png" title="1."></a></div>
						<div class="slide"><a href=""><img src="<?=$adr_img?>site/2.png" title="2."></a></div>
						<div class="slide"><a href=""><img src="<?=$adr_img?>site/3.png" title="3."></a></div>
						<div class="slide"><a href=""><img src="<?=$adr_img?>site/4.png" title="4."></a></div>
						<div class="slide"><a href=""><img src="<?=$adr_img?>site/5.png" title="5"></a></div>
						<div class="slide"><a href=""><img src="<?=$adr_img?>site/6.png" title="6."></a></div>
						<div class="slide"><a href=""><img src="<?=$adr_img?>site/7.png" title="7."></a></div>
						<div class="slide"><a href=""><img src="<?=$adr_img?>site/8.png" title="8."></a></div>
						<div class="slide"><a href=""><img src="<?=$adr_img?>site/9.png" title="9."></a></div>
						<div class="slide"><a href=""><img src="<?=$adr_img?>site/10.png" title="10."></a></div>
					</div>
				</div>
			</div>
			<div class="inner">
				<div class="ta_c mg_t64">
					<h2 class="top_h2 bo_color2">핫한 상품</h2>
					<p class="top_p bo_color2">지금 뜨고 있는 상품들을 만나보세요.</p>
				</div>
				<div id="hd_content" class="mg_t16 f_c">
					<div id="hd_slide">
						<?php foreach ($prdt as $list) :?>
						<div class="slide">
							<div class="imglist_div">
								<div class="imglist_img img_center">
									<div class="img_center_inner">
										<a href="<?=$adr_ctr ?>Shoppingbox/detail?idx=<?=$list->idx?>"><img src="<?=$list->img?>"></a>
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
										￦<?=$list->fPrice?>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
			<div class="inner">
				<div class="ta_c mg_t64">
					<h2 class="top_h2 bo_color2">쇼핑박스</h2>
					<p class="top_p bo_color2">원하는 상품을 사이트 구별없이 검색하고 가격비교 할 수 있습니다.</p>
				</div>
				<div id="sb_content" class="mg_t16 f_c">
					<?php foreach ($prdt as $list) :?>
					<div class="imglist_div grid grid_432">
						<div class="imglist_img img_center">
							<div class="img_center_inner">
								<a href="<?=$adr_ctr ?>Shoppingbox/detail?idx=<?=$list->idx?>"><img src="<?=$list->img?>"></a>
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
								￦<?=$list->fPrice?>
							</div>
						</div>
					</div>
					<?php endforeach;?>
				</div>
			</div>
		</div>
	</div>
	
	<div id="footer">
	<?php include ("footer.php");?>
	</div>
	
</div>

</body>
</html>