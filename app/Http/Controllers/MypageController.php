<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Request;

include dirname(__FILE__)."/../models/MemberModel.php";
include_once dirname(__FILE__)."/../function/baseFunction.php";

class MypageController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


	public function index()
	{
		if (loginStateChk(true))
		{
			$nickname = $_SESSION['nickname'];
			$result = getInfoByNickname($nickname)['data'][0];
			$page = 'mypage';
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
		$type = 5;
		$id = Request::input('id');
		$pw = Request::input('pw');
		
		$result = login($type, $id, $pw);
		
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
		$idx = Request::input('idx');
		$col = Request::input('col');
		$val = Request::input('val');
		
		$data = getInfoSingle($idx);
		
		if ($col == "email")
			$data['data'][0]->email = $val;
		else if ($col == "nickname")
			$data['data'][0]->nickname = $val;
		
		$result = update($idx, $data['data'][0]->nickname, $data['data'][0]->type, $data['data'][0]->email, $data['data'][0]->id);
		
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
		$idx = Request::input('idx');
		$pw = Request::input('pw');
	
		$result = updatePw($idx, $pw);
	
		header('Content-Type: application/json');
		echo json_encode($result);
	}

}