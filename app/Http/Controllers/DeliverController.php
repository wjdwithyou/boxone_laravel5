<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use SoapClient;
use Request;

require_once dirname(__FILE__)."/../lib/fedex-common.php5";
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
		
		$result[0] = $info;
		
		$page = 'deliver_entryInfo';
		return view($page, array('page' => $page, 'result' => $result));
		
		//echo ("화물번호:".$hwaNum.", M B/L:".$mbl.", H B/L:".$hbl);
	}
	
	function getInfoDelivery()
	{
		$company = Request::input('company');
		$num = Request::input('num');
		$adr_ctr = Request::input('adr_ctr');
		
		$result = array();
		
		$result['office'] = $company;
		$result['num'] = $num;
		
		if ($company == "CJ대한통운")
		{
			$postdata = "fsp_action=PARC_ACT_002&fsp_cmd=retrieveInvNoACT&invc_no=$num&nextpage=parcel%2Fpa_004_r.jsp";
				
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://www.doortodoor.co.kr/main/doortodoor.do");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSLVERSION, 3);
			curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'SSLv3');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
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
			
				// state
				$html = substr($html, strpos($html, "left") + 6);
				$temp['state'] = trim(substr($html, 0, strpos($html, "</div")), " &nbsp; ( ) <strong> </strong>");
				
				array_push($info, $temp);
				
				if (strpos($temp['state'], "배송완료") !== false)
					break;
			}
				
			array_push($result, $info);
			
		}
		else if ($company == "현대택배")		// 실패!!!! 망함 ㅠㅠ
		{						
			/*$result = file_get_contents('http://www.hlc.co.kr/open/tracking?invno='.$num);
			$str = $http_response_header[8];
			$cookie = substr($str, strpos($str, ":"));
			$cookie = substr($str, strpos($str, "=")+1, strpos($str, ";"));
			
			echo $cookie;
			
			setcookie("JSESSIONID_hlchome", $cookie, time()+60*60);
			
			$postdata = http_build_query(
				array(
					'action' => 'processSubmit'
				)
			);
			 	
			$header =
			 	'Content-Type: application/x-www-form-urlencoded\r\n'.
			 	'Host: www.hlc.co.kr\r\n'.
			 	'Origin: http://www.hlc.co.kr\r\n'.
			 	'Cookie: JSESSIONID_hlchome='.$cookie.'\r\n'.
			 	'Referer: http://www.hlc.co.kr/open/tracking?invno=304361081183\r\n'.
			 	'Upgrade-Insecure-Requests: 1\r\n'.
			 	'User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36';
			 	
			$opts = array(
			 	'http' => array(
			 		'method' => 'POST',
			 		'header' => $header,
			 		'content' => $postdata,
			 		'timeout' => 10
			 	)
			);
			
			$context = stream_context_create($opts);
			$result = file_get_contents('http://www.hlc.co.kr/open/tracking', false, $context);*/
			
			//$cookie_file = "cookie.txt";
				
			// Login the user
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, 'http://www.hlc.co.kr/open/tracking?invno='.$num);
			//curl_setopt ($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
			//curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie_file);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($ch, CURLOPT_HEADER, true);
			//curl_setopt ($ch, CURLOPT_CONNECT_ONLY, true);
			//curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Upgrade_Insecure_Requests: 1', 'Host: www.hlc.co.kr', 'Origin: http://www.hlc.co.kr', 'Cookie: JSESSIONID_hlchome=6vnKWkKKyh2gDmF0q2QGCS7Gl7QvX0cYWDrSynhLvm1QC2nT8Fjs!855130315!-1404783096', 'User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36'));
			//curl_setopt ($ch, CURLOPT_COOKIESESSION, true);
			//curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
			//curl_setopt ($ch, CURLOPT_AUTOREFERER, true);
			
			$result = curl_exec ($ch);
			curl_close($ch);
			
			$pos = strpos($result, "<!");
			$str = substr($result, 0, $pos);
			$str = substr($str, strpos($str, "JSESSIONID"));
			$cookie = substr($str, 0, strpos($str, ";"));
			
			$result = substr($result, $pos);
			echo $cookie."\n";
			
			sleep(3);
			
			// Get the users details
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, 'http://www.hlc.co.kr/open/tracking');
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($ch, CURLOPT_POST, true);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, "action=processSubmit");
			curl_setopt ($ch, CURLOPT_COOKIE, $cookie);
			//curl_setopt ($ch, CURLOPT_COOKIE, "JSESSIONID_hlchome=gj8lWmnh9y26RFX31NSfhQSpnG6BQ4tP1pRLWHQMGrp6tj3GDlQD!248303518!-256124272");
			//curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie_file);
			//curl_setopt ($ch, CURLOPT_HEADER, true);
			//curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie_file);
			$result = curl_exec ($ch);
			$result = str_replace ("/js", "http://www.hlc.co.kr/js", $result);
			
			curl_close($ch);
		
		}
		else if ($company == "로젠택배")
		{
			$html = file_get_contents('http://www.ilogen.com/iLOGEN.Web.New/TRACE/TraceView.aspx?gubun=slipno&slipno='.$num);
			$html = mb_convert_encoding($html, 'UTF-8', 'EUC-KR');
				
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
				$html = substr($html, strpos($html, ">"));
				$temp['location'] = substr($html, 0, strpos($html, "<"));
					
				// state
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">"));
				$temp['state'] = substr($html, 0, strpos($html, "<"));
				
				if (strpos($temp['state'], "&nbsp;") !== false)
					break;
			
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
		
				// state
				$html = substr($html, strpos($html, "<td"));
				$html = substr($html, strpos($html, ">") + 1);
				$temp['state'] = trim(substr($html, 0, strpos($html, "<")));
					
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
					
				array_push($info, $temp);
			}
			array_push($result, $info);
				
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
					
				array_push($info, $temp);
				
				$html = substr($html, strpos($html, "<tr") + 2);
			}
			array_push($result, $info);
				
		}
		else if ($company == "천일택배")
		{
			$html = file_get_contents('http://www.chunil.co.kr/HTrace/HTrace.jsp?transNo='.$num);
			$html = mb_convert_encoding($html, 'UTF-8', 'EUC-KR');
			
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
			$result['state'] = substr($html, 0, strpos($html, "<"));
				
			// 배송 상황 (날짜, 시간, 현재위치, 처리현황)
			$info = array();
			while ($pos = strpos($html, "txtL"))
			{
				$temp = array();
			
				$html = substr($html, strrpos(substr($html, 0, $pos), "<tr>"));
			
				// 날짜
				$html = substr($html, strpos($html, "<td>") + 4);
				$temp['date'] = substr($html, 0, strpos($html, " "));
			
				// 시간
				$html = substr($html, strpos($html, " ") + 1);
				$temp['time'] = substr($html, 0, strpos($html, "<"));
			
				// state
				$html = substr($html, strpos($html, "<td>") + 4);
				$temp['state'] = trim(substr($html, 0, strpos($html, "<")), " &nbsp; ( )");
				
				// 현재위치
				$html = substr($html, strpos($html, "txtL") + 6);
				$temp['location'] = trim(substr($html, 0, strpos($html, "<")), " &nbsp; ( )");
			
				
			
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
				
				array_push($info, $temp);
			}
			
			array_push($result, $info);			
		}
			
		if (!isset($result['state']))
			$result['state'] = $result[0][count($result[0])-1]['state'];
		if (!isset($result['prdt']))
			if (isset($result['sender']))
				$result['prdt'] = $result['receiver']."님의 상품";
			else 
				$result['prdt'] = "상품명 알 수 없음";
		
		$page = 'deliver_deliveryInfo';
		return view($page, array('page' => $page, 'result' => $result, 'adr_ctr' => $adr_ctr));
	}


}