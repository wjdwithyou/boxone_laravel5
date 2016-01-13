<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php
		include ("libraries.php");
		?>

	</head>

	<body>
		<?php
		include ("header.php");
		?>

		<div id="container">
			<div id="cm_top">
				<div id="cm_top_cate" class="bo_color">
					<?php foreach($result->category as $cateList) :?>#<?=$cateList?>&nbsp;<?php endforeach;?>
				</div>
				<div id="cm_top_title">
					<?=$result -> title ?>
				</div>
				<div id="cm_top_content">
					<table id="cm_top_table">
						<tr>
							<td rowspan="2">
								<img src="<?=$adr_img ?>profile/<?=$result -> image ?>">
							</td>
							<td class="cm_writer bo_color"><?=$result -> nickname ?></td>
						</tr>
						<tr>
							<td class="cm_content_info bo_color"><?=$result -> upload ?> | 조휘수 <?=$result -> hit_count ?> | 추천 <?=$result -> bookmark_count ?></td>
						</tr>
					</table>
				</div>
			</div>

			<div id="cm_content" class="cl_b">
				<?=$result -> contents ?>
			</div>
			
			<div id="cm_content_btnset" class="cl_b">
				<?php if (!($result->own)) :?>
				<div class="f_l">
					<?php if ($result->bookmark) :?>
						<button type="button" id="suggest_btn" class="bo_btn2" onclick='commBookmark(<?=$result -> idx ?>)'>
					<?php else :?>
						<button type="button" id="suggest_btn" class="bo_btn" onclick='commBookmark(<?=$result -> idx ?>)'>
					<?php endif;?>
						★ 추천
					</button>
				</div>
				<?php else : ?>
				<div id="content_btnset" class="f_r">
					<button type="button" class="bo_btn" onclick='location.href = "<?=$adr_ctr?>Community/indexWrite?idx=<?=$result->idx?>";'>
						수정
					</button>
					<button type="button" class="bo_btn" onclick="commDelete(<?=$result -> idx ?>)">
						삭제
					</button>
				</div>
				<?php endif; ?>
			</div>
		</div>
		
		<div id="reply_wrap">
			<div id="reply_inner">
				<div class="reply_title">
					<img src="<?=$adr_img ?>reply2.png">
					&nbsp;댓글
				</div>
				
				<!-- 댓글 -->
				<?php foreach($reply as $list) :?>
				<?php if (count($list->rereply) > 0) :?>
					<input type="hidden" id="reply_delete_chk_<?=$list -> idx ?>" value="0"/>
				<?php else : ?>
					<input type="hidden" id="reply_delete_chk_<?=$list -> idx ?>" value="1"/>
				<?php endif; ?>
				<table class="reply_table">
					<tr class="reply_show">
						<td class="reply_profile" rowspan="3">
							<img src="<?=$adr_img ?>profile/<?=$list -> image ?>">
						</td>
						<td>
							<span class="reply_writer"><?=$list -> nickname ?></span>
							&nbsp;
							<span class="reply_date bo_color"><?=$list -> upload ?></span>
						</td>
					</tr>
					<tr class="reply_show">
						<td class="reply_content"><?=$list -> contents ?></td>
					</tr>
					<tr class="reply_modify_show" hidden>
						<td class="input_textarea">
							<textarea class="form-control" placeholder="최대 300자까지 등록할 수 있습니다." maxlength="300" rows="3"></textarea>
							<button type="button" class="add_reply" onclick="replyUpdate($(this), <?=$list->idx?>);">
								등록
							</button>
						</td>
					</tr>
					<tr>
						<td>
							<div class="f_l bo_color reply_a">
								<a class="reply_show reply_input" onclick="reply_textarea($(this), <?=$result -> idx ?>, <?=$list -> idx ?>);">답글쓰기</a>
							</div>
							<?php if ($list->own) :?>
							<div class="f_r bo_color reply_a reply_rm">
								<a class="reply_show" onclick="reply_modify($(this));">수정</a>
								<a class="reply_show" onclick="replyDelete(<?=$list -> idx ?>);">삭제</a>
								<a class="reply_modify_show" onclick="reply_modify_cancel($(this));" hidden>취소</a>
							</div>
							<?php endif; ?>
						</td>
					</tr>
				</table>
				<!-- /댓글 -->

				<!-- 댓댓글 -->
				<?php foreach($list->rereply as $reList) :?>
				<table class="reply_table">
					<tr>
						<td class="reply_profile" rowspan="3">
							<img src="<?=$adr_img?>reply_inner.png">
						</td>
						<td class="reply_profile reply_show" rowspan="3">
							<img src="<?=$adr_img?>profile/<?=$reList->image?>">
						</td>
						<td>
							<span class="reply_writer reply_show"><?=$reList->nickname?></span>
							&nbsp;
							<span class="reply_date bo_color reply_show"><?=$reList->upload?></span>
						</td>
					</tr>
					<tr class="reply_show">
						<td class="reply_content"><?=$reList->contents?></td>
					</tr>
					<tr class="reply_modify_show" hidden>
						<td class="input_textarea">
							<textarea class="form-control" placeholder="최대 300자까지 등록할 수 있습니다." maxlength="300" rows="3"></textarea>
							<button type="button" class="add_reply" onclick="replyUpdate($(this), <?=$reList->idx?>);">
								등록
							</button>
						</td>
					</tr>
					<tr>
						<td>
							<?php if ($reList->own) :?>
							<div class="f_r bo_color reply_a reply_rm">
								<a class="reply_show" onclick="reply_modify($(this));">수정</a>
								<a class="reply_show" onclick="replyDelete(<?=$reList->idx?>);">삭제</a>
								<a class="reply_modify_show" onclick="reply_modify_cancel($(this));" hidden>취소</a>
							</div>
							<?php endif;?>
						</td>
					</tr>
				</table>
				<?php endforeach;?>
				<!-- /댓댓글 -->
				<?php endforeach;?>
				
				<div id="reply_input_wrap">
					<div class="reply_title reply_title2">
						<img src="<?=$adr_img ?>reply2.png">
						&nbsp;댓글 쓰기
					</div>
					
					<!-- 댓글 달기 -->
					<table id="reply_input_table" class="reply_table">
						<tr class="reply_modify_show">
							<td class="reply_profile reply_show reply_mobile">
								<img src="<?=$adr_img?>profile_image.png">
							</td>
							<td class="input_textarea2">
								<?php if ($logined) :?>
									<textarea id="reply_write_content" class="form-control" placeholder="최대 300자까지 등록할 수 있습니다." maxlength="300" rows="4"></textarea>
								<?php else :?>
									<textarea id="reply_write_content" class="form-control" placeholder="로그인 후에 이용해 주세요." maxlength="300" rows="4"></textarea>
								<?php endif;?>
								<button type="button" class="add_reply2" onclick="replyCreate($(this), <?=$result->idx?>, 0);">
									등록
								</button>
							</td>
						</tr>
					</table>
				</div>
				<!-- /댓글 달기 -->
			</div>
				
			<!-- 댓댓글 달기 클론 -->
			<div id="reply_textarea" hidden>
				<table class="reply_table">
					<tr class="reply_show">
						<td class="reply_profile" rowspan="3">
							<img src="<?=$adr_img?>reply_inner.png">
						</td>
					</tr>
					<tr class="reply_modify_show">
						<td class="input_textarea">
							<?php if ($logined) :?>
								<textarea class="form-control" placeholder="최대 300자까지 등록할 수 있습니다." maxlength="300" rows="3"></textarea>
							<?php else :?>
								<textarea class="form-control" placeholder="로그인 후에 이용해 주세요." maxlength="300" rows="3"></textarea>
							<?php endif;?>
							<button type="button" class="add_reply" onclick="">
								등록
							</button>
						</td>
					</tr>
					<tr>
						<td>
							<div class="f_r bo_color reply_a reply_rm">
								<a class="reply_modify_show" onclick="remove_reply_textarea($(this));">취소</a>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<!-- /댓댓글 달기 클론 -->

			<div id="pagination_wrap">
				<div id="pagination">
					<?php if($result->next) :?>
						<a onclick="commContent(<?=$result -> next ?>);">이전</a>
					<?php else : ?>
						<a onclick="alert('이전 게시글이 없습니다.');">이전</a>
					<?php endif; ?>
					&nbsp;|&nbsp;
					<a href="<?=$adr_ctr ?>Community/index?<?=$redirect ?>">목록보기</a>
					<input type="hidden" id="cm_redirect" value="<?=$redirect ?>"/>
					&nbsp;|&nbsp;
					<?php if($result->prev) :?>
						<a onclick="commContent(<?=$result -> prev ?>);">다음</a>
					<?php else : ?>
						<a onclick="alert('다음 게시글이 없습니다.');">다음</a>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php
		include ("footer.php");
		?>
		
		<script>
			function reply_textarea(e, comm_idx, reply_idx) {
				var logined = $("#logined").val();
				if (logined == 0)
					login_popup();
				else
				{
					$("#reply_textarea").find("button").attr("onclick", "replyCreate($(this), " + comm_idx + ", " + reply_idx + ");");
					$("#reply_textarea").children().clone().insertAfter(e.closest("table"));
					e.closest("table").find(".reply_input").hide();
				}
			}

			function remove_reply_textarea(e) {
				e.closest("table").remove();
				$(".reply_input").show();
			}

			function reply_modify(e) {
				var logined = $("#logined").val();
				if (logined == 0)
					login_popup();
				else
				{
					e.closest("table").find(".input_textarea").children("textarea").text(e.closest("table").find(".reply_content").text());
					e.closest("table").find(".reply_show").hide();
					e.closest("table").find(".reply_modify_show").show();
				}
			}

			function reply_modify_cancel(e) {
				e.closest("table").find(".reply_show").show();
				e.closest("table").find(".reply_modify_show").hide();
			}
		</script>
	</body>
</html>

