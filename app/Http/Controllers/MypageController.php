<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\MemberModel;
use App\Http\models\ShipmentCustomModel;
use App\Http\models\ShipmentDomesticModel;
use Request;


class MypageController extends Controller {


	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 마이페이지 처음
	 */
	public function index()
	{		
		$memberModel = new MemberModel();
		$cusModel = new ShipmentCustomModel();
		$domModel = new ShipmentDomesticModel();
		
		if (Utility::loginStateChk(true))
		{
			$idx = $_SESSION['idx'];
			$nickname = $_SESSION['nickname'];
			$result = $memberModel->getInfoByNickname($nickname)['data'][0];
			
			$alarmDc = $cusModel->getCntDeliver($idx) + $domModel->getCntDeliver($idx);
			
			$page = 'mypage';
			return view($page, array('page' => $page, 'result' => $result, 'alarmDc' => $alarmDc));
		}
		
	}
	
	
	public function infoIndex()
	{
		$memberModel = new MemberModel();
		$domModel = new ShipmentDomesticModel();
		$cusModel = new ShipmentCustomModel();
		
		if (Utility::loginStateChk(true))
		{
			$idx = $_SESSION['idx'];
			$nickname = $_SESSION['nickname'];
			$result = $memberModel->getInfoByNickname($nickname)['data'][0];
			
			$alarmDc = $cusModel->getCntDeliver($idx) + $domModel->getCntDeliver($idx);
			
			$page = 'mypage_info';
			return view($page, array('page' => $page, 'result' => $result, 'alarmDc' => $alarmDc));
		}
	}
	
	public function deliveryIndex()
	{
		$memberModel = new MemberModel();
		$domModel = new ShipmentDomesticModel();
		$cusModel = new ShipmentCustomModel();
		
		if (Utility::loginStateChk(true))
		{
			$idx = $_SESSION['idx'];
			$nickname = $_SESSION['nickname'];
			$result = $memberModel->getInfoByNickname($nickname)['data'][0];
			
			$dbList = $cusModel->getInfoList($idx);
			$customList = array();
			foreach($dbList['data'] as $list)
			{
				$temp = array(
						'hwaNum' => $list->entry_num,
						'year' => $list->year,
						'idx' => $list->idx
				);
				
				// 배송완료 상태일 때 (추후 수정 필요?)
				if ($list->status)
				{
					$result = json_decode(file_get_contents("http://platformstory.iptime.org:8093/custom.php?year=".$list->year."&num=".$list->entry_num), true);
					$temp['data'] = $result;
					$temp['state'] = '배송완료';
					$temp['upload'] = $list->upload;
					
					array_push($temp, array());
				}
				// 배송완료가 아닐 때
				else
				{
					$result = json_decode(file_get_contents("http://platformstory.iptime.org:8093/custom.php?year=".$list->year."&num=".$list->entry_num), true);
					$temp['data'] = $result;
					$temp['state'] = $result['state'];
					$temp['upload'] = date("Y-m-d H:i:s", time());
						
					$state = 0;
					if (substr(' '.$result['state'], "완료"))
						$state = 1;
					$cusModel->update($list->idx, $temp['state']);
				}
				array_push($customList, $temp);
			}

			$dbList = $domModel->getInfoList($idx);
			$deliverList = array();
			foreach($dbList['data'] as $list)
			{
				$temp = array(
						'company' => $list->postal_agency,
						'num' => $list->postal_num,
						'prdt_name' => $list->product_name,
						'idx' => $list->idx
				);
				
				// 배송완료 상태일 때 (추후 수정 필요?)
				if ($list->status)
				{
					$result = json_decode(file_get_contents("http://platformstory.iptime.org:8093/deliver.php?company=".$list->postal_agency."&num=".$list->postal_num), true);
					$temp['data'] = $result;
					$temp['state'] = '배송완료';
					$temp['upload'] = $list->upload;
				}
				// 배송완료가 아닐 때
				else
				{
					$result = json_decode(file_get_contents("http://platformstory.iptime.org:8093/deliver.php?company=".$list->postal_agency."&num=".$list->postal_num), true);
					$temp['data'] = $result;
					$temp['state'] = $result['state'];
					$temp['upload'] = date("Y-m-d H:i:s", time());
					
					$domModel->update($list->idx, $temp['state']);
				}
				array_push($deliverList, $temp);
			}
			
			$alarmDc = $cusModel->getCntDeliver($idx) + $domModel->getCntDeliver($idx);
				
			$page = 'mypage_dc';
			return view($page, array('page' => $page, 'result' => $result, 'customList' => $customList, 'deliverList' => $deliverList, 'alarmDc' => $alarmDc));
		}
		else
			return;
		
	}

	/*
	 * 2015.11.19
	 * 작성자 : 박용호
	 * 기존 비밀번호 확인 -> 로그인 기능을 이용해 확인
	 */
	public function checkPw()
	{
		$memberModel = new MemberModel();
		
		$type = 5;
		$id = Request::input('id');
		$pw = Request::input('pw');
		
		$result = $memberModel->login($type, $id, $pw);
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 각종 정보 업데이트 -> 인덱스로 해당 회원 정보 호출 후 일부 변경, 업데이트
	 */
	public function update()
	{
		$memberModel = new MemberModel();
		
		$idx = Request::input('idx');
		$col = Request::input('col');
		$val = Request::input('val');
		
		$data = $memberModel->getInfoSingle($idx);
		
		if ($col == "email")
			$data['data'][0]->email = $val;
		else if ($col == "nickname")
			$data['data'][0]->nickname = $val;
		
		$result = $memberModel->update($idx, $data['data'][0]->nickname, $data['data'][0]->type, $data['data'][0]->email, $data['data'][0]->id);
		
		if ($result['code'] == 1 && $col == 'nickname')
			$_SESSION['nickname'] = $val;
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 비밀번호 업데이트 -> 즉시 업데이트?
	 */
	public function updatePw()
	{
		$memberModel = new MemberModel();
		
		$idx = Request::input('idx');
		$pw = Request::input('pw');
	
		$result = $memberModel->updatePw($idx, $pw);
	
		header('Content-Type: application/json');
		echo json_encode($result);
	}

}