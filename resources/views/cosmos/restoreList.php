<?php
	header("Content-Type: text/xml; charset=utf-8");
	$data = array(
		'MallKind' 		=> Request::input('MallKind', ''),
		'MallID' 		=> Request::input('MallID', ''),
		'Ccode1' 		=> Request::input('Ccode1', ''),
		'ProdIncS' 		=> Request::input('ProdIncS', ''),
		'ProdIncE' 		=> Request::input('ProdIncE', '')
	);
	
	echo "<?xml version='1.0' encoding='utf-8'?> <RestoreData>";
	
	$prodList = DB::connection('sqlsrv')->select("SELECT ProdInc, Sku, Pname, Ccode1, Ccode2, Ccode3, Ccode4, Pimg, Purl, Stock, CreateDate8 FROM cgProdMain_".$data['MallID']."_".$data['MallKind']);
?>
<?php foreach($prodList as $list) : ?>
	<Prod>
	<ProdInc><?=$list->ProdInc?></ProdInc>
	<MallKind><?=$list->MallKind?></MallKind>
	<MallID><?=$list->MallID?></MallID>
	<Sku><?=$list->Sku?></Sku>
	<Pname><?=$list->PnameP?></Pname>
	<Ccode1><?=$list->Ccode1?></Ccode1>
	<Ccode2><?=$list->Ccode2?></Ccode2>
	<Ccode3><?=$list->Ccode3?></Ccode3>
	<Ccode4><?=$list->Ccode4?></Ccode4>
	<Pimg><?=$list->PimgP?></Pimg>
	<Purl><?=$list->PurlP?></Purl>
	<Stock><?=$list->Stock?></Stock>
	<CreateDate8><?=$list->CreateDate8?></CreateDate8>
	</Prod>
<?php endforeach;
	echo "</RestoreData>";
?>


