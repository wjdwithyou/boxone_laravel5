<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\HotdealTargetModel;
use App\Http\models\CategoryModel;
use Request;

class HotdealController extends Controller {

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

	public function main()
	{
		$page = 'hotdeal_main';
		return view($page, array('page' => $page));
	}
	
	public function indexProduct()
	{
		$page = 'hotdeal';
		return view($page, array('page' => $page));
	}
	
	public function indexCode()
	{
		$hotdealModel = new HotdealTargetModel();
		$categoryModel = new CategoryModel();
		
		// 정렬 방식 가져오기
		$sort = '1';
		if (Request::has('sort'))
			$sort = Request::input('sort');
		if (session_id() == '')	session_start();
		if ($sort == '5' && empty($_SESSION['idx']))
			$sort = 1;
		
		// 카테고리 검사
		$cateList = $categoryModel->getInfoListLarge();
		
		$cate = '0';
		if (Request::has('cate'))
			$cate = Request::input('cate');
		if ($cate > count($cateList))
			$cate = '0';
		
		// 현재 카테고리 이름 가져오기
		$name = "전체";
		for ($i = 0 ; $i < count($cateList['data']) ; $i++)
			if ($cateList['data'][$i]->idx == $cate)
				$name = $cateList['data'][$i]->name;
				
		// 5번이면 내 상품 가져오기
		if ($sort == '5' || $sort == 5)
		{
			// 페이지 검사
			$maxPage = 1;
			$nowPage = 1;

			$result = $hotdealModel->getMyHotdeal($_SESSION['idx'], 0);
		}
		else	// 5번 아니면 정렬, 페이지 기준에 따라 
		{
			// 페이지 검사
			$maxPage = floor(($hotdealModel->getResultSize($cate)-1) / 30) + 1;
			
			$nowPage = '1';
			if (Request::has('page'))
				$nowPage = Request::input('page');
			if ($maxPage < $nowPage)
				$nowPage = $maxPage;
			
			// 핫딜 데이터 가져오기
			$result = $hotdealModel->getInfoHotdeal($cate, $sort, $maxPage, $nowPage);
			
			// 로그인 되어있을 시 북마크 체크
			if (!empty($_SESSION['idx']))
			{
				$idx = $_SESSION['idx'];
				$bookmarks = $hotdealModel->getInfoListBookmark($idx);
			
				for ($i = 0 ; $i < count($result['data']) ; ++$i)
					for ($j = 0 ; $j < count($bookmarks['data']) ; ++$j)
						if ($result['data'][$i]->idx == $bookmarks['data'][$j]->hotdeal_idx)
							$result['data'][$i]->bookmark = 1;
			}
			
		}
			
		$nowCate = array('idx' => $cate, 'name' => $name);
		$paging = array('now' => $nowPage, 'max' => $maxPage);
		
		$page = 'hotdeal';
		return view($page, array('page' => $page, 'type' => '코드', 'cateList' => $cateList['data'], 'nowCate' => $nowCate, 'sort' => $sort, 'prdt' => $result['data'], 'paging' => $paging));
	}
	
	public function hitCountPlus()
	{
		$hotdealModel = new HotdealTargetModel();
		
		if (isset($_COOKIE['click']))
			return array('code' => 0, 'msg' => 'already clicked!');
		else
			setcookie('click', 1, time()+5);	
		
		$idx = Request::input('idx');
		$result = $hotdealModel->updateHitCount($idx);
		
		return $result;
	}
	
	public function hotdealBookmark()
	{
		$hotdealModel = new HotdealTargetModel();
		
		if (session_id() == '')	session_start();
		$member_idx = $_SESSION['idx'];
		$hotdeal_idx = Request::input('idx');
		
		$result = $hotdealModel->checkBookmark($member_idx, $hotdeal_idx); 
		
		if ($result['code'])
			$hotdealModel->createBookmark($member_idx, $hotdeal_idx, 0);
		else
			$hotdealModel->deleteBookmark($member_idx, $hotdeal_idx);
		
		header('Content-Type: application/json');
		return json_encode($result);
	}
	
}