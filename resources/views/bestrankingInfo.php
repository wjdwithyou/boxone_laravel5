<?php foreach ($lower as $charList) :?>
	<div class="site_set col-xs-6 col-sm-4">
		<div class="site_img">
			<a onclick="location.href = '<?= $charList->website_link?>'"><img src="<?= $adr_img ?>site/<?= $charList->idx?>.png"></a>
		</div>
		<div class="site_name_set">
			<div class="site_bookmark">
				<a onclick=""><img src="<?= $adr_img ?>bookmark.png"></a>
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

