<div class="f_c">
	<div class="grid grid_h">
		<select id="high_cate" class="popup_selectbox bo_selectbox bo_selectbox_3" onchange="selectHighcate();">
			<option value="1">유아</option>
			<option value="2">레저/스포츠</option>
			<option value="3">의류/패션잡화</option>
			<option value="4">가전</option>
			<option value="5">컴퓨터관련용품</option>
			<option value="6">영상/음향</option>
			<option value="7">도서/CD</option>
			<option value="8">화장품/미용</option>
			<option value="9">의약품/건강보조</option>
			<option value="10">침구/커튼</option>
			<option value="11">가구/인테리어</option>
			<option value="12">주방용품</option>
			<option value="13">애완용품</option>
			<option value="14">완구</option>
			<option value="15">바디/헤어케어용품</option>
			<option value="16">악기</option>
			<option value="17">예술품/수집품</option>
			<option value="18">식품</option>
			<option value="19">자동차용품</option>
			<option value="20">생활</option>
		</select>
	</div>
	<div class="grid grid_h">
		<select id="low_cate" class="popup_selectbox bo_selectbox bo_selectbox_3" onchange="selectLowcate();"></select>
	</div>
</div>
<table id="cal_table">
	<tr>
		<td class="cal_col">국가선택</td>
		<td colspan="2">
			<select id="select_country" class="popup_selectbox bo_selectbox bo_selectbox_2" onchange="select_country();">
				<option value="">국가선택</option>
				<option value="NLG">네덜란드</option>
				<option value="DEM">독일</option>
				<option value="USD">미국</option>
				<option value="ESP">스페인</option>
				<option value="GBP">영국</option>
				<option value="EUR">유럽</option>
				<option value="JPY">일본</option>
				<option value="CNY">중국</option>
				<option value="FRF">프랑스</option>
				<option value="AUD">호주</option>
				<option value="HKD">홍콩</option>					
			</select>
		</td>
	</tr>
	<tr id="exchange_rate" hidden>
		<td colspan="3">
			<p class="popup_p bo_color5">고시환율&nbsp;<strong id="rate"></strong>&nbsp;원</p>
			<p class="popup_p bo_color5">안심구매금액&nbsp<strong id="ansim"></strong></p>
		</td>
	</tr>
	<tr>
		<td class="cal_col">상품가격</td>
		<td class="input_div" colspan="2">
			<input type="number" id="input_price" class="bo_input1">
			<span id="monetary" class="font_16"></span>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<p class="popup_p font_10">물품가격은 외국내 배송료, 세금을 포함한 가격입니다.</p>
		</td>
	</tr>
	<tr>
		<td class="cal_col">
			상품무게
		</td>
		<td class="input_div">
			<input type="number" id="input_weight" class="bo_input1">
		</td>
		<td class="cal_col2">
			<select id="select_weight" class="popup_selectbox bo_selectbox bo_selectbox_2">
				<option value="kg">kg</option>
				<option value="lbs">lbs</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="input_div" colspan="3">
			<button type="button" class="bo_btn4 br_25" onclick="calculate_all();">계산하기</button>
		</td>
	</tr>
</table>
<table id="cal_result_table" class="mg_t16">
	<tr>
		<td colspan="2">
			<p class="popup_p">물품가격 200달러 이하로 목록통관 대상입니다.</p>
			<!-- 별도의 개별소비세 부과 대상입니다. -->
		</td>
	</tr>
	<tr>
		<td class="cal_col">상품가격</td>
		<td class="ta_r"><strong id="price_money" class="font_16 bo_color3"></strong>&nbsp;원</td>
	</tr>
	<tr>
		<td class="cal_col">선편요금</td>
		<td class="ta_r"><strong id="weight_money" class="font_16 bo_color1"></strong>&nbsp;원</td>
	</tr>
	<tr>
		<td class="cal_col">관세</td>
		<td class="ta_r"><strong id="duty_money" class="font_16 bo_color1"></strong>&nbsp;원</td>
	</tr>
	<tr>
		<td class="cal_col">부가세</td>
		<td class="ta_r"><strong id="surtax_money" class="font_16 bo_color1"></strong>&nbsp;원</td>
	</tr>
</table>
