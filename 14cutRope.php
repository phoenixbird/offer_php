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
//$length=5;
//var_dump(cutRope($length));

//动态规划思想做一遍，时间复杂度比贪婪算法大很多
function cutRope2($length){
    if($length<2){
        return 0;
    }elseif ($length==2){
        return 1;
    }elseif ($length==3){
        return 2;
    }
    //动态规划$len_collect[$i]表示长度为$i的绳子，任意分割后的分段长度积的最大值
    $len_collect=[];
    $len_collect[0]=0;
    $len_collect[1]=1;
    $len_collect[2]=2;
    //长度为3的绳子最大积是3，不分的情况，分的话为2
    $len_collect[3]=3;
    //从4开始进行迭代
    for($i=4;$i<=$length;$i++){
        $max=0;
        for ($j=1;$j<=intval($i/2);$j++){
            $len_collects=$len_collect[$j]*$len_collect[$i-$j];
            if($max<$len_collects){
                $max=$len_collects;
            }
            $len_collect[$i]=$max;
        }
    }
    $max=$len_collect[$length];
    return $max;
}
$length=5;
var_dump(cutRope2($length));