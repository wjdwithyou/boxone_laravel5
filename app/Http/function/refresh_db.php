<?php

@mysql_connect('boxone.c2byxfiradkw.ap-northeast-1.rds.amazonaws.com', 'boxone', '1q2w3e!!');
@mysql_select_db('boxone');

$cur_time = strtotime(date("Y-m-d H:i:s"));

$result = @mysql_query("SELECT idx, date FROM battle WHERE stat='N'");

while($row = mysql_fetch_array($result)) {
    $cur_idx = $row["idx"];
    if( strtotime($row["date"]) < $cur_time){
        @mysql_query("UPDATE battle set stat='E' WHERE idx=$cur_idx");
    }
}

