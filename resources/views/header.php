<?php
$need_login = "";
if (isset($_COOKIE['need_login'])) {
	$need_login = $_COOKIE['need_login'];
	setcookie("need_login", 1, time() - 1);
}
?>
<div class="inner">
	<div id="header_top_wrap" class="pc_header f_c">
		<nav class="f_l">
			<ul class="top_li_set li_set">
				<li><a onclick="toggleDialog(1, 'l', 22);">배송통관</a></li>
				<li><a onclick="toggleDialog(2, 'l', 91);">관세계산</a></li>
			</ul>
		</nav>
		<nav class="f_r">
			<ul class="top_li_set li_set">
				<?php if (!$logined): ?>
				<!-- 로그인 이전 헤더 -->
				<?php $sph = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]?>
				<li><a onclick="moveLogin('<?=$sph?>');">로그인</a></li>
				<span class="li_bar"></span>
				<li><a href="<?=$adr_ctr?>Login/join">회원가입</a></li>
				<!-- //로그인 이전 헤더 -->
				<?php else : ?>
				<!-- 로그인 후 헤더 -->
				<li>
					<a href="<?=$adr_ctr?>Mypage/index">
						<img src="<?= $adr_img?>profile/<?=$img?>" id="header_profile" class="img_24 br_50">
						<span><?=$nickname?>님</span>
					</a>
				</li>
				<span class="li_bar"></span>
				<li><a onclick="logout();">로그아웃</a></li>
				<?php endif; ?>
				<!-- //로그인 후 헤더 -->
				<!-- <li>
					<a onclick="toggleDialog('r', 136);">
						<img src="<?= $adr_img?>header_top_alarm.png" class="header_top_ico img_14">
						<span class="bo_badge" style="margin-left: -8px;">0</span>
					</a>
				</li> -->
				<li>
					<a onclick="toggleDialog(3, 'r', 94);">
						<img src="<?= $adr_img?>header_top_love.png" class="header_top_ico img_14">
					</a>
				</li>
				<li>
					<a onclick="toggleDialog(4, 'r', 60);">
						<img src="<?= $adr_img?>header_top_bookmark.png" class="header_top_ico img_14">
					</a>
				</li>
				<li>
					<a onclick="toggleDialog(5, 'r', 25);">
						<img src="<?= $adr_img?>header_top_recently.png" class="header_top_ico img_14">
					</a>
				</li>
			</ul>
		</nav>
		<!-- dialog 팝업 -->
		<div id="bo_dialog" hidden>
			<div class="bo_dialog_arrow bo_dialog_arrow_1"></div>
			<div class="bo_dialog_arrow bo_dialog_arrow_2"></div>
			<div id="bo_dialog_content"></div>
		</div>
		<!-- //dialog 팝업-->
	</div>
</div>
<hr class="header_hr2 pc_header">
<div class="inner">
	<div id="header_main_wrap" class="f_c">
		<div id="header_main" class="f_c grid grid_311">
			<a class="mob_header f_l" onclick="location.href='<?= $adr_ctr ?>Sidemenu/index?bef='+location.href"><img src="<?= $adr_img ?>menu.png" class="mob_side_btn img_14"></a>
			<a class="mob_header f_r" onclick="toggleSearch();"><img src="<?= $adr_img ?>search_img_gray.png" class="mob_side_btn img_14"></a>
			<a id="bo_logo" onclick="location.href='<?= $adr_ctr ?>'"><img src="<?= $adr_img ?>header_logo.png"></a>
		</div>
		<div id="header_search" class="pc_header grid grid_311">
			<input type="text" id="integrated_search" class="bo_search1 br_25" placeholder="검색어를 입력해주세요.">
			<a onclick=""><img src="<?= $adr_img ?>search_img.png" class="img_14"></a>
		</div>
		<div class="pc_header grid grid_311">
		</div>
	</div>
	<nav id="main_menu_wrap" class="pc_header">
		<ul id="main_menu" class="li_set f_c">
			<li><a href="<?=$adr_ctr?>Bestranking/index">베스트랭킹</a></li>
			<span class="li_bar4"></span>
			<li id="main_menu0"><a href="<?=$adr_ctr?>Shoppingbox/index?cate=c">클리어런스</a></li>
			<li id="main_menu1" class="menu_hover"><a href="<?=$adr_ctr?>Shoppingbox/index?cate=l1">여성의류</a></li>
			<li id="main_menu2" class="menu_hover"><a href="<?=$adr_ctr?>Shoppingbox/index?cate=l2">남성의류</a></li>
			<li id="main_menu3" class="menu_hover"><a href="<?=$adr_ctr?>Shoppingbox/index?cate=l3">유아동</a></li>
			<li id="main_menu4" class="menu_hover"><a href="<?=$adr_ctr?>Shoppingbox/index?cate=l4">패션잡화</a></li>
			<li id="main_menu5" class="menu_hover"><a href="<?=$adr_ctr?>Shoppingbox/index?cate=l5">주방생활취미</a></li>
			<li id="main_menu6" class="menu_hover"><a href="<?=$adr_ctr?>Shoppingbox/index?cate=l6">디지털가전</a></li>
			<li id="main_menu7" class="menu_hover"><a href="<?=$adr_ctr?>Shoppingbox/index?cate=l7">뷰티헬스식품</a></li>
		</ul>
	</nav>
</div>
<hr class="header_hr">

<!-- 쇼핑박스 hover 메뉴 -->
<div id="hover_menu_wrap" class="menu_hover" hidden>
</div>
<!-- //쇼핑박스 hover 메뉴 -->

<?php include ("menu.php");?>