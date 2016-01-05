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

		<?php if ($comm_idx != 0) :?>
			<input type="hidden" id="comm_idx" value="<?=$comm_idx?>"/>
		<?php endif;?>
		<div id="container" class="cl_b">
			<div id="top" class="cl_b">
				<!-- <div id="top_title">
					커뮤니티
				</div>
				<div id="top_content">
					커뮤니티 커뮤니티 커뮤니티
				</div>
				<hr>
				<div id="current_cate">
					패션 잡화
				</div> -->
				<div id="top_select">
					<select id="community_cate" class="form-control">
						<?php foreach($cateL as $list) :?>
						<option><?=$list -> name ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div id="cm_cate_wrap" class="cl_b">
				<?php foreach($cateS as $list) :?>
					<div class="cm_cate col-xs-4 col-sm-2">
						<a class="push_cate" onclick="stackCate(<?=$list -> idx ?>, '<?=$list -> name ?>');"><?=$list -> name ?></a>
					</div>
				<?php endforeach; ?>
			</div>
			
			<div id="stack_cate_wrap">
			</div>
			
			<div id="cmw_title_wrap">
				 <input type="text" class="form-control" id="cmw_title" placeholder="제목을 입력하세요">
			</div>
			
			<div id="cmw_content">
				<textarea id="summernote" name="content"></textarea>
			</div>
			
			<div id="cmw_btnset">
				<button type="button" class="bo_btn" onclick="lookAhead();">
					미리보기
				</button>
				<?php if ($comm_idx != 0) :?>
					<button type="button" class="bo_btn" onclick="commModify();">
						수정
					</button>
				<?php else :?>
					<button type="button" class="bo_btn" onclick="commWrite();">
						등록
					</button>
				<?php endif;?>
				<button type="button" class="bo_btn" onclick='history.go(-1);'>
					취소
				</button>
			</div>
		</div>
		
		<!-- 미리보기 팝업 -->
		<div class="modal fade" id="preview_modal" tabindex="-1" role="dialog">
			<div id="preview_dialog" class="modal-dialog" role="document">
				<div class="modal-content">
					<div id="preview_title" class="modal-header">
					</div>
					<div id="preview_content" class="modal-body">
					</div>
				</div>
			</div>
		</div>
		<!-- //미리보기 팝업 -->
		
		<style>
			#preview_modal {
				padding-right: 0 !important;
			}
			#preview_dialog {
				text-align: left;
			}
			#community_cate {
				width: 188px;
				height: 40px;
				border: 1px solid #F15A63 !important;
				color: #F15A63;
				background: #fff url('<?=$adr_img ?>select_arrow_pink.png') no-repeat 90% center;
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
				background: url(<?=$adr_img ?>bo_checkbox.png);
				background-size: contain;
				cursor: pointer;
			}
			input[type="checkbox"]:checked + label span {
				background: url(<?=$adr_img ?>bo_checkbox_on.png);
				background-size: contain;
			}
			@media (max-width: 768px) {
				#community_cate {
					width: 130px;
					height: 30px;
					background: #fff url('<?=$adr_img ?>
						select_arrow_pink.png') no-repeat 90% center;
						font-size: 10px;
						}
						}
		</style>

		<?php
		include ("footer.php");
		?>
	</body>
</html>

