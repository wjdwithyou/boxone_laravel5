$(document).ready(function(){
	$('#main_slide').bxSlider({
		auto: true
	});
	$('#br_slide').bxSlider({
		auto: true,
		controls: false,
		slideWidth: 150,
	    minSlides: 2,
	    maxSlides: 5,
	    moveSlides: 2,
	    slideMargin: 8,
	    captions: true
	});
	$('#hd_slide').bxSlider({
		auto: true,
		controls: false,
		slideWidth: 252,
	    minSlides: 2,
	    maxSlides: 4,
	    moveSlides: 1,
	    slideMargin: 16
	});
	$(".bx-pager").remove();
});
