<?php

@mysql_connect('boxone.c2byxfiradkw.ap-northeast-1.rds.amazonaws.com', 'boxone', '1q2w3e!!');
@mysql_select_db('boxone');

$cur_time = strtotime(date("Y-m-d H:i:s"));

// 핫딜 refresh
$hotdeal = @mysql_query("SELECT idx, deadline FROM hotdeal_promo WHERE stat='N'");

while($row1 = mysql_fetch_array($hotdeal)) {
    $cur_idx = $row1["idx"];
    if( strtotime($row1["deadline"]) < $cur_time){
        @mysql_query("DELETE FROM hotdeal_promo WHERE idx=$cur_idx");
        // cascade로 hotdeal_bookmark는 자동으로 삭제됨
    }
}


// 배송+통관 refresh
/*
$shipment = @mysql_query("SELECT * FROM shipment_domestic")

while($row2 = mysql_fetch_array($shipment)) {
    $cur_idx = $row2["idx"];
	   if( strtotime($row2["date"]) < $cur_time){
	     @mysql_query("UPDATE battle set stat='E' WHERE idx=$cur_idx");
    }
}
*/
