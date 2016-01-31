<?php
	$adr_ctr2 = "http://52.69.26.243/";
?>

<div id="aside_expand_top" class="pd_b8 ta_c">
	<span class="fw_b font_16">최근 본 상품</span>
</div>
<div id="aside_expand_content" class="f_c">
	<?php foreach ($recentlyList as $list) :?>
	<div class="imglist_div aside_img_wrap grid_as">
		<div class="imglist_img img_center">
			<div class="delete_img font_16">
				<a onclick="deleteImg();"><i class="fa fa-times-circle bo_color2"></i></a>
			</div>
			<div class="img_center_inner">
				<a href="<?=$adr_ctr2 ?>Shoppingbox/detail?idx=<?=$list->idx?>"><img src="<?=$list->img?>"></a>
			</div>
		</div>
		<div class="imglist_desc_wrap">
			<div class="imglist_desc1 ta_c t_o bo_color2">
				<?=$list[$i]->brand?>
			</div>
			<div class="imglist_desc2 ta_c t_o">
				<?=$list[$i]->name?>
			</div>
			<div class="imglist_desc3 ta_c t_o mg_t8">
				<?=$list[$i]->fPrice?>
			</div>
		</div>
	</div>
	<?php endforeach;?>
</div>