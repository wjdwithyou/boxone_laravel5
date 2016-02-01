<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\ShoppingsiteModel;
use App\Http\models\HotdealProductModel;
use App\Http\models\ProductModel;
use App\Http\models\CategoryModel;
use Request;

class MainController extends Controller {

	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 메인 페이지 출력, 미완
	 */
	public function index()
	{
		$siteModel = new ShoppingsiteModel();
		$hotPrdtModel = new HotdealProductModel();
		$prdtModel = new ProductModel();
		$cateModel = new CategoryModel();
		
		// 인기 쇼핑몰 랭킹 (쇼핑사이트 조회수로 10개) 가져오기
		$siteList = $siteModel->getBestSiteByCate();
		
		// 핫한 상품 (쇼핑박스 중 할인되는 것, 조회수 10개) 가져오기
		$result = $hotPrdtModel->getInfoList(1, 0, 0, array(), array(), array(), 1);
		$hotBigList = array_slice($result['data'], 0, 8);
		$hotList = array_slice($result['data'], 8, 8);
		//$hotList = array();
		
		// 쇼핑 박스 저장한 카테고리 수(쿠키) 확인 후, 우선순위 확인하여 가져오기
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
		$cookieValue = array(
				1 => 0,
				2 => 0,
				3 => 0,
				4 => 0,
				5 => 0,
				6 => 0,
				7 => 0,
		);
		foreach ($cookieArray as $list)
			$cookieValue[$list]++;
		arsort($cookieValue);
		$cateArray = array_keys($cookieValue);
		
		$prdtList = array();
		foreach($cateArray as $list)
		{
			// 상품 가져오기
			$temp = $prdtModel->getInfoList(1, 1, $list, array(), array(), array(), 1);
			
			if ($temp['code'] == 1)
			{
				$cateName = $cateModel->getCateName(1, $list);
				$temp = array_slice($temp['data'], 0, 10);
				$temp['cateName'] = $cateName['data'][0]->name;
				array_push($prdtList, $temp);
			}			
		}
		
		$page = 'main';
		return view($page, array('page' => $page, 'siteList' => $siteList, 'hotList' => $hotList, 'hotBigList' => $hotBigList, 'prdtList' => $prdtList));
	}
		
	public function deliver(){
		return view('deliver');
	}
	
	public function deliverInfo(){
		return view('deliverInfo');
	}
	
	public function calculator(){
		return view('calculator');
	}
	
	public function recently(){
		$cookie = Request::cookie('recentPrdt');
		
		if ($cookie == '')
			$cookieArray = array();
		else{
			$cookieArray = json_decode($cookie, true);
			
			if (json_last_error() != JSON_ERROR_NONE)
				$cookieArray = array();
		}
		
		return $cookieArray[9][0];
		/*
		// tt start
		// 쇼핑 박스 저장한 카테고리 수(쿠키) 확인 후, 우선순위 확인하여 가져오기
	
		$cookieValue = array(
				1 => 0,
				2 => 0,
				3 => 0,
				4 => 0,
				5 => 0,
				6 => 0,
				7 => 0,
		);
		foreach ($cookieArray as $list)
			$cookieValue[$list]++;
		arsort($cookieValue);
		$cateArray = array_keys($cookieValue);
		// tt end
		*/
		
		
		$page = 'aside_recently';
		return view($page, array('data' => $data));
		
		//return view('aside_recently');
	}
	
	public function bookmark(){
		return view('aside_bookmark');
	}
}