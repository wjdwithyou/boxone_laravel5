<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Request;
use App\Http\models\CategoryModel;
use App\Http\models\ProductModel;

class ProductController extends Controller {

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
		$page = 'product';
		return view($page, array('page' => $page));
	}
	
	public function getPrdtList()
	{
		$categoryModel = new CategoryModel();
		$prdtModel = new ProductModel();
		
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
		
		// 페이지 검사
		$nowPage = '1';
		if (Request::has('page'))
			$nowPage = Request::input('page');
		
		// 현재 카테고리 이름 가져오기
		$name = "전체";
		for ($i = 0 ; $i < count($cateList['data']) ; $i++)
			if ($cateList['data'][$i]->idx == $cate)
				$name = $cateList['data'][$i]->name;
		
		// 쇼핑박스 상품 목록 보기
		/*if ($sort == '5' || $sort == 5)
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
				
		}*/
		
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
	
	public function getPrdtDetail()
	{
		$prdtModel = new ProductModel();
		
		$idx = Request::input('idx');
		$result = $prdtModel->getSingleInfo($idx);
		
		$page = 'product';
		return view($page, array('page' => $page));
	}
}






