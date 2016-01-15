<?php
namespace App\Http\models;
use DB;
include_once dirname(__FILE__)."/Utility.php";



/*
 *  국내배송 관련 컨트롤러
 */
class ShipmentDomesticModel{
    /*  	
     *	국내배송정보 등록 기능
     */
	function create($product_name, $postal_num, $postal_agency, $memo, $member_idx, $icon, $status)
	{

		if(	!(	inputErrorCheck($product_name, 'product_name')
				&& inputErrorCheck($postal_agency, 'postal_agency')
				&& inputErrorCheck($postal_num, 'postal_num')
				&& inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($memo, 'memo')
				&& inputErrorCheck($icon, 'icon')
				&& inputErrorCheck($status, 'status')
				))
			return ;		
				

		$result = DB::table('shipment_domestic')->insertGetId(
			array(
				'product_name'=> $product_name,
				'postal_num'=> $postal_num,
				'postal_agency'=> $postal_agency, 
				'member_idx'=> $member_idx, 
				'memo'=> $memo, 
				'status'=> $status, 
				'icon'=> $icon,
				'upload'=>DB::raw('now()')
				)
			);	

		return array('code' => 1, 'msg' =>'success' ,'data' => $result);
	}

    /*  	
     *	국내배송 리스트 가져오는 기능
     */
	function getInfoList($member_idx)
	{
		if(	!(	inputErrorCheck($member_idx, 'member_idx')))
			return ;	
		
		$result = DB::select('select * from shipment_domestic where member_idx=? order by idx DESC', array($member_idx));

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

 	/*  	
     *	국내배송 삭제 기능
     */
	function delete($idx)
	{
		
		if(	!(	inputErrorCheck($idx, 'idx')))
			return ;		

 		$result = DB::delete('delete from shipment_domestic where idx=?', array($idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'delete false: no matched data');
        }
	}


    /*  	
     *	국내배송 수정 기능
     */
	function update($idx, $product_name, $postal_num, $postal_agency, $memo, $icon, $status)
	{

		if(	!(	inputErrorCheck($idx, 'idx')
				&& inputErrorCheck($product_name, 'product_name')
				&& inputErrorCheck($postal_num, 'postal_num')
				&& inputErrorCheck($postal_agency, 'postal_agency')
				&& inputErrorCheck($memo, 'memo')
				&& inputErrorCheck($icon, 'icon')
				&& inputErrorCheck($status, 'status')
				))
			return ;		
				
		$result = DB::update('update shipment_domestic set product_name=?, postal_num=?, postal_agency=?, memo=?, icon=?, status=?,	upload=now() where idx=?',
			array($product_name, $postal_num, $postal_agency, $memo, $icon, $status, $idx));
                    
 		if($result == true){
          	return array('code' => 1, 'msg' => 'success');
         }else{
          	return array('code' => 0, 'msg' => 'update false');
         } 
	}
}