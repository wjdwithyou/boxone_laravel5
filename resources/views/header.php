<div id="header_wrap">
	<?php
		$need_login = "";
		if (isset($_COOKIE['need_login']))
		{
			$need_login = $_COOKIE['need_login'];
			setcookie("need_login",1,time()-1);
		}
	?>
	<input type="hidden" id="need_login" value="<?=$need_login?>"/>
	<div id="header">
		<a id="mobile_menu_btn" onclick='location.href = "<?= $adr_ctr?>Sidemenu/index?bef="+location.href'>
			<img src="<?= $adr_img?>menu.png" class="side_menu_btn"></span>
		</a>
		<a id="mobile_search_btn" data-toggle="collapse" href="#mobile_searchbar_wrap" aria-expanded="false">
			<img src="<?= $adr_img?>search_img_gray.png" class="side_menu_btn"></span>
		</a>
		<div id="header_logo" onclick='location.href = "<?= $adr_ctr?>"'>
			<img src="<?= $adr_img?>header_logo.png">
		</div>
		<div id="alarm_wrap">
			<div id="login_sign">
				<?php if (!$logined): ?>
				<!-- 로그인 이전 헤더 -->
				<div id="before_login">
					<ol class="breadcrumb">
						<li><a onclick="login_popup();">로그인</a></li>
						<li><a onclick="delivery_popup();">배송통관조회</a></li>
					</ol>
				</div>
				<?php else : ?>
				<!-- 로그인시 헤더 -->
				<div id="after_login">
					<div id="member_menu_wrap">
					    <div>
							<img src="<?= $adr_img?>profile_image.png">	
					        <a><?=$nickname?>님</a>
					    </div>
					    <div id="member_menu">
					        <div><a href="<?=$adr_ctr?>Mypage/index">마이페이지</a></div>
					        <div><a onclick="delivery_popup();">배송/통관 조회</a></div>
					        <div><a rel="external" onclick="logout();">로그아웃</a></div>
					    </div>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<div id="alarm_set">
				<div class="col-xs-3">
					<a onclick=""><img src="<?= $adr_img?>header_alarm.png"></a>
				</div>
				<div class="col-xs-3">
					<a onclick=""><img src="<?= $adr_img?>header_recent.png"></a>
				</div>
				<div class="col-xs-3">
					<a onclick=""><img src="<?= $adr_img?>header_bookmark.png"></a>
				</div>
				<div class="col-xs-3">
					<a onclick="cal_toggle();"><img src="<?= $adr_img?>header_cal.png" id="header_cal"></a>
				</div>
				<!-- 계산기 팝업 -->
				<div id="cal_popup" hidden>
					<div id="cal_title">
						관세 계산기
					</div>
					<?php include ("calculator.php"); ?>					
				</div>
				<div class="clear_both"></div>
			</div>
		</div>		
		
		<div id="searchbar_wrap">
			<a onclick=""><img src="<?= $adr_img?>search_img.png"></a>
			<input type="text" class="form-control" placeholder="Search for...">
		</div>
	</div>	

	<div id="mobile_searchbar_wrap" class="collapse">
		<div id="mobile_searchbar_txt">검색창</div>
		<div id="mobile_searchbar_input">
			<a onclick=""><img src="<?= $adr_img?>search_img_gray.png"></a>
			<input type="text" class="form-control" placeholder="Search for...">
		</div>
	</div>
</div>

<div id="main_menu_wrap">
	<div id="main_menu">
		<div id="shoppingbox_menu_wrap" class="menu_split">
			<div id="shoppingbox" onclick='location.href="<?=$adr_ctr?>Shoppingbox/index"'>쇼핑박스</div>
		    <div id="shoppingbox_menu">
		        <div class="col-xs-2">
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
				<div class="col-xs-2">
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
				<div class="col-xs-2">
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
				<div class="col-xs-2">
					<div class="sb_top">뷰티·헬스·식품</div>
					<hr>
					<div class="sb_cate">뷰티</div>
					<div class="sb_cate">헬스</div>
					<div class="sb_cate">식품</div>
				</div>
				<div id="sdb_wrap" class="col-xs-4">
					<div id="sp_txt">스페셜 딜 브랜드</div>
					<div class="sdb">
						<a>
							<div class="sdb_img">
								<img src="<?=$adr_img?>main_image_1.jpg">
							</div>
							<div class="sdb_title">
								Heading
							</div>
							<div class="sdb_content">
								Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.
							</div>
						</a>
					</div>
					<div class="sdb">
						<a>
							<div class="sdb_img">
								<img src="<?=$adr_img?>main_image_2.jpg">
							</div>
							<div class="sdb_title">
								Heading
							</div>
							<div class="sdb_content">
								Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.
							</div>
						</a>
					</div>
				</div>				
				<div class="clear_both"></div>
		    </div>
		</div>
		<div class="menu_split" onclick='location.href="<?=$adr_ctr?>Bestranking/index"'>베스트랭킹</div>
		<div class="menu_split" onclick='location.href="<?=$adr_ctr?>Reward/index"'>리워드</div>
		<div class="menu_split" onclick='location.href="<?=$adr_ctr?>Card/index"'>카드혜택</div>
		<div class="menu_split" onclick='location.href="<?=$adr_ctr?>Hotdeal/main"'>핫딜</div>
		<div class="menu_split">직거래박스</div>
		<div class="menu_split">커뮤니티</div>
		<div class="menu_split" onclick='location.href="<?=$adr_ctr?>Guide/index?no=1&det=1_1"'>해외쇼핑가이드</div>
		<div class="clear_both"></div>
	</div>
</div>

<style>
	.sb_top, #sp_txt {
		font-weight: bold;
		margin-top: 15px;
		color: #000;
		font-size: 14px;
		text-align: left;
	}
	.sb_cate {
		padding-bottom: 5px;
		color: #000;
		font-size: 13px;
		font-weight: normal;
		text-align: left;
	}
	.sb_top:hover, .sb_cate:hover {
		cursor: pointer;
		color: #f43497;
	}	
#shoppingbox_menu hr {
	margin-top: 10px;
	margin-bottom: 10px;
	border-top: 1px solid #000;
}
#sdb_wrap {
	height: 100%;
	border-left: 1px solid #ccc;
}
.sdb_img {
	margin-top: 10px;
}
.sdb_img img {
	width: 215px;
	height: 134px;
}
.sdb_title {	
    text-align: left;
    font-size: 13px;
}
.sdb_content {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 11px;
    font-weight: normal;
    text-align: left;
}
</style>

<?php include ("login.php"); ?>
<?php include ("deliver.php"); ?>
