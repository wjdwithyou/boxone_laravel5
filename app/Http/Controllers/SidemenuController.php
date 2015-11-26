<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Request;

include dirname(__FILE__)."/../models/CalculationModel.php";
include_once dirname(__FILE__)."/../function/baseFunction.php";

class SidemenuController extends Controller {

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
		if (Request::has('bef'))		
			$bef = Request::input('bef');
		else
			$bef = "http://".$_SERVER['HTTP_HOST'];
		$page = 'sidemenu';
		return view($page, array('page' => $page, 'bef' => $bef));
	}
	
	public function getCateLarge()
	{
		$result = getInfoLarge();
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	public function getCateMedium()
	{
		$cateLarge = Request::input('cate');
		$result = getInfoMedium($cateLarge);
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function getCateTax()
	{
		$cate_idx = Request::input('cate');
		$result = getInfoTax($cate_idx);
		
		header('Content-Type: application/json');
		echo json_encode($result[0]);
	}
	
	public function getWeightTax()
	{
		$status = Request::input('status');
		$region = Request::input('region');
		$weight = Request::input('weight');
		
		if ($status == 1)
		{
			if ($weight % 2 == 1)
				$weight -= 1;
			
			$num = ($weight - ($weight % 20)) / 20;
			$weight = $weight % 20;
			
			$result = 0;
			if ($weight != 0)
				$result = getWeightTax($status, $region, $weight);
			
			if ($region == 1)
				$result += $num * 45500;
			else
				$result += $num * 59000;
		}
		else
		{
			if ($weight > 30)
				if ($region == 1)
					$result = 101300 + ($weight - 30)*2600;
				else
					$result = 213000 + ($weight - 30)*6000;
			else 
				$result = getWeightTax($status, $region, $weight);
		}
		
		header('Content-Type: application/json');
		echo $result;
	}
}



