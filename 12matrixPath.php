<?php
/**
 * 回溯法
 *请设计一个函数，用来判断在一个矩阵中是否存在一条包含某字符串所有字符的路径。
 * 路径可以从矩阵中的任意一个格子开始，每一步可以在矩阵中向左，向右，向上，向下移动一个格子。
 * 如果一条路径经过了矩阵中的某一个格子，则该路径不能再进入该格子。
 * 例如 a b c e s f c s a d e e 矩阵中包含一条字符串"bcced"的路径，
 * 但是矩阵中不包含"abcb"路径，因为字符串的第一个字符b占据了矩阵中的第一行第二个格子之后，
 * 路径不能再次进入该格子。
 */


/*
 * 回溯法
 * 首先条件给的$matrix矩阵是一串字符串，并不是直接给的二维数组，str_split函数利用它的第二参数可直观矩阵
 * $rows和$cols代表矩阵的行数和列数3*4和2*6以及4*3结果是不一样的，具体数值题目中给的
 */

/**
 * 一串字符串可以看成是一维数组
 * @param $matrix
 * 条件给的矩阵字符串
 * @param $rows
 * @param $cols
 * 3*4矩阵的行数和列数
 * @param $path
 * 查找的字符串路径
 * @return bool
 */
function hasPath($matrix, $rows, $cols, $path)
{
    //需要一个表示为 标记这个字符串是否被访问过了
    $len=strlen($matrix);
    //初始化一个与矩阵字符串对应的一个一维数组，用来表示某个位置的字符是访问过的
    $visited=array_fill(0,$len,false);
    //根据题意矩阵是3*4的二维数组，这就要一个变量表示各个位置
    for($i=0;$i<$rows;$i++){
        for ($j=0;$j<$cols;$j++){
            //判断一个位置上的字符在不在查找的字符串路径上，在写一个方法
            if(isInPath($matrix,$rows,$cols,$path,$i,$j,$visited,$path_index=0)){
                return true;
            }
        }
    }
    return false;
}

/**
 * @param $matrix
 * @param $rows
 * @param $cols
 * @param $path
 * @param $i
 * @param $j
 * @param $visited
 * @param int $path_index
 */
function isInPath($matrix,$rows,$cols,$path,$i,$j,$visited,$path_index=0){
    //传入的字符串的下标
    $index=$j+$i*$cols;
    //如果下标越界 或者 已经访问过 或者 路径字符串下标的字符与矩阵中的字符不一样
    if($i<0 || $j<0 || $i>=$rows || $j>=$cols ||$visited[$index]==true ||
        $matrix[$path_index]!==$path[$index]){
        return false;
    }
    
}


/*
 * 3*4矩阵
 * a b c e --0 1 2 3
 * s f c s --4 5 6 7
 * a d e e --8 9 10 11
 * $path[1]=b
 */
$matrix='abcesfcsadee';
$rows=3;
$cols=4;
$path='bcced';
hasPath($matrix,$rows,$cols,$path);
//var_dump(hasPath($matrix,$rows,$cols,$path));
