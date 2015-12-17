<?php
namespace App\Http\models;
use DB;

/*
 *  직거래박스 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";


class DirectTradeModel
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
	 *	직거래 상품 등록 + direct_salelist테이블에 해당 회원 판매리스트 추가 
	 */
	function createProduct()
	{

		$result = DB::table('direct_product')->insertGetId(
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

///////////////////////////////////////////////////////////////////////////////////////////////////////////////상품입력받고

		// direct_salelist에 주문상품 추가
		DB::table('direct_salelist')->insertGetId(
			array(
				'product_idx'	=> $result, 
				'upload'=>DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

	/*
	 *	오늘의랭킹 부분 - 현 시점에서 할인율 가장 높은 상품 9개 출력  
	 */
	function getInfoTodayRanking()
	{
		$result = DB::select('select * from direct_product where status=1 order by price_sale/price_original DESC limit 9');

		for($i=0; $i<count($result); $i++)
		{
			$result[$i]->sale_rate = (double)$result[$i]->price_sale/$result[$i]->price_original;
		}

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

	/*
	 *	직거래박스 메인페이지에서 대분류 카테고리별 베스트 랭킹 상품 출력
	 */
	function getInfoBestranking($category_L)
	{
		if( !( inputErrorCheck($category_L, 'category_L')))
			return ;

		$result = DB::select('select * from direct_product where category_L=? AND status=1 order by hit_count+bookmark_count DESC limit 12', array($category_L));

		return array('code' => 1,'msg' =>'success' ,'data' => $result);				
	}	

	/*
	 *	직거래박스 세부페이지에서 대/중/소분류 카테고리별 직거래박스 상품 출력
	 */
	function getInfoDirectProduct($category_idx, $type, $sort_option)
	{

		$option_query = '';
		switch($sort_option)
		{
			case 1:
			$option_query = ' hit_count+bookmark_count DESC,';
			break ;

			case 2:
			$option_query = ' price_sale ASC,';
			break ;

			case 3:
			$option_query = ' price_sale DESC,';
			break ;

			default :
			break;
		}

		$where_query = '';
		switch(type)
		{
			case 1:
			$where_query = "category_L='$category_idx'";
			break;
			
			case 2:
			$where_query = "category_M='$category_idx'";
			break;
	
			case 3:
			$where_query = "category_S='$category_idx'";
			break;
		
			default :
			break;	
		}

		$result = DB::select('select * from direct_product where '.$where_query.' AND status=1 order by'.$option_query.' idx DESC');

		return array('code' => 1, 'msg' => 'success', 'data' => $result);		
	}


/////BRAND_LIST
	/*
	 *	상품 등록시 브랜드 직접입력때 사용 
	 */
	function createBrand($name)
	{	
		if( !( inputErrorCheck($name, 'name')))
			return ;

		$result = DB::table('brand')->insertGetId(
			array(
				'name'			=> $name, 
				)
			);
		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

	/*
	 *	브랜드 리스트 출력
	 */
	function getInfoBrandList($char)
	{
		if( !( inputErrorCheck($char, 'char')))
			return ;

		$sort = "";
		if($char >= 65 && $char <= 90)		// 알파벳 일 경우
			$sort .= "name like '".chr($i)."%'";
		else if( $char == 123)				// 숫자 일 경우
			for ($i = 0 ; $i < 10 ; $i++)
				$sort .= " or name like '$i%'";		
		else 								// 특수문자 일 경우
		{ 								
			for ($i = 33 ; $i < 48 ; $i++)
				$sort .= "name like '".chr($i)."%'";
			for ($j = 58 ; $j < 65 ; $j++)
				$sort .= "name like '".chr($i)."%'";
		}
		$sort = "(".substr($sort, 3).")";
		
		$result = DB::select('select * from brand_list where '.$sort.' order by name asc');
		
		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	
	/*
	 *	브랜드 종류별 상품 출력 
	 */
	function getInfoByBrand($brand_idx, $sort_option)
	{

		if( !( inputErrorCheck($brand_idx, 'brand_idx')
				&& inputErrorCheck($sort_option, 'sort_option')))
			return ;

		$option_query = '';
		switch($sort_option)
		{
			case 1:
			$option_query = ' hit_count+bookmark_count DESC,';
			break ;

			case 2:
			$option_query = ' price_sale ASC,';
			break ;

			case 3:
			$option_query = ' price_sale DESC,';
			break ;

			default :
			break;
		}

		$result = DB::select('select * from direct_product where brand=? AND status=1 order by'.$option_query.' idx DESC', array($brand_idx));

		return array('code' => 1, 'msg' => 'success', 'data' => $result);		
	}	

/////BESTSELLER
	/*
	 *	셀러 단골등록하기 기능
	 */
	function createBestSeller($member_idx, $seller_idx)
	{
		if( !( inputErrorCheck($member_idx, 'member_idx')
			   && inputErrorCheck($seller_idx, 'seller_idx')))
			return ;

		$result = DB::table('direct_bestseller')->insertGetId(
			array(
				'member_idx'			=> $member_idx,
				'seller_idx'			=> $seller_idx, 
				'upload'				=> DB::raw('now()')
				)
			);

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

	/* 
	 *	단골 셀러 삭제
	 */
	function deleteBestSeller($bestseller_idx)
	{
		if( !( inputErrorCheck($bestseller_idx, 'bestseller_idx')))
			return ;

		$result = DB::delete('delete from direct_bestseller where idx=?', array($bestseller_idx));
                        
		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'delete failure: no matched data');
        }
	}

	/*
	 *	해당 회원의 단골 셀러 가져오는 기능
	 */
	function getBestSeller($member_idx)
	{
		if( !( inputErrorCheck($member_idx, 'member_idx')))
			return ;

		$result = DB::select('select * from direct_bestseller where member_idx=?', array($member_idx));

        return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

/////CART
	/*
	 *	해당 product를 장바구니에 저장
	 */
	function createDirectCart($member_idx, $product_idx)
	{

		if( !( inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($product_idx, 'product_idx')))
			return ;

		$result = DB::table('direct_cart')->insertGetId(
			array(
				'member_idx'		=> $member_idx, 
				'product_idx'		=> $product_idx, 
				'upload'			=> DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}


/////COMPLAIN
 	/*
 	 *	판매자에게 컴플레인 등록
 	 */
 	function createSellerComplain($member_idx, $seller_idx, $title, $contents, $complain_category)
 	{

		if( !( inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($seller_idx, 'seller_idx')
				&& inputErrorCheck($title, 'title')
				&& inputErrorCheck($contents, 'contents')
				&& inputErrorCheck($complain_category, 'complain_category')))
			return ;

		$result = DB::table('direct_cart')->insertGetId(
			array(
				'member_idx'		=> $member_idx, 
				'seller_idx'		=> $seller_idx, 
				'title'				=> $title, 
				'contents'			=> $contents, 
				'complain_category'	=> $complain_category, 
				'upload'			=> DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
 	}

 	/*
	 * 판매자가 컴플레인에 대한 답글 등록
	 * 구매자도 답답글로 등록 가능: seller table에 등록
	 */
 	function createSellerComplainAnswer($seller_idx, $title, $contents, $complain_idx)
 	{
		if( !( inputErrorCheck($seller_idx, 'seller_idx')
				&& inputErrorCheck($title, 'title')
				&& inputErrorCheck($contents, 'contents')
				&& inputErrorCheck($complain_idx, 'complain_idx')))
			return ;

		$result = DB::table('direct_cart')->insertGetId(
			array(
				'seller_idx'		=> $seller_idx, 
				'title'				=> $title, 
				'contents'			=> $contents, 
				'complain_idx'		=> $complain_idx, 
				'upload'			=> DB::raw('now()')
				)
			);	

		DB::update('update direct_complain set status=1 where idx=?',array($complain_idx));

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
 	}

 	/*
 	 *	판매자 컴플레인 리스트 출력
 	 */
 	function getInfoListSellerComplain($seller_idx)
 	{	
		if( !( inputErrorCheck($seller_idx, 'seller_idx')))
			return ;

		$result = DB::select("SELECT 
									dc.idx as dc_idx
									dc.contents as d_contents,
									dc.complain_category as dc_complain_category,
									dc.upload as dc_upload,
									dc.status as dc_status,
									mm.nickname as mm_nickname
								FROM direct_complain AS dc
								INNER JOIN direct_member AS dm
								 	ON dc.member_idx = dm.idx
								INNER JOIN member AS mm 
									ON dm.member_idx = mm.idx
								WHERE dc.seller_idx='$seller_idx'
								ORDER BY dc.idx DESC");

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
 	}


 	/*
 	 *	해당 판매자의 컴플레인 내용 + 답변까지 같이 넘겨줌
 	 */
 	function getSingleInfoSellerComplain($complain_idx)
 	{
		if( !( inputErrorCheck($complain_idx, 'complain_idx')))
			return ;

		$result = DB::select("SELECT 
									dc.contents as dc_contents, 
									dc.image as dc_image,
									dca.contents as dca_contents, 
									dca.upload as dca_upload,
									dca.image as dca_image,
									mm.nickname as mm_nickname
								FROM direct_complain AS dc
								INNER JOIN direct_complain_answer AS dca
									ON dc.idx = dca.complain_idx
								INNER JOIN direct_member AS dm
								 	ON dca.member_idx = dm.idx
								INNER JOIN member AS mm 
									ON dm.member_idx = mm.idx
								WHERE dc.complain_idx='$complain_idx'
								ORDER BY dca.idx ASC");

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
 	}

 	/*
 	 *	complain 검색 기능
 	 */
 	function getInfoComplainByKeyword($keyword, $type)
 	{
 		if( !( inputErrorCheck($keyword, 'keyword')
 				&& inputErrorCheck($type, 'type')))
 			return ;

 		if($type == 0)	// 문의종류로 검색
 		{
			$result = DB::select("SELECT 
										dc.idx as dc_idx
										dc.contents as d_contents,
										dc.complain_category as dc_complain_category,
										dc.upload as dc_upload,
										dc.status as dc_status,
										mm.nickname as mm_nickname
									FROM direct_complain AS dc
									INNER JOIN direct_member AS dm
									 	ON dc.member_idx = dm.idx
									INNER JOIN member AS mm 
										ON dm.member_idx = mm.idx
									WHERE dc_status='$keyword'
									ORDER BY dc.idx DESC");
 		}
 		else if($type == 1)	// 문의자로 검색
 		{
			$result = DB::select("SELECT 
										dc.idx as dc_idx
										dc.contents as d_contents,
										dc.complain_category as dc_complain_category,
										dc.upload as dc_upload,
										dc.status as dc_status,
										mm.nickname as mm_nickname
									FROM direct_complain AS dc
									INNER JOIN direct_member AS dm
									 	ON dc.member_idx = dm.idx
									INNER JOIN member AS mm 
										ON dm.member_idx = mm.idx
									WHERE mm_nickname='$keyword'
									ORDER BY dc.idx DESC");
 		}	
		return array('code' => 1, 'msg' => 'success', 'data' => $result);

 	}



/////REVIEW
	/*
	 *	판매자에 대한 구매평 작성 기능
	 */
	function createSellerReview($member_idx, $direct_seller_idx, $direct_product_idx)
	{
		if( !(inputErrorCheck($member_idx, 'member_idx')
			&& inputErrorCheck($direct_seller_idx, 'direct_seller_idx')
			&& inputErrorCheck($direct_product_idx, 'direct_product_idx')))
			return ;

		$result = DB::table('direct_review')->insertGetId(
			array(
				'member_idx'		=> $member_idx, 
				'direct_seller_idx'	=> $direct_seller_idx, 
				'direct_product_idx'=> $direct_product_idx, 
				'upload'			=> DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}	

	/*
	 *	판매자에 대한 구매평 리스트 가져오는 기능
	 */
	function getInfoSellerReview($seller_idx)
	{
		if( !(inputErrorCheck($seller_idx, 'seller_idx')))
			return ;

		$result = DB::select("SELECT 
									dr.title as dr_title,
									dr.rating as dr_rating
									dr.upload as dr_upload
									dp.name as dp_name
									dm.nickname as dm_nickname
								FROM direct_review AS dr
								INNER JOIN direct_product AS dp
									ON dr.direct_product_idx = dp.idx
								INNER JOIN direct_member AS dm
									ON dr.member_Idx = dm.idx
								WHERE seller_idx='$seller_idx'
								ORDER BY idx DESC");

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}




 	/*
 	 *	현재 보고있는 판매자 상품의 다른 상품 추천
 	 */
 	function recommandOtherProduct($seller_idx)
 	{
 		if( !( inputErrorCheck($seller_idx, 'seller_idx')))
 			return ;

 		$result = DB::select('select * from direct_product where seller_idx=? limit 4',array($seller_idx));
 	
		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}


	/*
	 *	주문  + direct_buylist 테이블에 해당 회원 구매내역 추가
	 */
	function cartOrder($member_idx)
	{


	}
}
