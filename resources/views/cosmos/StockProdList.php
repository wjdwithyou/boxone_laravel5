<?php
	header("Content-Type: text/xml; charset=utf-8");
	$mallList = DB::connection('sqlsrv')->select("SELECT MallKind, MallID FROM cgMallMain");
	$data = array();
	foreach($mallList as $list)
		array_push($data, DB::connection('sqlsrv')->select("SELECT MallKind, MallID, ProdInc, PnameP, Lprice, Sprice, Stock, PurlP, PimgP, Ccode1, Ccode2, Ccode3, Ccode4 FROM cgProdMain_$list"));
?>

<table border=1>
	<?php foreach ($data as $list) :?>
	<tr>
		<td class=MallKind><?=$list->MallKind?></td>
		<td class=MallID><?=$list->MallID?></td>
		<td class=Pcode>0</td>
		<td class=ProdInc><?=$list->ProdInc?></td>
		<td class=Pname><?=$list->PnameP?></td>
		<td class=Lprice><?=$list->Lprice?></td>
		<td class=Sprice><?=$list->Sprice?></td>
		<td class=Stock><?=$list->Stock?></td>
		<td class=Purl><?=$list->PurlP?></td>
		<td class=Pimg><?=$list->PimgP?></td>
		<td class=Ccode1><?=$list->Ccode1?></td>
		<td class=Ccode2><?=$list->Ccode2?></td>
		<td class=Ccode3><?=$list->Ccode3?></td>
		<td class=Ccode4><?=$list->Ccode4?></td>
	</tr>
	<?php endforeach;?>
</table>