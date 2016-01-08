<?php
namespace App\Http\models;
use DB;
/*
 *  카드 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";

   
class ProductModel{

	function createBookmark($prod_idx, $member_idx)
	{
		if( !( inputErrorCheck($prod_idx, 'prod_idx')
			   && inputErrorCheck($member_idx, 'member_idx')))
			return ;


		$result = DB::table('product_bookmark')->insertGetId(
			array(
				'prod_idx'=> $prod_idx, 
				'member_idx'=> $member_idx, 
				'upload'=>DB::raw('now()')
				)
			);	

		DB::update('update product set bookmark_count=bookmark_count+1 where idx=?',array($prod_idx));

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}


	/*  	
     *	단일 정보 가져오는 기능
     */
	function getInfoSingle($prod_idx)
	{

		if(	!(	inputErrorCheck($prod_idx, 'prod_idx')))
			return ;

		$result = DB::select('select * from product where idx =?',array($prod_idx));

		DB::update('update product set hit_count=hit_count+1 where idx=?',array($prod_idx));

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	정보 리스트 가져오는 기능
	 */
	function getInfoList($cate_small)
	{
		if( !( inputErrorCheck($cate_small, 'cate_small')))
					return ;

		// 정렬 구분
		$query_orderBy = "order by";
		switch($sort_option)
		{
			case 1: 	$query_orderBy .= ' hit_count DESC'; 	break ;
			case 2:		$query_orderBy .= ' deadline ASC'; 		break ;
			case 3:		$query_orderBy .= ' site_name ASC'; 	break ;
			default : 	$query_orderBy .= ""; 					break;
		}


		// 자료 가져오기
		$data = DB::select("select * from product where cate_small=$cate_small $query_orderBy, idx DESC");

		// 갯수 확인 후 페이지 자르기
		if (count($data) == 0)
			return array('code' => '0', 'msg' => 'no matched result');
		else
		{
			$page_max = floor((count($data)-1) / 30) + 1;
			if ($page_num > $page_max)
				$page_num = $page_max;
			$page_start = ($page_num-1)*30;
			$result = array_slice($data, $page_start, 30);
				
			return array('code' => 1, 'msg' => 'success', 'data' => $result, 'maxPage' => $page_max);
		}
	}


}