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
				<div id="option_btn_wrap">
					<button type="button" id="mycommunity_btn" onclick="location.href='<?=$adr_ctr?>Community/my'">MY커뮤니티</button>
				</div>
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
									<option selected="selected"><?=$list->name?></option>
								<?php else :?>
									<option><?=$list->name?></option>
								<?php endif; 
						};?>
					</select>
				</div>
				<div id="top_btnset" class="f_r">
					<?php if ($pageType == 1) :?>
					<button type="button" id="cm_page_type_button" class="bo_btn" onclick="changePageType();" value="1">
						앨범형
					</button>
					<?php else :?>
					<button type="button" id="cm_page_type_button" class="bo_btn" onclick="changePageType();" value="0">
						게시판형
					</button>
					<?php endif;?>
					<button type="button" class="bo_btn" onclick='commWrite();'>
						글쓰기
					</button>
				</div>
			</div>

			<div id="cm_cate_wrap" class="cl_b">
				<?php if ($cate == '전체') :?>
					<?php foreach($cateS as $list) :?>
						<div class="cm_cate col-xs-4 col-sm-2">
							<input type="checkbox" id="cm_cate_<?=$list->idx?>" name="cc" onclick="location.href = '<?=$adr_ctr?>Community/index?cate=<?=$list->name?>'">
							<label for="cm_cate_<?=$list->idx?>"><span></span><?=$list->name?></label>
						</div>
					<?php endforeach;?>
				<?php else :?>
					<?php foreach($cateS as $list) :?>
						<div class="cm_cate col-xs-4 col-sm-2">
							<?php if ($list->chk) :?>
								<input type="checkbox" id="cm_cate_<?=$list->idx?>" name="cc" value="<?=$list->idx?>" checked="checked" onclick="checkCate(1);">
							<?php else :?>
								<input type="checkbox" id="cm_cate_<?=$list->idx?>" name="cc" value="<?=$list->idx?>" onclick="checkCate(1);">
							<?php endif;?>
							<label for="cm_cate_<?=$list->idx?>"><span></span><?=$list->name?></label>
						</div>
					<?php endforeach;?>
				<?php endif;?>
			</div>
			<div id="cm_contents">
				<input type="hidden" id="cm_target_page" value="<?=$targetPage?>"/>
			</div>
			
			<div id="cm_search_wrap" class="cl_b">
				<select id="cm_cate_select" class="form-control f_l cm_search">
					<option>전체</option>
					<option>제목</option>
					<option>제목+내용</option>
					<option>글쓴이</option>
				</select>
				<input type="text" id="cm_search_input" class="form-control f_l cm_search">
				<button type="button" id="cm_search_btn" class="f_l cm_search" onclick="">검색</button>
			</div>
		</div>

		<?php
		include ("footer.php");
		?>

		<style>
			#community_cate {
				width: 188px;
				height: 40px;
				border: 1px solid #F15A63 !important;
				color: #F15A63;
				background: #fff url('<?=$adr_img?>select_arrow_pink.png') no-repeat 90% center;
				text-indent: 0.01px;
				text-overflow: "";
				padding-left: 6px;
				-webkit-appearance: none;
				-moz-appearance: none;
				appearance: none;
			}
			input[type="checkbox"] + label span {
				display: inline-block;
				width: 19px;
				height: 19px;
				margin: -4px 4px 0 0;
				vertical-align: middle;
				background: url(<?=$adr_img?>bo_checkbox.png);
				background-size: contain;
				cursor: pointer;
			}
			input[type="checkbox"]:checked + label span {
				background: url(<?=$adr_img?>bo_checkbox_on.png);
				background-size: contain;
			}
			@media (max-width: 768px) {
				#community_cate {
					width: 130px;
					height: 30px;
					background: #fff url('<?=$adr_img?>select_arrow_pink.png') no-repeat 90% center;
					font-size: 10px;
				}
			}
		</style>
	</body>
</html>

