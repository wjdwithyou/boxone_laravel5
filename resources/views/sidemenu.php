<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>
</head>

<body>
<div id="wrap">
	<div id="container">
		<div>
			<div id="sm_content">
				<div class="m_inner">
					<nav class="pd_lr16 f_c">
						<div class="f_l">
							<ul class="sm_li_set li_set">
								<?php if (!$logined): ?>
								<!-- 로그인 이전 헤더 -->
								<li><a onclick="moveLogin();" class="bo_colorW">로그인</a></li>
								<span class="li_bar2"></span>
								<li><a href="<?=$adr_ctr?>Login/join" class="bo_colorW">회원가입</a></li>
								<!-- //로그인 이전 헤더 -->
								<?php else : ?>
								<!-- 로그인 후 헤더 -->
								<li>
									<a href="<?=$adr_ctr?>Mypage/index">
										<img src="<?= $adr_img?>profile/<?=$img?>" id="sm_profile" class="img_32 br_50">
										<span class="bo_colorW"><?=$nickname?> 님</span>
									</a>
								</li>
								<span class="li_bar2"></span>
								<li><a onclick="logout();" class="bo_colorW">로그아웃</a></li>
								<?php endif; ?>
							</ul>
						</div>
						<div class="f_r">
							<a href="<?=$bef?>"><img src="<?=$adr_img?>xW2.png" id="sm_quit_btn" class="img_13"></a>
						</div>
					</nav>
					<nav class="">
						<ul class="sm_li_set2 li_set f_c">
							<li><a onclick=""><img src="<?=$adr_img?>header_top_loveW.gif" class="img_24"><p class="mg_t8 bo_colorW font_11">찜한상품</p></a></li>
							<li><a onclick=""><img src="<?=$adr_img?>header_top_bookmarkW.gif" class="img_24"><p class="mg_t8 bo_colorW font_11">즐겨찾기</p></a></li>
							<li><a onclick=""><img src="<?=$adr_img?>header_top_recentlyW.gif" class="img_24"><p class="mg_t8 bo_colorW font_11">최근본상품</p></a></li>
							<li><a onclick=""><img src="<?=$adr_img?>header_calW.gif" class="img_24"><p class="mg_t8 bo_colorW font_11">관세계산</p></a></li>
							<li><a onclick=""><img src="<?=$adr_img?>header_top_truckW.gif" class="img_24"><p class="mg_t8 bo_colorW font_11">배송통관</p></a></li>
						</ul>
					</nav>
				</div>
			</div>
			<nav class="m_inner mg_t16">
				<ul>
					<li class="sm_menu_li1">
						<a href="<?=$adr_ctr?>Bestranking/index">베스트랭킹</a>
					</li>
					<li class="sm_menu_li1">
						<a href="<?=$adr_ctr?>Shoppingbox/index">쇼핑박스</a>
					</li>
					<li class="sm_menu_li2">
						<a onclick="collapseMenu($(this))">
							<span class="bo_color2">클리어런스</span>
						</a>
					</li>
					<li class="sm_menu_li2">
						<a onclick="collapseMenu($(this))">
							<span class="bo_color2">여성의류</span>
							<img src="<?=$adr_img?>collapse_p.png" class="sm_menu_arrow img_13">
						</a>
						<div id="sm_menu1" class="collapse_menu f_c" hidden></div>
					</li>
					<li class="sm_menu_li2">
						<a onclick="collapseMenu($(this))">
							<span class="bo_color2">남성의류</span>
							<img src="<?=$adr_img?>collapse_p.png" class="sm_menu_arrow img_13">
						</a>
						<div id="sm_menu2" class="collapse_menu f_c" hidden></div>
					</li>
					<li class="sm_menu_li2">
						<a onclick="collapseMenu($(this))">
							<span class="bo_color2">유아동</span>
							<img src="<?=$adr_img?>collapse_p.png" class="sm_menu_arrow img_13">
						</a>
						<div id="sm_menu3" class="collapse_menu f_c" hidden></div>
					</li>
					<li class="sm_menu_li2">
						<a onclick="collapseMenu($(this))">
							<span class="bo_color2">패션잡화</span>
							<img src="<?=$adr_img?>collapse_p.png" class="sm_menu_arrow img_13">
						</a>
						<div id="sm_menu4" class="collapse_menu f_c" hidden></div>
					</li>
					<li class="sm_menu_li2">
						<a onclick="collapseMenu($(this))">
							<span class="bo_color2">주방생활취미</span>
							<img src="<?=$adr_img?>collapse_p.png" class="sm_menu_arrow img_13">
						</a>
						<div id="sm_menu5" class="collapse_menu f_c" hidden></div>
					</li>
					<li class="sm_menu_li2">
						<a onclick="collapseMenu($(this))">
							<span class="bo_color2">디지털가전</span>
							<img src="<?=$adr_img?>collapse_p.png" class="sm_menu_arrow img_13">
						</a>
						<div id="sm_menu6" class="collapse_menu f_c" hidden></div>
					</li>
					<li class="sm_menu_li2">
						<a onclick="collapseMenu($(this))">
							<span class="bo_color2">뷰티헬스식품</span>
							<img src="<?=$adr_img?>collapse_p.png" class="sm_menu_arrow img_13">
						</a>
						<div id="sm_menu7" class="collapse_menu f_c" hidden></div>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</div>

<?php include ("menu.php");?>
</body>
</html>