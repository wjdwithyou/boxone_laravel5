<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\ShoppingsiteModel;
use App\Http\models\HotdealProductModel;
use App\Http\models\ProductModel;

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
		
		// 인기 쇼핑몰 랭킹 (쇼핑사이트 조회수로 10개) 가져오기
		$result = $siteModel->getInfoList(0);
		$siteList = array_slice($result['data'], 0, 10);
		
		// 핫한 상품 (쇼핑박스 중 할인되는 것, 조회수 10개) 가져오기
		$result = $hotPrdtModel->getInfoList(1, array(), 1);
		$hotList = array_slice($result['data'], 0, 8);
		//$hotList = array();
		
		// 쇼핑 박스 (쇼핑박스 최신 순 20개) 가져오기
		$result = $prdtModel->getInfoList(1, array(), 1);
		$prdtList = $result['data'];
		
		$page = 'main';
		return view($page, array('page' => $page, 'siteList' => $siteList, 'hotList' => $hotList, 'prdtList' => $prdtList));
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
	public function love(){
		return view('love');
	}
	public function bookmark(){
		return view('bookmark');
	}
	public function recently(){
		return view('recently');
	}
}