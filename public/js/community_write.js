$(document).ready(function() {
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		$('#summernote').summernote({
			height : 400,
			lang: 'ko-KR',
			toolbar: [
				['style', ['fontsize', 'bold']],
				['insert', ['picture']],
			]
		});
	}
	else {
		$('#summernote').summernote({
			height : 600,
			lang: 'ko-KR',
			toolbar: [
				['style', ['fontsize', 'bold', 'underline', 'strikethrough']],
				['color', ['color']],
				['para', ['paragraph']],
				['insert', ['picture', 'video', 'link']],
			]
		});
	}
});

function commCreate()
{
	var title = $("cmw_title").val();
	var content = $("summernote").val();
}