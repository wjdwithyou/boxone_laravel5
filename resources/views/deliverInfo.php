	
	<?php if ($code == 0) :?>
		<div style="margin:10px 0;">
			<div style="font-size:14px; font-weight:bold; color:#f45a63; margin:10px 0;">
				조회 결과가 없습니다.
			</div>
			<button type="button" class="btn btn-default deliver_btn" onclick="delivery_popup();">재검색</button>
		</div>
	<?php else : if ($code == 1) :?>
		<div>
			<input type="hidden" id="delivery_office_value" value="<?=$result['office']?>"/>
			<input type="hidden" id="delivery_num_value" value="<?=$result['num']?>"/>
			<input type="hidden" id="delivery_prdt_value" value="<?=$result['prdt']?>"/>
			<span style="font-size:13px; color:#f45a63;">
				<?=$result['office']?> / <?=$result['num']?><br>
				 로 조회한 결과입니다.
			</span>
		</div>
	  	<div class="deliver_info">
  			<div class="deliver_info_title">
	  			<?=$result['prdt']?>
	  		</div>
	  		<div class="deliver_info_state">
	  			<?=$result['state']?>
	  		</div>
	  		<div class="deliver_info_office">
	  			<?=$result['office']?>
	  		</div>
	  		<button type="button" class="deliver_info_button" onclick="createDelivery();">
	  			배송통관등록
	  		</button>
	  	</div>
	  	<div class="deliver_detail">
	  		<div class="deliver_detail_title">
	  			배송추적
	  		</div>
	  		<div class="deliver_detail_content">
	  			<?php foreach($result[0] as $list) :?>
		  			<div class="deliver_detail_content_">
		  				<?php if ($list['date'] != "") :?>
		  					<span><?=$list['date']?> <?=$list['time']?><br></span>
		  				<?php endif;?>
		  				<span><?=$list['location']?></span>
		  				<span class="align_right"><?=$list['state']?></span>
		  			</div>
		  		<?php endforeach;?>
	  		</div>
	  	</div>
	<?php else : ?>
		<div>
			<input type="hidden" id="entry_num_value" value="<?=$result['hbl']?>"/>
			<input type="hidden" id="entry_year_value" value="<?=$result['year']?>"/>
			<span style="font-size:13px; color:#f45a63;">
				<?=$result['hbl']?> 로 조회한 결과입니다.
			</span>
		</div>
	  	<div class="deliver_info">
  			<div class="deliver_info_title">
	  			화물관리번호 :<br><?=$result['hwaNum']?>
	  		</div>
	  		<div class="deliver_info_state" style="width:auto;">
	  			<?=$result['state']?>
	  		</div>
	  		<button type="button" class="deliver_info_button" onclick="createEntry();">
	  			배송통관등록
	  		</button>
	  	</div>
	  	<div class="deliver_detail">
	  		<div class="deliver_detail_title">
	  			통관조회
	  		</div>
	  		<div class="deliver_detail_content">
	  			<?php foreach($result[0] as $list) :?>
		  			<div class="deliver_detail_content_">
		  				<span><?=$list['date']?> <?=$list['time']?></span>
		  				<span class="align_right"><?=$list['state']?></span>
		  			</div>
	  			<?php endforeach;?>
	  		</div>
	  	</div>
	<?php endif;?>
	<?php endif;?>	