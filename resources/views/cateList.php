<?php
	header("Content-type: text/xml;charset=euc-kr");
	$result1 = DB::select('SELECT * from category_large');
	$result2 = DB::select('SELECT * from category_medium');
	$result3 = DB::select('SELECT m.large_idx AS lidx, m.idx AS midx, s.idx AS sidx, s.name FROM category_medium AS m LEFT JOIN category_small AS s ON s.medium_idx = m.idx');
	
	echo "<?xml version='1.0' encoding='euc-kr'?>\n";
	echo "<CateCust>";
?>

<?php foreach($result1 as $list1):?>
<Category>
	<CustID>boxone</CustID>
	<Cinc>l<?= $list1->idx?>m0s0</Cinc>
	<Ccode1><?= $list1->idx?></Ccode1>
	<Ccode2>0</Ccode2>
	<Ccode3>0</Ccode3>
	<Depth>1</Depth>
	<CateName><?= $list1->name?></CateName>
</Category>
<?php endforeach;?>

<?php foreach($result2 as $list2):?>
<Category>
	<CustID>boxone</CustID>
	<Cinc>l<?= $list2->large_idx?>m<?= $list2->idx?>s0</Cinc>
	<Ccode1><?= $list2->large_idx?></Ccode1>
	<Ccode2><?= $list2->idx?></Ccode2>
	<Ccode3>0</Ccode3>
	<Depth>2</Depth>
	<CateName><?= $list2->name?></CateName>
</Category>
<?php endforeach;?>
	
<?php foreach($result3 as $list3):?>
<Category>
	<CustID>boxone</CustID>
	<Cinc>l<?= $list3->lidx?>m<?= $list3->midx?>s<?= $list3->sidx?></Cinc>
	<Ccode1><?= $list3->lidx?></Ccode1>
	<Ccode2><?= $list3->midx?></Ccode2>
	<Ccode3><?= $list3->sidx?></Ccode3>
	<Depth>3</Depth>
	<CateName><?= $list3->name?></CateName>
</Category>
<?php endforeach;?>
	
	
	
	
	
