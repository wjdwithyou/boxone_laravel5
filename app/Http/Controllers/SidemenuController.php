<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\CalculationModel;
use Request;

class SidemenuController extends Controller {



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
	 * 환율 가져오기
	 */
	public function getRate()
	{
		$country = Request::input('country');
		
		$url = "http://query.yahooapis.com/v1/public/yql";
		$url .= "?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22".$country."KRW%22)&format=json&env=store://datatables.org/alltableswithkeys&callback=";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1000);
		$result = curl_exec($ch);
		curl_close($ch);
	
		$result = json_decode($result);
		$result = $result->query->results->rate;
		
		$dateArray = explode('/',$result->Date);
		$date = $dateArray[2].".".$dateArray[0].".".$dateArray[1];
		
		$data = array($date.' '.$result->Time, $result->Rate);
		
		$url = "http://query.yahooapis.com/v1/public/yql";
		$url .= "?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22".$country."USD%22)&format=json&env=store://datatables.org/alltableswithkeys&callback=";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1000);
		$result = curl_exec($ch);
		curl_close($ch);
		
		$result = json_decode($result);
		$result = $result->query->results->rate;
				
		array_push($data, $result->Rate);
			
		header('Content-Type: application/json');
		echo json_encode($data);
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



