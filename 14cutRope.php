<?php
/**
 * 动态规划和贪婪算法
 *
 * 给你一根长度为n的绳子，请把绳子剪成m段（m、n都是整数，n>1并且m>1），
 * 每段绳子的长度记为k[0],k[1],...,k[m]。请问k[0]xk[1]x...xk[m]可能的最大乘积是多少？
 * 例如，当绳子的长度是8时，我们把它剪成长度分别为2、3、3的三段，此时得到的最大乘积是18。
 * 当2=<n<=60
 */

//首先要画出几种临界的情况，在来分析
function cutRope($length){
    if($length<2){
        return 0;
    }elseif ($length==2){
        return 1;
    }elseif ($length==3){
        return 2;
    }
    $len_3=intval($length/3);
    if($length-$len_3*3==1){
        $len_3-=1;
    }
    $len_2=($length-$len_3*3)/2;
    return pow(3,$len_3)*pow(2,$len_2);

}
$length=8;
var_dump(cutRope($length));