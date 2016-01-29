<?php
namespace App\Http\Controllers;

class Utility
{


	
	/*
	 * YYYY-MM-DD HH:MM:SS => YYYY-MM-DD
	 */
	static function getDateFromDatetime($dateTime)
	{
		return substr($dateTime, 0, 11);
	}
	
	/*
	 * YYYY-MM-DD HH:MM:SS => HH:MM:SS
	 */
	static function getTimeFromDatetime($dateTime)
	{
		return substr($dateTime, 12);
	}
	
	/*
	 * 로그인 체크
	 * 원하는 로그인 상태가 아니면 접근거부 / 로그인창 열기
	 */
	static function loginStateChk($chk)
	{
		if (session_id() == '')	session_start();
		$logined = !empty($_SESSION['idx']);
		if ($logined == $chk)
		{
			return true;
		}
		else
		{
			$host = $_SERVER['HTTP_HOST'];

			if (isset($_SERVER['HTTP_REFERER']))
			{
				$bef = $_SERVER['HTTP_REFERER'];

				// 앞 페이지가 있을 때
				if ($logined)
				{
					header("Location: http://".$host."/Mypage/index");
					die();
				}
				else 
				{
					setcookie("need_login", "1", time()+60, "/");
					if (!strpos($bef,"Mypage"))
						header("Location: ".$bef);
					else
						header("Location: http://".$host);
					die();
				}
			}
			// 앞 페이지가 없을 때
			else 
			{
				if ($logined)
				{
					header("Location: http://".$host."/Mypage/index");
					die();
				}
				else 
				{
					header("Location: http://".$host);
					die();
				}
			}
		}
	}
	
	/*
	 * 	2016.01.15
	 * 	박용호
	 * 	오늘이 아닐 경우 년-월-일 출력
	 *  오늘일 경우 시:분 출력
	 */
	static function cutDateAsToday($date)
	{		
		if (date('Y-m-d') == substr($date, 0, 10))
			return substr($date, 11, 5);
		else
			return substr($date, 0, 10);
	}
	
	/*
	 * 	2016.01.15
	 * 	박용호
	 *  달러로 받은 가격을 한국돈으로 변환, 콤마 찍기
	 */
	static function makeMoney($num)
	{
		$num = floor($num*1204.40)."";
		$str = "";
		while (strlen($num) > 3)
		{
			$str = substr($num, strlen($num)-3, 3).",".$str;
			$num = substr($num, 0, strlen($num)-3);
		}
		$str = $num.",".substr($str,0,strlen($str)-1);
			
		return $str;
	}
	
	
	/*
	 *  2016.01.15
	 *  박용호
	 *  Cosmos로 가져온 상품을 담고 있는 mssql 연결
	 */
	static function connectToMssql()
	{
		$conn = mssql_connect('cafe24', 'cstourplatform', 'q1w2e3r4!@cosmos99');
		return $conn;
	}
}
	

	
	
	
	
	
	

