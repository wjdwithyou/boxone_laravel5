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
	function create($member_idx, $title, $contents, $commucategory_idx, $commcommunity_idx)
	{
		if(	!(	inputErrorCheck($member_idx, 'member_idx')
		 		&& inputErrorCheck($title, 'title')
		 		&& inputErrorCheck($contents, 'contents')
		 		&& inputErrorCheck($commucategory_idx, 'commucategory_idx')
		 		&& inputErrorCheck($commcommunity_idx, 'commcommunity_idx')))
			return ;
		
		$community_idx = DB::table('community')->insertGetId(
			array(
				'member_idx'=> $member_idx, 
				'title'=> $title, 
				//'contents'=> $contents, 
				'commucategory_idx'=> $commucategory_idx,
				'commcommunity_idx' => $commcommunity_idx,
				'upload'=>DB::raw('now()')
				)
			);
		
		// 이미지 처리 (임시 이미지를 S3에 저장, 게시글에 이미지 src 변경, 임시 이미지 지우기)
		$imgList = array();
		
		$s3Adr = "https://s3-ap-northeast-1.amazonaws.com/boxone-image/community/";
		$dbImg = "";
		
		$str = $contents;
		$num = 0;
		
		while (strpos($str, "<img"))
		{
			$str = substr($str, strpos($str, "<img"));
			$str = substr($str, strpos($str, "src=\"") + 5);		
			$imgStr = substr($str, 0, strpos($str, "\""));
			
			$ext = substr($imgStr, strrpos($imgStr, "."));
			
			if (!$num)
				$dbImg = $community_idx.'_image0'.$ext;
			$imgName = $s3Adr.$community_idx.'_image'.($num++).$ext;
			
			array_push($imgList, $imgStr);
			$contents = str_replace($imgStr, $imgName, $contents);
		}
		
		if (count($imgList) > 0)
		{
			for ($i = 0 ; $i < count($imgList) ; $i++)
			{
				$imgStr = "img/community/".substr($imgList[$i], strrpos($imgList[$i], "/") + 1);
				$ext = substr($imgStr, strrpos($imgStr, ".")+1);
				if (is_file($imgStr))
					insertImg('1', $community_idx, $imgStr, $ext, "$i");
			}
		}
		$result = DB::update('update community set image=?, contents=? where idx=?', array($dbImg, $contents, $community_idx));
		                      
		return array('code' => 1,'msg' =>'success' ,'data' => $community_idx);
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
		
		DB::update('UPDATE community SET reply_number=reply_number+1 WHERE idx=?', array($community_idx));
		                  
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
	function updateReply($member_idx, $reply_idx, $contents)
	{

		if(	!(	inputErrorCheck($reply_idx, 'reply_idx')
		 		&& inputErrorCheck($contents, 'contents')
				&& inputErrorCheck($member_idx, 'member_idx')))
			return ;

		$result = DB::update('update community_reply set contents=? where idx=? and member_idx=?',
			array($contents, $reply_idx, $member_idx));
                    
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
		$result = DB::select('select idx, title as name, 0 as chk from community_category where large_name=?',
			array($large_name));

        return array('code' => 1 , 'msg' => 'success', 'data' => $result);
	}


    /*  	
     *	게시물 목록 가져오는 기능
     */
	function getInfoList($commucategory_idx_array, $page_num, $text, $searchType, $page_type)
	{

		$commucategory_query = "";
		
		if (count($commucategory_idx_array))
			for( $i=0; $i<count($commucategory_idx_array); $i++)
				$commucategory_query .= "cm.commucategory_idx like '%$commucategory_idx_array[$i],%' OR ";
		if ($commucategory_query != "")
			$commucategory_query = substr($commucategory_query, 0, count($commucategory_query) - 5);
		
		if ($text == "")		// 검색어 없을 시
		{
			if ($commucategory_query != "")
				$commucategory_query = "where ".$commucategory_query;
			$result = DB::select('select * from community as cm '.$commucategory_query.' order by idx DESC');
		}
		else 		// 검색어 있을 시
		{
			if ($commucategory_query != "")
				$commucategory_query = "(".$commucategory_query.") and ";
			switch($searchType)
			{
				// 제목
				case 1:
					$result = DB::select("select cm.* from community as cm where $commucategory_query cm.title like '%$text%' order by idx DESC");
					break;
			
				// 제목+내용
				case 2:
					$data = DB::select("select cm.* from community as cm where $commucategory_query (cm.title like '%$text%' or cm.contents like '%$text%') order by idx DESC");
					$result = array();
					foreach($data as $list)
						if (strpos($list->title, $text) || strpos(strip_tags($list->contents), $text))
							array_push($result, $list);
					break;
					
				// 댓글
				case 3:
					$result = DB::select("select cm.* from community_reply as cr left join community as cm on cr.community_idx=cm.idx where $commucategory_query (cr.contents like '%$text%') order by idx DESC");
					break;
				
				// 작성자
				case 4:
					$result = DB::select("select cm.* from community as cm left join member as mm on cm.member_idx=mm.idx where $commucategory_query mm.nickname like '%$text%' order by idx DESC");
					break;
			}
		}
		
		if ($page_type == "0")
		{
			$data = array();
			foreach ($result as $list)
				if ($list->image != "")
					array_push($data, $list);
			$result = $data;
		}

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
			$result[$i]->nickname = $temp[0]->nickname;
			
			$date = $result[$i]->upload;
			$result[$i]->upload = cutDateAsToday($date);
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

		// 상품 가져오기
		$result = DB::select('select cm.*, mm.nickname, mm.image from 
							(
								community as cm
								JOIN member as mm
								ON cm.member_idx=mm.idx
							) where cm.idx=? LIMIT 1', array($community_idx));
		
		// 카테고리 정리하기
		$cateNums = $result[0]->commucategory_idx;
		$cateList = array();
		while ($cateNums != "")
		{
			$cateNum = substr($cateNums, 0, 2);
			$cateStr = DB::select("SELECT title FROM community_category WHERE idx = $cateNum");
			array_push($cateList, $cateStr[0]->title);
			$cateNums = substr($cateNums, 3);
		}
		$result[0]->category = $cateList;
		
		// 이전, 다음 구하기 (속도 왕창 느려짐..)
		$prev = DB::select('SELECT idx FROM community WHERE idx<? ORDER BY idx DESC LIMIT 1', array($community_idx));
		$next = DB::select('SELECT idx FROM community WHERE idx>? LIMIT 1', array($community_idx));
		
		if (count($prev) > 0)
			$result[0]->prev = $prev[0]->idx;
		else 
			$result[0]->prev = 0;
		
		if (count($next) > 0)
			$result[0]->next = $next[0]->idx;
		else 
			$result[0]->next = 0;
		
		if (count($result))
		{
			if($result[0]->member_idx == $readmember_idx)
				$result[0]->own = 1;
			else
			{
				$result[0]->own = 0;
				if (count(DB::select('SELECT count(*) FROM community_bookmark WHERE member_idx=? AND community_idx=?', array($community_idx, $readmember_idx))))
					$result[0]->bookmark = 1;
				else
					$result[0]->bookmark = 0;
			}
	
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
		
		$rereply = array_reverse($rereply);
		
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
	function getInfoListByText($case, $text)
	{

		if( !( inputErrorCheck($text, 'text')))
			return ;

		switch($case)
		{
			// 전체(제목, 내용, 글쓴이)
			case 1:
				$result = DB::select("select cm.* from community as cm left join member as mm on cm.member_idx=mm.idx; where cm.title like '%$text%' or cm.contents like '%$text%' or mm.nickname like '%$text%'");
				break;
		
			// 제목
			case 2:
				$result = DB::select("select * from community where title like '%$text%'");
				break;
				
			// 제목+내용
			case 3:
				$result = DB::select("select * from community where title like '%$text%' or contents like '%$text%'");
				break;
			
			// 글쓴이
			case 4:
				$result = DB::select("select cm.* from community as cm left join member as mm on cm.member_idx=mm.idx; where mm.nickname like '%$text%'");
				break;
		}
		
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