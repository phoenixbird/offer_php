<?php
/**
 * 回溯法
 *请设计一个函数，用来判断在一个矩阵中是否存在一条包含某字符串所有字符的路径。
 * 路径可以从矩阵中的任意一个格子开始，每一步可以在矩阵中向左，向右，向上，向下移动一个格子。
 * 如果一条路径经过了矩阵中的某一个格子，则该路径不能再进入该格子。
 * 例如 a b c e s f c s a d e e 矩阵中包含一条字符串"bcced"的路径，
 * 但是矩阵中不包含"abcb"路径，因为字符串的第一个字符b占据了矩阵中的第一行第二个格子之后，
 * 路径不能再次进入该格子。
 *
 * 对于二维数组问题常用回溯法解决，问题本质是树结构，用一维数组线性结构表示出来。
 * 多思考条件找出跳出递归的所有条件。本解法是网上参考后自己撸了一遍，理解其思想.
 * 遇到个插曲导致出错i行j列 转化为一维的数值为 $j+$i*$cols
 */


/*
 * 回溯法
 * 首先条件给的$matrix矩阵是一串字符串，并不是直接给的二维数组，str_split函数利用它的第二参数可直观矩阵
 * $rows和$cols代表矩阵的行数和列数3*4和2*6以及4*3结果是不一样的，具体数值题目中给的
 */

/**
 * @param $matrix 矩阵
 * @param $rows 行数
 * @param $cols 列数
 * @param $path 需要判断的字符串路径
 * @return bool
 */
function hasPath($matrix, $rows, $cols, $path)
{
    //因为路径不能重复进入格子，需要定义一个和题目矩阵大小一样的布尔矩阵
    $len=strlen($matrix);
    $visited = array_fill(0,$len,false);
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            //需要判断$arr[i][j]是否是字符串$path的第n个字符
            if (strInPath($matrix,$rows,$cols,$i,$j,$visited,$path,0)){
                return true;
            }
        }
    }
    return false;
}

//判断第i行，第j列的格子是否是路径字符串中$path[$path_index]字符
//当出现如下条件，返回false
//1.边界条件不满足
//2.当前字符不匹配
//3.已经遍历过的字符，$visited[]相应位置为true
//当出现如下条件，返回true
//路径字符已经遍历结束

/**
 * @param $matrix
 * @param $rows
 * @param $cols
 * @param $i
 * @param $j
 * @param $visited
 * @param $path
 * @param $path_index
 * @return bool
 */
function strInPath($matrix, $rows, $cols, $i, $j, $visited, $path, $path_index=0)
{
    //经过两个for循环，二维数组已经降维一维数组,第i行第j列一维数组下标为
    $index = $j + $i * $cols;
    //下标越界，已经访问过，字符不匹配时候
    if ($i < 0 || $j < 0 || $i >= $rows || $j >= $cols ||
        $visited[$index] === true || $path[$path_index] !== $matrix[$index]) {
        return false;
    }
    //如果已经遍历比较到路径字符串的末尾，则跳出递归
    if (strlen($path) - 1 === $path_index) {
        return true;
    }
    //标记当前的格子已经访问过
    $visited[$index] = true;
    //此时还没有返回的话 就需要向格子的上下左右寻找下一个字符是否符合条件
    if (strInPath($matrix,$rows,$cols,$i-1,$j,$visited,$path,$path_index+1)||
        strInPath($matrix,$rows,$cols,$i+1,$j,$visited,$path,$path_index+1)||
        strInPath($matrix,$rows,$cols,$i,$j-1,$visited,$path,$path_index+1)||
        strInPath($matrix,$rows,$cols,$i,$j+1,$visited,$path,$path_index+1)) {
        return true;
    }
    //如果还是未找到的话，则当前格子不符合条件，重置未未访问
    $visited[$index]=false;
    return false;
}


/*
 * 3*4矩阵
 * a b c e --0 1 2 3
 * s f c s --4 5 6 7
 * a d e e --8 9 10 11
 * $path[1]=b
 */
$matrix = 'abcesfcsadee';
$rows = 3;
$cols = 4;
$path = 'bcc';
//hasPath($matrix, $rows, $cols, $path);
var_dump(hasPath($matrix,$rows,$cols,$path));
