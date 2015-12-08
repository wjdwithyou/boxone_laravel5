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
		
		// 카테고리 검사
		$cateList = $categoryModel->getInfoListLarge();
		
		$cate = '0';
		if (Request::has('cate'))
			$cate = Request::input('cate');
		if ($cate > count($cateList))
			$cate = '0';
				
		
		// 페이지 검사
		$maxPage = floor(($hotdealModel->getResultSize($cate)-1) / 30) + 1;
		
		$nowPage = '1';
		if (Request::has('page'))
			$nowPage = Request::input('page');
		if ($maxPage < $nowPage)
			$nowPage = $maxPage;
		
		// 정렬 방식 가져오기
		$sort = '1';
		if (Request::has('sort'))
			$sort = Request::input('sort');
		
		// 핫딜 데이터 가져오기
		$result = $hotdealModel->getInfoHotdeal($cate, $sort, $maxPage, $nowPage);
		
		// 현재 카테고리 이름 가져오기
		$name = "전체";
		for ($i = 0 ; $i < count($cateList['data']) ; $i++)
			if ($cateList['data'][$i]->idx == $cate)
				$name = $cateList['data'][$i]->name;
		
		$nowCate = array('idx' => $cate, 'name' => $name);
		$paging = array('now' => $nowPage, 'max' => $maxPage);
		
		$page = 'hotdeal';
		return view($page, array('page' => $page, 'type' => '코드', 'cateList' => $cateList['data'], 'nowCate' => $nowCate, 'sort' => $sort, 'prdt' => $result['data'], 'paging' => $paging));
	}
	
	public function hitCountPlus()
	{
		$hotdealModel = new HotdealTargetModel();
		
		$idx = Request::input('idx');
		$result = $hotdealModel->updateHitCount($idx);
		
		return $result;
	}
	
	
}