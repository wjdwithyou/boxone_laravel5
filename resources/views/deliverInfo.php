<?php if ($code == 0) :?>
<p class="popup_p mg_t16">조회 결과가 없습니다.</p>
<div class="input_div">
	<button type="button" class="bo_btn4 br_25" onclick="loadDialog('deliver');">뒤로</button>
</div>

<?php else : if ($code == 1) :?>
<input type="hidden" id="delivery_office_value" value="<?=$result['office']?>"/>
<input type="hidden" id="delivery_num_value" value="<?=$result['num']?>"/>
<input type="hidden" id="delivery_prdt_value" value="<?=$result['prdt']?>"/>
<p class="popup_p mg_t16">
	<?=$result['office']?> / <?=$result['num']?>로 조회한 결과입니다.
</p>
<ul class="info_box mg_t8">
	<li class="bo_color2">
		<?=$result['prdt']?>
	</li>
	<li class="bo_color3 pd_lr8">
		<?=$result['state']?>
	</li>
	<li class="pd_lr8">
		<?=$result['office']?>
	</li>
</ul>
<table>
	<caption>배송추적</caption>
	<?php foreach($result[0] as $list) :?>
	<tr class="b_b">
		<td>
		<?php if ($list['date'] != "") :?>
			<?=$list['date']?> <?=$list['time']?>
		<?php endif;?>
		</td>
		<td><?=$list['location']?></td>
		<td><?=$list['state']?></td>
	</tr>
	<?php endforeach;?>
</table>
<div class="btn_set2 input_div">
	<div class="grid grid_h">
		<button type="button" class="bo_btn3 br_25" onclick="loadDialog('deliver');">뒤로</button>
	</div>
	<div class="grid grid_h">
		<button type="button" class="bo_btn4 br_25" onclick="createDelivery();">배송통관 등록</button>
	</div>
</div>

<?php else : ?>
<input type="hidden" id="entry_num_value" value="<?=$result['hbl']?>"/>
<input type="hidden" id="entry_year_value" value="<?=$result['year']?>"/>
<p class="popup_p mg_t16">
	<?=$result['hbl']?>로 조회한 결과입니다.
</p>
<ul class="info_box mg_t8">
	<li class="bo_color2">
		화물관리번호 :<br><?=$result['hwaNum']?>
	</li>
	<li class="bo_color3 pd_lr8">
		<?=$result['state']?>
	</li>
</ul>
<table>
	<caption>통관조회</caption>
	<?php foreach($result[0] as $list) :?>
	<tr class="b_b">
		<td>
		<?php if ($list['date'] != "") :?>
			<?=$list['date']?> <?=$list['time']?>
		<?php endif;?>
		</td>
		<td><?=$list['state']?></td>
	</tr>
	<?php endforeach;?>
</table>
<div class="btn_set2 input_div">
	<div class="grid grid_h">
		<button type="button" class="bo_btn3 br_25" onclick="loadDialog('deliver');">뒤로</button>
	</div>
	<div class="grid grid_h">
		<button type="button" class="bo_btn4 br_25" onclick="createEntry();">배송통관 등록</button>
	</div>
</div>
<?php endif;?>	
<?php endif;?>