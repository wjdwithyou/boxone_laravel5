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
				<div id="top_index">
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
			<div id="product_img_wrap" class="col-xs-12 col-sm-6">
				<div class="fotorama" data-width="100%" data-height="500px" data-nav="thumbs" data-allowfullscreen="true">
					<?php foreach ($result['img'] as $imgList) :?>
						<a href="<?=$imgList?>"><img src="<?=$imgList?>"></a>
					<?php endforeach;?>
				</div>
			</div>
			<ul id="product_desc_wrap" class="col-xs-12 col-sm-6">
				<li class="bo_color">
					<?=$result['brand']?>
				</li>
				<li class="pd_li li_underline f_b">
					<?=$result['name']?>
				</li>
				<li class="pd_li2">
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
						<button type="button" class="bo_btn2">
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
					<button type="button" class="bo_btn f_b" onclick="window.open('<?=$result['url']?>');">
						구매하기
					</button>
				</li>
				<li class="pd_li">
					같은 가격의 쇼핑몰이 궁금하다면?
				</li>
				<li class="equal_price_wrap">
					<!-- 같은 가격 사이트 비교 -->
					<ul class="cl_b">
						<li>
							REVOLVE clothing
						</li>
						<li>
							<div class="f_l f_b">
								무료배송 면세
							</div>
							<div class="f_r">
								<button type="button" class="bo_btn3">
									구매하기
								</button>
							</div>
						</li>
					</ul>
					<!-- /같은 가격 사이트 비교 -->
					<ul class="cl_b">
						<li>
							REVOLVE clothing
						</li>
						<li>
							<div class="f_l f_b">
								무료배송 면세
							</div>
							<div class="f_r">
								<button type="button" class="bo_btn3">
									구매하기
								</button>
							</div>
						</li>
					</ul>
					<ul class="cl_b">
						<li>
							REVOLVE clothing
						</li>
						<li>
							<div class="f_l f_b">
								무료배송 면세
							</div>
							<div class="f_r">
								<button type="button" class="bo_btn3">
									구매하기
								</button>
							</div>
						</li>
					</ul>
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
									<td class="compare_site">amazon</td>
									<td class="compare_price" colspan="2">￦34,000</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"> Smathers & Branson®forJ.Crew card case forJ.Crew card case </td>
								</tr>
								<tr>
									<td></td>
									<td class="bo_color">무료배송</td>
									<td class="review_btn">
									<button type="button" class="bo_btn3">
										구매하기
									</button></td>
								</tr>
							</table>
						</div>
					</div>
					<!-- /가격 비교 -->
					<div class="compare_div col-xs-12 col-sm-6">
						<div class="compare_inner">
							<table class="compare_table">
								<tr>
									<td class="compare_site">amazon</td>
									<td class="compare_price" colspan="2">￦34,000</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"> Smathers & Branson®forJ.Crew card case forJ.Crew card case </td>
								</tr>
								<tr>
									<td></td>
									<td class="bo_color">무료배송</td>
									<td class="review_btn">
									<button type="button" class="bo_btn3">
										구매하기
									</button></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="compare_div col-xs-12 col-sm-6">
						<div class="compare_inner">
							<table class="compare_table">
								<tr>
									<td class="compare_site">amazon</td>
									<td class="compare_price" colspan="2">￦34,000</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"> Smathers & Branson®forJ.Crew card case forJ.Crew card case </td>
								</tr>
								<tr>
									<td></td>
									<td class="bo_color">무료배송</td>
									<td class="review_btn">
									<button type="button" class="bo_btn3">
										구매하기
									</button></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="compare_div col-xs-12 col-sm-6">
						<div class="compare_inner">
							<table class="compare_table">
								<tr>
									<td class="compare_site">amazon</td>
									<td class="compare_price" colspan="2">￦34,000</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"> Smathers & Branson®forJ.Crew card case forJ.Crew card case </td>
								</tr>
								<tr>
									<td></td>
									<td class="bo_color">무료배송</td>
									<td class="review_btn">
									<button type="button" class="bo_btn3">
										구매하기
									</button></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="compare_div col-xs-12 col-sm-6">
						<div class="compare_inner">
							<table class="compare_table">
								<tr>
									<td class="compare_site">amazon</td>
									<td class="compare_price" colspan="2">￦34,000</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"> Smathers & Branson®forJ.Crew card case forJ.Crew card case </td>
								</tr>
								<tr>
									<td></td>
									<td class="bo_color">무료배송</td>
									<td class="review_btn">
									<button type="button" class="bo_btn3">
										구매하기
									</button></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="compare_div col-xs-12 col-sm-6">
						<div class="compare_inner">
							<table class="compare_table">
								<tr>
									<td class="compare_site">amazon</td>
									<td class="compare_price" colspan="2">￦34,000</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"> Smathers & Branson®forJ.Crew card case forJ.Crew card case </td>
								</tr>
								<tr>
									<td></td>
									<td class="bo_color">무료배송</td>
									<td class="review_btn">
									<button type="button" class="bo_btn3">
										구매하기
									</button></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="compare_div col-xs-12 col-sm-6">
						<div class="compare_inner">
							<table class="compare_table">
								<tr>
									<td class="compare_site">amazon</td>
									<td class="compare_price" colspan="2">￦34,000</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"> Smathers & Branson®forJ.Crew card case forJ.Crew card case </td>
								</tr>
								<tr>
									<td></td>
									<td class="bo_color">무료배송</td>
									<td class="review_btn">
									<button type="button" class="bo_btn3">
										구매하기
									</button></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div id="suggest_wrap" class="cl_b">
				<div id="suggest_title">
					이런 상품 어떠세요?
				</div>
				<!-- 추천 상품 -->
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<!-- /추천 상품 -->
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
				<div class="product_div col-xs-6 col-sm-4 col-md-2">
					<div class="hd_product_img center_box">
						<div class="center_content">
							<a onclick='location.href="<?=$adr_ctr ?>Product/index"'><img src="<?= $adr_img ?>product_ex.jpg"></a>
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
							￦34,900
						</div>
					</div>
				</div>
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
							<span class="f_b bo_color2"><?php for ($i = 1 ; $i <= 5 ; $i++) if ($i < $rate[0]) echo '★'; else echo '☆';?></span>
							&nbsp;
							<span class="rating f_b"><?=$rate[0]?></span>
							&nbsp;/&nbsp;
							<span class="total_rating bo_color"><?=$rate[2]?></span>
						</div>
					</div>
					<div class="score_div col-xs-4">
						<div class="score_title f_b">
							가장 많은 평점
						</div>
						<div class="score">
							<span class="f_b bo_color2"><?php for ($i = 1 ; $i <= 5 ; $i++) if ($i < $rate[1][0]) echo '★'; else echo '☆';?></span>
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
								<span class="f_b bo_color2"><?php for ($i = 1 ; $i <= 5 ; $i++) if ($i < $list->rating) echo '★'; else echo '☆';?></span>
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
				
				<!-- 구글 후기 페이징 -->
				<div class="pagination_wrap cl_b">
					<a onclick=""><img src="<?= $adr_img ?>left_arrow.png"></a>
					<div class="pagination">
						<a class="current_page" onclick="">1</a>
						<a onclick="">2</a>
						<a onclick="">3</a>
						<span>···</span>
						<a onclick="">7</a>
					</div>
					<a onclick=""><img src="<?= $adr_img ?>right_arrow.png"></a>
				</div>
				<!-- /구글 후기 페이징 -->
				
				<div class="info_title remove_b_t">
					커뮤니티 후기
				</div>
				<div id="review_bo_wrap" class="info_content">
					<!-- 커뮤니티 후기 -->
					<ul class="review">
						<li class="cl_b">
							<div class="f_l">
								<span class="f_b bo_color2">★★★★☆</span>
								&nbsp;
								<span class="f_b">아이패드 에어2 역시 좋습니다</span>
								&nbsp;|&nbsp;
								<span class="bo_color f_s12">saemi park</span>
								&nbsp;|&nbsp;
								<span class="bo_color f_s12">G마켓에서 작성</span>
							</div>
							<div class="f_r f_s12 bo_color">
								APR 22, 2015
							</div>
						</li>
						<li class="review_content">
							우선 온라인을 통해서 처음으로 고가의 가전을 구입하게 되었습니다.
							하이마트나 이마트 등에 비해 5만원 가량 저렴합니다.

							걱정과는 다르게 뽁뽁이까지 싸져있어서 큰 이상은 없는 양품을 받은거 같아 기분이 좋네요
						</li>
					</ul>
					<!-- /커뮤니티 후기 -->
					<ul class="review">
						<li class="cl_b">
							<div class="f_l">
								<span class="f_b bo_color2">★★★★☆</span>
								&nbsp;
								<span class="f_b">아이패드 에어2 역시 좋습니다</span>
								&nbsp;|&nbsp;
								<span class="bo_color f_s12">saemi park</span>
								&nbsp;|&nbsp;
								<span class="bo_color f_s12">G마켓에서 작성</span>
							</div>
							<div class="f_r f_s12 bo_color">
								APR 22, 2015
							</div>
						</li>
						<li class="review_content">
							우선 온라인을 통해서 처음으로 고가의 가전을 구입하게 되었습니다.
							하이마트나 이마트 등에 비해 5만원 가량 저렴합니다.

							걱정과는 다르게 뽁뽁이까지 싸져있어서 큰 이상은 없는 양품을 받은거 같아 기분이 좋네요
						</li>
					</ul>
					<ul class="review">
						<li class="cl_b">
							<div class="f_l">
								<span class="f_b bo_color2">★★★★☆</span>
								&nbsp;
								<span class="f_b">아이패드 에어2 역시 좋습니다</span>
								&nbsp;|&nbsp;
								<span class="bo_color f_s12">saemi park</span>
								&nbsp;|&nbsp;
								<span class="bo_color f_s12">G마켓에서 작성</span>
							</div>
							<div class="f_r f_s12 bo_color">
								APR 22, 2015
							</div>
						</li>
						<li class="review_content">
							우선 온라인을 통해서 처음으로 고가의 가전을 구입하게 되었습니다.
							하이마트나 이마트 등에 비해 5만원 가량 저렴합니다.

							걱정과는 다르게 뽁뽁이까지 싸져있어서 큰 이상은 없는 양품을 받은거 같아 기분이 좋네요
						</li>
					</ul>
					<ul class="review">
						<li class="cl_b">
							<div class="f_l">
								<span class="f_b bo_color2">★★★★☆</span>
								&nbsp;
								<span class="f_b">아이패드 에어2 역시 좋습니다</span>
								&nbsp;|&nbsp;
								<span class="bo_color f_s12">saemi park</span>
								&nbsp;|&nbsp;
								<span class="bo_color f_s12">G마켓에서 작성</span>
							</div>
							<div class="f_r f_s12 bo_color">
								APR 22, 2015
							</div>
						</li>
						<li class="review_content">
							우선 온라인을 통해서 처음으로 고가의 가전을 구입하게 되었습니다.
							하이마트나 이마트 등에 비해 5만원 가량 저렴합니다.

							걱정과는 다르게 뽁뽁이까지 싸져있어서 큰 이상은 없는 양품을 받은거 같아 기분이 좋네요
						</li>
					</ul>
				</div>
				
				<!-- 커뮤니티 후기 페이징 -->
				<div class="pagination_wrap cl_b">
					<a onclick=""><img src="<?= $adr_img ?>left_arrow.png"></a>
					<div class="pagination">
						<a class="current_page" onclick="">1</a>
						<a onclick="">2</a>
						<a onclick="">3</a>
						<span>···</span>
						<a onclick="">7</a>
					</div>
					<a onclick=""><img src="<?= $adr_img ?>right_arrow.png"></a>
				</div>
				<!-- /커뮤니티 후기 페이징 -->
			</div>
		</div>

		<?php
		include ("footer.php");
		?>
	</body>
</html>

