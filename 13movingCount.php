<?php

/**
 * 回溯法的另一个运用
 * 地上有一个m行n列的方格，一个机器人从坐标为(0,0)的格子开始移动，
 * 它每次可以向左，向右，向上，向下移动一格，但不能进入行坐标和列坐标的位数之和大于k的格子
 * 例如当k=18时候，机器人能进入方格(35,37),因为3+5+3+7=18.不能进入方格(35,38)。
 * 请问机器人能到达到少个格子
 *
 * 根据剑指offer书中讲解 写出运行成功的代码
 * 本题目的一个很难思考到的是参数引用传递的运用，对比上一题，
 * 本题中标识的数组在每次调用的时候需要用到改变后的标识数组，与上一题是不同的
 */


function movingCount($k, $rows, $cols)
{
    //不符合条件的话 个数为0，如果返回false的话含意不清
    if($k<=0||$rows<=0||$cols<=0){
        return 0;
    }
    //题目要求的是机器人可以到达的格子的数量
//    $visited=array_fill(0,$rows*$cols,0);
    $visited = array_fill(0, $rows, array_fill(0, $cols, 0));//另一种思路
    //计算出从coordinate为(0,0)开始，机器人移动到达的格子数目
    $counts = calculateCount($k, $rows, $cols, 0, 0, $visited);
    return $counts;
}

//本例中容易忽略的就是用来标识的布尔矩阵 需要引用传递，
//默认情况下函数参数通过值传递（即使在函数内部改变参数的值，它并不会改变函数外部的值）
//希望允许函数修改它的参数值，必须通过引用传递传参
function calculateCount($k, $rows, $cols, $i, $j, &$visited)
{
    $count=0;
    if(checkCoordinate($k, $rows, $cols, $i, $j, $visited)){
//        $visited[$j+$i*$cols] = 1;
        $visited[$i][$j]=1;
        $count = 1 + calculateCount($k, $rows, $cols, $i - 1, $j, $visited)
            + calculateCount($k, $rows, $cols, $i + 1, $j, $visited)
            + calculateCount($k, $rows, $cols, $i, $j - 1, $visited)
            + calculateCount($k, $rows, $cols, $i, $j + 1, $visited);
    }
    return $count;


}

//判断机器人能否进入一个坐标($i,$j)
function checkCoordinate($k, $rows, $cols, $i, $j, $visited)
{
    if ($i < 0 || $i >= $rows || $j < 0 || $j >= $cols || getDigitSum($i) + getDigitSum($j) > $k || $visited[$i][$j] == 1) {
        //这里返回的是数值
        return false;
    }
    return true;
}

//求数字的位数之和 如123 善用while循环结构

function getDigitSum($num)
{
    $sum = 0;
    while ($num > 0) {
        $sum += $num % 10;
        $num = intval($num / 10);
    }
    return $sum;
}

/*
 * a b c d (0,0) (0,1) (0,2) (0,3)
 * e f g h (1,0) (1,1) (1,2) (1,3)
 * i j k l (2,0) (2,1) (2,2) (2,3)
 * m n o p (3,0) (3,1) (3,2) (3,3)
 *
 */
$k = 3;
var_dump(movingCount(3, 4, 4));




