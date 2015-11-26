<?php

/*
 *  북마크 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";

    /*  	
     *	북마크정보 등록 기능
     */
	function create($member_idx, $website_link)
	{

		if(	!(	inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($website_link, 'website_link')))
			return ;		
				
		$result = DB::table('link_bookmark')->insertGetId(
			array(
				'member_idx'=> $member_idx, 
				'website_link'=> $website_link, 
				'upload'=>DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

    /*  	
     *	북마크 리스트 가져오는 기능
     */
	function getInfoList()
	{
		$result = DB::select('select * from link_bookmark where order by idx DESC');

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

 	/*  	
     *	북마크 삭제 기능
     */
	function delete($idx)
	{
		if(	!(	inputErrorCheck($idx, 'idx')))
			return ;		

 		$result = DB::delete('delete from link_bookmark where idx=?', array($idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'data delete success');
        }else{
         	return array('code' => 0, 'msg' => 'delete false: no matched data');
        }
	}
