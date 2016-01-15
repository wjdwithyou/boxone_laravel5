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
		
		$page = 'deliverInfo';
		
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
		$html = file_get_contents('http://m.customs.go.kr/kcshome/mobile/program/program07List.do', false, $context);
		
		if (strpos($html, "자료가 없습니다"))
			return view($page, array('page' => $page, 'code' => 0));
		
		// 화물번호로 배송 상태 가져오기
		$pos = strpos($html, "program07Detail");
		$str = substr($html, $pos-40);
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
		$html = file_get_contents($str4, false, $context);
		
		
		// 화물번호 정리해서 보내기
		$result = array();
		$result['year'] = substr($year, 0, 4);
		
		$html = substr($html, strpos($html, "화물관리번호<"));
		$result['hwaNum'] = substr($html, strpos($html, '40%">')+5, 20);
		
		$html = substr($html, strpos($html, "B/L<"));
		$result['mbl'] = substr($html, strpos($html, '<td>')+4, 11);
		$result['hbl'] = substr($html, strpos($html, '-')+1, 13);
		
		$html = substr($html, strpos($html, "<tr"));
		$html = substr($html, strpos($html, "<td>") + 4);
		$result['state'] = substr($html, 0, strpos($html, "</td>"));
		
		$html = substr($html, strpos($html, "</thead>"));
		$info = array();
		while (strpos($html, "<tr>"))
		{
			$temp = array();
			
			$html = substr($html, strpos($html, "<tr>"));
			
			// 상태
			$html = substr($html, strpos($html, "<td>") + 4);
			$temp['state'] = trim(substr($html, 0, strpos($html, "<")));
			
			// 날짜
			$html = substr($html, strpos($html, "<td>") + 4);
			$html = substr($html, strpos($html, "<td>") + 4);
			$temp['date'] = trim(substr($html, 0, strpos($html, " ")));
			
			// 시간
			$html = substr($html, strpos($html, " ") + 1);
			$temp['time'] = trim(substr($html, 0, strpos($html, "<")));
			
			// 업체명
			$html = substr($html, strpos($html, "<td>") + 4);
			$temp['name'] = trim(substr($html, 0, strpos($html, "<")));
			
			array_push($info, $temp);
		}
		
		$result[0] = array_reverse($info);
		
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
		$company = Request::input('company');
		$num = Request::input('num');
		$adr_ctr = Request::input('adr_ctr');
		
		$page = 'deliverInfo';
		
		$result = array();
		
		$result['office'] = $company;
		$result['num'] = $num;
		
		if ($company == "CJ대한통운")
		{
			$postdata = "fsp_action=PARC_ACT_002&fsp_cmd=retrieveInvNoACT&invc_no=$num&nextpage=parcel%2Fpa_004_r.jsp";
				
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://www.doortodoor.co.kr/main/doortodoor.do");
			//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			//curl_setopt($ch, CURLOPT_SSLVERSION, 3);
			curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'SSLv3');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			ob_start();
			$res = curl_exec($ch);
			$buffer = ob_get_contents();
			ob_end_clean();
			if (!$buffer)
			{
				$html = "Curl Fetch Error : ".curl_error($ch);
				return view($page, array('page' => $page, 'code' => 0));
			}
			else
				$html = $buffer;
			curl_close($ch);
				
			$html = substr($html, strpos($html, "조회결과"));
			$html = substr($html, strpos($html, "last_b") + 6);
				
			// 보내는 분
			$html = substr($html, strpos($html, "last_b") + 8);
			$result['sender'] = substr($html, 0, strpos($html, "<"));
				
			// 받는 분
			$html = substr($html, strpos($html, "last_b") + 8);
			$result['receiver'] = substr($html, 0, strpos($html, "<"));
				
			// 상품명
			$html = substr($html, strpos($html, "last_b") + 8);
			$result['prdt'] = substr($html, 0, strpos($html, "<"));
				
			// 배송 상황 (날짜, 시간, 현재위치, 처리현황)
			$html = substr($html, strpos($html, "담당 점소<"));
			$info = array();
			while (strpos($html, "<tr>") < strpos($html, "</table>"))
			{
				$temp = array();
		
				// state
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['state'] = trim(substr($html, 0, strpos($html, "<")));
					
				// 날짜
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['date'] = substr($html, 0, strpos($html, " "));
					
				// 시간
				$html = substr($html, strpos($html, " ") + 1);
				$temp['time'] = substr($html, 0, strpos($html, "</td"));
		
				// 현재위치
				$html = substr($html, strpos($html, "href"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['location'] = substr($html, 0, strpos($html, "<"));
		
				array_push($info, $temp);
			}
				
			array_push($result, $info);
				
				
		}
		else if ($company == "우체국택배")
		{
			$html = file_get_contents('https://service.epost.go.kr/trace.RetrieveDomRigiTraceList.comm?displayHeader=N&sid1='.$num);
			
			if (strpos($html, "배달정보를 찾지 못했습니다"))
				return view($page, array('page' => $page, 'code' => 0));
				
			$html = substr($html, strpos($html, "배달결과"));
			$html = substr($html, strpos($html, "<td>") + 1);
		
			// 보내는분
			$html = substr($html, strpos($html, "<td>") + 4);
			$result['sender'] = substr($html, 0, strpos($html, "<"));
			// 발송날짜
			$html = substr($html, strpos($html, ">") + 1);
			$result['sendDate'] = substr($html, 0, strpos($html, "</"));
			
			// 받는분
			$html = substr($html, strpos($html, "<td>") + 4);
			$result['receiver'] = substr($html, 0, strpos($html, "<"));
			// 수신날짜
			$html = substr($html, strpos($html, ">") + 1);
			$result['receiveDate'] = substr($html, 0, strpos($html, "</"));
			
			$html = substr($html, strpos($html, "<td>") + 4);
			
			// 배달결과
			$html = substr($html, strpos($html, "<td>") + 4);
			$result['state'] = substr($html, 0, strpos($html, "<"));
			
			// 배송 상황 (날짜, 시간, 현재위치, 처리현황)
			$info = array();
			while ($pos = strpos($html, "return goPost"))
			{
				$temp = array();
				
				$html = substr($html, strrpos(substr($html, 0, $pos), "<tr>"));
				
				// 날짜
				$html = substr($html, strpos($html, "<td>") + 4);
				$temp['date'] = substr($html, 0, strpos($html, "<"));
				
				// 시간
				$html = substr($html, strpos($html, "<td>") + 4);
				$temp['time'] = substr($html, 0, strpos($html, "<"));
				
				// 현재위치
				$html = substr($html, strpos($html, "onclick"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['location'] = substr($html, 0, strpos($html, "<"));
				
				// state
				$html = substr($html, strpos($html, "<td>") + 4);
				$temp['state'] = trim(substr($html, 0, strpos($html, "<")), " &nbsp; ( )");
				
				array_push($info, $temp);
			}
			
			array_push($result, $info);

		}
		else if ($company == "한진택배")
		{
			
			$opts = array(
					'http' => array(
							'method' => 'GET',
							'header' => 'User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36; Content-type: application/x-www-form-urlencoded; charset=euc-kr',
							'timeout' => 10
					)
			);
			
			$context = stream_context_create($opts);
			$html = file_get_contents('http://www.hanjin.co.kr/Delivery_html/inquiry/result_waybill.jsp?wbl_num='.$num, false, $context);
			$html = mb_convert_encoding($html, 'UTF-8', 'EUC-KR');
			
			if (strpos($html, "result_error.jsp"))
				return view($page, array('page' => $page, 'code' => 0));
			
			$html = substr($html, strpos($html, "<tbody>"));
			$html = substr($html, strpos($html, "bb") + 4);
			
			// 상품명
			$html = substr($html, strpos($html, "bb") + 4);
			$result['prdt'] = substr($html, 0, strpos($html, "<"));
			
			// 보내는 분
			$html = substr($html, strpos($html, "bb") + 4);
			$html = substr($html, strpos($html, "bb") + 4);
			$html = substr($html, strpos($html, "bb") + 4);
			$result['sender'] = trim(substr($html, 0, strpos($html, "<")));
			
			// 받는 분
			$html = substr($html, strpos($html, "bb") + 4);
			$result['receiver'] = trim(substr($html, 0, strpos($html, "<")));
			
			// 배송 상황 (날짜, 시간, 현재위치, 처리현황)
			$html = substr($html, strpos($html, "<tbody>") + 4);
			$info = array();
			while (strpos($html, "<tr>"))
			{
				$temp = array();
			
				$html = substr($html, strpos($html, "<tr>"));
			
				// 날짜
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['date'] = substr($html, 0, strpos($html, "</td"));
			
				// 시간
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['time'] = substr($html, 0, strpos($html, "</td"));
			
				// 현재위치
				$html = substr($html, strpos($html, "<td>") + 4);
				$temp['location'] = substr($html, 0, strpos($html, "<"));
			
				// 상태
				$html = substr($html, strpos($html, "left") + 6);
				$tempStr = substr($html, 0, strpos($html, "</div"));
				$temp['state'] = substr($html, strrpos($tempStr, "<strong>") + 8, strrpos($tempStr, "</strong>") - strrpos($tempStr, "<strong>") - 8);
				
				array_push($info, $temp);
				
				if (strpos($temp['state'], "배송완료") !== false)
					break;
			}
				
			array_push($result, $info);
			
		}
		else if ($company == "현대택배")		// 실패!!!! 망함 ㅠㅠ
		{						
			// Login the user
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, 'http://www.hlc.co.kr/open/tracking?invno='.$num);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($ch, CURLOPT_HEADER, true);
			
			$cookie = curl_exec ($ch);
			curl_close($ch);
			
			$pos = strpos($cookie, "<!");
			$str = substr($cookie, 0, $pos);
			$str = substr($str, strpos($str, "JSESSIONID"));
			$cookie = substr($str, 0, strpos($str, ";"));
			
			//$html = substr($cookie, $pos);
			//echo $cookie."\n";
			
			sleep(3);
			
			// Get the users details
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, 'http://www.hlc.co.kr/open/tracking');
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($ch, CURLOPT_POST, true);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, "action=processSubmit");
			curl_setopt ($ch, CURLOPT_COOKIE, $cookie);
			$html = curl_exec ($ch);
			
			curl_close($ch);
			
			if (strpos($html, "해당 번호에 대한 배송정보가 없습니다"))
				return view($page, array('page' => $page, 'code' => 0));
			
			// 보낸날짜
			$html = substr($html, strpos($html, "<table") + 1);
			$html = substr($html, strpos($html, "<table") + 1);
			
			$info = array();
			
			while (strpos($html, "<tr") < strpos($html, "</table"))
			{
				$temp = array();
				
				$html = substr($html, strpos($html, "<tr") + 1);
				
				// 날짜
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['date'] = substr($html, 0, strpos($html, "</td"));
				
				// 시간
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['time'] = substr($html, 0, strpos($html, "</td"));
				
				// 위치
				$html = substr($html, strpos($html, "<a"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['location'] = substr($html, 0, strpos($html, "</a"));
				if ($temp['location'] == "")
					$temp['location'] = "&nbsp;";
				
				// 상태
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['state'] = substr($html, 0, strpos($html, "<"));
				if (strpos($temp['state'], "하였습니다"))
					$temp['state'] = substr($temp['state'], 0, strpos($temp['state'], "하였습니다"));
				if (strpos($temp['state'], "보내셨습니다"))
					$temp['state'] = substr($temp['state'], 0, strpos($temp['state'], "보내셨습니다"))."보냄";
				if (strpos($temp['state'], " 입니다"))
					$temp['state'] = substr($temp['state'], 0, strpos($temp['state'], " 입니다"));
				if ($temp['state'] == "배달 완료")
					$temp['state'] = "배달완료";
				
				array_push($info, $temp);
				
				$html = substr($html, strpos($html, "<tr") + 1);
			}
			if ($info[count($info)-1]['state'] == "고객")
				$info = array_slice($info, 0, count($info)-1);
			array_push($result, $info);
			
		}
		else if ($company == "로젠택배")
		{
			$html = file_get_contents('http://www.ilogen.com/iLOGEN.Web.New/TRACE/TraceView.aspx?gubun=slipno&slipno='.$num);
			$html = mb_convert_encoding($html, 'UTF-8', 'EUC-KR');
			
			if (strpos($html, "배송자료를 조회할 수 없습니다"))
				return view($page, array('page' => $page, 'code' => 0));
				
			// 보낸날짜
			$html = substr($html, strpos($html, "tbTakeDt"));
			$html = substr($html, strpos($html, "value") + 7);
			$result['sendDate'] = substr($html, 0, strpos($html, "\""));
			
			// 상품명
			$html = substr($html, strpos($html, "tbGoodsNm"));
			$html = substr($html, strpos($html, "value") + 7);
			$result['prdt'] = substr($html, 0, strpos($html, "\""));
			
			// 보내는 분
			$html = substr($html, strpos($html, "tbSndCustNm"));
			$html = substr($html, strpos($html, "value") + 7);
			$result['sender'] = substr($html, 0, strpos($html, "\""));
			
			// 받는 분
			$html = substr($html, strpos($html, "tbRcvCustNm"));
			$html = substr($html, strpos($html, "value") + 7);
			$result['receiver'] = substr($html, 0, strpos($html, "\""));
			
			// 배송 상황 (현재위치, 처리현황)
			$html = substr($html, strpos($html, "gridStat"));
			$info = array();
			while (strpos($html, "<tr"))
			{
				$temp = array();
					
				$html = substr($html, strpos($html, "<tr"));
					
				// 현재위치
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['location'] = substr($html, 0, strpos($html, "<"));
					
				// state
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['state'] = substr($html, 0, strpos($html, "<"));
				
				if (strpos($temp['state'], "&nbsp;") !== false)
					break;
				
				if (strpos($temp['state'], "하였습니다"))
					$temp['state'] = substr($temp['state'], 0, strpos($temp['state'], "하였습니다"));
				if (strpos($temp['state'], "했습니다"))
					$temp['state'] = substr($temp['state'], 0, strpos($temp['state'], "했습니다"));
				if (strpos($temp['state'], "입니다"))
					$temp['state'] = substr($temp['state'], 0, strpos($temp['state'], "입니다"));
				if (strpos($temp['state'], "물품을 전달"))
					$temp['state'] = "배달완료";
			
				$temp['date'] = "";
				$temp['time'] = "";
				array_push($info, $temp);
			}
			array_push($result, $info);
			
			// 받는 시간
			$html = substr($html, strpos($html, "tbScanDt"));
			$html = substr($html, strpos($html, "value") + 7);
			$result['receiveDate'] = substr($html, 0, strpos($html, "\""));
			
			if (count($result[0]) > 0)
			{
				$result[0][0]['date'] = $result['sendDate'];
				$result[0][count($result[0])-1]['date'] = $result['receiveDate'];
			}
		}
		else if ($company == "KG로지스")
		{
			$opts = array(
					'http' => array(
							'method' => 'POST',
							'header' => 'Content-type: application/x-www-form-urlencoded',
							'content' => 'item_no='.$num,
							'timeout' => 10
					)
			);
				
			$context = stream_context_create($opts);
			$html = file_get_contents('http://www.kglogis.co.kr/delivery/delivery_result.jsp', false, $context);
			
			$html = substr($html, strpos($html, "<tbody>"));
				
			// 보낸 분
			$html = substr($html, strpos($html, "<td>") + 4);
			$html = substr($html, strpos($html, "<td>") + 4);
			$result['sender'] = substr($html, 0, strpos($html, " "));
				
			// 상품명
			$html = substr($html, strpos($html, "<td>") + 4);
			$result['prdt'] = substr($html, 0, strpos($html, "<"));
				
			// 받는 분
			$html = substr($html, strpos($html, "<td>") + 4);
			$result['receiver'] = substr($html, 0, strpos($html, " "));
			
			if ($result['sender'] == "" && $result['prdt'] == "")
				return view($page, array('page' => $page, 'code' => 0));
				
			// 배송 상황 (현재위치, 처리현황)
			$html = substr($html, strpos($html, "<tbody>"));
			$info = array();
			while (strpos($html, "<span>"))
			{
				$temp = array();
		
				// 날짜
				$html = substr($html, strpos($html, "<span>") + 6);
				$temp['date'] = substr($html, 0, strpos($html, "<"));
		
				// 시간
				$html = substr($html, strpos($html, "<span>") + 6);
				$temp['time'] = substr($html, 0, strpos($html, "<"));
					
				// state
				$html = substr($html, strpos($html, "<span>") + 6);
				$temp['state'] = substr($html, 0, strpos($html, "<"));
				
				if (strpos($temp['state'], "운송장을 발행"))
					$temp['state'] = "운송장 발행";
				if (strpos($temp['state'], "이동중"))
					$temp['state'] = "이동중";
				if (strpos($temp['state'], "달지에"))
					$temp['state'] = "배달지 도착";
				if (strpos($temp['state'], "예정"))
					$temp['state'] = "배달준비";
				if (strpos($temp['state'], "배달완료"))
					$temp['state'] = "배달완료";
					
				// 위치
				$html = substr($html, strpos($html, "<span>") + 6);
				$temp['location'] = substr($html, 0, strpos($html, "<"));
		
				$html = substr($html, strpos($html, "</tr>") + 1);
		
				array_push($info, $temp);
		
		
			}
			array_push($result, $info);
		}
		else if ($company == "CVSnet 편의점택배")
		{
			$html = file_get_contents('http://www.doortodoor.co.kr/jsp/cmn/TrackingCVS.jsp?pTdNo='.$num);
			
			if (strpos($html, "검색된 결과가 없습니다"))
				return view($page, array('page' => $page, 'code' => 0));
				
			$html = substr($html, strpos($html, "<tbody"));
				
			// 보낸 분
			$html = substr($html, strpos($html, "<td") + 3);
			$html = substr($html, strpos($html, "<td"));
			$html = substr($html, strpos($html, ">") + 1);
			$result['sender'] = substr($html, 0, strpos($html, "<"));
				
			// 받는 분
			$html = substr($html, strpos($html, "<td"));
			$html = substr($html, strpos($html, ">") + 1);
			$result['receiver'] = substr($html, 0, strpos($html, "<"));
				
			// 상품 이름
			$html = substr($html, strpos($html, "<td"));
			$html = substr($html, strpos($html, ">") + 1);
			$result['prdt'] = substr($html, 0, strpos($html, "<"));
				
			// 배송 상황 (현재위치, 처리현황)
			$html = substr($html, strpos($html, "<tbody"));
			$info = array();
			while (strpos($html, "<tr"))
			{
				$temp = array();
					
				$html = substr($html, strpos($html, "</tr>") + 1);
					
				// 날짜
				$html = substr($html, strpos($html, "<td>") + 4);
				$temp['date'] = substr($html, 0, strpos($html, " "));
					
				// 시간
				$html = substr($html, strpos($html, " ") + 1);
				$temp['time'] = substr($html, 0, strpos($html, "<"));
		
				// 상태
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['state'] = trim(substr($html, 0, strpos($html, "<")));
				
				if (strpos($temp['state'], "배송지에 도착"))
					$temp['state'] = "배송지에 도착";
				if (strpos($temp['state'], "상품이 이동중"))
					$temp['state'] = "배송지역 이동중";
				if (strpos($temp['state'], "배송할 예정"))
					$temp['state'] = "배송 예정";
				if (strpos($temp['state'], "배송완료"))
					$temp['state'] = "배송완료";
					
					
				// 위치
				$html = substr($html, strpos($html, "href"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['location'] = substr($html, 0, strpos($html, "<"));
					
				array_push($info, $temp);
			}
		
			array_push($result, $info);
		}
		else if ($company == "KGB택배")
		{
			$opts = array(
					'http' => array(
							'method' => 'POST',
							'header' => 'Content-type: application/x-www-form-urlencoded',
							'content' => 'f_slipno='.$num,
							'timeout' => 10
					)
			);
		
			$context = stream_context_create($opts);
			$html = file_get_contents('http://www.kgbls.co.kr/sub/trace.asp', false, $context);
			$html = mb_convert_encoding($html, 'UTF-8', 'EUC-KR');
				
			$html = substr($html, strpos($html, "처리상태"));
				
			// 배송 상황 (현재위치, 처리현황)
			$info = array();
			while (strpos($html, "<table") < strpos($html, "history.back"))
			{
				$temp = array();
		
				$html = substr($html, strpos($html, "<table"));
					
				// 위치
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['location'] = substr($html, 0, strpos($html, "<"));
				
				if ($temp['location'] == "")
					$temp['location'] = "&nbsp;";
					
				// 날짜
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['date'] = substr($html, 0, strpos($html, " "));
		
				// 날짜
				$html = substr($html, strpos($html, " ") + 1);
				$temp['time'] = substr($html, 0, strpos($html, "<"));
					
				// 상태
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['state'] = substr($html, 0, strpos($html, "<"));
				
				if (strpos($temp['state'], "에서"))
					$temp['state'] = substr($temp['state'], strpos($temp['state'], "에서") + 7);
				if (strpos($temp['state'], "했습니다"))
					$temp['state'] = substr($temp['state'], 0, strpos($temp['state'], "했습니다"));
				if (strpos($temp['state'], "배송을 시작"))
					$temp['state'] = "배송을 시작";
				if (strpos($temp['state'], ". "))
					$temp['state'] = substr($temp['state'], 0, strpos($temp['state'], ". "));
					
				array_push($info, $temp);
			}
			array_push($result, $info);
			
			if (count($info) == 0)
				return view($page, array('page' => $page, 'code' => 0));
				
		}
		else if ($company == "경동택배")
		{
			
		}
		else if ($company == "대신택배")
		{
		
		}
		else if ($company == "일양로지스")
		{
		
		}
		else if ($company == "합동택배")
		{
			$opts = array(
					'http' => array(
							'method' => 'POST',
							'header' => 'Content-type: application/x-www-form-urlencoded',
							'content' => 'stype=1&p_item='.$num,
							'timeout' => 10
					)
			);
			
			$context = stream_context_create($opts);
			$html = file_get_contents('http://www.hdexp.co.kr/parcel/order_result_t.asp', false, $context);
			$html = mb_convert_encoding($html, 'UTF-8', 'EUC-KR');
			
			if (strpos($html, "운송장번호가 일치하지 않습니다."))
				return view($page, array('page' => $page, 'code' => 0));
			
			$html = substr($html, strpos($html, "<tbody"));
			$html = substr($html, strpos($html, "<tr") + 2);
			$html = substr($html, strpos($html, "<tr") + 2);
			$html = substr($html, strpos($html, "<tr") + 2);
			
			// 보내는 분
			$html = substr($html, strpos($html, "<td") + 2);
			$html = substr($html, strpos($html, "<td") + 2);
			$html = substr($html, strpos($html, ">") + 1);
			$result['sender'] = substr($html, 0, strpos($html, "</"));
			
			// 받는 분
			$html = substr($html, strpos($html, "<td") + 2);
			$html = substr($html, strpos($html, "<td") + 2);
			$html = substr($html, strpos($html, ">") + 1);
			$result['receiver'] = substr($html, 0, strpos($html, "</"));
			
			$html = substr($html, strpos($html, "<table") + 2);
			$html = substr($html, strpos($html, "<tr") + 2);
			$html = substr($html, strpos($html, "<tr") + 2);
			
			// 보내는 날짜
			$html = substr($html, strpos($html, "<td") + 2);
			$html = substr($html, strpos($html, ">") + 1);
			$result['sendDate'] = trim(substr($html, 0, strpos($html, "</")), " &nbsp;");
			
			// 물품명
			$html = substr($html, strpos($html, "<td") + 2);
			$html = substr($html, strpos($html, "<td") + 2);
			$html = substr($html, strpos($html, "<td") + 2);
			$html = substr($html, strpos($html, ">") + 1);
			$result['prdt'] = trim(substr($html, 0, strpos($html, "</")), " &nbsp;");
			
			$html = substr($html, strpos($html, "<table"));
			$html = substr($html, strpos($html, "<tr") + 2);
			
			if ($result['sender'] == "" && $result['prdt'] == "")
				return view($page, array('page' => $page, 'code' => 0));
				
			
			// 배송 상황 (현재위치, 처리현황)
			$info = array();
			while (strpos($html, "<tr") < strpos($html, "</tbody"))
			{
				$temp = array();
			
				$html = substr($html, strpos($html, "<tr"));
					
				// 날짜
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['date'] = substr($html, 0, strpos($html, " "));
			
				// 시간
				$html = substr($html, strpos($html, " ") + 1);
				$temp['time'] = substr($html, 0, strpos($html, "<"));
				
				// 위치
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['location'] = substr($html, 0, strpos($html, "<"));
					
				// 상태
				$html = substr($html, strpos($html, "<td") + 1);
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['state'] = substr($html, 0, strpos($html, "<"));
					
				array_push($info, $temp);
			}
			array_push($result, $info);
		}
		else if ($company == "GTX로지스")
		{
			$html = file_get_contents('http://www.gtxlogis.co.kr/tracking/default.asp?awblno='.$num);
			$html = mb_convert_encoding($html, 'UTF-8', 'EUC-KR');
			
			if (strpos($html, "운송장 번호에 대한 자료가 없습니다"))
				return view($page, array('page' => $page, 'code' => 0));
				
			
			// 보내는 분
			$html = substr($html, strpos($html, "jeon_07") + 9);
			$result['sender'] = substr($html, 0, strpos($html, "</"));
			
			// 배송상태
			$html = substr($html, strpos($html, "jeon_07") + 9);
			$result['state'] = substr($html, 0, strpos($html, "</"));
			
			// 받는 분
			$html = substr($html, strpos($html, "jeon_07") + 9);
			$result['receiver'] = substr($html, 0, strpos($html, "</"));
			
			// 배송 상황 (현재위치, 처리현황)
			$info = array();
			while (strpos($html, "lee_09"))
			{
				$temp = array();
					
				// 날짜
				$html = substr($html, strpos($html, "lee_09"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['date'] = substr($html, 0, strpos($html, "<"));
				
				// 시간
				$html = substr($html, strpos($html, "lee_09"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['time'] = substr($html, 0, strpos($html, "<"));
				
				// 현재위치
				$html = substr($html, strpos($html, "lee_09"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['location'] = substr($html, 0, strpos($html, "<"));
					
				// state
				$html = substr($html, strpos($html, "lee_09") + 3);
				$html = substr($html, strpos($html, "lee_09"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['state'] = substr($html, 0, strpos($html, "<"));
			
				array_push($info, $temp);
			}
			array_push($result, $info);
		}
		else if ($company == "건영택배")
		{
			$html = file_get_contents('http://www.kunyoung.com/goods/goods_01.php?mulno='.$num);
			$html = mb_convert_encoding($html, 'UTF-8', 'EUC-KR');
			
			if (strpos($html, "조회된 데이터가 없습니다"))
				return view($page, array('page' => $page, 'code' => 0));
			
			// 다음 페이지 가져오기
			$html = substr($html, strpos($html, $num) + 2);
			$html = substr($html, strpos($html, $num) - 8);
			$nextNum = substr($html, 0, strpos($html, "\">"));
			
			// 다음 페이지 열기
			$html = file_get_contents('http://www.kunyoung.com/goods/goods_02.php?mulno='.$nextNum);
			$html = mb_convert_encoding($html, 'UTF-8', 'EUC-KR');
			
			// 받는 분
			$html = substr($html, strpos($html, "받는분"));
			$html = substr($html, strpos($html, "<td"));
			$html = substr($html, strpos($html, ">") + 1);
			$result['receiver'] = trim(substr($html, 0, strpos($html, "</")), " &nbsp;");
			
			// 보내는 분
			$html = substr($html, strpos($html, "보내는"));
			$html = substr($html, strpos($html, "<td"));
			$html = substr($html, strpos($html, ">") + 1);
			$result['sender'] = trim(substr($html, 0, strpos($html, "</")), " &nbsp;");
			
			// 상품명
			$html = substr($html, strpos($html, "총수량"));
			$html = substr($html, strpos($html, "<tr") + 1);
			$html = substr($html, strpos($html, "<tr") + 1);
			$html = substr($html, strpos($html, "<td"));
			$html = substr($html, strpos($html, ">") + 1);
			$result['sender'] = trim(substr($html, 0, strpos($html, "</")), " &nbsp;");
			
			// 배송 상황 (현재위치, 처리현황)
			$html = substr($html, strpos($html, "상태"));
			$html = substr($html, strpos($html, "전화번호"));
			$html = substr($html, strpos($html, "<tr") + 2);
			$info = array();
			while (strpos($html, "<tr") < strpos($html, "</table"))
			{
				$html = substr($html, strpos($html, "<tr") + 1);
				
				$temp = array();
					
				// 날짜
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['date'] = substr($html, 0, strpos($html, " "));
			
				// 시간
				$html = substr($html, strpos($html, " ") + 1);
				$temp['time'] = substr($html, 0, strpos($html, "<"));
			
				// 현재위치
				$html = substr($html, strpos($html, "<td") + 1);
				$html = substr($html, strpos($html, "<td") + 1);
				$html = substr($html, strpos($html, ">") + 1);
				$temp['location'] = substr($html, 0, strpos($html, "<") - 6);
					
				// state
				$html = substr($html, strpos($html, "<") - 6);
				$temp['state'] = substr($html, 0, strpos($html, "<"));
				if ($temp['state'] == "완료")
					$temp['state'] = "배송완료";
					
				array_push($info, $temp);
				
				$html = substr($html, strpos($html, "<tr") + 2);
			}
			array_push($result, $info);
				
		}
		else if ($company == "천일택배")
		{
			$html = file_get_contents('http://www.chunil.co.kr/HTrace/HTrace.jsp?transNo='.$num);
			//$html = mb_convert_encoding($html, 'UTF-8', 'EUC-KR');
			
			if (strpos($html, "결과가 없습니다"))
				return view($page, array('page' => $page, 'code' => 0));
			
			// 보내는 분
			$html = substr($html, strpos($html, "명 :"));
			$html = substr($html, strpos($html, "<td"));
			$html = substr($html, strpos($html, ">") + 1);
			$result['sender'] = substr($html, 0, strpos($html, "</"));
			
			// 받는 분
			$html = substr($html, strpos($html, "명 :"));
			$html = substr($html, strpos($html, "<td"));
			$html = substr($html, strpos($html, ">") + 1);
			$result['receiver'] = substr($html, 0, strpos($html, "</"));
			
			// 상품이름
			$html = substr($html, strpos($html, "명 :"));
			$html = substr($html, strpos($html, "<td"));
			$html = substr($html, strpos($html, ">") + 1);
			$result['prdt'] = substr($html, 0, strpos($html, "</"));
			
			// 배송 상황 (현재위치, 처리현황)
			$html = substr($html, strpos($html, "상태"));
			
			$info = array();
			while (strpos($html, "<tr>") < strpos($html, "</table>"))
			{
				$temp = array();
					
				// 날짜
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['date'] = substr($html, 0, strpos($html, "<"));
				
				// 현재위치
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['location'] = substr($html, 0, strpos($html, "<"));
				
				// state
				$html = substr($html, strpos($html, "<td") + 2);
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['state'] = substr($html, 0, strpos($html, "<"));
				if ($temp['state'] == "도착")
					$temp['state'] = "배송완료";
					
				$temp['time'] = "";
				array_push($info, $temp);
			}
			array_push($result, $info);
		}
		else if ($company == "한의사랑택배")
		{
			
		}
		else if ($company == "굿투럭")
		{
			$opts = array(
					'http' => array(
							'method' => 'POST',
							'header' => 'Content-type: application/x-www-form-urlencoded',
							'content' => 'invc_no='.$num,
							'timeout' => 10
					)
			);
				
			$context = stream_context_create($opts);
			$result = file_get_contents('http://www.goodstoluck.co.kr/search/goodstoluck', false, $context);
			$result = json_decode($result);
		
		}
		else if ($company == "FedEx")	// 실패
		{
			/*$path_to_wsdl = dirname(__FILE__)."/../lib/TrackService_v10.wsdl";
			ini_set("soap.wsdl_cache_enabled", "0");
			
			$client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information
			
			$request['WebAuthenticationDetail'] = array(
					'ParentCredential' => array(
							'Key' => getProperty('XZLtoAV0acsEO896'),
							'Password' => getProperty('')
					),
					'UserCredential' => array(
							'Key' => getProperty('XZLtoAV0acsEO896'),
							'Password' => getProperty('')
					)
			);
			
			$request['ClientDetail'] = array(
					'AccountNumber' => getProperty('510087402'),
					'MeterNumber' => getProperty('118699515')
			);
			$request['TransactionDetail'] = array('CustomerTransactionId' => '*** Track Request using PHP ***');
			$request['Version'] = array(
					'ServiceId' => 'trck',
					'Major' => '10',
					'Intermediate' => '0',
					'Minor' => '0'
			);
			$request['SelectionDetails'] = array(
					'PackageIdentifier' => array(
							'Type' => 'TRACKING_NUMBER_OR_DOORTAG',
							'Value' => getProperty($num) // Replace 'XXX' with a valid tracking identifier
					)
			);
			
			
			
			try {
				if(setEndpoint('changeEndpoint')){
					$newLocation = $client->__setLocation(setEndpoint('endpoint'));
				}
			
				$response = $client ->track($request);
			
				if ($response -> HighestSeverity != 'FAILURE' && $response -> HighestSeverity != 'ERROR'){
					if($response->HighestSeverity != 'SUCCESS'){
						echo '<table border="1">';
						echo '<tr><th>Track Reply</th><th>&nbsp;</th></tr>';
						trackDetails($response->Notifications, '');
						echo '</table>';
					}else{
						if ($response->CompletedTrackDetails->HighestSeverity != 'SUCCESS'){
							echo '<table border="1">';
							echo '<tr><th>Shipment Level Tracking Details</th><th>&nbsp;</th></tr>';
							trackDetails($response->CompletedTrackDetails, '');
							echo '</table>';
						}else{
							echo '<table border="1">';
							echo '<tr><th>Package Level Tracking Details</th><th>&nbsp;</th></tr>';
							trackDetails($response->CompletedTrackDetails->TrackDetails, '');
							echo '</table>';
						}
					}
					printSuccess($client, $response);
				}else{
					printError($client, $response);
				}
			
				writeToLog($client);    // Write to log file
			} catch (SoapFault $exception) {
				printFault($exception, $client);
			}*/
			
		}
		else if ($company == "EMS")
		{				
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://service.epost.go.kr/trace.RetrieveEmsRigiTraceList.comm?POST_CODE=$num&displayHeader=N");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSLVERSION, 3);
			curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'SSLv3');
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			ob_start();
			$res = curl_exec($ch);
			$buffer = ob_get_contents();
			ob_end_clean();
			if (!$buffer)
				$result = "Curl Fetch Error : ".curl_error($ch);
			else
				$html = $buffer;
			curl_close($ch);
			
			$html = substr($html, strpos($html, "배달요약정보"));
			$html = substr($html, strpos($html, "<td>") + 1);
			
			// 발송날짜
			$html = substr($html, strpos($html, "<td>") + 1);
			$html = substr($html, strpos($html, "/>") + 1);
			$result['sendDate'] = substr($html, 0, strpos($html, "</"));
				
			// 발송날짜
			$html = substr($html, strpos($html, "<td>") + 1);
			$html = substr($html, strpos($html, "/>") + 1);
			$result['receiveDate'] = substr($html, 0, strpos($html, "</"));
			
			// 배달결과
			$html = substr($html, strpos($html, "<td>") + 4);
			$html = substr($html, strpos($html, "<td>") + 4);
			$result['state'] = substr($html, 0, strpos($html, "<"));
				
			// 배송 상황 (날짜, 시간, 현재위치, 처리현황)
			$info = array();
			while ($pos = strpos($html, "txtL"))
			{
				$temp = array();
			
				$html = substr($html, strrpos(substr($html, 0, $pos), "<tr>"));
			
				// 날짜
				$html = substr($html, strpos($html, "<td>") + 4);
				$temp['date'] = trim(substr($html, 0, strpos($html, " ")));
			
				// 시간
				$html = substr($html, strpos($html, " ") + 1);
				$temp['time'] = trim(substr($html, 0, strpos($html, "<")));
			
				// state
				$html = substr($html, strpos($html, "<td>") + 4);
				$temp['state'] = trim(substr($html, 0, strpos($html, "<")), " &nbsp; ( )");
				
				// 현재위치
				$html = substr($html, strpos($html, "txtL") + 6);
				$temp['location'] = "&nbsp";
				if ($temp['location'] == "")
					$temp['location'] = "&nbsp;";
				
			
				array_push($info, $temp);
			}
				
			array_push($result, $info);
		}
		else if ($company == "DHL")
		{
			
		}
		else if ($company == "UPS")
		{
			
		}
		else if ($company == "TNTExpress")
		{
			//echo ("???");
			$html = file_get_contents('http://www.tnt.com/webtracker/tracking.do?navigation=0&page=1&plazakey=&refs=&requesttype=GEN&respCountry=kr&respLang=ko&searchType=CON&sourceCountry=ww&sourceID=1&trackType=CON&cons='.$num);
			
			if (strpos($html, "일치되는 송장번호가 없습니다"))
				return view($page, array('page' => $page, 'code' => 0));
			
			$html = substr($html, strpos($html, "sectionheading"));
			$html = substr($html, strpos($html, "<tr"));
			
			$info = array();
			
			while (strpos($html, "<tr") < strpos($html, "</tbody>"))
			{
				$temp = array();
				
				// 날짜
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['date'] = substr($html, 0, strpos($html, "<"));
				
				// 시간
				$html = substr($html, strpos($html, "<td") + 4);
				$temp['time'] = substr($html, 0, strpos($html, "<"));
				
				// 위치
				$html = substr($html, strpos($html, "<td") + 4);
				$temp['location'] = substr($html, 0, strpos($html, "<"));
				
				// 상태
				$html = substr($html, strpos($html, "<td") + 4);
				$temp['state'] = substr($html, 0, strpos($html, "<"));
				
				if (strpos($temp['state'], "화물이 도착"))
					$temp['state'] = "배송사무소 도착";
				if (strpos($temp['state'], "경유센터"))
					$temp['state'] = "경유센터에서 분류";
				if (strpos($temp['state'], "물건을 픽업"))
					$temp['state'] = "물건 픽업";
				if (strpos($temp['state'], "센터에 화물"))
					$temp['state'] = "TNT센터 도착";
				if (strpos($temp['state'], "습니다"))
					$temp['state'] = substr($temp['state'], 0, strpos($temp['state'], "습니다") - 6);
				if (strpos($temp['state'], "인도가 완료"))
					$temp['state'] = "배송완료";
				
				array_push($info, $temp);
			}
			
			array_push($result, array_reverse($info));			
		}
			
		if (!isset($result['state']))
			$result['state'] = $result[0][count($result[0])-1]['state'];
		if (!isset($result['prdt']))
			if (isset($result['sender']))
				$result['prdt'] = $result['receiver']."님의 상품";
			else 
				$result['prdt'] = "상품명 알 수 없음";
		
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
		
		if (session_id() == '') 	session_start();
		$member_idx = $_SESSION['idx'];
		
		$result = $sdModel->create(trim($prdt), $num, $office, " ", $member_idx, " ", " ", "배송중");
		
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
	
		if (session_id() == '') 	session_start();
		$member_idx = $_SESSION['idx'];
	
		$result = $scModel->create($num, $year, " ", " ", $member_idx, "배송중");
	
		header('Content-Type: application/json');
		echo json_encode($result);
	}

}




