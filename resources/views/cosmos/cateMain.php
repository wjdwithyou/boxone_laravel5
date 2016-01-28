<?php
	header("Content-Type: text/xml; charset=utf-8");
	echo "<?xml version='1.0' encoding='utf-8'?>";
?>

<CateCust>
<?php
	for($i = 1; $i <= 3; ++$i):
		$query_piece = ($i >= 3)? 'm_idx, idx, ': (($i >= 2)? 'm_idx, m_': 'l_');
		
		$result = DB::select('SELECT distinct l_idx, '.$query_piece.'name from category');
		
		for ($j = 0; $j < count($result); ++$j):
			$name = ($i >= 3)? $result[$j]->name: (($i >= 2)? $result[$j]->m_name: $result[$j]->l_name);
?>
	<Category>
		<CustID>boxone</CustID>
		<Cinc><?=$result[$j]->l_idx?><?=($i>=2)?sprintf("%02d",$result[$j]->m_idx):'00'?><?=($i>=3)?sprintf("%03d",$result[$j]->idx):'000'?></Cinc>
		<Ccode1><?=$result[$j]->l_idx?></Ccode1>
		<Ccode2><?=($i>=2)?$result[$j]->m_idx:0?></Ccode2>
		<Ccode3><?=($i>=3)?$result[$j]->idx:0?></Ccode3>
		<Depth><?=$i?></Depth>
		<CateName><![CDATA[<?=$name?>]]></CateName>
	</Category>
		<?php endfor;?>
	<?php endfor;?>
</CateCust>

