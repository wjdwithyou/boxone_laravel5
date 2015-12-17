<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class CommunityController extends Controller {

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
		$page = 'community';
		return view($page, array('page' => $page));
	}
	
	public function write()
	{
		$page = 'community_write';
		return view($page, array('page' => $page));
	}
}