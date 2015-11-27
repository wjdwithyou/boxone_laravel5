<?php
namespace App\Http\models;
/*
 *  환율 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";

class CalculationModel{
	/*
	 *	계산기 카테고리 대분류 리스트 업
	 */
	function getInfoLarge(){

		$result = DB::select('select * from calculation_category_large');

		return $result;
	}

	/*
	 *	계산기 카테고리 중분류 리스트 업
	 */
	function getInfoMedium($large_idx){

        if( !(  inputErrorCheck($large_idx, 'large_idx')))
        	return ; 

		$result = DB::select('select idx, name from calculation_category_medium where large_idx=?', array($large_idx));

		return $result;

	}

	/*
	 *	선택된 인덱스에 해당하는 관세, 부가세 리턴
	 */
	function getInfoTax($idx){

        if( !(  inputErrorCheck($idx, 'idx')))
        	return ; 

		$result = DB::select('select status, duty, surtax, note from calculation_category_medium where idx=?', array($idx));

		return $result;
	}
	
	/*
	 *	선택된 무게에 따른 세금 리턴
	 */
	function getWeightTax($status, $region, $weight){
	
		if( !(inputErrorCheck($status, 'status')
				&& inputErrorCheck($region, 'region')
				&& inputErrorCheck($weight, 'weight')))
			return ;
	
		$result = DB::select('select tax from calculation_weight_tax where status=? AND weight=? AND region=?', array($status, $weight, $region));
	
		return $result[0]->tax;
	}
}	
