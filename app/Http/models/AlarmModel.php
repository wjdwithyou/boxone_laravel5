<?php
namespace App\Http\models;
use DB;
include_once dirname(__FILE__)."/Utility.php";


/*
 *  알람 관련 컨트롤러
 */
class AlarmModel
{





	/*
	 *	type 무관하게 마이페이지 알람중 최근 5개만 가져오는 기능
	 */
	function getInfoAlarm($member_idx)
	{
		if( !( inputErrorCheck($member_idx, 'member_idx')))
			return ;

		$result = DB::select('select * from alarm_mypage where member_idx=? limit 5', array($member_idx));

      	return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}






	/*
	 * 	키워드 알람 등록 기능
	 */
	function createKeywordAlarm($keyword, $member_idx, $target_table)
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