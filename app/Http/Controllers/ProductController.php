<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\models\ProductModel;
use App\Http\models\CategoryModel;
use Request;


class ProductController extends Controller {

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
		$page = 'product';
		return view($page, array('page' => $page));
	}

	public function detail()
	{
		$cateModel = new CategoryModel();
		$prdtModel = new ProductModel();
				
		$idx = Request::input('idx');
		$result = $prdtModel->getInfoSingle($idx);

		$cateS = $result['data'][0]->cate_small;
		$data = $cateModel->downToUp($cateS);
		
		$page = 'product';
		return view($page, array('page' => $page, 'result' => $result['data'], 'cate' => $data['data'][0]));
	}

}






