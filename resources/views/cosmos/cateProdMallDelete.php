<?php
	$data = array(
		'MallKind' 		=> Request::input('MallKind', ''),
		'MallID' 		=> Request::input('MallID', '')
	);
?>

<?php $cateList = DB::connection('sqlsrv')->delete("DELETE FROM cgCateLog WHERE MallKind = ? AND MallID = ?", array($data['MallKind'], $data['MallID']));?>

