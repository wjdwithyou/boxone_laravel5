<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>
</head>

<body>
<div id="wrap">
	<div id="container">
		<div id="sm_content" class="m_inner">
			<nav class="f_c">
				<div class="f_l">
					<ul class="li_set">
						<?php if ($logined): ?>
						<!-- 로그인 이전 헤더 -->
						<li><a onclick="moveLogin();">로그인</a></li>
						<span class="li_bar2"></span>
						<li><a href="<?=$adr_ctr?>Login/join">회원가입</a></li>
						<!-- //로그인 이전 헤더 -->
						<?php else : ?>
						<!-- 로그인 후 헤더 -->
						<li>
							<a href="<?=$adr_ctr?>Mypage/index">
								<img src="<?= $adr_img?>profile/default.png" id="sm_profile" class="img_32 br_50">
								<span>김용한 님</span>
							</a>
						</li>
						<span class="li_bar2"></span>
						<li><a onclick="logout();">로그아웃</a></li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="f_r">
					<a onclick=""><img src="<?=$adr_img?>x.png" id="sm_quit_btn"></a>
				</div>
			</nav>
			<nav class="sm_div">
				
			</nav>
			<nav>
				<ul>
					<li class="sm_div"></li>
					<li class="sm_div"></li>
					<li class="sm_div"></li>
					<li class="sm_div"></li>
					<li class="sm_div"></li>
					<li class="sm_div"></li>
					<li class="sm_div"></li>
					<li class="sm_div"></li>
					<li class="sm_div"></li>
				</ul>
			</nav>
	</div>
</div>
</body>
</html>