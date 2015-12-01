<?php
namespace App\Http\models;
use DB;

/*
 *  해외통관 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";


class ShipmentForeignModel{
    /*  	
     *	해외통관 정보 등록 기능
     */
	function create($product_name, $year, $icon, $memo, $member_idx, $status)
	{

		if(	!(	inputErrorCheck($product_name, 'product_name')
				&& inputErrorCheck($year, 'year')
				&& inputErrorCheck($icon, 'icon')
				&& inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($memo, 'memo')
				&& inputErrorCheck($status, 'status')
				))
			return ;		
				

		$result = DB::table('shipment_foreign')->insertGetId(
			array(
				'product_name'=> $product_name, 
				'year'=> $year, 
				'icon'=> $icon, 
				'member_idx'=> $member_idx, 
				'memo'=> $memo, 
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
		
		$result = DB::select('select * from shipment_foreign where member_idx=? order by idx DESC', array($membeR_idx));

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

 	/*  	
     *	해외통관 삭제 기능
     */
	function delete($idx)
	{
		if(	!(	inputErrorCheck($idx, 'idx')))
			return ;		

 		$result = DB::delete('delete from shipment_foreign where idx=?', array($idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'delete false: no matched data');
        }
	}


    /*  	
     *	해외통관 수정 기능
     */
	function update($idx, product_name, $year, $icon, $memo, $status)
	{


		if(	!(	inputErrorCheck($idx, 'idx')
				&& inputErrorCheck($product_name, 'product_name')
				&& inputErrorCheck($year, 'year')
				&& inputErrorCheck($icon, 'icon')
				&& inputErrorCheck($memo, 'memo')
				&& inputErrorCheck($status, 'status')
				))
			return ;		
				
				
		$result = DB::update('update shipment_foreign set product_name=?, year=?, icon=?, memo=?, status=?,	upload=now() where idx=?',
			array($product_name, $year, $icon, $memo, $status, $idx));
                    
 		if($result == true){
          	return array('code' => 1, 'msg' => 'success');
         }else{
          	return array('code' => 0, 'msg' => 'update false');
         } 
	}
}