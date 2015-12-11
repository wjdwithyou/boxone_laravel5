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

			<div id="summernote">
				Hello Summernote
			</div>
		</div>
		<script>
			$(document).ready(function() {
				$('#summernote').summernote({
					height : 300,
					minHeight : null,
					maxHeight : null,
					focus : true,
					lang: 'ko-KR'
				});
			});
		</script>

		<?php
		include ("footer.php");
		?>
	</body>
</html>

