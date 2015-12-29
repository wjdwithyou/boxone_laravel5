<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\CardModel;
use App\Http\models\ShoppingsiteModel;
use Request;

class CardController extends Controller {

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
		$cardModel = new CardModel();
		$ssModel = new ShoppingsiteModel();
		
		// 배대지 목록 가지고 오기
		$site = $ssModel->getInfoList(9);
		// 카드사 목록 가지고 오기
		$comp = $cardModel->getCardCompany();
		
		$page = 'card';
		return view($page, array('page' => $page, 'siteList' => $site['data'], 'compList' => $comp['data']));
	}
	
	/*
	 * 2015.11.27
	 * 작성자 : 박용호
	 * 카드 리스트 가져오기
	 * type 1:이름으로 검색, 2:배송대행지로 검색, 3:카드사로 검색
	 */
	public function getCardList()
	{
		$cardModel = new CardModel();
		
		$type = Request::input('type');
		$search = Request::input('search');
		$adr_img = Request::input('adr_img');
		
		if ($type == 3)
		{
			$title = "해외결제 혜택카드";
			$result = $cardModel->getInfoListByCardcompany($search);
		}
		else if ($type == 2)
		{
			$title = "배대지 제휴  신용카드";
			$result = $cardModel->getInfoListByShippingagency($search);
		}
		else
		{
			$title = "카드 검색 결과";
			$result = $cardModel->getInfoByName($search);
		}
		
		$page = "cardInfo";
		
		$ar = array(
			'page' => $page,
			'title' => $title." (".count($result['data']).")",
			'search' => $search,
			'result' => $result['data'],
			'adr_img' => $adr_img
		);
		
		return view($page, $ar);
	}
	
	
	/*
	 * 2015.11.27
	 * 작성자 : 박용호
	 * 카드 리스트 전체 가져오기
	 * type 1:모든 전체, 2:배송대행지 해당 카드 전체, 3:해외 직구 카드 전체
	 */
	public function getCardListAll()
	{
		$cardModel = new CardModel();
		
		$type = Request::input('type');
		$adr_img = Request::input('adr_img');
		
		if ($type == 3)
		{
			$title = "해외결제 혜택카드";
			$result = $cardModel->getInfoList(1);
		}
		else if ($type == 2)
		{
			$title = "배대지 제휴  신용카드";
			$result = $cardModel->getInfoList(0);
		}
		else
		{
			$title = "카드 검색 결과";
			$result = $cardModel->getInfoByName("");
		}
		
		$page = "cardInfo";
		
		$ar = array(
			'page' => $page,
			'title' => $title." (".count($result['data']).")",
			'search' => "전체검색",
			'result' => $result['data'],
			'adr_img' => $adr_img
		);
		
		return view($page, $ar);
	}
}