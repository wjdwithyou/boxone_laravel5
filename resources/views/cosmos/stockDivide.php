<?php
	header("Content-Type: text/xml; charset=utf-8");
	$data = array(
		'MallKind' 		=> Request::input('MallKind', ''),
		'MallID' 		=> Request::input('MallID', ''),
		'DivideCnt' 		=> Request::input('DivideCnt', '')
	);
	
	echo "<?xml version='1.0' encoding='utf-8'?> <Data>";
	
	$stockList = DB::connection('sqlsrv')->select("SELECT ProdInc FROM cgProdMain_".$data['MallID']."_".$data['MallKind']);
	$cnt = ceil(count($stockList)/$data['DivideCnt']);
	for ($i = 0 ; $i < count+2 ;$i+=$cnt): ?>
		<Divide> <No><?=$j?></No> <MallKind><?=$data['MallKind']?></MallKind> <MallID><?=$data['MallID']?></MallID> <PcodeS><?=$i?></PcodeS> <PcodeE><?=$i+$cnt?></PcodeE><CntP><?=$cnt?></CntP></Divide> 
<?php 
	endfor;
	echo "</Data>";
?>


