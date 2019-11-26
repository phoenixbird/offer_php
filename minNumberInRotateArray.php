<?php
/**
 * 旋转数组的最小数字
 * 把一个数组最开始的若干个元素搬到数组的末尾，我们称之为数组的旋转。
 * 输入一个非递减排序的数组的一个旋转，输出旋转数组的最小元素。
 * 例如数组{3,4,5,1,2}为{1,2,3,4,5}的一个旋转，该数组的最小值为1。
 *
 * 特例 [1,0,1,1,1]又该如何查找呢 第一个，中间的和最后一个值相等这个特例要考虑到
 *
 */

//二分查找的PHP实现
//有序数组 [1,2,3,4,5,6,7,8,9] 自增顺序
/**
 * @param $arr
 * @param $num
 * @return bool|mixed
 */
function binary_search($arr,$num){
    $start=0;
    $end=count($arr)-1;
    while($start<=$end){
        $mid=intval(($start+$end)/2);
        if($arr[$mid]>$num){
            $end=$mid-1;
        }elseif ($arr[$mid]<$num){
            $start=$mid+1;
        }else{
            return $arr[$mid];
        }
    }
    return false;
}

//$arr=[1,2,3,4,5,6,7,8,9];
//$num=19;
//var_dump(binary_search($arr,$num));

//[4,6,8,1,2,3] ,[1,1,1,0,1]
//二分查找法时间复杂度是O(log N)
function minNumberInRotateArray($rotateArray)
{
    // write code here
    if (empty($rotateArray)){
        return null;
    }

    $start=0;
    $end=count($rotateArray)-1;
    while($rotateArray[$start]>=$rotateArray[$end]){
        if(($end-$start)==1){
            return $rotateArray[$end];
        }
        $mid=intval(($start+$end)/2);
        if($rotateArray[$mid]==$rotateArray[$start] &&
        $rotateArray[$mid]==$rotateArray[$end]){
            for ($i=$start+1;$i<=$end;$i++){
                if($rotateArray[$start]>$rotateArray[$i]){
                    return $rotateArray[$i];
                }
            }
        }
        if($rotateArray[$mid]>$rotateArray[$start]){
            $start=$mid;
        }elseif ($rotateArray[$mid]<$rotateArray[$end]){
            $end=$mid;
        }
    }
    return false;
}

//function sequential_search($arr,$start,$end){
//    $result=[];
//    for ($i=$start+1;$i<=$end;$i++){
//        if($arr[$start]>$arr[$i]){
//            $result=$arr[$i];
//        }
//    }
//    return $result;
//}
//$arr=[1,1,1,0,1];
//$arr=[7,8,9,12,4,6];
//
//var_dump(minNumberInRotateArray($arr));

//本题目刻意用二分查找来做 while循环加for循环导致牛客网通不过运行时间过长
//通过示例发现一个特点[7,8,9,12,4,6]--[4,6,8,1,2,3]
// 分界线就是前一个数组第一个数字大于后一个递增数组的第一个数字
//或者当有数字小于第一个递增数组的第一个数字就是要找的位置
//两种思路 1）数组中出现后一个数字小于前一个数字的时候 就是要找的位置
//2）当数组中出现数字小于第一个递增数组的第一个数字时候 就是要找的位置
//综上2）是有标杆的 1）有两个未知

//时间复杂度O(N)比二分法大
function minNumberInRotateArray2($rotateArray){
    if (empty($rotateArray)){
        return null;
    }
    $min=$rotateArray[0];
    //for 循环通过不了，foreach在牛客网上可以通过
//    for($i=0;$i<count($rotateArray)-1;$i++){
//        if($min>$rotateArray[$i]){
//            $min=$rotateArray[$i];
//        }
//    }
    foreach ($rotateArray as $value) {
        if ($min > $value) {
            $min = $value;
        }
    }
    return $min;
}
$arr=[7,8,9,12,15,1,2,5];
var_dump(minNumberInRotateArray2($arr));
