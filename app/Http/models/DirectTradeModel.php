<?php
namespace App\Http\models;
use DB;

/*
 *  직거래박스 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";


class DirectTradeModel()
{

	/*
	 *	직거래 회원 전환 메소드
	 */
	function registerDirectMember($member_idx, $name, $phone, $addr_1, $addr_2, $account_bank, $account_number)
	{
		if( !( inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($name, 'name')
				&& inputErrorCheck($phone, 'phone')
				&& inputErrorCheck($addr_1, 'addr_1')
				&& inputErrorCheck($addr_2, 'addr_2')
				&& inputErrorCheck($account_bank, 'account_bank')
				&& inputErrorCheck($account_number, 'account_number')))


		$result = DB::table('direct_member')->insertGetId(
			array(
				'member_idx'=> $member_idx, 
				'name'			=> $name, 
				'phone'			=> $phone, 
				'addr_1'		=> $addr_1, 
				'addr_2'		=> $addr_2, 
				'account_bank'	=> $account_bank, 
				'account_number'	=> $account_number, 
				'upload'=>DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}



	}


}
