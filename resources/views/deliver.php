<!-- 로그인 통괄 팝업 -->
<div class="modal fade" id="deliver_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div id="deliver_modal_header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div id="deliver_header">
					<div class="deliver_header_ deliver_header_selected" onclick="delivery_popup();">
						배송조회
					</div>
					<div class="deliver_header_" onclick="entry_popup();">
						통관조회
					</div>
				</div>
			</div>
			<div class="modal-body">
				<!-- 팝업 -->
				<div id="deliver_body">
				</div>
			</div>
		</div>
	</div>
</div>

	<!-- 배송조회 팝업 1 -->
	<div id="delivery1" hidden>
		<div>
	  		texttext
	  	</div>
	  	<select id="delivery_office" class="form_margin form-control">
	  	</select>
	  	<input type="text" id="delivery_num" class="form_margin form-control" placeholder="운송장번호">
		<button type="button" class="btn btn-default deliver_btn" onclick="deliverySearch();">조회</button>
	</div>
	
	<!-- 통관조회 팝업 1 -->
	<div id="entry1" hidden>
		<div>
	  		texttext
	  	</div>
	  	<select id="entry_year" class="form_margin form-control">
	  	</select>
	  	<input type="text" id="entry_num" class="form_margin form-control" placeholder="화물통관번호">
		<button type="button" class="btn btn-default deliver_btn" onclick="entrySearch();">조회</button>
	</div>

