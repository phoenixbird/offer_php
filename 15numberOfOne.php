<?php

function numberOfOne($num){
    $count=0;
    //还要考虑为负整数的情况
    if($num < 0){//负数最高位变成0 转化成正数
        $num = $num & 0xffffffff;
    }
    while ($num!==0){
        $count++;
        $num=$num&($num-1);
    }
    return $count;
}
$num=11;
var_dump(numberOfOne($num));
