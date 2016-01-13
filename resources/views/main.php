<!DOCTYPE html>
<html lang="ko">
<head>
<?php include ("libraries.php");?>
<script src="<?=$adr_ctr?>bxslider/jquery.bxslider.min.js"></script>
<link rel="stylesheet" href="<?=$adr_ctr?>bxslider/jquery.bxslider.css" />
</head>

<body>
<div id="wrap">
	<div id="header">
	<?php include ("header.php");?>
	</div>
	
	<div id="container">
		<div id="content">
			<div class="slider1">
				<div id="c1" class="slide"></div>
				<div id="c2" class="slide"></div>
				<div id="c3" class="slide"></div>
			</div>
		</div>
	</div>
	
	<div id="footer">
	<?php include ("footer.php");?>
	</div>
	
</div>

<script>
$(document).ready(function(){
	$('.slider1').bxSlider({
		auto: true
	});
});
</script>
</body>
</html>