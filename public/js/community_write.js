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
	
	$("#community_cate").on('change', function(){
		var cate = $("#community_cate").val();
		$.ajax
		({
			url: adr_ctr+"Community/getSmallCate",
			type: 'post',
			async: false,
			data:{
				cate: cate
			},
			success: function(result)
			{
				//alert (JSON.stringify(result));
				result = JSON.parse(result);
				var pushCate = "";
				for (var i = 0 ; i < result.length ; i++)
				{
					pushCate += "<div class='cm_cate col-xs-4 col-sm-2'>\n";
					pushCate += "<a class=\"push_cate\" onclick=\"stackCate(" + result[i].idx + ", '" + result[i].name + "');\">" + result[i].name + "</a>\n";
					pushCate += "</div>\n";
				}
				$("#cm_cate_wrap").html(pushCate);
			},
			error: function(request,status,error)
			{
				console.log(request.responseText);
			    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	});
});

function stackCate(idx, name)
{
	var cnt = 0;
	
	$(".stack_cate").each(function(){
		if($(this).val()+"" == idx+""){
			cnt++;
			return false;
		}
	})
	
	if(cnt == 0){
		var appendStr = "<button type='button' class='stack_cate'"
		 +"onclick='remove_stack_cate($(this));' value='"+idx+"'>"+name+"&nbsp;&nbsp;X</button>";
		$("#stack_cate_wrap").append(appendStr);
	}
	else{
		alert("이미 선택하신 카테고리입니다.");
	}
}

function remove_stack_cate(e){
	e.remove();
}

function commWrite()
{
	var cate = "";
	$(".stack_cate").each(function(){
		cate += $(this).val() + ",";
	})
	
	var title = $("#cmw_title").val();
	var content = $("#summernote").val();
	
	if (cate == "")
		alert ("카테고리를 1개 이상 설정해주세요.");
	else if (title == "")
		alert ("제목을 작성해주세요.");
	else if (content == "")
		alert ("내용을 작성해주세요.");
	else
		$.ajax
		({
			url: adr_ctr+"Community/create",
			type: 'post',
			async: false,
			data:{
				cate: cate,
				title: title,
				content: content
			},
			success: function(result)
			{
				//alert (JSON.stringify(result));
				result = JSON.parse(result);
				alert (result.content);
				if (result.code == 1)
				{
					var adr_ctr = $("#adr_ctr").val();
					alert ("게시글이 작성되었습니다.");
					location.href = adr_ctr + "Community/content?idx=" + result.data;  
				}
				else
					alert ("잘못된 접근입니다.");
			},
			error: function(request,status,error)
			{
				console.log(request.responseText);
			    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	
}




