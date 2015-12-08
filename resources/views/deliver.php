<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php include ("libraries.php");?>
	</head>

	<body>
		<div>
			배송조회
			<select id="baesong_select">
			</select>
			<input type="text" id="baesong_num"/>
			<button onclick="baesongSearch();">버튼</button>
			<div id="baesong_test">
			</div>
		</div>
		
		<div>
			통관조회
			<select id="tongkwan_select">
			</select>
			<input type="text" id="tongkwan_num"/>
			<button onclick="tongkwanSearch();">버튼</button>
			<div id="tongkwan_test">
			</div>
		</div>
		
		
		
		
		 
	</body>
</html>

