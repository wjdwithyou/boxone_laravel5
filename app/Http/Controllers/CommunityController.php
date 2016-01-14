<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\CommunityModel;
use AWS;
use Request;

class CommunityController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	커뮤니티 목록 페이지
	 */
	public function index()
	{
		$cmModel = new CommunityModel();
		
		// 큰 카테고리
		$cate = Request::input('cate', '전체');
		
		// 특수경우용 상세카테고리
		$cateSList = Request::input('cateS', '');
		
		// 특수경우용 (보통 게시글 상세보기에서 목록 클릭 시) 타겟 페이징
		$targetPage = Request::input('targetPage', 1);
		
		// 게시판형, 앨범형
		$pageType = Request::input('pageType', 1);
		
		// 큰 카테고리 목록 가져오기
		$cateL = $cmModel->getLargeCategory();
		
		
		if ($cate == "전체")
			$cateS = $cateL;
		else	// 작은 카테고리 목록 가져오기
		{
			$cateS = $cmModel->getSmallCategory($cate);
			
			while($cateSList != "")
			{
				$temp = substr($cateSList, 0, 2);
				$cateSList = substr($cateSList, 3);
				for ($i = 0 ; $i < count($cateS['data']) ; $i++)
				{
					if ($temp == $cateS['data'][$i]->idx)
					{
						$cateS['data'][$i]->chk = 1;
						break;
					}
				}
			}
		}
		
		$page = 'community';
		return view($page, array('page' => $page, 'cate' => $cate, 'cateL' => $cateL['data'], 'cateS' => $cateS['data'], 'targetPage' => $targetPage, 'pageType' => $pageType));
	}
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	베스트랭킹 정보 가져오기
	 */
	public function getInfo()
	{
		$cmModel = new CommunityModel();
		
		$cate = json_decode(Request::input('cate', array('전체')));
		$adr_img = Request::input('adr_img');
		$page_type = Request::input('page_type', '1');
		$paging = Request::input('paging', '1');
		$searchText = trim(Request::input('searchText', ' '));
		$searchType = Request::input('searchType', '1');
		
		// 카테고리 정리
		if (!is_numeric($cate[0]))
		{
			$temp = array();
			
			if ($cate[0] != "전체")
			{				
				foreach($cate as $list)
				{
					$data = $cmModel->getSmallCategory($list);
					foreach($data['data'] as $idx)
						array_push($temp, $idx->idx);
				}
			}
			$cate = $temp;
		}		

		// 커뮤니티 목록 가져오기
		$result = $cmModel->getInfoList($cate, $paging, $searchText, $searchType, $page_type);
		
		// 검색 기준 목록
		$searchSelect = array('제목', '제목+내용', '댓글', '작성자');
		
		//print_r ($result);
		
		$page = 'communityInfo';
		return view($page, array('page' => $page, 'result' => $result['data'], 'adr_img' => $adr_img, 'page_type' => $page_type, 'paging' => $result['paging'], 'searchText' => $searchText, 'searchType' => $searchType, 'searchSelect' => $searchSelect));
	}
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	커뮤니티 글쓰기 처음 페이지
	 */
	public function indexWrite()
	{
		$cmModel = new CommunityModel();
		
		// 카테고리들 가져오기
		$cateL = $cmModel->getLargeCategory();		
		$cateS = $cmModel->getSmallCategory("패션잡화");
		
		// 글쓰기가 아닌 수정 페이지일 시 가지고 다님
		$idx = Request::input('idx', '0');
		
		$page = 'community_write';
		return view($page, array('page' => $page, 'cateL' => $cateL['data'], 'cateS' => $cateS['data'], 'comm_idx' => $idx));
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	글 작성
	 */
	public function create()
	{
		$cmModel = new CommunityModel();
	
		$cate = Request::input('cate', '');
		$title = Request::input('title', '');
		$content = Request::input('content', '');
	
		// 로그인 된 상태여야 글 작성이 가능하다.
		if (session_id() == '')
			session_start();
		if (!isset($_SESSION['idx']))
		{
			header('Content-Type: application/json');
			echo json_encode(array('code' => 0, 'msg' => 'not logined'));
		}
		else
		{
			$mem_idx = $_SESSION['idx'];
			$result = $cmModel->create($mem_idx, $title, $content, $cate, '0');
	
			header('Content-Type: application/json');
			echo json_encode($result);
		}
	
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	글 수정
	 */
	public function update()
	{
		$cmModel = new CommunityModel();
	
		$comm_idx = Request::input('idx', '0');
		$cate = Request::input('cate', '');
		$title = Request::input('title', '');
		$content = Request::input('content', '');
	
		// 역시 로그인 된 상태여야 수정이 가능함
		if (session_id() == '')
			session_start();
		if (isset($_SESSION['idx']))
		{
			$mem_idx = $_SESSION['idx'];
			
			// 글 하나 정보 가져오기
			$result = $cmModel->getInfoSingleWithCateName($comm_idx);
	
			// 로그인 한 회원과 해당 글 작성자가 같은지 확인
			if ($result->member_idx == $mem_idx)
			{
				// 기존 해당 글 이미지 모두 지우기
				$s3 = AWS::createClient('s3');
				$imgList = $s3->getIterator('ListObjects', array(
						'Bucket'	=> 'boxone-image',
						'Prefix'	=> 'community/'.$comm_idx.'_image'
				));
				foreach ($imgList as $list)
				{
					$s3->deleteObject(array(
							'Bucket'	=> 'boxone-image',
							'Key'		=> $list['Key']
					));
				}
	
				// 정보 업데이또
				$result = $cmModel->update($comm_idx, $title, $content, $cate);
	
				header('Content-Type: application/json');
				echo json_encode($result);
				return;
			}
		}
		header('Content-Type: application/json');
		echo json_encode(array('code' => 0, 'msg' => 'not logined'));
	}
	
	// 이미지 파일 임시 저장소에 임시저장 (img/community)
	public function imageUpload()
	{
		$file = Request::file('file');
		$num = Request::input('num');
	
		// 당연 로그인 되어있어야함!
		if (session_id() == '')
			session_start();
		if (!isset($_SESSION['idx']))
		{
			header('Content-Type: application/json');
			echo json_encode(array('code' => 0, 'msg' => 'not logined'));
		}
		else
		{
			$mem_idx = $_SESSION['idx'];
			$ext = $file->getClientOriginalExtension();
			$date = date("YmdHis", time());
			$name = "$mem_idx"."dd$num$date.$ext";
				
			//$path = str_replace("/","\\",$adr_img)."community\\";
			$path = "img/community/";
			$file->move($path, $name);
				
			header('Content-Type: application/json');
			echo json_encode(array('code' => 1, 'msg' => 'success', 'name' => $name));
		}
	}
	
	// 임시저장 후 등록하지 않고 다른 페이지 이동 시 임시저장 파일 제거
	public function deleteTempImg()
	{
		if (session_id() == '')
			session_start();
		if (!isset($_SESSION['idx']))
		{
			header('Content-Type: application/json');
			echo json_encode(array('code' => 0, 'msg' => 'not logined'));
		}
		else
		{
			$mem_idx = $_SESSION['idx'];
				
			$glob = glob('img/community/'.$mem_idx.'dd*');
			foreach($glob as $file)
			{
				if (is_file($file))
					unlink($file);
			}
				
			header('Content-Type: application/json');
			echo json_encode(array('code' => 1, 'msg' => 'success', 'data' => $glob));
		}
	}
	
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	글 수정 시 기존 글 내용 가져오기
	 */
	public function getModifyContent()
	{
		$cmModel = new CommunityModel();
		
		$comm_idx = Request::input('idx', '0');
		$adr_ctr = Request::input('adr_ctr');
		
		// 로그인 되어있을 시에만 가능
		if (session_id() == '')
			session_start();
		if (isset($_SESSION['idx']))
		{
			$mem_idx = $_SESSION['idx'];
			$result = $cmModel->getInfoSingleWithCateName($comm_idx);
			
			// 로그인 된 회원과 글 작성자가 같은 사람이어야 함
			if ($result->member_idx == $mem_idx)
			{

				$imgList = array();
				
				$s3Adr = "https://s3-ap-northeast-1.amazonaws.com/boxone-image/community/";
				$dbImg = "";
				
				$contents = $result->contents;
				$str = $contents;
				$num = 0;
				
				// 글 수정 시, s3에 저장되어 있던 이미지를 임시 저장소 (img/community/)로 옮기고, 본문의 <img src= 주소를 임시 저장소의 이미지로 변경 
				while (strpos($str, "<img"))
				{
					$str = substr($str, strpos($str, "<img"));
					$str = substr($str, strpos($str, "src=\"") + 5);
					$imgStr = substr($str, 0, strpos($str, "\""));
					$imgName = substr($imgStr, strrpos($imgStr, "/") + 1);
					$ext = substr($imgStr, strrpos($imgStr, ".")+1);
					
					$date = date("YmdHis", time());
					$tempName = "$mem_idx"."dd".($num++)."$date.$ext";	
					
					// 아마존 s3에 있던 이미지를 임시 저장소로 옮김
					$s3 = AWS::createClient('s3');
					if ($s3->doesObjectExist('boxone-image', 'community/'.$imgName))
					{
						$imgUrl = $s3->getObject(array(
							'Bucket' 	=> 'boxone-image',
							'Key' 		=> 'community/'.$imgName,
							'SaveAs' 	=> 'img/community/'.$tempName
						));
						$contents = str_replace($imgStr, $adr_ctr.'img/community/'.$tempName, $contents);
					}
				}
				
				// 정보 가져오기
				$result->contents = $contents;
				$data = $result;
				echo json_encode(array('code' => 1, 'data' => $data, 'num' => $num));
				return;
			}
		}
		
		echo json_encode(array('code' => 0, 'msg' => 'not logined'));
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	커뮤니티 내용 첫 페이지
	 */
	public function indexContent()
	{
		$cmModel = new CommunityModel();
		$comm_idx = Request::input('idx');
		
		// 이전 페이지 url
		$url = urldecode(Request::input('url', ''));
		
		if (session_id() == '')
			session_start();
		if (isset($_SESSION['idx']))
			$mem_idx = $_SESSION['idx'];
		else
			$mem_idx = '0';
	
		// 커뮤니티 글 정보 가져오기
		$result = $cmModel->getInfoSingle($comm_idx, $mem_idx);
		
		// 댓글 정보 가져오기
		$reply = $cmModel->getReplyList($comm_idx, $mem_idx);
		
		if ($result['code'])
		{
			$page = 'community_content';
			return view($page, array('page' => $page, 'result' => $result['data'], 'reply' => $reply['data'], 'redirect' => $url));
		}
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	커뮤니티 북마크
	 */
	public function bookmark()
	{
		$cmModel = new CommunityModel();
		$comm_idx = Request::input('comm_idx');
		
		header('Content-Type: application/json');
		
		if (session_id() == '')
			session_start();
		if (isset($_SESSION['idx']))
		{
			$mem_idx = $_SESSION['idx'];
			
			if ($cmModel->checkBookmark($mem_idx, $comm_idx))
				$result = $cmModel->deleteBookmark($mem_idx, $comm_idx);
			else 
				$result = $cmModel->createBookmark($mem_idx, $comm_idx);
			
			echo json_encode($result);
		}
		else
			echo json_encode(array('code' => 0, 'msg' => 'not logined'));
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	커뮤니티 글 삭제
	 */
	public function delete()
	{
		$cmModel = new CommunityModel();
		$comm_idx = Request::input('comm_idx');
		
		if (session_id() == '')
			session_start();
		if (isset($_SESSION['idx']))
			$mem_idx = $_SESSION['idx'];
		else
			$mem_idx = '0';
		
		// 커뮤니티 글 삭제는 로그인 된 회원이 작성자일 때만 실행됨
		$result = $cmModel->delete($comm_idx, $mem_idx);
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	커뮤니티 댓글 작성
	 */
	public function createReply()
	{
		$cmModel = new CommunityModel();
		$comm_idx = Request::input('comm_idx');
		$reply_idx = Request::input('reply_idx');
		$content = Request::input('text');
		
		if (session_id() == '')
			session_start();
		if (!isset($_SESSION['idx']))
		{
			header('Content-Type: application/json');
			echo json_encode(array('code' => 0, 'msg' => 'not logined'));
		}
		else 
		{
			$mem_idx = $_SESSION['idx'];
			$result = $cmModel->createReply($mem_idx, $comm_idx, $content, $reply_idx);	
			
			header('Content-Type: application/json');
			echo json_encode($result);
		}
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	커뮤니티 댓글 수정
	 */
	public function updateReply()
	{
		$cmModel = new CommunityModel();
		$my_idx = Request::input('idx');
		$content = Request::input('text');
	
		if (session_id() == '')
			session_start();
		if (!isset($_SESSION['idx']))
		{
			header('Content-Type: application/json');
			echo json_encode(array('code' => 0, 'msg' => 'not logined'));
		}
		else
		{
			$mem_idx = $_SESSION['idx'];
			$result = $cmModel->updateReply($mem_idx, $my_idx, $content);
				
			header('Content-Type: application/json');
			echo json_encode($result);
		}
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	커뮤니티 댓글 삭제
	 */
	public function deleteReply()
	{
		$cmModel = new CommunityModel();
		$reply_idx = Request::input('idx');
		
		if (session_id() == '')
			session_start();
		if (!isset($_SESSION['idx']))
		{
			header('Content-Type: application/json');
			echo json_encode(array('code' => 0, 'msg' => 'not logined'));
		}
		else
		{
			$mem_idx = $_SESSION['idx'];
			$result = $cmModel->deleteReply($reply_idx);
			
			header('Content-Type: application/json');
			echo json_encode($result);
		}
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	내 커뮤니티 목록
	 */
	public function indexMy()
	{
		$cmModel = new CommunityModel();
		
		// 큰 카테고리
		$cate = Request::input('cate', '전체');
		
		// 특수경우용 상세카테고리
		$cateSList = Request::input('cateS', '');
		
		// 특수경우용 (보통 게시글 상세보기에서 목록 클릭 시) 타겟 페이징
		$targetPage = Request::input('targetPage', 1);
		
		// 게시판 / 앨범
		$pageType = Request::input('pageType', 1);
		
		$cateL = $cmModel->getLargeCategory();
		
		if ($cate == "전체")
			$cateS = $cmModel->getLargeCategory();
		else
		{
			$cateS = $cmModel->getSmallCategory($cate);
			
			while($cateSList != "")
			{
				$temp = substr($cateSList, 0, 2);
				$cateSList = substr($cateSList, 3);
				for ($i = 0 ; $i < count($cateS['data']) ; $i++)
				{
					if ($temp == $cateS['data'][$i]->idx)
					{
						$cateS['data'][$i]->chk = 1;
						break;
					}
				}
			}
		}
		
		$page = 'community_my';
		return view($page, array('page' => $page, 'cate' => $cate, 'cateL' => $cateL['data'], 'cateS' => $cateS['data'], 'targetPage' => $targetPage, 'pageType' => $pageType));
	}
	
	
	/*
	 *  2016.01.14
	 *  박용호
	 * 	큰 카테고리 설정 시 작은 카테고리 가져오기
	 */
	public function getSmallCate()
	{
		$cmModel = new CommunityModel();
		
		$cate = Request::input('cate');
		
		$result = $cmModel->getSmallCategory($cate);
		
		header('Content-Type: application/json');
		echo json_encode($result['data']);
	}
	

}








