<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php
		include ("libraries.php");
		?>
	</head>

	<body>
		<?php
		include ("header.php");
		?>

		<div id="container" class="cl_b">
			<div id="top" class="cl_b">
				<div id="top_title">
					커뮤니티
				</div>
				<div id="top_content">
					커뮤니티 커뮤니티 커뮤니티
				</div>
				<hr>
				<div id="current_cate">
					패션잡화
				</div>
				<div id="top_select">
					<select id="community_cate" class="form-control">
						<?php if ($cate == '전체') :?>
							<option selected="selected">전체</option>
						<?php else :?>
							<option>전체</option>
						<?php endif;?>
						<?php foreach($cateL as $list){
								if ($cate == $list->name) :?>
									<option selected="selected"><?=$list->name?>
								<?php else :?>
									<option><?=$list->name?>
								<?php endif; 
						};?>
					</select>
				</div>
				<div id="top_btnset" class="f_r">
					<button type="button" id="cm_page_type_button" class="bo_btn" onclick="changePageType();" value="1">
						앨범형
					</button>
					<button type="button" class="bo_btn" onclick='location.href="<?=$adr_ctr ?>Community/write"'>
						글쓰기
					</button>
				</div>
			</div>

			<div id="cm_cate_wrap" class="cl_b">
				<?php for($i = 0 ; $i < count($cateS) ; $i++) :?>
					<div class="cm_cate col-xs-4 col-sm-2">
						<input type="checkbox" id="<?=$cateS[$i]->idx?>" name="cc" onclick="checkCate(1);">
						<label for="<?=$cateS[$i]->idx?>"><span></span><?=$cateS[$i]->name?></label>
					</div>
				<?php endfor;?>
				
			</div>
			<div id="cm_contents">
			</div>
		</div>

		<?php
		include ("footer.php");
		?>
	</body>
</html>

