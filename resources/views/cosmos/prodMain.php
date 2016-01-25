<?php
	use Request;

	header("Content-Type: text/xml; charset=utf-8");
	$data = array(
			'ProdInc' 		=> Request::input('ProdInc', ''),
			'CustID' 		=> Request::input('CustID', ''),
			'ProdKind' 		=> 'PROD',
			'MallKind' 		=> Request::input('MallKind', ''),
			'MallID' 		=> Request::input('MallID', ''),
			'ServiceID' 	=> Request::input('ServiceID', ''),
			'Cname1'		=> Request::input('Cname1', ''),
			'Cname2'		=> Request::input('Cname2', ''),
			'Cname3'		=> Request::input('Cname3', ''),
			'Cname4'		=> Request::input('Cname4', ''),
			'PageNum' 		=> 0,
			//'PnameP' 		=> Request::input('Pname', ''), 이전 PnameD를 복사
			'PnameD' 		=> Request::input('Pname', ''),
			//'SkuP' 		=> Request::input('Sku', ''),  이전 SkuD를 복사
			//'SkuP1' 		=> Request::input('Sku', ''),  이전 SkuD1를 복사
			'SkuD' 			=> Request::input('Sku', ''),
			'SkuD1' 		=> Request::input('Sku1', ''),
			//'PurlP' 		=> Request::input('Purl', ''),  이전 PurlD를 복사
			'PurlD' 		=> Request::input('Purl', ''),
			//'PimgP' 		=> Request::input('Pimg', ''),  이전 PimgD를 복사
			'PimgD' 		=> Request::input('Pimg', ''),
			'Brand' 		=> Request::input('Brand', ''),
			'BrandID' 		=> Request::input('Brand', ''),
			'Maker' 		=> Request::input('Maker', ''),
			'Nation' 		=> Request::input('Nation', ''),
			'Lprice' 		=> Request::input('LpriceP', ''),
			'Sprice' 		=> Request::input('SpriceP', ''),
			'LpriceS' 		=> Request::input('Lrprice', ''),
			'SpriceS' 		=> Request::input('Srprice', ''),
			'Shipping' 		=> Request::input('Shipping', ''),
			'POD'			=> Request::input('POD', '0'),
			'Ccode1' 		=> Request::input('Ccode1', ''),
			'Ccode2' 		=> Request::input('Ccode2', ''),
			'Ccode3' 		=> Request::input('Ccode3', ''),
			'Ccode4' 		=> Request::input('Ccode4', ''),
			'Depth' 		=> 3,
			'Ctxt1'			=> Request::input('Cname1', ''),
			'Ctxt2'			=> Request::input('Cname2', ''),
			'Ctxt3'			=> Request::input('Cname3', ''),
			'Ctxt4'			=> Request::input('Cname4', ''),
				
			
			'ItemCode' 		=> Request::input('ItemCode', ''),
			
			
			'Pimg' 			=> Request::input('Pimg', ''),
			'PimgP' 		=> Request::input('PimgP', ''),
			'PimgD' 		=> Request::input('PimgD', ''),
			'LogoImg' 		=> Request::input('LogoImg', ''),
			'Story' 		=> Request::input('Story', ''),
			'ColorInfo' 	=> Request::input('ColorInfo', ''),
			'StillInfo' 	=> Request::input('StillInfo', ''),
			'SizeInfo' 		=> Request::input('SizeInfo', ''),
			'ExchangeRate' 	=> Request::input('ExchangeRate', ''),
			
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
			'MDID' 			=> Request::input('MDID', ''),			
	);
	
	/*$cnt = DB::connection('sqlsrv')->select("SELECT count(*) as cnt FROM information_schema.TABLES WHERE TABLE_NAME = ?", array("cgProdMain_".$ProdMain['MallID']));
	if (!($cnt[0]->cnt))
	{
		$query = "CREATE TABLE cgProdMain_".$ProdMain['MallID']."(
				idx BIGINT NOT NULL PRIMARY KEY CLUSTERED,
				mall VARCHAR(30) NOT NULL,
				brand VARCHAR(30) NOT NULL,
				name VARCHAR(200) NOT NULL,
				img VARCHAR(500) NOT NULL,
				kPriceO INT NOT NULL,
				kPriceS INT NOT NULL,
				cateL TINYINT NOT NULL,
				cateM TINYINT NOT NULL,
				cateS TINYINT NOT NULL,
				hitCnt INT DEFAULT 0
				)";
		
		DB::connection('sqlsrv')->insert("$query");
	}*/
	
	
	$table = "cgProdMain_".$data['MallID']."_".$data['MallKind'];
	
	$cnt = DB::connection('sqlsrv')->select("SELECT count(*) as cnt FROM $table WHERE ProdInc = ?", array($data['ProdInc']));
	if ($cnt[0]->cnt)
		DB::connection('sqlsrv')->table($table)->where('ProdInc', $data['ProdInc'])->update($data);
	else
		DB::connection('sqlsrv')->table($table)->insert($data);
	
?>

