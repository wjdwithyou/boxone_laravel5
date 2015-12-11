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
	function createBookmark($member_idx, $hotdeal_idx, $target)
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
				'target'		=> $target,
				'upload'		=> DB::raw('now()')
				)
			);

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}
	
	
	/*
	 *	핫딜 북마크 검사
	 */
	function checkBookmark($member_idx, $hotdeal_idx)
	{
	
		if(	!(	inputErrorCheck($hotdeal_idx, 'hotdeal_idx')
				&& inputErrorCheck($member_idx, 'member_idx')))
					return ;

		//북마크 검사
		$result = DB::select('select idx from hotdeal_bookmark where member_idx = ? AND hotdeal_idx = ?',
			array($member_idx, $hotdeal_idx));
		if (count($result) > 0)
			return array('code' => 0, 'msg' => 'exist!');
		else
			return array('code' => 1, 'msg' => 'no!');
	}

	
	/*  	
     *	핫딜 북마크 삭제
     */
	function deleteBookmark($member_idx, $hotdeal_idx)
	{

		if(	!(	inputErrorCheck($member_idx, 'member_idx')
			 && inputErrorCheck($hotdeal_idx, 'hotdeal_idx')))
			return ;

		//북마크 -1
		DB::update('update hotdeal_promo set bookmark_count=bookmark_count-1 where idx=?',array($hotdeal_idx));

		//북마크 삭제
		$result = DB::delete('delete from hotdeal_bookmark where member_idx=? AND hotdeal_idx = ?', array($member_idx, $hotdeal_idx));

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}


	/*
	 *	북마크 리스트 가져오는 기능
	 */
	function getInfoListBookmark($member_idx)
	{
		if( !( inputErrorCheck($member_idx, 'member_idx')))
			return ;

		$result = DB::select('select * from hotdeal_bookmark where member_idx=?', array($member_idx));

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}
	
	
	/*
	 *	북마크 지정된 상품 가져오는 기능
	 */
	function getMyHotdeal($member_idx, $category_idx, $site_name, $sort_option, $page_num, $target)
	{
		if( !( inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($category_idx, 'category_idx')
				&& inputErrorCheck($site_name, 'site_name')
				&& inputErrorCheck($sort_option, 'sort_option')
				&& inputErrorCheck($page_num, 'page_num')))
					return ;
		
		// where 조건문 -> 카테고리, 회사 구분
		$query_where = "where b.target=$target and b.member_idx=$member_idx and p.idx=b.hotdeal_idx and";

		// 카테고리 구분
		if( $category_idx != 0 )
		{
			$query_where .= " category_idx=".$category_idx." and";
			$query_where2 = $query_where." category_idx=".$category_idx;
		}
		else
		{
			$query_where .= "";
			$query_where2 = substr($query_where, 0, strlen($query_where) - 3);
		}

		// 회사 구분
		if( $site_name != "0")
			$query_where .= " site_name='".$site_name."' and";
		else
			$query_where .= "";

		// where문 정리
		$query_where = substr($query_where, 0, strlen($query_where) - 3);


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
		$data = DB::select("select *, 1 as bookmark from hotdeal_promo as p, hotdeal_bookmark as b $query_where $query_orderBy, p.idx DESC");

		// 사이트명 리스트 출력 -> 선택 기준이 됨
		$company = DB::select("select distinct site_name from hotdeal_promo as p, hotdeal_bookmark as b $query_where2");

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
				
			return array('code' => 1, 'msg' => 'success', 'data' => $result, 'company' => $company, 'maxPage' => $page_max);
		}
	}

	/*
	 *	카테고리별 핫딜 30개씩 출력하는 출력 기능 
	 */
	function getInfoHotdeal($category_idx, $site_name, $sort_option, $page_num)
	{
		if( !( inputErrorCheck($category_idx, 'category_idx')
				&& inputErrorCheck($sort_option, 'sort_option')
				&& inputErrorCheck($page_num, 'page_num')))		
			return ;

		// where 조건문 -> 카테고리, 회사 구분
		$query_where = "where";
		
		// 카테고리 구분
		if( $category_idx != 0 )
		{
			$query_where .= " category_idx=".$category_idx." and";
			$query_where2 = "where category_idx=".$category_idx;
		}
		else
		{
			$query_where .= "";
			$query_where2 = "";
		}
		
		// 회사 구분
		if( $site_name != "0")
			$query_where .= " site_name='".$site_name."' and";
		else
			$query_where .= "";
		
		// where문 정리
		if ($query_where == "where")
			$query_where = "";
		else
			$query_where = substr($query_where, 0, strlen($query_where) - 3);
		
		
		// 정렬 구분
		$query_orderBy = "order by";
		switch($sort_option)
		{
			case 1: 	$query_orderBy .= ' hit_count DESC'; 	break ;
			case 2:		$query_orderBy .= ' deadline ASC'; 		break ;
			case 3:		$query_orderBy .= ' site_name ASC'; 	break ;
			default : 	$query_orderBy .= ' hit_count DESC';	break;
		}

		
		// 자료 가져오기
		$data = DB::select("select *, 0 as bookmark from hotdeal_promo $query_where $query_orderBy, idx DESC");
		
		// 사이트명 리스트 출력 -> 선택 기준이 됨
		$company = DB::select("select distinct site_name from hotdeal_promo $query_where2");

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
			
			return array('code' => 1, 'msg' => 'success', 'data' => $result, 'company' => $company, 'maxPage' => $page_max);
		}
	}
	
	/*
	 *	핫딜 힛 카운트 추가
	 */
	function updateHitCount($idx)
	{
		DB::table('hotdeal_promo')->where('idx', $idx)->increment('hit_count', 1);
		
		return array('code' => 1, 'msg' => 'success');
	}




}
