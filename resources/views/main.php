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
		<div id="main_slide">
			<div id="slide1" class="slide">
				<div class="slide_over">
					<h1 class="slide_h1 fw_b bo_colorw">박스원</h1>
					<h2 class="slide_h2 bo_colorw">해외직구 상품을 한자리에!</h2>
					<h2 class="slide_h2 bo_colorw">복잡한 회원가입 없이 간편하게 로그인하세요.</h2>
					<hr class="slide_hr">
					<button type="button" class="slide_btn bo_btnw" onclick='location.href="<?=$adr_ctr ?>Login/index"'>로그인</button>
				</div>
			</div>
			<div id="slide2" class="slide">
				<div class="slide_over">
					<h1 class="slide_h1 fw_b bo_colorw">박스원</h1>
					<h2 class="slide_h2 bo_colorw">해외직구 상품을 한자리에!</h2>
					<h2 class="slide_h2 bo_colorw">복잡한 회원가입 없이 간편하게 로그인하세요.</h2>
					<hr class="slide_hr">
					<button type="button" class="slide_btn bo_btnw" onclick='location.href="<?=$adr_ctr ?>Login/index"'>로그인</button>
				</div>
			</div>
			<div id="slide3" class="slide">
				<div class="slide_over">
					<h1 class="slide_h1 fw_b bo_colorw">박스원</h1>
					<h2 class="slide_h2 bo_colorw">해외직구 상품을 한자리에!</h2>
					<h2 class="slide_h2 bo_colorw">복잡한 회원가입 없이 간편하게 로그인하세요.</h2>
					<hr class="slide_hr">
					<button type="button" class="slide_btn bo_btnw" onclick='location.href="<?=$adr_ctr ?>Login/index"'>로그인</button>
				</div>
			</div>
		</div>
		<div id="content">
			<div id="br_wrap" class="inner">
				<div class="ta_c mg_t32">
					<h3 class="bo_color2">인기 쇼핑몰 랭킹</h3>
				</div>
				<div id="br_content" class="mg_t16">
					<div id="br_slide">
						<?php for ($i = 0 ; $i < count($siteList) ; $i++) :?>
							<div class="slide">
								<div class="imglist_div2">
									<div class="imglist_img img_center">
										<div class="img_center_inner">
											<a href="<?=$adr_ctr?>Bestranking/index?cate=<?=$i+1?>"><img src="<?=$adr_img?>site/<?=$siteList[$i]->idx?>.png"></a>
										</div>
									</div>
									<div class="imglist_desc_wrap ta_c">
										<div class="imglist_desc1 ta_c t_o bo_color1 font_10 br_20 br_border" onclick='location.href="<?=$adr_ctr?>Bestranking/index?cate=<?=$i+1?>"' style="cursor:pointer">
											<?=$siteList[$i]->cate_name?>
										</div>
										<div class="imglist_desc2 ta_c t_o">
											<a href="<?=$adr_ctr?>Bestranking/index?cate=<?=$i+1?>"><?=$siteList[$i]->name?></a>
										</div>
									</div>
								</div>
							</div>
						<?php endfor;?>
					</div>
				</div>
			</div>
			<div id="hd_wrap" class="mg_t32">
				<div class="inner">
					<div class="ta_c">
						<h3 class="bo_color2">핫한 상품</h3>
						<p class="top_p bo_color2">지금 뜨고 있는 상품들을 만나보세요.</p>
					</div>
					<div id="hd_content" class="mg_t16 f_c">
						<div id="hd_slide_wrap" class="grid grid_211">
							<div id="hd_slide_wrap_inner">
								<div id="hd_slide">
									<?php foreach ($hotBigList as $list) :?>
									<div class="slide">
										<div class="imglist_div2">
											<div class="imglist_img img_center">
												<div class="img_center_inner">
													<a href="<?=$adr_ctr?>Hotdeal/productDetail?idx=<?=$list->idx?>"><img src="<?=$list->img?>"></a>
												</div>
											</div>
											<div class="imglist_desc_wrap">
												<div class="imglist_desc1 ta_c t_o bo_color2">
													<?=$list->brand?>
												</div>
												<div class="imglist_desc2 ta_c t_o">
													<?=$list->name?>
												</div>
												<div class="bo_color1 ta_c fw_b mg_t8">
													<?=$list->saleP?>%
												</div>
												<div class="imglist_desc3 ta_c t_o">
													<strike class="bo_color2">￦<?=$list->fPriceO?></strike>&nbsp;￦<?=$list->fPriceS?>
												</div>
											</div>
										</div>
									</div>
									<?php endforeach;?>
								</div>
							</div>
						</div>
						<?php foreach ($hotList as $list) :?>
						<div class="imglist_div2 imglist_div3 grid grid_442">
							<div class="imglist_div_inner">
								<div class="imglist_img img_center">
									<div class="img_center_inner">
										<a href="<?=$adr_ctr?>Hotdeal/productDetail?idx=<?=$list->idx?>"><img src="<?=$list->img?>"></a>
									</div>
								</div>
								<div class="imglist_desc_wrap">
									<div class="imglist_desc1 ta_c t_o bo_color2">
										<?=$list->brand?>
									</div>
									<div class="imglist_desc2 ta_c t_o">
										<?=$list->name?>
									</div>
									<div class="bo_color1 ta_c fw_b mg_t8">
										<?=$list->saleP?>%
									</div>
									<div class="imglist_desc3 ta_c t_o">
										<strike class="bo_color2">￦<?=$list->fPriceO?></strike>&nbsp;￦<?=$list->fPriceS?>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
			<div class="inner">
				<div class="ta_c mg_t32">
					<h3 class="bo_color2">내게 딱 맞는 상품</h3>
				</div>
				<div id="sb_content" class="f_c"><?php $i=1 ?>
					<?php foreach ($prdtList as $list) :?>
						<div class="cate_title_wrap">
							<hr class="cate_title_hr">
							<div class="cate_title br_25 f_b bo_color2" onclick='location.href="<?=$adr_ctr?>/Shoppingbox/index?cate=l<?=$list['cateIdx']?>"' style="cursor:pointer"><?=$list['cateName']?></div>
						</div>
						<?php if(!isMobile()) :?>
						<div class="cate_slide">
							<?php for($i = 0 ; $i < count($list)-2 ; $i++) :?>
							<div class="slide">
								<div class="imglist_div">
									<div class="imglist_img img_center">
										<div class="img_center_inner">
											<a href="<?=$adr_ctr ?>Shoppingbox/detail?idx=<?=$list[$i]->idx?>"><img src="<?=$list[$i]->img?>"></a>
										</div>
									</div>
									<div class="imglist_desc_wrap">
										<div class="imglist_desc1 ta_c t_o bo_color2">
											<?=$list[$i]->brand?>
										</div>
										<div class="imglist_desc2 ta_c t_o">
											<?=$list[$i]->name?>
										</div>
										<div class="imglist_desc3 ta_c t_o mg_t8">
											￦<?=$list[$i]->fPrice?>
										</div>
									</div>
								</div>
							</div>
							<?php endfor;?>
						</div>
						<?php else :?>
						<div class="imglist_wrap ws_n ofx_a f_c">
							<?php for($i = 0 ; $i < count($list)-1 ; $i++) :?>
							<div class="imglist_div dp_ib grid_442">
								<div class="imglist_img img_center">
									<div class="img_center_inner">
										<a href="<?=$adr_ctr ?>Shoppingbox/detail?idx=<?=$list[$i]->idx?>"><img src="<?=$list[$i]->img?>"></a>
									</div>
								</div>
								<div class="imglist_desc_wrap">
									<div class="imglist_desc1 ta_c t_o bo_color2">
										<?=$list[$i]->brand?>
									</div>
									<div class="imglist_desc2 ta_c t_o">
										<?=$list[$i]->name?>
									</div>
									<div class="imglist_desc3 ta_c t_o mg_t8">
										￦<?=$list[$i]->fPrice?>
									</div>
								</div>
							</div>
							<?php endfor;?>
							<?php for($i = 0 ; $i < count($list)-1 ; $i++) :?>
							<div class="imglist_div dp_ib grid_442">
								<div class="imglist_img img_center">
									<div class="img_center_inner">
										<a href="<?=$adr_ctr ?>Shoppingbox/detail?idx=<?=$list[$i]->idx?>"><img src="<?=$list[$i]->img?>"></a>
									</div>
								</div>
								<div class="imglist_desc_wrap">
									<div class="imglist_desc1 ta_c t_o bo_color2">
										<?=$list[$i]->brand?>
									</div>
									<div class="imglist_desc2 ta_c t_o">
										<?=$list[$i]->name?>
									</div>
									<div class="imglist_desc3 ta_c t_o mg_t8">
										￦<?=$list[$i]->fPrice?>
									</div>
								</div>
							</div>
							<?php endfor;?>
							<?php for($i = 0 ; $i < count($list)-1 ; $i++) :?>
							<div class="imglist_div dp_ib grid_442">
								<div class="imglist_img img_center">
									<div class="img_center_inner">
										<a href="<?=$adr_ctr ?>Shoppingbox/detail?idx=<?=$list[$i]->idx?>"><img src="<?=$list[$i]->img?>"></a>
									</div>
								</div>
								<div class="imglist_desc_wrap">
									<div class="imglist_desc1 ta_c t_o bo_color2">
										<?=$list[$i]->brand?>
									</div>
									<div class="imglist_desc2 ta_c t_o">
										<?=$list[$i]->name?>
									</div>
									<div class="imglist_desc3 ta_c t_o mg_t8">
										￦<?=$list[$i]->fPrice?>
									</div>
								</div>
							</div>
							<?php endfor;?>
						</div>
						<?php endif;?>
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
