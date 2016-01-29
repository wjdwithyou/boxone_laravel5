<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\MemberModel;
use Request;
use Mail;


class LoginController extends Controller {

	
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 네이버 로그인으로 데이터 가져오기  -> 네이버는 javascript에서 토큰 등의 접근을 불허함. ㅠㅠ
	 */
	public function naverLogin()
	{	
		if (!empty(Request::input('error')))
		{
			$data = array(
					'result'=>"로그인을 취소하셨습니다."
			);
		}
		else
		{
			$grant_type = "authorization_code";
			$client_id = "o08PVHiq6vxd5Ub23ZVG";
			$client_secret = "Z7z534HWCb";
			$code = Request::input('code');
			$state = Request::input('state');
			
			$url = "https://nid.naver.com/oauth2.0/token";
			$url .= "?grant_type=".$grant_type;
			$url .= "&client_id=".$client_id;
			$url .= "&client_secret=".$client_secret;
			$url .= "&code=".$code;
			$url .= "&state=".$state;
			
			$file = json_decode(file_get_contents($url));
			if (!empty($file->error))
			{
				$data = array(
						'result'=>'잠시 후에 다시 시도해 주세요.\ntoken get error : '.$file->error
				);
			}
			else 
			{
				$access_token = $file->access_token;
				$opts = array(
				
						'http'=>array(
								'method'=>"GET",
								'header'=>'Authorization: bearer '.$access_token
						)
				);
				$context = stream_context_create($opts);
				$file = json_decode(file_get_contents('https://apis.naver.com/nidlogin/nid/getUserProfile.json?response_type=json', false, $context));
				
				if ($file->message == "success")
				{
					$data = array(
							'result' => "success",
							'type' => "1",
							'id' => $file->response->id,
							'nickname' => $file->response->nickname,
							'email' => $file->response->email,
							'img' => $file->response->profile_image
					);
				}
				else
				{
					$data = array(
						'result'=>"잠시 후에 다시 시도해 주세요.\nprofile get error : ".Request::input('error')
					);
				}
				//print_r($data);
			}
		}
		return view('naverGetData', $data);
	}
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 로그인 -> type, id, pw 확인 후 로그인 세션 부여
	 */
	public function login()
	{
		$memberModel = new MemberModel();
		
		$type = Request::input('type');
		$id = Request::input('id');
		$pw = Request::input('pw');

		// DB에 해당 정보 있는지 확인 후 return
		$result = $memberModel->login($type, $id, $pw);
		
		// 로그인 된 상태로 변환
		if ($result['code'] == 1)
		{	
			if (session_id() == '')
				session_start();
			$_SESSION['idx'] = $result['data'][0]->idx;
			$_SESSION['nickname'] = $result['data'][0]->nickname;
			$_SESSION['img'] = $result['data'][0]->image;
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 회원가입 -> 추천인 포인트 업, DB에 기본정보 넣기, 이미지 처리(미완) 후 로그인 처리
	 */
	public function signIn()
	{
		$memberModel = new MemberModel();
		
		$type = Request::input('type');
		$id = Request::input('id');
		$pw = Request::input('pw');
		$email = Request::input('email');
		$nickname = Request::input('nickname');	
		$rec = Request::input('rec');
		
		// 이미지는 파일이 될 수도(자체 회원가입), url 주소가 될 수도(소셜 회원가입) 있음.
		if (Request::hasFile('img'))
		{
			$img = Request::file('img');
			$imgType = 1;
		}
		else if (Request::has('img'))
		{
			$img = Request::input('img');
			if (strpos(" ".$img, "default") || strpos(" ".$img, "nodata"))
			{
				$img = "default.png";
				$imgType = 3;
			}
			else
				$imgType = 2;
		}
		else
		{
			$img = "default.png";
			$imgType = 3;
		}
		
		//추천인 포인트 업
		if (!empty($rec))
			$memberModel->recommand($rec);
		
		//DB에 넣기
		$result = $memberModel->create($type, $email, $nickname, $id, $pw, $img, $imgType);
		
		//필요정보 받아오기
		$result = $memberModel->login($type, $id, $pw);
		if ($result['code'] == 1)
		{
			if (session_id() == '')
				session_start();
			$_SESSION['idx'] = $result['data'][0]->idx;
			$_SESSION['nickname'] = $result['data'][0]->nickname;
			$_SESSION['img'] = $result['data'][0]->image;
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function modifyInfo(){
		$mbModel = new MemberModel();
		
		//$type = Request::input('type');	// social+
		$nicknameo = Request::input('nicknameo');
		//$email = Request::input('email');	// social+
		$nickname = Request::input('nickname');
		$pw = Request::input('pw');
		
		$img = Request::file('img');
		/*
		if (Request::hasFile('img'))
			$img = Request::file('img');
		*/
		
		/*
		// 이미지는 파일이 될 수도(자체 회원가입), url 주소가 될 수도(소셜 회원가입) 있음.
		if (Request::hasFile('img'))
		{
			$img = Request::file('img');
			$imgType = 1;
		}
		else if (Request::has('img'))
		{
			$img = Request::input('img');
			if (strpos(" ".$img, "default") || strpos(" ".$img, "nodata"))
			{
				$img = "default.png";
				$imgType = 3;
			}
			else
				$imgType = 2;
		}
		else
		{
			$img = "default.png";
			$imgType = 3;
		}
		*/
		$result = $mbModel->updateInfo($nicknameo, /*$type, $email*/$nickname, $pw, $img);
		
		$image = $mbModel->getImage($nickname);
		
		if ($result['code'] == 1){
			if (session_id() == '')
				session_start();
			
			$_SESSION['nickname'] = $nickname;
			$_SESSION['img'] = $image['data'][0]->image;
		}
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 이메일 중복 체크
	 */
	public function checkEmail()
	{
		$memberModel = new MemberModel();
		
		$email = Request::input('email');
		$result = $memberModel->checkEmail($email);
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 닉네임 중복 체크
	 */
	public function checkNickname()
	{
		$memberModel = new MemberModel();
		
		$nickname = Request::input('nickname');
		$result = $memberModel->checknickname($nickname);
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	// 160129 J.Style
	// Check old password is correct.
	public function checkPwo(){
		$memberModel = new MemberModel();
		
		$nicknameo = Request::input('nicknameo');
		$pwo = Request::input('pwo');
		
		$result = $memberModel->checkPwo($nicknameo, $pwo);
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 로그아웃
	 */
	public function logout()
	{
		if (session_id() == '')
		{
			session_start();
			session_destroy();
		}
		
		if (isset($_COOKIE[session_name()]))
			setcookie(session_name(), '', time()-42000, '/');
	}
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 비밀번호 찾기 -> 소셜로그인 회원이면 비밀번호 찾을 수 없음, 직접 가입한 회원이면 메일로 인증 코드 발송
	 */
	public function findPw()
	{
		$memberModel = new MemberModel();
		
		$email = Request::input('email');
		
		// 해당 이메일이 가입되어 있는지 확인하기
		$check = $memberModel->checkEmail($email);
		if ($check['code'] == 0)
		{
			switch($check['msg'])
			{
				case 1:
					$result['code'] = 0;
					$result['msg'] = "해당 아이디는 네이버 아이디로 가입된 아이디입니다. 네이버 아이디로 로그인해주세요.";
					break;
					
				case 2:
					$result['code'] = 0;
					$result['msg'] = "해당 아이디는 카카오 아이디로 가입된 아이디입니다. 카카오 아이디로 로그인해주세요.";
					break;
					
				case 3:
					$result['code'] = 0;
					$result['msg'] = "해당 아이디는 페이스북 아이디로 가입된 아이디입니다. 페이스북 아이디로 로그인해주세요.";
					break;
					
				case 4:
					$result['code'] = 0;
					$result['msg'] = "해당 아이디는 구글플러스 아이디로 가입된 아이디입니다. 구글플러스 아이디로 로그인해주세요.";
					break;
					
				case 5:
					$result['code'] = 1;
					$result['idx'] = $check['idx'];
					break;
			}
		}
		else
		{
			$result['code'] = 0;
			$result['msg'] = "해당 이메일은 가입되지 않은 이메일입니다.";
		}
		
		if ($result['code'] != 1)
		{
			header('Content-Type: application/json');
			echo json_encode($result);
			return;
		}
		else 
		{
			// 랜덤 8자리 문자열만들기
			$str = "";
			for ($i = 0 ; $i < 8 ; $i++)
			{
				$num = mt_rand(0, 61);
				if ($num < 10)
					$str .= $num;
				else if ($num < 36)
					$str .= chr($num+55);
				else
					$str .= chr($num+61);
			}
			
			// 메일 보내기
			$user = array(
					'email' => $email,
					'name' => 'Boxone'
			);
			$data = array(
					'code' => $str,
					'email' => $email
			);
			Mail::send('pwFindMail', $data, function($m) use ($user)
			{
				$m->from('boxone2015@gmail.com', 'Boxone');
				$m->to($user['email'], $user['name'])->subject('Find Pw');
			});
			
			$memberModel->createSession($email, $str);
			
			header('Content-Type: application/json');
			echo json_encode($result);
		}
	}
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 비밀번호 변경 -> 인증코드 정상 입력 시 호출, 새로운 비밀번호로 변경.
	 */
	public function checkSession()
	{
		$memberModel = new MemberModel();
	
		$email = Request::input('email');
		$num = Request::input('num');
	
		$result = $memberModel->checkSession($email, $num);
	
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 비밀번호 변경 -> 인증코드 정상 입력 시 호출, 새로운 비밀번호로 변경.
	 */
	public function updatePw()
	{
		$memberModel = new MemberModel();
		
		$email = Request::input('email');
		$pw = Request::input('pw');
		
		$result = $memberModel->updatePw($email, $pw);
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function index(){
		// 20160120 J.Style
		/*	If session exist, redirect to myPage.
		 *  Else,
		 * 			If prev page(REFERER) exist, 	and has 'prev', redirect to 'prev' page.
		 * 											and no 'prev', redirect to prev page(HTTP_REFERER).
		 * 			Else, redirect to mainPage.
		 */
		if (session_id() == '')
			session_start();
		
		if (isset($_SESSION['idx'])){
			$mbModel = new MemberModel();
				
			$nickname = $_SESSION['nickname'];
			$result = $mbModel->getInfoByNickname($nickname);
			
			$page = 'mypage';
			return view($page, array('page' => $page, 'result' => $result['data'][0]));
		}
		else{
			if (isset($_SERVER['HTTP_REFERER'])){
				if (Request::has('prev'))
					$prev_url = Request::input('prev');
				else
					$prev_url = $_SERVER['HTTP_REFERER'];
			}
			else
				$prev_url = 'http://'.$_SERVER['HTTP_HOST'];
			
			$page = 'login';
			return view($page, array('page' => $page, 'prev_url' => $prev_url));
		}
	}
	
	public function join(){
		// 20160115 J.Style
		// If session exist, redirect to myPage.
		if (session_id() == '')
			session_start();
		
		if (isset($_SESSION['idx'])){
			$mbModel = new MemberModel();
		
			$nickname = $_SESSION['nickname'];
			$result = $mbModel->getInfoByNickname($nickname);
		
			$page = 'mypage';
			return view($page, array('page' => $page, 'result' => $result['data'][0]));
		}
		// J.Style end
		
		$page = 'join';
		return view($page, array('page' => $page));
	}
	public function login_findpw(){
		// 20160115 J.Style
		// If prev page doesn't exist, redirect to main page.
		
		// TODO:	 session exist + prev exist?
		
		if (!isset($_SERVER['HTTP_REFERER'])){
			header("Location: http://".$_SERVER['HTTP_HOST']);
			die();
		}
		// J.Style end
		
		$page = 'login_findpw';
		return view($page, array('page' => $page));
	}
	
	public function login_changepw(){
		// 20160118 J.Style
		// If prev page doesn't exist, redirect to main page.
		
		// TODO:	 session exist + prev exist?
		
		if (!isset($_SERVER['HTTP_REFERER'])){
			header("Location: http://".$_SERVER['HTTP_HOST']);
			die();
		}
		// J.Style end
		
		$eid = Request::input('eid');
		$page = 'login_changepw';
		return view($page, array('page' => $page, 'eid' => $eid));
	}
	public function login_addinfo(){
		// 20160118 J.Style
		// If prev page doesn't exist, redirect to main page.
		
		// TODO:	 session exist + prev exist?
		
		if (!isset($_SERVER['HTTP_REFERER'])){
			header("Location: http://".$_SERVER['HTTP_HOST']);
			die();
		}
		// J.Style end
		
		$type = Request::input('type');
		$id = Request::input('id');
		$email = Request::input('email');
		$nickname = Request::input('nickname');
		$img = Request::input('img');
		
		$page = 'login_addinfo';
		return view($page, array('page' => $page, 'type' => $type, 'id' => $id, 'email' => $email, 'nickname' => $nickname, 'img' => $img));
	}
}
