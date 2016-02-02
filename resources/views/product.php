<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>
<link  href="<?=$adr_ctr ?>fotorama/fotorama.css" rel="stylesheet">
<script src="<?=$adr_ctr ?>fotorama/fotorama.js"></script>
</head>

<body>
<div id="wrap">
	<div id="header">
	<?php include ("header.php");?>
	</div>
	
	<div id="container">
		<div id="top" class="inner">
			<nav id="top_index" class="pd_lr8 ta_l">
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
			</nav>
		</div>
		<div id="content">
			<div class="inner">
				<div class="f_c">
					<div id="pd_img" class="grid grid_211">
						<div class="fotorama" data-width="100%" data-height="442px" data-nav="thumbs" data-allowfullscreen="true">
							<?php foreach ($result['img'] as $imgList) :?>
							<a href="<?=$imgList?>"><img src="<?=$imgList?>"></a>
							<?php endforeach;?>
						</div>
					</div>
					<div id="pd_desc" class="grid grid_211">
						<table class="font_14">
							<tr>
								<td class="bo_color2" colspan="2"><?=$result['brand']?></td>
							</tr>
							<tr class="b_b2">
								<td class="fw_b font_16" colspan="2"><?=$result['name']?></td>
							</tr>
							<tr>
								<td class="bo_color1" colspan="2"><?=$result['mall']?></td>
							</tr>
							<tr>
								<td class="fw_b">가격</td>
								<td class="fw_b font_16">
									<?php if ($cate->lidx == 'c') :?>
										<strike class="bo_color2">￦<?=$result['priceO']?></strike>
									<?php endif;?>
									<span class="fw_b">￦<?=$result['price']?></span>
									<?php if ($cate->lidx == 'c') :?>
										<span class="bo_color1 fw_b">(<?=$result['saleP']?>% OFF)</span>
									<?php endif;?>
								</td>
							</tr>
							<tr class="b_b2">
								<td class="fw_b">배송비</td>
								<td>￦14,000</td>
							</tr>
							<tr>
								<td class="fw_b">컬러</td>
								<td class="bo_color2">
									<?php foreach($result['color'] as $colorList) :?>
										<?=$colorList?>&nbsp;/&nbsp; 
									<?php endforeach;?>
								</td>
							</tr>
							<tr>
								<td class="fw_b">사이즈</td>
								<td>
									<button type="button" class="bo_btn6 br_25 pd_lr8" onclick="">사이즈표</button>
								</td>
							</tr>
							<tr>
								<td class="ta_r" colspan="2">
									<select id="size_selectbox" class="bo_selectbox bo_selectbox_4" onchange="();">
									<?php foreach($result['size'] as $sizeList) :?>
										<option value="<?=$sizeList?>"><?=$sizeList?></option>
									<?php endforeach;?>
									</select>
								</td>
							</tr>
							<tr>
								<td class="ta_c font_24" colspan="2">
									<div class="btn_set2 input_div pd_t24 f_c">
										<div class="grid grid_h">
											<button type="button" class="pd_btn font_16 bo_btn1 br_25" onclick="prdtZZim(<?=$idx?>, <?=$is_hotdeal?>);"><i class="fa fa-heart-o"></i>&nbsp;찜하기</button>
										</div>
										<div class="grid grid_h">
											<button type="button" class="pd_btn font_16 bo_btn1 br_25" onclick="window.open('<?=$result['url']?>');">구매하기</button>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			
			<div class="np_inner">
				<div id="desc_nav_wrap" class="mg_t32 ta_c pd_tb16">
					<a onclick="">상품정보</a>
					<a onclick="">가격비교</a>
					<a onclick="">상품후기</a>
				</div>
					
				<div id="info_wrap" class="mg_t32">
					<div class="info_title ta_c fw_b pd_tb16">
						상품정보
					</div>
					<div class="mg_t16 pd_lr8">
						<?=$result['story']?>
					</div>
				</div>
				
				<div id="compare_wrap" class="mg_t32">
					<div class="info_title ta_c fw_b pd_tb16">
						가격비교
					</div>
					<div class="mg_t16 pd_lr8 f_c">
						<?php foreach ($sameList as $list) :?>
						<div class="pd_lr8 grid grid_221">
							<div class="compare_inner">
								<table class="compare_table">
									<tr>
										<td class="fw_b font_14"><?=$list->brand?></td>
										<td class="fw_b bo_color1 font_16" colspan="2">￦<?=$list->fPrice?></td>
									</tr>
									<tr>
										<td></td>
										<td class="pd_t8" colspan="2"><?=$list->name?></td>
									</tr>
									<tr>
										<td></td>
										<td class="bo_color2 pd_t16">무료배송</td>
										<td class="ta_r">
											<button type="button" class="compare_buy_btn br_25 bo_btn2" onclick="">구매하기</button>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<?php endforeach;?>
					</div>
				</div>
				
				<div id="suggest_wrap" class="mg_t32">
					<div class="bo_color1 ta_c fw_b">
						<i>이런 상품 어떠세요?</i>
					</div>
					<div class="f_c">
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
					</div>
				</div>
				
				<div id="review_wrap" class="mg_t32">
					<div class="info_title ta_c fw_b pd_tb16">
						상품후기
					</div>
					<div id="score_wrap" class="f_c">
						<div class="score_div grid grid_t">
							<div class="fw_b">
								사용자 총평점
							</div>
							<div class="mg_t8">
								<span class="fw_b bo_color2"><?php for ($i = 1 ; $i <= 5 ; $i++) if ($i <= $rate[0]) echo '★'; else echo '☆';?></span>
								&nbsp;
								<span class="fw_b"><?=$rate[0]?></span>
								&nbsp;/&nbsp;
								<span class="bo_color2"><?=$rate[2]?>건</span>
							</div>
						</div>
						<div class="score_div grid grid_t">
							<div class="fw_b">
								가장 많은 평점
							</div>
							<div class="mg_t8">
								<span class="f_b bo_color2"><?php for ($i = 1 ; $i <= 5 ; $i++) if ($i <= $rate[1][0]) echo '★'; else echo '☆';?></span>
								&nbsp;
								<span class="fw_b"><?=$rate[1][0]?></span>
								&nbsp;|&nbsp;
								<span class="bo_color2"><?=$rate[1][1]?>건</span>
							</div>
						</div>
						<div class="score_div grid grid_t">
							<div class="fw_b">
								전체 리뷰수
							</div>
							<div class="mg_t8">
								<span class="bo_color2 fw_b"><?=$rate[2]?>건</span>
							</div>
						</div>
					</div>
					
					<div id="review_google_wrap" class="info_content">
						<?php foreach($reviewList as $list) :?>
						<ul>
							<li class="f_c">
								<div class="f_l">
									<span class="fw_b bo_color2"><?php for ($i = 1 ; $i <= 5 ; $i++) if ($i <= $list->rating) echo '★'; else echo '☆';?></span>
									&nbsp;
									<span class="fw_b"><?=$list->title?></span>
									&nbsp;|&nbsp;
									<span class="bo_color2"><?=$list->writer_name?></span>
								</div>
								<div class="f_r bo_color2">
									<?=$list->upload?>
								</div>
							</li>
							<li>
								<?=$list->contents?>
							</li>
							<li>
								<a onclick="">번역</a>
							</li>
						</ul>
						<?php endforeach;?>
					</div>
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