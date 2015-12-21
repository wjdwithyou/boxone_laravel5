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
	function create($member_idx, $title, $contents, $commucategory_idx, $commcommunnity_idx)
	{
		if(	!(	inputErrorCheck($member_idx, 'member_idx')
		 		&& inputErrorCheck($title, 'title')
		 		&& inputErrorCheck($contents, 'contents')
		 		&& inputErrorCheck($commucategory_idx, 'commucategory_idx')
		 		&& inputErrorCheck($commcommunnity_idx, 'commcommunnity_idx')))
			return ;
		
		$result = DB::table('community')->insertGetId(
			array(
				'member_idx'=> $member_idx, 
				'title'=> $title, 
				'contents'=> $contents, 
				'commucategory_idx'=> $commucategory_idx,
				'commcommunnity_idx' => $commcommunnity_idx,
				'upload'=>DB::raw('now()')
				)
			);		
		                      
		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

	/*  	
     *	댓글 등록 기능
     */
	function createReply($member_idx, $community_idx, $contents, $rereply_idx)
	{
		
		if(	!(	inputErrorCheck($member_idx, 'member_idx')
		 		&& inputErrorCheck($community_idx, 'community_idx')
		 		&& inputErrorCheck($contents, 'contents')
		 		&& inputErrorCheck($rereply_idx, 'rereply_idx')))
			return ;
		

		$result = DB::table('community_reply')->insertGetId(
			array(
				'member_idx'=> $member_idx,
				'community_idx'	=> $community_idx, 	
				'contents'	=> $contents,
				'rereply_idx' => $rereply_idx,
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
	function delete($community_idx, $member_idx)
	{
	  	
		if(	!(	inputErrorCheck($community_idx, 'community_idx')))
			return ;		

 		$result = DB::delete('delete from community where idx=? and member_idx=?', array($community_idx, $member_idx));

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

		// 댓글의 댓글이 없을 시에만 삭제 가능
		$chk = DB::select('SELECT count(*) AS cnt FROM community_reply WHERE rereply_idx=? LIMIT 1', array($reply_idx));
		
		if ($chk[0]->cnt)
			return array('code' => 0, 'msg' => 'delete failure: fucking replies are fucking exist');
		else 
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
		$result = DB::select('select distinct large_name as name, large_name as idx from community_category');

        return array('code' => 1 , 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	각각 대분류에 해당하는 중분류 리스트 출력
	 */
	function getSmallCategory($large_name)
	{
		$result = DB::select('select idx, title as name from community_category where large_name=?',
			array($large_name));

        return array('code' => 1 , 'msg' => 'success', 'data' => $result);
	}


    /*  	
     *	게시물 목록 가져오는 기능
     */
	function getInfoList($commucategory_idx_array, $page_num)	// product_num은 한 페이지에 몇개씩 보여줄지
	{

		$commucategory_query = "where ";
		
		if (count($commucategory_idx_array))
		{
			for( $i=0; $i<count($commucategory_idx_array); $i++)
			{
				$commucategory_query .= "commucategory_idx = '$commucategory_idx_array[$i]' ";
				if( $i != count($commucategory_idx_array)-1)
					$commucategory_query .= "OR ";
			}
		}
		else
			$commucategory_query = "";
		
		// 마지막 데이터까지 전부 출력
		$result = DB::select('select * from community ' .$commucategory_query. 'order by idx DESC');

		//해당하는 내용이 없을 경우
		if( count($result)==0 )
		 	return array('code' => '406', 'msg' => 'no matched result', 'data' => array(), 'paging' => array('now' => 1, 'max' => 1));
		
		$page_max = floor((count($result)-1) / 20) + 1;
		if ($page_num > $page_max)
			$page_num = $page_max;
		$page_start = ($page_num-1)*20;
		
		$result = array_slice($result, $page_start, 20);
		
		for($i = 0 ; $i < count($result) ; $i++) 
		{
			$member_idx = $result[$i]->member_idx;
			
			$temp = DB::select('select nickname from member where idx=?', array($member_idx));
			$result[$i]->nickname  = $temp[0]->nickname;
		}

       return array('code' => 1, 'msg' => 'success', 'data' => $result, 'paging' => array('now' => $page_num, 'max' => $page_max));
	}


	/*  	
     *	단일 게시글 가져오는 기능 + 조회수 1 증가
     */
	function getInfoSingle($community_idx, $readmember_idx)
	{

		if(	!(	inputErrorCheck($community_idx, 'community_idx')
		 		&& inputErrorCheck($readmember_idx, 'readmember_idx')))
			return ;

		DB::update('update community set hit_count=hit_count+1 where idx=?',array($community_idx));

		$result = DB::select('select cm.*, mm.nickname, mm.image, cc.title from 
							(
								community as cm
								JOIN member as mm
								ON cm.member_idx=mm.idx
								JOIN community_category as cc
								ON cm.commucategory_idx=cc.idx
							) where cm.idx=? LIMIT 1', array($community_idx));
		
		// 이전, 다음 구하기 (속도 왕창 느려짐..)
		$prev = DB::select('SELECT idx FROM community WHERE idx<? ORDER BY idx DESC LIMIT 1', array($community_idx));
		$next = DB::select('SELECT idx FROM community WHERE idx>? LIMIT 1', array($community_idx));
		$result[0]->prev = $prev[0]->idx;
		$result[0]->next = $next[0]->idx;

		if (count($result))
		{
			if($result[0]->member_idx == $readmember_idx)
				$result[0]->own = 1;
			else
				$result[0]->own = 0;
	
	        return array('code' => 1, 'msg' => 'success', 'data' => $result[0]);
		}
		else
			return array('code' => 0, 'msg' => 'fucking no data');
	}


    /*  	
     *	게시물 댓글 목록 가져오는 기능
     */
	function getReplyList($community_idx, $readmember_idx)		// 게시글인덱스, 현재 보고있는 사용자 인덱스
	{

		if(	!(	inputErrorCheck($community_idx, 'community_idx')
		 		&& inputErrorCheck($readmember_idx, 'readmember_idx')))
			return ;

 		$result = DB::select('select cr.*, mm.nickname, mm.image from 
							(
								community_reply as cr
								JOIN member as mm
								ON cr.member_idx=mm.idx
							) where cr.community_idx=?
 							order by idx DESC', array($community_idx));
		
 		
 		$reply = array();
 		$rereply = array();
 		
		for($i=0; $i<count($result); $i++) 
		{			
			// 둘이 동일인일 경우 own권한 부여
			if($readmember_idx == $result[$i]->member_idx)
				$result[$i]->own = 1;
			else
				$result[$i]->own = 0;
			
			// 댓글, 댓댓글 분류
			if ($result[$i]->rereply_idx)
				array_push($rereply, $result[$i]);
			else
			{
				$result[$i]->rereply = array();
				array_push($reply, $result[$i]);
			}
		}
		
		for ($i=0; $i<count($rereply); $i++)
			for ($j=0; $j<count($reply); $j++)
				if ($rereply[$i]->rereply_idx == $reply[$j]->idx)
				{
					array_push($reply[$j]->rereply, $rereply[$i]);
					break;	
				}

       return array('code' => 1, 'msg' => 'success', 'data' => array_reverse($reply));
	}


	/*
	 *  게시물의 제목+내용 필터로 검색
	 */
	function getInfoListByText($text)
	{

		if( !( inputErrorCheck($text, 'text')))
			return ;

		$result = DB::select("select distinct * from community where title like '%$text%' or contents like '%$text%'");
		
		return array('code' => 1, 'data' => $result);
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

        return array('code' => 1, 'msg' => 'created', 'data' => $result);
	}
	
	/*
	 *	커뮤니티 글 북마크 체크
	 */
	function checkBookmark($member_idx, $community_idx)
	{
	
		if(	!(	inputErrorCheck($community_idx, 'community_idx')
				&& inputErrorCheck($member_idx, 'member_idx')))
					return ;
	
		//북마크 체크
		$result = DB::select("SELECT count(*) as count FROM community_bookmark WHERE member_idx=? AND community_idx=? LIMIT 1", array($member_idx,$community_idx));
		return $result[0]->count;
	}

	/*  	
     *	커뮤니티 글 북마크 삭제
     */
	function deleteBookmark($member_idx, $community_idx)
	{

		if(	!(	inputErrorCheck($member_idx, 'member_idx')
			 && inputErrorCheck($community_idx, 'community_idx')))
			return ;

		//북마크 -1
		DB::update('update community set bookmark_count=bookmark_count-1 where idx=?',array($community_idx));

		//북마크 삭제
		$result = DB::delete('delete from community_bookmark where member_idx=? and community_idx=?', array($member_idx, $community_idx));

        return array('code' => 1, 'msg' => 'deleted', 'data' => $result);
	}

	/*  	
     *	내가 쓴 글 목록 가져오기
     */
	function getInfoListMyCommunity($member_idx)
	{

		if(	!(	inputErrorCheck($member_idx, 'member_idx')))
			return ;

		$result = DB::select('select * from community where member_idx=? order by idx DESC', array($member_idx));

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*  	
     *	내가 쓴 글 목록 가져오기
     */
	function getInfoListMyReply($member_idx)
	{

		if(	!(	inputErrorCheck($member_idx, 'member_idx')))
			return ;

		$result = DB::select('select * from community_reply where member_idx=? order by idx DESC', array($member_idx));

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}	

}