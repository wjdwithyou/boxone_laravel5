<?php
namespace App\Http\models;
use DB;
/*
 *  알람 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";


class AlarmModel()
{





	/*
	 *	type 무관하게 마이페이지 알람중 최근 5개만 가져오는 기능
	 */
	function getInfoAlarm($member_idx)
	{
		//5개

	}






	/*
	 * 	키워드 알람 등록 기능
	 */
	function createKeywordAlarm($keyword, $member_idx)
	{



	}

	/*
	 * 	나의키워드 리스트 보여줌
	 */
	function getInfoKeywordAlarm($member_idx)
	{


		
	}

	/*
	 * 	키워드알람 삭제
	 */
	function deleteKeywordAlarm()
	{

	}



}