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
			<div id="top" class="cl_b">
				<div id="top_title">
					커뮤니티
				</div>
				<div id="top_content">
					커뮤니티 커뮤니티 커뮤니티
				</div>
				<hr>
				<div id="current_cate">
					패션잡화
				</div>
				<div id="top_select">
					<select id="community_cate" class="form-control" onchange="">
						<option value="">전체</option>
						<option value="">패션잡화</option>
						<option value="">디지털/가전</option>
						<option value="">리빙/뷰티/헬스/기타</option>
						<option value="">사이즈 무게공유</option>
						<option value="">쇼핑몰/배대지</option>
						<option value="">리워드/세금</option>
						<option value="">교환/환불/배송</option>
						<option value="">자유게시판</option>
					</select>
				</div>
				<div id="top_btnset" class="f_r">
					<button type="button" class="bo_btn">
						앨범형
					</button>
					<button type="button" class="bo_btn" onclick='location.href="<?=$adr_ctr?>Community/write"'>
						글쓰기
					</button>
				</div>
			</div>

			<div id="cm_cate_wrap" class="cl_b">
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c1" name="cc">
					<label for="c1"><span></span>Check Box 1</label>
				</div>
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c2" name="cc">
					<label for="c2"><span></span>Check Box 1</label>
				</div>
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c3" name="cc">
					<label for="c3"><span></span>Check Box 1</label>
				</div>
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c4" name="cc">
					<label for="c4"><span></span>Check Box 1</label>
				</div>
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c5" name="cc">
					<label for="c5"><span></span>Check Box 1</label>
				</div>
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c6" name="cc">
					<label for="c6"><span></span>Check Box 1</label>
				</div>
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c7" name="cc">
					<label for="c7"><span></span>Check Box 1</label>
				</div>
			</div>
			
			<div id="cm_board_wrap">
				<table id="cm_board">
					<!-- 커뮤니티 글 -->
					<tr>
						<td class="cm_board_no">127257</td>
						<td class="cm_board_title"><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_board_reply b_bottom" rowspan="2">
							<div class="numberCircle">12</div>
						</td>
					</tr>
					<tr class="b_bottom">
						<td class="cm_board_no"></td>
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 223</td>
					</tr>
					<!-- /커뮤니티 글 -->
					<tr>
						<td class="cm_board_no">127257</td>
						<td class="cm_board_title"><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_board_reply b_bottom" rowspan="2">
							<div class="numberCircle">12</div>
						</td>
					</tr>
					<tr class="b_bottom">
						<td class="cm_board_no"></td>
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 223</td>
					</tr>
					<tr>
						<td class="cm_board_no">127257</td>
						<td class="cm_board_title"><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_board_reply b_bottom" rowspan="2">
							<div class="numberCircle">12</div>
						</td>
					</tr>
					<tr class="b_bottom">
						<td class="cm_board_no"></td>
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 223</td>
					</tr>
					<tr>
						<td class="cm_board_no">127257</td>
						<td class="cm_board_title"><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_board_reply b_bottom" rowspan="2">
							<div class="numberCircle">12</div>
						</td>
					</tr>
					<tr class="b_bottom">
						<td class="cm_board_no"></td>
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 223</td>
					</tr>
					<tr>
						<td class="cm_board_no">127257</td>
						<td class="cm_board_title"><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_board_reply b_bottom" rowspan="2">
							<div class="numberCircle">12</div>
						</td>
					</tr>
					<tr class="b_bottom">
						<td class="cm_board_no"></td>
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 223</td>
					</tr>
					<tr>
						<td class="cm_board_no">127257</td>
						<td class="cm_board_title"><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_board_reply b_bottom" rowspan="2">
							<div class="numberCircle">12</div>
						</td>
					</tr>
					<tr class="b_bottom">
						<td class="cm_board_no"></td>
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 223</td>
					</tr>
					<tr>
						<td class="cm_board_no">127257</td>
						<td class="cm_board_title"><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_board_reply b_bottom" rowspan="2">
							<div class="numberCircle">12</div>
						</td>
					</tr>
					<tr class="b_bottom">
						<td class="cm_board_no"></td>
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 223</td>
					</tr>
					<tr>
						<td class="cm_board_no">127257</td>
						<td class="cm_board_title"><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_board_reply b_bottom" rowspan="2">
							<div class="numberCircle">12</div>
						</td>
					</tr>
					<tr class="b_bottom">
						<td class="cm_board_no"></td>
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 223</td>
					</tr>
				</table>
			</div>
			
			<div class="pagination_wrap cl_b">
				<a onclick=""><img src="<?= $adr_img ?>left_arrow.png"></a>
				<div class="pagination">
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
	</body>
</html>

