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

		<div id="container" class="cl_b">
			<div id="mytop_wrap" class="cl_b">
				<div id="mytop" class="cl_b">
					<div id="mytop_title">
						MY 커뮤니티
					</div>
					<div id="mytop_profile">
						<img src="<?= $adr_img ?>img.png">
					</div>
					<div id="mytop_nickname">
						우주토깽 님
					</div>
					<div id="mytop_info">
						<div class="mytop_info_ico col-xs-4">
							<img src="<?= $adr_img ?>reply3.png">
							&nbsp;게시물&nbsp;23
						</div>
						<div class="mytop_info_ico col-xs-4">
							<img src="<?= $adr_img ?>suki_on2.png">
							&nbsp;댓글&nbsp;12
						</div>
						<div class="mytop_info_ico col-xs-4">
							<img src="<?= $adr_img ?>suki_on2.png">
							&nbsp;북마크&nbsp;4
						</div>
					</div>
				</div>
			</div>
			<div id="mytop_sub_wrap" class="cl_b">
				<div id="latest_reply">
					[댓글댓글댓글 댓글을 써욤 댓글댓글 댓...]에 댓글[1] 이 달렸습니다
				</div>
			</div>
			
			<div id="mycm_nav">
				<a class="current_mycm" onclick="">내가 쓴 글</a>
				<a onclick="">내가 쓴 댓글</a>
				<a onclick="">북마크</a>
			</div>
				
			<div id="cm_content">
				<div id="cm_board_wrap" class="cl_b">
					<table class="cm_board">
						<!-- 커뮤니티 글 -->
						<tr>
							<td class="mycm_checkbox" rowspan="2">
								<input type="checkbox" id="cm_cate_" name="cc" onclick="">
								<label for="cm_cate_"><span></span></label>
							</td>
							<td class="cm_board_title"><a onclick="">[EXO] 수니 심장 뿌셔뿌셔한 목폴라와 무스탕입은 오늘자 공항 찬열이.jpg<span class="pc_reply">&nbsp;[12]</span></a></td>
							<td class="cm_pc">파지래기</td>
							<td class="cm_pc">2015-12-24 01:35:07</td>
							<td class="cm_pc">112</td>
							<td class="cm_board_reply cm_mobile" rowspan="2">
								<div class="numberCircle">12</div>
							</td>
						</tr>
						<tr class="cm_mobile">
							<td class="cm_board_writer bo_color">파지래기&nbsp;|&nbsp;2015-12-24 01:35:07&nbsp;|&nbsp;조회수&nbsp;112</td>
						</tr>
						<!-- /커뮤니티 글 -->
					</table>
					<table class="cm_board">
						<!-- 커뮤니티 글 -->
						<tr>
							<td class="mycm_checkbox" rowspan="2">
								<input type="checkbox" id="cm_cate_" name="cc" onclick="">
								<label for="cm_cate_"><span></span></label>
							</td>
							<td class="cm_board_title"><a onclick="">[EXO] 수니 심장 뿌셔뿌셔한 목폴라와 무스탕입은 오늘자 공항 찬열이.jpg<span class="pc_reply">&nbsp;[12]</span></a></td>
							<td class="cm_pc">파지래기</td>
							<td class="cm_pc">2015-12-24 01:35:07</td>
							<td class="cm_pc">112</td>
							<td class="cm_board_reply cm_mobile" rowspan="2">
								<div class="numberCircle">12</div>
							</td>
						</tr>
						<tr class="cm_mobile">
							<td class="cm_board_writer bo_color">파지래기&nbsp;|&nbsp;2015-12-24 01:35:07&nbsp;|&nbsp;조회수&nbsp;112</td>
						</tr>
						<!-- /커뮤니티 글 -->
					</table>
					<table class="cm_board">
						<!-- 커뮤니티 글 -->
						<tr>
							<td class="mycm_checkbox" rowspan="2">
								<input type="checkbox" id="cm_cate_" name="cm_cate_" onclick="">
								<label for="cm_cate_"><span></span></label>
							</td>
							<td class="cm_board_title"><a onclick="">[EXO] 수니 심장 뿌셔뿌셔한 목폴라와 무스탕입은 오늘자 공항 찬열이.jpg<span class="pc_reply">&nbsp;[12]</span></a></td>
							<td class="cm_pc">파지래기</td>
							<td class="cm_pc">2015-12-24 01:35:07</td>
							<td class="cm_pc">112</td>
							<td class="cm_board_reply cm_mobile" rowspan="2">
								<div class="numberCircle">12</div>
							</td>
						</tr>
						<tr class="cm_mobile">
							<td class="cm_board_writer bo_color">파지래기&nbsp;|&nbsp;2015-12-24 01:35:07&nbsp;|&nbsp;조회수&nbsp;112</td>
						</tr>
						<!-- /커뮤니티 글 -->
					</table>
					<table class="cm_board">
						<!-- 커뮤니티 글 -->
						<tr>
							<td class="mycm_checkbox" rowspan="2">
								<input type="checkbox" id="cm_cate_" name="cc" onclick="">
								<label for="cm_cate_"><span></span></label>
							</td>
							<td class="cm_board_title"><a onclick="">[EXO] 수니 심장 뿌셔뿌셔한 목폴라와 무스탕입은 오늘자 공항 찬열이.jpg<span class="pc_reply">&nbsp;[12]</span></a></td>
							<td class="cm_pc">파지래기</td>
							<td class="cm_pc">2015-12-24 01:35:07</td>
							<td class="cm_pc">112</td>
							<td class="cm_board_reply cm_mobile" rowspan="2">
								<div class="numberCircle">12</div>
							</td>
						</tr>
						<tr class="cm_mobile">
							<td class="cm_board_writer bo_color">파지래기&nbsp;|&nbsp;2015-12-24 01:35:07&nbsp;|&nbsp;조회수&nbsp;112</td>
						</tr>
						<!-- /커뮤니티 글 -->
					</table>
				</div>
			</div>
			
			<div id="cm_contents_btnset" class="cl_b">
				<div class="f_l">
					<input type="checkbox" id="check_all" name="select_all" onclick="check_all();">
					<label for="check_all"><span></span>전체선택</label>
				</div>
				<div class="f_r">
					<button type="button" id="selected_remove" onclick="">삭제</button>
				</div>
			</div>
			
			<div id="pagination_wrap">
				<a onclick=""><img src="<?= $adr_img ?>left_arrow.png"></a>
				<div id="pagination">
					<a class="current_page" onclick="">1</a>
					<a onclick="">2</a>
					<a onclick="">3</a>
					<span>···</span>
					<a onclick="">7</a>
				</div>
				<a onclick=""><img src="<?= $adr_img ?>right_arrow.png"></a>
			</div>
		</div>

		<?php
		include ("footer.php");
		?>
		
		<script>
			function check_all(){
				if($("#check_all").prop("checked")) {
					$("input[type=checkbox]").prop("checked",true);
				} else {
					$("input[type=checkbox]").prop("checked",false);
				}
			}
		</script>
		<style>
			input[type="checkbox"] + label span {
				display: inline-block;
				width: 19px;
				height: 19px;
				margin: -4px 4px 0 0;
				vertical-align: middle;
				background: url(<?=$adr_img?>bo_checkbox.png);
				background-size: contain;
				cursor: pointer;
			}
			input[type="checkbox"]:checked + label span {
				background: url(<?=$adr_img?>bo_checkbox_on.png);
				background-size: contain;
			}
		</style>
	</body>
</html>

