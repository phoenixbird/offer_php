<?php
/**
 * 二维数组查找
 *在一个二维数组中（每个一维数组的长度相同），每一行都按照从左到右递增的顺序排序，
 * 每一列都按照从上到下递增的顺序排序。请完成一个函数，输入这样的一个二维数组和一个整数，
 * 判断数组中是否含有该整数
 * 1   2   8   9
 * 2   4   9   12
 * 4   7   10  13
 * 6   8   11  15
 *
 * PHP有数组函数，就不必用对角线右上角那个思路了
 */
//$array = array(0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red');
//$result=array_search('green',$array);
//var_dump($result);
/**
 * @param $target
 * @param $array
 * @return bool
 */
function findInMatrix($target,$array){
    if(!empty($array)){
        foreach ($array as $arr){
            if(array_search($target,$arr)!==false){
                return true;
            }
        }
    }
    return false;
}
$arr=[
    [1,2,8,9],
    [2,4,9,12],
    [4,7,10,13],
    [6,8,11,15]
];
var_dump(findInMatrix(7,$arr));
var_dump(findInMatrix(5,$arr));

/*
 * 时间复杂度最低
 */
function find_in_array($search,$arr){
    //二维数组有多少行，多少列
    $count_row=count($arr);
    $count_col=count($arr[0]);
    $i=0;
    $j=$count_col-1;
    while ($i<$count_row && $j>=0){
        if($arr[$i][$j]>$search){
            $j--;
        }elseif ($arr[$i][$j]<$search){
            $i++;
        }else{
            return true;
        }
    }
    return false;
}
