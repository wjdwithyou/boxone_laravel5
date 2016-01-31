<?php foreach ($lower as $charList) :?>
<li class="br_site_li grid grid_532">
	<div class="br_site_img">
		<a onclick="clickLink(<?= $charList->idx?>, '<?= $charList->website_link?>');">
			<img src="<?= $adr_img ?>site/<?= $charList->idx?>.png">
		</a>
	</div>
	<div class="site_bookmark">
		<a onclick="clickBookmark($(this).children(), <?= $charList-->idx?>);">
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
