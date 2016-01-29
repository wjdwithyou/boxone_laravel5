<?php if ($code == 0) :?>
<p class="popup_p">조회 결과가 없습니다.</p>
<div class="input_div pd_t24">
	<button type="button" class="bo_btn8 br_25" onclick="loadDialog('deliver');">뒤로</button>
</div>

<?php else : if ($code == 1) :?>
<input type="hidden" id="delivery_office_value" value="<?=$result['office']?>"/>
<input type="hidden" id="delivery_num_value" value="<?=$result['num']?>"/>
<input type="hidden" id="delivery_prdt_value" value="<?=$result['prdt']?>"/>
<input type="hidden" id="delivery_state_value" value="<?=$result['stateNum']?>"/>
<p class="popup_p">
	<?=$result['office']?> / <?=$result['num']?>로 조회한 결과입니다.
</p>
<ul class="info_box mg_t8">
	<li class="bo_colorw">
		<?=$result['prdt']?>
	</li>
	<li class="bo_color6 mg_t8">
		<?=$result['state']?>
	</li>
	<li class="bo_colorw">
		<?=$result['office']?>
	</li>
</ul>
<table class="deliver_table mg_t8 ta_c">
	<caption class="ta_c">배송추적</caption>
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
<div class="btn_set2 input_div pd_t24">
	<div class="grid grid_h">
		<button type="button" class="bo_btn8 br_25" onclick="loadDialog('deliver');">뒤로</button>
	</div>
	<div class="grid grid_h">
		<button type="button" class="bo_btn7 br_25" onclick="createDelivery();">배송통관 등록</button>
	</div>
</div>

<?php else : ?>
<input type="hidden" id="entry_num_value" value="<?=$result['hbl']?>"/>
<input type="hidden" id="entry_year_value" value="<?=$result['year']?>"/>
<input type="hidden" id="entry_state_value" value="<?=$result['stateNum']?>"/>
<p class="popup_p">
	<?=$result['hbl']?>로 조회한 결과입니다.
</p>
<ul class="info_box mg_t8">
	<li class="bo_colorw">
		화물관리번호 :<br><?=$result['hwaNum']?>
	</li>
	<li class="bo_color6 mg_t8">
		<?=$result['state']?>
	</li>
</ul>
<table class="deliver_table mg_t8 ta_c">
	<caption class="ta_c">통관조회</caption>
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
<div class="btn_set2 input_div pd_t24 f_c">
	<div class="grid grid_h">
		<button type="button" class="bo_btn8 br_25" onclick="loadDialog('deliver');">뒤로</button>
	</div>
	<div class="grid grid_h">
		<button type="button" class="bo_btn7 br_25" onclick="createEntry();">배송통관 등록</button>
	</div>
</div>
<?php endif;?>	
<?php endif;?>