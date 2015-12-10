		<div>
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
	  		<button type="button" class="deliver_info_button">
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