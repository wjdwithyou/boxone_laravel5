<?php
namespace App\Http\models;
use DB;

/*
 *  상품 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";


class ProductModel
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

		if (connectToMssql())
		{
			$my_data = DB::select('select * from product where idx =?',array($prod_idx));
				
			$table = $my_data[0]->mall_id.'_'.$my_data[0]->mall_kind;
			$prodInc = $my_data[0]->prod_id;
				
			$query = mssql_query("SELECT * FROM cgProdMain_$table WHERE ProdInc = $prodInc");
			$ms_data_prod = mssql_fetch_array($query);
			$ms_data_img = array($ms_data_prod['PimgD']);
				
			$query = mssql_query("SELECT * FROM cgColorMain_$table WHERE ProdInc = $prodInc");
			$ms_data_color = array();
			while ($temp = mssql_fetch_array($query))
			{
				array_push($temp['ColorTxt']);
				array_push($ms_data_img, $temp['Bimg']);
				for ($i = 1 ; $i <= 12 ; $i++)
				{
					$tempImg = $temp['Zimg'.$i];
					if ($tempImg != "")
						array_push($ms_data_img, $tempImg);
					else 
						break;
				}
			}
			$ms_data_color = substr($ms_data_color, 0, strlen($ms_data_color)-3);
				
			$query = mssql_query("SELECT Distinct SizeTxt, * FROM cgSizeMain_$table WHERE ProdInc = $prodInc");
			$ms_data_size = array();
			while ($temp = mssql_fetch_array($query))
				array_push($temp['SizeTxt']);
			$ms_data_size = substr($ms_data_size, 0, strlen($ms_data_size)-3);
				
			$query = mssql_query("SELECT Story FROM cgStoryMain_$table WHERE ProdInc = $prodInc");
			$temp = mssql_fetch_array($query);
			$ms_data_story = $temp['Story'];
			
			$query = mssql_query("SELECT Still FROM cgStillMain_$table WHERE ProdInc = $prodInc");
			$temp = mssql_fetch_array($query);
			while ($temp = mssql_fetch_array($query))
				array_push($ms_data_img, $temp['Still']);						
				
			$result = array(
					'idx' => $my_data[0]->idx,
					'cate' => $my_data[0]->cate_small,
					'url' => $ms_data_prod['PurlD'],
					'img' => $ms_data_img,
					'name' => $ms_data_prod['PnameD'],
					'explain' => '',
					'mall' => $ms_data_prod['MallID'],
					'brand' => $ms_data_prod['BrandID'],
					'price' => makeMoney($ms_data_prod['Lprice']),
					'deliverFee' => '',
					'color' => $ms_data_color,
					'size' => $ms_data_size,
					'story' => $ms_data_story
			);
				
			DB::update('update product set hit_count=hit_count+1 where idx=?',array($prod_idx));
		}
		else
		{
			echo "mssql Connection failed.\n";
			return;
		}

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	정보 리스트 가져오는 기능
	 */
	function getInfoList($sort, $getCateList, $page_num)
	{
		if( !( inputErrorCheck($sort, 'sort') && 
				inputErrorCheck($getCateList, 'getCateList') &&
				inputErrorCheck($page_num, 'page_num')))
			return ;

		// 정렬 구분
		$query_orderBy = "order by ";
		switch($sort)
		{
			case 1: 	$query_orderBy .= 'hit_count DESC, '; 	break;
			case 2:		$query_orderBy .= 'deadline ASC, '; 		break;
			case 3:		$query_orderBy .= 'site_name ASC, '; 	break;
			default : 	$query_orderBy .= ""; 					break;
		}
		
		// 카테고리 정리
		$query_cate = "where name != '' ";
		foreach($getCateList as $list)
			$query_cate .= "and cate_small=$list ";
		
		// 자료 가져오기
		$data = DB::select("select * from product $query_cate $query_orderBy idx DESC");

		// 갯수 확인 후 페이지 자르기
		if (count($data) == 0)
			return array('code' => '0', 'msg' => 'no matched result');
		else
		{
			$page_max = floor((count($data)-1) / 30) + 1;
			if ($page_num > $page_max)
				$page_num = $page_max;
			$page_start = ($page_num-1)*30;
			$result = array_slice($data, $page_start, 30);

			return array('code' => 1, 'msg' => 'success', 'data' => $result, 'maxPage' => $page_max);
		}
	}
}
