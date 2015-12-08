<?php

@mysql_connect('boxone.c2byxfiradkw.ap-northeast-1.rds.amazonaws.com', 'boxone', '1q2w3e!!');
@mysql_select_db('boxone');

$cur_time = strtotime(date("Y-m-d H:i:s"));

// 핫딜 refresh
$result = @mysql_query("SELECT idx, deadline FROM hotdeal_promo WHERE stat='N'");

while($row = mysql_fetch_array($result)) {
    $cur_idx = $row["idx"];
    if( strtotime($row["date"]) < $cur_time){
        @mysql_query("UPDATE battle set stat='E' WHERE idx=$cur_idx");
    }
}



// 배송+통관 refresh

