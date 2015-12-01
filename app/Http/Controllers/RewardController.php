<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\RewardModel;
use Request;

class RewardController extends Controller {

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
		$page = 'reward';
		return view($page, array('page' => $page));
	}
	
	public function searchReward()
	{
		$rewardModel = new RewardModel();
		$text = Request::input('text');
		$adr_img = Request::input('adr_img');
		
		$data = $rewardModel->getInfoListByTarget($text);
		$data = $data['data'];
		
		// 타깃 사이트별로 정렬
		if (count($data) > 1)
		{
			$pre_site = $data[0]->target_site;
			$result = array();
			$i = 1;
			while (count($data) > $i)
			{
				$now_site = $data[$i]->target_site;
				
				if ($now_site != $pre_site)
				{
					array_push($result, array_slice($data, 0, $i));
					$data = array_slice($data, $i);
					$i = 1;
					$pre_site = $now_site;
				}
				else 
					$i++;
			}
		}
		
		$page = 'rewardInfo';
		return view($page, array('page' => $page, 'reward' => $result, 'adr_img' => $adr_img));
	}
}