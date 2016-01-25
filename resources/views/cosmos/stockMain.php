<?php
	use Request;

	header("Content-Type: text/xml; charset=utf-8");
	$data = array(
			'Pinc' 		=> Request::input('ProdInc', ''),
			'Pcode' 		=> Request::input('Pcode', ''),
			'CustID' 		=> Request::input('CustID', ''),
			'ProdKind' 		=> Request::input('ProdKind', ''),
			'MallKind' 		=> Request::input('MallKind', ''),
			'MallID' 		=> Request::input('MallID', ''),
			'ServiceID' 	=> Request::input('ServiceID', ''),
			'Ccode1' 		=> Request::input('Ccode1', ''),
			'Ccode2' 		=> Request::input('Ccode2', ''),
			'Ccode3' 		=> Request::input('Ccode3', ''),
			'Ccode4' 		=> Request::input('Ccode4', ''),
			'PnameP' 		=> Request::input('PnameP', ''),
			'PnameD' 		=> Request::input('PnameD', ''),
			'Stock' 		=> Request::input('Stock', ''),
			'StockMsg' 		=> Request::input('StockMsg', ''),
			
			/*'Pname' 		=> Request::input('Pname', ''),
			'Brand' 		=> Request::input('Brand', ''),
			'ItemCode' 		=> Request::input('ItemCode', ''),
			'Sku' 			=> Request::input('Sku', ''),
			'Nation' 		=> Request::input('Nation', ''),
			'Maker' 		=> Request::input('Maker', ''),
			'Lprice' 		=> Request::input('Lprice', ''),
			'Sprice' 		=> Request::input('Sprice', ''),
			
			'Purl' 			=> Request::input('Purl', ''),
			'Pimg' 			=> Request::input('Pimg', ''),
			'PimgP' 		=> Request::input('PimgP', ''),
			'PimgD' 		=> Request::input('PimgD', ''),
			'LogoImg' 		=> Request::input('LogoImg', ''),
			'Story' 		=> Request::input('Story', ''),
			'ColorInfo' 	=> Request::input('ColorInfo', ''),
			'StillInfo' 	=> Request::input('StillInfo', ''),
			'SizeInfo' 		=> Request::input('SizeInfo', ''),
			'LpriceP' 		=> Request::input('LpriceP', ''),
			'SpriceP' 		=> Request::input('SpriceP', ''),
			'Lrprice' 		=> Request::input('Lrprice', ''),
			'Srprice' 		=> Request::input('Srprice', ''),
			'Lsprice' 		=> Request::input('Lsprice', ''),
			'Ssprice' 		=> Request::input('Ssprice', ''),
			'ExchangeRate' 	=> Request::input('ExchangeRate', ''),
			'Shipping' 		=> Request::input('Shipping', ''),
			'Trate' 		=> Request::input('Trate', ''),
			'Weight' 		=> Request::input('Weight', ''),
			'DeliveryFee' 	=> Request::input('DeliveryFee', ''),
			'Drate' 		=> Request::input('Drate', ''),
			'Dadd' 			=> Request::input('Dadd', ''),
			'Krate' 		=> Request::input('Krate', ''),
			'Kadd' 			=> Request::input('Kadd', ''),
			'Crate' 		=> Request::input('Crate', ''),
			'CstdD' 		=> Request::input('CstdD', ''),
			'CstdK' 		=> Request::input('CstdK', ''),
			'CstdType' 		=> Request::input('CstdType', ''),
			'Customs' 		=> Request::input('Customs', ''),
			'AddTax' 		=> Request::input('AddTax', ''),
			'Prate' 		=> Request::input('Prate', ''),
			'Profit' 		=> Request::input('Profit', ''),
			'MDID' 			=> Request::input('MDID', ''),		*/	
	);
	
	$table = "cgProdStock_".$data['MallID']."_".$data['MallKind'];
	
	$cnt = DB::connection('sqlsrv')->select("SELECT count(*) as cnt FROM $table WHERE ProdInc = ?", array($data['ProdInc']));
	if ($cnt[0]->cnt)
		DB::connection('sqlsrv')->table($table)->where('ProdInc', $data['ProdInc'])->update($data);
	else 
		DB::connection('sqlsrv')->table($table)->insert($data);
	
	$table = "cgProdMain_".$data['MallID']."_".$data['MallKind'];
	DB::connection('sqlsrv')->table($table)->where('ProdInc', $data['ProdInc'])->update($data);

?>

