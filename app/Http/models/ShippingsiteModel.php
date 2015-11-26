<?php

/*
 *  쇼핑사이트 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";

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
     *	쇼핑사이트 리스트 카테고리 분류별로 가져오는 기능
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

 		$result = DB::delete('delete from Shippingagency where idx=?', array($idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'update failure: no matched data');
        }
	}


    /*  	
     *	쇼핑사이트 수정 기능
     */
	function update($idx, $title, $contents)
	{
	  	   
		if(	!(	inputErrorCheck($idx, 'idx')
				&& inputErrorCheck($title, 'title')
				&& inputErrorCheck($contents, 'contents')))
			return ;		
				
		$result = DB::update('update Shippingagency set title=?, contents=?, upload=now() where idx = ?' ,
			array($title, $contents, $idx));
                    
 		if($result == true){
          	return array('code' => 1, 'msg' => 'success');
         }else{
          	return array('code' => 0, 'msg' => 'update failure: no matched data');
         } 
	}
