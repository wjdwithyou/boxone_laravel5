<div id="aside_expand_top" class="pd_b8 ta_c">
	<span class="fw_b font_16">최근 본 상품</span>
</div>
<div id="aside_expand_content" class="f_c">
	<?php for ($i = 0; $i < count($recentList); ++$i) :?>
		<?php foreach ($recentList[$i] as $j) :?>
		<div class="imglist_div aside_img_wrap grid_as">
			<div class="imglist_img img_center">
				<div class="delete_img font_16">
					<a onclick="deleteImg();"><i class="fa fa-times-circle bo_color2"></i></a>
				</div>
				<div class="img_center_inner">
					<?php if ($j->is_hotdeal == 1) :?>
					<a onclick='location.href="<?=$adr_ctr ?>Hotdeal/productDetail?idx=<?=$list->idx?>"'><img src="<?=$list->img?>"></a>
					<?php else :?>
					<a onclick='location.href="<?=$adr_ctr ?>Shoppingbox/detail?idx=<?=$list->idx?>"'><img src="<?=$list->img?>"></a>
					<?php endif;?>
				</div>
			</div>
			<div class="imglist_desc_wrap">
				<div class="imglist_desc1 ta_c t_o bo_color2">
					<?=$j->brand?>
				</div>
				<div class="imglist_desc2 ta_c t_o">
					<?=$j->name?>
				</div>
				<div class="imglist_desc3 ta_c t_o">
					<?=$j->fprice?>
				</div>
			</div>
		</div>
		<?php endforeach;?>
	<?php endfor;?>
</div>