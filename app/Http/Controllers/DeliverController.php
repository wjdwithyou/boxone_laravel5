<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Request;

//include ("/var/www/laravel/app/models/MemberModel.php");

class DeliverController extends Controller {

	/*
	 *  명수꺼, 테스트용
	 */
	


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
		$company = Request::input('company');
		$num = Request::input('num');
		$url = Request::input('url');
		
		$result = array();
		
		if ($company == "우체국택배")
		{
			$html = file_get_contents($url);
			
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
		else if ($company == "대한통운")
		{
			$postdata = 'fsp_action=PARC_ACT_002&fsp_cmd=retrieveInvNoACT&invc_no=689354045702&nextpage=parcel%2Fpa_004_r.jsp';
			
			/*$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://www.doortodoor.co.kr/main/doortodoor.do");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSLVERSION, 3);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_REFERER, "https://www.doortodoor.co.kr/main/doortodoor.do");
			curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__)."/cacert.pem");
			ob_start();
			$res = curl_exec($ch);
			$buffer = ob_get_contents();
			ob_end_clean();
			if (!$buffer) 
			{
				$returnVal = "Curl Fetch Error : ".curl_error($ch);
			}
			else
			{
				$returnVal = $buffer;
			} 
			curl_close($ch); 
			echo $returnVal;*/
			
			
			$opts = array(
				'http' => array(
					'method' => 'POST',
					'header' => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata,
					'timeout' => 10
				), 
				'ssl' => array(
					'verify_peer' => true,
					'cafile' => "http://localhost:8000/img/cacert.pem",
					'CN_match' => 'https://www.doortodoor.co.kr/main/doortodoor.do',
					'ciphers' => 'HIGH:!SSLv2:!SSLv3'
				)
			);
			
			$context = stream_context_create($opts);
			$result = file_get_contents('https://www.doortodoor.co.kr/main/doortodoor.do', false, $context);
			
			echo $result;
			
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
			$html = file_get_contents($url, false, $context);
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
		else if ($company == "로젠택배")
		{
			$html = file_get_contents($url);
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
			$result['sender'] = substr($html, 0, strpos($html, "\""));
			
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
			
				array_push($info, $temp);
			}
			array_push($result, $info);
			
			// 받는 시간
			$html = substr($html, strpos($html, "tbScanDt"));
			$html = substr($html, strpos($html, "value") + 7);
			$result['sendDate'] = substr($html, 0, strpos($html, "\""));
		}
		else if ($company == "현대택배")
		{
			/*
			$postdata = http_build_query(
			    array(
			        'action' => 'processSubmit',
			    	'invno' => 304361081183
			    )
			);
			
			$header =
					'Content-Type: application/x-www-form-urlencoded\r\n'.
					'Host: www.hlc.co.kr\r\n'.
					'Origin: http://www.hlc.co.kr\r\n'.
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
			
			define("COOKIE_FILE", "cookie.txt");
			
			// Login the user
			$ch = curl_init('http://www.hlc.co.kr/open/tracking?invno='.$num);
			curl_setopt ($ch, CURLOPT_COOKIEJAR, COOKIE_FILE);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			echo curl_exec ($ch);
			
			// Read the session saved in the cookie file
			echo "<br/><br/>";
			$file = fopen("cookie.txt", 'r');
			echo fread($file, 100000000);
			echo "<br/><br/>";
			
			// Get the users details
			$ch = curl_init('http://www.hlc.co.kr/open/tracking');
			curl_setopt ($ch, CURLOPT_COOKIEJAR, COOKIE_FILE);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "action=processSubmit");
			echo curl_exec ($ch);
				
		}
		else if ($company == "KG옐로우캡택배")
		{
				
		}
		else if ($company == "KGB택배")
		{
				
		}
		else if ($company == "EMS")
		{
				
		}
		else if ($company == "DHL")
		{
				
		}
		else if ($company == "한덱스")
		{
				
		}
		else if ($company == "FedEx")
		{
				
		}
		else if ($company == "동부익스프레스")
		{
				
		}
		else if ($company == "CJ GLS")
		{
				
		}
		else if ($company == "UPS")
		{
				
		}
		else if ($company == "하나로택배")
		{
				
		}
		else if ($company == "대신택배")
		{
				
		}
		else if ($company == "경동택배")
		{
				
		}
		else if ($company == "이노지스택배")
		{
		
		}
		else if ($company == "일양로지스택배")
		{
		
		}
		else if ($company == "CVSnet 편의점택배")
		{
		
		}
		else if ($company == "TNT Express")
		{
		
		}
		else if ($company == "HB한방택배")
		{
		
		}		
		
			
		print_r ($result);
	}


}