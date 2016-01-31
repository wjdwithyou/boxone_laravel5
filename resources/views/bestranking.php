<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>
</head>

<body>
<div id="wrap">
	<div id="header">
	<?php include ("header.php");?>
	</div>
	
	<div id="container">
		<div id="top">
			<h1 class="top_h1">베스트랭킹</h1>
			<p class="top_p bo_color2">박스원이 알선한 이번주 해외직구 사이트 베스트 랭킹!</p>
			<hr class="top_hr">
			<h2 class="top_h2">
				
			</h2>
		</div>
		<div id="content">
			<div class="inner">
				<div id="select_wrap" class="f_c">
					<div>
						<select id="select_cate" class="bo_selectbox bo_selectbox_2" onchange="">
							<option value="0&char=1">탑 브랜드</option>
							<?php foreach ($cate as $cateList) :?>
							<option value="<?=$cateList->idx?>"><?= $cateList->name?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
			</div>
			<ul class="imglist_wrap li_set f_c">
				<?php for($i = 0 ; $i < count($upper) ; $i++) :?>
				<?php if ($i == 0) :?>
				<li class="brlist_div grid grid_512">
				<?php else :?>
				<li class="brlist_div grid grid_532">
				<?php endif;?>
					<div class="inner_box">
						<div class="brlist_top mg_t8">
							<p class="brlist_top_txt bo_color1"><strong>BEST <?= ($i+1)?></strong></p>
							<a onclick="clickBookmark($(this).children(), <?= $upper[$i]->idx?>);">
								<?php if ($upper[$i]->bookmark == 1) :?>
								<img src="<?= $adr_img ?>bookmark_on.png" class="br_bookmark img_14">
								<?php else :?>
								<img src="<?= $adr_img ?>bookmark.png" class="br_bookmark img_14">
								<?php endif;?>
							</a>
						</div>
						<div class="brlist_img img_center">
							<div class="img_center_inner">
								<a onclick="clickLink(<?= $upper[$i]->idx?>, '<?= $upper[$i]->website_link?>');"><img src="<?= $adr_img ?>site/<?= $upper[$i]->idx?>.png"></a>
							</div>
						</div>
						<div class="imglist_desc_wrap">
							<div class="imglist_desc1 ta_c pd_lr8 t_o bo_color2">
								<?= $upper[$i]->name_eng?>
							</div>
							<div class="imglist_desc2 ta_c pd_b8 pd_lr8 t_o">
								<div>
									<?= $upper[$i]->name?>
								</div>
							</div>
						</div>
					</div>
				</li>
				<?php endfor;?>
			</ul>
			<div class="inner">
				<div class="ta_c mg_t64">
					<h2 class="top_h2 bo_color2">더 많은 사이트를 알고 싶어요!</h2>
				</div>
				<nav id="br_site_atoz">
					<a onclick="sortByChar(<?= $nowCate?>, 2);">A - E</a>
					<a onclick="sortByChar(<?= $nowCate?>, 3);">F - L</a>
					<a onclick="sortByChar(<?= $nowCate?>, 4);">M - S</a>
					<a onclick="sortByChar(<?= $nowCate?>, 5);">T - Z</a>
					<a onclick="sortByChar(<?= $nowCate?>, 1);">0 - 9</a>
				</nav>
				<hr class="sub_hr">
				<ul id="br_site_wrap" class="li_set mg_t16 f_c">
					<?php foreach ($lower as $charList) :?>
					<li class="br_site_li grid grid_532">
						<div class="br_site_img pd">
							<a onclick="clickLink(<?= $charList->idx?>, '<?= $charList->website_link?>');">
								<img src="<?= $adr_img ?>site/<?= $charList->idx?>.png">
							</a>
						</div>
						<div>
							<a onclick="clickBookmark($(this).children(), <?= $charList->idx?>);">
								<?php if ($charList->bookmark == 1) :?>
								<img src="<?= $adr_img ?>bookmark_on.png" class="br_bookmark img_14">
								<?php else :?>
								<img src="<?= $adr_img ?>bookmark.png" class="br_bookmark img_14">
								<?php endif;?>
							</a>
						</div>
						<div>
							<div class="imglist_desc1 ta_c pd_lr8 t_o bo_color2">
								<?= $charList->name_eng?>
							</div>
							<div class="imglist_desc2 ta_c pd_lr8 t_o">
								<?= $charList->name?>
							</div>
						</div>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
	</div>
	
	<div id="footer">
	<?php include ("footer.php");?>
	</div>
	
</div>

</body>
</html>