<?php
namespace App\Http\models;
use DB;
/*
 *  카드 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";

   
class CardModel{
    /*  	
     *	카드정보 등록 기능
     */
	function create($title, $contents, $status)
	{

		if(	!(	inputErrorCheck($title, 'title')
				&& inputErrorCheck($contents, 'contents')
				&& inputErrorCheck($status, 'status')))
			return ;		
				
		$result = DB::table('card')->insertGetId(
			array(
				'title'=> $title, 
				'contents'=> $contents, 
				'status'=> $status, 
				'upload'=>DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

    /*  	
     *	카드 리스트로 종류별로 가져오는 기능
     */
	function getInfoList($status)
	{
		$result = DB::select('select * from card where status=? order by idx DESC', array($status));

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}


    /*  	
     *	카드 이름으로 검색하는 기능
     */
	function getInfoByName($title)
	{
		$result = DB::select("select * from card where title like '%$title%'");

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}


 	/*  	
     *	카드 삭제 기능
     */
	function delete($card_idx)
	{
		if(	!(	inputErrorCheck($card_idx, 'card_idx')))
			return ;		

 		$result = DB::delete('delete from card where idx=?', array($card_idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'delete false: no matched data');
        }
	}


    /*  	
     *	카드 수정 기능
     */
	function update($idx, $title, $contents)
	{
	  	   
		if(	!(	inputErrorCheck($idx, 'idx')
				&& inputErrorCheck($title, 'title')
				&& inputErrorCheck($contents, 'contents')))
			return ;		
				
		$result = DB::update('update card set title=?, contents=?, upload=now() where idx = ?' ,
			array($title, $contents, $idx));
                    
 		if($result == true){
          	return array('code' => 1, 'msg' => 'success');
         }else{
          	return array('code' => 0, 'msg' => 'update false');
         } 
	}

	/*
	 *	입력받은 배대지에 해당하는 카드 리스트 출력
	 */
	function getInfoListByShippingagency($shippingagency)
	{
		if( !( inputErrorCheck($shippingagency, 'shippingagency')))
			return ;

		$result = DB::select("select * from card where support_site like '%$shippingagency%'");

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}


	/*
	 *	입력받은 카드사에 따른 카드 리스트 출력
	 */
	function getInfoListByCardcompany($cardcompany)
	{
		if( !( inputErrorCheck(($cardcompany, 'cardcompany')))
			return ;

		$result = DB::select("select * from card where support_card like '%$cardcompany%'");

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

}