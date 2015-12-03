<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php include ("libraries.php");?>
	</head>

	<body>
		<div>
			배송조회
			<select id="baesong_select">
				<option selected="selected">우체국택배</option>
				<option>대한통운</option>
				<option>한진택배</option>
				<option>로젠택배</option>
				<option>현대택배</option>
				<option>KG옐로우캡택배</option>
				<option>KGB택배</option>
				<option>EMS</option>
				<option>DHL</option>
				<option>한덱스</option>
				<option>FedEx</option>
				<option>동부익스프레스</option>
				<option>CJ GLS</option>
				<option>UPS</option>
				<option>하나로택배</option>
				<option>대신택배</option>
				<option>경동택배</option>
				<option>이노지스택배</option>
				<option>일양로지스택배</option>
				<option>CVSnet 편의점택배</option>
				<option>TNT Express</option>
				<option>HB한방택배</option>
			</select>
			<input type="text" id="baesong_num"/>
			<button onclick="baesongSearch();">버튼</button>
			<div id="test">
			</div>
		</div>
		
		<div>
			통관조회
			<input type="text" id="tongkwan_text"/>
		</div>
		
		
		
		
		 
	</body>
</html>

