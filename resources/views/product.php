<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php
		include ("libraries.php");
		?>
		<link  href="<?=$adr_ctr ?>fotorama/fotorama.css" rel="stylesheet">
		<script src="<?=$adr_ctr ?>fotorama/fotorama.js"></script>
	</head>

	<body>
		<?php
		include ("header.php");
		?>

		<div id="product_wrap">
			<div id="top">
				<div id="top_index" class="pd_lr8">
					<a href='<?=$adr_ctr?>Shoppingbox/index'>쇼핑박스</a>
					&nbsp;>&nbsp;
					<?php if ($cate->lidx == 'c') :?>
						<a onclick="getPrdt('c','',1);">클리어런스</a>
					<?php else :?>
						<a onclick="getPrdt('l<?=$cate->lidx?>','',1);"><?=$cate->lname?></a>
						&nbsp;>&nbsp;
						<a onclick="getPrdt('m<?=$cate->midx?>','',1);"><?=$cate->mname?></a>
						&nbsp;>&nbsp;
						<a onclick="getPrdt('s<?=$cate->sidx?>','',1);"><?=$cate->sname?></a>
					<?php endif;?>
				</div>
			</div>
			<div id="product_img_wrap" class="col-xs-12 col-sm-6 pd_lr8">
				<div class="fotorama" data-width="100%" data-height="500px" data-nav="thumbs" data-allowfullscreen="true">
					<?php foreach ($result['img'] as $imgList) :?>
						<a href="<?=$imgList?>"><img src="<?=$imgList?>"></a>
					<?php endforeach;?>
				</div>
			</div>
			<ul id="product_desc_wrap" class="col-xs-12 col-sm-6 pd_a8 mg_t32">
				<li class="bo_color font_14">
					<?=$result['brand']?>
				</li>
				<li class="pd_li li_underline f_b font_16">
					<?=$result['name']?>
				</li>
				<li class="pd_li2 font_14">
					<?=$result['mall']?>
				</li>
				<li class="pd_li cl_b">
					<div class="f_l f_b">
						가격
					</div>
					<div class="f_r">
						<?php if ($cate->lidx == 'c') :?>
							<span class="before_price bo_color">￦<?=$result['priceO']?></span>
						<?php endif;?>
						<span class="after_price f_b">￦<?=$result['price']?></span>
						<?php if ($cate->lidx == 'c') :?>
							<span class="after_price f_b">(<?=$result['saleP']?>% OFF)</span>
						<?php endif;?>
					</div>
				</li>
				<li class="pd_li li_underline cl_b">
					<div class="f_l f_b">
						배송비
					</div>
					<div class="f_r">
						￦14,000
					</div>
				</li>
				<li class="pd_li f_b">
					컬러
				</li>
				<li class="pd_li3 bo_color">
					<?php foreach($result['color'] as $colorList) :?>
						<span class="pd_color"><?=$colorList?></span>&nbsp;/&nbsp; 
					<?php endforeach;?>
				</li>
				<li class="pd_li cl_b">
					<div class="f_l f_b">
						사이즈
					</div>
					<div class="f_r">
						<button type="button" class="bo_btn6 pd_lr8 br_25">
							사이즈표
						</button>
					</div>
				</li>
				<li class="pd_li3 bo_color">
					<?php foreach($result['size'] as $sizeList) :?>
						<span class="pd_size"><?=$sizeList?></span>&nbsp;/&nbsp; 
					<?php endforeach;?>
				</li>
				<li class="pd_li4 li_underline">
					<div class="btn_set2 input_div pd_t24 f_c">
						<div class="grid grid_h">
							<button type="button" class="bo_btn1 br_25" onclick="">찜하기</button>
						</div>
						<div class="grid grid_h">
							<button type="button" class="bo_btn2 br_25" onclick="window.open('<?=$result['url']?>');">구매하기</button>
						</div>
					</div>
				</li>
			</ul>
			<div class="cl_b"></div>

			<div id="desc_nav_wrap">
				<a onclick="">상품정보</a>
				<a onclick="">가격비교</a>
				<a onclick="">상품후기</a>
			</div>

			<div id="info_wrap">
				<div class="info_title">
					상품정보
				</div>
				<div class="info_content">
					<?=$result['story']?>
				</div>
			</div>

			<div id="compare_wrap">
				<div class="info_title">
					가격비교
				</div>
				<div id="compare_div_wrap" class="cl_b">
					<!-- 가격 비교 -->
					<div class="compare_div col-xs-12 col-sm-6">
						<div class="compare_inner">
							<table class="compare_table">
								<tr>
									<td class="compare_site">ASOS</td>
									<td class="compare_price" colspan="2">￦49,800</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2">MJC Women's Rudolph Plush Pajama Pants</td>
								</tr>
								<tr>
									<td></td>
									<td class="bo_color">무료배송</td>
									<td class="review_btn">
										<button type="button" class="aaa br_25 bo_btn2" onclick="">구매하기</button>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="compare_div col-xs-12 col-sm-6">
						<div class="compare_inner">
							<table class="compare_table">
								<tr>
									<td class="compare_site">ASOS</td>
									<td class="compare_price" colspan="2">￦49,800</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2">MJC Women's Rudolph Plush Pajama Pants</td>
								</tr>
								<tr>
									<td></td>
									<td class="bo_color">무료배송</td>
									<td class="review_btn">
										<button type="button" class="aaa br_25 bo_btn2" onclick="">구매하기</button>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="compare_div col-xs-12 col-sm-6">
						<div class="compare_inner">
							<table class="compare_table">
								<tr>
									<td class="compare_site">ASOS</td>
									<td class="compare_price" colspan="2">￦49,800</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2">MJC Women's Rudolph Plush Pajama Pants</td>
								</tr>
								<tr>
									<td></td>
									<td class="bo_color">무료배송</td>
									<td class="review_btn">
										<button type="button" class="aaa br_25 bo_btn2" onclick="">구매하기</button>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="compare_div col-xs-12 col-sm-6">
						<div class="compare_inner">
							<table class="compare_table">
								<tr>
									<td class="compare_site">ASOS</td>
									<td class="compare_price" colspan="2">￦49,800</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2">MJC Women's Rudolph Plush Pajama Pants</td>
								</tr>
								<tr>
									<td></td>
									<td class="bo_color">무료배송</td>
									<td class="review_btn">
										<button type="button" class="aaa br_25 bo_btn2" onclick="">구매하기</button>
									</td>
								</tr>
							</table>
						</div>
					</div>s
					<?php foreach ($sameList as $list) :?>
					<div class="compare_div col-xs-12 col-sm-6">
						<div class="compare_inner">
							<table class="compare_table">
								<tr>
									<td class="compare_site"><?=$list->brand?></td>
									<td class="compare_price" colspan="2">￦<?=$list->fPrice?></td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"> <?=$list->name?> </td>
								</tr>
								<tr>
									<td></td>
									<td class="bo_color">무료배송</td>
									<td class="review_btn">
									<?php if ($list->ptype == 'p') :?>
									<button type="button" class="bo_btn3" onclick="location.href = '<?=$adr_ctr?>Shoppingbox/detail?idx=<?=$list->idx?>';">
									<?php else :?>
									<button type="button" class="bo_btn3" onclick="location.href = '<?=$adr_ctr?>Hotdeal/productDetail?idx=<?=$list->idx?>';">
									<?php endif;?>
										구매하기
									</button></td>
								</tr>
							</table>
						</div>
					</div>
					<!-- /가격 비교 -->
					<?php endforeach;?>
				</div>
			</div>

			<div id="suggest_wrap" class="cl_b">
				<div id="suggest_title">
					이런 상품 어떠세요?
				</div>
				<!-- 추천 상품 -->
				<?php foreach ($suggestList as $list) :?>
				<div class="imglist_div grid grid_532">
					<div class="imglist_img img_center">
						<div class="img_center_inner">
							<?php if ($list->ptype == 'p') :?>							
							<a onclick='location.href="<?=$adr_ctr ?>Shoppingbox/detail?idx=<?=$list->idx?>"'>
							<?php else :?>
							<a onclick='location.href="<?=$adr_ctr ?>Hotdeal/productDetail?idx=<?=$list->idx?>"'>
							<?php endif;?>
								<img src="<?=$list->img?>">
							</a>
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
				<!-- /추천 상품 -->
			</div>

			<div id="review_wrap" class="cl_b">
				<div class="info_title">
					상품후기
				</div>
				<div id="score_wrap" class="cl_b">
					<div class="score_div col-xs-4">
						<div class="score_title f_b">
							사용자 총평점
						</div>
						<div class="score">
							<span class="f_b bo_color2"><?php for ($i = 1 ; $i <= 5 ; $i++) if ($i <= $rate[0]) echo '★'; else echo '☆';?></span>
							&nbsp;
							<span class="rating f_b"><?=$rate[0]?></span>
							&nbsp;/&nbsp;
							<span class="total_rating bo_color"><?=$rate[2]?>건</span>
						</div>
					</div>
					<div class="score_div col-xs-4">
						<div class="score_title f_b">
							가장 많은 평점
						</div>
						<div class="score">
							<span class="f_b bo_color2"><?php for ($i = 1 ; $i <= 5 ; $i++) if ($i <= $rate[1][0]) echo '★'; else echo '☆';?></span>
							&nbsp;
							<span class="rating f_b"><?=$rate[1][0]?></span>
							&nbsp;|&nbsp;
							<span class="total_rating bo_color"><?=$rate[1][1]?>건</span>
						</div>
					</div>
					<div class="score_div col-xs-4">
						<div class="score_title f_b">
							전체 리뷰수
						</div>
						<div class="score">
							<span class="review_count bo_color2 f_b"><?=$rate[2]?>건</span>
						</div>
					</div>
				</div>
				<div id="review_google_wrap" class="info_content">
					<!-- 구글 후기 -->
					<?php foreach($reviewList as $list) :?>
					<ul class="review">
						<li class="cl_b">
							<div class="f_l">
								<span class="f_b bo_color2"><?php for ($i = 1 ; $i <= 5 ; $i++) if ($i <= $list->rating) echo '★'; else echo '☆';?></span>
								&nbsp;
								<span class="f_b"><?=$list->title?></span>
								&nbsp;|&nbsp;
								<span class="bo_color f_s12"><?=$list->writer_name?></span>
							</div>
							<div class="f_r f_s12 bo_color">
								<?=$list->upload?>
							</div>
						</li>
						<li class="review_content f_s12">
							<?=$list->contents?>
						</li>
						<li class="review_translate">
							<a onclick="">번역</a>
						</li>
					</ul>
					<?php endforeach;?>
					<!-- /구글 후기 -->
				</div>
			</div>
		</div>

		<?php
		include ("footer.php");
		?>
	</body>
</html>

