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
					글 쓰기
				</div>
			</div>

			<div id="cmw_wrap">
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox1" value="option1">
					아우터</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox2" value="option2">
					상의</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox3" value="option3">
					하의</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox1" value="option1">
					원피스</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox2" value="option2">
					언더웨어</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox3" value="option3">
					남성신발</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox1" value="option1">
					여성신발</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox2" value="option2">
					가방</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox3" value="option3">
					지갑</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox1" value="option1">
					시계</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox2" value="option2">
					안경 및 선글라스</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox3" value="option3">
					쥬얼리</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox2" value="option2">
					유아동</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="inlineCheckbox3" value="option3">
					기타</label>
			</div>
			<div id="summernote">
				Hello Summernote
			</div>
		</div>
		<script>
		$(document).ready(function() {
			$('#summernote').summernote({
				height : 300,
				lang: 'ko-KR',
				toolbar: [
					['style', ['fontsize', 'bold', 'underline', 'strikethrough']],
					['color', ['color']],
					['para', ['paragraph']],
					['insert', ['picture', 'video', 'link']],
					['misc', ['codeview']],
				]
			});
		});
		</script>

		<?php
		include ("footer.php");
		?>
	</body>
</html>

