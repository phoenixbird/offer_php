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


function hasPath($matrix, $rows, $cols, $path)
{
$len = strlen($matrix);
    //是否访问过
    $visited = array_fill(0,$len,false);
    for ($i=0; $i < $rows; $i++) {
        for ($j=0; $j < $cols; $j++) {
            if(judge($matrix,$rows,$cols,$i,$j,$visited,$path,0)){
                return true;
            }
        }
    }
    return false;
}

/**
 * @param array $matrix
 * @param int $rows
 * @param int $cols
 * @param int $i
 * @param int $j
 * @param bool[] $visted 是否访问过
 * @param string $path 路径
 * @param int $path_index 当前检查的路径下标
 */
function judge($matrix,$rows,$cols,$i,$j,$visited,$path,$path_index)
{
    //传入的是一维数组,因此需要转换下标
    $index = $j + $i * $cols;

    //下标越界 或 已经访问过 或 路径对应的字符串与数组中的不相同
    if($i < 0 || $j < 0 || $i >= $rows || $j >= $cols || $visited[$index] === true || $path[$path_index] !== $matrix[$index]){
        return false;
    }

    //到达路径末尾,返回true
    if(strlen($path) - 1 === $path_index){
        return true;
    }

    //标记当前节点已经访问过
    $visited[$index] = true;

    //像四面寻找下一个路径，找到返回true
    if(judge($matrix,$rows,$cols,$i - 1,$j,$visited,$path,$path_index + 1) ||
        judge($matrix,$rows,$cols,$i + 1,$j,$visited,$path,$path_index + 1) ||
        judge($matrix,$rows,$cols,$i,$j - 1,$visited,$path,$path_index + 1) ||
        judge($matrix,$rows,$cols,$i,$j + 1,$visited,$path,$path_index + 1)
    ){
        return true;
    }

    //未找到，则当前节点不可用，设置为未访问并返回false
    $visited[$index] = false;
    return false;
}
$matrix='abcesfcsadee';
$rows=3;
$cols=4;
$path='bcced';
var_dump(hasPath($matrix,$rows,$cols,$path));