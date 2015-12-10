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

	public function index()
	{
		$ssModel = new ShoppingsiteModel();
		
		if (Request::has('cate'))
			$cate = Request::input('cate');
		else 
			$cate = "0";
		
		if (Request::has('char'))
			$char = Request::input('char');
		else
			$char = "1";
				
		// 사이트 카테고리 가져오기
		$allCate = $ssModel->getCate();
		
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
	
	public function sortByChar()
	{
		$ssModel = new ShoppingsiteModel();
		
		$cate = Request::input('cate');
		$char = Request::input('char');
		$adr_img = Request::input('adr_img');
		
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
	
	public function checkBookmark()
	{
		$ssModel = new ShoppingsiteModel();
		
		if (session_id() == '')	session_start();
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









