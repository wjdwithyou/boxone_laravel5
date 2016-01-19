<nav class="mg_t16 f_c">
	<div id="parcel_tab" class="popup_tab selected_tab grid grid_h" onclick="parcel();">
		배송
	</div>
	<div id="customs_tab" class="popup_tab notselected_tab grid grid_h" onclick="customs();">
		통관
	</div>
</nav>
<div>
	<div id="parcel">
		<p class="popup_p mg_t8">BOXONE에서 간편하게 배송조회하세요!</p>
		<div class="input_div">
			<select id="delivery_office" class="bo_selectbox bo_selectbox_3">
			</select>
		</div>
		<div class="input_div">
			<input type="number" id="delivery_num" class="bo_input1" placeholder="운송장번호">
		</div>
		<div class="input_div">
			<button type="button" class="bo_btn4 br_25" onclick="deliverySearch();">조회</button>
		</div>
	</div>
	<div id="customs" hidden>
		<p class="popup_p mg_t8">BOXONE에서 간편하게 통관조회하세요!</p>
		<div class="input_div">
			<select id="entry_year" class="bo_selectbox bo_selectbox_3">
			</select>
		</div>
		<div class="input_div">
			<input type="number" id="entry_num" class="bo_input1" placeholder="화물통관번호">
		</div>
		<div class="input_div">
			<button type="button" class="bo_btn4 br_25" onclick="entrySearch();">조회</button>
		</div>
	</div>
</div>