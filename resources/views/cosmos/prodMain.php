<?php
	use Request;

	header("Content-Type: text/xml; charset=utf-8");
	$ProdMain = array(
			'CustID' 		=> Request::input('CustID', ''),
			'MallKind' 		=> Request::input('MallKind', ''),
			'MallID' 		=> Request::input('MallID', ''),
			'ServiceID' 	=> Request::input('ServiceID', ''),
			'ProdInc' 		=> Request::input('ProdInc', ''),
			'Pname' 		=> Request::input('Pname', ''),
			'Brand' 		=> Request::input('Brand', ''),
			'ItemCode' 		=> Request::input('ItemCode', ''),
			'Sku' 			=> Request::input('Sku', ''),
			'Nation' 		=> Request::input('Nation', ''),
			'Maker' 		=> Request::input('Maker', ''),
			'Lprice' 		=> Request::input('Lprice', ''),
			'Sprice' 		=> Request::input('Sprice', ''),
			'Ccode1' 		=> Request::input('Ccode1', ''),
			'Ccode2' 		=> Request::input('Ccode2', ''),
			'Ccode3' 		=> Request::input('Ccode3', ''),
			'Ccode4' 		=> Request::input('Ccode4', ''),
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
			'MDID' 			=> Request::input('MDID', ''),			
	);
	
	$cnt = DB::connection('sqlsrv')->select("SELECT count(*) as cnt FROM information_schema.TABLES WHERE TABLE_NAME = ?", array("cgProdMain_".$ProdMain['MallID']));
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
	}
	
	
	
	
	echo "<?xml version='1.0' encoding='utf-8'?>\n";
?>

