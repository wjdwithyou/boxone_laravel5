<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\ProductModel;
use App\Http\models\HotdealProductModel;
use App\Http\models\CategoryModel;
use Request;
use Cookie;

class ShoppingboxController extends Controller {



	public function index()
	{
		$cateModel = new CategoryModel();
		$prdtModel = new ProductModel();
		$hotPrdtModel = new HotdealProductModel();
		
		// 정렬 방식 가져오기, 검사	(1, 2, 3, 5)
		$sort = Request::input('sort', '1');
		if (session_id() == '')	session_start();
		if ($sort == '5' && empty($_SESSION['idx']))
			$sort = '1';
		
		// 브랜드 가져오기
		$brand = array();
		if (Request::has('brand'))
			$brand = json_decode(Request::input('brand'), true);
		
		// 사이트 가져오기
		$mall = array();
		if (Request::has('mall'))
			$mall = json_decode(Request::input('mall'), true);
		
		// 검색어 가져오기
		$search = Request::input('search', '');
		$searchText = array();
		if ($search != '')
			$searchText = explode(' ', $search);
		
		// 카테고리 가져오기, 검사 (0은 전체)
		$cate = Request::input('cate', 'l0');
		
		// 클리어런스
		if ($cate == 'c')
		{
			$cateIdx = $cateListIdx = 0;
			$cateDepth = -1;
			
			$tempList = $cateModel->getInfoListLarge();
			$cateList = array(array("l0", "전체", 0), array("c", "클리어런스", 1));
			foreach($tempList['data'] as $list)
				array_push($cateList, array("l".$list->idx, $list->name, 0));
				
			$cate = array(array("c", "클리어런스"));
		}
		// 전체
		else if ($cate == 'l0')
		{
			$cateIdx = $cateListIdx = 0;
			$cateDepth = 0;
				
			$tempList = $cateModel->getInfoListLarge();
			$cateList = array(array("l0", "전체", 0), array("c", "클리어런스", 0));
			foreach($tempList['data'] as $list)
				array_push($cateList, array("l".$list->idx, $list->name, 0));
		
			$cate = array(array("l0", "전체"));
		}
		// 카테고리 대분류
		else if (strpos(" ".$cate, 'l'))
		{
			$cateIdx = $cateListIdx = substr($cate, 1);
			$cateDepth = 1;
			
			$tempList = $cateModel->getInfoListMedium($cateIdx);
			$cateList = array(array($cate, "전체", 0));
			foreach($tempList['data'] as $list)
				array_push($cateList, array("m".$list->idx, $list->name, 0));
				
			$cateName = $cateModel->getCateName($cateDepth, $cateIdx);
			$cate = array(array($cate, $cateName['data'][0]->name));
		}
		// 카테고리 중분류
		else if (strpos(" ".$cate, 'm'))
		{
			$cateIdx = $cateListIdx = substr($cate, 1);
			$cateDepth = 2;
			
			$tempList = $cateModel->getInfoListSmall($cateIdx);
			$cateList = array(array($cate, "전체", 0));
			foreach($tempList['data'] as $list)
				array_push($cateList, array("s".$list->idx, $list->name, 0));
				
			$temp = $cateModel->getCateName(2, $cateIdx);
			
			$cate = array(array("l".$temp['data'][0]->large_idx, $temp['data'][0]->large_name),
					array($cate, $temp['data'][0]->name));

		}
		// 카테고리 소분류
		else if (strpos(" ".$cate, 's'))
		{
			$cateIdx = substr($cate, 1);
			$cateDepth = 3;
			
			$temp = $cateModel->getCateName(3, $cateIdx);
			$cateIdx_m = $cateListIdx = $temp['data'][0]->medium_idx;
			$tempList = $cateModel->getInfoListSmall($cateIdx_m);
			$cateList = array(array("m$cateIdx_m", "전체", 0));
			foreach($tempList['data'] as $list)
				if ($list->idx == $cateIdx)
					array_push($cateList, array("s".$list->idx, $list->name, 1));
				else
					array_push($cateList, array("s".$list->idx, $list->name, 0));
			
			$tempData = $temp['data'][0];
			$cate = array(array("l".$tempData->large_idx, $tempData->large_name),
					array("m".$tempData->medium_idx, $tempData->medium_name),
					array("s".$tempData->idx, $tempData->name));
		}
		
		// 페이지 검사
		$nowPage = Request::input('page', 1);
		
		// 상품, 카테고리별 상품 갯수 가져오기
		if ($sort != '5')
		{
			if ($cateDepth == -1)
				$result = $hotPrdtModel->getInfoList($sort, 0, 0, $brand, $mall, $searchText, $nowPage);
			else
				$result = $prdtModel->getInfoList($sort, $cateDepth, $cateIdx, $brand, $mall, $searchText, $nowPage);
			$cntList = $prdtModel->getPrdtCnt($cateDepth, $cateListIdx, $brand, $mall, $searchText, 0);
		}
		else
		{
			$mem_idx = $_SESSION['idx'];
			if ($cateDepth == -1)
				$result = $hotPrdtModel->getMyList($mem_idx, 0, 0, $brand, $mall, $searchText, $nowPage);
			else
				$result = $prdtModel->getMyList($mem_idx, $cateDepth, $cateIdx, $brand, $mall, $searchText, $nowPage);
			$cntList = $prdtModel->getPrdtCnt($cateDepth, $cateListIdx, $brand, $mall, $searchText, $mem_idx);
		}
				
		if (!($result['code']))
		{
			$result['maxPage'] = $nowPage = 1;
			$result['data'] = array();
			$result['brandList'] = array();
			$result['mallList'] = array();
			$result['prdtCnt'] = 0;
		}

		// 현재 체크된 브랜드 선택
		foreach($result['brandList'] as $brandList)
		{
			$brandList->checked = 0;
			foreach($brand as $list)
				if ($brandList->brand == $list)
				{
					$brandList->checked = 1;
					break;
				}
		}
		
		// 현재 체크된 브랜드 선택
		foreach($result['mallList'] as $mallList)
		{
			$mallList->checked = 0;
			foreach($mall as $list)
				if ($mallList->mall_id == $list)
				{
					$mallList->checked = 1;
					break;
				}
		}
			
		$paging = array('now' => $nowPage, 'max' => $result['maxPage']);
		
		$page = 'shoppingbox';
		$data = array(
				'page' => $page,
				'search' => $search,
				'cateList' => $cateList,
				'nowCate' => $cate,
				'sort' => $sort,
				'brandList' => $result['brandList'],
				'mallList' => $result['mallList'],
				'paging' => $paging,
				'prdtCnt' => $result['prdtCnt'],
				'cntList' => $cntList,
				'prdt' => $result['data']
		);
		return view($page, $data);
	}
	
	

