<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\CommunityModel;
use Request;

//include ("/var/www/laravel/app/models/MemberModel.php");

class MyungSsooController extends Controller {

	/*
	 *  명수꺼, 테스트용
	 */
	


	public function index()
	{
		$model = new CommunityModel();

		$result = $model->getInfoList(array(16, 17), 3, 4);
		
		print_r($result);
	}
	
	/*
	 * 2015.11.23
	 * 작성자 : 박용호
	 * 통관번호, 년도 입력하여 현재 상태 받기 
	 */
	public function getInfo()
	{
		$num = Request::input('num');
		$year = Request::input('year');
		
		// 통관번호로 화물번호 가져오기
		$postdata = http_build_query(
			array(
				'layoutMenuNo' => '22883',
				'guBun' => '2',
				'mblNo' => '',
				'hblNo' => $num,
				'dsptDatm' => $year
			)
		);
		
		$opts = array('http' =>
			array(
				'method' => 'POST',
				'header' => 'Content-type: application/x-www-form-urlencoded; Host: /m.customs.go.kr/; User-Agent: '.$_SERVER['HTTP_USER_AGENT'],
				'content' => $postdata
			)
		);
		
		$context = stream_context_create($opts);
		$result = file_get_contents('http://m.customs.go.kr/kcshome/mobile/program/program07List.do', false, $context);
		
		// 화물번호로 배송 상태 가져오기
		$pos = strpos($result, "program07Detail");
		$str = substr($result, $pos-40);
		$pos1 = strpos($str, '<a href="') + 9;
		$str1 = substr($str, $pos1);
		$pos2 = strpos($str1, '"');
		$str2 = substr($str1, 0, $pos2);

		$opts = array(
			'http' => array(
				'method' => 'GET',
				'header' => 'Content-type: application/x-www-form-urlencoded; Host: /m.customs.go.kr/; User-Agent: '.$_SERVER['HTTP_USER_AGENT']
			)
		);
		
		$context = stream_context_create($opts);
		$str3 = str_replace('amp;','',$str2);
		$str4 = 'http://m.customs.go.kr'.$str3;
		$result = file_get_contents($str4, false, $context);
		
		
		// 화물번호 정리해서 보내기
		$result = substr($result, strpos($result, "화물관리번호<"));
		$hwaNum = substr($result, strpos($result, '40%">')+5, 20);
		
		$result = substr($result, strpos($result, "B/L<"));
		$mbl = substr($result, strpos($result, '<td>')+4, 11);
		$hbl = substr($result, strpos($result, '-')+1, 13);		
		
		$result = substr($result, strpos($result, "</thead>"));
		$send = array();
		
		
		
		
		echo ("화물번호:".$hwaNum.", M B/L:".$mbl.", H B/L:".$hbl);
	}
	
	function getInfoBaesong()
	{
		$url = Request::input('url');	
		$result = file_get_contents($url);
		
		echo ($result);
	}

}