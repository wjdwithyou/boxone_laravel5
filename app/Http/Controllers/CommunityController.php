<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\CommunityModel;
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
	
	public function index()
	{
		$cmModel = new CommunityModel();
		
		// 큰 카테고리
		if (Request::has('cate'))
			$cate = Request::input('cate');
		else
			$cate = "전체";
		
		// 특수경우용 상세카테고리
		if (Request::has('cateS'))
			$cateSList = Request::input('cateS');
		else 
			$cateSList = "";
		
		// 특수경우용 (보통 게시글 상세보기에서 목록 클릭 시) 타겟 페이징
		if (Request::has('targetPage'))
			$targetPage = Request::input('targetPage');
		else
			$targetPage = 1;
		
		if (Request::has('pageType'))
			$pageType = Request::input('pageType');
		else 
			$pageType = 1;
		
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
		
		$page = 'community';
		return view($page, array('page' => $page, 'cate' => $cate, 'cateL' => $cateL['data'], 'cateS' => $cateS['data'], 'targetPage' => $targetPage, 'pageType' => $pageType));
	}
	
	public function getInfo()
	{
		$cmModel = new CommunityModel();
		
		$cate = json_decode(Request::input('cate'));
		$adr_ctr = Request::input('adr_ctr');
		$page_type = Request::input('page_type');
		$paging = Request::input('paging');
		
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

		$result = $cmModel->getInfoList($cate, $paging);
		
		
		//print_r ($result);
		
		$page = 'communityInfo';
		return view($page, array('page' => $page, 'result' => $result['data'], 'adr_ctr' => $adr_ctr, 'page_type' => $page_type, 'paging' => $result['paging']));
	}
	
	public function write()
	{
		$cmModel = new CommunityModel();
		
		if (Request::has('cate'))
			$cate = Request::input('cate');
		else
			$cate = "전체";
		
		$cateL = $cmModel->getLargeCategory();
		
		if ($cate == "전체")
			$cateS = $cmModel->getLargeCategory();
		else
			$cateS = $cmModel->getSmallCategory($cate);
		
		$page = 'community_write';
		return view($page, array('page' => $page, 'cate' => $cate, 'cateL' => $cateL['data'], 'cateS' => $cateS['data']));
	}
	
	public function content()
	{
		$cmModel = new CommunityModel();
		$comm_idx = Request::input('idx');
		
		if (Request::has('url'))
			$url = urldecode(Request::input('url'));
		else
			$url = "";
		
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
		
		$result = $cmModel->delete($comm_idx, $mem_idx);
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
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
}








