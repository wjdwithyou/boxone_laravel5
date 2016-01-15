<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Request;

class GuideController extends Controller {

	

	public function index()
	{
		$no = Request::input('no');
		$det = Request::input('det');
		$page = 'guide';
		return view($page, array('page' => $page, 'no' => $no, 'det' => $det));
	}
}