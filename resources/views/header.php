<?php
$need_login = "";
if (isset($_COOKIE['need_login'])) {
	$need_login = $_COOKIE['need_login'];
	setcookie("need_login", 1, time() - 1);
}
?>
<div id="header_theme1">
	<div id="header_div1">
		<div class="inner">
			<div id="header_top_wrap" class="pc_header f_c">
				<nav class="f_l">
					<ul class="top_li_set li_set">
						<li><a class="header_t1" onclick="toggleDialog('deliver', 11);">배송통관</a></li>
						<span class="li_bar2"></span>
						<li><a class="header_t1" onclick="toggleDialog('calculator', 80);">관세계산</a></li>
					</ul>
				</nav>
				<nav class="f_r">
					<ul class="top_li_set li_set">
						<?php if (!$logined): ?>
						<!-- 로그인 이전 헤더 -->
						<li><a class="header_t1" onclick="moveLogin('<?=$page?>');">로그인</a></li>
						<span class="li_bar2"></span>
						<li><a class="header_t1" href="<?=$adr_ctr?>Login/join">회원가입</a></li>
						<?php else : ?>
						<li>
							<a href="<?=$adr_ctr?>Mypage/index">
								<img src="<?= $adr_img?>profile/<?=$img?>" id="header_profile" class="img_24 br_50">
								<span class="header_t1"><?=$nickname?>님</span>
							</a>
						</li>
						<span class="li_bar2"></span>
						<li><a class="header_t1" onclick="logout();">로그아웃</a></li>
						<?php endif; ?>
					</ul>
				</nav>
				<!-- dialog 팝업 -->
				<div id="bo_dialog" hidden>
					<div class="bo_dialog_arrow bo_dialog_arrow_1"></div>
					<div class="bo_dialog_arrow bo_dialog_arrow_2"></div>
					<div id="bo_dialog_content" class="f_c"></div>
				</div>
				<!-- //dialog 팝업-->
			</div>
		</div>
	</div>
	<hr class="header_hr1 pc_header">
	<div id="header_div2">
		<div class="inner">
			<div id="header_main_wrap" class="f_c">
				<div id="header_main" class="f_c grid grid_311">
					<a class="mob_header f_l" onclick="location.href='<?= $adr_ctr ?>Sidemenu/index?bef='+location.href"><img src="<?= $adr_img ?>menu.png" class="mob_side_btn img_14"></a>
					<a class="mob_header f_r" onclick="toggleSearch();"><img src="<?= $adr_img ?>search_img_gray.png" class="mob_side_btn img_14"></a>
					<a id="bo_logo" onclick="location.href='<?= $adr_ctr ?>'"><img src="<?= $adr_img ?>header_logo.gif" alt="boxone" title="boxone"></a>
				</div>
				<div id="header_search" class="pc_header grid grid_311">
					<input type="text" id="integrated_search" class="bo_search1 br_25" placeholder="검색어를 입력해주세요." <?php if (isset($search)) echo "value='$search'";?>>
					<a onclick=""><img src="<?= $adr_img ?>search_img.png" class="img_14"></a>
				</div>
				<div class="pc_header grid grid_311">
				</div>
			</div>
		</div>
	</div>
	<div id="header_div3">
		<div class="inner">
			<nav id="main_menu_wrap" class="pc_header">
				<ul id="main_menu" class="li_set f_c">
					<li><a class="header_t2" href="<?=$adr_ctr?>Bestranking/index">베스트랭킹</a></li>
					<li id="main_menu0"><a class="header_t2" href="<?=$adr_ctr?>Shoppingbox/index?cate=c">클리어런스</a></li>
					<li id="main_menu1" class="menu_hover"><a class="header_t2" href="<?=$adr_ctr?>Shoppingbox/index?cate=l1">여성의류</a></li>
					<li id="main_menu2" class="menu_hover"><a class="header_t2" href="<?=$adr_ctr?>Shoppingbox/index?cate=l2">남성의류</a></li>
					<li id="main_menu3" class="menu_hover"><a class="header_t2" href="<?=$adr_ctr?>Shoppingbox/index?cate=l3">유아동</a></li>
					<li id="main_menu4" class="menu_hover"><a class="header_t2" href="<?=$adr_ctr?>Shoppingbox/index?cate=l4">패션잡화</a></li>
					<li id="main_menu5" class="menu_hover"><a class="header_t2" href="<?=$adr_ctr?>Shoppingbox/index?cate=l5">주방생활취미</a></li>
					<li id="main_menu6" class="menu_hover"><a class="header_t2" href="<?=$adr_ctr?>Shoppingbox/index?cate=l6">디지털가전</a></li>
					<li id="main_menu7" class="menu_hover"><a class="header_t2" href="<?=$adr_ctr?>Shoppingbox/index?cate=l7">뷰티헬스식품</a></li>
				</ul>
			</nav>
		</div>
	</div>
	<hr class="header_hr2">
</div>

<aside id="aside_menu_wrap" class="f_c">
	<!-- <div id="aside_arrow" class="f_l">
		<a onclick="toggleAsidemenu();"><img src="<?=$adr_img?>left_arrow.png"></a>
	</div> -->
	<div id="aside_menu" class="f_l f_c">
		<div class="aside_div aside_div_3" onclick="moveMain();">
			<i class="fa fa-home bo_color2"></i>
		</div>
		<div class="aside_div" onclick="toggleExpand($(this), 1);">
			<i class="fa fa-star bo_color2"></i>
		</div>
		<div class="aside_div" onclick="location.href = '<?=$adr_ctr?>Mypage/index'">
			<i class="fa fa-heart bo_color2 sm_ico"></i>
		</div>
		<div class="aside_div" onclick="toggleExpand($(this), 2);">
			<div class="aside_badge"><span class="ico_badge fw_b br_20 bo_colorw font_10">1</span></div>
			<i class="fa fa-shopping-cart bo_color2"></i>
		</div>
		<div class="aside_div aside_div_2" onclick="moveTop();">
			<img src="<?=$adr_img?>arr_top.png" width="26" height="28" alt=""></i>
		</div>
		<div class="aside_div aside_div_4" onclick="moveTop();">
			<img src="<?=$adr_img?>arr_top_red.png" width="22" height="24" alt=""></i>
		</div>
	</div>
</aside>
<aside id="aside_expand" hidden>
	<div class="pd_a8">
		
	</div>
</aside>

<div id="mob_aside_bg"></div>

<!-- 쇼핑박스 hover 메뉴 -->
<div id="hover_menu_wrap" class="menu_hover" hidden>
</div>
<!-- //쇼핑박스 hover 메뉴 -->

<?php include ("menu.php");?>