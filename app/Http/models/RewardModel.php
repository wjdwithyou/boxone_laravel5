<?php
namespace App\Http\models;
use DB;

/*
 *  리워드 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";

   
class RewardModel
{
    /*  	
     *	카드정보 등록 기능
     */
	function create($target_site, $target_link, $rewardsite_idx, $reward_rate)
	{

		if(	!(	inputErrorCheck($target_site, 'target_site')
				&& inputErrorCheck($target_link, 'target_link')
				&& inputErrorCheck($rewardsite_idx, 'rewardsite_idx')
				&& inputErrorCheck($reward_rate, 'reward_rate')))
			return ;		
				
		$result = DB::table('reward')->insertGetId(
			array(
				'target_site'=> $target_site, 
				'target_link'=> $target_link, 
				'rewardsite_idx'=> $rewardsite_idx, 
				'reward_rate'=> $reward_rate
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

    /*  	
     *	타깃에 해당하는 info 가져오는 기능
     */
	function getInfoListByTarget($target_site)
	{
		if(	!(	inputErrorCheck($target_site, 'target_site')))
			return ;


		$result = DB::select("(select * from reward where target_site like '%$target_site%' order by target_site DESC)
								LEFT JOIN shoppingsite ON reward.rewardsite_idx=shoppingsite.idx");

		$

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

 	/*  	
     *	리워드 삭제 기능
     */
	function delete($reward_idx)
	{
		if(	!(	inputErrorCheck($reward_idx, 'reward_idx')))
			return ;		

 		$result = DB::delete('delete from reward where idx=?', array($reward_idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'delete false: no matched data');
        }
	}


    /*  	
     *	리워드 수정 기능
     */
	function update($idx, $target_site, $target_link, $rewardsite_idx, $reward_rate)
	{
	  	   
		if(	!(	inputErrorCheck($idx, 'idx')
				&& inputErrorCheck($target_site, 'target_site')
				&& inputErrorCheck($target_link, 'target_link')
				&& inputErrorCheck($rewardsite_idx, 'rewardsite_idx')
				&& inputErrorCheck($reward_rate, 'reward_rate')))
			return ;		
				
		$result = DB::update('update reward set target_site=?, target_link=?, rewardsite_idx=?, reward_rate=? where idx = ?' ,
			array($target_site, $target_link, $rewardsite_idx, $reward_rate, $idx));
                    
 		if($result == true){
          	return array('code' => 1, 'msg' => 'success');
         }else{
          	return array('code' => 0, 'msg' => 'update false');
         } 
	}

/////////////////////////////////////////////////////////////

	/*
	 *	입력받은 카드사에 따른 카드 리스트 출력
	 */
	function getInfoListByCardcompany($cardcompany)
	{
		if( !( inputErrorCheck($cardcompany, 'cardcompany')))
			return ;

		$result = DB::select("select * from card where support_card like '%$cardcompany%'");

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}


	/*
	 * 	카드사 목록 출력하는 기능
	 */
	function getCardCardcompany()
	{
		$result = DB::select("select distinct support_card from card");

		return array('code' => 1, 'msg' => 'success', 'data' => $result);

	}


	/*
	 * 	배대지 목록 출력하는 기능
	 */
	function getCardShippingagency()
	{
		$result = DB::select("select distinct support_site from card");

		return array('code' => 1, 'msg' => 'success', 'data' => $result);

	}
}