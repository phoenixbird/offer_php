<?php
/**
 * 字符串的排列
 * 输入一个字符串,按字典序打印出该字符串中字符的所有排列。
 * 例如输入字符串abc,则打印出由字符a,b,c所能排列出来的所有字符串abc,acb,bac,bca,cab和cba
 *
 * 参考网上的思路，琢磨了好久才稍微明白 这递归思想
 * 递归的条件是 当字符串第一个位置及倒数第二个位置上字符确定时候，返回一个结果
 */

//交换两个字符值
function swap(&$a, &$b){
    $tmp = $a;
    $a = $b;
    $b = $tmp;
}


$str="abc";
function Permutation($str){
    // write code here
    $result=[];
    if($str==""){
        return [];
    }
    $arr = str_split($str);
    sort($arr);
    recursion($arr,$result,'');
    return $result;
}
//递归得出结果
//注意参数的递归引用的使用，在函数内部 定义了 $res 并且func(&$res) 与func(&res2)同一个函数调用
//效果是完全不同的
function recursion($arr,&$result,$str){
    $len = count($arr);
    //递归出来的条件
    if($len == 1){
        $result[] = $str.$arr[0];
        return;
    }

    for($i=0;$i<$len;$i++){
        if($i!=0 && $arr[$i] == $arr[0]){
            continue;
        }
//        var_dump($arr);
        swap($arr[$i],$arr[0]);
//        var_dump($arr);
        $arr_swap=array_slice($arr,1);
//        var_dump("第".$i."次",$arr_swap,$result,$str.$arr[0]);
//        var_dump('---');
        //这里参数是$result与$r是完全不一样的
        recursion($arr_swap, $result, $str.$arr[0]);
    }
}
Permutation($str);
