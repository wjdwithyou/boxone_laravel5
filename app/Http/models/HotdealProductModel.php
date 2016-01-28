<?php
namespace App\Http\models;
use DB;
include_once dirname(__FILE__)."/Utility.php";



/*
 *  상품 관련 컨트롤러
 */
class HotdealProductModel
{

	/*
	 * dd
	 */
	function createBookmark($prod_idx, $member_idx)
	{
		if( !( inputErrorCheck($prod_idx, 'prod_idx')
				&& inputErrorCheck($member_idx, 'member_idx')))
					return ;

		$result = DB::table('product_bookmark')->insertGetId(
				array(
						'prod_idx'=> $prod_idx,
						'member_idx'=> $member_idx,
						'upload'=>DB::raw('now()')
				)
		);

		DB::update('update product set bookmark_count=bookmark_count+1 where idx=?',array($prod_idx));

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}


	/*
	 *	단일 정보 가져오는 기능
	 */
	function getInfoSingle($prod_idx)
	{

		if(	!(	inputErrorCheck($prod_idx, 'prod_idx')))
			return ;

		$my_data = DB::select('SELECT *, FORMAT(priceO, 0) as fPriceO, FORMAT(priceS, 0) as fPriceS FROM hotdeal_product WHERE idx =?',array($prod_idx));
			
		$table = $my_data[0]->mall_id.'_'.$my_data[0]->mall_kind;
		$prodInc = $my_data[0]->prod_id;
		
		$query = DB::connection('sqlsrv')->select("SELECT * FROM cgProdMain_$table WHERE ProdInc = ?", array($prodInc));
		$ms_data_prod = $query[0];
		$ms_data_img = array($ms_data_prod->PimgD);
			
		$query = DB::connection('sqlsrv')->select("SELECT * FROM cgColorMain_$table WHERE ProdInc = ?", array($prodInc));
		$ms_data_color = array();
		foreach($query as $list)
		{
			array_push($ms_data_color, $list->ColorTxt);
			array_push($ms_data_img, $list->Bimg);
			for ($i = 1 ; $i <= 12 ; $i++)
			{
				$col = 'Zimg'.$i;
				$tempImg = $list->$col;
				if ($tempImg != "")
					array_push($ms_data_img, $tempImg);
				else 
					break;
			}
		}
			
		$query = DB::connection('sqlsrv')->select("SELECT Distinct SizeTxt FROM cgSizeMain_$table WHERE ProdInc = ?", array($prodInc));
		$ms_data_size = array();
		foreach($query as $list)
			array_push($ms_data_size, $list->SizeTxt);
			
		$query = DB::connection('sqlsrv')->select("SELECT Story FROM cgStoryMain_$table WHERE ProdInc = ?", array($prodInc));
		$ms_data_story = $query[0]->Story;
		
		$query = DB::connection('sqlsrv')->select("SELECT Still FROM cgStillMain_$table WHERE ProdInc = ?", array($prodInc));
		foreach($query as $list)
			array_push($ms_data_img, $list->Still);	
		
		$imgList = array();
		// 동일한 이미지 정리
		for ($i = 0 ; $i < count($ms_data_img) ; $i++)
		{
			for ($j = $i+1 ; $j < count($ms_data_img) ; $j++)
			{
				if (strpos($ms_data_img[$i], "?"))
					$img1 = substr($ms_data_img[$i], 0, strpos($ms_data_img[$i], "?"));
				else 
					$img1 = $ms_data_img[$i];
				
				if (strpos($ms_data_img[$j], "?"))
					$img2 = substr($ms_data_img[$j], 0, strpos($ms_data_img[$j], "?"));
				else
					$img2 = $ms_data_img[$j];
				
				if ($img1 == $img2)
					break;
			}
			if ($j == count($ms_data_img))
				array_push($imgList, $ms_data_img[$i]);
		}
			
		$result = array(
				'idx' => $my_data[0]->idx,
				'cate' => $my_data[0]->cate_small,
				'url' => $ms_data_prod->PurlD,
				'img' => $imgList,
				'name' => $ms_data_prod->PnameD,
				'explain' => '',
				'mall' => $ms_data_prod->MallID,
				'brand' => $ms_data_prod->BrandID,
				'priceO' => $my_data[0]->fPriceO,
				'price' => $my_data[0]->fPriceS,
				'saleP' => $my_data[0]->saleP,
				'deliverFee' => '',
				'color' => $ms_data_color,
				'size' => $ms_data_size,
				'story' => $ms_data_story
		);
			
		DB::update('update product set hit_count=hit_count+1 where idx=?',array($prod_idx));
		
		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	정보 리스트 가져오는 기능
	 */
	function getInfoList($sort, $cateDepth, $cateIdx, $brand, $mall, $searchList, $page_num)
	{
		if( !( inputErrorCheck($sort, 'sort') && 
				inputErrorCheck($page_num, 'page_num')))
			return ;

		// 정렬 구분
		$query_orderBy = "order by ";
		switch($sort)
		{
			case 1: 	$query_orderBy .= 'hit_count DESC, '; 	break;
			case 2:		$query_orderBy .= 'priceS ASC, '; 		break;
			case 3:		$query_orderBy .= 'priceS DESC, '; 	break;
			case 4:		$query_orderBy .= 'saleP DESC, '; 	break;
			default : 	$query_orderBy .= ""; 					break;
		}
		
		// 카테고리 정리
		$query_cate = "where name != '' ";
		if ($cateDepth == 1)
			$query_cate .= "and cate_large = $cateIdx";
		else if ($cateDepth == 2)
			$query_cate .= "and cate_medium = $cateIdx";
		else if ($cateDepth == 3)
			$query_cate .= "and cate_small = $cateIdx";
		
		// 브랜드 정리
		$query_brand = "";
		foreach($brand as $list)
			$query_brand .= "brand='$list' or ";
		if ($query_brand != "")
			$query_brand = " and (".substr($query_brand, 0, strlen($query_brand) - 3).")";
		
		// 사이트 정리
		$query_mall = "";
		foreach($brand as $list)
			$query_mall .= "mall_id='$list' or ";
		if ($query_mall != "")
			$query_mall = " and (".substr($query_mall, 0, strlen($query_mall) - 3).")";
		
		// 검색어 정리
		$query_search = "";
		foreach($searchList as $list)
			$query_search = "name like '%$list%' or brand like '%$list%' or ";
		if ($query_search != "")
			$query_search = " and (".substr($query_search, 0, strlen($query_search) - 3).")";
		
		
		// 자료 가져오기
		$data = DB::select("select *, FORMAT(priceO, 0) as fPriceO, FORMAT(priceS, 0) as fPriceS from hotdeal_product $query_cate $query_brand $query_mall $query_search $query_orderBy idx DESC");
		
		// 브랜드 리스트 가져오기
		$brandList = DB::select("SELECT DISTINCT brand FROM hotdeal_product $query_cate $query_search ORDER BY brand ASC");
		
		// 사이트 리스트 가져오기
		$mallList = DB::select("SELECT DISTINCT mall_id FROM hotdeal_product $query_cate $query_search ORDER BY mall_id ASC");

		// 갯수 확인 후 페이지 자르기
		$page_max = floor((count($data)-1) / 20) + 1;
		if ($page_num > $page_max)
			$page_num = $page_max;
		$page_start = ($page_num-1)*20;
		$result = array_slice($data, $page_start, 20);
		
		return array('code' => 1, 'msg' => 'success', 'data' => $result, 'maxPage' => $page_max, 'brandList' => $brandList, 'mallList' => $mallList, 'prdtCnt' => count($data));
	}
	

	/*
	 *	내 찜한 상품 목록 가져오기 기능
	 */
	function getMyList($mem_idx, $cateDepth, $cateIdx, $brand, $mall, $searchList, $page_num)
	{
		if( !( 	inputErrorCheck($mem_idx, 'mem_idx') &&
				inputErrorCheck($page_num, 'page_num')))
					return ;
				
		// 브랜드 정리
		$query_brand = "";
		foreach($brand as $list)
			$query_brand .= "hp.brand='$list' or ";
		if ($query_brand != "")
			$query_brand = " and (".substr($query_brand, 0, strlen($query_brand) - 3).")";
		
		// 사이트 정리
		$query_mall = "";
		foreach($brand as $list)
			$query_mall .= "hp.mall_id='$list' or ";
		if ($query_mall != "")
			$query_mall = " and (".substr($query_mall, 0, strlen($query_mall) - 3).")";
		
		// 검색어 정리
		$query_search = "";
		foreach($searchList as $list)
			$query_search = "hp.name like '%$list%' or hp.brand like '%$list%' or ";
		if ($query_search != "")
			$query_search = " and (".substr($query_search, 0, strlen($query_search) - 3).")";
		

		// 자료 가져오기
		$data = DB::select("select *, FORMAT(priceO, 0) as fPriceO, FORMAT(priceS, 0) as fPriceS
							from hotdeal_bookmark as hb, hotdeal_product as hp  
							where hb.member_idx = ? and hb.target = 1 and hb.hotdeal_idx = hp.idx $query_brand $query_mall $query_search", 
							array($mem_idx));
		
		// 브랜드 리스트 가져오기
		$brandList = DB::select("SELECT DISTINCT brand
							FROM hotdeal_bookmark AS hb, hotdeal_product AS hp  
							WHERE hb.member_idx = ? AND hb.target = 1 and hb.hotdeal_idx = hp.idx $query_search ORDER BY brand ASC",
							array($mem_idx));
		
		// 사이트 리스트 가져오기
		$brandList = DB::select("SELECT DISTINCT mall_id
				FROM hotdeal_bookmark AS hb, hotdeal_product AS hp
				WHERE hb.member_idx = ? AND hb.target = 1 and hb.hotdeal_idx = hp.idx $query_search ORDER BY mall_id ASC",
				array($mem_idx));

		// 갯수 확인 후 페이지 자르기
		if (count($data) == 0)
			return array('code' => 0, 'msg' => 'no matched result');
		else
		{
			$page_max = floor((count($data)-1) / 20) + 1;
			if ($page_num > $page_max)
				$page_num = $page_max;
			$page_start = ($page_num-1)*20;
			$result = array_slice($data, $page_start, 20);

			return array('code' => 1, 'msg' => 'success', 'data' => $result, 'maxPage' => $page_max, 'brandList' => $brandList, 'mallList' => $mallList, 'prdtCnt' => count($data));
		}
	}
	
	function getReview($idx)
	{
		$result = DB::select("SELECT * FROM hotdeal_review WHERE hotdeal_idx = ?", array($idx));
		
		$rateArray = array(0,0,0,0,0);
		$rateAll = 0;
		foreach ($result as $list)
		{
			$rateAll += $list->rating;
			++$rateArray[ceil($list->rating+0.1)];
		}
		$rateAve = $rateAll / count($result);
		
		arsort($rateArray);
		$rateBest = array(array_keys($rateArray)[0], array_shift($rateArray));
		
		return array('code' => 1, 'msg' => 'success', 'data' => $result, 'rateCnt' => count($result), 'rateBest' => $rateBest, 'rateAve' => $rateAve);
	}
	
}
