<?php $deleteList = DB::connection('sqlsrv')->select("SELECT MallKind, MallID, ProdInc, DeleteDate8 FROM cgDeleteLog");?>
<?php foreach ($deleteList as $list) :?>
	<?=$list->MallKind?>:<?=$list->MallID?>:<?=$list->ProdInc?>:<?=$list->DeleteDate8?>,
<?php endforeach;?>