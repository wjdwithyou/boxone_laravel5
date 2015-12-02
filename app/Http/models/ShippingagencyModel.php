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
	 *	
	 */

	function getShippingFare($country, $region_code, $howtoship, $weight)
	{

		if( !( inputErrorCheck($country, 'country')))
			return ;


		if( $region_code = 0)

			echo "false";

		then else( $weight = 0)
		



	}
}