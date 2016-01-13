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
				<!-- <li><a onclick="toggleDialog('l', 22);">배송통관조회</a></li> -->
				<li><a onclick="delivery_popup();">배송통관조회</a></li>
				<li><a onclick="toggleDialog('l', 91);">계산기</a></li>
			</ul>
		</nav>
		<nav class="f_r">
			<ul class="top_li_set li_set">
				<?php if (!$logined): ?>
				<!-- 로그인 이전 헤더 -->
				<li><a onclick="moveLogin();">로그인</a></li>
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
					<a onclick="toggleDialog('r', 94);">
						<img src="<?= $adr_img?>header_top_love.png" class="header_top_ico img_14">
					</a>
				</li>
				<li>
					<a onclick="toggleDialog('r', 60);">
						<img src="<?= $adr_img?>header_top_bookmark.png" class="header_top_ico img_14">
					</a>
				</li>
				<li>
					<a onclick="toggleDialog('r', 25);">
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
		<div id="header_main" class="f_c grid grid_310">
			<a class="mob_header f_l" onclick="location.href='<?= $adr_ctr ?>Sidemenu/index?bef='+location.href"><img src="<?= $adr_img ?>menu.png" class="mob_side_btn img_14"></a>
			<a class="mob_header f_r" onclick="toggleSearch();"><img src="<?= $adr_img ?>search_img_gray.png" class="mob_side_btn img_14"></a>
			<a id="bo_logo" onclick="location.href='<?= $adr_ctr ?>'"><img src="<?= $adr_img ?>header_logo.png"></a>
		</div>
		<div id="header_search" class="pc_header grid grid_310">
			<input type="text" id="integrated_search" class="bo_search1 br_25" placeholder="검색어를 입력해주세요.">
			<a onclick=""><img src="<?= $adr_img ?>search_img.png" class="img_14"></a>
		</div>
		<div class="pc_header grid grid_310">
		</div>
	</div>
	<nav id="main_menu_wrap" class="pc_header">
		<ul id="main_menu" class="li_set f_c">
			<li id="shoppingbox_menu" class="shoppingbox_hover"><a href="<?=$adr_ctr?>Shoppingbox/index">쇼핑박스</a></li>
			<li><a href="<?=$adr_ctr?>Bestranking/index">베스트랭킹</a></li>
			<li><a href="<?=$adr_ctr?>Reward/index">리워드</a></li>
			<li><a href="<?=$adr_ctr?>Card/index">카드혜택</a></li>
			<li><a href="<?=$adr_ctr?>Hotdeal/main">핫딜</a></li>
			<li><a href="<?=$adr_ctr?>Community/index">커뮤니티</a></li>
			<li><a href="<?=$adr_ctr?>Guide/index?no=1&det=1_1">해외쇼핑가이드</a></li>
		</ul>
	</nav>
</div>
<hr class="header_hr">

<!-- 쇼핑박스 hover 메뉴 -->
<div class="hover_menu shoppingbox_hover" hidden>
</div>
<!-- //쇼핑박스 hover 메뉴 -->
