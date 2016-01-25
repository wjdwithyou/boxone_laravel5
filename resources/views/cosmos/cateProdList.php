<?php
	$data = array(
		'DataType' 		=> Request::input('DataType', ''),
		'MallKind' 		=> Request::input('MallKind', ''),
		'MallID' 		=> Request::input('MallID', ''),
		'Ccode1' 		=> Request::input('Ccode1', '')
	);
?>

<?php 
	$cateList = DB::connection('sqlsrv')->select("SELECT MallKind, MallID, ProdInc, Ccode1, Ccode2, Ccode3, Ccode4, DeleteDate8 FROM cgCateLog");
	foreach($cateList as $list) :?>
		<?=$list->MallKind?>:<?=$list->MallID?>:<?=$list->ProdInc?>:<?=$list->Ccode1?>:<?=$list->Ccode2?>:<?=$list->Ccode3?>:<?=$list->Ccode4?>:<?=$list->DeleteDate8?>,
	<?php endforeach;?>

