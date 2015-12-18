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
					<button type="button" class="bo_btn" onclick='location.href="<?=$adr_ctr ?>Community/write"'>
						글쓰기
					</button>
				</div>
			</div>

			<div id="cm_cate_wrap" class="cl_b">
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c1" name="cc">
					<label for="c1"><span></span>안경 및 선글라스</label>
				</div>
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c2" name="cc">
					<label for="c2"><span></span>안경 및 선글라스</label>
				</div>
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c3" name="cc">
					<label for="c3"><span></span>안경 및 선글라스</label>
				</div>
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c4" name="cc">
					<label for="c4"><span></span>안경 및 선글라스</label>
				</div>
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c5" name="cc">
					<label for="c5"><span></span>안경 및 선글라스</label>
				</div>
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c6" name="cc">
					<label for="c6"><span></span>안경 및 선글라스</label>
				</div>
				<div class="cm_cate col-xs-4 col-sm-2">
					<input type="checkbox" id="c7" name="cc">
					<label for="c7"><span></span>안경 및 선글라스</label>
				</div>
			</div>

			<div id="cm_board_wrap" class="cl_b">
				<!-- 게시판형 -->
				<table class="cm_board">
					<tr>
						<td class="cm_pc ">127257</td>
						<td class="cm_board_title "><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_pc ">서장원</td>
						<td class="cm_pc ">2015-07-14</td>
						<td class="cm_pc ">223</td>
						<td class="cm_board_reply cm_mobile" rowspan="2">
						<div class="numberCircle">
							12
						</div></td>
					</tr>
					<tr class="cm_mobile">
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 조회수 223</td>
					</tr>
				</table>
				<!-- /게시판형 -->
				<table class="cm_board">
					<tr>
						<td class="cm_pc ">127257</td>
						<td class="cm_board_title "><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_pc ">서장원</td>
						<td class="cm_pc ">2015-07-14</td>
						<td class="cm_pc ">223</td>
						<td class="cm_board_reply cm_mobile" rowspan="2">
						<div class="numberCircle">
							12
						</div></td>
					</tr>
					<tr class="cm_mobile">
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 조회수 223</td>
					</tr>
				</table>
				<table class="cm_board">
					<tr>
						<td class="cm_pc ">127257</td>
						<td class="cm_board_title "><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_pc ">서장원</td>
						<td class="cm_pc ">2015-07-14</td>
						<td class="cm_pc ">223</td>
						<td class="cm_board_reply cm_mobile" rowspan="2">
						<div class="numberCircle">
							12
						</div></td>
					</tr>
					<tr class="cm_mobile">
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 조회수 223</td>
					</tr>
				</table>
				<table class="cm_board">
					<tr>
						<td class="cm_pc ">127257</td>
						<td class="cm_board_title "><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_pc ">서장원</td>
						<td class="cm_pc ">2015-07-14</td>
						<td class="cm_pc ">223</td>
						<td class="cm_board_reply cm_mobile" rowspan="2">
						<div class="numberCircle">
							12
						</div></td>
					</tr>
					<tr class="cm_mobile">
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 조회수 223</td>
					</tr>
				</table>
				<table class="cm_board">
					<tr>
						<td class="cm_pc ">127257</td>
						<td class="cm_board_title "><a>신규 통장 발급 얼마나 까다롭기에, 통장고시라는 말까지</a></td>
						<td class="cm_pc ">서장원</td>
						<td class="cm_pc ">2015-07-14</td>
						<td class="cm_pc ">223</td>
						<td class="cm_board_reply cm_mobile" rowspan="2">
						<div class="numberCircle">
							12
						</div></td>
					</tr>
					<tr class="cm_mobile">
						<td class="cm_board_writer bo_color">서장원 | 2015-07-14 | 조회수 223</td>
					</tr>
				</table>

				<!-- 앨범형 -->
				<div class="hd_result_div_wrap cl_b">
					<div class="hd_result_div">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>calculator.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치 드디어 왔어요! 개봉샷 올립니다! 평가점
							</div>
							<div class="album_writer bo_color">
								서장원 | 2015-07-14 | 223
							</div>
							<div class="album_btnset cl_b">
								<div class="f_l">
									<img src="<?= $adr_img ?>suki.png">
									<span class="album_count">16</span>
								</div>
								<div class="f_r">
									<img src="<?= $adr_img ?>reply.png">
									<span class="album_count">5</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /앨범형 -->
				<div class="hd_result_div_wrap cl_b">
					<div class="hd_result_div">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>calculator.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치 드디어 왔어요! 개봉샷 올립니다! 평가점
							</div>
							<div class="album_writer bo_color">
								서장원 | 2015-07-14 | 223
							</div>
							<div class="album_btnset cl_b">
								<div class="f_l">
									<img src="<?= $adr_img ?>suki.png">
									<span class="album_count">16</span>
								</div>
								<div class="f_r">
									<img src="<?= $adr_img ?>reply.png">
									<span class="album_count">5</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hd_result_div_wrap cl_b">
					<div class="hd_result_div">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>calculator.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치 드디어 왔어요! 개봉샷 올립니다! 평가점
							</div>
							<div class="album_writer bo_color">
								서장원 | 2015-07-14 | 223
							</div>
							<div class="album_btnset cl_b">
								<div class="f_l">
									<img src="<?= $adr_img ?>suki.png">
									<span class="album_count">16</span>
								</div>
								<div class="f_r">
									<img src="<?= $adr_img ?>reply.png">
									<span class="album_count">5</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hd_result_div_wrap cl_b">
					<div class="hd_result_div">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>calculator.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치 드디어 왔어요! 개봉샷 올립니다! 평가점
							</div>
							<div class="album_writer bo_color">
								서장원 | 2015-07-14 | 223
							</div>
							<div class="album_btnset cl_b">
								<div class="f_l">
									<img src="<?= $adr_img ?>suki.png">
									<span class="album_count">16</span>
								</div>
								<div class="f_r">
									<img src="<?= $adr_img ?>reply.png">
									<span class="album_count">5</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hd_result_div_wrap cl_b">
					<div class="hd_result_div">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>calculator.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치 드디어 왔어요! 개봉샷 올립니다! 평가점
							</div>
							<div class="album_writer bo_color">
								서장원 | 2015-07-14 | 223
							</div>
							<div class="album_btnset cl_b">
								<div class="f_l">
									<img src="<?= $adr_img ?>suki.png">
									<span class="album_count">16</span>
								</div>
								<div class="f_r">
									<img src="<?= $adr_img ?>reply.png">
									<span class="album_count">5</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hd_result_div_wrap">
					<div class="hd_result_div">
						<div class="hd_product_img center_box">
							<div class="center_content">
								<a onclick=""><img src="<?= $adr_img ?>calculator.jpg"></a>
							</div>
						</div>
						<div class="hd_site_desc">
							<div class="hd_brand text_overflow">
								토리버치 드디어 왔어요! 개봉샷 올립니다! 평가점
							</div>
							<div class="album_writer bo_color">
								서장원 | 2015-07-14 | 223
							</div>
							<div class="album_btnset cl_b">
								<div class="f_l">
									<img src="<?= $adr_img ?>suki.png">
									<span class="album_count">16</span>
								</div>
								<div class="f_r">
									<img src="<?= $adr_img ?>reply.png">
									<span class="album_count">5</span>
								</div>
							</div>
						</div>
					</div>
				</div>
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

		<style>
			#community_cate {
				width: 188px;
				height: 40px;
				border: 1px solid #F15A63 !important;
				color: #F15A63;
				background: #fff url('<?=$adr_img?>select_arrow_pink.png') no-repeat 90% center;
				text-indent: 0.01px;
				text-overflow: "";
				padding-left: 6px;
				-webkit-appearance: none;
				-moz-appearance: none;
				appearance: none;
			}
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
			@media (max-width: 768px) {
				#community_cate {
					width: 130px;
					height: 30px;
					background: #fff url('<?=$adr_img?>select_arrow_pink.png') no-repeat 90% center;
					font-size: 10px;
				}
			}
		</style>
	</body>
</html>

