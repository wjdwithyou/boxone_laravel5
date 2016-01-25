<?php
	$data = array(
		'MallKind' 		=> Request::input('MallKind', ''),
		'MallID' 		=> Request::input('MallID', '')
	);
?>
[BOF]MallKind:<?=$data['MallKind']?>/MallID:<?=$data['MallID']?>

<?php 
	$prodList = DB::connection('sqlsrv')->select("SELECT ProdInc, Ccode1, Ccode2, Ccode3, Ccode4 FROM cgProdMain_".$data['MallID']."_".$data['MallKind']);
	for($i = 0 ; $i < count($prodList) ; $i++) :
?>
{<?=$i?>|<?=$prodList[$i]->ProdInc?>|<?=$prodList[$i]->Ccode1?>|<?=$prodList[$i]->Ccode2?>|<?=$prodList[$i]->Ccode3?>|<?=$prodList[$i]->Ccode4?>}
<?php 
	endfor;
?>
[EOF]

