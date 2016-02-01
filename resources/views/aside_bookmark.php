<div id="aside_expand_top" class="pd_b8 ta_c">
	<span class="fw_b font_16">즐겨찾기</span>
</div>
<div>
	<?php for ($i = 0; $i < count($pdList); ++$i) :?>
		<?php foreach ($pdList[$i] as $j) :?>
			<?=$j->idx?><br>
			<?=$j->img?><br>
			<?=$j->brand?><br>
			<?=$j->name?><br>
			<?=$j->price?><br>
		<?php endforeach;?>
		<br>
	<?php endfor;?>
</div>
<!--div id="aside_expand_content" class="f_c">
	<div class="imglist_div aside_img_wrap grid_as">
		<div class="imglist_img img_center">
			<div class="delete_img font_16">
				<a onclick="deleteImg();"><i class="fa fa-times-circle bo_color2"></i></a>
			</div>
			<div class="img_center_inner">
				<a onclick="clickLink(243, 'http://www.ahavaus.com/');"><img src="https://s3-ap-northeast-1.amazonaws.com/boxone-image/site/243.png"></a>
			</div>
		</div>
		<div class="imglist_desc_wrap">
			<div class="imglist_desc1 ta_c t_o bo_color2">
				AHAVA
			</div>
			<div class="imglist_desc2 ta_c t_o">
				아하바
			</div>
		</div>
	</div>
	<div class="imglist_div aside_img_wrap grid_as">
		<div class="imglist_img img_center">
			<div class="delete_img font_16">
				<a onclick="deleteImg();"><i class="fa fa-times-circle bo_color2"></i></a>
			</div>
			<div class="img_center_inner">
				<a onclick="clickLink(139, 'http://us.accessorize.com/');"><img src="https://s3-ap-northeast-1.amazonaws.com/boxone-image/site/139.png"></a>
			</div>
		</div>
		<div class="imglist_desc_wrap">
			<div class="imglist_desc1 ta_c t_o bo_color2">
				Accessorize
			</div>
			<div class="imglist_desc2 ta_c t_o">
				악세서라이즈
			</div>
		</div>
	</div>
	<div class="imglist_div aside_img_wrap grid_as">
		<div class="imglist_img img_center">
			<div class="delete_img font_16">
				<a onclick="deleteImg();"><i class="fa fa-times-circle bo_color2"></i></a>
			</div>
			<div class="img_center_inner">
				<a onclick="clickLink(391, 'https://www.amazon.com/');"><img src="https://s3-ap-northeast-1.amazonaws.com/boxone-image/site/391.png"></a>
			</div>
		</div>
		<div class="imglist_desc_wrap">
			<div class="imglist_desc1 ta_c t_o bo_color2">
				Amazon
			</div>
			<div class="imglist_desc2 ta_c t_o">
				아마존
			</div>
		</div>
	</div>
	<div class="imglist_div aside_img_wrap grid_as">
		<div class="imglist_img img_center">
			<div class="delete_img font_16">
				<a onclick="deleteImg();"><i class="fa fa-times-circle bo_color2"></i></a>
			</div>
			<div class="img_center_inner">
				<a onclick="clickLink(39, 'http://us.asos.com/?hrd=1');"><img src="https://s3-ap-northeast-1.amazonaws.com/boxone-image/site/39.png"></a>
			</div>
		</div>
		<div class="imglist_desc_wrap">
			<div class="imglist_desc1 ta_c t_o bo_color2">
				ASOS
			</div>
			<div class="imglist_desc2 ta_c t_o">
				아소스
			</div>
		</div>
	</div>
	<div class="imglist_div aside_img_wrap grid_as">
		<div class="imglist_img img_center">
			<div class="delete_img font_16">
				<a onclick="deleteImg();"><i class="fa fa-times-circle bo_color2"></i></a>
			</div>
			<div class="img_center_inner">
				<a onclick="clickLink(250, 'http://www.biotherm-usa.com/');"><img src="https://s3-ap-northeast-1.amazonaws.com/boxone-image/site/250.png"></a>
			</div>
		</div>
		<div class="imglist_desc_wrap">
			<div class="imglist_desc1 ta_c t_o bo_color2">
				Biotherm
			</div>
			<div class="imglist_desc2 ta_c t_o">
				비오템
			</div>
		</div>
	</div>
	<div class="imglist_div aside_img_wrap grid_as">
		<div class="imglist_img img_center">
			<div class="delete_img font_16">
				<a onclick="deleteImg();"><i class="fa fa-times-circle bo_color2"></i></a>
			</div>
			<div class="img_center_inner">
				<a onclick="clickLink(297, 'http://www.dyson.com/');"><img src="https://s3-ap-northeast-1.amazonaws.com/boxone-image/site/297.png"></a>
			</div>
		</div>
		<div class="imglist_desc_wrap">
			<div class="imglist_desc1 ta_c t_o bo_color2">
				Dyson
			</div>
			<div class="imglist_desc2 ta_c t_o">
				다이슨
			</div>
		</div>
	</div>
</div-->
