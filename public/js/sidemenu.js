function mypage_open() {
	$('#mypage_wrap').slideDown();
	$('#mypage').css('border-bottom', '0');
}

function mypage_close() {
	$('#mypage_wrap').slideUp();
	$('#mypage').css('border-bottom', '1px solid #ccc');
}

function shipping_open() {
	$('#shipping_wrap').slideDown();
	$('#shipping').css('border-bottom', '0');
}

function shipping_close() {
	$('#shipping_wrap').slideUp();
	$('#shipping').css('border-bottom', '1px solid #ccc');
}

function mypage_collapse() {
	if ($('#mypage_wrap').is(':visible')) {
		mypage_close();
	} else {
		mypage_open();
		shipping_close();
	}
}

function shipping_collapse() {
	if ($('#shipping_wrap').is(':visible')) {
		shipping_close();
	} else {
		shipping_open();
		mypage_close();
	}
}

function guide_collapse() {
	if ($('#guide_wrap').is(':visible')) {
		$('#guide_wrap').slideUp();
		$("#guide_menu").css('border-bottom', '1px solid #ccc');
	} else {
		$('#guide_wrap').slideDown();
		$("#guide_menu").css('border-bottom', '0');
	}
}

function sb_collapse() {
	if ($('#sb_wrap').is(':visible')) {
		$('#sb_wrap').slideUp();
		$('#sb_collapse_arrow').addClass('glyphicon-menu-down').removeClass('glyphicon-menu-up');
	} else {
		$('#sb_wrap').slideDown();
		$('#sb_collapse_arrow').addClass('glyphicon-menu-up').removeClass('glyphicon-menu-down');
	}
}

function open_modal(id) {
	$(id).modal("show");
}