			<input type="hidden" id="cm_page_type" value="<?=$page_type?>"/>
			
			<?php if ($page_type != 0) :?>
				<!-- 게시판형 -->
				<?php foreach($result as $list) :?>
				<div id="cm_board_wrap" class="cl_b">
					<table class="cm_board">
						<!-- 커뮤니티 글 -->
						<tr>
							<td class="cm_pc"><?= $list->idx?></td>
							<td class="cm_board_title"><a onclick="commContent(<?= $list->idx?>);"><?= $list->title?><span class="pc_reply">&nbsp;[<?=$list->replyCnt?>]</span></a></td>
							<td class="cm_pc"><?= $list->nickname?></td>
							<td class="cm_pc"><?= $list->upload?></td>
							<td class="cm_pc"><?= $list->hit_count?></td>
							<td class="cm_board_reply cm_mobile" rowspan="2">
								<div class="numberCircle"><?= $list->bookmark_count?></div>
							</td>
						</tr>
						<tr class="cm_mobile">
							<td class="cm_board_writer bo_color"><?= $list->nickname?>&nbsp;|&nbsp;<?= $list->upload?>&nbsp;|&nbsp;조회수&nbsp;<?= $list->hit_count?></td>
						</tr>
						<!-- /커뮤니티 글 -->
					</table>
				</div>
				<?php endforeach;?>
				<!-- /게시판형 -->
			<?php else :?>
				<!-- 앨범형 -->
				<?php foreach($result as $list) :?>
				<div class="hd_result_div_wrap cl_b">
					<div class="hd_result_div">
						<div class="hd_product_img center_box">
							<div class="center_content" onclick="commContent(<?= $list->idx?>);">
								<img src="<?=$adr_img?>community/<?=$list->image?>">
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								<?=$list->title?><span class="pc_reply">&nbsp;[<?=$list->replyCnt?>]</span>
							</div>
							<div class="album_writer bo_color">
									<?=$list->nickname?> | <?=$list->upload?> | <?=$list->hit_count?>
							</div>
							<div class="album_btnset cl_b">
								<img src="<?=$adr_img?>suki.png">
								<span class="album_count"><?=$list->bookmark_count?></span>
								&nbsp;
								<img src="<?=$adr_img?>reply.png">
								<span class="album_count"><?=$list->reply_number?></span>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach;?>
			
				<!-- /앨범형 -->
			<?php endif;?>
			
			<input type="hidden" id="cm_nowPage" value="<?=$paging['now']?>"/>
			<div class="pagination_wrap cl_b">
				<a onclick="checkCate(<?php echo ($paging['now'] - 1);?>);"><img src="<?=$adr_img?>left_arrow.png"></a>
				<div class="pagination">
					<?php if ($paging['now'] > 3) :?>
						<a onclick="checkCate(1);">1</a>
						<span>···</span>
						<!-- <a onclick="checkCate(<?php echo ($paging['now'] - 2);?>);"><?php echo ($paging['now'] - 2);?></a> -->
						<a onclick="checkCate(<?php echo ($paging['now'] - 1);?>);"><?php echo ($paging['now'] - 1);?></a>
					<?php else :?>
						<?php for($i = 1 ; $i < $paging['now'] ; $i++) :?>
							<a onclick="checkCate(<?=$i?>);"><?=$i?></a>
						<?php endfor;?>
					<?php endif;?>
					<a class="current_page"><?=$paging['now']?></a>
					<?php if ($paging['max'] - $paging['now'] > 3) :?>
						<a onclick="checkCate(<?php echo ($paging['now'] + 1);?>);"><?php echo ($paging['now'] + 1);?></a>
						<!-- <a onclick="checkCate(<?php echo ($paging['now'] + 2);?>);"><?php echo ($paging['now'] + 2);?></a> -->
						<span>···</span>
						<a onclick="checkCate(<?=$paging['max']?>);"><?=$paging['max']?></a>
					<?php else :?>
						<?php for($i = $paging['now'] + 1 ; $i < $paging['max'] + 1 ; $i++) :?>
							<a onclick="checkCate(<?=$i?>);"><?=$i?></a>
						<?php endfor;?>
					<?php endif;?>
				</div>
				<a onclick="checkCate(<?php echo ($paging['now'] + 1);?>);"><img src="<?=$adr_img?>right_arrow.png"></a>
			</div>
			
			
			
			