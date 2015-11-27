<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\CalculationModel;
use Request;

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
	
	/*
	 * 2015.11.27
	 * 작성자 : 박용호
	 * 계산기용 큰 카테고리 가져오기
	 */
	public function getCateLarge()
	{
		$calculationModel = new CalculationModel();
		
		$result = $calculationModel->getInfoLarge();
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	
	/*
	 * 2015.11.27
	 * 작성자 : 박용호
	 * 계산기용 작은 카테고리 가져오기
	 */
	public function getCateMedium()
	{
		$calculationModel = new CalculationModel();
		
		$cateLarge = Request::input('cate');
		$result = $calculationModel->getInfoMedium($cateLarge);
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	
	/*
	 * 2015.11.27
	 * 작성자 : 박용호
	 * 카테고리별 관세, 부과세 비율 가져오기 (+ 안심금액)
	 */
	public function getCateTax()
	{
		$calculationModel = new CalculationModel();
		
		$cate_idx = Request::input('cate');
		$result = $calculationModel->getInfoTax($cate_idx);
		
		header('Content-Type: application/json');
		echo json_encode($result[0]);
	}
	
	
	/*
	 * 2015.11.27
	 * 작성자 : 박용호
	 * 선편요금 가져오기
	 */
	public function getWeightTax()
	{
		$calculationModel = new CalculationModel();
		
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
				$result = $calculationModel->getWeightTax($status, $region, $weight);
			
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
				$result = $calculationModel->getWeightTax($status, $region, $weight);
		}
		
		header('Content-Type: application/json');
		echo $result;
	}
}



