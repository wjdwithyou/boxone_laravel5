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
	function create($member_idx, $title, $contents, $category_small)
	{
		if(	!(	inputErrorCheck($member_idx, 'member_idx')
		 		&& inputErrorCheck($title, 'title')
		 		&& inputErrorCheck($contents, 'contents')
		 		&& inputErrorCheck($category_small, 'category_small')))
			return ;
		
		$result = DB::table('community')->insertGetId(
			array(
				'member_idx'=> $member_idx, 
				'title'=> $title, 
				'contents'=> $contents, 
				'category_small'=> $category_small,
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
	function update($community_idx, $title, $contents)
	{
	  	   

		if(	!(	inputErrorCheck($community_idx, 'community_idx')
		 		&& inputErrorCheck($title, 'title')
		 		&& inputErrorCheck($contents, 'contents')))
			return ;

		$result = DB::update('update community set title=?, contents=?, upload=now() where idx = ?' ,
			array($title, $contents, $community_idx));
                    
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
     *	게시물 목록 가져오는 기능
     */
	function getInfoList($last_idx)
	{
		if ( isset($last) && ($last != '') ) { //사용자가 검색을 통해 인덱스 넘겼을 때 들어감
			$result = DB::select('select * from community where idx <=? order by idx DESC limit 20 ',array($last_idx));
		}else if ($last == ''){				   //최초 게시판 들어갔을때 최근 리스트 보여줌
			$result = DB::select('select * from community order by idx DESC limit 20 ',array());
		}else{								   //잘못된 인풋값
			return array('code' => 0, 'msg' => 'invalid input at idx'));
			return;
		}
		
		//끝에 도달하였을 경우
		if((count($result)==1 && $last==1) ||count($result)==0){
		 	return array('code' => '406', 'msg' => '더 이상 게시물이 존재하지 않습니다.'));
			return;
		}

		for($i=0; $i<count($result); $i++) 
		{
			$member_idx = $result[$i]->member_idx;
			
			$temp = DB::select('select nickname from member where idx=?', array($member_idx));
			$result[$i]->nickname  = $temp[0]->nickname;		
		}

       return array('code' => 1, 'msg' => 'success', 'data' => $result);
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
	function retrieveByText($text)
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
}