<?php foreach ($lower as $charList) :?>
	<div class="site_set col-xs-6 col-sm-4">
		<div class="site_img">
			<a onclick="clickLink(<?= $charList->idx?>, '<?= $charList->website_link?>');"><img src="<?= $adr_img ?>site/<?= $charList->idx?>.png"></a>
		</div>
		<div class="site_name_set">
			<div class="site_bookmark">
				<a onclick="clickBookmark($(this).children(), <?= $charList->idx?>);">
					<?php if ($charList->bookmark == 1) :?>
						<img src="<?= $adr_img ?>bookmark_on.png">
					<?php else :?>
						<img src="<?= $adr_img ?>bookmark.png">
					<?php endif;?>
				</a>
			</div>
			<div class="site_name_en">
				<?= $charList->name_eng?>
			</div>
			<div class="site_name_kr">
				<?= $charList->name?>
			</div>
			<div class="clear_both"></div>
		</div>
	</div>
<?php endforeach;?>
<div class="clear_both"></div>

