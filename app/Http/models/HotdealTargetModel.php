<?php
namespace App\Http\models;
use DB;

/*
 *  핫딜 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";


class HotdealTargetModel()
{

	/*
	 *	핫딜 생성 함수
	 */
	function create($site_name, $title, $deadline, $promo_code, $price, $category_idx, $website_link)
	{
		if( !( inputErrorCheck($site_name, 'site_name')
				&& inputErrorCheck($title, 'title')
				&& inputErrorCheck($deadline, 'deadline')
				&& inputErrorCheck($promo_code, 'promo_code')
				&& inputErrorCheck($price, 'price')
				&& inputErrorCheck($category_idx, 'category_idx')
				&& inputErrorCheck($website_link, 'website_link')))
			return ;



		$result = DB::table('hotdeal_target')->insertGetId(
			array(
				'site_name'		=> $site_name, 
				'title'			=> $title, 
				'deadline'		=> $deadline, 
				'promo_code'	=> $promo_code, 
				'price'			=> $price, 
				'category_idx'	=> $category_idx, 
				'website_link'	=> $website_link, 
				'upload'=>DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}



	/*  	
     *	핫딜 북마크 추가
     */
	function createBookmark($member_idx, $hotdeal_idx)
	{

		if(	!(	inputErrorCheck($hotdeal_idx, 'hotdeal_idx')
		 		&& inputErrorCheck($member_idx, 'member_idx')))
			return ;

		//북마크 +1
		DB::update('update hotdeal_target set bookmark_count=bookmark_count+1 where idx=?',array($hotdeal_idx));

		//북마크 생성
		$result = DB::table('hotdeal_bookmark')->insertGetId(
			array(
				'member_idx'	=> $member_idx,
				'hotdeal_idx'	=> $hotdeal_idx, 	
				'upload'	=> DB::raw('now()')
				)
			);

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	
	/*  	
     *	핫딜 북마크 삭제
     */
	function deleteBookmark($bookmar_idx, $hotdeal_idx)
	{

		if(	!(	inputErrorCheck($bookmark_idx, 'bookmark_idx')
			 && inputErrorCheck($hotdeal_idx, 'hotdeal_idx')))
			return ;

		//북마크 -1
		DB::update('update hotdeal_target set bookmark_count=bookmark_count-1 where idx=?',array($hotdeal_idx));

		//북마크 삭제
		$result = DB::delete('delete from hotdeal_bookmark where idx=?', array($bookmar_idx));

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}


	/*
	 *	핫딜 리스트 가져오는 기능
	 */
	function getMyHotdeal($member_idx)
	{
		if( !( inputErrorCheck($member_idx, 'member_idx')))
			return ;

		$result = DB::select('select * from hotdeal_bookmark where member_idx=?', array($member_idx));

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	카테고리별 핫딜 출력 기능 
	 */
	function getInfoHotdeal()
	{

		
	}

}
