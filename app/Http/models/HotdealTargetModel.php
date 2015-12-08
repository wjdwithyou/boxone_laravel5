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
	function getInfoHotdeal($category_idx, $last_idx, $sort_option)
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

			default: 
			break;
		}

		if ( isset($last_idx) && ($last_idx != '') ) { //사용자가 검색을 통해 인덱스 넘겼을 때 들어감
			$result = DB::select('select * from'.$target_query.' where idx<=? order by idx DESC'.$option_query.' limit 30 ',array($last_idx));
		}
		else if ($last_idx == ''){	//최초 게시판 들어갔을때 최근 리스트 보여줌
			$result = DB::select('select * from'.$target_query.' order by idx DESC'.$option_query.' limit 30');
		}
		else{
			return (array('code' => '400', 'msg' => 'invalid input at last_idx'));
		}		

		if((count($result)==1 && $last_idx==1) || count($result)==0)
		 	return array('code' => '406', 'msg' => '더 이상 게시물이 존재하지 않습니다.');
		
		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

		




}
