function commBookmark(comm_idx)
{
	var logined = $("#logined").val();
	
	if (logined != "1")
		login_popup();
	else
	{
		$.ajax
		({
			url: adr_ctr+"Community/bookmark",
			type: 'post',
			async: false,
			data:{
				comm_idx: comm_idx
			},
			success: function(result)
			{
				result = JSON.parse(result);
				if (result.code == 1)
				{
					if (result.msg == "created")
					{
						alert ("북마크에 추가되었습니다.");
						// 버튼 변경
					}
					else
					{
						alert ("북마크에서 제거되었습니다.");
						// 버튼 변경
					}
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
	
}

function commDelete(comm_idx)
{
	$.ajax
	({
		url: adr_ctr+"Community/delete",
		type: 'post',
		async: false,
		data:{
			comm_idx: comm_idx
		},
		success: function(result)
		{
			result = JSON.parse(result);
			if (result.code == 1)
			{
				alert ("글이 삭제되었습니다.");
				var adr_ctr = $("#adr_ctr").val();
				location.href = adr_ctr + "Community/index";
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

function replyCreate(comm_idx)
{
	var logined = $("#logined").val();
	var text = $("#reply_write_content").val();
	
	if (logined != "1")
		login_popup();
	else if (text.length == 0)
		alert ("댓글을 입력해주세요.");
	else if (text.length > 200)
		alert ("최대 200자까지 등록할 수 있습니다.");
	else
	{
		$.ajax
		({
			url: adr_ctr+"Community/createReply",
			type: 'post',
			async: false,
			data:{
				comm_idx: comm_idx,
				text: text
			},
			success: function(result)
			{
				result = JSON.parse(result);
				if (result.code == 1)
				{
					alert ("댓글이 등록되었습니다.");
					var adr_ctr = $("#adr_ctr").val();
					location.reload();
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
		
}






