<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\RewardModel;
use Request;

class RewardController extends Controller {

	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 리워드 초기 페이지
	 */
	public function index()
	{
		$page = 'reward';
		return view($page, array('page' => $page));
	}
	
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 리워드 검색 결과
	 */
	public function searchReward()
	{
		$rewardModel = new RewardModel();
		
		// 리워드 검색어
		$text = Request::input('text', '');
		$adr_img = Request::input('adr_img');
		
		// 검색어로 리워드 검색
		$data = $rewardModel->getInfoListByTarget($text);
		$data = $data['data'];
		
		// 타깃 사이트별로 정렬 (Amazon.com, 등등 끼리 모음)
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
		else 
			$result = array();
		
		$page = 'rewardInfo';
		return view($page, array('page' => $page, 'reward' => $result, 'adr_img' => $adr_img));
	}
}