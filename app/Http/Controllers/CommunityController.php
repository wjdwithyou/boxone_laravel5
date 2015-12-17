<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\CommunityModel;
use Request;

class CommunityController extends Controller {

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
		$cmModel = new CommunityModel();
		
		if (Request::has('cate'))
			$cate = Request::input('cate');
		else
			$cate = "전체";
		
		$cateL = $cmModel->getLargeCategory();
		
		if ($cate == "전체")
			$cateS = $cmModel->getLargeCategory();
		else
			$cateS = $cmModel->getSmallCategory($cate);		
		
		$page = 'community';
		return view($page, array('page' => $page, 'cate' => $cate, 'cateL' => $cateL['data'], 'cateS' => $cateS['data']));
	}
	
	public function getInfo()
	{
		$cmModel = new CommunityModel();
		
		$cate = json_decode(Request::input('cate'));
		$adr_img = Request::input('adr_img');
		$page_type = Request::input('page_type');
		$paging = Request::input('paging');
		
		if (!is_numeric($cate[0]))
		{
			$temp = array();
			
			if ($cate[0] != "전체")
			{				
				foreach($cate as $list)
				{
					$data = $cmModel->getSmallCategory($list);
					foreach($data['data'] as $idx)
						array_push($temp, $idx->idx);
				}
			}
			$cate = $temp;
		}

		$result = $cmModel->getInfoList($cate, $paging);
		
		
		//print_r ($result);
		
		$page = 'communityInfo';
		return view($page, array('page' => $page, 'result' => $result['data'], 'adr_img' => $adr_img, 'page_type' => $page_type, 'paging' => $result['paging']));
	}
	
	public function write()
	{
		$page = 'community_write';
		return view($page, array('page' => $page));
	}
}