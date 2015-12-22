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

function replyCreate(e, comm_idx, reply_idx)
{
	var logined = $("#logined").val();
	var text = e.parent().find("textarea").val();
	
	if (logined != "1")
		login_popup();
	else if (text.length == 0)
		alert ("댓글을 입력해주세요.");
	else if (text.length > 300)
		alert ("최대 300자까지 등록할 수 있습니다.");
	else
	{
		$.ajax
		({
			url: adr_ctr+"Community/createReply",
			type: 'post',
			async: false,
			data:{
				comm_idx: comm_idx,
				reply_idx: reply_idx,
				text: text
			},
			success: function(result)
			{
				result = JSON.parse(result);
				if (result.code == 1)
				{
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

function replyDelete(idx)
{
	var chk = $("#reply_delete_chk_"+idx).val();
	if (chk == "0")
		alert ("해당 댓글에 댓글이 달려 있어 삭제할 수 없습니다.");
	else if (confirm("댓글을 삭제하시겠습니까?"))
	{
		$.ajax
		({
			url: adr_ctr+"Community/deleteReply",
			type: 'post',
			async: false,
			data:{
				idx: idx
			},
			success: function(result)
			{
				result = JSON.parse(result);
				if (result.code == 1)
				{
					location.reload();
				}
				else
					alert ("잘못된 접근입니다." + result.msg);
			},
			error: function(request,status,error)
			{
				console.log(request.responseText);
			    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	}
}

function commContent(idx)
{
	var adr_ctr = $("#adr_ctr").val();
	var url = encodeURIComponent($("#cm_redirect").val());
	location.href = adr_ctr + "Community/content?idx=" + idx + "&url=" + url;
}






