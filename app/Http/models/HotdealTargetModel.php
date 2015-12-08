<?php
namespace App\Http\models;
use DB;

/*
 *  핫딜 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";


class HotdealTargetModel
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



		$result = DB::table('hotdeal_promo')->insertGetId(
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
		DB::update('update hotdeal_promo set bookmark_count=bookmark_count+1 where idx=?',array($hotdeal_idx));

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
		DB::update('update hotdeal_promo set bookmark_count=bookmark_count-1 where idx=?',array($hotdeal_idx));

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
	 *	카테고리별 핫딜 30개씩 출력하는 출력 기능 
	 */
	function getInfoHotdeal($category_idx, $sort_option, $maximum_page, $page_num)
	{
		if( !( inputErrorCheck($category_idx, 'category_idx')
				&& inputErrorCheck($last_idx, 'last_idx')))		
			return ;

		$target_query = "select * from hotdeal_promo"; 
		if( $category_idx != 0 ){
			$target_query .= " where category_idx=".$category_idx;
		}	

		$option_query;
		switch($sort_option)
		{
			case 1:
			$option_query = ', hit_count DESC';
			break ;

			case 2:
			$option_query = ', site_name ASC';
			break ;

			case 3:
			$option_query = ', deadline DESC';
			break ;

			default 
			break;
		}

		// 마지막 데이터까지 전부 출력
		if( $maximum_page == $page_num)
		{
			$result = DB::select('select * from'.$target_query.' where category_idx=? order by idx DESC'.$option_query.' limit 30', array($category_idx));
		}
		// 맥시멈 데이터까지만 출력
		else
		{
			$maximum_val = ($page_num)*30;
			$result = DB::select('select * from'.$target_query.' where category_idx=? order by idx DESC'.$option_query.' limit ?', array($maximum_val));
		}

		$finish = count($result);
		//해당하는 내용이 없을 경우
		if( $finish==0 )
		 	return array('code' => '406', 'msg' => 'no matched result');

		$start = ($page_num-1)*$product_num;

       return array('code' => 1, 'msg' => 'success', 'data' => array_slice($result, $start, $finish));		
	}

		
	/*
	 *	해당 핫딜 갯수 가져옴
	 */
	function getResultSize($category_idx)
	{

		if( $category_idx == 0)
			$result = DB::select('select * from hotdeal_promo');
		else
			$result = DB::select('select * from hotdeal_promo where category_idx=?', array($category_idx));

		return count($result);
	}




}
