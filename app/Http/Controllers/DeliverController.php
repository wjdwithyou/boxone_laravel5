<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\ShipmentDomesticModel;
use App\Http\models\ShipmentCustomModel;
use Request;

class DeliverController extends Controller {

	
	
	public function index()
	{
		$page = 'deliver';
		return view($page, array('page' => $page));
	}
	
	/*
	 * 2015.11.23
	 * 작성자 : 박용호
	 * 통관번호, 년도 입력하여 현재 상태 받기 
	 */
	public function getInfoEntry()
	{
		$num = Request::input('num');
		$year = Request::input('year');
		
		$result = json_decode(file_get_contents("http://platformstory.iptime.org:8093/custom.php?year=$year"."&num=$num"), true);
		
		if (strpos(' '.$result['state'], "반출"))
			$result['stateNum'] = 1;
		else
			$result['stateNum'] = 0;
		
		$page = 'deliverInfo';
		return view($page, array('page' => $page, 'code' => 2, 'result' => $result));
		
		//echo ("화물번호:".$hwaNum.", M B/L:".$mbl.", H B/L:".$hbl);
	}
	
	
	/*
	 * 2015.11.23
	 * 작성자 : 박용호
	 * 배송조회
	 */
	function getInfoDelivery()
	{
		$company = trim(Request::input('company'));
		$num = Request::input('num');
		$adr_ctr = Request::input('adr_ctr');
		
		$result = json_decode(file_get_contents("http://platformstory.iptime.org:8093/deliver.php?company=$company"."&num=$num"), true);
		$result['office'] = $company;
		$result['num'] = $num;
		
		if (strpos(' '.$result['state'], "완료"))
			$result['stateNum'] = 1;
		else
			$result['stateNum'] = 0;			
		
		array_push($result, array());
		
		$page = 'deliverInfo';
		return view($page, array('page' => $page, 'code' => 1, 'result' => $result, 'adr_ctr' => $adr_ctr));
	}

	
	/*
	 * 2015.11.23
	 * 작성자 : 박용호
	 * 배송조회 저장
	 */
	public function createDelivery()
	{
		$sdModel = new ShipmentDomesticModel(); 
		
		$office = Request::input('office');
		$num = Request::input('num');
		$prdt = Request::input('prdt');
		$state = Request::input('state');
		
		if (session_id() == '') 	session_start();
		$member_idx = $_SESSION['idx'];
		
		$result = $sdModel->create(trim($prdt), $num, $office, $member_idx, $state);
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	
	/*
	 * 2015.11.23
	 * 작성자 : 박용호
	 * 통관조회 저장
	 */
	public function createEntry()
	{
		$scModel = new ShipmentCustomModel();
	
		$num = Request::input('num');
		$year = Request::input('year');
		$state = Request::input('state');
	
		if (session_id() == '') 	session_start();
		$member_idx = $_SESSION['idx'];
	
		$result = $scModel->create($num, $year, $member_idx, $state);
	
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	/*
	 *  배송 삭제
	 */
	public function deleteDelivery()
	{
		$sdModel = new ShipmentDomesticModel(); 
		
		$idx = Request::input('idx');
		
		if (session_id() == '') 	session_start();
		$member_idx = $_SESSION['idx'];
		
		$info = $sdModel->getInfoSingle($idx);
		if (count($info) && $info[0]->member_idx == $member_idx)
			$result = $sdModel->delete($idx);
		else 
			$result = array('code' => 0);		
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	/*
	 *  통관 삭제
	 */
	public function deleteEntry()
	{
		$scModel = new ShipmentCustomModel();
	
		$idx = Request::input('idx');
	
		if (session_id() == '') 	session_start();
		$member_idx = $_SESSION['idx'];
		
		$info = $scModel->getInfoSingle($idx);
		if (count($info) && $info[0]->member_idx == $member_idx)
			$result = $scModel->delete($idx);
		else
			$result = array('code' => 0);
	
		header('Content-Type: application/json');
		echo json_encode($result);
	}

}




