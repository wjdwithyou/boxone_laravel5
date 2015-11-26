<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php
		include ("libraries.php");
		?>
	</head>

	<body>
		<?php
		include ("header.php");
		?>
		
		<input type="hidden" id="no" value="<?=$no?>"/>
		
		<div id="current_menu" class="col=xs-12">
			해외쇼핑 가이드&nbsp;>&nbsp;
			<?php switch($no): 
				case 1: ?>
			<span>직구 시작하기</span>
			<?php break;?>
			<?php case 2: ?>
			<span>쇼핑몰 둘러보기</span>
			<?php break;?>
			<?php case 3: ?>
			<span>배송대행 이용하기</span>
			<?php break;?>
			<?php case 4: ?>
			<span>직구 꿀팁</span>
			<?php break;?>
			<?php default: ?>
			<span>직구 시작하기</span>
			<?php break;?>
			<?php endswitch;?>
		</div>
		
		<?php switch($no): 
			case 1: ?>
		<div id="guide_nav_wrap">
			<div class="submenu_grid" onclick='location.href="<?=$adr_ctr?>Guide/index?no=1&det=1_1"'>
				해외직구란?
			</div>
			<div class="submenu_grid" onclick="move_scroll(900);">
				구매대행/배송대행/직배송
			</div>
			<div class="submenu_grid" onclick='location.href="<?=$adr_ctr?>Guide/index?no=1&det=1_2"'>
				간편 직구용어
			</div>
			<div class="clear_both"></div>
		</div>
		<?php break;?>
		<?php case 2: ?>
		<div id="guide_nav_wrap">
			<div class="submenu_grid" onclick='location.href="<?=$adr_ctr?>Guide/index?no=2&det=2_1"'>
				회원가입하기
			</div>
			<div class="submenu_grid" onclick='location.href="<?=$adr_ctr?>Guide/index?no=2&det=2_2"'>
				상품 주문하기
			</div>
			<div class="submenu_grid" onclick='location.href="<?=$adr_ctr?>Guide/index?no=2&det=2_3"'>
				주문서 작성하기
			</div>
			<div class="clear_both"></div>
		</div>
		<?php break;?>
		<?php case 3: ?>
		<div id="guide_nav_wrap">
			<div class="submenu_grid half" onclick='location.href="<?=$adr_ctr?>Guide/index?no=3&det=3_1"'>
				배송대행과정
			</div>
			<div class="submenu_grid half" onclick='location.href="<?=$adr_ctr?>Guide/index?no=3&det=3_2"'>
				배대지 선택하기
			</div>
			<div class="clear_both"></div>
		</div>
		<?php break;?>		
		<?php default: ?>
		<div id="guide_nav_wrap">
			<div class="submenu_grid" onclick='location.href="<?=$adr_ctr?>Guide/index?no=1&det=1_1"'>
				해외직구란?
			</div>
			<div class="submenu_grid" onclick="move_scroll(900);">
				구매대행/배송대행/직배송
			</div>
			<div class="submenu_grid" onclick='location.href="<?=$adr_ctr?>Guide/index?no=1&det=1_2"'>
				간편 직구용어
			</div>
			<div class="clear_both"></div>
		</div>
		<?php break;?>
		<?php endswitch;?>
		
		<div id="guide_header_wrap">
		</div>
		
		<div id="guide_title_wrap">
			<div id="guide_title">
				<div id="common_title">해외 쇼핑 가이드</div>
				
				<div id="common_content">
					내게 맞는 직구 유형 알아보고 쉽게 직구하세요!
					<br>
					직구 상식부터 꿀팁까지 필요한 정보만 뽑아 보는 직구 가이드
				</div>
			</div>
			<div id="each_title">
				<div id="title">
					<?php switch($no): 
						case 1: ?>
					STEP.1 직구 시작하기
					<?php break;?>
					<?php case 2: ?>
					STEP.2 쇼핑몰 둘러보기
					<?php break;?>
					<?php case 3: ?>
					STEP.3 배송대행 이용하기
					<?php break;?>
					<?php case 4: ?>
					STEP.4 직구 꿀팁
					<?php break;?>
					<?php default: ?>
					STEP.1 직구 시작하기
					<?php break;?>
					<?php endswitch;?>
				</div>
			</div>
		</div>

		<div id="guide_wrap">
			<div id="static_menu_wrap">
				<div class="gm_top" onclick='location.href="<?=$adr_ctr?>Guide/index?no=1&det=1_1"'>직구 시작하기</div>
				<div class="gm_menu" onclick='location.href="<?=$adr_ctr?>Guide/index?no=1&det=1_1"'>해외직구란?</div>
				<div class="gm_menu" onclick="move_scroll(900);">구매대행/배송대행/직배송</div>
				<div class="gm_menu" onclick='location.href="<?=$adr_ctr?>Guide/index?no=1&det=1_2"'>간편 직구용어</div>
				<hr>
				<div class="gm_top" onclick='location.href="<?=$adr_ctr?>Guide/index?no=2&det=2_1"'>쇼핑몰 둘러보기</div>
				<div class="gm_menu" onclick='location.href="<?=$adr_ctr?>Guide/index?no=2&det=2_1"'>회원가입하기</div>
				<div class="gm_menu" onclick='location.href="<?=$adr_ctr?>Guide/index?no=2&det=2_2"'>상품 주문하기</div>
				<div class="gm_menu" onclick='location.href="<?=$adr_ctr?>Guide/index?no=2&det=2_3"'>주문서 작성하기</div>
				<hr>
				<div class="gm_top" onclick='location.href="<?=$adr_ctr?>Guide/index?no=3&det=3_1"'>배송대행 이용하기</div>
				<div class="gm_menu" onclick='location.href="<?=$adr_ctr?>Guide/index?no=3&det=3_1"'>배송대행 과정</div>
				<div class="gm_menu" onclick='location.href="<?=$adr_ctr?>Guide/index?no=3&det=3_2"'>배대지 선택하기</div>
				<hr>
				<div class="gm_top" onclick='location.href="<?=$adr_ctr?>Guide/index?no=4&det=4_1"'>직구 꿀팁</div>
			</div>

			<div id="guide_content" class="tab-content">
				<?php switch($det): 
					case '1_1': ?>
				<img src="<?=$adr_img?>guide1_1.jpg">
				<?php break;?>
				<?php case '1_2': ?>
				<img src="<?=$adr_img?>guide1_2.jpg">
				<?php break;?>
				<?php case '2_1': ?>
				<img src="<?=$adr_img?>guide2_1.jpg">
				<?php break;?>
				<?php case '2_2': ?>
				<img src="<?=$adr_img?>guide2_2.jpg">
				<?php break;?>
				<?php case '2_3': ?>
				<img src="<?=$adr_img?>guide2_3.jpg">
				<?php break;?>
				<?php case '3_1': ?>
				<img src="<?=$adr_img?>guide3_1.jpg">
				<?php break;?>
				<?php case '3_2': ?>
				<img src="<?=$adr_img?>guide3_2.jpg">
				<?php break;?>
				<?php case '4_1': ?>
				<img src="<?=$adr_img?>guide4_1.png">
				<?php break;?>
				<?php default: ?>
				<img src="<?=$adr_img?>guide1_1.jpg">
				<?php break;?>
				<?php endswitch;?>
			</div>
		</div>
		
		<?php
		include ("footer.php");
		?>
	</body>
</html>

