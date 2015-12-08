<?php
namespace App\Http\models;
use DB;
/*
 *  카테고리 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";

class CategoryModel{


	/*
	 *	소분류 -> 대분류 
	 */
	function downToUp($small_idx)
	{

		$result = DB::select('select * from
							(
								(
								 category_small as cs 
								 JOIN category_medium as cm
								 ON cs.medium_idx=cm.idx
								) as cms
							 LEFT JOIN category_large as cl 
							 ON cms.large_idx=cl.idx
							) where cs.idx=?', array($small_idx));

      	return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	대분류 -> 소분류 
	 */
	function upToDown($large_idx)
	{
		if( !( inputErrorCheck($large_idx, 'large_idx')))
			return ;

		$result = DB::select('select * from
						(
							(
							 (select * from category_large where idx=?) as cl 
							 LEFT JOIN category_medium as cm
							 ON cl.idx=cm.large_idx
							) as clm
						 LEFT JOIN category_small as cs 
						 ON clm.idx=cs.medium_idx
						)',array($large_idx));

      	return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	대분류 리스트 업 
	 */
	function getInfoListLarge()
	{
		$result = DB::select('select * from category_large')

      	return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	중분류 리스트 업 
	 */
	function getInfoListMedium($large_idx)
	{
		if( !( inputErrorCheck($large_idx, 'large_idx')))
			return ;

		$result = DB::select('select * from category_medium where large_idx=?', array($large_idx));

	    return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	소분류 리스트 업 
	 */
	function getInfoListSmall($medium_idx)
	{
		if( !( inputErrorCheck($medium_idx, 'medium_idx')))
			return ;

		$result = DB::select('select * from category_small where medium_idx=?', array($medium_idx));

	    return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

}