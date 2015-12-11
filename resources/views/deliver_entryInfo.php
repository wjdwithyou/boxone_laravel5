		<div>
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
	  		<button type="button" class="deliver_info_button">
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