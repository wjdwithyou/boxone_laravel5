<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\ShoppingsiteModel;
use Request;


class BestrankingController extends Controller {

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

	/*
	 *  2016.01.14
	 *  박용호
	 * 	베스트랭킹 첫 페이지
	 */
	public function index()
	{
		$ssModel = new ShoppingsiteModel();
		
		$cate = Request::input('cate', '0');
		$char = Request::input('char', '1');
				
		// 사이트 카테고리 가져오기
		$allCate = $ssModel->getCate();
		$allCate['data'] = array_slice($allCate['data'], 0, count($allCate['data'])-1);
		
		// 카테고리 별 사이트 베스트 랭킹
		$upper = $ssModel->getInfoList($cate);		
		$lower = $ssModel->getInfoListByChar($cate, $char);
		
		// 로그인 되어있을 시 북마크 체크
		if (session_id() == '')	session_start();
		if (!empty($_SESSION['idx']))
		{
			$idx = $_SESSION['idx'];
			$bookmarks = $ssModel->getInfoListBookmark($idx);
			
			for ($i = 0 ; $i < count($upper['data']) ; ++$i)
				for ($j = 0 ; $j < count($bookmarks['data']) ; ++$j)
					if ($upper['data'][$i]->idx == $bookmarks['data'][$j]->shoppingsite_idx)
						$upper['data'][$i]->bookmark = 1;
					
			for ($i = 0 ; $i < count($lower['data']) ; ++$i)
				for ($j = 0 ; $j < count($bookmarks['data']) ; ++$j)
					if ($lower['data'][$i]->idx == $bookmarks['data'][$j]->shoppingsite_idx)
						$lower['data'][$i]->bookmark = 1;
		}
		
		// 랭킹 1위 떼어내기
		if (count($upper['data']) > 0)
			$best1 = $upper['data'][0];
		else
			$best1 = null;
					
		$page = 'bestranking';
		return view($page, array('page' => $page, 'nowCate' => $cate, 'cate' => $allCate['data'], 'best1' => $best1, 'upper' => $upper['data'], 'lower' => $lower['data']));
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	베스트랭킹 내용 부분
	 *  카테고리, 문자를 받아 해당하는 사이트 목록을 보내줌
	 */
	public function sortByChar()
	{
		$ssModel = new ShoppingsiteModel();
		
		// 카테고리
		$cate = Request::input('cate', '0');
		$char = Request::input('char', '1');
		$adr_img = Request::input('adr_img');
		
		// 카테고리, 문자 별 베스트 랭킹
		$lower = $ssModel->getInfoListByChar($cate, $char);
		
		// 로그인 되어있을 시 북마크 체크
		if (session_id() == '')	session_start();
		if (!empty($_SESSION['idx']))
		{
			$idx = $_SESSION['idx'];
			$bookmarks = $ssModel->getInfoListBookmark($idx);
			
			for ($i = 0 ; $i < count($lower['data']) ; ++$i)
				for ($j = 0 ; $j < count($bookmarks['data']) ; ++$j)
					if ($lower['data'][$i]->idx."" == $bookmarks['data'][$j]->shoppingsite_idx)
						$lower['data'][$i]->bookmark = 1;
		}
		
		$page = 'bestrankingInfo';
		return view($page, array('page' => $page, 'nowCate' => $cate, 'lower' => $lower['data'], 'adr_img' => $adr_img));
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	북마크 클릭 시 사용하는 함수
	 * 	해당 회원의 해당 사이트 북마크가 없으면 북마크를 만들고, 있으면 북마크를 제거한다.
	 *  로그인 여부 체크해아 함
	 */
	public function checkBookmark()
	{
		$ssModel = new ShoppingsiteModel();
		
		if (session_id() == '')	session_start();
		if (isset($_SESSION['idx']))
		{
			$member_idx = $_SESSION['idx'];
			$shoppingsite_idx = Request::input('site');
			
			$chk = $ssModel->checkBookmark($member_idx, $shoppingsite_idx);
			if ($chk['code'] == 0)
				$result = $ssModel->createBookmark($member_idx, $shoppingsite_idx);
			else
				$result = $ssModel->deleteBookmark($member_idx, $shoppingsite_idx);
			
			header('Content-Type: application/json');
			echo json_encode($result);
		}
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	조회수 +1
	 *  cookie를 이용해서 반복적인 조회수 증가를 막으려 했으나...
	 *  일단 한 브라우저에서 10초안에는 조회수가 1이상 오르지 않음
	 */
	public function hitCountPlus()
	{
		$ssModel = new ShoppingsiteModel();
		
		if (isset($_COOKIE['bestrank_click']))
			return array('code' => 0, 'msg' => 'already clicked!');
		else
			setcookie('bestrank_click', 1, time()+10);	
		
		$idx = Request::input('idx', '0');
		$result = $ssModel->increaseHitCount($idx);
		
		return $result;
	}
}









