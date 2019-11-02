<?php
/**
 * 写一个函数,输入n,求出斐波那契数列的第n项
 * 0,1,1,2,3,5,8,13,21,34,55,...
 */

//此方法的时间复杂度是指数级别的,不是面试官所期待的算法
function fibonacci($num){
    if($num==0){
        return 0;
    }elseif ($num==1){
        return 1;
    }elseif ($num>1){
        return fibonacci($num-1)+fibonacci($num-2);
    }else{
        return false;
    }
}
//$num=20;
//var_dump(fibonacci($num));

//结合for循环把重复计算的值保存起来，时间复杂度O(n)
function fibonacci1($n){
    $fibN=0;
    $fibN_1=1;
    $fibN_2=0;
    if($n==0){
        return 0;
    }elseif ($n==1){
        return 1;
    }elseif ($n>1){
        for($i=2;$i<=$n;$i++){
            $fibN=$fibN_1+$fibN_2;
            //每次赋值的顺序是前1赋给前2，当前赋给前1
            $fibN_2=$fibN_1;
            $fibN_1=$fibN;
        }
        return $fibN;
    }else{
        return false;
    }
}
var_dump(fibonacci1(8));