<div id="aside_expand_top" class="pd_b8 ta_c">
	<span class="fw_b font_16">즐겨찾기</span>
</div>

<div id="aside_expand_content" class="f_c">
	<?php for ($i = 0; $i < count($bookmarkList); ++$i) :?>
		<?php foreach ($bookmarkList[$i] as $j) :?>
		<div class="imglist_div aside_img_wrap grid_as">
			<div class="imglist_img img_center">
				<div class="delete_img font_16">
					<a onclick="deleteBookmark(<?=$j->idx?>);"><i class="fa fa-times-circle bo_color2"></i></a>
				</div>
				<div class="img_center_inner">
					<a onclick="clickLink(<?=$j->idx?>, '<?=$j->website_link?>');"><img src="https://s3-ap-northeast-1.amazonaws.com/boxone-image/site/<?= $j->idx?>.png"></a>
				</div>
			</div>
			<div class="imglist_desc_wrap">
				<div class="imglist_desc1 ta_c t_o bo_color2">
					<?=$j->name_eng?>
				</div>
				<div class="imglist_desc2 ta_c t_o">
					<?=$j->name?>
				</div>
			</div>
		</div>
		<?php endforeach;?>
	<?php endfor;?>
</div>