<?php
namespace App\Http\models;
use DB;

/*
 *  직거래박스 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";


class DirectTradeModel()
{

	/*
	 *	직거래 회원 전환 메소드
	 */
	function createMember($member_idx, $name, $phone, $addr_1, $addr_2, $account_bank, $account_number)
	{
		if( !( inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($name, 'name')
				&& inputErrorCheck($phone, 'phone')
				&& inputErrorCheck($addr_1, 'addr_1')
				&& inputErrorCheck($addr_2, 'addr_2')
				&& inputErrorCheck($account_bank, 'account_bank')
				&& inputErrorCheck($account_number, 'account_number')))
			return ;

		$result = DB::table('direct_member')->insertGetId(
			array(
				'member_idx'=> $member_idx, 
				'name'			=> $name, 
				'phone'			=> $phone, 
				'addr_1'		=> $addr_1, 
				'addr_2'		=> $addr_2, 
				'account_bank'	=> $account_bank, 
				'account_number'	=> $account_number, 
				'upload'=>DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}


	/*
	 *	직거래 상품 등록
	 */
	function createProduct()
	{


	}


	/*
	 *	카테고리별 베스트 랭킹 상품 출력
	 */
	function getInfoBestranking($category_idx)
	{
		//대분류 카테고리에서 베스트 순서로 출력

	}


	/*
	 *	오늘의랭킹 부분 - 전체 직거래박스 물품중 랭킹 TOP 출력 
	 */
	function getInfoTotalBestranking()
	{
		direct_product

	}

	/*
	 *	셀러 단골등록하기 기능
	 */
	function createBestSeller($member_idx, $seller_idx)
	{
		if( !( inputErrorCheck($member_idx, 'member_idx')
			   && inputErrorCheck($seller_idx, 'seller_idx')))
			return ;



	}

	/* 
	 *	단골 셀러 삭제
	 */
	function deleteBestSeller($bestseller_idx)
	{


	}

	/*
	 *	해당 product를 장바구니에 저장
	 */
	function createDirectCart($member_idx, $product_idx)
	{


	}


 	/*
 	 *	판매자에게 컴플레인 등록
 	 */
 	function createDirectComplain($member_idx, $seller_idx)
 	{


 	}


 	/*
	 * 판매자가 컴플레인에 대한 답글 등록
	 */
 	function createDirectComplainReply($member_idx,)
 	{


 		status update 필요
 	}


 	/*
 	 *	현재 보고있는 판매자 상품의 다른 상품 추천
 	 */
 	function other()
 	{


 	
	}


	/*
	 *	주문  + direct_buylist 테이블에 해당 회원 구매내역 추가
	 */

}
