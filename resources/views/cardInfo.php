
<input type="hidden" id="token_renew" value="<?php echo csrf_token();?>"/>
<div id="card_result">
	<div id="result_title">
		<span><?= $title?></span>
	</div>
	<div class="result_sub_title">
		<?= $search?>
	</div>
	<?php 
		if (count($result) != 0)
		{
			foreach ($result as $cardList): 
	?>
				<div class="result_content">
					<div class="col-xs-4">
						<img src="<?= $adr_img?>card/<?= $cardList->idx?>.png">
					</div>
					<div class="col-xs-8">
						<div class="card_desc">
							<div class="card_name"><?= $cardList->title?></div>
							<div class="card_title"><?= $cardList->support_site?></div>
							<div class="card_content">
								<?= $cardList->contents?> <br>
								연회비 : <?= $cardList->anual_fee?>
							</div>
						</div>
					</div>
					<div class="clear_both"></div>
				</div>
	<?php 
			endforeach;
		}
		else 
		{
	?>
			<div class="result_content" style="text-align:center; background-color:#DDDDDD;">
				겁색된 결과가 없습니다!! 다시!! 입력해주세요!!
			</div>
	<?php 
		}
	?>
</div>


