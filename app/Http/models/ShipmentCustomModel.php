<?php
namespace App\Http\models;
use DB;
include_once dirname(__FILE__)."/Utility.php";



/*
 *  해외통관 관련 컨트롤러
 */
class ShipmentCustomModel{
    /*  	
     *	해외통관 정보 등록 기능
     */
	function create($entry_num, $year, $member_idx, $status)
	{

		if(	!(	inputErrorCheck($entry_num, 'entry_num')
				&& inputErrorCheck($year, 'year')
				&& inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($status, 'status')
				))
			return ;		
				

		$result = DB::table('shipment_custom')->insertGetId(
			array(
				'entry_num'=> $entry_num, 
				'year'=> $year, 
				'member_idx'=> $member_idx, 
				'status'=> $status, 
				'upload'=>DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

    /*  	
     *	해외통관 리스트 가져오는 기능
     */
	function getInfoList($member_idx)
	{
		if(	!(	inputErrorCheck($member_idx, 'member_idx')))
			return ;	
		
		$result = DB::select('select * from shipment_custom where member_idx=? order by idx DESC', array($member_idx));

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

 	/*  	
     *	해외통관 삭제 기능
     */
	function delete($idx)
	{
		if(	!(	inputErrorCheck($idx, 'idx')))
			return ;		

 		$result = DB::delete('delete from shipment_custom where idx=?', array($idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'delete false: no matched data');
        }
	}


  /*  	
     *	해외배송 수정 기능
     */
	function update($idx, $status)
	{

		if(	!(	inputErrorCheck($idx, 'idx')
				&& inputErrorCheck($status, 'status')
				))
			return ;		
				
		$result = DB::update('update shipment_custom set status=?, upload=now() where idx=?',
			array($status, $idx));
                    
 		if($result == true){
          	return array('code' => 1, 'msg' => 'success');
         }else{
          	return array('code' => 0, 'msg' => 'update false');
         } 
	}
	
	/*
	 *  배송중인 항목 갯수
	 */
	function getCntDeliver($member_idx)
	{
		$result = DB::select("SELECT count(*) as cnt FROM shipment_custom WHERE member_idx = ? AND status = 0", array($member_idx));
	
		return $result[0]->cnt;
	}
	
	/*
	 *  단일 정보 가져오기
	 */
	function getInfoSingle($idx)
	{
		$result = DB::select("SELECT * FROM shipment_custom WHERE idx = ?", array($idx));
	
		return $result;
	}
}