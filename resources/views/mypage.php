<!DOCTYPE html>
<html lang="ko">
	<head>
		<?php include ("libraries.php");?>
 	 	<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
	</head>

	<body>
		<?php include ("header.php");?>
		<div id="mypage_wrap" class="row">
			<div id="current_menu" class="col=xs-12">
				<span>마이페이지</span>
			</div>
			<input type="hidden" id="member_idx" value="<?=$result->idx?>"/>
			
			<!-- 기본정보 (소셜 연동) -->
			<?php if ($result->type != 5) :	?>
				<div id="social_basis" class="mypage_box_wrap col-xs-12 col-sm-6">
					<div class="mypage_box">
						<div class="mypage_box_header">
							<span>기본정보</span>
							<div class="clear_both"></div>
						</div>
						<div class="mypage_box_content">
							<table class="table">
								<tbody>
									<tr>
										<td class="font_weight_bold">아이디</td>
										<td>
											<?php switch ($result->type)
												{
													case 1:	$type = "naver"; break;
													case 2:	$type = "katalk"; break;
													case 3:	$type = "facebook"; break;
													case 4:	$type = "google"; break;
												}
											?>
											<img class="basis_img" src="<?=$adr_img ?><?=$type?>.png">
										</td>
									</tr>
									<tr>
										<td class="font_weight_bold">이메일</td>
										<td id="social_basis_email"><?=$result->email?></td>
									</tr>
									<tr>
										<td>
											<button type="button" class="mypage_modify_btn btn btn-default" onclick="open_email_modal();">수정</button>
										</td>
									</tr>
									
								</tbody>
							</table>
						</div>
					</div>
					<!--기본정보 (소셜 연동)수정 팝업 -->
					<div id="social_basis_modal" class="modal fade" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									기본정보 수정
								</div>
								<div class="modal-body">
									<span id="social_basis_modal_email_msg" class="input_msg">미입력</span> <!-- 이메일 형식체크, 중복체크 메시지 -->
									<input type="text" id="social_basis_modal_email" class="form_margin form-control" placeholder="이메일">
									<div class="btn_padding_right col-xs-6">
										<button type="button" class="boxone_btn_2 btn btn-default" onclick="close_popup('#social_basis_modal');">취소</button>
									</div>
									<div class="btn_padding_left col-xs-6">
										<button type="button" class="boxone_btn_1 btn btn-default" onclick="">확인</button>
									</div>
									<div class="clear_both"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			
			<?php else :?>
				<!-- 기본정보 (자체 회원) -->
				<div id="boxone_basis" class="mypage_box_wrap col-xs-12 col-sm-6">
					<div class="mypage_box">
						<div class="mypage_box_header">
							<span>기본정보</span>						
							<div class="clear_both"></div>
						</div>
						<div class="mypage_box_content">
							<table class="table">
								<tbody>
									<tr>
										<td class="font_weight_bold">아이디</td>
										<td>
											<span id="boxone_basis_id"><?=$result->id?></span>
											<img class="basis_img" src="<?=$adr_img ?>boxone.png">
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<button type="button" class="mypage_modify_btn btn btn-default" onclick="open_pw_modal();">비밀번호 수정</button>
										</td>
									</tr>								
								</tbody>
							</table>
						</div>
					</div>
					<!-- 기본정보 (자체 회원)수정 팝업 -->
					<div id="boxone_basis_modal" class="modal fade" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div id="" class="modal-header">
									기본정보 수정
								</div>
								<div class="modal-body">
									<input type="password" id="boxone_basis_pw_origin" class="form_margin form-control" placeholder="기존 비밀번호">
									<span id="boxone_basis_pw_msg" class="input_msg">미입력</span> <!-- 이메일 형식체크, 중복체크 메시지 -->
									<input type="password" id="boxone_basis_pw" class="form_margin form-control" placeholder="새 비밀번호">
									<span id="boxone_basis_pw_confirm_msg" class="input_msg">불일치</span> <!-- 이메일 형식체크, 중복체크 메시지 -->
									<input type="password" id="boxone_basis_pw_confirm" class="form_margin form-control" placeholder="새 비밀번호 확인">
									<div class="btn_padding_right col-xs-6">
										<button type="button" class="boxone_btn_2 btn btn-default" onclick="close_popup('#boxone_basis_modal');">취소</button>
									</div>
									<div class="btn_padding_left col-xs-6">
										<button type="button" class="boxone_btn_1 btn btn-default" onclick="updatePw()">확인</button>
									</div>
									<div class="clear_both"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif;?>
			
			<!-- 프로필,닉네임 (공통) -->
			<div id="profile" class="mypage_box_wrap col-xs-12 col-sm-6">
				<div class="mypage_box">
					<div class="mypage_box_header">
						<span>프로필</span>						
						<div class="clear_both"></div>
					</div>
					<div class="mypage_box_content">
						<table class="table">
							<tbody>
								<tr>
									<td class="text_align_center" rowspan="2"><a href="#" onclick=""><img id="profile_img" src="<?=$adr_img ?>profile/<?=$result->image?>"></a></td>
									<td class="font_weight_bold">닉네임</td>
								</tr>
								<tr>
									<td id="profile_nickname"><?=$result->nickname?></td>
								</tr>
								<tr>
									<td>
										<button type="button" class="mypage_modify_btn btn btn-default" onclick="open_nickname_modal();">수정</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- 프로필,닉네임 수정 팝업 -->
				<div id="profile_modal" class="modal fade" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div id="" class="modal-header">
								프로필 수정
							</div>
							<div class="modal-body">
								<div id="mod_profile_img">
									<a onclick=""><img src="<?=$adr_img?>profile_image.png"></a>
								</div>
								<span id="profile_modal_nickname_msg" class="input_msg">미입력</span> <!-- 이메일 형식체크, 중복체크 메시지 -->								
								<input type="text" id="profile_modal_nickname" class="form_margin form-control" placeholder="닉네임">
								<div class="btn_padding_right col-xs-6">
									<button type="button" class="boxone_btn_2 btn btn-default" onclick="close_popup('#profile_modal');">취소</button>
								</div>
								<div class="btn_padding_left col-xs-6">
									<button type="button" class="boxone_btn_1 btn btn-default" onclick="updateNickname();">확인</button>
								</div>
								<div class="clear_both"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<!-- 직거래 회원정보  (아직 미구현)-->
			<!-- <div id="direct_info" class="mypage_box_wrap col-xs-12 col-sm-6">
				<div class="mypage_box">
					<div class="mypage_box_header">
						<span>추가정보</span>
						<div class="clear_both"></div>
					</div>
					<div class="mypage_box_content">
						<table class="table">
							<tbody>
								<tr>
									<td class="font_weight_bold">이름</td>
									<td id="direct_info_name">박스원</td>
								</tr>
								<tr>
									<td class="font_weight_bold">연락처</td>
									<td id="direct_info_phone">010-1234-5678</td>
								</tr>
								<tr>
									<td class="font_weight_bold">주소</td>
									<td id="direct_info_address">04763 서울시 성동구 왕십리로222 한양종합기술연구원(HIT), 313호</td>
								</tr>
								<tr>
									<td class="font_weight_bold">계좌정보</td>
									<td id="direct_info_account">하나은행 111-111111-1111</td>
								</tr>
								<tr>
									<td>
										<button type="button" class="mypage_modify_btn btn btn-default" data-toggle="modal" data-target="#direct_info_modal">수정</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				
				<div id="direct_info_modal" class="modal fade" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div id="" class="modal-header">
								추가정보 수정
							</div>
							<div class="modal-body">
								<input type="text" id="" class="form_margin form-control" placeholder="연락처">
								<input type="text" id="post" class="form_margin form-control" placeholder="우편번호" readonly>
								<button type="button" id="post_btn" class="boxone_btn_2 btn btn-default" onclick="daum_post();">검색</button>
								<input type="text" id="address" class="form_margin form-control" placeholder="주소" readonly>
								<input type="text" id="address_detail" class="form_margin form-control" placeholder="상세주소">
								<select id="" class="form_margin form-control">
									<option value="은행 선택">은행 선택</option>
									<option value="하나은행">하나은행</option>
									<option value="신한은행">신한은행</option>
									<option value="국민은행">국민은행</option>
									<option value="농협">농협</option>
								</select>
								<input type="text" id="" class="form_margin form-control" placeholder="계좌번호">
								<div class="btn_padding_right col-xs-6">
									<button type="button" class="boxone_btn_2 btn btn-default" onclick="close_popup('#boxone_basis_modal');">취소</button>
								</div>
								<div class="btn_padding_left col-xs-6">
									<button type="button" class="boxone_btn_1 btn btn-default" onclick="">확인</button>
								</div>
								<div class="clear_both"></div>
							</div>
						</div>
					</div>
				</div> -->
			</div>			
		</div>

		<?php include("footer.php"); ?>
	</body>
</html>

