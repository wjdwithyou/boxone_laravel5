<div id="cal_wrap">	
	<div id="input_wrap">
		<table id="cal_input">
			<tbody>
				<tr>
					<td colspan="2">
						<select id="select_cate" class="cal_cate_split form-control" onchange="select_cate();">
						</select>
						<select id="low_cate" class="cal_cate_split form-control" onchange="select_lowcate();">
						</select>
					</td>
				</tr>
				<tr>
					<td class="cal_txt">
						국가선택
					</td>
					<td class="cal_cate">
						<select id="select_country" class="form-control" onchange="select_country();">
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
				<tr>
					<td id="exchange" colspan="2">
						고시환율&nbsp;
						<span id="rate" class="font_weight_bold"></span>
						&nbsp;원
						<br>
						안심구매금액&nbsp;
						<span id="ansim" class="font_weight_bold"></span>
					</td>
				</tr>
				<tr>
					<td class="cal_txt">
						상품가격
					</td>
					<td class="cal_cate">
						<input type="text" id="input_price" class="form-control" placeholder="">
						<span id="monetary"></span>
					</td>
				</tr>
				<tr>
					<td class="cal_msg" colspan="2">
						<span>물품가격은 외국내 배송료, 세금을 포함한 가격입니다</span>
					</td>
				</tr>
				<tr>
					<td class="cal_txt">
						상품무게
					</td>
					<td class="cal_cate">
						<input type="text" id="input_weight" class="form-control" placeholder="">
						<select id="select_weight" class="form-control">
							<option value="kg">kg</option>
							<option value="lbs">lbs</option>
						</select>
					</td>
				</tr>
				<tr>
					<td id="cal_btn_wrap" colspan="2">
						<input id="cal_btn" class="boxone_btn_3 btn btn-default" type="button" onclick="calculate_all();" value="계산하기">
					</td>
				</tr>
				<tr id="cal_result_wrap">
					<td class="cal_msg" colspan="2">
						물품가격 200달러 이하로 목록통관 대상입니다
					</td>
				</tr>
				<tr>
					<td class="result_txt">
						상품가격
					</td>
					<td class="result_money">
						<span id="price_money"></span>
						&nbsp;원
					</td>
				</tr>
				<tr>
					<td class="result_txt">
						선편요금
					</td>
					<td class="result_money">
						<span id="weight_money"></span>
						&nbsp;원
					</td>
				</tr>
				<tr>
					<td class="result_txt">
						관세
					</td>
					<td class="result_money">
						<span id="duty_money"></span>
						&nbsp;원
					</td>
				</tr>
				<tr>
					<td class="result_txt">
						부가세
					</td>
					<td class="result_money">
						<span id="surtax_money"></span>
						&nbsp;원
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="result_wrap">
	</div>
</div>







