$(document).ready(function(){
	$('#main_slide').bxSlider({
		auto: true,
		pager: false
	});
	$('#br_slide').bxSlider({
		slideWidth: 150,
	    minSlides: 2,
	    maxSlides: 5,
	    moveSlides: 2,
	    slideMargin: 8,
	    captions: true,
	    pager: false
	});
	$('#hd_slide').bxSlider({
	    minSlides: 1,
	    maxSlides: 1,
	    moveSlides: 1,
	    pager: true,
	    controls: false
	});
	$('.cate_slide').each(function() {
	    var _this = $(this).bxSlider({
	        slideWidth: 181,
		    minSlides: 2,
		    maxSlides: 5,
		    moveSlides: 1,
		    pager: false,
		    speed: 1000,
        	pause: 500
	    });
	    _this.parent(".bx-viewport").next().find(".bx-next").mouseenter(function() {
	         _this.startAuto();      
	     }).mouseleave(function() {   
	         _this.stopAuto();
	    });
	    _this.parent(".bx-viewport").next().find(".bx-prev").mouseenter(function() {
	         interval = setInterval(function(){
		       _this.goToPrevSlide();      
		   }, 200);
	     }).mouseleave(function() {   
	         clearInterval(interval); 
	    });
	});
	
	if($(window).width() >767)
		hdslideToppadding();
		
	$(window).resize(function(){
		if($(window).width() >767)
			hdslideToppadding();
	});
});

function hdslideToppadding(){
	$("#hd_slide_wrap").height($(".imglist_div3").eq(1).height() * 2 + 16);
}
