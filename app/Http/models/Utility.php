<?php


	/*
	 * 	2016.01.15
	 * 	박용호
	 * 	인풋 에러 체크 함수
	 * 	parameter, columnName, type
	 */
	function inputErrorCheck($parameter, $columnName)
	{
		if(isset($parameter) && ($parameter!=''))
			return TRUE;
		else
		{
			echo json_encode( array('code' => '400', 'msg' => 'invalid input at '.$columnName));
			return FALSE;
		}
	}

	/*
	 *	이미지 사진 등록 함수
	 */
	function insertImg($target_idx, $document_idx, $image, $ext, $image_num)
	{
		if( ! (inputErrorCheck($target_idx, 'target_idx')
			  && inputErrorCheck($document_idx, 'document_idx')
			  && inputErrorCheck($image, 'image')
			  && inputErrorCheck($image_num, 'image_num')))
				return;
		
		//$image->move("/tmp", "test.jpg");
			
		$s3 = App::make('aws')->createClient('s3');
//		$image = Image::make('/tmp/test.jpg')->fit(317,374)->save('/tmp/test_317.jpg');
//		$image = Image::make('/tmp/test.jpg')->fit(164,167)->save('/tmp/test_164.jpg');

		switch ($target_idx) {
			// community
			case '1':
			$image_name = $document_idx.'_image'.$image_num.'.'.$ext;
			$s3->putObject(array(
				'Bucket'	=> 'boxone-image',
				'Key'		=> 'community/'.$image_name,
				'SourceFile'	=> $image,
				));
			break;
			
			// member
			case '2':
			$image_name = $document_idx.'_image.'.$ext;
			$s3->putObject(array(
				'Bucket'	=> 'boxone-image',
				'Key'		=> 'profile/'.$image_name,
				'SourceFile'	=> $image,
				));							
			break;
			
			
			// social member
			case '3':
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $image);
				curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'SSLv3');
				curl_setopt($ch, CURLOPT_TIMEOUT, 10);
				ob_start();
				$res = curl_exec($ch);
				$buffer = ob_get_contents();
				ob_end_clean();
				$image_name = $document_idx.'_image.'.$ext;
				
				file_put_contents("img/community/".$image_name, $buffer);
				$s3->putObject(array(
						'Bucket'	=> 'boxone-image',
						'Key'		=> 'profile/'.$image_name,
						'SourceFile' => "img/community/".$image_name,
				));
				unlink("img/community/".$image_name);
			break;

			// community complain
			case '4':
			$s3->putObject(array(
				'Bucket'	=> 'boxone_image/community_complain',
				'Key'		=> $document_idx.'_image'.$image_num.'.jpg',
				'SourceFile'	=> '/tmp/test.jpg',
				));				
			$result = DB::update('update community_complain set image= CONCAT(image, "?") where idx=?', array($image_name, $document_idx));
			break;

			// direct product
			case '5':
			$s3->putObject(array(
				'Bucket'	=> 'boxone_image/direct_product',
				'Key'		=> $document_idx.'_image'.$image_num.'.jpg',
				'SourceFile'	=> '/tmp/test.jpg',
				));				
			$result = DB::update('update direct_product set image= CONCAT(image, "?") where idx=?', array($image_name, $document_idx));
			break;

			default:
			break;
		}
			
		//File::delete("/tmp/test.jpg");

//		File::delete("/tmp/test_317.jpg");
//		File::delete("/tmp/test_164.jpg");

		return array('code' => '200', 'data' => 'image uplaod success');
				
	}
	
	/*
	 * YYYY-MM-DD HH:MM:SS => YYYY-MM-DD
	 */
	function getDateFromDatetime($dateTime)
	{
		return substr($dateTime, 0, 11);
	}
	
	/*
	 * YYYY-MM-DD HH:MM:SS => HH:MM:SS
	 */
	function getTimeFromDatetime($dateTime)
	{
		return substr($dateTime, 12);
	}
	
	/*
	 * 로그인 체크
	 * 원하는 로그인 상태가 아니면 접근거부 / 로그인창 열기
	 */
	function loginStateChk($chk)
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
	function cutDateAsToday($date)
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
	function makeMoney($num)
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
	function connectToMssql()
	{
		$conn = mssql_connect('cafe24', 'cstourplatform', 'q1w2e3r4!@cosmos99');
		return $conn;
	}
	

	
	
	
	
	
	

