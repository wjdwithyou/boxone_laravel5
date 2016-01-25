<?php
use DB;
	header("Content-Type: text/xml; charset=utf-8");
	$data = array(
		'ProdInc' 		=> Request::input('ProdInc', ''),
		'MallKind' 		=> Request::input('MallKind', ''),
		'MallID' 		=> Request::input('MallID', '')
	);
	
	DB::connection('sqlsrv')->delete("DELETE FROM cgDeleteLog WHERE ProdOInc=?", array($data['ProdInc']));

?>