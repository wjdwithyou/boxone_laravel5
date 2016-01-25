<?php
	$data = array(
		'MallKind' 		=> Request::input('MallKind', ''),
		'MallID' 		=> Request::input('MallID', ''),
		'ProdIncS' 		=> Request::input('ProdIncS', ''),
		'ProdIncE' 		=> Request::input('ProdIncE', '')
	);
?>
MallKind[<?=$data['MallKind']?>] / MallID[<?=$data['MallID']?>] / ProdIncS[<?=$data['ProdIncS']?>] / ProdIncE[<?=$data['ProdIncE']?>]<br>
<?php 
	$incList = DB::connection('sqlsrv')->select("SELECT ProdInc FROM cgProdMain_$MallID"."_$MallKind WHERE ProdInc > ? AND ProdInc < ?", array($data['ProdIncS'], $data['ProdIncE']));
	for ($i = 0 ; $i < count($incList) ; $i++)
	{
		if ($i != count($incList)-1)
			echo $list->prodInc.",";
		else 
			echo $list->prodInc."[EOF]";
	}
?>

