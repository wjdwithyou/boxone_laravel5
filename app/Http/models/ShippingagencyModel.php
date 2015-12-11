<?php
namespace App\Http\models;
use DB;

/*
 *  쇼핑사이트 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";


class ShippingagencyModel{

	// 배대지 function 작업하기



	/*
	 *	국가, 지역코드, 배송방식, 무게 입력받아서 배대지별로 요금 출력해주는 기능	
	 */
	function getShippingFare($country, $region_code, $howtoship, $weight)
	{

		if( !( inputErrorCheck($country, 'country')))
			return ;

		$result = DB::select('SELECT * FROM shipping_agency_fare1 AS saf 
									JOIN shioppingsite AS ss 
									ON saf.agency_idx = shoppingsite.idx
									WHERE country=? AND region_code=? AND howtoship=?',
									array($country, $region_code, $howtoship));)

		for($i=0; $i<count($temp); $i++)
		{
			$temp2 = DB::select('select fare from shipping_agency_fare2 where fare1_idx=?, weight=?',
				array($temp[$i]->idx, $weight));


			// 정확한 weight값에 해당하는 fare가 존재하지 않을 경우 반올림해서 검색
			if( $temp2 == NULL ){
				$temp2 = DB::select('select fare from shipping_agency_fare2 where fare1_idx=?, weight=?',
					array($temp[$i]->idx, ceil($weight)));
			}

			$result[$i]->fare = $temp2[0]->fare;
		}

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}


}