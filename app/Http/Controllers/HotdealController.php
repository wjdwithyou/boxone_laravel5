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
		
		// 정렬 방식 가져오기, 검사	(1, 2, 3, 5)
		$sort = '1';
		if (Request::has('sort'))
			$sort = Request::input('sort');
		if (session_id() == '')	session_start();
		if ($sort == '5' && empty($_SESSION['idx']))
			$sort = 1;
		
		// 카테고리 가져오기, 검사	(0은 전체)		
		$cate = '0';
		if (Request::has('cate'))
			$cate = Request::input('cate');
		$cateList = $categoryModel->getInfoListLarge();
		if ($cate > count($cateList['data']))
			$cate = '0';
		
		// 사이트 가져오기, 검사 (전체는 0)
		$site = "0";
		if (Request::has('site'))
			$site = Request::input('site');
		
		// 페이지 검사
		$nowPage = '1';
		if (Request::has('page'))
			$nowPage = Request::input('page');
		
		// 현재 카테고리 이름 가져오기
		$name = "전체";
		for ($i = 0 ; $i < count($cateList['data']) ; $i++)
			if ($cateList['data'][$i]->idx == $cate)
				$name = $cateList['data'][$i]->name;
				
			
		// 내 북마크 핫딜, 전체 핫딜 분기
		if ($sort == '5' || $sort == 5)
		{
			$result = $hotdealModel->getMyHotdeal($_SESSION['idx'], $cate, $site, '1', $nowPage, 0);
		}
		else	// 5번 아니면 정렬, 페이지 기준에 따라 
		{			
			// 핫딜 데이터 가져오기
			$result = $hotdealModel->getInfoHotdeal($cate, $site, $sort, $nowPage);
			
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
		
		if ($result['code'] == '0')
		{
			$result['maxPage'] = 1;
			$result['company'] = array();
			$result['data'] = array();
		}
		
		$nowCate = array('idx' => $cate, 'name' => $name);
		$paging = array('now' => $nowPage, 'max' => $result['maxPage']);
		
		$page = 'hotdeal';
		$data = array(
				'page' => $page, 
				'type' => '코드', 
				'cateList' => $cateList['data'],
				'company' => $result['company'],
				'nowCate' => $nowCate,
				'site' => $site,
				'sort' => $sort,
				'paging' => $paging,
				'prdt' => $result['data'] 
		);
		return view($page, $data);
	}
	
	public function hitCountPlus()
	{
		$hotdealModel = new HotdealTargetModel();
		
		if (isset($_COOKIE['hotdeal_click']))
			return array('code' => 0, 'msg' => 'already clicked!');
		else
			setcookie('hotdeal_click', 1, time()+5);	
		
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