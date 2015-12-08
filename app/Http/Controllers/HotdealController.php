<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class HotdealController extends Controller {

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
		$page = 'hotdeal';
		return view($page, array('page' => $page));
	}
	
	public function main()
	{
		$page = 'hotdeal_main';
		return view($page, array('page' => $page));
	}
}