	public function detail()
	{
		$cateModel = new CategoryModel();
		$prdtModel = new ProductModel();
	
		$idx = Request::input('idx');
		$result = $prdtModel->getInfoSingle($idx);
	
		$cateS = $result['data']['cate'];
		$data = $cateModel->downToUp($cateS);
		
		// 리뷰 가져오기
		$reviewList = $prdtModel->getReview($idx);
		
		// 동일 상품 가져오기
		$sameList = $prdtModel->getMappingPrdt($result['data']['binding']);
		
		// 최하단 '이런 상품 어떠세요?' 가져오기
		$suggestList = $prdtModel->getSuggestPrdt($cateS, $idx);
		
		// 최근 본 상품의 카테고리를 cookie로 가지고 다닌다.
		$cookie = Request::cookie('recentCate');
		if ($cookie == '')
			$cookieArray = array();
		else
		{
			$cookieArray = json_decode($cookie, true);
			// cookie 임의 변경 시 자동 초기화
			if (json_last_error() != JSON_ERROR_NONE)
				$cookieArray = array();
		}
		array_push($cookieArray, $data['data'][0]->lidx);
		if (count($cookieArray) > 10)
			$cookieArray = array_slice($cookieArray, 1, 10);
		
		$json_cookie = json_encode($cookieArray);
		Cookie::queue('recentCate', $json_cookie);
		
		// 최근 본 상품의 정보 (idx, name, brand, img, price)를 가지고 다닌다.
		$cookie = Request::cookie('recentPrdt');
		if ($cookie == '')
			$cookieArray = array();
		else 
		{
			$cookieArray = json_decode($cookie, true);
			// cookie 임의 변경 시 자동 초기화
			if (json_last_error() != JSON_ERROR_NONE)
				$cookieArray = array();
		}
		array_push($cookieArray, array('p', $result['data']['idx']));
		if (count($cookieArray) > 10)
			$cookieArray = array_slice($cookieArray, 1, 10);
		
		$json_cookie = json_encode($cookieArray);
		Cookie::queue('recentPrdt', $json_cookie);
		
		// 출력
		$page = 'product';
		return view($page, array(
				'page' => $page, 
				'result' => $result['data'], 
				'reviewList' => $reviewList['data'],
				'sameList' => $sameList['data'],
				'suggestList' => $suggestList['data'],
				'rate' => array($reviewList['rateAve'], $reviewList['rateBest'], $reviewList['rateCnt']),
				'cate' => $data['data'][0]
		));
	}

}

