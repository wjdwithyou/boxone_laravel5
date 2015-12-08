// 이미지 바뀌는거 테스트 function
function add_heart(e) {
	if (e.attr('src') == '<?= $adr_img ?>heart.png')
		e.attr('src', '<?= $adr_img ?>heart_on.png');
	else
		e.attr('src', '<?= $adr_img ?>heart.png');
}