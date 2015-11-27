<?php
namespace App\Http\models;
use DB;

/*
 *  쇼핑사이트 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";

class ShoppingsiteModel{
    /*  	
     *	쇼핑사이트정보 등록 기능
     */
	function create($name, $website_link, $category_idx, $note)
	{

		if(	!(	inputErrorCheck($name, 'name')
				&& inputErrorCheck($website_link, 'website_link')
				&& inputErrorCheck($category_idx, 'category_idx')
				&& inputErrorCheck($note, 'note')))
			return ;		
				

		$result = DB::table('shoppingsite')->insertGetId(
			array(
				'name'=> $name, 
				'website_link'=> $website_link, 
				'category_idx'=> $category_idx, 
				'note'=> $note
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

    /*  	
     *	쇼핑사이트 리스트로 종류별로 가져오는 기능
     */
	function getInfoList($category_idx)
	{
		$result = DB::select('select * from shoppingsite where category_idx=?', array($category_idx));

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}


 	/*  	
     *	쇼핑사이트 삭제 기능
     */
	function delete($idx)
	{

		if(	!(	inputErrorCheck($idx, 'idx')))
			return ;		

 		$result = DB::delete('delete from shoppingsite where idx=?', array($idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'update failure: no matched data');
        }
	}


    /*  	
     *	쇼핑사이트 수정 기능
     */
	function update($idx, $name, $website_link, $category_idx, $note)
	{
	  	   
		if(	!(	inputErrorCheck($idx, 'idx')
				&& inputErrorCheck($name, 'name')
				&& inputErrorCheck($website_link, 'website_link')
				&& inputErrorCheck($category_idx, 'category_idx')
				&& inputErrorCheck($note, 'note')))
			return ;		
				
		$result = DB::update('update shoppingsite set name=?, website_link=?, category_idx=?, note=? where idx = ?',
			array($name, $website_link, $category_idx, $note, $idx));
                    
 		if($result == true){
          	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'update failure: no matched data');
        } 
	}


    /*  	
     *	북마크정보 등록 기능
     */
	function createBookmark($member_idx, $website_link)
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
	function getInfoListBookmark($member_idx)
	{
		if(!(inputErrorCheck($member_idx, 'member_idx')))
			return ;

		$result = DB::select('select * from link_bookmark where member_idx=? order by idx DESC',
			array($member_idx));

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

 	/*  	
     *	북마크 삭제 기능
     */
	function deleteBookmark($idx)
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
}