<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\ProductModel;
use App\Http\models\CategoryModel;
use Request;

class ShoppingboxController extends Controller {

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
		$cateModel = new CategoryModel();
		$prdtModel = new ProductModel();
		
		// 정렬 방식 가져오기, 검사	(1, 2, 3, 5)
		$sort = '1';
		if (Request::has('sort'))
			$sort = Request::input('sort');
		if (session_id() == '')	session_start();
		if ($sort == '5' && empty($_SESSION['idx']))
			$sort = 1;
		
		// 카테고리 가져오기, 검사 (0은 전체)
		$cate = 'l0';
		if (Request::has('cate'))
			$cate = Request::input('cate');
		
		if ($cate == 'l0')
			$cateDepth = 0;
		else if (strpos(" ".$cate, 'l'))
		{
			$cateL = substr($cate, 1);
			$cateDepth = 1;
		}
		else if (strpos(" ".$cate, 'm'))
		{
			$cateM = substr($cate, 1);
			$cateDepth = 2;
		}
		else if (strpos(" ".$cate, 's'))
		{
			$cateS = substr($cate, 1);
			$cateDepth = 3;
		}
		
		$getCateList = array();

		if ($cateDepth == 1)
		{
			$tempList = $cateModel->getInfoListMedium($cateL);
			$cateList = array(array("l$cateL", "전체"));
			foreach($tempList['data'] as $list)
				array_push($cateList, array("m".$list->idx, $list->name, 0));
			
			$temp = $cateModel->upToDown($cateL);
			if (count($temp['data']))
			{
				foreach($temp['data'] as $list)
					array_push($getCateList, $list->sidx);
				
				$cate = array(array("l".$cateL, $temp['data'][0]->lname));
			}
			else 
				$cateDepth = 0;
		}
		else if ($cateDepth == 2)
		{
			$tempList = $cateModel->getInfoListSmall($cateM);
			$cateList = array(array("m$cateM", "전체"));
			foreach($tempList['data'] as $list)
				array_push($cateList, array("s".$list->idx, $list->name, 0));
			
			foreach($cateList['data'] as $list)
				array_push($getCateList, $list->idx);
			
			$temp2 = $cateModel->getCateName(2, $cateM);
			$temp1 = $cateModel->getCateName(1, $temp2['data'][0]->large_idx);

			if (count($temp1['data']) > 0 && count($temp2['data']) > 0)
				$cate = array(array("l".$temp1['data'][0]->idx, $temp1['data'][0]->name), 
							  array("m".$cateM, $temp2['data'][0]->name));
			else 
				$cateDepth = 0;
			
		}
		else if ($cateDepth == 3)
		{
			$tempList = $cateModel->getInfoListSmall($cateM);
			$cateList = array(array("m$cateM", "전체"));
			foreach($tempList['data'] as $list)
				if ($list->idx == $cateS)
					array_push($cateList, array("s".$list->idx, $list->name, 1));
				else
					array_push($cateList, array("s".$list->idx, $list->name, 0));
				
			array_push($getCateList, $cateS);
			
			$temp = $cateModel->downToUp($cateS);
			if (count($temp['data']))
			{
				$tempData = $temp['data'][0];
				$cate = array(array("l".$tempData->lidx, $tempData->lname), 
							  array("m".$tempData->midx, $tempData->mname), 
							  array("s".$tempData->sidx, $tempData->sname));
			}
			else
				$cateDepth = 0;
		}
		if ($cateDepth == 0)
		{
			$tempList = $cateModel->getInfoListLarge();
			$cateList = array(array("l0", "전체"));
			foreach($tempList['data'] as $list)
				array_push($cateList, array("l".$list->idx, $list->name));
			
			$cate = array("l0", "전체");
		}
		
		// 페이지 검사
		$nowPage = '1';
		if (Request::has('page'))
			$nowPage = Request::input('page');
		
		$result = $prdtModel->getInfoList($sort, $getCateList, $nowPage);
		
		$paging = array('now' => $nowPage, 'max' => $result['maxPage']);
		
		$page = 'shoppingbox';
		$data = array(
				'page' => $page,
				'cateList' => $cateList,
				'nowCate' => $cate,
				'sort' => $sort,
				'paging' => $paging,
				'prdt' => $result['data']
		);
		return view($page, $data);
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
}