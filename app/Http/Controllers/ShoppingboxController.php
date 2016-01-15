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
			$cateList = array(array("l$cateL", "전체", 0));
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
			$cateList = array(array("m$cateM", "전체", 0));
			foreach($tempList['data'] as $list)
				array_push($cateList, array("s".$list->idx, $list->name, 0));
			
			foreach($tempList['data'] as $list)
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
			$temp = $cateModel->getCateName(3, $cateS);
			$cateM = $temp['data'][0]->medium_idx;
			$tempList = $cateModel->getInfoListSmall($cateM);
			$cateList = array(array("m$cateM", "전체", 0));
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
			$cateList = array(array("l0", "전체", 0));
			foreach($tempList['data'] as $list)
				array_push($cateList, array("l".$list->idx, $list->name, 0));
			
			$cate = array(array("l0", "전체"));
		}
		
		// 페이지 검사
		$nowPage = '1';
		if (Request::has('page'))
			$nowPage = Request::input('page');
		
		if ($sort != '5')
			$result = $prdtModel->getInfoList($sort, $getCateList, $nowPage);
		else
			$result = $prdtModel->d();
		
		if (!($result['code']))
		{
			$result['maxPage'] = $nowPage = 1;
			$result['data'] = array();
		}
			
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
	
	

	public function detail()
	{
		$cateModel = new CategoryModel();
		$prdtModel = new ProductModel();
	
		$idx = Request::input('idx');
		$result = $prdtModel->getInfoSingle($idx);
	
		$cateS = $result['data']['cate'];
		$data = $cateModel->downToUp($cateS);
	
		$page = 'product';
		return view($page, array('page' => $page, 'result' => $result['data'], 'cate' => $data['data'][0]));
	}
	
}