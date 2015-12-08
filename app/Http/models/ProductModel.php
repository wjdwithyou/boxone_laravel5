<?php
namespace App\Http\models;
use DB;

/*
 *  상품 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";


class ProductModel()
{

	/*
	 *	유사상품 추천 메소드	-> 소분류 카테고리에서 랜덤출력
	 */
	function recommandProduct($small_idx)
	{
		if( !( InputErrorCheck($small_idx, 'small_idx')))
			return ;
		


	}

	/*
	 *	찜한 상품 가져오는 기능
	 */
	function getInfoBookmark($member_idx)
	{
		if( !( InputErrorCheck($member_idx, 'member_idx')))
			return ;

		$result = DB::select('select * from product_bookmark where member_idx=?', array($member_idx));

		return array('code'=>1, 'msg'=> 'success', 'data'=> $result);
	}

}
