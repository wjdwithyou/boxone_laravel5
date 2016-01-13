<?php if (count($reward)) :?>
	<?php foreach($reward as $target) :?>	
		<div id="rw_result_top_wrap">
			<div id="rw_result_top">
				<?= $target[0]->target_site?>
			</div>
		</div>
		<!-- 리워드 사이트 -->
		<?php foreach($target as $rewardList) :?>
			<div class="rw_result_div_wrap">
				<div class="rw_result_div">
					<div class="rw_site_img">
						<a onclick="window.open('<?= $rewardList->target_link?>');"><img src="<?= $adr_img ?>site/<?= $rewardList->idx?>.png"></a>
					</div>
					<div class="rw_site_desc">
						<div class="rw_site_name">
							<span class="site_name_kr"><?= $rewardList->name?></span>&nbsp;(<span class="site_name_en"><?= $rewardList->name_eng?></span>)
						</div>
						<div class="rw_site_reward">
							<span class="reward_percent"><?= $rewardList->reward_rate?></span> 리워드
						</div>
					</div>
				</div>
			</div>
		<?php endforeach;?>
		<div class="clear_both"></div>
	<?php endforeach;?>
<?php else :?>
	<div id="rw_result_top_wrap">
		<div id="rw_result_top" style="text-align:center; background-color:#DDDDDD;">
			검색된 결과가 없습니다!! 다시!! 입력해주세요!!
		</div>
	</div>
<?php endif;?>