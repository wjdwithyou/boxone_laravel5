$(document).ready(function() {
	$(".product_div2").height($(".product_div").height());
	
	$(window).resize(function() {
		$(".product_div2").height($(".product_div").height());
	});
});