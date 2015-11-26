<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php include ("libraries.php"); ?>
	</head>

	<body>
		<div id="sidemenu_wrap">
			<div id="sidemenu_top" class="sidemenu_div">
				<div>
					<?php if ($logined) :?>
						<!-- 로그인 후 -->
						<img src="<?= $adr_img?>profile_image.png" id="profile_img">
	        			<span><?=$nickname?></span>
	        		<?php else :?>
	        			<!-- 로그인 전 -->
	        			<img src="<?= $adr_img?>profile_image.png" id="profile_img">
	        			<a onclick="login_popup();">로그인 해주세요</a>
	        		<?php endif;?>
				</div>			
	        	<a id="close_sidemenu" onclick='location.href = "<?=$bef?>"'>
	        		<img src="<?= $adr_img?>x.png">
	        	</a>
			</div>
			<div class="sidemenu_div">
				<div class="menuset col-xs-3" onclick="open_modal('#alarm_modal');">
					<img src="<?= $adr_img?>header_alarm.png">
					<br>
					<span>알림</span>
				</div>
				<div class="menuset col-xs-3" onclick="open_modal('#recently_modal');">
					<img src="<?= $adr_img?>header_recent.png">
					<br>
					<span>최근본상품</span>
				</div>
				<div class="menuset col-xs-3" onclick="open_modal('#bookmark_modal');">
					<img src="<?= $adr_img?>header_bookmark.png">
					<br>
					<span>즐겨찾기</span>
				</div>
				<div class="menuset col-xs-3" onclick="open_modal('#calculator_modal');">
					<img src="<?= $adr_img?>header_cal.png">
					<br>
					<span>관세 계산기</span>
				</div>
			</div>
			<div id="sidemenu_top2">
				<?php if ($logined) :?>
					<div id="mypage" class="sidemenu_hover col-xs-6" onclick="mypage_collapse();">
				<?php else:?>
					<div id="mypage" class="sidemenu_hover col-xs-6" onclick="login_popup();">
				<?php endif;?>
					<span>마이페이지</span>
				</div>
				<div id="shipping" class="sidemenu_hover col-xs-6" onclick="shipping_collapse();">
					<span>배송통관조회</span>
				</div>
			</div>
			<div id="mypage_wrap" hidden>
				<div class="sidemenu_div2 sidemenu_hover" onclick="">
					<span>알림관리</span>
				</div>
				<div class="sidemenu_div2 sidemenu_hover" onclick="">
					<span>배송/통관</span>
				</div>
				<div class="sidemenu_div2 sidemenu_hover" onclick="">
					<span>찜한 상품</span>
				</div>
				<div class="sidemenu_div2 sidemenu_hover" onclick="">
					<span>내정보관리</span>
				</div>
				<div class="sidemenu_div2 sidemenu_hover" onclick="logout();">
					<span>로그아웃</span>
				</div>
			</div>			
			<div id="shipping_wrap" hidden>
				<a onclick=""><img src="<?= $adr_img?>search_img_gray.png"></a>
				<input type="text" class="form-control" placeholder="Search for..." onclick="">
			</div>
			
			<div id="guide_menu" class="menu sidemenu_div sidemenu_hover" onclick="guide_collapse();">
				<span>쇼핑가이드</span>
			</div>
			<div id="guide_wrap" hidden>
				<div class="guide_submenu sidemenu_hover" onclick='location.href="<?=$adr_ctr?>Guide/index?no=1&det=1_1"'>직구 시작하기</div>
				<div class="guide_submenu sidemenu_hover" onclick='location.href="<?=$adr_ctr?>Guide/index?no=2&det=2_1"'>쇼핑몰 둘러보기</div>
				<div class="guide_submenu sidemenu_hover" onclick='location.href="<?=$adr_ctr?>Guide/index?no=3&det=3_1"'>배송대행 이용하기</div>
				<div class="guide_submenu sidemenu_hover" onclick='location.href="<?=$adr_ctr?>Guide/index?no=4&det=4_1"'>직구 꿀팁</div>
			</div>
			<div class="menu sidemenu_div sidemenu_hover" onclick="">				
				<span>리워드</span>
			</div>
			<div class="menu sidemenu_div sidemenu_hover" onclick="">				
				<span>카드혜택</span>
			</div>
			<div class="menu sidemenu_div sidemenu_hover" onclick="">				
				<span>핫딜</span>
			</div>
			<div class="menu sidemenu_div sidemenu_hover" onclick="">				
				<span>직거래박스</span>
			</div>
			<div class="menu sidemenu_div sidemenu_hover" onclick="">				
				<span>커뮤니티</span>
			</div>
			<div id="sb_menu" class="menu sidemenu_div sidemenu_hover" onclick="sb_collapse();">				
				<span>쇼핑박스</span>
				<span id="sb_collapse_arrow" class="glyphicon glyphicon-menu-down">
			</div>
			<div id="sb_wrap" hidden>
				<div class="col-xs-6 col-sm-3">
					<div class="sb_top">패션잡화</div>
					<hr>
					<div class="sb_cate">신발</div>
					<div class="sb_cate">가방</div>
					<div class="sb_cate">악세사리</div>
					<div class="sb_top">여성의류</div>
					<hr>
					<div class="sb_cate">아우터</div>
					<div class="sb_cate">상의</div>
					<div class="sb_cate">원피스/정장</div>
					<div class="sb_cate">하의</div>
					<div class="sb_cate">속옷</div>
					<div class="sb_cate">스포츠웨어</div>
					<div class="sb_cate">임부복</div>
				</div>
				<div class="col-xs-6 col-sm-3">
					<div class="sb_top">남성의류</div>
					<hr>
					<div class="sb_cate">아우터</div>
					<div class="sb_cate">상의</div>
					<div class="sb_cate">하의</div>
					<div class="sb_cate">속옷/기타</div>
					<div class="sb_cate">스포츠웨어</div>
					<div class="sb_cate">정장</div>
					<div class="sb_top">유아동</div>
					<hr>
					<div class="sb_cate">의류</div>
					<div class="sb_cate">완구/잡화</div>
					<div class="sb_cate">세면/위생용품</div>
					<div class="sb_cate">기타용품</div>
				</div>
				<div class="col-xs-6 col-sm-3">
					<div class="sb_top">주방·생활·취미</div>
					<hr>
					<div class="sb_cate">취미</div>
					<div class="sb_cate">생활용품</div>
					<div class="sb_cate">주방용품</div>
					<div class="sb_top">디지털·가전</div>
					<hr>
					<div class="sb_cate">휴대폰</div>
					<div class="sb_cate">카메라</div>
					<div class="sb_cate">PC/태블릿</div>
					<div class="sb_cate">음향기기</div>
					<div class="sb_cate">게임기</div>
					<div class="sb_cate">가전</div>
					<div class="sb_cate">자동차기기</div>
					<div class="sb_cate">기타</div>
				</div>
				<div class="col-xs-6 col-sm-3">
					<div class="sb_top">뷰티·헬스·식품</div>
					<hr>
					<div class="sb_cate">뷰티</div>
					<div class="sb_cate">헬스</div>
					<div class="sb_cate">식품</div>
				</div>
				<div class="clear_both"></div>
				<div class="cos-xs-12">
					<div id="sp_txt">스페셜 딜 브랜드</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<a>
						<div class="embed-responsive embed-responsive-4by3">
							<img class="embed-responsive-item" src="<?=$adr_img?>main_image_1.jpg">
						</div>
						<div class="sp_desc_wrap">
							<div class="sp_desc_head">
								Heading
							</div>
							<div class="sp_desc_content">
								Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</div>
						</div>
					</a>
				</div>
				<div class="col-xs-12 col-sm-6">
					<a>
						<div class="embed-responsive embed-responsive-4by3">
							<img class="embed-responsive-item" src="<?=$adr_img?>main_image_2.jpg">
						</div>
						<div class="sp_desc_wrap">
							<div class="sp_desc_head">
								Heading
							</div>
							<div class="sp_desc_content">
								Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</div>
						</div>
					</a>
				</div>
				<div class="clear_both"></div>
			</div>
		</div>
		
		<!-- 알림 팝업 -->
		<div id="alarm_modal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">알림</h4>
					</div>
					<div class="modal-body"></div>
				</div>
			</div>
		</div>
		
		<!-- 최근 본 상품 팝업 -->
		<div id="recently_modal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">최근 본 상품</h4>
					</div>
					<div class="modal-body"></div>
				</div>
			</div>
		</div>
		
		<!-- 즐겨찾기 팝업 -->
		<div id="bookmark_modal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">즐겨찾기</h4>
					</div>
					<div class="modal-body"></div>
				</div>
			</div>
		</div>
		
		<!-- 계산기 팝업 -->
		<div id="calculator_modal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">관세 계산기</h4>
					</div>
					<div class="modal-body">
						<?php include ("calculator.php"); ?>
					</div>
				</div>
			</div>
		</div>
		<?php include ("login.php");?>
	</body>		
</html>

