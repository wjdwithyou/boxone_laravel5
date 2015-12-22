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
			<div id="mytop" class="cl_b">
				<div id="mytop_title">
					MY 커뮤니티
				</div>
				<div id="mytop_content">
					커뮤니티 커뮤니티 커뮤니티
				</div>
				<div id="current_cate">
					패션잡화
				</div>
			
				
			</div>

			
			<div id="cm_contents">
				<input type="hidden" id="cm_target_page" value="<?=$targetPage?>"/>
			</div>
			
		</div>

		<?php
		include ("footer.php");
		?>
		
	</body>
</html>

