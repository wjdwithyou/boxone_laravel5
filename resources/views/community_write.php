<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php
		include ("libraries.php");
		?>

		<link href="<?=$adr_ctr ?>summernote/summernote.css" rel="stylesheet">
		<link href="<?=$adr_ctr ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<script src="<?=$adr_ctr ?>summernote/summernote.min.js"></script>
		<script src="<?=$adr_ctr ?>summernote/summernote-ko-KR.js"></script>
	</head>

	<body>
		<?php
		include ("header.php");
		?>

		<div id="container">
			<div id="top">
				<div id="top_title">
					커뮤니티
				</div>
				<div id="top_content">
					커뮤니티 커뮤니티 커뮤니티
				</div>
				<hr>
				<div id="current_cate">
					패션 잡화
				</div>
			</div>
			
			<div id="cmw_title_wrap">
				 <input type="text" class="form-control" id="cmw_title" placeholder="제목을 입력하세요">
			</div>

			<div id="cm_cate_wrap" class="cl_b">
				<?php for($i = 0 ; $i < count($cateS) ; $i++) :?>
					<div class="cm_cate col-xs-4 col-sm-2">
						<input type="checkbox" id="<?=$cateS[$i]->idx?>" name="cc" onclick="checkCate(1);">
						<label for="<?=$cateS[$i]->idx?>"><span></span><?=$cateS[$i]->name?></label>
					</div>
				<?php endfor;?>
			</div>
			
			<div id="cmw_content">
				<textarea id="summernote" name="content"></textarea>
			</div>
			
			<div id="cmw_btnset">
				<button type="button" class="bo_btn" onclick="">
					미리보기
				</button>
				<button type="button" class="bo_btn" onclick="">
					등록
				</button>
				<button type="button" class="bo_btn" onclick=''>
					취소
				</button>
			</div>
		</div>
		
		<style>
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
		</style>
		<?php
		include ("footer.php");
		?>
	</body>
</html>

