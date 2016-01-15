<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class MainController extends Controller {

	
	/*
	 * 2015.11.17
	 * 작성자 : 박용호
	 * 메인 페이지 출력, 미완
	 */
	public function index()
	{
		$page = 'main';
		return view($page, array('page' => $page));
	}


}