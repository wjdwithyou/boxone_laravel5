<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\HotdealTargetModel;
use App\Http\models\CategoryModel;
use App\Http\models\HotdealProductModel;
use App\Http\models\ProductModel;
use Request;
use Cookie;

class HotdealController extends Controller {

	
	/*
	 * 2016.01.14
	 * 작성자 : 박용호
	 * 핫딜 메인 페이지
	 */
	public function main()
	{
		$page = 'hotdeal_main';
		return view($page, array('page' => $page));
	}
	
	
	/*
	 * 2016.01.14
	 * 작성자 : 박용호
	 * 핫딜 상품 페이지
	 */
	public function indexProduct()
	{
		$page = 'hotdeal';
		return view($page, array('page' => $page));
	}
	
	
	public function productDetail()
	{
		$cateModel = new CategoryModel();
		$hotPrdtModel = new HotdealProductModel();
		$prdtModel = new ProductModel();
	
		$idx = Request::input('idx');
		$result = $hotPrdtModel->getInfoSingle($idx);
	
		$cateS = $result['data']['cate'];
		$data = $cateModel->downToUp($cateS);
		
		// 리뷰 가져오기
		$reviewList = $hotPrdtModel->getReview($idx);
		
		// 동일 상품 가져오기
		$sameList = $prdtModel->getMappingPrdt($idx, $result['data']['binding']);
		
		// 최근 본 상품의 카테고리를 cookie로 가지고 다닌다.
		$cookie = Request::cookie('recentCate');
		if ($cookie == '')
			$cookieArray = array();
		else
		{
			$cookieArray = json_decode($cookie, true);
			// cookie 임의 변경 시 자동 초기화
			if (json_last_error() != JSON_ERROR_NONE)
				$cookieArray = array();
		}
		array_push($cookieArray, $data['data'][0]->lidx);
		if (count($cookieArray) > 10)
			$cookieArray = array_slice($cookieArray, 0, 10);
		
		$json_cookie = json_encode($cookieArray);
		Cookie::queue('recentCate', $json_cookie);
		
		// 최근 본 상품의 정보 (idx, name, brand, img, price)를 가지고 다닌다.
		$cookie = Request::cookie('recentPrdt');
		if ($cookie == '')
			$cookieArray = array();
		else
		{
			$cookieArray = json_decode($cookie, true);
			// cookie 임의 변경 시 자동 초기화
			if (json_last_error() != JSON_ERROR_NONE)
				$cookieArray = array();
		}
		array_push($cookieArray, array(
				$result['data']['idx'],
				$result['data']['name'],
				$result['data']['brand'],
				$result['data']['img'][0],
				$result['data']['price']
		));
		if (count($cookieArray) > 10)
			$cookieArray = array_slice($cookieArray, 1, 10);
		
		$json_cookie = json_encode($cookieArray);
		Cookie::queue('recentPrdt', $json_cookie);
		
		$data['data'][0]->lidx = 'c';
	
		$page = 'product';
		return view($page, array(
				'page' => $page, 
				'result' => $result['data'], 
				'reviewList' => $reviewList['data'], 
				'sameList' => $sameList['data'],
				'rate' => array($reviewList['rateAve'], $reviewList['rateBest'], $reviewList['rateCnt']),
				'cate' => $data['data'][0]
		));
	}
	
	
	/*
	 * 2016.01.14
	 * 작성자 : 박용호
	 * 핫딜 코드 페이지
	 */
	public function indexCode()
	{
		$hotdealModel = new HotdealTargetModel();
		$categoryModel = new CategoryModel();
		
		// 정렬 방식 가져오기, 검사	(1, 2, 3, 5)
		$sort = Request::input('sort', '1');
		if (session_id() == '')	session_start();
		if ($sort == '5' && empty($_SESSION['idx']))
			$sort = '1';
		
		// 카테고리 가져오기, 검사	(0은 전체)		
		$cate = Request::input('cate', '0');
		$cateList = $categoryModel->getInfoListLarge();
		if ($cate > count($cateList['data']))
			$cate = '0';
		
		// 사이트 가져오기, 검사 (전체는 0)
		$site = Request::input('site', '0');
		
		// 페이지 검사
		$nowPage = Request::input('page', '1');
		
		// 현재 카테고리 이름 가져오기
		$name = "전체";
		for ($i = 0 ; $i < count($cateList['data']) ; $i++)
			if ($cateList['data'][$i]->idx == $cate)
				$name = $cateList['data'][$i]->name;
				
			
		// 내 북마크 핫딜, 전체 핫딜 분기
		if ($sort == '5' || $sort == 5)
		{
			$result = $hotdealModel->getMyHotdeal($_SESSION['idx'], $cate, $site, '1', $nowPage, 0);
		}
		else	// 5번 아니면 정렬, 페이지 기준에 따라 
		{			
			// 핫딜 데이터 가져오기
			$result = $hotdealModel->getInfoHotdeal($cate, $site, $sort, $nowPage);
			
			// 로그인 되어있을 시 북마크 체크
			if (!empty($_SESSION['idx']))
			{
				$idx = $_SESSION['idx'];
				$bookmarks = $hotdealModel->getInfoListBookmark($idx);
			
				for ($i = 0 ; $i < count($result['data']) ; ++$i)
					for ($j = 0 ; $j < count($bookmarks['data']) ; ++$j)
						if ($result['data'][$i]->idx == $bookmarks['data'][$j]->hotdeal_idx)
							$result['data'][$i]->bookmark = 1;
			}
			
		}
		
		// 해당 정보 없을 시 빈 배열 넣어줌
		if ($result['code'] == '0')
		{
			$result['maxPage'] = 1;
			$result['company'] = array();
			$result['data'] = array();
		}
		
		// 현재 카테고리
		$nowCate = array('idx' => $cate, 'name' => $name);
		
		// 현재, 최대 페이지 번호
		$paging = array('now' => $nowPage, 'max' => $result['maxPage']);
		
		$page = 'hotdeal';
		$data = array(
				'page' => $page, 
				'type' => '코드', 
				'cateList' => $cateList['data'],
				'company' => $result['company'],
				'nowCate' => $nowCate,
				'site' => $site,
				'sort' => $sort,
				'paging' => $paging,
				'prdt' => $result['data'] 
		);
		return view($page, $data);
	}
	
	
	/*
	 * 2016.01.14
	 * 작성자 : 박용호
	 * 조회수 1 증가
	 * 역시 1 증가한 후 10초 후에 증가할 수 있음
	 */
	public function hitCountPlus()
	{
		$hotdealModel = new HotdealTargetModel();
		
		if (isset($_COOKIE['hotdeal_click']))
			return array('code' => 0, 'msg' => 'already clicked!');
		else
			setcookie('hotdeal_click', 1, time()+10);	
		
		$idx = Request::input('idx');
		$result = $hotdealModel->updateHitCount($idx);
		
		return $result;
	}
	
	
	/*
	 * 2016.01.14
	 * 작성자 : 박용호
	 * 핫딜 북마크
	 */
	public function hotdealBookmark()
	{
		$hotdealModel = new HotdealTargetModel();
		
		if (session_id() == '')	session_start();
		$member_idx = $_SESSION['idx'];
		$hotdeal_idx = Request::input('idx');
		
		$result = $hotdealModel->checkBookmark($member_idx, $hotdeal_idx); 
		
		if ($result['code'])
			$hotdealModel->createBookmark($member_idx, $hotdeal_idx, 0);
		else
			$hotdealModel->deleteBookmark($member_idx, $hotdeal_idx);
		
		header('Content-Type: application/json');
		return json_encode($result);
	}
	
}