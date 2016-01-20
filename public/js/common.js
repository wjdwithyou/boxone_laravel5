$(document).ready(function(){
	if ($("#need_login").val() == "1")
		moveLogin();
			
	$(".menu_hover").mouseover(function() {
		$(this).children().css("color", "#f15a63");
		$("#hover_menu_wrap").show();
		var temp_menuId = $(this).attr("id");
		temp_menuId = "#sb_menu" + temp_menuId.substring(9,10);
		$("#hover_menu_wrap").html($(temp_menuId).html());
	})
	.mouseout(function() {
		$(this).children().css("color", "#000");
		$("#hover_menu_wrap").hide();
	});
});

var adr_ctr = $("#adr_ctr").val();
var adr_img = $("#adr_img").val();

//chrome, firefox 스크롤바 width 무시하기
function checkScrollBars() {
	var b = $('body');
	var normalw = 0;
	var scrollw = 0;
	if (b.prop('scrollHeight') > b.height()) {
		normalw = window.innerWidth;
		scrollw = normalw - b.width();
		$('body').css({
			marginRight : '-' + scrollw + 'px'
		});
	}
}

function toggleDialog(addr, d, n){
	if(d == "l"){
		$("#bo_dialog").css({"left": 0, "right": ""});
		$(".bo_dialog_arrow").css({"left": 0, "right": ""});
		$(".bo_dialog_arrow").css({"left": n});
	}
	else{
		$("#bo_dialog").css({"left": "", "right": 0});
		$(".bo_dialog_arrow").css({"left": "", "right": 0});
		$(".bo_dialog_arrow").css({"right": n});
	}
	if($("#bo_dialog").is(":visible")){
		$("#bo_dialog_content").children().remove();
		$("#bo_dialog").hide();
	}
	else{
		loadDialog(addr);
		$("#bo_dialog").show();
	}
}

function loadDialog(addr){
	$("#bo_dialog_content").load(adr_ctr + addr);
	$.ajax({
		url: adr_ctr + "js/" + addr + ".js",
		dataType: "script",
		cache: true
	});
}

function toggleSearch(){
	$("#header_search").toggle();
}

function moveLogin(page){
	var query = '';
	
	if (page == 'login')
		query += '?prev=' + $('#prev_url').val();
	
	var url = adr_ctr + 'Login/index' + query;
	$(location).attr('href',url);
}

function moveMain(){
	$(location).attr('href', adr_ctr);
}

/*
 * 2015.11.17
 * 작성자 : 박용호
 * 로그아웃 -> 세션 파괴..
 */
function logout()
{
	$.ajax
	({
		url: adr_ctr+'Login/logout',
		type: 'post',
		async: false,
		success: function(result)
		{
			//console.log(result);
			//alert (result);
			alert ("안녕히가세요 빠빠");
			location.reload(false);
		},	
		error:function(request,status,error)
		{
		    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}
