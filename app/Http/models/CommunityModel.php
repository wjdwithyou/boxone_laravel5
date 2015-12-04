<?php
namespace App\Http\models;
use DB;
/*
 *  커뮤니티 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";

class CommunityModel{

    /*  	
     *	게시물 등록 기능
     */
	function create($member_idx, $title, $contents, $commucategory_idx)
	{
		if(	!(	inputErrorCheck($member_idx, 'member_idx')
		 		&& inputErrorCheck($title, 'title')
		 		&& inputErrorCheck($contents, 'contents')
		 		&& inputErrorCheck($commucategory_idx, 'commucategory_idx')))
			return ;
		
		$result = DB::table('community')->insertGetId(
			array(
				'member_idx'=> $member_idx, 
				'title'=> $title, 
				'contents'=> $contents, 
				'commucategory_idx'=> $commucategory_idx,
				'upload'=>DB::raw('now()')
				)
			);		
		                      
		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

	/*  	
     *	댓글 등록 기능
     */
	function createReply($member_idx, $community_idx, $contents)
	{
		
		if(	!(	inputErrorCheck($member_idx, 'member_idx')
		 		&& inputErrorCheck($community_idx, 'community_idx')
		 		&& inputErrorCheck($contents, 'contents')))
			return ;
		

		$result = DB::table('community_reply')->insertGetId(
			array(
				'member_idx'=> $member_idx,
				'community_idx'	=> $community_idx, 	
				'contents'	=> $contents,
				'upload'	=> DB::raw('now()')
				)
			);
		                  
		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

    /*  	
     *	게시물 수정 기능
     */
	function update($community_idx, $title, $contents, $commucategory_idx)
	{

		if(	!(	inputErrorCheck($community_idx, 'community_idx')
		 		&& inputErrorCheck($title, 'title')
		 		&& inputErrorCheck($contents, 'contents')
		 		&& inputErrorCheck($commucategory_idx, 'commucategory_idx')))
			return ;

		$result = DB::update('update community set title=?, contents=?, commucategory_idx=?, upload=now() where idx = ?',
			array($title, $contents, $community_idx, $commucategory_idx));
                    
 		if($result == true){
          	return array('code' => 1, 'msg' => 'update success');
         }else{
          	return array('code' => 0, 'msg' => 'update failure');
         } 
	}

    /*  	
     *	댓글 수정 기능
     */
	function updateReply($reply_idx, $contents)
	{

		if(	!(	inputErrorCheck($reply_idx, 'reply_idx')
		 		&& inputErrorCheck($contents, 'contents')))
			return ;

		$result = DB::update('update community_repy set contents=? where idx=?',
			array($contents, $reply_idx));
                    
 		if($result == true){
          	return array('code' => 1, 'msg' => 'update success');
         }else{
          	return array('code' => 0, 'msg' => 'update failure');
         } 	
	}

	  
    /*  	
     *	게시물 삭제 기능
     */
	function delete($community_idx)
	{
	  	
		if(	!(	inputErrorCheck($community_idx, 'community_idx')))
			return ;		

 		$result = DB::delete('delete from community where idx=?', array($community_idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'delete failure: no matched data');
        }
	}
	  

    /*  	
     *	댓글 삭제 기능
     */
	function deleteReply($reply_idx)
	{
	  	
		if(	!(	inputErrorCheck($reply_idx, 'reply_idx')))
			return ;		

 		$result = DB::delete('delete from community_reply where idx=?', array($reply_idx));
                        
		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'delete failure: no matched data');
        }
	}

	/*
	 *	대분류 리스트 중복제거하고 출력
	 */
	function getLargeCategory()
	{
		$result = DB::select('select distinct large_name from community_category');

        return array('code' => 1 , 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	각각 대분류에 해당하는 중분류 리스트 출력
	 */
	function getSmallCategory($large_name)
	{
		$result = DB::select('select idx, name from community_category where large_name=?',
			array($large_name));

        return array('code' => 1 , 'msg' => 'success', 'data' => $result);
	}


	/*
	 *	해당 자료 갯수 가져옴
	 */
	function getResultSize($commucategory_idx_array)
	{
		$commucategory_query = "";
		for( $i=0; $i<count($commucategory_idx_array); $i++)
		{
			$commucategory_query .= "commucategory_idx like '%" .$commucategory_idx_array[$i]. "%'";
			if( $i != count($commucategory_idx_array)-1)
				$commucategory_query .= " OR ";
		}
		$result = DB::select('select * from community where ' .$commucategory_query. ' order by idx DESC');

		return count($result);
	}

    /*  	
     *	게시물 목록 가져오는 기능
     */
	function getInfoList($commucategory_idx_array, $page_num, $maximum_page)
	{

		$commucategory_query = "";
		for( $i=0; $i<count($commucategory_idx_array); $i++)
		{
			$commucategory_query .= "commucategory_idx like '%" .$commucategory_idx_array[$i]. "%'";
			if( $i != count($commucategory_idx_array)-1)
				$commucategory_query .= " OR ";
		}
		
		// 마지막 데이터까지 전부 출력
		if( $maximum_page == $page_num)
		{
			$result = DB::select('select * from community where ' .$commucategory_query. ' order by idx DESC');
		}
		// 맥시멈 데이터까지만 출력
		else
		{
			$maximum_val = ($page_num)*5;
			$result = DB::select('select * from community where ' .$commucategory_query. ' order by idx DESC limit ?',
				array($maximum_val));
		}

		$finish = count($result);
		//해당하는 내용이 없을 경우
		if( $finish==0 )
		 	return array('code' => '406', 'msg' => 'no matched result');
		
		$start = ($page_num-1)*5;
		for($i=$start; $i<$finish; $i++) 
		{
			$member_idx = $result[$i]->member_idx;
			
			$temp = DB::select('select nickname from member where idx=?', array($member_idx));
			$result[$i]->nickname  = $temp[0]->nickname;		
		}

       return array('code' => 1, 'msg' => 'success', 'data' => array_slice($result, $start, $finish));
	}


    /*  	
     *	게시물 댓글 목록 가져오는 기능
     */
	function getReplyList($community_idx, $readmember_idx)		// 게시글인덱스, 현재 보고있는 사용자 인덱스
	{

		if(	!(	inputErrorCheck($community_idx, 'community_idx')
		 		&& inputErrorCheck($readmember_idx, 'readmember_idx')))
			return ;

		$result = DB::select('select * from community_reply where community_idx=? order by idx DESC ', 
			array($community_idx));

		
		for($i=0; $i<count($result); $i++) 
		{
			$writermember_idx = $result[$i]->member_idx;

			// 둘이 동일인일 경우 own권한 부여
			if($readmember_idx == $writermember_idx)
				$result[$i]->own = 'Y';
			else
				$result[$i]->own = 'N';
			
			$temp = DB::select('select image, nickname from member where idx=?', array($writermember_idx));

			$result[$i]->image 		= $temp[0]->image;
			$result[$i]->nickname 	= $temp[0]->nickname;			
		}

       return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}


	/*
	 *  게시물의 제목+내용 필터로 검색
	 */
	function getInfoByText($text)
	{

		if( !( inputErrorCheck($text, 'text')))
			return ;

		$result = DB::select("select distinct * from community where title like '%$text%' or contents like '%$text%'");
		
		return array('code' => 1, 'data' => $result);
	}


	/*  	
     *	단일 게시글 가져오는 기능 + 조회수 1 증가
     */
	function getInfoSingle($community_idx, $readmember_idx)
	{

		if(	!(	inputErrorCheck($community_idx, 'community_idx')
		 		&& inputErrorCheck($readmember_idx, 'readmember_idx')))
			return ;

		// 해당 게시물의 작성자 정보
		$result = DB::select('select * from community where idx =?',array($community_idx));
		$writer_mem = $result[0]->member_idx;

		DB::update('update community set hit_count=hit_count+1 where idx=?',array($community_idx));

		if($writer_mem == $readmember_idx)
			$result[0]->own = 'Y';
		else
			$result[0]->own = 'N';

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*  	
     *	커뮤니티 글 북마크 추가
     */
	function createBookmark($member_idx, $community_idx)
	{

		if(	!(	inputErrorCheck($community_idx, 'community_idx')
		 		&& inputErrorCheck($member_idx, 'member_idx')))
			return ;

		//북마크 +1
		DB::update('update community set bookmark_count=bookmark_count+1 where idx=?',array($community_idx));

		//북마크 생성
		$result = DB::table('community_bookmark')->insertGetId(
			array(
				'member_idx'	=> $member_idx,
				'community_idx'	=> $community_idx, 	
				'upload'	=> DB::raw('now()')
				)
			);

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*  	
     *	커뮤니티 글 북마크 삭제
     */
	function deleteBookmark($bookmar_idx, $community_idx)
	{

		if(	!(	inputErrorCheck($bookmark_idx, 'bookmark_idx')
			 && inputErrorCheck($community_idx, 'community_idx')))
			return ;

		//북마크 -1
		DB::update('update community set bookmark_count=bookmark_count-1 where idx=?',array($community_idx));

		//북마크 삭제
		$result = DB::delete('delete from community_bookmark where idx=?', array($bookmark_idx));

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*  	
     *	내가 쓴 글 목록 가져오기
     */
	function getInfoMyCommunity($member_idx)
	{

		if(	!(	inputErrorCheck($member_idx, 'member_idx')))
			return ;

		$result = DB::select('select * from community where member_idx=? order by idx DESC', array($member_idx));

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*  	
     *	내가 쓴 글 목록 가져오기
     */
	function getInfoMyReply($member_idx)
	{

		if(	!(	inputErrorCheck($member_idx, 'member_idx')))
			return ;

		$result = DB::select('select * from community_reply where member_idx=? order by idx DESC', array($member_idx));

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}	

}