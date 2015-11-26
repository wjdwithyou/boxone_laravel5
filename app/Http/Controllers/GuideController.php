<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Request;

class GuideController extends Controller {

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
		$no = Request::input('no');
		$det = Request::input('det');
		$page = 'guide';
		return view($page, array('page' => $page, 'no' => $no, 'det' => $det));
	}
}