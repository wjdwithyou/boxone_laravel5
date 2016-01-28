<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>

<link rel="stylesheet" href="<?=$adr_css?>mypage_common.css">
</head>

<body>
<input type="hidden" id="member_idx" value="<?=$result->idx?>"/>

<div id="wrap">
	<div id="header">
	<?php include ("header.php");?>
	</div>
	
	<div id="container">
		<div id="top">
			<h1 class="top_h1">마이페이지</h1>
			<hr class="top_hr">
			<p class="top_p bo_color2">전세계 모든 상품들을 클릭 한번에 내 입맛대로</p>
		</div>
		<div id="mypage_top">
			<div class="np_inner">
				<nav class="bo_colorw f_c mg_t32">
					<h1 id="mpt_tit" class="top_h1 ta_c bo_colorw pd_t16">마이페이지</h1>
					<div class="top_div1 f_l">
						<div class="top_div1_bl ta_c">
							<div>
								<span></span>
							</div>
							<div>
								<img src="<?=$adr_img?>info.png" class="br_50" width="80" height="80">
							</div>
							<p class="font_14 mg_t8"><?=$nickname?>님</p>
						</div>
					</div>
					<div class="top_div2 f_l ta_c" onclick="location.href = '<?=$adr_ctr?>Mypage/index'">
						<div><span class="mp_badge fw_b br_20">123</span></div>
						<div class="mpt_ico">
							<img src="<?=$adr_img?>mp_heart.png" class="mp_ico">
						</div>
						<p>찜한상품</p>
					</div>
					<div class="selected_mpdiv top_div2 f_l ta_c" onclick="location.href = '<?=$adr_ctr?>Mypage/dc'">
						<div><span class="mp_badge fw_b br_20">1</span></div>
						<div class="mpt_ico">
							<img src="<?=$adr_img?>mp_delivery.png" class="mp_ico">
						</div>
						<p>배송통관</p>
					</div>
					<div class="top_div2 f_l ta_c" onclick="location.href = '<?=$adr_ctr?>Mypage/info'">
						<div class="mpt_ico2">
							<img src="<?=$adr_img?>mp_info.png" class="mp_ico">
						</div>
						<p>내정보</p>
					</div>
				</nav>
			</div>
		</div>
		<div id="content">
			<div class="np_inner">
				<div class="f_c">
					<div class="f_r pd_lr8">
						<button type="button" class="mp_btn bo_btn5 br_25" onclick="">배송/통관등록</button>
					</div>
				</div>
				<div class="f_c">
					<div class="grid grid_211 pd_a8">
						<div class="cate_title_wrap">
							<hr class="cate_title_hr">
							<div class="cate_title br_25 f_b bo_color2"><span class="font_16">배송</span></div>
						</div>
						<ul class="dc_ul pd_a8">
							<li class="pd_tb16 f_c">
								<a class="f_c" onclick="toggleState($(this));">
									<div class="f_l">
										<div>상품명</div>
										<div class="bo_color7 td_ul mg_t8">배송중</div>
										<div>반입</div>
									</div>
									<div class="dc_ico f_r">
										<i class="fa fa-chevron-circle-down font_14 bo_color2"></i>
									</div>
								</a>
								<div class="dc_state_wrap mg_t8 pd_tb8" hidden>
									<div class="dc_state_top f_c">
										<div class="mg_lr8 f_r">
											<button type="button" class="mp_btn bo_btn5 br_25" onclick="">삭제</button>
										</div>
									</div>
									<div class="dc_state_content">
										<table class="deliver_table mg_t8 ta_c">
											<caption class="ta_c">배송추적</caption>
												<tbody><tr class="b_b">
												<td>2015-08-05</td>
												<td>서용산</td>
												<td>이천센터(으)로 출발</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>이천센터</td>
												<td>서용산에서 도착</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>이천센터</td>
												<td>서수원(으)로 출발</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>서수원</td>
												<td>서수원지점에 도착</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>북수원</td>
												<td>고객님께 물품을 배달 준비 중</td>
											</tr>
												<tr class="b_b">
												<td>2015-08-06 20:47</td>
												<td>북수원</td>
												<td>배달완료</td>
											</tr>
											</tbody></table>
									</div>
								</div>
							</li>
							<li class="pd_tb16 f_c">
								<a class="f_c" onclick="toggleState($(this));">
									<div class="f_l">
										<div>상품명</div>
										<div class="bo_color7 td_ul mg_t8">배송중</div>
										<div>반입</div>
									</div>
									<div class="dc_ico f_r">
										<i class="fa fa-chevron-circle-down font_14 bo_color2"></i>
									</div>
								</a>
								<div class="dc_state_wrap mg_t8 pd_tb8" hidden>
									<div class="dc_state_top f_c">
										<div class="mg_lr8 f_r">
											<button type="button" class="mp_btn bo_btn5 br_25" onclick="">삭제</button>
										</div>
									</div>
									<div class="dc_state_content">
										<table class="deliver_table mg_t8 ta_c">
											<caption class="ta_c">배송추적</caption>
												<tbody><tr class="b_b">
												<td>2015-08-05</td>
												<td>서용산</td>
												<td>이천센터(으)로 출발</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>이천센터</td>
												<td>서용산에서 도착</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>이천센터</td>
												<td>서수원(으)로 출발</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>서수원</td>
												<td>서수원지점에 도착</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>북수원</td>
												<td>고객님께 물품을 배달 준비 중</td>
											</tr>
												<tr class="b_b">
												<td>2015-08-06 20:47</td>
												<td>북수원</td>
												<td>배달완료</td>
											</tr>
											</tbody></table>
									</div>
								</div>
							</li>
							<li class="pd_tb16 f_c">
								<a class="f_c" onclick="toggleState($(this));">
									<div class="f_l">
										<div>상품명</div>
										<div class="bo_color7 td_ul mg_t8">배송중</div>
										<div>반입</div>
									</div>
									<div class="dc_ico f_r">
										<i class="fa fa-chevron-circle-down font_14 bo_color2"></i>
									</div>
								</a>
								<div class="dc_state_wrap mg_t8 pd_tb8" hidden>
									<div class="dc_state_top f_c">
										<div class="mg_lr8 f_r">
											<button type="button" class="mp_btn bo_btn5 br_25" onclick="">삭제</button>
										</div>
									</div>
									<div class="dc_state_content">
										<table class="deliver_table mg_t8 ta_c">
											<caption class="ta_c">배송추적</caption>
												<tbody><tr class="b_b">
												<td>2015-08-05</td>
												<td>서용산</td>
												<td>이천센터(으)로 출발</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>이천센터</td>
												<td>서용산에서 도착</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>이천센터</td>
												<td>서수원(으)로 출발</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>서수원</td>
												<td>서수원지점에 도착</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>북수원</td>
												<td>고객님께 물품을 배달 준비 중</td>
											</tr>
												<tr class="b_b">
												<td>2015-08-06 20:47</td>
												<td>북수원</td>
												<td>배달완료</td>
											</tr>
											</tbody></table>
									</div>
								</div>
							</li>
							<li class="pd_tb16 f_c">
								<a class="f_c" onclick="toggleState($(this));">
									<div class="f_l">
										<div>상품명</div>
										<div class="bo_color7 td_ul mg_t8">배송중</div>
										<div>반입</div>
									</div>
									<div class="dc_ico f_r">
										<i class="fa fa-chevron-circle-down font_14 bo_color2"></i>
									</div>
								</a>
								<div class="dc_state_wrap mg_t8 pd_tb8" hidden>
									<div class="dc_state_top f_c">
										<div class="mg_lr8 f_r">
											<button type="button" class="mp_btn bo_btn5 br_25" onclick="">삭제</button>
										</div>
									</div>
									<div class="dc_state_content">
										<table class="deliver_table mg_t8 ta_c">
											<caption class="ta_c">배송추적</caption>
												<tbody><tr class="b_b">
												<td>2015-08-05</td>
												<td>서용산</td>
												<td>이천센터(으)로 출발</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>이천센터</td>
												<td>서용산에서 도착</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>이천센터</td>
												<td>서수원(으)로 출발</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>서수원</td>
												<td>서수원지점에 도착</td>
											</tr>
												<tr class="b_b">
												<td></td>
												<td>북수원</td>
												<td>고객님께 물품을 배달 준비 중</td>
											</tr>
												<tr class="b_b">
												<td>2015-08-06 20:47</td>
												<td>북수원</td>
												<td>배달완료</td>
											</tr>
											</tbody></table>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="grid grid_211 pd_a8">
						<div class="cate_title_wrap">
							<hr class="cate_title_hr">
							<div class="cate_title br_25 f_b bo_color2"><span class="font_16">통관</span></div>
						</div>
						<ul class="dc_ul pd_a8">
							<li class="pd_tb16 f_c">
								<a class="f_c" onclick="">
									<div class="f_l">
										<div>상품명</div>
										<div class="bo_color7 td_ul mg_t8">배송중</div>
										<div>반입</div>
									</div>
									<div class="dc_ico f_r">
										<i class="fa fa-chevron-circle-down bo_color7 font_14"></i>
									</div>
								</a>
							</li>
							<li class="pd_tb16 f_c">
								<a class="f_c" onclick="">
									<div class="f_l">
										<div>상품명</div>
										<div class="bo_color7 td_ul mg_t8">배송중</div>
										<div>반입</div>
									</div>
									<div class="dc_ico f_r">
										<i class="fa fa-chevron-circle-down bo_color7 font_14"></i>
									</div>
								</a>
							</li>
							<li class="pd_tb16 f_c">
								<a class="f_c" onclick="">
									<div class="f_l">
										<div>상품명</div>
										<div class="bo_color7 td_ul mg_t8">배송중</div>
										<div>반입</div>
									</div>
									<div class="dc_ico f_r">
										<i class="fa fa-chevron-circle-down bo_color7 font_14"></i>
									</div>
								</a>
							</li>
						</ul>
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