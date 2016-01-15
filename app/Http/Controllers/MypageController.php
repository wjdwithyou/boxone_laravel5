<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\MemberModel;
use Request;


class MypageController extends Controller {


	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 마이페이지 처음
	 */
	public function index()
	{
		$memberModel = new MemberModel();
		$util = new Utility();
		
		if ($util->loginStateChk(true))
		{
			$nickname = $_SESSION['nickname'];
			$result = $memberModel->getInfoByNickname($nickname)['data'][0];
			$page = 'mypage';
		}
		return view($page, array('page' => $page, 'result' => $result));
	}
	
	
	public function info()
	{
		$memberModel = new MemberModel();
		$util = new Utility();
		
		if ($util->loginStateChk(true))
		{
			$nickname = $_SESSION['nickname'];
			$result = $memberModel->getInfoByNickname($nickname)['data'][0];
			$page = 'mypage_info';
		}
		return view($page, array('page' => $page, 'result' => $result));
	}

	/*
	 * 2015.11.19
	 * 작성자 : 박용호
	 * 기존 비밀번호 확인 -> 로그인 기능을 이용해 확인
	 */
	public function checkPw()
	{
		$memberModel = new MemberModel();
		
		$type = 5;
		$id = Request::input('id');
		$pw = Request::input('pw');
		
		$result = $memberModel->login($type, $id, $pw);
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 각종 정보 업데이트 -> 인덱스로 해당 회원 정보 호출 후 일부 변경, 업데이트
	 */
	public function update()
	{
		$memberModel = new MemberModel();
		
		$idx = Request::input('idx');
		$col = Request::input('col');
		$val = Request::input('val');
		
		$data = $memberModel->getInfoSingle($idx);
		
		if ($col == "email")
			$data['data'][0]->email = $val;
		else if ($col == "nickname")
			$data['data'][0]->nickname = $val;
		
		$result = $memberModel->update($idx, $data['data'][0]->nickname, $data['data'][0]->type, $data['data'][0]->email, $data['data'][0]->id);
		
		if ($result['code'] == 1 && $col == 'nickname')
			$_SESSION['nickname'] = $val;
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 비밀번호 업데이트 -> 즉시 업데이트?
	 */
	public function updatePw()
	{
		$memberModel = new MemberModel();
		
		$idx = Request::input('idx');
		$pw = Request::input('pw');
	
		$result = $memberModel->updatePw($idx, $pw);
	
		header('Content-Type: application/json');
		echo json_encode($result);
	}

}