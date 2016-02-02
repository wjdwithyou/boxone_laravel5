<?php
namespace App\Http\models;
use DB;
include_once dirname(__FILE__)."/Utility.php";



/*
 *  쇼핑사이트 관련 컨트롤러
 */
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
	 *  쇼핑사이트 카테고리 가져오는 기능
	 */
	function getCate()
	{
		$result = DB::select('select * from shoppingsite_category');
	
		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}
	

    /*  	
     *	쇼핑사이트 리스트로 종류별로 가져오는 기능, 조회수로 정렬
     */
   function getInfoList($category_idx)
   {
      if ($category_idx == "0" || $category_idx == 0)
         $cate = "where category_idx!=10 ";
      else
         $cate = "where category_idx='$category_idx' ";
      $result = DB::select('select *, 0 as bookmark from shoppingsite '.$cate.'group by name order by hit_count desc limit 10');

      return array('code' => 1, 'msg' => 'success', 'data' => $result);
   }
	
	/*
	 *  쇼핑사이트 리스트로 문자, 종류별로 가져오는 기능, 문자로 정렬 
	 */
	function getInfoListByChar($category_idx, $char)
	{
		if ($category_idx == "0")
			$cate = "category_idx!=10 and ";
		else
			$cate = "category_idx='$category_idx' and ";
		
		$sort = "";
		if ($char == "1")
			for ($i = 0 ; $i < 10 ; $i++)
				$sort .= " or name_eng like '$i%'";
		else if ($char == "2")
			for ($i = 65 ; $i < 70 ; $i++)
				$sort .= " or name_eng like '".chr($i)."%'";
		else if ($char == "3")
			for ($i = 70 ; $i < 77 ; $i++)
				$sort .= " or name_eng like '".chr($i)."%'";
		else if ($char == "4")
			for ($i = 77 ; $i < 84 ; $i++)
				$sort .= " or name_eng like '".chr($i)."%'";
		else if ($char == "5")
			for ($i = 84 ; $i < 91 ; $i++)
				$sort .= " or name_eng like '".chr($i)."%'";
		$sort = "(".substr($sort, 3).")";
		
		$result = DB::select('select *, 0 as bookmark from shoppingsite where '.$cate.$sort.' group by name order by name_eng asc');
		
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
	function createBookmark($member_idx, $shoppingsite_idx)
	{

		if(	!(	inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($shoppingsite_idx, 'shoppingsite_idx')))
			return ;		
				
		$result = DB::table('link_bookmark')->insertGetId(
			array(
				'member_idx'=> $member_idx, 
				'shoppingsite_idx'=> $shoppingsite_idx, 
				'upload'=>DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => 'create');
	}
	
	
	/*
	 *	북마크정보 확인 기능
	 */
	function checkBookmark($member_idx, $shoppingsite_idx)
	{
	
		if(	!(	inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($shoppingsite_idx, 'shoppingsite_idx')))
				return ;
	
		$result = DB::select('select * from link_bookmark where member_idx=? and shoppingsite_idx=?', array($member_idx, $shoppingsite_idx));
		
		if (count($result) > 0)
			return array('code' => 1,'msg' =>'success' ,'data' => $result);
		else
			return array('code' => 0,'msg' =>'failure' ,'data' => $result);
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
	
	// 160202 J.Style
	// Get $member_idx's bookmark site info.
	function getBookmarkSite($member_idx){
		if ( !(inputErrorCheck($member_idx, 'member_idx')))
			return;
		
		$idxList = DB::select('select shoppingsite_idx from link_bookmark where member_idx=?', array($member_idx));
		
		$result = array();
		
		for ($i = 0; $i < count($idxList); ++$i){
			$temp = DB::select('select idx, name, website_link, name_eng from shoppingsite where idx=?', array($idxList[$i]->shoppingsite_idx));
			array_push($result, $temp);
		}
		
		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

 	/*  	
     *	북마크 삭제 기능
     */
	function deleteBookmark($member_idx, $shoppingsite_idx)
	{
		if(	!(	inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($shoppingsite_idx, 'shoppingsite_idx')))
				return ;	

 		$result = DB::delete('delete from link_bookmark where member_idx=? and shoppingsite_idx=?', array($member_idx, $shoppingsite_idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'data delete success', 'data' => 'delete');
        }else{
         	return array('code' => 0, 'msg' => 'delete false: no matched data');
        }
	}

	/*
	 *	사용자 log를 바탕으로 사이트 조회수 1씩 증가
	 */
	function increaseHitCount($shoppingsite_idx)
	{
		if( !( inputErrorCheck($shoppingsite_idx, 'shoppingsite_idx')))
			return ;

		$result = DB::update('update shoppingsite set hit_count=hit_count+1 where idx=?',
			array($shoppingsite_idx));

 		if($result == true){
          	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'update failure: no matched data');
        } 
	}
	
	/*
	 *  각 카테고리별 최고 쇼핑사이트 가져오기 (메인페이지용)
	 */
	function getBestSiteByCate()
	{
		$result = DB::select("SELECT ss.*, sc.name as cate_name 
							FROM (
								SELECT * 
								FROM (
									SELECT * 
									FROM shoppingsite 
									ORDER BY hit_count DESC) s 
								GROUP BY s.category_idx) ss 
							INNER JOIN shoppingsite_category sc ON ss.category_idx = sc.idx ");
		return $result;
	}
}






