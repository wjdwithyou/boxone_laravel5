<?php
	$data = array(
		'MallKind' 		=> Request::input('MallKind', ''),
		'MallID' 		=> Request::input('MallID', ''),
		'ProdInc' 		=> Request::input('ProdInc', '')
	);
?>

<?php $cateList = DB::connection('sqlsrv')->delete("DELETE FROM cgCateLog WHERE ProdInc = ?", array($data['ProdInc']));?>

