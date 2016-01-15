<?php
namespace App\Http\models;
use DB;
include_once dirname(__FILE__)."/Utility.php";


/*
 *  카테고리 관련 컨트롤러
 */
class CategoryModel{


	/*
	 *	소분류 -> 대분류 
	 */
	function downToUp($small_idx)
	{


		$result = DB::select("SELECT 
									cs.idx as sidx, 
									cs.name as sname, 
									cm.idx as midx, 
									cm.name as mname, 
									cl.idx as lidx, 
									cl.name as lname 
								FROM category_small AS cs
								INNER JOIN category_medium AS cm
									ON cs.medium_idx = cm.idx
								INNER JOIN category_large AS cl
								 	ON cm.large_idx = cl.idx
								WHERE cs.idx='$small_idx'");

      	return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	대분류 -> 소분류 
	 */
	function upToDown($large_idx)
	{
		if( !( inputErrorCheck($large_idx, 'large_idx')))
			return ;

		$result = DB::select("SELECT 
									cs.idx as sidx, 
									cs.name as sname, 
									cm.idx as midx, 
									cm.name as mname, 
									cl.idx as lidx, 
									cl.name as lname
								FROM category_large AS cl
								INNER JOIN category_medium AS cm
									ON cm.large_idx = cl.idx
								INNER JOIN category_small AS cs
								 	ON cs.medium_idx = cm.idx
								WHERE cl.idx='$large_idx'");


      	return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	대분류 리스트 업 
	 */
	function getInfoListLarge()
	{
		$result = DB::select('select * from category_large');

      	return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	중분류 리스트 업 
	 */
	function getInfoListMedium($large_idx)
	{
		if( !( inputErrorCheck($large_idx, 'large_idx')))
			return ;

		$result = DB::select('select * from category_medium where large_idx=?', array($large_idx));

	    return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

	/*
	 *	소분류 리스트 업 
	 */
	function getInfoListSmall($medium_idx)
	{
		if( !( inputErrorCheck($medium_idx, 'medium_idx')))
			return ;

		$result = DB::select('select * from category_small where medium_idx=?', array($medium_idx));

	    return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}
	
	function getCateName($depth, $idx)
	{
		if ($depth == 1)
			$result = DB::select("SELECT * FROM category_large WHERE idx=$idx");
		else if ($depth == 2)
			$result = DB::select("SELECT * FROM category_medium WHERE idx=$idx");
		else
			$result = DB::select("SELECT * FROM category_small WHERE idx=$idx");
		
		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

}